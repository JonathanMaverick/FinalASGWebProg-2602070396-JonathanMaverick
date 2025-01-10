<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHobby extends Model
{
    protected $table = 'user_hobbies';

    protected $fillable = ['hobby_id', 'user_id'];
}
