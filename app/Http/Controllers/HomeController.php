<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{

    public function home()
    {
        $users = User::query()
            ->where('id', '!=', auth()->id())
            ->get();


//        dd(auth()->id());

        return view('home', compact('users'));
    }

    public function chat(User $receiver)
    {
        return view('welcome', compact('receiver'));
    }
}
