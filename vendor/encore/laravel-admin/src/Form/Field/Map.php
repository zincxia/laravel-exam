<?php

namespace Encore\Admin\Form\Field;

use Encore\Admin\Form\Field;

class Map extends Field
{
    /**
     * Column name.
     *
     * @var array
     */
    protected $column = [];

    /**
     * Get assets required by this field.
     *
     * @return array
     */
    public static function getAssets()
    {
        if (config('app.locale') == 'zh-CN') {
//            $js = '//map.qq.com/api/js?v=2.exp&libraries=drawing,geometry,autocomplete,convertor';
            $js = '//api.map.baidu.com/api?v=2.0&ak=fq5dpqUsyksee741FyFBylNzem66CkFG';
        } else {
            $js = '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=' . env('GOOGLE_API_KEY');
        }

        return compact('js');
    }

    public function __construct($column, $arguments)
    {
        $this->column['lat'] = $column;
        $this->column['lng'] = $arguments[0];

        array_shift($arguments);

        $this->label = $this->formatLabel($arguments);
        $this->id = $this->formatId($this->column);

        /*
         * Google map is blocked in mainland China
         * people in China can use Tencent map instead(;
         */
        if (config('app.locale') == 'zh-CN') {
//            $this->useTencentMap();
            $this->useBaiduMap();
        } else {
            $this->useGoogleMap();
        }
    }

    public function useGoogleMap()
    {
        $this->script = <<<EOT
        function initGoogleMap(name) {
            var lat = $('#{$this->id['lat']}');
            var lng = $('#{$this->id['lng']}');

            var LatLng = new google.maps.LatLng(lat.val(), lng.val());

            var options = {
                zoom: 13,
                center: LatLng,
                panControl: false,
                zoomControl: true,
                scaleControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            var container = document.getElementById("map_"+name);
            var map = new google.maps.Map(container, options);

            var marker = new google.maps.Marker({
                position: LatLng,
                map: map,
                title: 'Drag Me!',
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function (event) {
                lat.val(event.latLng.lat());
                lng.val(event.latLng.lng());
            });
        }

        initGoogleMap('{$this->id['lat']}{$this->id['lng']}');
EOT;
    }

    public function useTencentMap()
    {
        $this->script = <<<EOT
        function initTencentMap(name) {
            var lat = $('#{$this->id['lat']}');
            var lng = $('#{$this->id['lng']}');
           
            var center = new qq.maps.LatLng(lat.val(), lng.val());

            var container = document.getElementById("map_"+name);
            var map = new qq.maps.Map(container, {
                center: center,
                zoom: 13
            });

            var anchor = new qq.maps.Point(15, 15),
            size = new qq.maps.Size(35, 35),
            origin = new qq.maps.Point(0, 0),
            icon = new qq.maps.MarkerImage('/image/located.png', size, origin, anchor);

            var marker = new qq.maps.Marker({
                icon: icon,
                position: center,
                draggable: true,
                map: map
            });
            if( ! lat.val() || ! lng.val()) {
                var citylocation = new qq.maps.CityService({
                    complete : function(result){
                        map.setCenter(result.detail.latLng);
                        marker.setPosition(result.detail.latLng);
                    }
                });

                citylocation.searchLocalCity();
            }            
            var latlngBounds = new qq.maps.LatLngBounds();
            var searchService,map,markers = [];
            searchService = new qq.maps.SearchService({
                //设置搜索范围为北京
                location: "深圳",
                //设置搜索页码为1
                pageIndex: 0,
                //设置每页的结果数为5
                pageCapacity: 5,
                //搜索结果列表展示
                //panel: document.getElementById('info_{$this->id['lat']}{$this->id['lng']}'),
                //设置动扩大检索区域。默认值true，会自动检索指定城市以外区域。
                autoExtend: false,
                //地图详情标注
                map:map,
                complete : function(results){
                    var pois = results.detail.pois;
                    for(var i = 0,l = pois.length;i < l; i++){
                        var poi = pois[i];
                        latlngBounds.extend(poi.latLng);  
                        var marker = new qq.maps.Marker({
                            map:map,
                            position: poi.latLng
                        });
        
                        marker.setTitle(i+1);
                        
                        markers.push(marker);
                    }
                    map.fitBounds(latlngBounds);
                },
                //若服务请求失败，则运行以下函数
                error: function() {
                    alert("出错了。");
                }
            });
            $("#btn_{$this->id['lat']}{$this->id['lng']}").on('click',function(){
                var keyword = document.getElementById("keyword_{$this->id['lat']}{$this->id['lng']}").value;
                region = new qq.maps.LatLng(lat,lng);
                //searchService.searchNearBy(keyword, region, 20);//根据中心点坐标、半径和关键字进行周边检索。
                searchService.search(keyword);//根据关键字发起检索。
                //searchService.searchInBounds(keyword,region);//根据范围和关键字进行指定区域检索。
            });
            qq.maps.event.addListener(map, 'click', function(event) {
                marker.setPosition(event.latLng);
            });

            qq.maps.event.addListener(marker, 'position_changed', function(event) {
                var position = marker.getPosition();
                lat.val(position.getLat());
                lng.val(position.getLng());
            });
        }
        initTencentMap('{$this->id['lat']}{$this->id['lng']}');
EOT;
    }

    public function useBaiduMap()
    {
        $this->script = <<<EOT
        function initBaiduMap(name){
            var lat = $('#{$this->id['lat']}');
            var lng = $('#{$this->id['lng']}');
            // 百度地图API功能
            var point = new BMap.Point(lng.val(),lat.val());   // 创建坐标
           
            var container = document.getElementById("map_"+name);
	        var map = new BMap.Map(container);      // 创建Map实例
	        
	        var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
	        var top_left_navigation = new BMap.NavigationControl({
                // 靠左上角位置
                anchor: BMAP_ANCHOR_TOP_LEFT,
                // LARGE类型
                type: BMAP_NAVIGATION_CONTROL_LARGE,
                // 启用显示定位
                enableGeolocation: true
            });  //左上角，添加默认缩放平移控件
	        map.addControl(top_left_control);        
		    map.addControl(top_left_navigation);  
		    map.enableScrollWheelZoom();   //启用滚轮放大缩小，默认禁用
	        map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
	        
	        map.centerAndZoom(point, 12);  // 初始化地图,设置中心点坐标和地图级别
	        
	        var marker = new BMap.Marker(point);    // 创建标注
	        marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
            
            // 添加定位控件
            var geolocationControl = new BMap.GeolocationControl();
            geolocationControl.addEventListener("locationSuccess", function(e){
                // 定位成功事件
                var address = '';
                address += e.addressComponent.province;
                address += e.addressComponent.city;
                address += e.addressComponent.district;
                address += e.addressComponent.street;
                address += e.addressComponent.streetNumber;
                //alert("当前定位地址为：" + address);
            });
            geolocationControl.addEventListener("locationError",function(e){
                // 定位失败事件
                alert(e.message);
            });
            map.addControl(geolocationControl);   
	        if(! lat.val() || ! lng.val()){
	            var myCity = new BMap.LocalCity();
	            myCity.get(function myFun(result){
                    var cityName = result.name;
                    map.setCenter(cityName);
                });
	        }
	        map.addOverlay(marker);               // 将标注添加到地图中
	        //单击获取点击的经纬度
            map.addEventListener("click",function(e){
                marker.setPosition(new BMap.Point(e.point.lng , e.point.lat));
                map.addOverlay(marker);               // 将标注添加到地图中
                lat.val(e.point.lat);
                lng.val(e.point.lng);
//                alert(e.point.lng + "," + e.point.lat);
            });
            
            var local = new BMap.LocalSearch(map, {
                renderOptions:{map: map}
            });
            $("#btn_{$this->id['lat']}{$this->id['lng']}").on('click',function(){
                var keyword = document.getElementById("keyword_{$this->id['lat']}{$this->id['lng']}").value;
                local.search(keyword);
            });
        };
        initBaiduMap('{$this->id['lat']}{$this->id['lng']}');
EOT;
    }
}
