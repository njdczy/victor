<?php

namespace App\Admin\Controllers;

use Encore\Admin\Widgets\Chart\Bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Column;
use Encore\Admin\Widgets\Collapse;
use Encore\Admin\Layout\Row;
use Encore\Admin\Grid;

use Encore\Admin\Widgets\Box;

use App\SignLog;
use App\Conference;
use App\Vuser;
use Illuminate\Support\Facades\DB;

class EnterController extends Controller
{
    protected $id;
    public function __construct(Request $request)
    {
        $this->id = $request->input('id');
    }

    public function index()
    {

        return Admin::content(function (Content $content)  {
            $content->header('会议');
            $content->description('签到');

            $content->row(
                $this->grid()->render()
            );
            if (!$this->id) {

            } else {
                $content->row(function (Row $row) {
                    $row->column(4, function (Column $column) {
                    });
                });
                //  应签到人数 s
                $vcat_ids = DB::table('demo_taggables')
                    ->select('vcat_id')
                    ->where('taggable_id','=',$this->id)
                    ->get()
                    ->toArray();
                foreach ($vcat_ids as $k => $vcat_id) {
                    $in_array[] = $vcat_id->vcat_id;
                }
                $should_vuser_count = Vuser::whereIn('vcat_id',$in_array)->pluck('id','id')->count();
                $sign_vuser_count = Conference::select('sign_count')
                    ->where('id','=',$this->id)->first()->toArray();
                $should_vcat_count = DB::table('demo_taggables')
                    ->where('taggable_id','=',$this->id)
                    ->count();
                $sign_vcat_count = DB::table('demo_taggables')
                    ->where('taggable_id','=',$this->id)
                    ->where('is_sign','=',1)
                    ->count();
                // 应签到人数 e
                $box = new Box('统计', '
<span>应到人数:</span><b>'.$should_vuser_count.'</b>
<span>实到人数:</span><b>'.$sign_vuser_count['sign_count'].'</b><hr>
<span>应到家数:</span><b>'.$should_vcat_count.'</b>
<span>实到家数:</span><b>'.$sign_vcat_count.'</b>'
                );
                $content->row($box->style('primary'));
            }
        });
    }

    public function grid()
    {
        return Admin::grid(Conference::class, function (Grid $grid)  {
            $grid->disableExport();
            $grid->disableBatchDeletion();
            $grid->disableRowSelector();
            $grid->disableCreation();
            $grid->disableActions();
            $grid->disablePagination();
            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->equal('id', '会议名称')
                    ->select(function () {
                        return Conference::pluck('name','id');
                    });
            });
        });
    }
}
