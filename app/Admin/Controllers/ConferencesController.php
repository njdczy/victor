<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;

use App\Vcat;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Form;
use Encore\Admin\Grid;

use Encore\Admin\Controllers\ModelForm;

use App\Conference;

class ConferencesController extends Controller
{
    use ModelForm;

    public function index()
    {
//        $date = Conference::pluck('date', 'date')
//            ->flatten(1)
//            ->all();

        return Admin::content(function (Content $content) {
            $content->header('会议');
            $content->description('列表');
            $content->row(
                $this->grid()
            );
        });
    }

    protected function grid()
    {
        return Admin::grid(Conference::class, function (Grid $grid) {
            $grid->column('time', '时间')->display(function () {
                return $this->start_time . '一一' . $this->end_time;
            });
            $grid->name('名称');
            $grid->description('地点')->display(
                function ($description) {
                    return '<pre>' . $description . '</pre>';
                }
            );
            $grid->vcats('参加该会议的单位')->pluck('title')->display(function ($vcats) {
                $html = '<div style="" class="col-sm-2">';
                foreach (collect($vcats) as $key => $value) {
                    if (fmod($key,4) == 0) {
                        $html .="<br>";

                    }
                    $html .= '<span class="label label-success" style="margin-top: 3px">' . $value . '</span>&nbsp;';
                }
                $html .= '</div>';
                return $html;
            });
            //$grid->vcats('参加该会议的单位')->pluck('title')->label();
            if (Admin::user()->id != 1) {
                if (Admin::user()->name != 'VICTOR') {
                    $grid->model()->where('name', 'like', Admin::user()->name . '%');
                }
                $grid->disableActions();
                $grid->disableCreation();
            }
            $grid->disableExport();
            $grid->disableBatchDeletion();
            $grid->disableRowSelector();
            $grid->disableFilter();
        });
    }

    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('');
            $content->description('');
            $content->body($this->form());
        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('');
            $content->description(trans('admin::lang.edit'));
            $content->body($this->form()->edit($id));
        });
    }

    protected function form()
    {
        return Conference::form(function (Form $form) {
            $form->dateTimeRange('start_time', 'end_time', '时间范围');
            $form->text('name', '名称')->rules('required');
            $form->textarea('description', '地点')->placeholder('输入会议描述或地点（每句话结束请换行）')->rules('required');
            $form->multipleSelect('vcats', '参加该会议的单位')
                ->options(Vcat::all()->where('is_father', '=', 0)->pluck('title', 'id'));
        });
    }
}
