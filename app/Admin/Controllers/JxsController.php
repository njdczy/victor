<?php


namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use App\Jxs;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class JxsController extends Controller
{
    use ModelForm;

    public function index()
    {

        return Admin::content(function (Content $content)  {
            $content->header('经销商');
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
        return Admin::grid(Jxs::class, function (Grid $grid)  {

            $grid->name('经销商名称');
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
            $content->header('经销商');
            $content->description('添加');
            $content->body($this->form());
        });
    }

    protected function form()
    {
        return Jxs::form(function (Form $form) {
            $form->text('name', '经销商名称')->rules('required');
        });
    }
}