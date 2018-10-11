<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/21 0021
 * Time: 上午 10:54
 */

namespace App\Admin\Models;

use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Log;

class LesMillsTech extends Base
{
    protected $table = 'lesmille_tech';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public static $typeOption = [
        1 => 'BODYPUMP',
        2 => 'RPM',
        3 => 'BODYCOMBAT',
        4 => 'BODYJAM',
        5 => 'BODYATTACk',
        6 => 'BODYBALLANCE',

    ];

    public static $typeAbOption = [
        1 => 'BP',
        2 => 'RPM',
        3 => 'BC',
        4 => 'BJ',
        5 => 'BA',
        6 => 'BB',
    ];

    public function setImgListAttribute($value)
    {
        $this->attributes['img_list'] = json_encode($value);
    }

    public function getImgListAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getTypeAttribute($value)
    {
        if (method_exists(Admin::user(),'isRole') && Admin::user()->isRole('lesmille')) {
            return self::$typeOption[$value];
        } else {
            return $value;
        }
    }
}