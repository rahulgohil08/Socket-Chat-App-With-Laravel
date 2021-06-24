<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function fetch()
    {
        $users = User::query()
            ->get();

        return response()->json($users, 200);

    }


    public function login(Request $request)
    {

        $credentials = $request->validate([
            'mobile_no' => 'required',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {

            $user = User::find(auth()->id());
            return response()->json($user, 200);

        } else {
            return response()->json($this->responseBody("Invalid Mobile No. or Password"), 401, [], JSON_PRETTY_PRINT);
        }

    }

    private function responseBody($msg)
    {
        return [
            'message' => $msg,
        ];
    }
}
