<?php

namespace App\Admin\Controllers;

use App\Conference;
use App\Http\Controllers\Controller;
use App\Vuser;
use App\Vcat;
use App\Province;
use App\Post;
use App\Salesman;
use App\Manager;
use App\Hotel;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;

use Excel;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('VICTOR');
            $content->description('会议签到系统');

            $content->row(function ($row) {
                $vuser_count = Vuser::count();
                $conference_count = Conference::count();
//                $sign_count = Vuser::where('is_sign', '=', 1)->count();
//                $sign_vcat_count = Vcat::where('is_sign', '=', 1)->count();
                $row->column(2,function(){});
                $row->column(3, new InfoBox('人员总数', 'users', 'aqua', '/admin/vusers',$vuser_count));
                $row->column(2,function(){});
                $row->column(3, new InfoBox('会议数', 'calendar', 'green', '/admin/conferences', $conference_count));
//                $row->column(3, new InfoBox('已报到人数', 'book', 'yellow', '/admin/sign', $sign_count));
//                $row->column(3, new InfoBox('已报到家数', 'file', 'red', '/admin/sign', $sign_vcat_count));
            });



            $content->row(function ($row)  {
//                $form = new Form();
//                $form->disableReset();
//                $form->disableSubmit();
//
//                $form->textarea('sms_content','短信内容')
//                    ->attribute('disabled', 'disabled')
//                    ->placeholder('邀请您参加订货会');
//                //$form->divide();
//
//                $box = new Box('第二个容器',
//                    '<p>邀请您参加订货会</p>
//                     <hr>
//                    <button>发送短信</button>'
//                );
//                $row->column(2,function(){});
//                $row->column(8,$box->style('primary'));
            });


        });
    }

    public function import()
    {
        $filePath = 'storage/import/'. '3'.'.xls';
        $tabl_name = date('YmdHis').mt_rand(100,999);
        Excel::load($filePath, function($reader) use ($tabl_name) {
            $reader = $reader->getSheet(0);
            $data = $reader->toArray();
            unset($data[0]);
            $vcat_values_array = array_unique(array_column($data,3));
            $provice_values_array = array_unique(array_column($data,4));
            $post_values_array = array_unique(array_column($data,6));
            $hotel_values_array = array_unique(array_column($data,10));
            $salesman_values_array = array_unique(array_column($data,12));
            $manager_values_array = array_unique(array_column($data,13));

            $vcat_ids_array = Vcat::whereIn('title', $vcat_values_array)->pluck('id', 'title')->all();

            $province_id_array = Province::whereIn('name', $provice_values_array)->pluck('id', 'name')->all();
            $post_id_array = Post::whereIn('name', $post_values_array)->pluck('id', 'name')->all();
            $salesman_id_array = Salesman::whereIn('name', $salesman_values_array)->pluck('id', 'name')->all();
            $regional_manager_id_array = Manager::whereIn('name', $manager_values_array)->pluck('id', 'name')->all();
            $hotel_id_array = Hotel::whereIn('name', $hotel_values_array)->pluck('id', 'name')->all();


            foreach ($data as $key => $value) {
                $import = [];
                $import['number'] = $value[0];
                $import['card'] = $value[1]?$value[1]:000000;
                $import['vcat_id'] = $vcat_ids_array[$value[3]];
                $import['province_id'] = $value[4]?$province_id_array[$value[4]]:'';
                $import['name'] = $value[5];
                $import['post_id'] = $value[6]?$post_id_array[$value[6]]:'';
                $import['mobile'] = intval($value[7]);
                $import['code'] = intval($value[8]);
                $import['company'] = $value[9];
                $import['hotel'] = $value[10]?$hotel_id_array[$value[10]]:'';
                $import['has_attend'] = $value[11] == '是'?1:0;
                $import['salesman_id'] = $value[12]?$salesman_id_array[$value[12]]:'';
                $import['regional_manager_id'] = $value[13]?$regional_manager_id_array[$value[13]]:'';
                $import['is_need_sms'] = $value[11] == '是'?1:0;
                $import_data[] = $import;
            }
            DB::table('vusers')->insert($import_data);exit;
        });

    }

}
