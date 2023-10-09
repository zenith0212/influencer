@extends('frontend.index')
@section('meta_content')
    @foreach($content as $key=>$value)
        <meta {{ $value->keyword_en }} content="{{ $value->description_en }}"/>
    @endforeach
@endsection
@section('content')
  <main class="white-bg"  >  
        <section class="coming-soon-section bg-white section-top-space section-bottom-space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="coming-soon-content ">
                            <img src="{{asset('/assets/images/logo.png')}}" alt="">
                            <h1>Something <span>Awesome</span> is coming...</h1>
                            <p>Subscribe to be the first to know about all the events and get a discount on your first order!</p>
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control input-control" name="subscribe-mail" placeholder="Enter Your email">
                                    <button type="submit" class="primary-btn">Subscribe <i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
