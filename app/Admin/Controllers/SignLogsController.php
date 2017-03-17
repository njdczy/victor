<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;

use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Grid;

use Illuminate\Http\Request;
use Encore\Admin\Widgets\Collapse;
use App\Admin\Extensions\CustomExporter;

use App\SignLog;
use App\Conference;
use App\Vuser;
use App\Vcat;
use Illuminate\Support\Facades\DB;

class SignLogsController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->input('id');
        return Admin::content(function (Content $content) use ($id) {
            $content->header('会议');
            $content->description('签到记录');

            $content->row(
                $this->grid($id)->render()
            );
            if (!$id) {
                $content->row(function (Row $row) {
//                    $row->column(4, function (Column $column) {});
//                    $row->column(4, function (Column $column) {
//                        $vuser_count = Vuser::count();
//                        $sign_count = Vuser::where('is_sign', '=', 1)->count();
//                        $vcat_count = Vcat::count();
//                        $first_ids = Vcat::where('parent_id', '=', 0)->pluck('id');
//                        foreach ($first_ids as $first_id) {
//                            $tmp_count = Vcat::where('parent_id', '=', $first_id)->count();
//                            if ($tmp_count){
//                                $vcat_count--;
//                            }
//                        }
//                        $sign_vcat_count = Vcat::where('is_sign', '=', 1)->count();
//                        $collapse = new Collapse();
//                        $bar = new Bar(
//                            ["应到总人数", "实到总人数", "应到总家数", "实到总家数"],
//                            [
//                                ['First', [$vuser_count,$sign_count,$vcat_count,$sign_vcat_count]],
//                            ]
//                        );
//                        $collapse->add('【家数】释义：人员类别中 （子分类总数 + 没有子类的类别数）', $bar);
//                        $column->append($collapse);
//
//                    });

//                    $row->column(12, function (Column $column) {
//                        $res = Conference::select('name', 'should_ids', 'sign_ids')
//                            ->get()->toArray();
//                        $conference_names_array = array_column($res, 'name');
//                        $collapse = new Collapse();
//
//                        $bar = new Bar(
//                            $conference_names_array,
//                            [
//                                ['1', [40,56,67,23,10,45,78]],
//                                ['2', [93,23,12,23,75,21,88]],
//                                ['3', [33,82,34,56,87,12,56]],
//                                ['4', [34,25,67,12,48,91,16]],
//                            ]
//                        );
//                        $collapse->add('Bar', $bar);
//                        $column->append($collapse);
//
//                    });
                });
            }
        });
    }

    protected function grid($id = 0)
    {
        return Admin::grid(Conference::class, function (Grid $grid) use ($id)  {
            if ($id) {
                $grid->column('time','会议时间')->display(function () {
                    return  $this->start_time.'-'.$this->end_time;
                });


                $grid->name('会议名称');
                $grid->column('should_vuser_ids','应签到人数')->display(function ()  {
                    //  应签到人数 s
                    $vcat_ids = DB::table('demo_taggables')
                        ->select('vcat_id')
                        ->where('taggable_id','=',$this->id)
                        ->get()
                        ->toArray();
                    foreach ($vcat_ids as $k => $vcat_id) {
                        $in_array[] = $vcat_id->vcat_id;
                    }
                    return $count = Vuser::whereIn('vcat_id',$in_array)->pluck('id','id')->count();
                    // 应签到人数 e
                });
                $grid->sign_count('实签到人数');
                $grid->should_vcat_ids('应签到家数')->display(function () {
                    return DB::table('demo_taggables')->where('taggable_id','=',$this->id)->count();
                    //return $this->should_vcat_ids?count(explode($this->should_vcat_ids,',')):0;
                });
                $grid->sign_vcat_ids('实签到家数')->display(function () {
                    return DB::table('demo_taggables')
                        ->where('taggable_id','=',$this->id)
                        ->where('is_sign','=',1)
                        ->count();
                    //return $this->should_vcat_ids?count(explode($this->sign_vcat_ids,',')):0;
                });

//                foreach ($conference_ids_array as $conference_id) {
//                    $the_tmp = [];
//                    foreach ($tmp as $key => $value) {
//                        if($value['conference_id'] == $conference_id){
//                            array_push($the_tmp,$value['vuser_id']);
//                        }
//                    }
//                    $array[$conference_id] = $the_tmp;
//                }

                $tmp = SignLog::select('vuser_id')
                    ->where('conference_id','=',$id)->get()->toArray();
                $vuser_ids_array = array_column($tmp, 'vuser_id');

                $grid->column('details','签到详情')->expand(function () use ($vuser_ids_array) {
                    if (is_array($vuser_ids_array)) {
                        $name = Vuser::whereIn('id',$vuser_ids_array)->pluck('name')->all();
                        $rows = [
                            ['',' <b>签到人名单&nbsp;:</b>&nbsp;' . implode(' ▪ ',$name)]
                        ];
                        return new Table([], $rows);
                    }
                }, 'details');
            }
            if ($vuser_ids_array){
                $grid->exporter(new CustomExporter($vuser_ids_array));
            } else {
                $grid->disableExport();
            }
            $grid->disableBatchDeletion();
            $grid->disableRowSelector();
            $grid->disableCreation();
            $grid->disableActions();
            $grid->disablePagination();
            $grid->filter(function ($filter)  {
                $filter->disableIdFilter();
                $filter->equal('id', '会议名称')
                    ->select(function () {
                        if (Admin::user()->id == 1) {
                            return Conference::pluck('name','id');
                        }
                        return Conference::where('name','like',Admin::user()->name.'%')->pluck('name','id');
                    });
            });
        });
    }
}
