<?php

namespace App\Admin\Controllers;

use App\Conference;
use App\Http\Controllers\Controller;
use App\Vuser;
use App\Vcat;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;



class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Dashboard');
            $content->description('网站数据为假数据');

            $content->row(function ($row) {
                $vuser_count = Vuser::count();
                $conference_count = Conference::count();
                $sign_count = Vuser::where('is_sign', '=', 1)->count();
                $sign_vcat_count = Vcat::where('is_sign', '=', 1)->count();
                $row->column(3, new InfoBox('人员总数', 'users', 'aqua', '/admin/vusers',$vuser_count));
                $row->column(3, new InfoBox('会议数', 'calendar', 'green', '/admin/conferences', $conference_count));
                $row->column(3, new InfoBox('已报到人数', 'book', 'yellow', '/admin/sign', $sign_count));
                $row->column(3, new InfoBox('已报到家数', 'file', 'red', '/admin/sign', $sign_vcat_count));
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

                $box = new Box('第二个容器',
                    '<p>邀请您参加订货会</p>
                     <hr>
                    <button>发送短信</button>'
                );
                $row->column(2,function(){});
                $row->column(8,$box->style('primary'));
            });


        });
    }
}
