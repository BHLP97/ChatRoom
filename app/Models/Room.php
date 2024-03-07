<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = "rooms";

    protected $fillable = [
        'name',
        'author_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'roomables', 'room_id', 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
