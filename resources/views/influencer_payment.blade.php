@extends('layouts.index')
@section('style')
    <style>
        .input-group input{
            border-radius: 20px !important;

        }
        .input-group .input-group-append .input-group-text{
            gap: 10px;
            padding: 20px 30px;
            border-radius: 20px !important;
        }

        .input-group .input-group-append i {
            font-size: 20px;
        }



        @media screen and (max-width:767px){
            .input-group .input-group-append .input-group-text{
                gap: 10px;
                padding: 16px 20px;
                border-radius: 20px !important;
            }

            .input-group .input-group-append i {
                font-size: 16px;
            }

            .form-group .form-select{
                padding: 12px 15px;
                font-size: 14px;
            }
        }
    </style>
@endsection
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<main class="main">
<div class="twelve text-center mb-5">
    <h1>Connect Bank Account</h1>
</div>
    <div class="row justify-content-center">
        <aside class="col-md-10 col-lg-8 col-xxl-6">
            <article class="card">
                <div class="card-body p-5">
                    <ul class="nav bg-light nav-pills rounded nav-fill mb-5" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
                            <i class="fa fa-credit-card"></i> Credit Card</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-tab-card">
                            @foreach (['danger', 'success'] as $status)
                                @if(Session::has($status))
                                    <p class="alert alert-{{$status}}">{{ Session::get($status) }}</p>
                                @endif
                            @endforeach
                            <form role="form" method="POST" id="paymentForm" action="{{ route('connect_influencer_stripe_account') }}"  data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Full name (on the card)</label>
                                    <input type="text" class="form-control" name="fullName" id="fullName" placeholder="Full Name" value="{{ \Auth::user()->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="cardNumber">Card number</label>
                                    <div class="input-group justify-content-between flex-sm-nowrap">
                                        <div class="d-block w-100 w-sm-75 me-sm-4 mb-4 mb-sm-0">
                                            <input type="text" class="form-control" name="cardNumber"  id="cardNumber" placeholder="Card Number"  maxlength="16" required>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text text-muted">
                                            <i class="fab fa-cc-visa fa-lg pr-1"></i>
                                            <i class="fab fa-cc-amex fa-lg pr-1"></i>
                                            <i class="fab fa-cc-mastercard fa-lg"></i>
                                            </span>
                                        </div>
                                        @error('cardNumber')
                                        <p class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label><span class="hidden-xs">Expiration</span> </label>
                                            <div class="input-group row">
                                                <div class="col-md-6 mb-4 mb-md-0">
                                                    <select class="form-select" name="month" id="month">
                                                        <option value="">MM</option>
                                                        @foreach(range(1, 12) as $month)
                                                            <option value="{{$month}}">{{$month}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-4 mb-md-0">
                                                    <select class="form-select" name="year" id="year">
                                                        <option value="">YYYY</option>
                                                        @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                            <option value="{{$year}}">{{$year}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
                                            <input type="number" min="1" placeholder="..." class="form-control" placeholder="CVV" id="cvv" name="cvv" required>
                                        </div>
                                    </div>
                                </div>
                                @if(!empty(\Auth::user()->stripe_customer_id))
                                    <button class="subscribe btn btn-block" type="submit" disabled> Connected </button>
                                @else
                                    <button class="subscribe btn btn-block" type="submit"> Connect </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </aside>
    </div>
</main>
@endsection

@section('script')
<script src="{{ asset('assets/js/jquery-validate.min.js') }}"></script>
<script>
$("#paymentForm").validate({
        rules: {
            'fullName': {
                required: true
            },
            'cardNumber': {
                required: true,
            },
            'month': {
                required: true
            },
            'year': {
                required: true
            },
            'cvv': {
                required: true
            },
        },
        messages: {
            'fullName': {
                required: "Please enter fullname"
            },
            'cardNumber': {
                required: "Please enter card number"
            },
            'month': {
                required: "Please select month"
            },
            'year': {
                required: "Please select year"
            },
            'cvv': {
                required: "Please enter cvv"
            },
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });
    </script>
@endsection
