<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" class=
            "navbar-toggle collapsed" data-target="#navbar" data-toggle=
                    "collapse" type="button"><span class="sr-only">Toggle
            navigation</span> <span class="icon-bar"></span> <span class=
                                                                   "icon-bar"></span> <span class="icon-bar"></span></button>


            <a class="navbar-brand" href="{{url('/')}}" onclick='location.href="{{url('/')}}";'>
                <img src="{{asset( app_settings()->logo ?? 'staticpage/assets/images/logo-text.png')}}" alt="homepage" class="light-logo" />
            </a>
            {{--<span class="slogan">App Landing Page</span>--}}
            <!-- Logo end -->

        </div>
        <div class="navbar-collapse collapse" id="navbar">

            <div class="navbar-right">

                @if($lang == 'ar')
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{url('/')}}#section-1-1" @if(!Request::is('/')) onclick='location.href="{{url('/')}}#section-1-1";' @endif>الرئيسية</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}#section-1-2" @if(!Request::is('/')) onclick='location.href="{{url('/')}}#section-1-2";' @endif>كيف يعمل</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}#section-1-3" @if(!Request::is('/')) onclick='location.href="{{url('/')}}#section-1-3";' @endif>مميزاتنا</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}#section-1-7" @if(!Request::is('/')) onclick='location.href="{{url('/')}}#section-1-7";' @endif>شاشات التطبيق</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}#section-1-12" @if(!Request::is('/')) onclick='location.href="{{url('/')}}#section-1-12";' @endif>تواصل معنا</a>
                        </li>

                    </ul>
                @else
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{url('/')}}#section-1-1" @if(!Request::is('/')) onclick='location.href="{{url('/')}}#section-1-1";' @endif>Home</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}#section-1-2" @if(!Request::is('/')) onclick='location.href="{{url('/')}}#section-1-2";' @endif>How It Works</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}#section-1-3" @if(!Request::is('/')) onclick='location.href="{{url('/')}}#section-1-3";' @endif>Our Advantages</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}#section-1-7" @if(!Request::is('/')) onclick='location.href="{{url('/')}}#section-1-7";' @endif>Screenshots</a>
                        </li>
                        <li>
                            <a href="{{url('/')}}#section-1-12" @if(!Request::is('/')) onclick='location.href="{{url('/')}}#section-1-12";' @endif>Contact Us</a>
                        </li>

                    </ul>
                @endif

                <!-- Menu end -->

                <!-- Social Icons -->
                <ul class="nav navbar-nav social">
                    @isset(app_settings()->facebook)
                    <li><a href="{{app_settings()->facebook}}" class="external"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    @endisset
                    @isset(app_settings()->twitter)
                    <li><a href="{{app_settings()->twitter}}" class="external"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    @endisset

                    @if($lang == 'ar')
                        <li><a href="{{url('lang/en')}}" class="external">EN</a></li>
                    @else
                        <li><a href="{{url('lang/ar')}}" class="external">AR</a></li>
                    @endif
                        <li class="joinus">
                            <a href="{{url('applications')}}" onclick='location.href="{{url('applications')}}";'>
                                @if($lang == 'ar')
                                    إنضم كحاضنة
                                @else
                                    Join babysitter
                                @endif
                            </a>
                        </li>
                </ul>

            </div>

        </div><!--/.nav-collapse -->
    </div>
</nav>
