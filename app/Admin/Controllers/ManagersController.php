<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Form;
use Encore\Admin\Grid;

use Encore\Admin\Controllers\ModelForm;

use App\Manager;
class ManagersController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content)  {
            $content->header('区域经理');
            $content->description('列表');
            $content->row(function (Row $row) {
                $row->column(2, function (Column $column)  {});
                $row->column(8, function (Column $column)  {
                    $column->append((
                    $this->grid()
                    ));
                });
            });
        });
    }

    protected function grid()
    {
        return Admin::grid(Manager::class, function (Grid $grid)  {

            $grid->name('区域经理名称');
            $grid->paginate(10);
            $grid->disableExport();
            $grid->disableBatchDeletion();
            $grid->disableRowSelector();
            $grid->disableFilter();
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

    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('区域经理');
            $content->description('添加');
            $content->body($this->form());
        });
    }

    protected function form()
    {
        return Manager::form(function (Form $form) {
            $form->text('name', '区域经理名称')->rules('required');
        });
    }

    public function destroy($id)
    {
        if (Manager::where('id',$id)->first()->vusers) {
            return response()->json([
                'status'  => false,
                'message' => '有参会人是住该区域经理负责的，不允许删除',
            ]);
        }
        if ($this->form()->destroy($id)) {
            return response()->json([
                'status'  => true,
                'message' => trans('admin::lang.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('admin::lang.delete_failed'),
            ]);
        }
    }
}
