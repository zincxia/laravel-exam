<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/21 0021
 * Time: 上午 10:54
 */

namespace App\Admin\Models;


use Illuminate\Support\Facades\Log;

class LesmilleTech extends Base
{
    protected $table = 'lesmille_tech';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function setImgListAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['img_list'] = json_encode($value);
        }
    }
    public function getImgListAttribute($value)
    {
        return json_decode($value, true);
    }
}