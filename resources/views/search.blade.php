@extends('layouts.layout')

@section('title', 'Search')

@section('content')
  <div class="container">
    <h3>Search Results for "{{ $query }}"</h3>

    <form method="GET" action="{{ route('search_hobby') }}" class="mb-4">
      <input type="hidden" name="query" value="{{ $query }}">
      <div class="row">
        <div class="col-md-4">
          <select class="form-control" name="hobby">
            <option value="">Filter by Hobby</option>
            @foreach ($hobbies as $hobbyItem)
              <option value="{{ $hobbyItem->name }}">
                {{ $hobbyItem->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-secondary w-100">Filter</button>
        </div>
      </div>
    </form>

    @if ($users->isEmpty())
      <p>No users with the username "{{ $query }}" found for
        @if ($selectedHobby ?? false)
          the hobby "{{ $selectedHobby }}"
        @else
          any hobby
        @endif
      </p>
    @else
      <div class="row">
        @foreach ($users as $user)
          <div class="col-md-4 mb-4">
            <div class="card">
              <img
                src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/150' }}"
                class="card-img-top" alt="Profile Picture">
              <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text">{{ $user->email }}</p>
                @if (Auth::check() && Auth::user()->id !== $user->id)
                  @if (Auth::user()->friends->contains($user))
                    <button class="btn btn-success" disabled>Already Friends</button>
                  @elseif (Auth::user()->sentRequests->contains($user))
                    <button class="btn btn-warning" disabled>Request Sent</button>
                  @elseif (Auth::user()->receivedRequests->contains($user))
                    <form action="{{ route('friend.accept', $user->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-success">Accept Friend Request</button>
                    </form>
                  @else
                    <form action="{{ route('friend.send', $user->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-primary">Send Friend Request</button>
                    </form>
                  @endif
                @endif

              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
@endsection
