<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ app_settings()->title ?? config('app.name') }} -  @yield('title')</title>
    <meta name="description" content="Pixa - App Landing Page Pack with Page builder">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset( app_settings()->logo ?? 'staticpage/assets/images/favicon.png')}}">

    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('staticpage/assets/bootstrap/css/bootstrap.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('staticpage/assets/css/font-awesome.min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('staticpage/assets/css/et-line.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('staticpage/assets/css/magnific-popup.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('staticpage/assets/css/slick.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('staticpage/assets/css/hover-min.css')}}" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('staticpage/assets/css/style.css')}}" type="text/css" media="all">
    @if($lang == 'ar')
        <link rel="stylesheet" href="{{asset('staticpage/assets/css/style-rtl.css')}}" type="text/css" media="all">
    @endif
    @yield('styles')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
