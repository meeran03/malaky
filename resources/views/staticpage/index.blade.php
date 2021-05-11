@extends('staticpage.layouts.app')
@section('content')
@if($staticpages[0]['is_active'] == 1)
@php
$transes = $staticpages[0]['transes'];
$found_key = array_search($lang, array_column($transes, 'locale'));
$sec = $transes[$found_key];
$images = explode(';',$sec['images']);
@endphp

<section id="section-1-1" class="hero hero-bg-1 layout-2">
    <div class="container">
        <!-- items outer -->
        <div class="outer clearfix z-1 relative">

            <div class="row flex">
                <!-- row -->

                <!-- phones image -->
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="phones">
                        <img src="{{asset($images[0])}}" alt="hero" />
                    </div>
                </div>

                <!-- call to action -->
                <div class="col-md-7 col-md-offset-1 col-sm-12 col-xs-12">

                    <div class="cta">

                        <!-- text -->
                        <h2 class="b20-1">
                            <span class="strong">
                                {{$sec['title']}}
                            </span>
                        </h2>
                        <p class="b20-2">
                            {!! $sec['content']!!}
                        </p>

                        <!-- buttons -->
                        <div class="buttons b20-3">
                            <a href="#" class="btn btn-default btn-download hvr-float-shadow">
                                <i class="fa fa-apple" aria-hidden="true"></i>
                                <span class="text">
                                    <span class="little">Download on the</span><br>App Store
                                </span>
                            </a>
                            <a href="#" class="btn btn-default btn-download hvr-float-shadow">
                                <i class="fa fa-android" aria-hidden="true"></i>
                                <span class="text">
                                    <span class="little">Get it on</span><br>Google Play
                                </span>
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- light overlay -->
    <div class="overlay-light"></div>

</section>
@endif

@if($staticpages[1]['is_active'] == 1)
@php
$transes = $staticpages[1]['transes'];
$found_key = array_search($lang, array_column($transes, 'locale'));
$sec = $transes[$found_key];
$images = explode(';',$sec['images']);
@endphp
<section id="section-1-2" class="work-process colored">
    <div class="container">

        <div class="section-header text-center">
            <h2>
                {{$sec['title']}}
            </h2>
            <p>
                {{$sec['excerpt']}}
            </p>
        </div>

        <div class="row">
            {!! $sec['content']!!}
        </div>
    </div>
</section>
@endif

@if($staticpages[2]['is_active'] == 1)
@php
$transes = $staticpages[2]['transes'];
$found_key = array_search($lang, array_column($transes, 'locale'));
$sec = $transes[$found_key];
$images = explode(';',$sec['images']);
@endphp
<section id="section-1-3" class="describe-1">
    <div class="container">
        <div class="row flex">
            <!-- Row begin -->
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="image">
                    <img src="{{asset($images[0])}}" alt="describe" class="b20-1" />
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <h2 class="light">{{$sec['title']}}</h2>
                <p>{{$sec['excerpt']}}</p>
                {!! $sec['content']!!}
            </div>
        </div>
    </div>
</section>
@endif
@if($staticpages[3]['is_active'] == 1)
@php
$transes = $staticpages[3]['transes'];
$found_key = array_search($lang, array_column($transes, 'locale'));
$sec = $transes[$found_key];
$images = explode(';',$sec['images']);
@endphp
<section id="section-1-7" class="screenshots">
    <div class="container">

        <!-- section header -->
        <div class="section-header text-center">
            <h2 class="light">{{$sec['title']}}</h2>
            <p>{{$sec['excerpt']}}</p>
        </div>

        <!-- wrapper -->
        <div class="screenshots-01-wrap">
            @foreach($images as $one)
            <div class="item">
                <img src="{{asset($one)}}" alt="screenshot" />
            </div>
            @endforeach
        </div>

    </div>
</section>
@endif
@if($staticpages[4]['is_active'] == 1)
@php
$transes = $staticpages[4]['transes'];
$found_key = array_search($lang, array_column($transes, 'locale'));
$sec = $transes[$found_key];
$images = explode(';',$sec['images']);
@endphp
<section id="section-1-12" class="download-cta colored">
    <div class="container container-800 z-1 relative">
        <div class="cta text-center">
            <h2 class="light">{{$sec['title']}}</h2>
            <p>{{$sec['excerpt']}}</p>
            <ul class="contact-list">
                @isset(app_settings()->email)
                <li><a href="mailto:{{app_settings()->email}}"><i class="fa fa-envelope" aria-hidden="true"></i> {{app_settings()->email}}</a></li>
                @endisset
                @isset(app_settings()->phone)
                <li><a href="tel:{{app_settings()->phone}}"><i class="fa fa-phone" aria-hidden="true"></i> {{app_settings()->phone}}</a></li>
                @endisset
                @isset(app_settings()->phone2)
                <li><a href="tel:{{app_settings()->phone2}}"><i class="fa fa-phone" aria-hidden="true"></i> {{app_settings()->phone2}}</a></li>
                @endisset
            </ul>

            <!-- buttons -->
            <div class="cta-buttons">
                <a href="#" class="btn btn-primary btn-download hvr-float-shadow">
                    <i class="fa fa-apple" aria-hidden="true"></i>
                    <span class="text">
                        <span class="little">Download on the</span><br>App Store
                    </span>
                </a>
                <a href="#" class="btn btn-primary btn-download hvr-float-shadow">
                    <i class="fa fa-android" aria-hidden="true"></i>
                    <span class="text">
                        <span class="little">Get it on</span><br>Google Play
                    </span>
                </a>
            </div>

        </div>

    </div>
</section>
@endif
@endsection
