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
            $grid->disableRowSelector();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->disableIdFilter();
                $filter->like('name', '动作')->placeholder('技术动作名称：深蹲');
            });
            $grid->column('id', 'ID');
            $grid->column('name', '动作名称')->editable('text')->label('info');
//            $grid->img_list('演示图片')
//                ->image('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/', 100, 100)
//                ->ThumbnailToImg();
            $grid->column('img_list', '演示图片')
                ->image('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/', 100, 100);
//                ->ThumbnailToImg();
            $grid->column('position', '姿势')->editable('textarea');
            $grid->column('execution', '轨迹')->editable('textarea');
            $grid->column('layer2', '二层教授')->editable('textarea');
            $grid->actions(function ($actions) {
                $actions->disableDelete();
//                $actions->disableEdit();
            });
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
        return Admin::form(LesmilleTech::class, function (Form $form) {
            $form->text('name', '动作名称');
            $form->textarea('position', '姿势')->placeholder('姿势建立');
            $form->textarea('execution', '轨迹')->placeholder('执行建立');
            $form->textarea('layer2', '二层教授');
            $form->multipleImage('img_list', '演示图片')->uniqueName();
        });
    }
}