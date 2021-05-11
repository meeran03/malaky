
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> الموقع في الصيانة {{ config('app.name', 'Laravel') }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset( app_settings()->logo ?? 'adminpanel/assets/images/favicon.png')}}">
    <!-- Custom CSS -->
    <link href="{{asset('adminpanel/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('adminpanel/dist/css/style-rtl.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        @media (max-width: 650px) {
            .error-box .error-title {
                font-size: 70px;
            }
        }
    </style>
</head>

<body>
<div class="main-wrapper">
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div class="error-box">
        <div class="error-body text-center">
            <h1 class="error-title text-danger">Maintenance</h1>
            <h3 class="text-uppercase error-subtitle">الموقع في الصيانة</h3>
            <p class="text-muted m-t-30 m-b-30">نأسف لعد اتاحة الموقع في الفترة الحالية ، لأعمال صيانة في الموقع ، عاود الزيارة مرة أخرى</p>
            <a href="" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">شرفتنا زيارتك</a>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="{{asset('adminpanel/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('adminpanel/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('adminpanel/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
</script>
</body>

</html>
