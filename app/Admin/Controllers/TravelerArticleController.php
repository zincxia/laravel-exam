<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/30
 * Time: 14:24
 */

namespace App\Admin\Controllers;


use App\Admin\Models\TravelerArticle;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;

class TravelerArticleController extends Base
{
    private $header = '旅行';
    private $description = '文章';

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
        return Admin::grid(TravelerArticle::class, function (Grid $grid) {
            $grid->model()->orderBy('id', 'desc');
            $grid->disableRowSelector();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->disableIdFilter();

            });
            $grid->column('id', '文章编号');
            $grid->column('title', '标题');
            $grid->column('advertisement_img', '文章图片')
                ->image('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . '/', 100, 100);
            $grid->column('category', '分类');
            $grid->column('tag', '标签');
            $grid->column('created_at', '创建时间');
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableView();
            });
            $grid->paginate(10);
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

    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header($this->header);
            $content->description($this->header);
            $content->body($this->form()->edit($id));
        });
    }

    protected function form()
    {
        return Admin::form(TravelerArticle::class, function (Form $form) {
            $form->tools(function (Form\Tools $tools) {
                // 去掉返回按钮
                $tools->disableView();
                $tools->disableDelete();
            });
            $form->text('title', '文章标题');
            $form->image('advertisement_img', '广告图')->uniqueName()->removable();
            $form->text('category_id', '分类');
            $form->text('tag_id', '标签');
//            $form->editor('content', '文章内容');
            $form->summernote('content', '文章内容');
            $form->disableReset();
        });
    }


}