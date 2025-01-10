<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function topUp(Request $request)
    {
        $user = Auth::user();

        $user->balance += 1000;

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'balance' => DB::raw('balance + 1000'),
                'updated_at' => now(),
            ]);

        return redirect()->route('profile')->with('success', 'Balance topped up by $1000!');
    }

    public function sendRequest($friendId)
    {
        $user = Auth::user();

        if ($user->friends()->where('friend_id', $friendId)->exists()) {
            return redirect()->back()->with('error', 'You are already friends!');
        }

        if ($user->sentRequests()->where('friend_id', $friendId)->exists()) {
            return redirect()->back()->with('error', 'You have already sent a friend request!');
        }

        if ($user->receivedRequests()->where('user_id', $friendId)->exists()) {
            return redirect()->back()->with('error', 'Friend request already pending!');
        }

        $user->sentRequests()->attach($friendId, ['status' => 'pending']);

        return redirect()->back()->with('success', 'Friend request sent!');
    }

    public function acceptFriend(User $user)
    {
        $authUser = Auth::user();

        $request = FriendRequest::where('user_id', $user->id)
            ->where('friend_id', $authUser->id)
            ->first();

        // dd($request);
        if ($request) {
            $request->status = 'accepted';

            DB::table('friends')->insert([
                'user_id' => $authUser->id,
                'friend_id' => $user->id,
                'status' => 'accepted',
            ]);

            $request->save();
            notify()->success('Friend request accepted!');
            return redirect()->back()->with('success', 'Friend request accepted!');
        }

        return redirect()->back()->with('error', 'No pending friend request found!');
    }
}
