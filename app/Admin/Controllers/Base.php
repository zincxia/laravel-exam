<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/3 0003
 * Time: 上午 9:42
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class Base extends Controller
{
    use ModelForm;

    public function getEditId($name = '', $model = null)
    {
        $param = request()->route()->parameters();
        if (empty($param)) {
            $id = null;
            $data = [];
        } else {
            $id = $param[$name];
            $data = $model::find($id);
        }
        return [$id, $data];
    }
}