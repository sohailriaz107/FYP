<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\RoomsTypes;
use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'roomName' => 'required|string|max:100',
            'basePrice' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:500',
        ]);

        $room = RoomsTypes::create([
            'name' => $request->roomName,
            'base_price' => $request->basePrice,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Room added successfully!',
            'room' => $room
        ]);
    }
    public function update(Request $request, $id)
    {
        $room = RoomsTypes::findOrFail($id);

        $room->name = $request->roomName;
        $room->base_price = $request->basePrice;
        $room->description = $request->description;
        $room->save();

        return response()->json([
            'id' => $room->id,
            'name' => $room->name,
            'base_price' => $room->base_price,
            'description' => $room->description
        ]);
    }
    public function destroy($id)
    {
        $room = RoomsTypes::findOrFail($id);
        $room->delete();

        return response()->json([
            'message' => 'Room deleted successfully',
            'id' => $id
        ]);
    }

    public function RoomsList()
    {    
          $amenities = Amenities::where('is_active', 1)->get();
        $rooms = Rooms::with(['roomType', 'amenities'])->get();
        $roomTypes = RoomsTypes::all();
        return view('admin.roomlist', compact('rooms', 'roomTypes','amenities'));
    }

    public function RoomStore(Request $request)
    {
        $request->validate([
            'roomno' => 'required|string|max:100',
            'roomtype' => 'required|exists:room_types,id',
            'status' => 'required|in:available,occupied,maintenance',
            'amenities' => 'nullable|array'
        ]);

        $room = Rooms::create([
            'room_type_id' => $request->roomtype,
            'room_number' => $request->roomno,
            'status' => $request->status,
        ]);

        if ($request->has('amenities')) {
            $room->amenities()->attach($request->amenities);
        }

        $room->load(['roomType', 'amenities']);

        return response()->json([
            'status' => true,
            'message' => 'Room added successfully!',
            'room' => $room
        ]);
    }

    public function RoomUpdate(Request $request, $id)
    {
        $request->validate([
            'roomno' => 'required|string|max:100',
            'roomtype' => 'required|exists:room_types,id',
            'status' => 'required|in:available,occupied,maintenance',
            'amenities' => 'nullable|array'
        ]);

        $room = Rooms::findOrFail($id);
        $room->update([
            'room_type_id' => $request->roomtype,
            'room_number' => $request->roomno,
            'status' => $request->status,
        ]);

        if ($request->has('amenities')) {
            $room->amenities()->sync($request->amenities);
        } else {
            $room->amenities()->detach();
        }

        $room->load(['roomType', 'amenities']);

        return response()->json([
            'status' => true,
            'message' => 'Room updated successfully!',
            'room' => $room
        ]);
    }

    public function RoomDestroy($id)
    {
        $room = Rooms::findOrFail($id);
        $room->delete();

        return response()->json([
            'status' => true,
            'message' => 'Room deleted successfully!',
        ]);
    }
}
