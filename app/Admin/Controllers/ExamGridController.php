<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/7/23 0023
 * Time: 上午 9:56
 */

namespace App\Admin\Controllers;


use App\Admin\Models\ExamGrids;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class ExamGridController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    protected function grid()
    {
        return Admin::grid(ExamGrids::class, function (Grid $grid) {
            $grid->filter(function () {

            });
        });
    }
}