<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $request->password = Hash::make($request->password);

        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard')->with('success', 'Successfully Loggedin!');
        } else {
            return redirect()->back()->with('error', 'Incorrect login details!');
        }
    }

    public function registerView()
    {
        return view('Auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $validated['password'] = Hash::make($request->password);

        $user = User::create($validated);

        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard')->with('success', 'Successfully registered!');
        }

        if ($user) {
            return redirect()->route('loginView')->with('success', 'Successfully registered & Login!');
        } else {
            return redirect()->back()->with('error', 'Something wen\'t wrong!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginView');
    }
}
