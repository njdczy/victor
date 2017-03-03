<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Grid;

use App\SignLog;
use App\Conference;
use App\Vuser;
use App\Vcat;

class SignLogsController extends Controller
{
    public function index()
    {
        $sign_count = Vuser::where('is_sign', '=', 1)->count();
        $sign_vcat_count = Vcat::where('is_sign', '=', 1)->count();
        return Admin::content(function (Content $content) use ($sign_count, $sign_vcat_count) {
            $content->header('会议');
            $content->description('签到记录');
            $content->body(

                new Box(
                   '总实际报到人数(' . $sign_count .
                   ')总实际报到家数( ' . $sign_vcat_count .
                   ')-------tips:只要有一次会议签到即视为已报到', $this->grid()
                )
            );
        });
    }

    protected function grid()
    {
        return Admin::grid(Conference::class, function (Grid $grid) {
            $grid->column('time','会议时间')->display(function () {
                return $this->date . ' ' . $this->start_time.'-'.$this->end_time;
            });
            $grid->name('会议名称');
            $grid->sign_count('签到人数');
            $grid->sign_vcat_count('签到家数');
            $tmp = SignLog::select('vuser_id','conference_id')->get()->toArray();
            $conference_ids_array = array_unique(array_column($tmp, 'conference_id'));
            foreach ($conference_ids_array as $conference_id) {
                $the_tmp = [];
                foreach ($tmp as $key => $value) {
                    if($value['conference_id'] == $conference_id){
                        array_push($the_tmp,$value['vuser_id']);
                    }
                }
                $array[$conference_id] = $the_tmp;
            }
            $grid->column('details','签到详情')->expand(function () use ($array) {
            $name = Vuser::whereIn('id',$array[$this->id])->pluck('name')->all();
                $rows = [
                    ['',' <b>签到人名单&nbsp;:</b>&nbsp;' . implode(' ▪ ',$name)]
                ];
                return new Table([], $rows);

            }, 'details');
            $grid->disableExport();
            $grid->disableBatchDeletion();
            $grid->disableRowSelector();
            $grid->disableFilter();
            $grid->disableCreation();
            $grid->disableActions();
            $grid->disablePagination();
        });
    }
}
