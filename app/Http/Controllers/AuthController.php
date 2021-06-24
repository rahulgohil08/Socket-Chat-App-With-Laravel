<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'mobile_no' => 'required',
            'password' => 'required',
        ]);



        if (Auth::attempt($credentials)) {

            return redirect()->route('home');

        } else {
            return redirect()->route('user.login')
                ->withInput(['mobile_no' => $credentials['mobile_no']])
                ->withErrors(['password' => 'Invalid Mobile No or password']);
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
