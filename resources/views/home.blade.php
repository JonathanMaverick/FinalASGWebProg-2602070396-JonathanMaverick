@extends('layouts.layout')

@section('title', 'Home')

@section('content')
  <div class="container">
    <h3>Avatar Shop</h3>

    <div class="row">
      @foreach ($avatars as $avatar)
        <div class="col-md-3 mb-4">
          <div class="card">
            <img src="{{ asset('storage/' . $avatar->image_url) }}" class="card-img-top" alt="{{ $avatar->name }}">
            <div class="card-body">
              <h5 class="card-title">{{ $avatar->name }}</h5>
              <p class="card-text">${{ $avatar->price }}</p>
              @auth
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#purchaseModal"
                  data-avatar-name="{{ $avatar->name }}" data-avatar-price="{{ $avatar->price }}"
                  data-avatar-id="{{ $avatar->id }}">
                  Buy
                </button>
              @else
                <a href="{{ route('login') }}" class="btn btn-primary">
                  Buy
                </a>
              @endauth
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="purchaseModalLabel">Purchase Avatar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to purchase this avatar?</p>
            <div class="mb-3">
              <strong>Avatar Name:</strong> <span id="avatar-name"></span><br>
              <strong>Price:</strong> Coins<span id="avatar-price"></span>
            </div>

            <form id="purchaseForm" method="POST" action="{{ route('avatar.purchase') }}">
              @csrf
              <input type="hidden" name="avatar_id" id="avatar-id">

              <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  <i class="bi bi-x-circle"></i> Cancel
                </button>

                <button type="submit" class="btn btn-primary" id="confirm-purchase">
                  <i class="bi bi-cart-check"></i> Confirm Purchase
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Select all buy buttons that trigger the modal
      const buyButtons = document.querySelectorAll('[data-bs-toggle="modal"]');

      buyButtons.forEach(button => {
        button.addEventListener('click', function() {
          const avatarName = this.getAttribute('data-avatar-name');
          const avatarPrice = this.getAttribute('data-avatar-price');
          const avatarId = this.getAttribute('data-avatar-id');

          document.getElementById('avatar-name').textContent = avatarName;
          document.getElementById('avatar-price').textContent = avatarPrice;
          document.getElementById('avatar-id').value = avatarId; // Populate hidden input with avatar ID

          console.log('Avatar Name:', avatarName);
          console.log('Avatar Price:', avatarPrice);
          console.log('Avatar ID:', avatarId);
        });
      });

      document.getElementById('purchaseForm').addEventListener('submit', function(event) {
        const avatarId = document.getElementById('avatar-id').value;
        if (!avatarId) {
          event.preventDefault();
          alert('Avatar ID is missing! Please select an avatar to purchase.');
        } else {
          console.log('Form is ready to be submitted');
        }
      });
    });
  </script>
@endsection
