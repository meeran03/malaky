<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset( app_settings()->logo ?? 'adminpanel/assets/images/favicon.png')}}">
        <title>{{ app_settings()->translate('ar')->title ?? config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #343a40;
                color: #fff;
                font-family: 'Cairo', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #ffb848;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .light-logo{
                margin: 0 auto 30px;
                max-height: 80px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">

                </div>
            @endif

            <div class="content">
                <img src="{{asset( app_settings()->logo ?? 'adminpanel/assets/images/logo-text.png')}}" alt="homepage" class="light-logo" />
                <div class="title m-b-md">

                </div>

                <div class="links">
                    @auth
                        <a href="{{ url('/') }}">الرئيسية</a>
                        <a href="{{ url('/admin') }}">لوحة التحكم</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            تسجيل خروج
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('admin.login') }}">تسجيل الدخول</a>

                    <!-- @if (Route::has('register'))
                        <a href="{{ route('register') }}">تسجيل جديد</a>
                        @endif -->
                    @endauth
                    </div>
                    <div class="links">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-styled-left">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if(Session::has('error'))
                        <div class="alert alert-danger alert-styled-left d-block">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                            {{ Session::get('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
