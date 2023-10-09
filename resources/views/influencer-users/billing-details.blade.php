@extends('layouts.index')
@section('style')
    <style>
        .payment-card{
            max-width: 508px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            background: rgba(49, 49, 49, 0.15);
            margin: auto;
        }

        .payment-card .front-face{
            padding: 25px 20px;
            position: relative;
        }
        .payment-card .front-face .card-name h3{
            font-size: 24px;
            line-height: 1.4;
            margin-bottom: 20px;
        }
        .payment-card .front-face svg{
            height: 60px;
            width: 60px;
            margin-bottom: 15px;
        }
        .payment-card .front-face .number{
            font-weight: 500;
            letter-spacing: 3px;
            font-size: 24px;
            line-height: 1.4;
            text-shadow: 0 2px 1px #0a0a0a;
            font-family: "Orbitron", sans-serif;
            margin-bottom: 20px;
        }
        .payment-card .front-face .valid{
            display: inline-flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            font-weight: 400;
            font-size: 12px;
            letter-spacing: 2px;
        }
        .payment-card .front-face .cardHolder{
            font-weight: 400;
            font-size: 16px;
            letter-spacing: 2px;
            margin-bottom: 0;
        }
        .payment-card .card-icon{
            position: absolute;
            bottom: 20px;
            right: 40px;

        }
        .payment-card .card-icon i{
            font-size:  60px;
        }

        @media (max-width: 480px){
            .payment-card .front-face{
                padding: 10px
            }
            .payment-card .front-face .card-name h3{
                font-size: 20px;
                margin-bottom: 10px;
            }
            .payment-card .front-face .number{
                font-size: 18px;
                margin-bottom: 10px;
            }
            .payment-card .card-icon{
                bottom: 10px;
                right: 20px;
            }
            .payment-card .card-icon i{
                font-size:  30px;
            }
        }
    </style>
@endsection
@section('content')
<main>
    <div class="content">
        <div class="container-fluid">
            <div class="campaign">
                <h3>{{ $title }}</h3>

                <div class="row">
                    <div class="col-12">
                        <div class="payment-card">
                            <div class="front-face">
                                <div class="card-name">
                                    <h3 class="debit">Credit Card</h3>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><path fill="#FF9800" d="M5 35V13c0-2.2 1.8-4 4-4h30c2.2 0 4 1.8 4 4v22c0 2.2-1.8 4-4 4H9c-2.2 0-4-1.8-4-4z"/><path fill="#FFD54F" d="M43 21v-2H31c-1.1 0-2-.9-2-2s.9-2 2-2h1v-2h-1c-2.2 0-4 1.8-4 4s1.8 4 4 4h3v6h-3c-2.8 0-5 2.2-5 5s2.2 5 5 5h2v-2h-2c-1.7 0-3-1.3-3-3s1.3-3 3-3h12v-2h-7v-6h7zm-26 6h-3v-6h3c2.2 0 4-1.8 4-4s-1.8-4-4-4h-3v2h3c1.1 0 2 .9 2 2s-.9 2-2 2H5v2h7v6H5v2h12c1.7 0 3 1.3 3 3s-1.3 3-3 3h-2v2h2c2.8 0 5-2.2 5-5s-2.2-5-5-5z"/></svg>
                                <h4 class="number">XXXX XXXX XXXX {{ !empty($cardDetails['card_number']) ? $cardDetails['card_number'] : 'XXXX' }}</h4>
                                <h5 class="valid"><span>Valid thru</span><span>{{ !empty($cardDetails['card_expiry_month']) ? $cardDetails['card_expiry_month'] : "01" }}/{{ !empty($cardDetails['card_expiry_year']) ? $cardDetails['card_expiry_year'] : '24' }}</span></h5>
                                <h5 class="cardHolder">{{ !empty($cardDetails['card_holder_name']) ? ucfirst($cardDetails['card_holder_name']) : '' }}</h5>
                                <div class="card-icon">
                                    @if(!empty($cardDetails['card_type']) && $cardDetails['card_type'] == "Visa")
                                        <i class="fa-brands fa-cc-visa"></i>
                                    @else
                                        <i class="fa-brands fa-cc-mastercard"></i>
                                    @endif
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer></footer>
</main>
@endsection
