<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/3 0003
 * Time: 上午 9:42
 */

namespace App\Admin\Controllers;

use App\Admin\Models\QuestionDictionary;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Log;

class QuestionDictionaryController extends Base
{
    private $header = '问卷';
    private $description = '字典';

    public function index()
    {

        return Admin::content(function (Content $content) {

            $content->header($this->header);
            $content->description($this->description);

            $content->body($this->grid());
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

    protected function grid()
    {
        return Admin::grid(QuestionDictionary::class, function (Grid $grid) {
            $grid->disableExport();
            $grid->disableRowSelector();
            $grid->filter(function ($filter) {
                $filter->disableIdFilter();// 去掉默认的id过滤器
            });
            $level = $grid->model()->level;
            $list = QuestionDictionary::where('level', $level)->pluck('id', 'attr_name');
            $grid->column('id', '序号');
            $grid->column('type', '分类');
            $grid->column('parent_id', '上级节点')
                ->editable('select',$list);
            $grid->column('attr_name', '名称')->editable('text');
            $grid->column('attr_value', '属性')->editable('text');
            $grid->column('level', '等级')->display(function () {
                return QuestionDictionary::$level[$this->level];
            });
            $grid->column('memo', '备注');
        });
    }

    protected function form()
    {
        return Admin::form(QuestionDictionary::class, function (Form $form) {
            list($id, $data) = $this->getEditId('questionDictionary', QuestionDictionary::class);
            $form->setTitle('添加属性');
            $form->tools(function (Form\Tools $tools) {
                // 去掉返回按钮
                $tools->disableBackButton();
                // 去掉跳转列表按钮
                $tools->disableListButton();
                // 添加一个按钮, 参数可以是字符串, 或者实现了Renderable或Htmlable接口的对象实例
                $tools->add('<a class="btn btn-sm btn-info" href="' . admin_url('questionDictionary') . '"><i class="fa fa-undo"></i>&nbsp;&nbsp;返回</a>');
            });
//            $form->display('id', '编号');
            $form->hidden('type', '分类')->setWidth(8, 2);
            $form->text('attr_name', '名称')->setWidth(8, 2);
            $form->text('attr_value', '属性')->setWidth(8, 2);
            $form->select('level', '等级')->options(QuestionDictionary::$level)
                ->load('parent_id', admin_url('/questionDictionary/child'))->setWidth(8, 2);
            $form->select('parent_id', '所属')->options()->setWidth(8, 2);
            $form->text('memo', '备注')->setWidth(8, 2);
            $form->saving(function (Form $form) {
                $input = request()->all();
                if (isset($input['parent_id'])) {
                    $type_name = QuestionDictionary::typeName($input['parent_id']);
                    $form->input('type', $type_name);
                }
            });
        });
    }


    /**
     * select联动获取下拉列表
     * @return array
     */
    public function child()
    {
        $res = [];
        if (request()->get('q')) {
            $level = request()->get('q') - 1;
            $list = QuestionDictionary::where('level', $level)->get()->toArray();
            foreach ($list as $item) {
                $res[] = [
                    'id' => $item['id'],
                    'text' => $item['attr_name']
                ];
            }
        }
        return $res;
    }
}