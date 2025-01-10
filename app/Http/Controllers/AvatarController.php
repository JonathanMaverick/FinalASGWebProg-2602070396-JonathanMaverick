<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AvatarController extends Controller
{
    //
    public function purchase(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to purchase an avatar.');
        }
        $avatarId = $request->input('avatar_id');
        $user = Auth::user();

        $alreadyOwned = DB::table('avatar_user')
            ->where('user_id', $user->id)
            ->where('avatar_id', $avatarId)
            ->exists();

        $avatar = DB::table('avatars')->where('id', $avatarId)->first();

        if (!$avatar) {
            return redirect()->route('home')->with('error', 'Avatar not found.');
        }

        if ($alreadyOwned) {
            notify()->error('You already own this avatar.');
            return redirect()->route('home');
        }

        if ($user->balance < $avatar->price) {
            notify()->error('You do not have enough balance to purchase this avatar.');
            return redirect()->route('home');
        }

        DB::table('users')
            ->where('id', $user->id)
            ->decrement('balance', $avatar->price);

        DB::table('avatar_user')->insert([
            'user_id' => $user->id,
            'avatar_id' => $avatarId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('home')->with('success', 'Avatar purchased successfully!');
    }

    public function setProfile($avatarId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to set a profile avatar.');
        }

        $avatar = Avatar::findOrFail($avatarId);

        DB::table('users')
            ->where('id', Auth::id())
            ->update(['profile_picture' => $avatar->image_url]);

        return redirect()->route('profile')->with('success', 'Your profile avatar has been updated!');
    }
}
