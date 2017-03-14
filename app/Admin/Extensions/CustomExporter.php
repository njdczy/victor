<?php

namespace App\Admin\Extensions;

use App\Hotel;
use App\Manager;
use App\Post;
use App\Province;
use App\Salesman;
use App\Vcat;
use Carbon\Carbon;
use Encore\Admin\Grid\Exporters\AbstractExporter;
use Excel;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-03-10
 * Time: 下午 4:45
 */
class CustomExporter extends AbstractExporter
{
    private $execl_title = [
        '参会人员编号',
        '卡片号码',
        '类别',
        '部门',
        '省',
        '参会人员',
        '职务',
        '手机号',
        '客户编码',
        '客户',
        '入住饭店',
        '是否参加过会议',
        '业务员',
        '区域经理',
        '是否推送短信',
    ];

    public function export()
    {
        $data = $this->getData();
        $vcat_id_array = array_unique(array_column($data, 'vcat_id'));
        $province_id_array = array_unique(array_column($data, 'province_id'));
        $post_id_array = array_unique(array_column($data, 'post_id'));
        $salesman_id_array = array_unique(array_column($data, 'salesman_id'));
        $regional_manager_id_array = array_unique(array_column($data, 'regional_manager_id'));
        $hotel_id_array = array_unique(array_column($data, 'hotel'));

        $vcat_values_array = Vcat::whereIn('id', $vcat_id_array)->pluck('title', 'id')->all();

        $vcat_parent_ids_array = Vcat::whereIn('id', $vcat_id_array)->pluck('parent_id', 'id')->all();
        $vcat_parent_values_array = Vcat::whereIn('id', $vcat_parent_ids_array)->pluck('title', 'id')->all();

        $province_values_array = Province::whereIn('id', $province_id_array)->pluck('name', 'id')->all();
        $post_values_array = Post::whereIn('id', $post_id_array)->pluck('name', 'id')->all();
        $salesman_values_array = Salesman::whereIn('id', $salesman_id_array)->pluck('name', 'id')->all();
        $manager_values_array = Manager::whereIn('id', $regional_manager_id_array)->pluck('name', 'id')->all();
        $hotel_values_array = Hotel::whereIn('id', $hotel_id_array)->pluck('name', 'id')->all();

        $export_data[] = $this->execl_title;
        foreach ($data as $key => $value) {
            $export = [];
            $export[] = $value['number']; //参会人员编号
            $export[] = $value['card']; //卡片号码
            $export[] = $vcat_parent_values_array[$vcat_parent_ids_array[$value['vcat_id']]]; //类别
            $export[] = $value['vcat_id']?$vcat_values_array[$value['vcat_id']]:'';                    //部门
            $export[] = $value['province_id']?$province_values_array[$value['province_id']]:'';                    //省
            $export[] = $value['name'];                                           //参会人员
            $export[] = $value['post_id']?$post_values_array[$value['post_id']]:'';                 //职务
            $export[] = $value['mobile'];                   //手机号
            $export[] = $value['code'];                   //客户编码
            $export[] = $value['company'];                   //客户
            $export[] = $value['hotel']?$hotel_values_array[$value['hotel']]:'';                   //入住饭店
            $export[] = $value['has_attend'] ? '是' : '否';                   //是否参加过会议
            $export[] = $value['salesman_id']?$salesman_values_array[$value['salesman_id']]:'';                   //业务员
            $export[] = $value['regional_manager_id']?$manager_values_array[$value['regional_manager_id']]:'';                   //区域经理
            $export[] = $value['is_need_sms'] ? '是' : '否';                   //是否推送短信
            $export_data[] = $export;
        }

        Excel::create('经销商报名资料' . Carbon::now()->toDateTimeString(), function ($excel) use ($export_data) {
            $excel->sheet('score', function ($sheet) use ($export_data) {
                $sheet->rows($export_data);
            });
        })->export('xls');
        exit;
    }
}