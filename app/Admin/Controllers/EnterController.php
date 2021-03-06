<?php

namespace App\Admin\Controllers;

use App\Vcat;
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
use Encore\Admin\Widgets\Form;
use Encore\Admin\Widgets\Table;
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
                $token = csrf_token();
                $table_html = <<<EOT
<table class="table">
    <thead>
    <tr><td>光标放入输入框:</td><td><input id="input"/></td></tr>
    </thead>
    <tbody>
        <tr>
            <td>照片:</td>
            <td><img id="vuser_gravatar" style="width:100px;height:100px;" src="/static/img/victor_logo.png"/></td>
        </tr>
        <tr>
          <!--<td>类别:<span id="vcat_one"></span></td>-->
        </tr>
        <tr>
            <td>部门:<span id="vcat_two"></span></td>
             <td>省:<span id="province_name"></span></td>
        </tr>
        <tr>
          <td>参会人员:<span id="vuser_name"></span></td>
          <td>客户名称:<span id="company_name"></span></td>
        </tr>
        <tr>
            <td>业务人员:<span id="salesman_name"></span></td>
            <td>签到时间:<span id="sign_time"></span></td>
        </tr>
        </tbody>
</table>
<script>
var input = document.getElementById("input");

input.addEventListener("keydown", function(e){
         e = e||event;
		 var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
         if(keyCode==13){

             e.preventDefault();
			 if(input.value){
			     $.ajax({
                    method: 'post',
                    url: 'sign',
                    data: {
                        _token:'{$token}',
                        card: input.value,
                        conference_id: {$this->id},
                    },
                    success: function (data) {
                        if (data.error > 0) {

                            toastr.error(data.msg);

                        } else {
                           document.getElementById("vuser_gravatar").setAttribute('src','http://v.xhbuy.cn/upload/'+data.vuser_info.vuser_gravatar);
                           document.getElementById("vcat_two").innerText=data.vuser_info.vcat_two;
                           document.getElementById("province_name").innerText=data.vuser_info.province_name;
                           document.getElementById("vuser_name").innerText=data.vuser_info.vuser_name;
                           document.getElementById("company_name").innerText=data.vuser_info.company_name;
                           document.getElementById("salesman_name").innerText=data.vuser_info.salesman_name;

                           document.getElementById("sign_vuser_count").innerText=data.sign_info.sign_vuser_count;
                           document.getElementById("sign_vcat_count").innerText=data.sign_info.sign_vcat_count;


                           toastr.success(data.msg);
                        }

                        input.value = '';
                        input.focus();

                    }
                });
			 }
        }
});
</script>
EOT;
                $box = new Box('签到人信息',$table_html);
                $content->row($box->style('primary'));

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
                //实到经销商s
                $sign_vuser_id = SignLog::where('conference_id',$this->id)->pluck('vuser_id')->toArray();
                $sign_company = Vuser::whereIn('id',$sign_vuser_id)->pluck('company')->toArray();
                $sign_company_count = count(array_unique($sign_company));
                //实到经销商e
                // 应签到人数 e
                $box = new Box('统计', '
<span>应到人数:</span><b id="should_vuser_count">'.$should_vuser_count.'</b>&nbsp;&nbsp;&nbsp;
<span>实到人数:</span><b id="sign_vuser_count">'.$sign_vuser_count['sign_count'].'</b>&nbsp;&nbsp;&nbsp;   
<span>应到部门:</span><b id="should_vcat_count">'.$should_vcat_count.'</b>&nbsp;&nbsp;&nbsp;   
<span>实到部门:</span><b id="sign_vcat_count">'.$sign_vcat_count.'</b>&nbsp;&nbsp;&nbsp;   
<span>实到经销商数:</span><b id="sign_company_count">'.$sign_company_count.'</b>'
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
            $grid->filter(function ($filter)  {
                $filter->disableIdFilter();
                $filter->equal('id', '会议名称')
                    ->select(function () {
                        if (Admin::user()->id == 1 ||  Admin::user()->name == 'VICTOR') {
                            return Conference::pluck('name','id');
                        }
                        return Conference::where('name','like',Admin::user()->name.'%')->pluck('name','id');
                    });
            });
        });
    }
}
