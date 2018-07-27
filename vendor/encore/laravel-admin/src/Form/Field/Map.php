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
            $js = '//map.qq.com/api/js?v=2.exp&libraries=drawing,geometry,autocomplete,convertor';
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
            $this->useTencentMap();
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

            var anchor = new qq.maps.Point(10, 10),
            size = new qq.maps.Size(24, 24),
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
                panel: document.getElementById('info_{$this->id['lat']}{$this->id['lng']}'),
                //设置动扩大检索区域。默认值true，会自动检索指定城市以外区域。
                autoExtend: false,
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
}
