<?php

namespace App\Admin\Controllers;

use App\SignLog;
use App\Vuser;
use App\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

use Encore\Admin\Facades\Admin;

class SignController extends Controller
{
    public function index(Request $request)
    {
        $conference_id = $request->get('conference_id');
        $vuser = Vuser::where('card','=',$request->get('card'))->first();
        if (isset($vuser->id)) {  //如果用户存在
            $res = DB::table('demo_taggables')
                ->select('vcat_id')
                ->where('taggable_id','=',$conference_id)
                ->get()
                ->toArray();
            foreach ($res as $k => $vcat_id) {
                $in_array[] = $vcat_id->vcat_id;
            }
            if (in_array($vuser->vcat_id,$in_array)) {//如果用户类别在这个会议中
                $vcats = DB::table('vcats')
                    ->where('id','=',$vuser->vcat_id)
                    ->pluck('title')
                    ->toArray();
                $province = DB::table('provinces')
                    ->where('id','=',$vuser->province_id)
                    ->pluck('name')
                    ->toArray();
                $salesman = DB::table('salesmen')
                    ->where('id','=',$vuser->salesman_id)
                    ->pluck('name')
                    ->toArray();
                $vuser_info = [//输入用户信息
                    'vuser_gravatar' => $vuser->gravatar,
                    //'vcat_one' => $vuser->gravatar,
                    'vcat_two' => $vcats[0],
                    'province_name' => $province[0],
                    'vuser_name' => $vuser->name,
                    'company_name' => $vuser->company,
                    'salesman_name' => $salesman[0],
                    'sign_time' => Carbon::now()->toDateTimeString(),
                ];
                $sign_log = SignLog::where('vuser_id','=',$vuser->id)
                    ->where('conference_id','=',$conference_id)
                    ->first();//查找用户签到记录

                if (isset($sign_log->id)) {
                    $error = -1;
                    $msg = '已经签到过该会议';
                } else {
                    //记录到签到表中 s
                    $new_sign_log = new SignLog;
                    $new_sign_log->vuser_id = $vuser->id;
                    $new_sign_log->admin_user_name = Admin::user()->username;
                    $new_sign_log->conference_id = $conference_id;
                    $new_sign_log->save();
                    //记录到签到表中 e
                    $error = 0;
                    $msg = '签到成功';

                    //更新会议签到人数和家数 s
                    Conference::where('id','=',$conference_id)->increment('sign_count');
                    DB::table('demo_taggables')
                        ->where('vcat_id','=',$vuser->vcat_id)->update(['is_sign' => 1]);
                    //更新会议签到人数和家数 e
                }
                //  签到人数家数 s


                $sign_info['sign_vuser_count'] = Conference::select('sign_count')
                    ->where('id','=',$conference_id)->first()->toArray()['sign_count'];
                $sign_info['sign_vcat_count'] = DB::table('demo_taggables')
                    ->where('taggable_id','=',$conference_id)
                    ->where('is_sign','=',1)
                    ->count();
                // 签到人数家数 e
                return response()->json([
                    'error' => $error,
                    'msg' => $msg,
                    'vuser_info' =>$vuser_info,
                    'sign_info' =>$sign_info
                ]);
            } else {
                return response()->json([
                    'error' => 2,
                    'msg' => '该人员不在会议中',
                ]);
            }
        }  else {
            return response()->json([
               'error' => 1,
               'msg' => '不存在该卡号对应的人员',
            ]);
        }

    }
}
