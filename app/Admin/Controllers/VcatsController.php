<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Tree;

use Encore\Admin\Form;

use Encore\Admin\Controllers\ModelForm;

use App\Vcat;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class VcatsController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('类别');
            $content->description('在右边新增类别');

            $content->row(function (Row $row) {
                $row->column(6, $this->treeView()->render());
                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_url('vcats'));

                    $form->select('parent_id', '选择父类别')->options(Vcat::selectOptions());
                    $form->text('title', '子类别名称')->rules('required');

                    $column->append((new Box(trans('admin::lang.new'), $form))->style('success'));
                });
            });
        });
    }

    private function treeView()
    {
        return Vcat::tree(function (Tree $tree) {
            $tree->disableCreate();
        });
    }

    public function show($id)
    {
        return redirect()->action(
            '\App\Admin\Controllers\VcatsController@edit', ['id' => $id]
        );
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('类别部门');
            $content->description(trans('admin::lang.edit'));

            $content->row($this->form()->edit($id));
        });
    }

    public function store()
    {
        $parent_id = Input::get('parent_id');
        DB::table('vcats')->where('id','=',$parent_id)->update(['is_father' => 1]);
        return $this->form()->store();
    }

    public function update($id)
    {
        $old_parent_id = DB::table('vcats')->select('parent_id')->where('id','=',$id)->first();
        $new_parent_id = Input::get('parent_id');
        //如果修改了父级分类
        if ($old_parent_id->parent_id != $new_parent_id) {
            //设置新父级分类is_father为1
            DB::table('vcats')->where('id','=',$new_parent_id)->update(['is_father' => 1]);
            //如果旧的父级分类只有当前要更新的子类一个子类  设置is_father为0
            $count = DB::table('vcats')->select('id')->where('parent_id','=',$old_parent_id->parent_id)->count();
            if ($count == 1) {
                DB::table('vcats')->where('id','=',$old_parent_id->parent_id)->update(['is_father' => 0]);
            }
        }
        return $this->form()->update($id);
    }

    public function destroy($id)
    {
        $parent_id = DB::table('vcats')->select('parent_id')->where('id','=',$id)->first();

        if ($this->form()->destroy($id)) {
            $count = DB::table('vcats')->select('id')->where('parent_id','=',$parent_id->parent_id)->count();

            if ($count == 0) {
                DB::table('vcats')->where('id','=',$parent_id->parent_id)->update(['is_father' => 0]);
            }
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

    private function form()
    {
        return Vcat::form(function (Form $form) {
            $form->display('id', 'ID');

            $form->select('parent_id', '父类别')->options(Vcat::selectOptions());
            $form->text('title', '类别名称')->rules('required');

            $form->display('created_at', trans('admin::lang.created_at'));
            $form->display('updated_at', trans('admin::lang.updated_at'));
        });
    }


}
