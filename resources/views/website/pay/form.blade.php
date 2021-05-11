@extends('staticpage.layouts.app')
@section('title')
    @if(Session::has('success'))
        {{ Session::get('success') }}
    @endif
    @if(Session::has('error'))
        {{ Session::get('error') }}
    @endif
@endsection
@section('styles')
@endsection
@section('content')
    <section id="section-1-1" class="hero hero-bg-1 layout-2">
        <div class="container">
            <div class="outer clearfix z-1 relative">
                    <a class="success-logo" href="{{url('/')}}">
                        <img src="{{asset( app_settings()->logo ?? 'staticpage/assets/images/logo-text.png')}}" alt="homepage" class="img-fluid"/>
                    </a>
                <form action="{{url('/pay/result?user_id='.$user_id.'&package_id='.$package_id.'&transaction_id='.$transaction_id.'&type='.$type)}}" class="paymentWidgets" data-brands="@if($type=='visa') VISA MASTER @else MADA @endif"></form>

            </div>
        </div>
        <div class="overlay-light"></div>
    </section>
@endsection
@section('scripts')
    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$checkoutId}}"></script>
    <script>
        var wpwlOptions = {
            locale: "{{$lang}}",
            style:"card",
            paymentTarget:"_top"
        }
    </script>
@endsection
