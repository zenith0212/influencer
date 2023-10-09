<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign Details</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

   <body marginheight="0">
        <style>         
            *{
              margin: 0;
              padding: 0;
              color:#0B0B0B;
            }
          
         </style>
        <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box ; color:#0B0B0B; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; background-color: #edf2f7 ; margin: 0 ; padding: 0 ; width: 100%"> 
            <tbody>
                <tr> 
                    <td align="center" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative"> 
                        <table class="content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; margin: 0 ; padding: 0 ; width: 100%"> 
                           
                            <tbody>
                                <tr> 
                                   <td class="header" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; padding: 25px 0 ; text-align: center"> <a href="#" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0B0B0B ; font-size: 19px ; font-weight: bold ; text-decoration: none ; display: inline-block;" target="_other" rel="nofollow"> <img style="max-width: 210px;" src="{{ asset('assets/media/logos/topbrandmate.png') }}" alt=""> </a> </td>
                                </tr> 
                                
                                <tr> 
                                    <td class="body" width="100%" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; background-color: #edf2f7 ; border-bottom: 1px solid #edf2f7 ; border-top: 1px solid #edf2f7 ; margin: 0 ; padding: 0 ; width: 100% ; border: hidden"> 
                                        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; background-color: #ffffff ; border-color: #e8e5ef ; border-radius: 5px ; border-width: 1px ; box-shadow: 0 2px 0 rgba(0 , 0 , 150 , 0.025) , 2px 4px 0 rgba(0 , 0 , 150 , 0.015) ; margin: 0 auto 30px; padding: 0 ; width: 570px"> 
                                            <thead>
                                                <tr>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr> 
                                                    <td class="content-cell" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; max-width: 100vw ; padding: 32px"> 
                                                        <h1 style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0B0B0B ; font-size: 24px ; font-weight: bold ; margin-top: 0 ; margin-bottom: 15px; text-align: left"> Hello  {{$brand_details->title_en}}, </h1> 
                                                        <table>
                                                            <tr>
                                                                <td style="margin-right: 10px;">
                                                                    <b style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0B0B0B ; font-size: 20px ; font-weight: bold ; margin-top: 0 ; margin-bottom: 10px; margin-right: 20px; text-align: left; display: block;">
                                                                      
                                                                    </b>
                                                                    <p style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0b0b0bdb ; font-size: 16px ; margin-top: 0 ; margin-bottom: 15px; text-align: left; margin-right: 20px;">
                                                                    @if($identifier == "direct-apply")
                                                                    
                                                                        I have looked over your campaign, "{{$campaigns->name_en }}" and I have been entrusted with it. See my profile for more information. <br><br>

                                                                    Reason for apply:             
                                                                    {{ 
                                                                        $apply_reason_en
                                                                    }}

                                                                    @elseif($identifier == 'apply')

                                                                    I have looked over your campaign, "{{$campaigns->name_en }}" and I have been entrusted with it. <br><br>

                                                                    Reason for acceptence:             
                                                                    {{ 
                                                                       $accept_reason_en
                                                                    }}

                                                                    @elseif($identifier == 'reject')

                                                                        I apologize for not being able to join your campaign, {{ $campaigns->name_en}}, after reviewing it. <br><br>

                                                                    Reason for rejection:             
                                                                    {{ 
                                                                        $reject_reason_en
                                                                    }}
                                                                    @endif
                                                                    </p>
                                                                </td>
                                                               </tr>
                                                        </table>
                                                        <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; margin: 30px auto ; padding: 0 ; text-align: center ; width: 100%"> 
                                                            <tbody>
                                                                <tr> 
                                                                <td align="center" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative"> 
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative"> 
                                                                <tbody>
                                                                    <tr> 
                                                                    <td align="center" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative"> 
                                                                    <table border="0" cellpadding="0" cellspacing="0" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative"> 
                                                                    <tbody>
                                                                        <tr> 
                                                                    @if($identifier == 'direct-apply')
                                                                       <td style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative"> <a href="  {{ route('guest_influencer_details', $user_id) }}" class="button button-primary" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; border-radius: 4px ; color: #fff ; display: inline-block ; overflow: hidden ; text-decoration: none ; background-color: #F26546 ; border-bottom: 8px solid #F26546 ; border-left: 18px solid #F26546 ; border-right: 18px solid #F26546 ; border-top: 8px solid #F26546" rel="nofollow">View Profile</a> </td> 
                                                                       @else
                                                                    @endif
                                                                        </tr> 
                                                                    </tbody>
                                                                    </table> </td> 
                                                                    </tr> 
                                                                </tbody>
                                                                </table> </td> 
                                                                </tr> 
                                                            </tbody>
                                                        </table> 
                                                        <p style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; font-size: 16px ; line-height: 1.5em ; margin-top: 0 ; margin-bottom: 25px;  text-align: left"></p> <p style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; font-size: 16px ; line-height: 1.5em ; margin-top: 0 ; text-align: left">Regards,<br> Influencer Marketing</p>  
                                                    </td> 
                                                </tr> 
                                            </tbody>
                                        </table>
                                    </td> 
                                </tr> 

                                <tr>
                                    <td class="body" width="100%" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; background-color: #edf2f7 ; border-bottom: 1px solid #edf2f7 ; border-top: 1px solid #edf2f7 ; margin: 0 ; padding: 0 ; width: 100% ; border: hidden"> 
                                        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; background-color: #F26546 ; border-color: #e8e5ef ; border-radius: 5px ; border-width: 1px ; box-shadow: 0 2px 0 rgba(0 , 0 , 150 , 0.025) , 2px 4px 0 rgba(0 , 0 , 150 , 0.015) ; margin: 0 auto ; padding: 0 ; width: 570px"> 
                                            
                                            <tbody>
                                                <tr>
                                                    <td class="content-cell" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; text-align: center; max-width: 100vw ; padding: 32px">   
                                                        <h2 style="font-size: 20px; font-weight: 400; color: #ffffff; margin: 0 auto 10px;">Need more help?</h2>
                                                        <p style="margin: 0;"><a href="#" target="_blank" style="color: rgba(255 , 255,  255, 0.55);">We’re here to help you out</a></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table> 
                                    </td>   
                                </tr>

                                <tr> 
                                <td style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative"> 
                                <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; margin: 0 auto ; padding: 0 ; text-align: center ; width: 570px"> 
                                <tbody>
                                    <tr> 
                                    <td class="content-cell" align="center" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; max-width: 100vw ; padding: 32px"> <p style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; line-height: 1.5em ; margin-top: 0 ; color: #b0adc5 ; font-size: 12px ; text-align: center">© 2023 Influencer Marketing. All rights reserved.</p> </td> 
                                    </tr> 
                                </tbody>
                                </table> </td> 
                                </tr> 
                            </tbody>
                        </table>
                     </td> 
                </tr> 
            </tbody>
        </table>  
     
        <br><br><br><br>

</body>
</html>