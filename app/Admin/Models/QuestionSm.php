<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/1 0001
 * Time: 下午 3:02
 */

namespace App\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class QuestionSm extends Model
{
    protected $table = 'question_sm';

    public static $options = [
        '1' => '非常喜欢',
        '2' => '喜欢',
        '3' => '一般',
        '4' => '不喜欢',
        '5' => '拒绝'
    ];
}