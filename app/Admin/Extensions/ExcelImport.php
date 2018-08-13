<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/9 0009
 * Time: 下午 2:13
 */

namespace App\Admin\Extensions;


use Maatwebsite\Excel\Facades\Excel;

class ExcelImport
{
    //Excel文件导入功能
    public static function import($filePath = '')
    {
        $reader = Excel::load($filePath);
        $reader = $reader->getSheet(0);
        $data = $reader->toArray();
        return $data;
    }
}