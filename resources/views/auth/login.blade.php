<!-- resources/views/auth/login.blade.php -->

@extends('layouts.auth')

@section('title', 'Login')

@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
      <div class="col-md-6 col-lg-4">
        <div class="card p-4">
          <h2 class="text-center mb-4">Login</h2>

          <!-- Form Login -->
          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                name="email" aria-describedby="emailHelp" value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror"
                id="exampleInputPassword1" name="password">
              @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>

          <!-- Link to Register -->
          <p class="mt-3 text-center">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </div>
      </div>
    </div>
  </div>
@endsection
