<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $avatars = Avatar::all();
        return view('home', compact('avatars'));
    }

    public function profile()
    {
        $user = Auth::user();
        $avatars = $user->avatars;

        return view('profile', compact('user', 'avatars'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
