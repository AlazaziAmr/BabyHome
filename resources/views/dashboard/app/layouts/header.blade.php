<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $settings['settings']->getTranslation('name',app()->getLocale(),false) }} | {{ $data['title'] }}</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    @if(app()->getLocale() == 'en')
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/meanmenu/meanmenu.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/wave/waves.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/wave/button.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/jvectormap/jquery-jvectormap-2.0.3.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/notika-custom-icon.css') }}">
        @stack('styles')
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/style.css') }}?v=2">
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/responsive.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/ar_style.css') }}">
        @stack('styles')
        <link rel="stylesheet" href="{{ asset('public/dashboard/ar_style.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/css/ar_style2.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('public/dashboard/css/dialog/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/dashboard/css/dialog/dialog.css')}}">
        <script src="{{ asset('public/dashboard/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body dir="{{ app()->getLocale() == 'ar'  ? 'rtl' : 'ltr' }}">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Start Header Top Area -->

