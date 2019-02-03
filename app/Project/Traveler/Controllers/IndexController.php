<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/23 0023
 * Time: 上午 11:28
 */

namespace App\Project\Traveler\Controllers;


use App\Admin\Models\LesMillsTech;
use App\Admin\Models\TravelerArticle;

class IndexController extends Base
{
    public function index()
    {
        $id = Request()->input('id');
        $cond = ['id' => $id];
        $tech_list = TravelerArticle::where($cond)->get()->toArray();
        return view('Traveler/Article/index',
            ['tech_list' => $tech_list]);
    }
}