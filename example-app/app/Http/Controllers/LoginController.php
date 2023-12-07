<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    # use middleware to make sure unauthorized user
    # cannot access dashboard and logout
    public function __construct(){
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    public function register(){
        return view('register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        # regenerate session ID
        $request->session()->regenerate();
        return redirect()->route('dashboard')->withSuccess("You have successfully registered an account.");
    }

    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email', # email should be validated email
            'password' => 'required' # password is required
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard')->withSuccess("You have successfully logged in");
        }
        # can't validate account
        # return to last page
        return back()->withErrors([
            'email' => "You failed log in"
        ])->onlyInput('email');
    }

    public function dashboard(){
        if (Auth::check()){
            return view('dashboard');
        }

        return redirect()->route('login')->withErrors([
            'email'=>"Please login to access the dashboard",
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess("You have successfully logged out");
    }
}
