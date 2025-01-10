@extends('layouts.layout')

@section('title', 'Profile')

@section('content')
  <div class="container mt-4">
    <h3 class="mb-4 text-center">Your Profile</h3>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header text-center">
            <h5>{{ $user->name }}'s Profile</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 d-flex align-items-center justify-content-center">
                <img
                  src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/150' }}"
                  class="img-fluid rounded-circle mb-3" alt="Profile Picture" style="max-width: 150px; height: auto;">
              </div>

              <div class="col-md-8 d-flex align-items-center">
                <div>
                  <h6><strong>Email:</strong> {{ $user->email }}</h6>
                  <h6><strong>Gender:</strong> {{ $user->gender }}</h6>
                  <h6><strong>Instagram:</strong> <a href="https://instagram.com/{{ $user->instagram }}"
                      target="_blank">{{ $user->instagram }}</a></h6>
                  <h6><strong>Mobile Number:</strong> {{ $user->mobile_number }}</h6>
                  <h6><strong>Balance:</strong> {{ number_format($user->balance) }} Coins</h6>
                  <form action="{{ route('user.topup') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">
                      Top Up Balance (1000 Coins)
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-4">
          <h5>Your Avatars</h5>
          <div class="row">
            @forelse ($avatars as $avatar)
              <div class="col-md-3 mb-3">
                <div class="card">
                  <img src="{{ asset('storage/' . $avatar->image_url) }}" class="card-img-top" alt="{{ $avatar->name }}">
                  <div class="card-body text-center">
                    <h6 class="card-title">{{ $avatar->name }}</h6>
                    <p class="card-text">Price: ${{ number_format($avatar->price, 2) }}</p>
                    <!-- Add a button to select the avatar as current profile -->
                    <form action="{{ route('avatar.setProfile', $avatar->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-primary">Set as Profile</button>
                    </form>
                  </div>
                </div>
              </div>
            @empty
              <div class="col-12 text-center">
                <p class="alert alert-danger">You have no avatars.</p>
              </div>
            @endforelse
          </div>
        </div>

        <div class="mt-4">
          <h5>Your Friends</h5>
          @if ($user->friends->isEmpty())
            <p>You don't have any friends yet.</p>
          @else
            <div class="row">
              @foreach (Auth::user()->friends->contains($user) || $user->friends->contains(Auth::user()) as $friend)
                <div class="col-md-4 mb-4">
                  <div class="card">
                    <img
                      src="{{ $friend->profile_picture ? asset('storage/' . $friend->profile_picture) : 'https://via.placeholder.com/150' }}"
                      class="card-img-top" alt="Profile Picture">
                    <div class="card-body">
                      <h5 class="card-title">{{ $friend->name }}</h5>
                      <p class="card-text">{{ $friend->email }}</p>
                      <a href="{{ route('user.profile', $friend->id) }}" class="btn btn-secondary">View Profile</a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        </div>

      </div>
    </div>
  </div>
@endsection
