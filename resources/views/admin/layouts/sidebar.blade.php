<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/admin')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">الرئيسية</span></a></li>
                @if(admin_can_any('settings'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/admin/settings')}}" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">الإعدادات</span></a></li>
                @endif
                @if(admin_can_any('cities'))
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-map"></i><span class="hide-menu">المدن </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.cities.create')}}" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"> إضافة مدينة </span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.cities.index')}}" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> كل المدن </span></a></li>
                    </ul>
                </li>
                @endif

                @if(admin_can_any('users'))
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">الأعضاء </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.users.create')}}" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu"> إضافة عضو </span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.users.index')}}" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> كل الأعضاء </span></a></li>
                    </ul>
                </li>
                @endif
                @if(admin_can_any('roles'))
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-network"></i><span class="hide-menu">الصلاحيات و الأدوار </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.roles.create')}}" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu"> إضافة دور </span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.roles.index')}}" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> كل الأدوار </span></a></li>
                    </ul>
                </li>
                @endif
                @if(admin_can_any('packages'))
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-developer-board"></i><span class="hide-menu">الباقات </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.packages.create')}}" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu"> إضافة باقة </span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.packages.index')}}" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> كل الباقات </span></a></li>
                    </ul>
                </li>
                @endif
                @if(admin_can_any('subscriptions'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('admin.subscriptions.index')}}" aria-expanded="false"><i class="mdi mdi-chart-areaspline"></i><span class="hide-menu">الاشتراكات</span></a></li>
                @endif

                @if(admin_can_any('notifications'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.notifications.index') }}" aria-expanded="false"><i class="mdi mdi-bell"></i><span class="hide-menu">الإشعارات</span></a></li>
                @endif
                @if(admin_can_any('chats'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.chats.index') }}" aria-expanded="false"><i class="mdi mdi-wechat"></i><span class="hide-menu">المحادثات</span></a></li>
                @endif
                @if(admin_can_any('coupons'))
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-credit-card"></i><span class="hide-menu">الكوبونات</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.coupons.create')}}" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu"> إضافة كوبون </span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.coupons.index')}}" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> كل الكوبونات </span></a></li>
                        @if(admin_can_any('activations'))
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.activations.index') }}" aria-expanded="false"><i class="mdi mdi-human"></i><span class="hide-menu">مستخدمي الكوبونات</span></a></li>
                        @endif
                    </ul>
                </li>
                @endif
                {{-- THis is my custom added functionality --}}
                @if(admin_can_any('coupons'))
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-credit-card"></i><span class="hide-menu">االحصائيات</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.statistics.index')}}" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu">  االحصائيات </span></a></li>
                    </ul>
                </li>
                @endif
                {{-- It is till here --}}
                @if(admin_can_any('applications'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.applications.index') }}" aria-expanded="false"><i class="mdi mdi-apps"></i><span class="hide-menu">طلبات الحاضنات</span></a></li>
                @endif
                @if(admin_can_any('deliveries'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.deliveries.index') }}" aria-expanded="false"><i class="mdi mdi-view-headline"></i><span class="hide-menu">طلبات المناديب</span></a></li>
                @endif
                @if(admin_can_any('seeks'))
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.seeks.index') }}" aria-expanded="false"><i class="mdi mdi-server"></i><span class="hide-menu">طلبات الخدمات</span></a></li>
                @endif
                @if(admin_can_any('orders'))
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-arrow-all"></i><span class="hide-menu"> الطلبات</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            @if(admin_can_any('statuses'))
                            <li class="sidebar-item"><a href="{{route('admin.statuses.index')}}" class="sidebar-link"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu"> حالات الطلب </span></a></li>
                            @endif
                            <li class="sidebar-item"><a href="{{route('admin.orders.index')}}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> الطلبات </span></a></li>
                            <li class="sidebar-item"><a href="{{route('admin.reports.index')}}" class="sidebar-link"><i class="mdi mdi-library-books"></i><span class="hide-menu"> تقارير شهرية </span></a></li>
                            @if(admin_can_any('withdrawals'))
                            <li class="sidebar-item"><a href="{{route('admin.withdrawals.index')}}" class="sidebar-link"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu">التسويات </span></a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(admin_can_any('pages'))
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-book-open-page-variant"></i><span class="hide-menu">الصفحات</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.pages.create')}}" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu"> إضافة صفحة </span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.pages.index')}}" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> كل الصفحات </span></a></li>
                    </ul>
                </li>
                @endif
                @if(admin_can_any('sliders'))
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-book-multiple-variant"></i><span class="hide-menu">السلايدرات</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.sliders.create')}}" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu"> إضافة سلايدر </span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.sliders.index')}}" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> كل السلايدرات </span></a></li>
                    </ul>
                </li>
                @endif
                @if(admin_can_any('conditions'))
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-television-guide"></i><span class="hide-menu">الشروط</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{route('admin.conditions.create')}}" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu"> إضافة شرط </span></a></li>
                        <li class="sidebar-item"><a href="{{route('admin.conditions.index')}}" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> كل الشروط </span></a></li>
                    </ul>
                </li>
                @endif
                @if(admin_can_any('services'))
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-server-network"></i><span class="hide-menu">الخدمات</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{route('admin.services.create')}}" class="sidebar-link"><i class="mdi mdi-account-plus"></i><span class="hide-menu"> إضافة خدمة </span></a></li>
                            <li class="sidebar-item"><a href="{{route('admin.services.index')}}" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> كل الخدمات </span></a></li>
                        </ul>
                    </li>
                @endif
                @if(admin_can_any('apprates'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.apprates.index') }}" aria-expanded="false"><i class="mdi mdi-verified"></i><span class="hide-menu">التقييمات</span></a></li>
                @endif
                @if(admin_can_any('contacts'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.contacts.index') }}" aria-expanded="false"><i class="mdi mdi-message"></i><span class="hide-menu">تواصل معنا</span></a></li>
                @endif
                @if(admin_can_any('staticpages'))
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin.staticpages.index') }}" aria-expanded="false"><i class="mdi mdi-page-layout-body"></i><span class="hide-menu">الصفحة الرئيسية</span></a></li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
