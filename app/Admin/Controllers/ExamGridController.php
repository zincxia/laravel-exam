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
use Encore\Admin\Form;
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

    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    protected function grid()
    {
        return Admin::grid(ExamGrids::class, function (Grid $grid) {
            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->like('name', '名称');
                $filter->like('desc', '描述');
                $filter->like('memo', '备注');
                $filter->equal('memo', '备注')->select([0 => '11']);
                $filter->like('memo', '备注');
                $filter->like('memo', '备注');
                $filter->like('memo', '备注');
                $filter->like('memo', '备注');
                $filter->like('memo', '备注');
                $filter->like('memo', '备注');
                $filter->like('memo', '备注');
            });
            $grid->column('id', '序号');
            $grid->column('name', '名称');
            $grid->column('desc', '描述');
            $grid->column('memo', '备注');
            $grid->column('lat', '经度');
            $grid->column('lng', '纬度');
        });
    }

    protected function form()
    {
        return Admin::form(ExamGrids::class, function (Form $form) {
            $form->text('name', 'name');
            $form->text('desc', 'desc');
            $form->text('memo', 'memo');
            $form->map('lat', 'lng', 'map');
        });
    }
}