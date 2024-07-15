<?php

namespace App\Http\Controllers;

use App\Models\Photos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
 
class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
 
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
 
        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/teacher/studentList');
        }
    
        return redirect('/login')->with('error', 'Invalid credentials. Please try again.');
    }
}