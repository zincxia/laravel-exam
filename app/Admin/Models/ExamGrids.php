<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/7/23 0023
 * Time: 上午 10:07
 */

namespace App\Admin\Models;


use Illuminate\Database\Eloquent\Model;

class ExamGrids extends Model
{
//    protected $connection = 'e_commerce';
    protected $table = 'exam_grids';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $primaryKey = 'sp_id';
    protected $keyType = 'string';
}