<?php

namespace App\Http\Controllers\Auth;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $hobbies = Hobby::all();

        return view('auth.register', compact('hobbies'));
    }

    public function getInstagramUsername($url)
    {
        $pattern = "/^https:\/\/www\.instagram\.com\/([A-Za-z0-9_]+)\/?$/";

        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    // Handle the registration logic
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'gender' => 'required|in:Male,Female',
            'hobbies' => 'required|array|min:3',
            'instagram' => 'required|url|starts_with:https://www.instagram.com',
            'mobile' => 'required|digits_between:8,15',
        ]);

        $username = $this->getInstagramUsername($request->instagram);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'gender' => $request->input('gender'),
            'instagram' => $request->input('instagram'),
            'mobile_number' => $request->input('mobile'),
            'balance' => 1000,
            'name' => $username,
        ]);

        $user->hobbies()->attach($request->input('hobbies'));

        notify()->success('Registration successful! Please login.');
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}
