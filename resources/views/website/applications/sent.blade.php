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
    <style>

    </style>
@endsection
@section('content')
    <section id="section-1-1" class="hero hero-bg-1 layout-2">
        <div class="container">
            <div class="outer clearfix z-1 relative">
                    <a class="success-logo" href="{{url('/')}}">
                        <img src="{{asset( app_settings()->logo ?? 'staticpage/assets/images/logo-text.png')}}" alt="homepage" class="img-fluid"/>
                    </a>
                <h2 class="b20-1 text-center">
                    <span class="strong">
                        @if(Session::has('success'))
                            {{ Session::get('success') }}
                        @endif
                        @if(Session::has('error'))
                            {{ Session::get('error') }}
                        @endif
                    </span>
                </h2>
        </div>
        </div>
        <div class="overlay-light"></div>
    </section>
@endsection
