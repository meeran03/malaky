</div>
<footer class="footer text-center">
    جميع الحقوق محفوظة
    {{--<a href="https://moltaqa.net/">لشركة ملتقى للبرمجيات </a>--}}
    @ {{date('Y')}}.
</footer>
</div>
</div>
<script src="{{asset('adminpanel/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('adminpanel/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('adminpanel/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('adminpanel/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('adminpanel/assets/extra-libs/sparkline/sparkline.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('adminpanel/dist/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('adminpanel/dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('adminpanel/dist/js/custom.min.js')}}"></script>
<!--This page JavaScript -->
<!-- <script src="{{asset('adminpanel/dist/js/pages/dashboards/dashboard1.js"></script> ')}}-->
<!-- Charts js Files -->
<script src="{{asset('adminpanel/assets/libs/flot/excanvas.js')}}"></script>
<script src="{{asset('adminpanel/assets/libs/flot/jquery.flot.js')}}"></script>
<script src="{{asset('adminpanel/assets/libs/flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('adminpanel/assets/libs/flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('adminpanel/assets/libs/flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('adminpanel/assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
<script src="{{asset('adminpanel/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{asset('adminpanel/dist/js/pages/chart/chart-page-init.js')}}"></script>
<script src="{{asset('adminpanel/assets/libs/quill/dist/quill.min.js')}}"></script>
@yield('scripts')
</body>
