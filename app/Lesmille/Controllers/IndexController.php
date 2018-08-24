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

class IndexController extends Base
{
    public function index()
    {
        $tech_list = LesmilleTech::get()->toArray();
        foreach ($tech_list as $k => $tech) {
            $tech_list[$k]['ab'] = LesmilleTech::$typeAbOption[$tech['type']];
        }
        return view('Lesmille/Index/index',
            ['tech_list' => $tech_list]);
    }
}