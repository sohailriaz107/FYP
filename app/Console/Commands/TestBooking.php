<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Rooms;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestBooking extends Command
{
    protected $signature = 'test:booking';
    protected $description = 'Test the booking post controller method directly';

    public function handle()
    {
        $user = User::first();
        Auth::login($user);
        
        $room = Rooms::with("roomType")->first();
        $this->info("Room: " . $room->room_number);
        $this->info("Base Price: " . $room->roomType->base_price);
        
        $request = Request::create('/booking', 'POST', [
            'check_in' => now()->addDays(1)->format('Y-m-d'),
            'check_out' => now()->addDays(3)->format('Y-m-d'),
            'guests' => '1',
            'room_type' => $room->roomType->name,
            'room_no' => $room->room_number,
            'base_price' => $room->roomType->base_price,
        ]);
        
        // Mock AJAX
        $request->headers->set('X-Requested-With', 'XMLHttpRequest');
        
        $controller = app()->make(BookingController::class);
        $response = $controller->post($request);
        
        $this->info("Status: " . $response->getStatusCode());
        $this->info("Response: " . $response->getContent());
    }
}
