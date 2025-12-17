<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotalController extends Controller
{
    public function index()
    {
        return view('hotal.index');
    }

    public function room()
    {
        return view('hotal.rooms');
    }
    public function RoomSingle(){
        return view('hotal.room-single');
    }
    public function Resturent(){
        return view('hotal.resturent');
    }
    public function About(){
        return view('hotal.about');
    }
    public function Contact(){
        return view('hotal.contact');
    }
    public function Profile(){
        return view('hotal.profile');
    }
}
