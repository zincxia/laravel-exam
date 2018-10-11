<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/23 0023
 * Time: 上午 11:28
 */

namespace App\Lesmille\Controllers;


use App\Admin\Models\LesmilleTech;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\DB;

class IndexController extends Base
{
    public function index()
    {
        $type = Request()->input('type');
        $keyword = Request()->input('keyword');
        $type_id = array_search(isset($type) ? $type : 'BodyPump', LesmilleTech::$typeOption);
        $cond = $orCond = [];
        if (isset($keyword)) {
            $cond[] = ['name', 'like', '%' . $keyword . '%'];
            $orCond[] = ['name_en','like', '%' . $keyword . '%'];
        }else{
            $cond['type'] = $type_id;
        }
        $tech_list = LesmilleTech::where($cond)->orWhere($orCond)->get()->toArray();
        foreach ($tech_list as $k => $tech) {
            $tech_list[$k]['ab'] = LesmilleTech::$typeAbOption[$tech['type']];
        }
        return view('Lesmille/Index/index',
            ['tech_list' => $tech_list]);
    }
}