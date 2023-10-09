<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\{Campaigns, CampaignConnectedInfluencers, User, BrandDetails, InfluencersRecords};
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use PDF;

class BrandReportController extends Controller
{
    public function index() {
        $totalCampaigns         = Campaigns::select('id', 'name_en')->where(['brand_id' => Auth::user()->id, 'is_draft' => 1])->get();
        $totalSpendAmount       = Campaigns::withSum('campaignConnectedInfluencerTotalSpend', 'negotiation_price')
                                    ->where(['campaigns.brand_id' => Auth::user()->id, 'campaigns.is_draft' => 1])
                                    ->get()
                                    ->sum('campaign_connected_influencer_total_spend_sum_negotiation_price');

        $remainingSpendAmount   = Campaigns::withSum('campaignConnectedInfluencerRemainingSpend', 'negotiation_price')
                                    ->where(['campaigns.brand_id' => Auth::user()->id, 'campaigns.is_draft' => 1])
                                    ->get()
                                    ->sum('campaign_connected_influencer_remaining_spend_sum_negotiation_price');

        $this->data = array(
            'title'                     => 'Total Spends',
            'totalCampaigns'            => $totalCampaigns,
            'totalSpendAmount'          => $totalSpendAmount,
            'remainingSpendAmount'      => $remainingSpendAmount
        );
        return view('brand-users.total-spends', $this->data);
    }

    // Get total earnings of the influencer
    public function getTotalSpends(Request $request){
        $userId     = Auth::user()->id;
        $campaignId = $request->get('campaignId');
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
        $totalCampaigns             = Campaigns::select('count(*) as allcount')->where(['id' => $campaignId, 'brand_id' => $userId, 'is_draft' => 1])->count();
        $totalCampaignsWithFilter   = Campaigns::select('count(*) as allcount')->where(['id' => $campaignId, 'brand_id' => $userId, 'is_draft' => 1])->count();

        // Fetch records
        $campaignData = Campaigns::with(['campaignConnectedInfluencer'])
                    ->where(['id' => $campaignId, 'brand_id' => $userId, 'is_draft' => 1])
                    ->skip($start)
                    ->take($rowPerPage)
                    ->first();

        $response = [];

        $startDate      = !empty($campaignData->application_start_date) ? \Carbon\Carbon::parse($campaignData->application_start_date)->format('jS F Y') : '';
        $endDate        = !empty($campaignData->application_end_date) ? \Carbon\Carbon::parse($campaignData->application_end_date)->format('jS F Y') : '';
        if(!empty($campaignData->campaignConnectedInfluencer)){
            foreach ( $campaignData->campaignConnectedInfluencer as $connectedInfluencer ) {
                $influencerData     = $connectedInfluencer->is_type == 1 ? User::whereId($connectedInfluencer->influencer_id)->first() : InfluencersRecords::whereId($connectedInfluencer->influencer_id)->first();
                $influencerName     = $connectedInfluencer->is_type == 1 ? $influencerData->name : $influencerData->nickname;
                $influencerImage    = $connectedInfluencer->is_type == 1 ? ($influencerData->profile ?? asset('/assets/media/avatars/blank.png')) : $influencerData->media_profile;
                $status             = ($connectedInfluencer->payment_status == "4" && !empty($connectedInfluencer->is_paid)) ? '<span class="badge text-bg-success">Paid</span>' : (($connectedInfluencer->offer_status == "2" && empty($connectedInfluencer->is_paid)) ? '<span class="badge text-bg-danger">Not Paid</span>' : '<span class="badge text-bg-secondary">N/A</span>');
                $response[] = array(
                    'id'                        => $campaignData->id,
                    'campaign_id'               => $connectedInfluencer->id,
                    'influencer_name'           => $influencerName,
                    'influencer_image'          => $influencerImage,
                    'amount'                    => !empty($connectedInfluencer->negotiation_price) ? $connectedInfluencer->negotiation_price : $campaignData->budget_for_each_influencer,
                    'campaign_duration'         => !empty($campaignData->application_end_date) ? $startDate." - ".$endDate : $startDate,
                    'status'                    => $status,
                    'detail'                    => route('brand.campaign.view',$campaignData->id),
                    'pdf_stream'                => route('pdf_stream',encrypt($connectedInfluencer->id)),
                );
            }
        }

        $response = array(
            'draw'                  => intval($draw),
            'iTotalRecords'         => $totalCampaigns,
            'iTotalDisplayRecords'  => $totalCampaignsWithFilter,
            'aaData'                => $response,
        );

        return response()->json($response);
    }

    public function pdfStream(Request $request, $id) {
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
        return $pdf->stream('brand_report_'. decrypt($id) .'.pdf');
    }
}
