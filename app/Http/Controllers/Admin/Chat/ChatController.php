<?php

namespace App\Http\Controllers\Admin\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\ChatListCollection;
use App\Http\Resources\Chat\ChatListResource;
use App\Http\Resources\Chat\ChatResource;
use App\Models\Chat;
use Illuminate\Database\Eloquent\Builder;


class ChatController extends Controller
{
    public function index()
    {

        $chatsSorted = Chat::query()
            ->select('chats.*')
            ->join('messages', 'messages.chat_id', '=', 'chats.id')
            ->when(\request()->input('search'), function (Builder $query, $search) {
                $query->where('message', 'like', '%' . $search . '%');
            })
            ->groupBy('chats.id')
            ->orderByRaw('max(messages.created_at) desc');

        $filters = \request()->only(['search']);

        $chats = ChatListResource::collection($chatsSorted
            ->paginate(10)
            ->withQueryString()
        );

        return inertia('Admin/Chat/Index', compact('chats','filters'));




        return Inertia::render(

            'Admin/Control/UsersView',
            [

                'users' =>
                    User::query()
                        ->when(\request()->input('search'), function (Builder $query, $search) {
                            $query->where('name', 'like', '%' . $search . '%')
                                ->OrWhere('email', 'like', '%' . $search . '%');
                        })->paginate(10)
                        ->withQueryString(),

            ]
        );
    }

    public function show(Chat $chat)
    {

        $chat = ChatResource::make($chat);

        return inertia('Admin/Chat/Show', compact('chat'));
    }

    public function store()
    {

    }
}
