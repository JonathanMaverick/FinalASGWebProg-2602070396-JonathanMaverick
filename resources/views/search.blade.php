@extends('layouts.layout')

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
                <a href="" class="btn btn-primary">Like</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
@endsection