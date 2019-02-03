<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/30
 * Time: 14:30
 */

namespace App\Admin\Models;


class TravelerArticle extends Base
{
    protected $table = 'traveler_article';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
}