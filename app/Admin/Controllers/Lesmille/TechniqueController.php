<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/21 0021
 * Time: 上午 10:45
 */

namespace App\Admin\Controllers\Lesmille;


use App\Admin\Controllers\Base;
use App\Admin\Models\LesmilleTech;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class TechniqueController extends Base
{
    private $header = '莱美';
    private $description = '技术';

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header($this->header);
            $content->description($this->description);
            $content->body($this->grid());
        });
    }

    public function grid()
    {
        return Admin::grid(LesmilleTech::class, function (Grid $grid) {
            $grid->model()->orderBy('id', 'desc');
            $grid->disableRowSelector();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->disableIdFilter();
                $filter->like('name', '动作')->placeholder('名称：深蹲');
                $filter->like('name_en', '动作(英文)')->placeholder('名称：SQUAT');
                $filter->equal('type', '课程类型')->select(LesmilleTech::$typeOption);
                $filter->like('target', '目标肌肉')->placeholder('肌肉：胸肌');
            });
            $grid->paginate(10);
            if (Admin::user()->isRole('lesmille')) {
                $grid->disableCreateButton();
                $grid->column('type', '课程类型');
                $grid->column('name', '动作名称');
                $grid->column('name_en', '动作(英文)');
                $grid->column('target', '目标肌肉');
                $grid->column('img_list', '演示图片')
                    ->image('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/', 100, 100);
                $grid->actions(function ($actions) {
                    $actions->disableDelete();
                });
            } else {
                $grid->column('type', '课程类型')->editable('select', LesmilleTech::$typeOption);
                $grid->column('name', '动作名称')->editable('text');
                $grid->column('name_en', '动作(英文)')->editable('text');
                $grid->column('target', '目标肌肉');
                $grid->column('img_list', '演示图片')
                    ->image('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/', 100, 100);
                $grid->column('updated_at', '更新时间');
//                $grid->column('position', '姿势')->editable('textarea');
//                $grid->column('execution', '轨迹')->editable('textarea');
//                $grid->column('layer2', '二层教授')->editable('textarea');
                $grid->actions(function ($actions) {
                    $actions->disableDelete();
                });
            }
        });
    }

    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header($this->header);
            $content->description($this->description);
            $content->body($this->form());
        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header($this->header);
            $content->description($this->header);
            $content->body($this->form()->edit($id));
        });
    }

    protected function form()
    {
        if (Admin::user()->isRole('lesmille')) {
            return Admin::form(LesmilleTech::class, function (Form $form) {
                $form->display('type', '课程名称');
                $form->display('name', '动作名称');
                $form->display('name_en', '动作名称(英文)');
                $form->display('target', '目标肌肉');
                $form->display('img_list', '演示图片')->with(function ($value) {
                    $return = '';
                    if (is_array($value)) {
                        foreach ($value as $item) {
                            $return = $return .
                                '<img src="' . 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/' . $item . '" >';
                        }
                    }
                    return $return;
                });
                $form->display('position', '姿势');
                $form->display('execution', '轨迹');
                $form->display('layer2', '二层教授');
//                $form->textarea('position', '姿势')->attribute(['readOnly' => 'true'])->rows(10);
                $form->disableReset();
                $form->disableSubmit();
            });
        } else {
            return Admin::form(LesmilleTech::class, function (Form $form) {
                $form->select('type', '课程名称')->options(LesmilleTech::$typeOption);
                $form->text('name', '动作名称');
                $form->text('name_en', '动作名称(英文)');
                $form->text('target', '动作名称(英文)');
                $form->editor('position', '姿势')->placeholder('姿势建立');
                $form->editor('execution', '轨迹')->placeholder('执行建立');
                $form->editor('layer2', '二层教授');
                $form->multipleImage('img_list', '演示图片')
                    ->uniqueName()->rules('mimes:jpg,jepg');
                $form->disableReset();
            });
        }

    }
}