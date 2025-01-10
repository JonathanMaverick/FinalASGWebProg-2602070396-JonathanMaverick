<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    //
    protected $table = 'friends';
    protected $fillable = ['friend_id', 'user_id'];
}
