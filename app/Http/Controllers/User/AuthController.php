<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function Register()
    {
        return view('user.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->password
        ]);
        if ($user) {
            return redirect()->route('user.login')->with('success', 'please you can login here');
        } else {
            return redirect()->route('user.register')->with('error', 'Error while registration');
        }
    }

    public function LoginForm()
    {
        return view('user.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        // user login attempt

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home')->with('success', 'Logged in successfully!');
        } else {
            return back()->with('error', 'Invalid email or password.');
        }
    }
}
