<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'message',
        'visitor',
        'chat_id'
    ];


    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
