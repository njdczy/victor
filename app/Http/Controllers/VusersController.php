<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VusersController extends Controller
{
    public function index(Request $request)
    {
        return view('users/index');
    }
}
