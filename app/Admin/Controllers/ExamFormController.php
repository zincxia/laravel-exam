<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/7/26 0026
 * Time: 下午 2:53
 */

namespace App\Admin\Controllers;


use App\Admin\Models\ExamGrids;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;

class ExamFormController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    protected function form()
    {
        return Admin::form(ExamGrids::class, function (Form $form) {
            $form->map('11','22','name');
        });
    }
}