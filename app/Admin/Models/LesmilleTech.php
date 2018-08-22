<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/21 0021
 * Time: 上午 10:54
 */

namespace App\Admin\Models;

use Encore\Admin\Facades\Admin;

class LesmilleTech extends Base
{
    protected $table = 'lesmille_tech';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public static $typeOption = [
        1 => 'BodyPump',
        2 => 'RPM',
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
        if (Admin::user()->isRole('lesmille')) {
            return self::$typeOption[$value];
        } else {
            return $value;
        }
    }
}