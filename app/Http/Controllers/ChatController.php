<?php

namespace App\Http\Controllers;

use App\Http\Resources\Chat\ChatResource;
use App\Models\Chat;


class ChatController extends Controller
{

    public function index()
    {

        $chat = Chat::query()
            ->where('from_session_id',request()->session()->getId())
            ->first();

        if($chat) {
            return new ChatResource($chat);
        }




//        $chat = Chat::query()
//            ->firstOrCreate([
//                'from_session_id' => \request()->session()->getId(),
//                'user_id' => User::find(1)->id
//            ]);
//
//        if ($chat) {
//            $messages = ChatResource::collection($chat->messages);
//        } else {
//            $messages = [];
//        }
//
//        return $messages;
    }
}
