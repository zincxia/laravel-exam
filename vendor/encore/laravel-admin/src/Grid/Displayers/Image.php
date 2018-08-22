<?php

namespace Encore\Admin\Grid\Displayers;

use Encore\Admin\Admin;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Storage;

class Image extends AbstractDisplayer
{
    public function display($server = '', $width = 200, $height = 200)
    {
        if ($this->value instanceof Arrayable) {
            $this->value = $this->value->toArray();
        }
        return collect((array)$this->value)->filter()->map(function ($path) use ($server, $width, $height) {
            if (url()->isValidUrl($path)) {
                $src = $path;
            } elseif ($server) {
                $src = $server . $path;
            } else {
                $src = Storage::disk(config('admin.upload.disk'))->url($path);
            }
            $tag = substr($path, 10, 6);
            Admin::script('
                $("#' . $tag . '_thum").on("click",function(){
                    $("#' . $tag . '_img").removeClass("hide");
                });
                $("#' . $tag . '_img").on("click",function(){
                    $("#' . $tag . '_img").addClass("hide");
                });
            ');
            return '
                    <img src="' . $src . '" id="' . $tag . '_thum' . '" style="max-width:' . $width . 'px;max-height:' . $height . 'px" class="img img-thumbnail" >
                    <div style="position: fixed;z-index: 999;top: 10%;left: 30%;width: 50%;max-width:' . $width*5 . 'px;max-height:' . $height*5 . 'px;" id="' . $tag . '_img' . '" class="hide">
                        <img src="' . $src . '" style="width: 100%;border: 5px solid  white;border-radius:15px;"  alt="">
                    </div>
                    ';
        })->implode('&nbsp;');
    }
}
