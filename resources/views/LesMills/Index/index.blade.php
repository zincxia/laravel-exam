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
    html, body, .page-header {
        margin: 0;
        padding: 0;
    }

    .content {
        margin-top: 5em;
        margin-bottom: 5em;
        height: 47em;
    }

    .content-left {
        height: 50em;
        overflow: auto;
    }

    .content-right {
        height: 50em;
        overflow: auto;
    }

    .badge {
        margin-left: 0.5em;
    }
</style>
<body onload="load()">
<div class="container-fluid">
    {{--头部--}}
    <div class="navbar navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="navbar-brand">
                    <img class="pull-left"
                         alt="logo" src="{{ URL::asset('favicon.ico')}}">
                    <p class="pull-left" style="margin-left: 0.5em;">LesMills</p>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    @foreach (\App\Admin\Models\LesMillsTech::$typeOption as $type)
                        <li id="{{$type}}">
                            <a href="?type={{$type}}" target="_self">{{$type}}</a>
                        </li>
                    @endforeach
                </ul>
                <form action="#" method="get" class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input name="keyword" type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row content">
        {{--左侧导航--}}
        <div class="col-xs-2 content-left">
            <div class="list-group">
                @foreach ($tech_list as $k => $tech)
                    <button type="button" href="#{{$tech['name_en']}}"
                            class="list-group-item" id="action_{{$k}}"
                            onclick="setActive({{$k}})">
                        <span class="badge">{{$tech['ab']}}</span>
                        {{$tech['name']}}
                    </button>
                @endforeach
            </div>
        </div>
        <div class="col-xs-10 content-right">
            @foreach ($tech_list as $tech)
                <div class="panel panel-default" id="{{$tech['name_en']}}">
                    <div class="panel-heading">
                        <span class="label label-danger">{{$tech['ab']}}</span>
                        {{$tech['name']}} - {{$tech['name_en']}}
                    </div>
                    <div class="panel-body">
                        <p>{{$tech['target']}}</p>
                        @if($tech['img_list'])
                            @foreach ($tech['img_list'] as $img)
                                <img src="{{'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/' .$img}}"
                                     alt="">
                            @endforeach
                        @endif
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
                                {!! $tech['layer2'] !!}
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{--<a href='tencent://message/?uin=QQ号码&Site=网站地址&Menu=yes'>QQ</a>--}}
    {{--<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=240186797&site=qq&menu=yes">--}}
    {{--<img border="0"--}}
    {{--src="http://wpa.qq.com/pa?p=2:178899573:51"--}}
    {{--alt="点击这里给我发消息"--}}
    {{--title="点击这里给我发消息"/></a>--}}
    <a href="#{{isset($tech_list[0]['name_en'])?$tech_list[0]['name_en']:''}}"
       style="position:fixed;right:1.5em;bottom:2em;font-size: 32px;color: #101010"
       onclick="resetActive()">
        <span class="fa fa-arrow-circle-up"></span>
    </a>
    {{--底部--}}
    <div class="navbar navbar-fixed-bottom navbar-inverse">
        <div style="color: whitesmoke;">123</div>

    </div>
</div>
<script>
    function load() {
        var path = GetUrlParam('type');
        $('#' + path).addClass('active');
        resetActive();
    }

    function GetUrlParam(paraName) {
        var url = document.location.toString();
        var arrObj = url.split("?");

        if (arrObj.length > 1) {
            var arrPara = arrObj[1].split("&");
            var arr;

            for (var i = 0; i < arrPara.length; i++) {
                arr = arrPara[i].split("=");

                if (arr != null && arr[0] == paraName) {
                    return arr[1];
                }
            }
            return "";
        }
        else {
            return "";
        }
    }

    function setActive(id) {
        $('.list-group-item').removeClass('list-group-item-danger');
        $('#action_' + id).addClass('list-group-item-danger');
    }

    function resetActive() {
        $('.list-group-item').removeClass('list-group-item-danger');
        $('#action_0').addClass('list-group-item-danger');
    }
</script>
</body>
</html>