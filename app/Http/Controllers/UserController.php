<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $guests = User::where('role', 'user')->latest()->get();
        return view('admin.guests', compact('guests'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'phone', 'address']));

        return response()->json([
            'status' => 'success',
            'message' => 'Guest updated successfully!',
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Guest removed successfully!'
        ]);
    }
}
