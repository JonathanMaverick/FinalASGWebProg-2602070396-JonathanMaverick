<!-- resources/views/auth/register.blade.php -->

@extends('layouts.auth')

@section('title', 'Register')

@section('content')
  <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card shadow p-4">
          <h2 class="text-center mb-4">Create Your Account</h2>

          <!-- Form Register -->
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

            <div class="mb-4">
              <label for="gender" class="form-label">Gender</label>
              <select class="form-select" id="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>

            <div class="mb-4">
              <label for="hobbies" class="form-label">Hobbies <small class="text-muted">(at least 3)</small></label>
              <div id="hobbies" style="max-height: 200px; overflow-y: auto; padding-right: 10px;">
                @foreach ($hobbies as $hobby)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hobbies[]" value="{{ $hobby->id }}"
                      id="hobby_{{ $hobby->id }}">
                    <label class="form-check-label" for="hobby_{{ $hobby->id }}">
                      {{ $hobby->name }}
                    </label>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="mb-4">
              <label for="instagram" class="form-label">Instagram Username</label>
              <input type="url" class="form-control" id="instagram" placeholder="http://www.instagram.com/username"
                required>
            </div>

            <div class="mb-4">
              <label for="mobile" class="form-label">Mobile Number</label>
              <input type="text" class="form-control" id="mobile" pattern="\d+"
                placeholder="Enter your mobile number" required>
            </div>

            <div class="mb-4 text-center">
              <label class="form-label fw-bold">Registration Fee</label>
              <p class="fs-4 text-primary">Rp {{ random_int(100000, 125000) }}</p>
            </div>

            <button type="submit" class="btn btn-primary w-100">Register</button>
          </form>

          <!-- Link to Login -->
          <p class="mt-4 text-center">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
      </div>
    </div>
  </div>
@endsection
