<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/23 0023
 * Time: 上午 11:28
 */

namespace App\LesMills\Controllers;


use App\Admin\Models\LesMillsTech;

class IndexController extends Base
{
    public function index()
    {
        $type = Request()->input('type');
        $keyword = Request()->input('keyword');
        $type_id = array_search(isset($type) ? $type : 'BODYPUMP', LesMillsTech::$typeOption);
        $cond = $orCond = [];
        if (isset($keyword)) {
            $cond[] = ['name', 'like', '%' . $keyword . '%'];
            $orCond[] = ['name_en','like', '%' . $keyword . '%'];
        }else{
            $cond['type'] = $type_id;
        }
        $tech_list = LesMillsTech::where($cond)->orWhere($orCond)->get()->toArray();
        foreach ($tech_list as $k => $tech) {
            $tech_list[$k]['ab'] = LesMillsTech::$typeAbOption[$tech['type']];
            if(empty($tech['img_list'])){
                $tech_list[$k]['img_list'] = [];
            }
        }
        return view('LesMills/Index/index',
            ['tech_list' => $tech_list]);
    }
}