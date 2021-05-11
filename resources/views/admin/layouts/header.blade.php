@include('admin.layouts.head')

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="{{url('/admin')}}">
                        <!-- Logo icon -->
                        {{--<b class="logo-icon p-l-10">--}}
                        {{--<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->--}}
                        {{--<!-- Dark Logo icon -->--}}
                        {{--<img src="{{asset('adminpanel/assets/images/logo-icon.png')}}" alt="homepage" class="light-logo" />--}}

                        {{--</b>--}}
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{asset( app_settings()->logo ?? 'adminpanel/assets/images/logo-text.png')}}" alt="homepage" class="light-logo" />

                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <!-- <img src="{{asset('adminpanel/assets/images/logo-text.png" alt="homepage" class="light-logo" /> ')}}-->

                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left ml-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-block">إنشاء جديد <i class="fa fa-angle-down"></i></span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(admin_can_any('cities'))
                                    <a class="dropdown-item" href="{{route('admin.cities.create')}}">أضف مدينة</a>
                                @endif
                                @if(admin_can_any('users'))
                                    <a class="dropdown-item" href="{{route('admin.users.create')}}">أضف عضو</a>
                                @endif
                                @if(admin_can_any('roles'))
                                    <a class="dropdown-item" href="{{route('admin.roles.create')}}">أضف دور</a>
                                @endif
                                @if(admin_can_any('packages'))
                                    <a class="dropdown-item" href="{{route('admin.packages.create')}}">أضف باقة</a>
                                @endif
                                @if(admin_can_any('coupons'))
                                    <a class="dropdown-item" href="{{route('admin.coupons.create')}}">أضف كوبون</a>
                                @endif
                                @if(admin_can_any('pages'))
                                    <a class="dropdown-item" href="{{route('admin.pages.create')}}">أضف صفحة</a>
                                @endif
                                @if(admin_can_any('sliders'))
                                    <a class="dropdown-item" href="{{route('admin.sliders.create')}}">أضف سلايدر</a>
                                @endif
                                @if(admin_can_any('conditions'))
                                    <a class="dropdown-item" href="{{route('admin.conditions.create')}}">أضف شرط</a>
                                @endif
                                @if(admin_can_any('services'))
                                    <a class="dropdown-item" href="{{route('admin.services.create')}}">أضف خدمة</a>
                                @endif

                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute" action="{{url('admin/search')}}" method="post">
                                @csrf
                                <input type="text" class="form-control" placeholder="إبحث عن عضو" name="search"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(Auth::user()->unreadNotifications()->count())
                                    <span class="badge badge-pill badge-danger">{{ Auth::user()->unreadNotifications()->count() }}</span>
                                    <i class="mdi mdi-bell-ring font-24"></i>
                                @else
                                    <i class="mdi mdi-bell font-24"></i>
                                @endif
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @forelse(Auth::user()->unreadNotifications()->latest()->take(5)->get() as $key => $one)
                                <a class="dropdown-item" href="{{ route('admin.notifications.show' , [$one->id]) }}">
                                    <div class="text-right">
                                        <td><i class="mdi mdi-bell font-35"></i> {{ $one->data['ar'] }}</td>
                                    </div>
                                    <small class="text-left text-secondary">
                                        <td>{{ $one->created_at->diffForHumans() }}</td>
                                    </small>
                                </a>
                                @empty
                                <div class="alert alert-danger text-center">لا توجد إشعارات ...</div>
                                @endforelse
                                <div class="dropdown-divider"></div>
                                @if(Auth::user()->unreadNotifications()->count())
                                <div class="text-center mx-2">
                                    <a href="{{ route('admin.markAllAsRead') }}" class="btn btn-sm btn-warning btn-rounded">تحديد الكل كمقروء</a>
                                </div>
                                @endif
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                            <!-- Message -->
                                            <a href="{{url('/')}}" class="link border-top px-2" target="_blank">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i class="ti-home"></i></span>
                                                    <div class="m-l-10 mr-3">
                                                        <h5 class="m-b-0">الرئيسية</h5>
                                                        <span class="mail-desc">الصفحة الرئيسية للموقع</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="{{url('admin/settings')}}" class="link border-top px-2">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                    <div class="m-l-10 mr-3">
                                                        <h5 class="m-b-0">الإعدادات</h5>
                                                        <span class="mail-desc">تغيير الإعدادات والعناوين</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="{{url('admin/users')}}" class="link border-top px-2">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                    <div class="m-l-10 mr-3">
                                                        <h5 class="m-b-0">الأعضاء</h5>
                                                        <span class="mail-desc">كل الأعضاء المشتركين بالموقع</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('adminpanel/assets/images/users/1.jpg')}}" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-left user-dd animated">
                                <a class="dropdown-item" href="{{url('admin/users/'.auth()->id())}}"><i class="ti-user m-r-5 m-l-5"></i> البروفايل</a>
                                <a class="dropdown-item" href="{{url('admin/notifications/')}}"><i class="ti-email m-r-5 m-l-5"></i> الإشعارات</a>
                                <div class="dropdown-divider"></div>
                                <div class="mx-2"><a href="{{url('admin/logout/')}}"  class="btn btn-sm btn-warning btn-rounded"><i class="fa fa-power-off m-r-5 m-l-5"></i> تسجيل خروج</a>
                                {{--<div class="mx-2"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-sm btn-warning btn-rounded"><i class="fa fa-power-off m-r-5 m-l-5"></i> تسجيل خروج</a>--}}
                                    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
                                        {{--@csrf--}}
                                    {{--</form>--}}
                                </div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>

        @include('admin.layouts.sidebar')

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">لوحة التحكم</h4>
                        <div class="mr-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">الرئيسية</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
