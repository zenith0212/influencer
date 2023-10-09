<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap');

        * {
            margin: 0;
            padding: 0;
            color: #0B0B0B;
            box-sizing: border-box;
            font-size: 16px;
            line-height: normal;
            font-family: 'Poppins', sans-serif;
        }

        table {
            font-family: 'Poppins', sans-serif;
            border-collapse: collapse;
        }

        th {
            font-family: 'Poppins', sans-serif;
        }

        td {
            font-family: 'Poppins', sans-serif;
        }

        .invoice-details{
            width: 100%;
            overflow: hidden;
        }

        .invoice-details thead{
            border-radius: 10px 10px 0 0;
            overflow: hidden;
        }

        .invoice-details tbody{
            overflow: hidden;
        }

        .invoice-details th{
            border-left: 1px solid #FFFFFF;
            padding: 15px 16px;
            background-color: #225675;
            font-size: 16px;
            line-height: 1.4;
            color: #FFFFFF;
            white-space: nowrap;
            text-align: left;
        }

        .invoice-details td {
            padding: 10px 16px;
            box-shadow: none;
            font-weight: 400;
            font-size: 14px;
            line-height: 1.5;
            color: rgba(11, 11, 11, 0.7);
            border-bottom: 1px solid rgba(34, 86, 117, 0.1);
            border-left: 1px solid rgba(34, 86, 117, 0.1);
            text-align: left;
        }

        .invoice-details td:first-child{
            border-radius: 0 0 0 10px;
        }
        .invoice-details td:last-child{
            border-right: 1px solid rgba(34, 86, 117, 0.1);
            border-radius: 0 0 10px 0;
        }
    </style>
</head>

<body>
    <div style="width:100%; display:block; text-align:center; margin-bottom: 20px;">
        <img style="margin:auto;" src="https://eros.narola.online:551/pma4/nbj/data/topbrandmate-html/front-end/assets/images/logo.png" alt="">
    </div>
    <table class="wrapper" style="width:100%;" cellpadding="0" cellspacing="0"
        style="box-sizing: border-box ; color:#0B0B0B;  position: relative ; background-color: #fff ; margin: 0 ; padding: 0 ; ">
        <tbody>
            <tr>
                <td style="box-sizing: border-box ;  position: relative">
                    <table class="content" cellpadding="0" cellspacing="0"
                        style="box-sizing: border-box ;  position: relative ; margin: 0 ; padding: 0 ; width:100%;">
                        <tbody style="width:100%;">
                            <tr>
                                <td class="body"
                                    style="box-sizing: border-box ;  position: relative ; background-color: #fff ; border-bottom: 1px solid #fff ; border-top: 1px solid #fff ; margin: 0 ; padding: 0 ;  ; border: hidden">
                                    <table class="inner-body" cellpadding="0"
                                        cellspacing="0"
                                        style="box-sizing: border-box ;  position: relative ; background-color: #ffffff ; border-color: #e8e5ef ; border-radius: 5px ; border-width: 1px ; box-shadow: 0 2px 0 rgba(0 , 0 , 150 , 0.025) , 2px 4px 0 rgba(0 , 0 , 150 , 0.015) ; margin: 0 auto 30px; padding: 0 ; ">
                                        <tbody>
                                            <tr>
                                                <td class="content-cell"
                                                    style="box-sizing: border-box ;  position: relative ;  padding: 32px">
                                                    <h1
                                                        style="box-sizing: border-box ;  position: relative ; color: #0B0B0B ; font-size: 26px ; font-weight: bold ; margin-top: 0 ; margin-bottom: 20px; text-align: left">
                                                        Hello {{ $influencer_name }},</h1>

                                                    <p style="line-height:1.4; margin-bottom: 10px;">Congratulations, You have completed the campaign <b>{{ $campaign_name }}</b> with <b>{{ $brand_name }}</b> brand.</p>

                                                    <p style="line-height:1.4; margin-bottom: 30px;"> You can review your earnings using the below details.</p>

                                                    <table class="invoice-details">
                                                        <thead>
                                                            <tr>
                                                                <th>Campaign Name</th>
                                                                <th>Brand</th>
                                                                <th>Duration</th>
                                                                <th>Fees</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $campaign_name }}</td>
                                                                <td>{{ $brand_name }}</td>
                                                                <td>{{ $campaign_duration }}</td>
                                                                <td>$ {{ $final_price }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <p
                                                        style="box-sizing: border-box ;  margin-top: 30px; position: relative ; font-size: 14px ; line-height: 1.5em ;  text-align: left; font-weight: lighter;">
                                                        Thank you for chossing TopBrandMate marketplace platform. <br/><br/> Thanks a lot!
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
