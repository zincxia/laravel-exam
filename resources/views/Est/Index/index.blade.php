<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Est</title>
    <link href="{{ URL::asset('vendor/laravel-admin/AdminLTE/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ URL::asset('vendor/fullPage/src/fullpage.css') }}" rel="stylesheet"
          type="text/css">
    <script type="text/javascript"
            src="{{ URL::asset('vendor/laravel-admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('vendor/laravel-admin/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('vendor/fullPage/vendors/easings.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('vendor/fullPage/vendors/scrolloverflow.js') }}"></script>
    <script type="text/javascript"
            src="{{ URL::asset('vendor/fullPage/src/fullpage.js') }}"></script>
</head>
<style>
    html, body {
        margin: 0;
        padding: 0;
    }

    .navbar-nav {
        float: none;
        text-align: center;
    }

    ul.nav.navbar-nav li {
        float: none;
        display: inline-block;
        margin: 0em;
    }

    .section {
        text-align: center
    }
</style>
<body>
<div>
    {{--头部--}}
    <div class="navbar navbar-fixed-top navbar-inverse">
        <div class="container-fluid">

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">首页</a>
                    </li>
                    <li>
                        <a href="#">启明星</a>
                    </li>
                    <li>
                        <a href="#">以德</a>
                    </li>
                    <li>
                        <a href="#">关于我们</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    {{--fullpage 内容主体--}}
    <div id="fullpage" style="margin-top: 3.65em;">
        <div class="section" style="background-color: blue">
            <div class="slide" style="background-color: #1f6377">第三屏的第一屏</div>
            <div class="slide" style="background-color: #2f96b4 ">第三屏的第二屏</div>
            <div class="slide" style="background-color: #4BBFC3">第三屏的第三屏</div>
            <div class="slide" style="background-color: #5bc0de">第三屏的第四屏</div>
        </div>
        <div class="section">
            <img src="{{'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/images/1.gif'}}"/>
        </div>
        <div class="section">
            <img src="{{'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/images/2.gif'}}"/>
        </div>

        <div class="section">
            <img src="{{'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/images/3.jpg'}}"/>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#fullpage').fullpage();
    });
</script>
</body>
</html>