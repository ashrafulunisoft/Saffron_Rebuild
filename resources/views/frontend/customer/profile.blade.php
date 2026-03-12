@extends('frontend.layouts.app')

@section('title', 'Profile Settings - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <div class="row g-4">
      <!-- Sidebar -->
      <div class="col-lg-3">
        <div class="glass-card p-4">
          <!-- User Profile Card -->
          <div class="text-center mb-4">
            <div class="customer-avatar">
              @if(auth()->user()->avatar)
                <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
              @else
                <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
              @endif
            </div>
            <h5 class="mt-3" style="color: #f5e6cc;">{{ auth()->user()->name }}</h5>
            <p style="color: rgba(245,230,204,0.6); font-size: 0.9rem;">{{ auth()->user()->email }}</p>
          </div>

          <!-- Navigation Menu -->
          <nav class="customer-nav">
            <a href="{{ route('customer.dashboard') }}" class="customer-nav-item">
              <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a href="{{ route('customer.orders') }}" class="customer-nav-item">
              <i class="fas fa-shopping-bag me-2"></i> My Orders
            </a>
            <a href="{{ route('customer.wishlist') }}" class="customer-nav-item">
              <i class="fas fa-heart me-2"></i> Wishlist
            </a>
            <a href="{{ route('customer.addresses') }}" class="customer-nav-item">
              <i class="fas fa-map-marker-alt me-2"></i> Addresses
            </a>
            <a href="{{ route('customer.profile') }}" class="customer-nav-item active">
              <i class="fas fa-user-edit me-2"></i> Profile Settings
            </a>
            <hr style="border-color: rgba(255,255,255,0.1); margin: 1rem 0;">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="customer-nav-item w-100" style="color: #f43f5e;">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
              </button>
            </form>
          </nav>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-lg-9">
        <!-- Page Header -->
        <div class="glass-card p-4 mb-4">
          <h4 style="color: #f5e6cc; margin-bottom: 0.5rem;">
            <i class="fas fa-user-edit me-2" style="color: #fbbf24;"></i>Profile Settings
          </h4>
          <p style="color: rgba(245,230,204,0.7); margin: 0;">
            Update your personal information
          </p>
        </div>

        <!-- Profile Form -->
        <div class="glass-card p-4">
          <form method="POST" action="{{ route('customer.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="row g-4">
              <!-- Avatar Upload -->
              <div class="col-12">
                <div class="text-center mb-4">
                  <div class="customer-avatar-lg">
                    @if(auth()->user()->avatar)
                      <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                    @else
                      <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    @endif
                  </div>
                  <div class="mt-3">
                    <label for="avatar" class="btn btn-glass btn-sm">
                      <i class="fas fa-camera me-2"></i>Change Avatar
                    </label>
                    <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                  </div>
                </div>
              </div>

              <!-- Name -->
              <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control input-dark" value="{{ auth()->user()->name }}" required>
              </div>

              <!-- Email -->
              <div class="col-md-6">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control input-dark" value="{{ auth()->user()->email }}" required>
              </div>

              <!-- Phone -->
              <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control input-dark" value="{{ auth()->user()->phone ?? '' }}" placeholder="+880 1XXX-XXXXXX">
              </div>

              <!-- Date of Birth -->
              <div class="col-md-6">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control input-dark" value="{{ auth()->user()->date_of_birth ?? '' }}">
              </div>

              <!-- Gender -->
              <div class="col-md-6">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select input-dark">
                  <option value="">Select Gender</option>
                  <option value="male" {{ auth()->user()->gender === 'male' ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ auth()->user()->gender === 'female' ? 'selected' : '' }}>Female</option>
                  <option value="other" {{ auth()->user()->gender === 'other' ? 'selected' : '' }}>Other</option>
                </select>
              </div>

              <!-- Current Password -->
              <div class="col-md-6">
                <label class="form-label">Current Password</label>
                <input type="password" name="current_password" class="form-control input-dark" placeholder="Required to change password">
              </div>

              <!-- New Password -->
              <div class="col-md-6">
                <label class="form-label">New Password (Optional)</label>
                <input type="password" name="password" class="form-control input-dark" placeholder="Leave blank to keep current">
              </div>

              <!-- Confirm Password -->
              <div class="col-md-6">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control input-dark" placeholder="Re-enter new password">
              </div>

              <!-- Submit Button -->
              <div class="col-12">
                <button type="submit" class="btn btn-glow">
                  <i class="fas fa-save me-2"></i>Save Changes
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
  .customer-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f59e0b, #f43f5e);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 2rem;
    color: white;
    font-weight: 700;
    overflow: hidden;
  }
  .customer-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .customer-avatar-lg {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f59e0b, #f43f5e);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 3rem;
    color: white;
    font-weight: 700;
    overflow: hidden;
    border: 4px solid rgba(245,158,11,0.3);
  }
  .customer-avatar-lg img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .customer-nav {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  .customer-nav-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    border-radius: 12px;
    color: rgba(245,230,204,0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    background: transparent;
    border: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
  }
  .customer-nav-item:hover {
    background: rgba(245,158,11,0.1);
    color: #fbbf24;
    transform: translateX(5px);
  }
  .customer-nav-item.active {
    background: linear-gradient(135deg, rgba(245,158,11,0.2), rgba(244,63,94,0.1));
    color: #fbbf24;
    border: 1px solid rgba(245,158,11,0.3);
  }
</style>
@endpush
