<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-03-15
 * Time: 上午 9:42
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function welcome(Request $request)
    {
        if ($request->has('id')) {

        }
        return  view('users/welcome');
    }


    public function intro()
    {
        return  view('users/intro');
    }

    public function conference()
    {
        return  view('users/conference');
    }

    public function bus()
    {
        return  view('users/bus');
    }

    public function seat()
    {
        return  view('users/seat');
    }
}