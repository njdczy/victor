<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-03-10
 * Time: 下午 4:45
 */
class CustomExporter extends AbstractExporter
{
    public function export()
    {
        $filename = $this->getTable().'.csv';

        dump($this->getData());
        // 这里获取数据
        //dd($this->getData());

//        // 根据上面的数据拼接出导出数据，
//        $output = '';
//
//        // 在这里控制你想输出的格式,或者使用第三方库导出Excel文件
//        $headers = [
//            'Content-Encoding'    => 'UTF-8',
//            'Content-Type'        => 'text/csv;charset=UTF-8',
//            'Content-Disposition' => "attachment; filename=\"$filename\"",
//        ];
//
//        // 导出文件，
//        response(rtrim($output, "\n"), 200, $headers)->send();
        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        dump($cellData);exit;
        Excel::create('学生成绩',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
        exit;
    }
}