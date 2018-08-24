<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Lesmille</title>
    <link href="{{ URL::asset('vendor/laravel-admin/AdminLTE/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
          type="text/css">
    <script type="text/javascript"
            src="{{ URL::asset('vendor/laravel-admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('vendor/laravel-admin/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<style>
    html, body, .page-header {
        margin: 0;
        padding: 0;
    }

    .content {
        margin-top: 6em;
        margin-bottom: 5em;
        height: 45em;
    }

    .content-left {
        display: block;
        position: fixed;
        height: 45em;
        overflow: auto;
    }

    .content-right {
        margin-left: 20em;
        height: 45em;
        overflow: auto;
    }

    .badge {
        margin-left: 0.5em;
    }
</style>
<body>
<div class="container-fluid">
    {{--头部--}}
    <div class="page-header navbar-fixed-top">
        <h1>基础动作
            <small>bodypump</small>
        </h1>
    </div>
    <div class="row content">
        {{--左侧导航--}}
        <div class="col-xs-2 content-left">
            <div class="list-group">
                @foreach ($tech_list as $tech)
                    <a href="#{{$tech['name_en']}}" class="list-group-item">
                        <span class="badge">{{$tech['ab']}}</span>
                        {{$tech['name']}}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-xs-9 content-right">
            @foreach ($tech_list as $tech)
                <div class="panel panel-default" id="{{$tech['name_en']}}">
                    <div class="panel-heading">
                        <span class="label label-danger">{{$tech['ab']}}</span>
                        {{$tech['name']}} - {{$tech['name_en']}}
                    </div>
                    <div class="panel-body">
                        <p>{{$tech['target']}}</p>
                        <img src="{{'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/' .$tech['img_list'][0]}}"
                             alt="">
                        <div class="row">
                            <div class="col-xs-4">
                                <h4><strong>姿势建立</strong></h4>
                                {!! $tech['position'] !!}
                            </div>
                            <div class="col-xs-4">
                                <h4><strong>执行建立</strong></h4>
                                {!! $tech['execution'] !!}
                            </div>
                            <div class="col-xs-4">
                                <h4><strong>第二层</strong></h4>
                                {!! $tech['position'] !!}
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <a href="#{{$tech_list[0]['name_en']}}" style="position:fixed;right:2em;bottom:6em">↑ top</a>
    {{--底部--}}
    <div class="page-footer  navbar-fixed-bottom">
        <h1>Example page header
            <small>Subtext for header</small>
        </h1>
    </div>
</div>
</body>
</html>