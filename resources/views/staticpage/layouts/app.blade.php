<!DOCTYPE html>
{{--<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<html lang="en-US">
    @include('staticpage.layouts.header')
    @yield('content')
    @include('staticpage.layouts.footer')
</html>
