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
            //tab页
            $form->tab('基础使用', function ($form) {
                $form->text('设置保存值')->value('text...');
                //设置默认值
                $form->text('设置默认值')->default('text...');
                //设置help信息
                $form->text('设置help信息')->help('help...');
                //设置属性
                $form->text('设置属性')->attribute(['data-title' => 'title...']);
                //设置placeholder
                $form->text('设置placeholder')->placeholder('请输入。。。');
                //文本框输入
//                $form->text($column, [$label]);
                //textarea输入框
                $form->textarea('name4', 'textarea输入框')->rows(10);
                //隐藏域
                $form->hidden('hidden');
                //显示字段
                $value = '';
                $form->display('display', '显示字段')->with(function () use ($value) {
                    return "<img src=" . $value . " />";
                });
                //分割线
                $form->divide();
                //标签
                $form->tags('keywords','标签');
                //Html
                $form->html('你的html内容', $label = '');
                //图标
                $form->icon('icon');
            })->tab('选择器', function ($form) {
                /*                select选择框
                                从api中获取选项列表:
                                [
                                    {
                                        "id": 9,
                                        "text": "xxx"
                                    },
                                    {
                                        "id": 21,
                                        "text": "xxx"
                                    },
                                    ...
                                ]
                                $form->select($column[, $label])->options('/api/users');

                                ajax方式动态分页载入选项
                                $form->select('user_id')->options(function ($id) {
                                    $user = User::find($id);

                                    if ($user) {
                                        return [$user->id => $user->name];
                                    }
                                })->ajax('/admin/api/users');

                                多级联动
                                $form->select('province')->options(...)->load('city', '/api/city');
                                $form->select('city');
                                */

                $form->select('name1', 'select选择框')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
                //多选框
                $form->multipleSelect('name2', '多选框')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
                //listbox
                $form->listbox('name3', 'listbox')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);

                //checkbox选择
                $form->checkbox('name5', 'checkbox选择')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
                //滑动选择控件
                $form->slider('slider', '滑动选择控件')->options(['max' => 100, 'min' => 1, 'step' => 1, 'postfix' => 'years old']);
                //开关选择
                $states = [
                    'on' => ['value' => 1, 'text' => '打开', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
                ];

                $form->switch('switch', '开关选择')->states($states);
            })->tab('特定输入框', function ($form) {
                //email个数输入框
                $form->email('email', 'email个数输入框');
                //密码输入框
                $form->password('password', '密码输入框');
                //url输入框
                $form->url('url', 'url输入框');
                //ip输入框
                $form->ip('ip', 'ip输入框');
                //电话号码输入框
                $form->mobile('mobile', '电话号码输入框')->options(['mask' => '999 9999 9999']);
                //颜色选择框
                $form->color('color', '颜色选择框')->default('#ccc');
                //时间输入框 设置时间格式，更多格式参考http://momentjs.com/docs/#/displaying/format/
                $form->time('time', '时间输入框')->format('HH:mm:ss');
                //日期时间输入框
                $form->datetime('datetime', '日期时间输入框')->format('YYYY-MM-DD HH:mm:ss');
//                $form->timeRange('timeRange', '时间范围选择框')->format('YYYY-MM-DD HH:mm:ss');

                //货币输入框 设置单位符号
                $form->currency('currency', '货币输入框')->symbol('￥');

                //数字输入框
                $form->number('number', '数字输入框')->min(0)->max(100);
                //比例输入框
                $form->rate('rate', '比例输入框');

            })->tab('文件上传', function ($form) {
                //图片上传
                $form->image('image', '图片上传')->removable();
                // 多图
                $form->multipleImage('multipleImage', '多图')->removable();
                //文件上传
                $form->file('file', '文件上传')->removable()->rules('mimes:doc,docx,xlsx');
                // 多文件
                $form->multipleFile('multipleFile', '多文件')->removable();


            })->tab('地图', function ($form) {
                //设置地图
                $form->map('11', '22', 'name');
//                $form->hasMany('jobs', function ($form) {
//                    $form->text('company');
//                    $form->date('start_date');
//                    $form->date('end_date');
//                });
            });

        });
    }
}