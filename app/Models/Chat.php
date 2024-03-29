<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        "from_session_id",
    ];


    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }

    public function messages():HasMany
    {
        return $this->hasMany(Message::class);
    }
}
