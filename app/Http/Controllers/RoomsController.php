<?php

namespace App\Http\Controllers;

use App\Models\RoomsTypes;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'roomName' => 'required|string|max:100',
            'basePrice' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:500',
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

}
