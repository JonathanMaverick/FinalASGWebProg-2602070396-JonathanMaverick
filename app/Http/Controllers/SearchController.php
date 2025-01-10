<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'nullable|string|max:255',
        ]);

        $query = $request->input('query');
        $users = User::where('name', 'LIKE', '%' . $query . '%')
            ->where('id', '!=', Auth::id())
            ->get();

        $hobbies = Hobby::all();

        return view('search', compact('users', 'query', 'hobbies'));
    }

    public function searchHobby(Request $request)
    {
        $query = $request->input('query');
        $selectedHobby = $request->input('hobby');

        if ($query) {
            $users = User::where('name', 'LIKE', '%' . $query . '%')
                ->when($selectedHobby, function ($query) use ($selectedHobby) {
                    return $query->whereHas('hobbies', function ($query) use ($selectedHobby) {
                        $query->where('name', $selectedHobby);
                    });
                })
                ->get();
        } else {
            $users = collect();
        }

        $hobbies = Hobby::all();

        return view('search', compact('users', 'hobbies', 'query', 'selectedHobby'));
    }
}
