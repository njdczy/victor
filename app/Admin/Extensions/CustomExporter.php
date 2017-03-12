<?php

namespace App\Admin\Extensions;

use App\Hotel;
use App\Manager;
use App\Post;
use App\Province;
use App\Salesman;
use App\Vcat;
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
    private $en_to_cn = [
        "vcat_id" => '',
        "province_id" => 37,
        "name" => "jupton",
        "post_id" => 1,
        "mobile" => "14398725601",
        "code" => "81432675",
        "card" => "72518436",
        "company" => "Veum-Weissnat",
        "has_attend" => 0,
        "salesman_id" => 1,
        "regional_manager_id" => 3,
        "is_need_sms" => 1,
        "has_sms" => 0,
        "is_enter" => 0,
        "is_sign" => 0,
        "hotel" => "Braun, Pollich and Baumbach",
        "gravatar" => null,
        "deleted_at" => null,
        "created_at" => "2017-03-10 05:41:21",
        "updated_at" => "2017-03-10 05:41:21",
    ];
    public function export()
    {
        $filename = $this->getTable().'.csv';

        $data = $this->getData();
        $vcat_id_array = array_unique(array_column($data, 'vcat_id'));
        $province_id_array = array_unique(array_column($data, 'province_id'));
        $post_id_array = array_unique(array_column($data, 'post_id'));
        $salesman_id_array = array_unique(array_column($data, 'salesman_id'));
        $regional_manager_id_array = array_unique(array_column($data, 'regional_manager_id'));
        $hotel_id_array = array_unique(array_column($data, 'hotel'));

        $vcat_values_array = Vcat::whereIn('id',$vcat_id_array)->pluck('title','id')->all();
        $province_values_array = Province::whereIn('id',$province_id_array)->pluck('name','id')->all();
        $post_values_array = Post::whereIn('id',$post_id_array)->pluck('name','id')->all();
        $salesman_values_array = Salesman::whereIn('id',$salesman_id_array)->pluck('name','id')->all();
        $manager_values_array = Manager::whereIn('id',$regional_manager_id_array)->pluck('name','id')->all();
        $hotel_values_array = Hotel::whereIn('id',$hotel_id_array)->pluck('name','id')->all();

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