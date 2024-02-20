<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lastMessage = $this->messages->last();

        //todo n+1
        return [
            'id'=>$this->id,
            'text'=>$lastMessage->message,
            'time'=>$lastMessage->created_at->diffForHumans()
        ];
    }
}
