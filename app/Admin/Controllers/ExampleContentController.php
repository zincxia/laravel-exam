<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/20 0020
 * Time: 下午 2:26
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Table;

class ExampleContentController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('标题');
            $content->description('描述');

            $content->body(function (Row $row) {
                $row->column(6, function (Column $column) {
                    $column->row('
                        <table border="1">
                        <tr>
                        <th>Month</th>
                        <th>Savings</th>
                        </tr>
                        <tr>
                        <td>January</td>
                        <td>$100</td>
                        </tr>
                        </table>
                    ');
                    $column->row('222');
                    $column->row(function (Row $row) {
                        $row->column(6, '444');
                        $row->column(6, '555');
                    });
                });

                $row->column(6, function (Column $column) {
                    $column->row('111');
                    $column->row('222');
                    $column->row(function (Row $row) {
                        $row->column(6, '444');
                        $row->column(6, '555');
                    });
                });
            });


        });
    }

}