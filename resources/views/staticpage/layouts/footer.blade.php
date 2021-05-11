<footer id="footer-1" class="footer">
    <div class="container">

        <!-- footer menu -->
        @if($lang == 'ar')
            <ul class="footer-menu">
                <li>
                    <a href="{{url('/')}}#section-1-1">الرئيسية</a>
                </li>
                <li>
                    <a href="{{url('/')}}#section-1-2">كيف يعمل</a>
                </li>
                <li>
                    <a href="{{url('/')}}#section-1-3">مميزاتنا</a>
                </li>
                <li>
                    <a href="{{url('/')}}#section-1-7">شاشات التطبيق</a>
                </li>
                <li>
                    <a href="{{url('/')}}#section-1-12">تواصل معنا</a>
                </li>
                <li>
                    <a href="{{url('applications')}}">إنضم كحاضنة</a>
                </li>
                @if(!empty(app_privacy()))
                    <li>
                        <a href="{{url('pages/' . app_privacy()->translate('ar')->slug)}}">{{app_privacy()->translate('ar')->title}}</a>
                    </li>
                @endif
                <li>
                    <a href="{{url('lang/en')}}">English</a>
                </li>

            </ul>
        @else
            <ul class="footer-menu">
                <li>
                    <a href="{{url('/')}}#section-1-1">Home</a>
                </li>
                <li>
                    <a href="{{url('/')}}#section-1-2">How It Works</a>
                </li>
                <li>
                    <a href="{{url('/')}}#section-1-3">Our Advantages</a>
                </li>
                <li>
                    <a href="{{url('/')}}#section-1-7">Screenshots</a>
                </li>
                <li>
                    <a href="{{url('/')}}#section-1-12">Contact Us</a>
                </li>
                <li>
                    <a href="{{url('applications')}}">Join babysitter</a>
                </li>
                @if(!empty(app_privacy()))
                    <li>
                        <a href="{{url('pages/' . app_privacy()->translate('en')->slug)}}">{{app_privacy()->translate('en')->title}}</a>
                    </li>
                @endif
                <li>
                    <a href="{{url('lang/ar')}}">العربية</a>
                </li>
            </ul>
    @endif
        <!-- copyright text -->
        <span class="copyright">{{app_settings()->copyrights}} <br />
        {{--<a href="https://moltaqa.net">Alkayan elaseel - moltaqa tech</a>--}}
        </span>

        <!-- social icons -->
        <ul class="social-icons">
            @isset(app_settings()->facebook)
                <li><a href="{{app_settings()->facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            @endisset
            @isset(app_settings()->twitter)
                <li><a href="{{app_settings()->twitter}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            @endisset
            @isset(app_settings()->instagram)
                <li><a href="{{app_settings()->instagram}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            @endisset
            @isset(app_settings()->youtube)
                <li><a href="{{app_settings()->youtube}}"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
            @endisset
        </ul>

    </div>
</footer>
<!-- Section footer 1 end -->

<!-- SCRIPTS -->
<script type="text/javascript" src="{{asset('staticpage/assets/js/jquery-1.12.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('staticpage/assets/js/jquery.easing.min.js')}}"></script>
<script type="text/javascript" src="{{asset('staticpage/assets/js/jquery.single-page.min.js')}}"></script>
<script type="text/javascript" src="{{asset('staticpage/assets/js/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript" src="{{asset('staticpage/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('staticpage/assets/js/jquery.counterup.min.js')}}"></script>
<script type="text/javascript" src="{{asset('staticpage/assets/js/jquery.ajaxchimp.js')}}"></script>
<script type="text/javascript" src="{{asset('staticpage/assets/js/countdown.js')}}"></script>
<script type="text/javascript" src="{{asset('staticpage/assets/js/waypoints.min.js')}}"></script>
<script type="text/javascript" src="{{asset('staticpage/assets/js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{asset('staticpage/assets/js/scrollreveal.min.js')}}"></script>
<script type="text/javascript" src="{{asset('staticpage/assets/js/classie.js')}}"></script>
<script type="text/javascript" src="{{asset('staticpage/assets/js/custom.js')}}"></script>
@yield('scripts')
</body>
