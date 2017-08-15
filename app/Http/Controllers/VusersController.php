<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Jxs;
use Illuminate\Http\Request;
use Auth;

class VusersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $user->company = Jxs::where('id', $user->company)->value('name');
        return view('users/index',compact('user'));
    }

    public function hotel()
    {
        $hotel_id = Auth::user()->hotel;
        $hotel = Hotel::find($hotel_id);
        return view('users/hotel',compact('hotel'));
    }


}
