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
          <form>
            @csrf
            <div class="mb-4">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-4">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1">
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
