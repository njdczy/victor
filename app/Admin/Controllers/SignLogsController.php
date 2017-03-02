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
            $grid->column('details','签到详情')->expand(function () {
                $the_sign_logs = SignLog::where('id', '=', $this->id)->pluck('id')->flatten()->all();
                $name = Vuser::whereIn($the_sign_logs)->pluck('name')->all();
                dump($name);exit;
                $rows = [
                    ['',' <b>签到人名单:</b>刘云山	▪ 刘延东	▪ 刘奇葆	▪ 许其亮▪ 孙春兰	▪ 孙政才	▪ 李克强	▪ 李建国▪ 李源潮	▪ 汪洋	▪ 张春贤	▪ 张高丽
                            ▪ 张德江	▪ 范长龙	▪ 孟建柱	▪ 赵乐际▪ 胡春华	▪ 俞正声	▪ 栗战书	▪ 郭金龙▪ 韩正▪ 刘延东	▪ 刘奇葆	▪ 许其亮▪ 孙春兰	▪ 孙政才	▪ 李克强	▪ 李建国▪ 李源潮	▪ 汪洋	▪ 张春贤	▪ 张高丽
                            ▪ 张德江	▪ 范长龙	▪ 孟建柱	▪ 赵乐际▪ 胡春华	▪ 俞正声	▪ 栗战书	▪ 郭金龙▪ 韩正▪ 刘延东	▪ 刘奇葆	▪ 许其亮▪ 孙春兰	▪ 孙政才	▪ 李克强	▪ 李建国▪ 李源潮	▪ 汪洋	▪ 张春贤	▪ 张高丽
                            ▪ 张德江	▪ 范长龙	▪ 孟建柱	▪ 赵乐际▪ 胡春华	▪ 俞正声	▪ 栗战书	▪ 郭金龙▪ 韩正▪ 刘延东	▪ 刘奇葆	▪ 许其亮▪ 孙春兰	▪ 孙政才	▪ 李克强	▪ 李建国▪ 李源潮	▪ 汪洋	▪ 张春贤	▪ 张高丽
                            ▪ 张德江	▪ 范长龙	▪ 孟建柱	▪ 赵乐际▪ 胡春华	▪ 俞正声	▪ 栗战书	▪ 郭金龙▪ 韩正▪ 刘延东	▪ 刘奇葆	▪ 许其亮▪ 孙春兰	▪ 孙政才	▪ 李克强	▪ 李建国▪ 李源潮	▪ 汪洋	▪ 张春贤	▪ 张高丽
                            ▪ 张德江	▪ 范长龙	▪ 孟建柱	▪ 赵乐际▪ 胡春华	▪ 俞正声	▪ 栗战书	▪ 郭金龙▪ 韩正']
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
