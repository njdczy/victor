<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\BatchEnter;
use App\Admin\Extensions\Tools\DelCard;
use App\Admin\Extensions\Tools\BatchSend;
use App\Http\Controllers\Controller;


use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Grid;

use Encore\Admin\Controllers\ModelForm;

use Illuminate\Http\Request;
use App\Vuser;
use App\Vcat;
use App\Salesman;
use App\Manager;
use App\Province;
use App\Hotel;
use App\Post;
use Illuminate\Support\Facades\DB;

use App\Admin\Extensions\CustomExporter;

class VusersController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('人员');
            $content->description('列表');
            $content->body($this->grid()->render());
        });
    }

    private function grid()
    {
        return Vuser::grid(function (Grid $grid) {
            $grid->model()->orderBy('created_at','desc');
            $grid->number('编号');
            $grid->column('type','类别')->display(function(){
                $prrent_id = Vcat::find($this->vcat_id)->parent_id;
                return Vcat::find($prrent_id)->title;
            });
            $grid->vcat_id('部门')->display(function($vcat_id){
                return Vcat::find($vcat_id)->title;
            });
            $grid->province_id('省')->display(function($province_id){
                return Province::find($province_id)->name;
            });
            $grid->name('参会人员')->editable();
            $grid->gravatar('头像')->image('', 100, 100);
            $grid->post_id('职务')->display(function($post_id) {
                return Post::find($post_id)->name;
            });
            $grid->mobile('手机号')->editable();
            $grid->code('客户编码')->editable();
            $grid->card('卡号')->editable();
            $grid->salesman_id('业务员')->display(function($salesman_id) {
                return Salesman::find($salesman_id)->name;
            });
            $grid->regional_manager_id('区域经理')->display(function($regional_manager_id) {
                return Manager::find($regional_manager_id)->name;
            });
            $grid->company('客户单位')->editable();
            //$grid->hotel('入住酒店')->editable();
            $states = [
                'on' => ['text' => '是'],
                'off' => ['text' => '否'],
            ];
            $grid->column('switch_group','是否')->switchGroup([
                'has_attend' => '参加过订货会', 'is_need_sms' => '推送短信', 'is_enter' => '已报名'
            ], $states);

            $grid->has_sms('已发送短信')->display(function() {
                return $this->has_sms? '是':'否';
            });

            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->equal('vcat_id', '类别')
                    ->select(function () {
                        return Vcat::selectOptions();
                    });
                $filter->equal('is_enter', '是否报名')
                    ->select([0=>'否',1=>'是']);
                $filter->equal('has_attend', '是否参加过订货会')
                    ->select([0=>'否',1=>'是']);
                $filter->equal('has_sms', '是否发送过短信')
                    ->select([0=>'否',1=>'是']);
                $filter->like('name','参会人员');
                $filter->like('code','客户编码');
                $filter->like('hotel','入住酒店');
            });
            $grid->exporter(new CustomExporter());
            $grid->tools(function ($tools) {
                $tools->append(new DelCard());

                $tools->batch(function ($batch) {
                    $batch->add('批量报名', new BatchEnter(1));
                    $batch->add('批量发送短信', new BatchSend(1));
                });
            });
        });
    }

    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('人员');
            $content->description('添加');
            $content->body($this->form());
        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('人员');
            $content->description(trans('admin::lang.edit'));
            $content->body($this->form()->edit($id));
        });
    }

    public function form()
    {
        return Vuser::form(function (Form $form) {
            $form->select('vcat_id','类别')->options(Vcat::selectOptions())->rules('numeric|min:1');
            $form->select('province_id', '省')->options(Province::all()->where('parent_id', '>', 0)->pluck('name', 'id'));
            $form->text('name', '参会人员')->rules('required');
            $form->image('gravatar','头像');
            $form->select('post_id', '职务')->options(Post::all()->pluck('name', 'id'));
            $form->text('mobile', '手机号')->rules('required');
            $form->text('code', '客户编码')->rules('required');
            $form->text('card', '卡号')->rules('required');
            $form->select('salesman_id', '业务员')->options(Salesman::all()->pluck('name', 'id'));
            $form->switch('has_attend','参加过订货会');
            $form->switch('is_need_sms','推送短信');
            $form->switch('is_enter','报名');
            $form->select('regional_manager_id', '区域经理')->options(Manager::all()->pluck('name', 'id'));
            $form->text('company', '客户单位')->rules('required');
            $form->select('hotel', '入住酒店')->options(Hotel::all()->pluck('name', 'id'));
        });
    }

    public function enter(Request $request)
    {
        foreach (Vuser::find($request->get('ids')) as $vuser) {
            $vuser->is_enter = $request->get('action');
            $vuser->save();
        }
    }

    public function delCard(Request $request)
    {
        if ($request->ajax()) {
            DB::table('vusers')->update(['card' => '']);
        }
    }

    public function sendSms(Request $request)
    {
        if ($request->ajax()) {

            foreach (Vuser::find($request->get('ids')) as $vuser) {
                $vuser->has_sms = $request->get('action');
                $vuser->save();
            }

            return response()->json([
                'errCode' => 0,
                'msg' => 'success'
            ]);
        }
    }
}
