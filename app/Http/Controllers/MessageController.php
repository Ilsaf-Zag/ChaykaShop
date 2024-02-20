<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\SendMessage;
use App\Http\Requests\MessageRequest;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
    }

// routes/channels.php


    public function store(MessageRequest $request)
    {

        if ($request->chat_id) {
            $chat = Chat::query()->find($request->chat_id);
        } else {
            $chat = Chat::query()
                ->create(
                    [
                        'from_session_id' => $request->session()->getId(),
                    ]);
        }

        $message = Message::create([
            'session_id' => $request->session()->getId(),
            'message' => $request->text,
            'visitor' => !auth()->check(),
            'chat_id' => $chat->id,
        ]);
        broadcast(new MessageSent($message));

        return redirect()->back();
    }
}
