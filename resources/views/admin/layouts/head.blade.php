<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset( app_settings()->logo ?? 'adminpanel/assets/images/favicon.png')}}">
    <title> لوحة تحكم الموقع - @yield('title')</title>
    <link href="{{asset('adminpanel/assets/libs/flot/css/float-chart.css')}}" rel="stylesheet">
    <link href="{{asset('adminpanel/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('adminpanel/dist/css/style-rtl.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel/assets/libs/quill/dist/quill.snow.css') }}">
    @yield('styles')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
