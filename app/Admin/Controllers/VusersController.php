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
            $grid->number('参会人员编号');
            if (Admin::user()->id == 1) {
                $grid->model()->orderBy('number', 'asc');
                $grid->card('卡片号码')->editable();
                $grid->column('type', '类别')->display(function () {
                    $prrent_id = Vcat::find($this->vcat_id)->parent_id;
                    return $prrent_id ? Vcat::find($prrent_id)->title : '';
                });
                $grid->vcat_id('部门')->display(function ($vcat_id) {
                    return Vcat::find($vcat_id)->title;
                });
                $grid->province_id('省')->display(function ($province_id) {
                    return $province_id ? Province::find($province_id)->name : '';
                });
                $grid->name('参会人员')->editable();
                $grid->gravatar('头像')->image('', 100, 100);
                $grid->post_id('职务')->display(function ($post_id) {
                    return $post_id ? Post::find($post_id)->name : '';
                });
                $grid->mobile('手机号')->editable();
                $grid->code('客户编码')->editable();
                $grid->company('客户')->editable();
                $grid->hotel('入住饭店')->display(function ($hotel) {
                    return $hotel ? Hotel::find($hotel)->name : '';
                });
                $states = [
                    'on' => ['text' => '是'],
                    'off' => ['text' => '否'],
                ];
                $grid->column('switch_group', '是否')->switchGroup([
                    'has_attend' => '参加过订货会', 'is_need_sms' => '推送短信', 'is_enter' => '已报名'
                ], $states);
            } else {
                $vcat_id = Vcat::where('title','=',Admin::user()->name)->first();

                if (isset($vcat_id) && $vcat_id) {
                    $vcat_id->toArray();
                    $grid->model()->where('vcat_id','=',$vcat_id['id'])->orderBy('number', 'asc');
                }

                $grid->card('卡片号码');
                $grid->column('type', '类别')->display(function () {
                    $prrent_id = Vcat::find($this->vcat_id)->parent_id;
                    return $prrent_id ? Vcat::find($prrent_id)->title : '';
                });
                $grid->vcat_id('部门')->display(function ($vcat_id) {
                    return Vcat::find($vcat_id)->title;
                });
                $grid->province_id('省')->display(function ($province_id) {
                    return $province_id ? Province::find($province_id)->name : '';
                });
                $grid->name('参会人员');
                $grid->gravatar('头像')->image('', 100, 100);
                $grid->post_id('职务')->display(function ($post_id) {
                    return $post_id ? Post::find($post_id)->name : '';
                });
                $grid->mobile('手机号');
                $grid->code('客户编码');
                $grid->company('客户');
                $grid->hotel('入住饭店')->display(function ($hotel) {
                    return $hotel ? Hotel::find($hotel)->name : '';
                });
                $grid->has_attend('参加过订货会')->display(function() {
                    return $this->has_sms? '是':'否';
                });
                $grid->has_attend('推送短信')->display(function() {
                    return $this->has_sms? '是':'否';
                });
                $grid->has_attend('已报名')->display(function() {
                    return $this->has_sms? '是':'否';
                });
            }
            $grid->salesman_id('业务员')->display(function($salesman_id) {
                return $salesman_id?Salesman::find($salesman_id)->name:'';
            });
            $grid->regional_manager_id('区域经理')->display(function($regional_manager_id) {
                return $regional_manager_id?Manager::find($regional_manager_id)->name:'';
            });


            $grid->has_sms('已发送短信')->display(function() {
                return $this->has_sms? '是':'否';
            });
            if (Admin::user()->id != 1) {
                $grid->disableActions();
                $grid->disableBatchDeletion();
                $grid->disableCreation();
            }
            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();

                $filter->where(function ($query) {
                    $select_vcat = Vcat::where('id','=',$this->input)->where('parent_id','=',0)->get();
                    if ($select_vcat->isEmpty()) {//是子类
                        $query->where('vcat_id', '=', "$this->input");
                    } else {
                        $children_vcats = Vcat::where('parent_id','=',$this->input)->get()->toArray();
                        $children_vcats = array_column($children_vcats, 'id');
                        $query->whereIn('vcat_id',$children_vcats);
                    }
                },'类别&部门')->select(function () {
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
            if (Admin::user()->id == 1) {
                $grid->tools(function ($tools) {
                    $tools->append(new DelCard());

                    $tools->batch(function ($batch) {
                        $batch->add('批量报名', new BatchEnter(1));
                        $batch->add('批量发送邀请短信', new BatchSend(1,1));
                        $batch->add('批量发送天气短信', new BatchSend(1,4));
                        $batch->add('批量发送晚宴短信', new BatchSend(1,2));
                        $batch->add('批量发送发布短信', new BatchSend(1,3));
                    });
                });
            }
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

            $province_arr = Province::all()->pluck('name', 'id')->toArray();
            $post_arr = Post::all()->pluck('name', 'id')->toArray();
            $salesman_arr = Salesman::all()->pluck('name', 'id')->toArray();
            $manager_arr = Manager::all()->pluck('name', 'id')->toArray();
            $hotel_arr = Hotel::all()->pluck('name', 'id')->toArray();

            $province_arr[0] = '';
            ksort($province_arr);
            $post_arr[0] = '';
            ksort($post_arr);
            $salesman_arr[0] = '';
            ksort($salesman_arr);
            $manager_arr[0] = '';
            ksort($manager_arr);
            $hotel_arr[0] = '';
            ksort($hotel_arr);
            $form->select('vcat_id','类别')->options(Vcat::selectOptions())->rules('numeric|min:1');
            $form->select('province_id', '省')->options($province_arr);
            $form->text('number','参会人员编号');
            $form->text('name', '参会人员')->rules('required');
            $form->image('gravatar','头像')->move('',microtime().rand(0000,9999).".jpg");
            $form->select('post_id', '职务')->options($post_arr);
            $form->text('mobile', '手机号')->rules('required');
            $form->text('code', '客户编码');
            $form->text('card', '卡号');
            $form->select('salesman_id', '业务员')->options($salesman_arr);
            $form->switch('has_attend','参加过订货会');
            $form->switch('is_need_sms','推送短信');
            $form->switch('is_enter','报名');
            $form->select('regional_manager_id', '区域经理')->options($manager_arr);
            $form->text('company', '客户单位');
            $form->select('hotel', '入住酒店')->options($hotel_arr);
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
            $flag = 1;
            //短信接口地址
            $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
            foreach (Vuser::find($request->get('ids')) as $vuser) {
                if ($vuser->is_need_sms && $vuser->mobile) {
                    if ($request->get('content_number') == 1) {
                        $post_data = "account=C30735724&password=4db205b4c2434f1fee8735b22eddd8ed&mobile=".$vuser->mobile."&content=".
                            rawurlencode("尊敬的经销商，2017 VICTOR品牌大会暨秋冬新品发布会欢迎您！请点击链接获取入场凭证 v.xhbuy.cn/u/".$vuser->id);
                    } else if ($request->get('content_number') == 2) {
                        $post_data = "account=C30735724&password=4db205b4c2434f1fee8735b22eddd8ed&mobile=".$vuser->mobile."&content=".
                            rawurlencode("尊敬的经销商，欢迎晚宴于下午18:00开始，地址：南京国际博览会议中心，三楼钟山厅，欢迎莅临，谢谢！");
                    } else if ($request->get('content_number') == 3) {
                        $post_data = "account=C30735724&password=4db205b4c2434f1fee8735b22eddd8ed&mobile=".$vuser->mobile."&content=".
                            rawurlencode("尊敬的经销商， 2017 VICTOR 品牌大会暨春夏新品发布会于上午8:30正式开始，地址：南京国际青年文化中心，五楼中华厅，欢迎莅临，谢谢！");
                    } else if ($request->get('content_number') == 4) {
                        $post_data = "account=C30735724&password=4db205b4c2434f1fee8735b22eddd8ed&mobile=".$vuser->mobile."&content=".
                            rawurlencode("尊敬的经销商，南京天气：3月20日小雨转阴9-12°C；3月21日多云9-15°C；3月22日阴转暴雨12-13°C。出行请带好雨伞，注意保暖！");
                    }

                    $responses =  xml_to_array(post($post_data, $target));
                    if($responses['code']==2){
                        $vuser->has_sms = $request->get('action');
                        $vuser->save();
                        $flag = 0;
                    }
                }
            }

            return response()->json([
                'errCode' => $flag,
                'response' => $responses
            ]);

        }
    }
}
