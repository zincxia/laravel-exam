<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/3 0003
 * Time: 上午 9:39
 */

namespace App\Admin\Models;


use Illuminate\Support\Facades\Log;

class QuestionDictionary extends Base
{
    protected $table = 'question_dictionary';

    public static $level = [
        '0' => '未选择',
        '1' => '一级目录',
        '2' => '二级目录',
        '3' => '三级目录',

    ];

    public static function typeName($id)
    {
        return self::where('id', $id)->value('attr_name');
    }

    public static function fatherList($level)
    {
        $res = [];
        $level = $level - 1;
        $list = self::where('level', $level)->pluck('id', 'attr_name');
        foreach ($list as $item) {
            $res[$item['id']] = $item['attr_name'];
        }
        Log::error('file:' . __CLASS__ . '  function:' . __FUNCTION__ . '  line:' . __LINE__ . '$res == ' . print_r($res, true));
        return $res;
    }

}