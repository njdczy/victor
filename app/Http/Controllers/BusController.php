<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index(Request $request)
    {
        return view('users/bus');
    }
}