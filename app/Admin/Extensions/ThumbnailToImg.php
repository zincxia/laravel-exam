<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/6/25 0025
 * Time: 下午 3:36
 */

namespace App\Admin\Extensions\Grid;

use Encore\Admin\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Column;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;

/**
 * 缩略图放大
 * Class ThumbnailToImg
 * @package App\Admin\Extensions
 */
class ThumbnailToImg extends AbstractDisplayer
{
    protected $id;

    public function display($thumbName = 'thumb', $imgName = 'img')
    {
        $primaryKey = $this->grid->getKeyName();
        $this->id = $this->row[$primaryKey];
        Admin::script('
            $("#' . $thumbName . '_' . $this->id . '").on("click",function(){
                $("#' . $imgName . '_' . $this->id . '").removeClass("hide");
            });
            $("#' . $imgName . '_' . $this->id . '").on("click",function(){
                $("#' . $imgName . '_' . $this->id . '").addClass("hide");
            });
        ');
        return '
            <img src="' . $this->value . '" id="' . $thumbName . '_' . $this->id . '" style="width: 50px;height: 50px;" alt="" >
            <div style="position: fixed;z-index: 999;top: 10%;left: 30%;width: 50%">
                <img src="' . $this->value . '" id="' . $imgName . '_' . $this->id . '" style="width: 100%;" alt="" class="hide">
            </div>

        ';

    }




//    protected $id;          //识别参数
//    protected $img_url;     //图片路径
//
//    public function __construct($img_url, $id)
//    {
//        $this->img_url = $img_url;
//        $this->id = $id;
//    }
//
//    protected function script()
//    {
//        return <<<SCRIPT
//            $("#thum_' . $this->id . '").on("click",function(){
//                $("#img_' . $this->id . '").removeClass("hide");
//            });
//            $("#img_' . $this->id . '").on("click",function(){
//                $("#img_' . $this->id . '").addClass("hide");
//            });
//SCRIPT;
//    }
//    public function render()
//    {
//        Admin::script($this->script());
//        return <<<EOT
//           <img src="' . $this->img_url . '" id="thum_' . $this->id . '" style="width: 50px;height: 50px;" alt="" >
//                            <img src="' . $this->img_url . '" id="img_' . $this->id . '" style="width: 500px;top: 10%;position: fixed;" alt="" class="hide">
//EOT;
//    }
//
//    public function __toString()
//    {
//        return $this->render();
//    }
}