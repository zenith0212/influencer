<?php

use Illuminate\Auth\Events\Registered;
use App\Models\BrandActivityLogs;
use App\Models\InfluencerActivityLogs;
/**--------------------------------------------------------------
 * @Created     : NPP ( 16-03-2023 )
 * @Updated     : NPP ( 16-03-2023 )
 * @PC No.      : C100-90
 * @Description : Side Menubar show active
 * --------------------------------------------------------------
 */

if(!function_exists('is_active_menu')){
    function is_active_menu($url_name, $className = 'active', $params = '') {
        $name = request()->route()->getName();
        $url_params = request()->get('id');
        if (is_array($url_name)) {
            return in_array($name, $url_name) ? $className : '';
        } else {
            if ($name == $url_name) {
                if (isset($url_params)) {
                    if ($url_params == $params) {
                        return $className;
                    } else {
                        return '';
                    }
                }
                return $className;
            }else {
                return '';
            }
            // return ( $name == $url_name ) ? $className : '';
        }
        return null;
    }
}


function intWithStyle($n)
{
    if ($n < 1000) return $n;
    $suffix = ['','k','M','G','T','P','E','Z','Y'];
    $power = floor(log($n, 1000));
    return round($n/(1000**$power),1,PHP_ROUND_HALF_EVEN).$suffix[$power];
};

function getFans($input)
    {
        $input = number_format($input);
        $input_count = substr_count($input, ',');
        if ($input_count != '0') {
            if ($input_count == '1') {
                return substr($input, 0, -4) . 'k';
            } else if ($input_count == '2') {
                return substr($input, 0, -8) . 'm';
            } else if ($input_count == '3') {
                return substr($input, 0, -12) . 'b';
            } else {
                return;
            }
        } else {
            return $input;
        }
    }

    /* Activity log for admin side */
    function add_admin_log($title,$message,$role,$user){
        activity($title)
            ->performedOn($role)
            ->causedBy($user)
            ->log($message);
        event(new Registered($user,$role));
    }

    /* Activity log function for brand/influencer side */
    function add_activity_logs($logname,$msg,$type,$id){
        if($type == "Brand"){
            $brand_activity = BrandActivityLogs::where("description",$msg)->exists();
            if(!$brand_activity){
                BrandActivityLogs::create([
                    'log_name' => $logname,
                    'description' => $msg,
                    'brand_id' => $id
                ]);
            }
        }else {
            $influencer_activity = InfluencerActivityLogs::where("description",$msg)->exists();
            if(!$influencer_activity){
                InfluencerActivityLogs::create([
                    'log_name' => $logname,
                    'description' => $msg,
                    'influencer_id' => $id
                ]);
            }
        }
    }

?>