<?php

namespace App\Admin\Controllers;

use App\Vuser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SignController extends Controller
{
    public function index(Request $request)
    {
        $vuser = Vuser::find($request->get('id'));
        if (isset($vuser->id)) {
            $res = DB::table('demo_taggables')
                ->select('vcat_id')
                ->where('taggable_id','=',$request->get('conference_id'))
                ->get()
                ->toArray();
            foreach ($res as $k => $vcat_id) {
                $in_array[] = $vcat_id->vcat_id;
            }
            if (in_array($vuser->vcat_id,$in_array)) {
                $vcats = DB::table('vcats')
                    ->select('title')
                    ->where('id','=',$vuser->vcat_id)
                    ->get()
                    ->toArray();
                $province = DB::table('provinces')
                    ->select('name')
                    ->where('id','=',$vuser->province_id)
                    ->get()
                    ->toArray();
                $salesman = DB::table('salesmen')
                    ->select('name')
                    ->where('id','=',$vuser->salesman_id)
                    ->get()
                    ->toArray();
                return response()->json([
                    'error' => 0,
                    'msg' => '签到成功',
                    'vuser_info' =>[
                        'vuser_gravatar' => $vuser->gravatar,
                        //'vcat_one' => $vuser->gravatar,
                        'vcat_two' => $vcats[0]->title,
//                        'province_name' => $province->name,
//                        'vuser_name' => $vuser->name,
//                        'company_name' => $vuser->company,
//                        'salesman_name' => $salesman->name,
                        //'sign_time' => $vuser->gravatar,
                    ],
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
