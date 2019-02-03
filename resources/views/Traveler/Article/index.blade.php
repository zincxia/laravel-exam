@include('Traveler.public.header')
{{--头部--}}
@include('Traveler.public.nav')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>{!!$content['title']!!}</h3>

            <span class="label label-default">132</span>
        </div>
        <div class="panel-body">
            {!!$content['content']!!}
        </div>
    </div>
    <a href="#{{isset($tech_list[0]['name_en'])?$tech_list[0]['name_en']:''}}"
       style="position:fixed;right:1.5em;bottom:2em;font-size: 32px;color: #101010"
       onclick="resetActive()">
        <span class="fa fa-arrow-circle-up"></span>
    </a>
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
        $('.list-group-item').removeClass('list-group-item-info');
        $('#action_' + id).addClass('list-group-item-info');
    }

    function resetActive() {
        $('.list-group-item').removeClass('list-group-item-info');
        $('#action_0').addClass('list-group-item-info')
    }
</script>
@include('Traveler.public.footer')