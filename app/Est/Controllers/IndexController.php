<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/23 0023
 * Time: 上午 11:28
 */

namespace App\Est\Controllers;


class IndexController extends Base
{
    public function index()
    {
        return view('Est/Index/index');
    }
}