<?php

namespace App\Http\Controllers;

use App\Http\Requests\StripePaymentForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\{StripeAccount, StripePayment, CampaignConnectedInfluencers, Campaigns, User, InfluencersRecords};
use Stripe\OAuth;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Exception\CardException;
use App\Services\StripePayment as StripeService;
use Illuminate\Http\JsonResponse;
use Mail;
use Exception;
use PDF;


class AdminPaymentController extends Controller
{
    public function index() {
        $totalReleaseAmount     = CampaignConnectedInfluencers::where(['payment_status' => '4', 'is_paid' => 1])->sum('negotiation_price');
        $remainingReleaseAmount = CampaignConnectedInfluencers::where(['offer_status' => '2', 'is_paid' => 0])->sum('negotiation_price');
        $this->data = array(
            'title' => 'Payments | ',
            'breadcrumbs' => array(
                'title' => 'Payments',
                'breadcrumb' => array(
                    'admin.dashboard' => __('payments.home'),
                    '',
                    'payments.index' => __('payments.title'),
                    '',
                    '#' => 'List Payments',
                ),
            ),
            'totalReleaseAmount'        => $totalReleaseAmount,
            'remainingReleaseAmount'    => $remainingReleaseAmount
        );
        return view('admin.payments.index', $this->data);
    }

    public function getPayments(Request $request): JsonResponse
    {
        ## Read value
        $draw                   = $request->get('draw');
        $start                  = $request->get("start");
        $rowperpage             = $request->get("length"); // Rows display per page

        $columnIndex_arr        = $request->get('order');
        $columnName_arr         = $request->get('columns');
        $order_arr              = $request->get('order');
        $search_arr             = $request->get('search');

        $columnIndex            = $columnIndex_arr[0]['column']; // Column index
        $columnName             = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder        = $order_arr[0]['dir']; // asc or desc
        $searchValue            = $search_arr['value']; // Search value

        // Total records
        $totalPayments                = CampaignConnectedInfluencers::select('count(*) as allcount')->where('offer_status', "2")->count();
        $totalPaymentsWithFilter      = CampaignConnectedInfluencers::select('count(*) as allcount')->where('offer_status', "2")->count();

        // Fetch records
        $payments = CampaignConnectedInfluencers::with('campaigns')
                ->where('offer_status', "2")
                ->skip($start)
                ->take($rowperpage)
                ->get();

        $response = array();

        foreach( $payments as $payment ) {
            $infName        = $payment->is_type == 1 ? User::whereId($payment->influencer_id)->pluck('name')->first() : InfluencersRecords::whereId($payment->influencer_id)->pluck('nickname')->first();
            $thumbnailImage = !empty($payment->campaigns->thumbnail_image) ? asset('/storage/campaign_images/').'/'.$payment->campaigns->thumbnail_image : asset('/assets/media/avatars/default_img.png');
            $response[] = array(
                'id'                => $payment->id,
                'thumbnail_image'   => $thumbnailImage,
                'campaign_name'     => $payment->campaigns->name_en,
                'influencer_name'   => $infName,
                'price'             => "$ ".$payment->negotiation_price,
                'campaign_duration' => !empty($payment->campaigns->application_end_date) ? \Carbon\Carbon::parse($payment->campaigns->application_start_date)->format('jS F Y').' - '. \Carbon\Carbon::parse($payment->campaigns->application_end_date)->format('jS F Y') : \Carbon\Carbon::parse($payment->campaigns->application_start_date)->format('jS F Y'),
                'status'            => !empty($payment->is_paid) ? '<span class="badge badge-success">Paid</span>' : '<span class="badge badge-danger">Not Paid</span>',
                'is_paid'           => $payment->is_paid,
                'pdf_preview'       => route('payments.admin_pdf_preview',encrypt($payment->id)),
            );
        }

        return response()->json(array(
            'draw'                  => intval($draw),
            'iTotalRecords'         => $totalPayments,
            'iTotalDisplayRecords'  => $totalPaymentsWithFilter,
            'aaData'                => $response,
         ));
    }

    public function viewPayment(Request $request){
        $payment        = CampaignConnectedInfluencers::whereId($request->id)->with('campaigns')->first();
        $infName        = $payment->is_type == 1 ? User::whereId($payment->influencer_id)->pluck('name')->first() : InfluencersRecords::whereId($payment->influencer_id)->pluck('nickname')->first();
        $paymentDetail  = [
            'campaign_name'     => $payment->campaigns->name_en,
            'influencer_name'   => $infName,
            'price'             => "$ ".$payment->negotiation_price,
            'campaign_duration' => !empty($payment->campaigns->application_end_date) ? \Carbon\Carbon::parse($payment->campaigns->application_start_date)->format('jS F Y').' - '. \Carbon\Carbon::parse($payment->campaigns->application_end_date)->format('jS F Y') : \Carbon\Carbon::parse($payment->campaigns->application_start_date)->format('jS F Y'),
            'status'            => !empty($payment->is_paid) ? '<span class="badge badge-success">Paid</span>' : '<span class="badge badge-danger">Not Paid</span>',
        ];
        return response()->json([
            'status'            => !empty($paymentDetail) ? true : false,
            'paymentDetail'     => !empty($paymentDetail) ? $paymentDetail : '',
        ]);
    }

    public function showPdf(Request $request, $id) {
        ini_set('max_execution_time', -1);
        $pdfData = CampaignConnectedInfluencers::with(['campaigns'])->whereId(decrypt($id))->first();

        $startDate      = !empty($pdfData->campaigns->application_start_date) ? \Carbon\Carbon::parse($pdfData->campaigns->application_start_date)->format('jS F Y') : '';
        $endDate        = !empty($pdfData->campaigns->application_end_date) ? \Carbon\Carbon::parse($pdfData->campaigns->application_end_date)->format('jS F Y') : '';

        $this->data = [
            'influencer_name'   => $pdfData->is_type == 1 ? User::whereId($pdfData->influencer_id)->pluck('name')->first() : InfluencersRecords::whereId($pdfData->influencer_id)->pluck('nickname')->first(),
            'campaign_name'     => $pdfData->campaigns->name_en,
            'brand_name'        => $pdfData->campaigns->brands->title_en,
            'campaign_duration' => !empty($pdfData->campaigns->application_end_date) ? $startDate." - ".$endDate : $startDate,
            'final_price'       => $pdfData->negotiation_price,
        ];
        $pdf = PDF::loadView('brand-users.pdf_view', $this->data);
        return $pdf->stream('admin_pdf_report_'. decrypt($id) .'.pdf');
    }
}
