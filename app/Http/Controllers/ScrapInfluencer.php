<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfluencersRecords;
use App\Models\InfluencerScrapDetails;
use DB;
use Illuminate\Support\Collection;

class ScrapInfluencer extends Controller
{
    //
    public function get_data(){
        // $keyword = $request['name'];
        ini_set('max_execution_time', -1);
        for($i=344;$i<=422;$i++)
        {
           
        $client = new \GuzzleHttp\Client();
        $endpoint = 'https://api.influencegrid.com/api/accounts?follower_count_min=11501&follower_count_max=15000&page='.$i;
        $publicKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuaW5mbHVlbmNlZ3JpZC5jb21cL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE2ODM4NjQxMTMsImV4cCI6MTY4Mzg3ODUxMywibmJmIjoxNjgzODY0MTEzLCJqdGkiOiJHeWZPbk14Q0RHZDR6a3o3Iiwic3ViIjo4MDEwLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.1zcW4JqZfFgsIzTEX8dr_2vDtqKSaag1Tyd2_IXy2Z8';

        $raw_response = $client->get($endpoint, [
            'headers' => [ 'Authorization' => 'Bearer ' . $publicKey ],
        ]);

        $response = json_decode($raw_response->getBody()->getContents(), true);
        $records = $response['data'];
        $res_msg = isset($response['message']);
        if($res_msg == "No query results for model [App\\Models\\SocialMedia\\TiktokAccount]."){
            return '';
        }
        foreach($records as $key=>$record){
            
            if($record['verified'] == true){
                $verified = '1';
            }
            if($record['verified'] == false){
                $verified = '0';
            }
                
            $get_mail = $record['channels'];

            $influencer_email ="";
            foreach($get_mail as $key=>$value){
                if($value['type'] == 'email'){
                    $influencer_email = $value['value'];
                }
            }
            $all = InfluencersRecords::where("nickname",$record['nickname'])->exists();
            if(!$all){
                $transactions= [
                    'account_id' => $record['id'],
                    'unique_id' => $record['unique_id'],
                    'nickname' => $record['nickname'],
                    'signature' => $record['signature'],
                    'verified' => $verified,
                    // 'gender' => $record['gender'],
                    'region' => $record['region'],  
                    'country' => $record['country'],
                    'language' => $record['language'],
                    'account_url' => $record['account_url'],
                    'link' => $record['link'],
                    'media_profile'=> $record['media']['medium'],
                    'follower_count' => $record['stats']['follower_count'],
                    'following_count' => $record['stats']['following_count'],
                    'like_count' => $record['stats']['like_count'],
                    'post_count' => $record['stats']['post_count'],
                    'average_like_count' => $record['stats']['average_like_count'],
                    'average_comment_count' => $record['stats']['average_comment_count'],
                    'average_share_count' => $record['stats']['average_share_count'],
                    'average_play_count' => $record['stats']['average_play_count'],
                    'average_engagement_rate' => $record['stats']['average_engagement_rate'],
                    'average_enagement' => $record['stats']['average_engagement'],
                    'amount_from' =>  isset($record['stats']['post_price']['amount_from']) ? $record['stats']['post_price']['amount_from']: null,
                    'amount_to' => isset($record['stats']['post_price']['amount_to']) ? $record['stats']['post_price']['amount_to']: null,
                    'currency' => isset($record['stats']['post_price']['currency']) ? $record['stats']['post_price']['currency']: null,
                    'email' => isset($influencer_email) ? $influencer_email : null,
                    'hastags' => isset($record['hashtags']) ? implode(',',$record['hashtags']) : null,
                    'email_link' => isset($record['channels']) ? json_encode($record['channels']) : null,
                    'response_data' => json_encode($record)
                ];
                $res = InfluencersRecords::create($transactions);
            
                /* add details in influencer scarping table */
                $influencer_id = InfluencersRecords::whereId($res->id)->first();
                $endpoint_scarp = 'https://api.influencegrid.com/api/accounts/'.$influencer_id->account_id.'/posts';
                $raw_response = $client->get($endpoint_scarp, [
                    'headers' => [ 'Authorization' => 'Bearer ' . $publicKey ],
                ]);
                
                $response_data = json_decode($raw_response->getBody()->getContents(), true);
                $records_data = $response_data['data'];
                if(!empty($records_data)){
                    $collection = collect($records_data);
                    $chunk = $collection->take(2);
                        foreach($chunk as $key=>$value){
                                $insert_data = [
                                    'post_id'   =>  $value['post_id'],
                                    'influencer_record_id' => $res->id,
                                    'description'   =>  isset($value['description']) ? $value['description'] : null,
                                    'music_title'    => isset($value['music_title']) ? $value['music_title'] : null,
                                    'music_author_name'  => isset($value['music_author_name']) ? $value['music_author_name'] : null,
                                    'link'    => $value['link'],
                                    'profile'    => $value['media']['medium'],
                                    'like_count'    =>  $value['stats']['like_count'],
                                    'share_count'    =>  $value['stats']['share_count'],
                                    'comment_count'    =>  $value['stats']['comment_count'],
                                    'play_count'    =>  $value['stats']['play_count'],
                                    'hastags'   => isset($value['hashtags']) ? implode(',',$value['hashtags']) : null,
                                    'published_date'    => date("Y-m-d",strtotime($value['published_at'])),
                                    'json_response' => json_encode($value)
                                ];
                            $res_result = InfluencerScrapDetails::create($insert_data);
                            sleep(1);
                        }
                }
            }
        }
    }  
    }
}
