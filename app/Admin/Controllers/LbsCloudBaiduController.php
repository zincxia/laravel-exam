<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/14 0014
 * Time: 上午 11:19
 */

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class LbsCloudBaiduController extends Controller
{
    protected $key = 'IpmieZtiFPMN7MVqR5NKG8wHLsIwmmvA';
//    protected $key = 'ZTzBAjmIj8aIRzd0Asaqeybs0PjfBAUj';

    /**
     * 位置数据表（geotable）管理
     *
     */
    public function geoTable()
    {
        $create_url = 'http://api.map.baidu.com/geodata/v3/geotable/create';
        $update_url = 'http://api.map.baidu.com/geodata/v3/geotable/update';
        $data = [
            'name' => 'test1',//geotable的中文名称
            'geotype' => 1,//geotable持有数据的类型 1：点；3：面。默认为1（如需存储“面”数据，建议使用V4版云存储服务）
            'is_published' => 1,//是否发布到检索
            /*
            * 0：未自动发布到云检索，
            * 1：自动发布到云检索；
            * 注：
            * 1）通过URL方式创建表时只有is_published=1时 在云检索时表内的数据才能被检索到。
            * 2）可通过数据管理模块设置，在设置中将是否发送到检索一栏中选定为是即可。
            * */
            'ak' => $this->key,//用户的访问权限key
        ];
        $client = new Client();
        $send = $client->post($create_url, ['form_params' => $data]);
        $response = $send->getBody()->getContents();
        $responseArr = json_decode($response, true);
        dd($responseArr);
    }

    public function column()
    {
        $url = 'http://api.map.baidu.com/geodata/v3/column/create';
        $data = [
            'name' => '',//column的名称描述
            'key' => '',//column存储的key标识，含义与返回结果中的列“id”字段相同，该字段为用户创建时自定义设置  同一个geotable内的名字不能相同
            'type' => '',//存储的值的类型 枚举值1：Int64, 2：double, 3：string, 4：在线图片url
            'max_length' => '',//最大长度 最大值2048，最小值为1。当type为string该字段有效，此时该字段必填。此值代表utf8的汉字个数，不是字节个数
            'default_value' => '',//默认值
            'is_sortfilter_field' => '',//是否检索引擎的数值排序筛选字段 1代表是，0代表否。设置后，在请求 LBS.云检索时可针对该字段进行排序。该字段只能为int或double类型，最多设置15个
            'is_search_field' => '',//是否检索引擎的文本检索字段 1代表支持，0为不支持。只有type为string时可以设置检索字段，只能用于字符串类型的列且最大长度不能超过512个字节
            'is_index_field' => '',//是否将字段设置为云存储的索引字段； 用于存储接口查询:1代表支持，0为不支持，注：is_index_field=1 时才能在根据该列属性值检索时检索到数据。
            'is_unique_field' => '',//是否云存储唯一索引字段，方便更新，删除，查询 1代表是，0代表否。设置后将在数据创建和更新时进行该字段唯一性检查，并可以以此字段为条件进行数据的更新、删除和查询。最多设置1个
            'geotable_id' => '',//所属于的geotable_id
            'ak' => $this->key,//用户的访问权限key
        ];
    }

    public function poi()
    {
        $create_url = 'http://api.map.baidu.com/geodata/v3/poi/create';
        $update_url = 'http://api.map.baidu.com/geodata/v3/poi/update';
        $data = [
            'title' => '',//位置数据名称 可选。最多128个utf-8字符
            'address' => '',//位置数据地址 可选。最多128个utf-8字符
            'tags' => '',//位置数据类别 可选。最多200个tag，每个tag最长32个字符。
            'latitude' => '',//用户上传的纬度 必选。非百度墨卡托坐标时，取值为[-90,90]
            'longitude' => '',//用户上传的经度 必选。非百度墨卡托坐标时，取值为[-180,180]
            'coord_type' => 3,
            /*
             * 用户上传的坐标的类型：1、2、3、4
             * 必选
             * 1：GPS经纬度坐标
             * 2：国测局加密经纬度坐标
             * 3：百度加密经纬度坐标
             * 4：百度加密墨卡托坐标
             * */
            'geotable_id' => '',//创建数据的对应数据表id
            'ak' => $this->key,//用户的访问权限key
            '{column key}' => '',//用户在column定义的key/value对 唯一索引字段必选，且需要保证唯一，否则会创建失败。最大长度2048字节。
        ];
    }
}