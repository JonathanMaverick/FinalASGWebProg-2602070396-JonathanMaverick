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
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Email Input -->
            <div class="mb-4">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                name="email" aria-describedby="emailHelp" value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Password Input -->
            <div class="mb-4">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror"
                id="exampleInputPassword1" name="password">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Gender Input -->
            <div class="mb-4">
              <label for="gender" class="form-label">Gender</label>
              <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
              </select>
              @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Hobbies Input -->
            <div class="mb-4">
              <label for="hobbies" class="form-label">Hobbies <small class="text-muted">(at least 3)</small></label>
              <div id="hobbies" style="max-height: 200px; overflow-y: auto; padding-right: 10px;">
                @foreach ($hobbies as $hobby)
                  <div class="form-check">
                    <input class="form-check-input @error('hobbies') is-invalid @enderror" type="checkbox"
                      name="hobbies[]" value="{{ $hobby->id }}" id="hobby_{{ $hobby->id }}"
                      {{ is_array(old('hobbies')) && in_array($hobby->id, old('hobbies')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="hobby_{{ $hobby->id }}">{{ $hobby->name }}</label>
                  </div>
                @endforeach
              </div>
              @error('hobbies')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Instagram Input -->
            <div class="mb-4">
              <label for="instagram" class="form-label">Instagram Username</label>
              <input type="url" class="form-control @error('instagram') is-invalid @enderror" id="instagram"
                name="instagram" placeholder="http://www.instagram.com/username" value="{{ old('instagram') }}" required>
              @error('instagram')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Mobile Input -->
            <div class="mb-4">
              <label for="mobile" class="form-label">Mobile Number</label>
              <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile"
                name="mobile" pattern="\d+" placeholder="Enter your mobile number" value="{{ old('mobile') }}"
                required>
              @error('mobile')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Registration Fee -->
            <div class="mb-4 text-center">
              <label class="form-label fw-bold">Registration Fee</label>
              <p class="fs-4 text-primary">Rp {{ random_int(100000, 125000) }}</p>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Register</button>
          </form>

          <!-- Link to Login -->
          <p class="mt-4 text-center">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
      </div>
    </div>
  </div>
@endsection
