<?php

namespace App\Http\Controllers;

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
}
