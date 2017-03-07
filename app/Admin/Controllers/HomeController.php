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
use Encore\Admin\Widgets\Chart\Bar;
use Encore\Admin\Widgets\Chart\Doughnut;
use Encore\Admin\Widgets\Chart\Line;
use Encore\Admin\Widgets\Chart\Pie;
use Encore\Admin\Widgets\Chart\PolarArea;
use Encore\Admin\Widgets\Chart\Radar;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;



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

            $content->row(function (Row $row) {

                $row->column(6, function (Column $column) {


                    $collapse = new Collapse();

                    $bar = new Bar(
                        ["January", "February", "March", "April", "May", "June", "July"],
                        [
                            ['First', [40,56,67,23,10,45,78]],
                            ['Second', [93,23,12,23,75,21,88]],
                            ['Third', [33,82,34,56,87,12,56]],
                            ['Forth', [34,25,67,12,48,91,16]],
                        ]
                    );
                    $collapse->add('Bar', $bar);
                    $column->append($collapse);

                });


            });

        });
    }
}
