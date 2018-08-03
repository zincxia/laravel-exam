<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/1 0001
 * Time: 下午 2:25
 */

namespace App\Admin\Controllers;

use App\Admin\Models\QuestionSm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class QuestionnaireController extends Base
{
    private $header = '问卷';

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header($this->header);
//            $content->description('description');

            $content->body($this->grid());
        });
    }


    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header($this->header);
            $content->description('description');

            $content->body($this->form());
        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header($this->header);
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    protected function grid()
    {
        return Admin::grid(QuestionSm::class, function (Grid $grid) {
            $grid->disableExport();
            $grid->disableRowSelector();
            $grid->filter(function ($filter) {
                $filter->disableIdFilter();// 去掉默认的id过滤器
            });
            $grid->column('id', '序号');
            $grid->column('question_id', '编号');
            $grid->column('qq', 'QQ');
            $grid->column('wechat', '微信');
            $grid->column('age', '年龄');
            $grid->column('height', '身高');
            $grid->column('weight', '体重');
            $grid->column('memo', '备注');
        });
    }

    protected function form()
    {
        return Admin::form(QuestionSm::class, function (Form $form) {
            $form->setTitle('填写');
            $form->tools(function (Form\Tools $tools) {
                // 去掉返回按钮
                $tools->disableBackButton();
                // 去掉跳转列表按钮
                $tools->disableListButton();
                // 添加一个按钮, 参数可以是字符串, 或者实现了Renderable或Htmlable接口的对象实例
                $tools->add('<a class="btn btn-sm btn-info" href="' . admin_url('produceUnitInfo') . '"><i class="fa fa-undo"></i>&nbsp;&nbsp;返回</a>');
            });
            $form->row(function (Form\Row $row) {
                $row->hidden('question_id', '编号');
                $row->width(2)->text('qq', 'QQ号');
                $row->width(2)->text('wechat', '微信账号');
                $row->width(2)->text('age', '年龄');
                $row->width(2)->text('height', '身高');
                $row->width(2)->text('weight', '体重');
            });
            $form->row(function(Form\Row $row){
                $row->width(12)->divider();
                $row->width(12)->multipleSelect('qq1', 'QQ号')->options(QuestionSm::$sex);
                $row->width(12)->listbox('wechat2', '微信账号')->options(QuestionSm::$sex);
                $row->width(12)->checkbox('age3', '年龄')->options(QuestionSm::$sex);
                $row->width(12)->multipleLevelSelect('height4', '身高')->options(QuestionSm::$sex);
                $row->width(12)->rate('weight1', '体重');
                $row->width(12)->multipleSelect('weight5', '体重')->options(QuestionSm::$sex);
            });
        });
    }
}