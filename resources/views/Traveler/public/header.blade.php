<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Lesmille</title>
    <link href="{{ URL::asset('vendor/laravel-admin/AdminLTE/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ URL::asset('vendor/laravel-admin/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
          type="text/css">
    <script type="text/javascript"
            src="{{ URL::asset('vendor/laravel-admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('vendor/laravel-admin/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<style>
    html, body {
        padding-top: 3em;
        overflow-x: hidden;
        height: 100%;
    }

    .content-left {
        position: fixed;
        overflow-y: auto;
        height: 90%;
        display: block;
    }

    .content-right {
        left: 17%;
        height: 90%;
        overflow: auto;
    }

    .target-fix {
        position: relative;
        top: -3.7em;
        display: block;
        height: 0;
        overflow: hidden;
    }

    .badge {
        margin-left: 0.5em;
    }
</style>
<body onload="load()">