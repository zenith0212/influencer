@extends('layouts.index')
@section('content')

<!-- <div class='row'>
    <div class='col d-flex align-items-center justify-content-center'>
        <p class='mt-2 text-center'><strong>Subscribe {{ $plans->name_en }} Plan:</strong></p>
    </div>
</div> -->

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
<div class="twelve">
    <h1>Subscribe {{ $plans->name_en }} Plan:</h1>
</div>
    <div class="row">
        <aside class="col-sm-6 offset-3">
            <article class="card">
                <div class="card-body p-5">
                    <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
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
                            <form role="form" method="POST" id="paymentForm" action="{{ url('/payment')}}"  data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                                @csrf
                                <input type="hidden" name="plan_id" value="{{ $plan_id }}"/>
                                <div class="form-group">
                                    <label for="username">Full name (on the card)</label>
                                    <input type="text" class="form-control" name="fullName" id="fullName" placeholder="Full Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="cardNumber">Card number</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cardNumber"  id="cardNumber" placeholder="Card Number"  maxlength="16" required>
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
                                            <div class="input-group">
                                                <select class="form-control" name="month" id="month">
                                                    <option value="">MM</option>
                                                    @foreach(range(1, 12) as $month)
                                                        <option value="{{$month}}">{{$month}}</option>
                                                    @endforeach
                                                </select>
                                                <select class="form-control" name="year" id="year">
                                                    <option value="">YYYY</option>
                                                    @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                        <option value="{{$year}}">{{$year}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label data-toggle="tooltip" title=""
                                                data-original-title="3 digits code on back side of the card">CVV <i
                                                class="fa fa-question-circle"></i></label>
                                            <input type="number" min="1" class="form-control" placeholder="CVV" id="cvv" name="cvv" required>
                                        </div>
                                    </div>
                                </div>
                                <button class="subscribe btn btn-block" type="submit"> Pay ${{ $plans->amount }} </button>
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
            if(element.attr("name") == "cardNumber") {
                error.appendTo( element.next("div") );
            } else {
                error.insertAfter(element);
            }
        }
    });
    </script>
@endsection