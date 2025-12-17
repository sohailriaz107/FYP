<?php

namespace App\Http\Controllers;

use App\Models\RoomsTypes;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    
    public function Dashboard(){
        return view('admin.dashboard');
    }
    public function Rooms(){
        $room_types=RoomsTypes::all();
        return view('admin.rooms',compact('room_types'));
    }
}
