<?php
    $setting = App\Models\Setting::first();
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @isset($setting)
    <link rel="icon" type="image/jpg" href="{{ asset($setting->footerlogo) }}"/>
    @endisset
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/circular-std/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    {{--  <link rel="stylesheet" href="{{ asset('backend/assets/vendor/charts/chartist-bundle/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/charts/c3charts/c3.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">  --}}

    <link rel="stylesheet" href="{{  asset('backend/assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{  asset('backend/assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{  asset('backend/assets/vendor/datatables/css/select.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{  asset('backend//assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">

    <link href="{{  url('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css') }}" rel="stylesheet">
    <title> @yield('title') </title>
    @yield('style')
</head>
