<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'gender',
        'instagram',
        'mobile_number',
        'balance',
        'name',
        'currentProfile',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'user_hobbies', 'user_id', 'hobby_id');
    }

    public function avatars()
    {
        return $this->belongsToMany(Avatar::class, 'avatar_user', 'user_id', 'avatar_id');
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withPivot('status')
            ->wherePivot('status', 'accepted');
    }

    public function sentRequests()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->withPivot('status')->wherePivot('status', 'pending');
    }

    public function receivedRequests()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')->withPivot('status')->wherePivot('status', 'pending');
    }
}
