<?php
/**
 * Created by PhpStorm.
 * User: BORUI
 * Date: 2018/8/6 0006
 * Time: 下午 2:41
 */

namespace App\Admin\Extensions;


use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExpoter extends AbstractExporter
{
    public function export()
    {
        Excel::create('Filename', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {

                // 这段逻辑是从表格数据中取出需要导出的字段
                $rows = collect($this->getData())->map(function ($item) {
                    return array_only($item, ['id', 'title', 'content', 'rate', 'keywords']);
                });
                $sheet->rows($rows);
            });

        })->export('xls');
    }
}