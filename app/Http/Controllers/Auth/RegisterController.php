<?php

namespace App\Http\Controllers\Auth;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $hobbies = Hobby::all();

        return view('auth.register', compact('hobbies'));
    }

    // Handle the registration logic
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gender' => 'required|in:Male,Female',
            'hobbies' => 'required|min:3',
            'instagram' => 'required|url|regex:/^https:\/\/www\.instagram\.com\/[A-Za-z0-9_]+$/',
            'mobile' => 'required|digits',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new user or save the data
        // Example of saving data (adjust to your needs)
        User::create([
            'gender' => $request->input('gender'),
            'hobbies' => $request->input('hobbies'),
            'instagram' => $request->input('instagram'),
            'mobile_number' => $request->input('mobile'),
        ]);

        // For now, just return a success message
        return redirect()->route('auth.login')->with('success', 'Registration successful! Please login.');
    }
}
