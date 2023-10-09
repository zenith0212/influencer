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
          @if(Session::has('message'))
            <div class="col-12 alert alert-success" role="alert">
                <h2>{{ Session::get('message') }}</h2>
            </div>
        @endif
        <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box ; color:#0B0B0B; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; background-color: #edf2f7 ; margin: 0 ; padding: 0 ; width: 100%"> 
            <tbody>
                <tr> 
                    <td align="center" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative"> 
                        <table class="content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; margin: 0 ; padding: 0 ; width: 100%"> 
                           
                            <tbody>
                                <tr> 
                                    <td class="header" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; padding: 25px 0 ; text-align: center"> <a href="https://www.mailinator.com/linker?linkid=9b4ff1f0-f917-49d0-99d3-439d1e821310" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0B0B0B ; font-size: 19px ; font-weight: bold ; text-decoration: none ; display: inline-block;" target="_other" rel="nofollow"> <img style="max-width: 210px;" src="https://eros.narola.online:551/pma4/nbj/data/topbrandmate-html/front-end/assets/images/logo.png" alt=""> </a> </td> 
                                </tr> 
                                
                                <tr> 
                                    <td class="body" width="100%" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; background-color: #edf2f7 ; border-bottom: 1px solid #edf2f7 ; border-top: 1px solid #edf2f7 ; margin: 0 ; padding: 0 ; width: 100% ; border: hidden"> 
                                        <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; background-color: #ffffff ; border-color: #e8e5ef ; border-radius: 5px ; border-width: 1px ; box-shadow: 0 2px 0 rgba(0 , 0 , 150 , 0.025) , 2px 4px 0 rgba(0 , 0 , 150 , 0.015) ; margin: 0 auto 30px; padding: 0 ; width: 570px"> 
                                            <thead>
                                                <tr>
                                                    <th style="border-radius: 5px; overflow: hidden;">
                                                        <img src="{{ $campaigns->thumbnail_image }}" style="width: 100%;" alt="">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr> 
                                                    <td class="content-cell" style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; max-width: 100vw ; padding: 32px"> 
                                                        <h1 style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0B0B0B ; font-size: 24px ; font-weight: bold ; margin-top: 0 ; margin-bottom: 15px; text-align: left">{{ $campaigns->name_en }}</h1> 
                                                        <table>
                                                            <tr>
                                                            <td style="margin-right: 10px;">
                                                                    <p style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0B0B0B ; font-size: 18px ; margin-top: 0 ; margin-bottom: 10px; margin-right: 20px; text-align: left; display: block;">{{ $campaigns->description_en }}</p>
                                                                  
                                                                </td>
                                                            </tr>
                                                         
                                                        </table>
                                                        <br/>
                                                        <table>
                                                            <tr>
                                                                <td style="margin-right: 10px;">
                                                                    <b style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0B0B0B ; font-size: 20px ; font-weight: bold ; margin-top: 0 ; margin-bottom: 10px; margin-right: 20px; text-align: left; display: block;">${{ $campaigns->max_price }}</b>
                                                                    <p style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0b0b0bdb ; font-size: 16px ; margin-top: 0 ; margin-bottom: 15px; text-align: left; margin-right: 20px;">Payable Amount</p>
                                                                </td>
                                                                <td style="margin-right: 10px;">
                                                                    <b style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0B0B0B ; font-size: 20px ; font-weight: bold ; margin-top: 0 ; margin-bottom: 10px; margin-right: 20px; text-align: left; display: block;">12/12/2021</b>
                                                                    <p style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0b0b0bdb ; font-size: 16px ; margin-top: 0 ; margin-bottom: 15px; text-align: left; margin-right: 20px;">Starting From </p>
                                                                </td>
                                                                <td style="margin-right: 10px;">
                                                                    <b style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0B0B0B ; font-size: 20px ; font-weight: bold ; margin-top: 0 ; margin-bottom: 10px; margin-right: 20px; text-align: left; display: block;">$1000</b>
                                                                    <p style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; color: #0b0b0bdb ; font-size: 16px ; margin-top: 0 ; margin-bottom: 15px; text-align: left; margin-right: 20px;">Total Amount</p>
                                                                </td>
                                                              
                                                            </tr>
                                                        </table>
                                                    
                                                        <p style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; font-size: 16px ; line-height: 1.5em ; margin-top: 0 ; margin-bottom: 25px;  text-align: left">
                                                        <form method="post" action="{{ url('save-response') }}/{{ $id }}">
                                                            @csrf
                                                            <textarea id="response" class="form-control" name="response" placeholder="Your Response" required></textarea>
                                                            <input type="hidden" name="influencer_id" value="{{ $influencer_id }}"/>
                                                            <input type="hidden" name="id" value="{{$id}}">
                                                            <br/>
                                                            <input type="submit" class="btn primary-btn me-5" name="submit" value="Submit"/>
                        
                                                        </form> 
                                                        </p> <p style="box-sizing: border-box ; font-family: blinkmacsystemfont , segoe ui , roboto , helvetica , arial , sans-serif , apple color emoji , segoe ui emoji , segoe ui symbol ; position: relative ; font-size: 16px ; line-height: 1.5em ; margin-top: 0 ; text-align: left">Regards,<br> Influencer Marketing</p>  
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