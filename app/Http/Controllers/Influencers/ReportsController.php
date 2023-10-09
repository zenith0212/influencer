<?php

namespace App\Http\Controllers\Influencers;

use App\Http\Controllers\Controller;
use App\Models\{Campaigns, CampaignConnectedInfluencers, User, BrandDetails};
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Stripe\OAuth;
use Stripe\Stripe;
use Stripe\StripeClient;
use PDF;

class ReportsController extends Controller
{
    public function index() {
        $totalReleaseAmount     = CampaignConnectedInfluencers::where(['influencer_id' => Auth::user()->id, 'payment_status' => '4', 'is_paid' => 1])->sum('negotiation_price');
        $remainingReleaseAmount = CampaignConnectedInfluencers::where(['influencer_id' => Auth::user()->id, 'offer_status' => '2', 'is_paid' => 0])->sum('negotiation_price');
        $this->data = array(
            'title'                     => 'Total Earnings',
            'totalReleaseAmount'        => $totalReleaseAmount,
            'remainingReleaseAmount'    => $remainingReleaseAmount
        );
        return view('influencer-users.total-earnings', $this->data);
    }

    // Get total earnings of the influencer
    public function getTotalEarnings(Request $request){
        $userId     = Auth::user()->id;
        $draw       = $request->get('draw');
        $start      = $request->get("start");
        $rowPerPage = $request->get("length"); // Rows display per page

        $columnIndex_arr    = $request->get('order');
        $columnName_arr     = $request->get('columns');
        $order_arr          = $request->get('order');
        $search_arr         = $request->get('search');

        $columnIndex        = $columnIndex_arr[0]['column']; // Column index
        $columnName         = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder    = $order_arr[0]['dir']; // asc or desc
        $searchValue        = $request->get('search_string'); // Search value

        // Total records
        $totalCampaigns             = CampaignConnectedInfluencers::select('count(*) as allcount')->where(['influencer_id' => $userId, 'offer_status' => "2"])->count();
        $totalCampaignsWithFilter   = CampaignConnectedInfluencers::select('count(*) as allcount')->where(['influencer_id' => $userId, 'offer_status' => "2"])->count();

        // Fetch records
        $earnings = CampaignConnectedInfluencers::with(['campaigns'])
                        ->whereHas('campaigns', function($q) use($searchValue) {
                            $q->where('campaigns.name_en', 'like', "%$searchValue%");
                    })
                    ->where(['influencer_id' => $userId, 'offer_status' => "2"])
                    ->skip($start)
                    ->take($rowPerPage)
                    ->get();

        $response = [];

        foreach ( $earnings as $earning ) {
            $thumbnailImage = !empty($earning->campaigns->thumbnail_image) ? asset('/storage/campaign_images/').'/'.$earning->campaigns->thumbnail_image : asset('/assets/media/avatars/default_img.png');
            $startDate      = !empty($earning->campaigns->application_start_date) ? \Carbon\Carbon::parse($earning->campaigns->application_start_date)->format('jS F Y') : '';
            $endDate        = !empty($earning->campaigns->application_end_date) ? \Carbon\Carbon::parse($earning->campaigns->application_end_date)->format('jS F Y') : '';
            $response[] = array(
                'id'                        => $earning->id,
                'campaign_name'             => $earning->campaigns->name_en ?? '',
                'amount'                    => !empty($earning->negotiation_price) ? $earning->negotiation_price : 0,
                'campaign_duration'         => !empty($earning->campaigns->application_end_date) ? $startDate." - ".$endDate : $startDate,
                'thumbnail_image'           => $thumbnailImage,
                'status'                    => !empty($earning->is_paid) ? '<span class="badge text-bg-success">Paid</span>' : '<span class="badge text-bg-danger">Not Paid</span>',
                'detail'                    => route('influencer.campaign_details',$earning->campaign_id),
                'pdf_preview'               => route('pdf_preview',encrypt($earning->id)),
            );
        }

        $response = array(
            'draw'                  => intval($draw),
            'iTotalRecords'         => $totalCampaigns,
            'iTotalDisplayRecords'  => $totalCampaignsWithFilter,
            'aaData'                => $response,
        );

        return response()->json($response);
    }

    // Get the billing details of the Brand and Influencer
    public function billingDetails(){
        $stripeCustId = Auth::user()->hasRole('Influencer') ? User::whereId(Auth::user()->id)->pluck('stripe_customer_id')->first() : BrandDetails::where('user_id', Auth::user()->id)->pluck('stripe_customer_id')->first();

        if(!empty($stripeCustId)){
            $stripe = new \Stripe\StripeClient(
                config('stripe.api_keys.secret_key')
            );
            $customerData = $stripe->customers->retrieve(
                $stripeCustId,
                []
            );

            $cardData = $stripe->customers->retrieveSource(
                $stripeCustId,
                $customerData['default_source'],
                []
            );

            $cardDetails = [
                'card_holder_name'  => !empty($customerData) && !empty($customerData['name']) ? $customerData['name'] : '',
                'card_number'       => !empty($cardData) && !empty($cardData['last4']) ? $cardData['last4'] : 'XXXX',
                'card_expiry_month' => !empty($cardData) && !empty($cardData['exp_month']) ? $cardData['exp_month'] : '',
                'card_expiry_year'  => !empty($cardData) && !empty($cardData['exp_year']) ? $cardData['exp_year'] : '',
                'card_type'         => !empty($cardData) && !empty($cardData['brand']) ? $cardData['brand'] : '',
            ];

            $this->data = [
                'title'         => 'Billing Details',
                'cardDetails'   => $cardDetails,
            ];

            return view('influencer-users.billing-details', $this->data);
        } else {
            return redirect()->route('brand_dashboard')->with('error', 'Data(Stripe Customer Id) not found!');
        }
    }

    public function pdfPreview(Request $request, $id) {
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
        return $pdf->stream('inf_report_'. decrypt($id) .'.pdf');
    }
}

