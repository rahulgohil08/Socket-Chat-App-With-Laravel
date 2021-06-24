<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{


    public function fetch(Request $request)
    {

        $data = $request->validate([
            'sender_id' => 'required',
            'receiver_id' => 'required',
        ]);

        $chat = Chat::query()
            ->where(function ($query) use ($data) {
                return $query
                    ->where('sender_id', $data['sender_id'])
                    ->Where('receiver_id', $data['receiver_id']);
            })
            ->orWhere(function ($query) use ($data) {
                return $query
                    ->where('sender_id', $data['receiver_id'])
                    ->Where('receiver_id', $data['sender_id']);
            })
            ->get();

        return response()->json($chat, 200);

    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'message' => 'required',
        ]);

        $chat = Chat::create($data);

        return response()->json($chat, 200);

    }


}
