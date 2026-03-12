@extends('frontend.layouts.app')

@section('title', 'My Addresses - Saffron Sweets & Bakery')

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
            <a href="{{ route('customer.addresses') }}" class="customer-nav-item active">
              <i class="fas fa-map-marker-alt me-2"></i> Addresses
            </a>
            <a href="{{ route('customer.profile') }}" class="customer-nav-item">
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
          <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
              <h4 style="color: #f5e6cc; margin-bottom: 0.5rem;">
                <i class="fas fa-map-marker-alt me-2" style="color: #fbbf24;"></i>My Addresses
              </h4>
              <p style="color: rgba(245,230,204,0.7); margin: 0;">
                Manage your delivery addresses
              </p>
            </div>
            <button class="btn btn-glow btn-sm" onclick="showAddressForm()">
              <i class="fas fa-plus me-2"></i>Add New
            </button>
          </div>
        </div>

        <!-- Address Form (Hidden by default) -->
        <div id="addressFormContainer" class="glass-card p-4 mb-4" style="display: none;">
          <h5 style="color: #f5e6cc; margin-bottom: 1.5rem;">
            <i class="fas fa-plus-circle me-2" style="color: #fbbf24;"></i>Add New Address
          </h5>
          <form method="POST" action="{{ route('customer.addresses.store') }}">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Label (Home, Office, etc.)</label>
                <input type="text" name="label" class="form-control input-dark" placeholder="Home" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control input-dark" placeholder="Enter name" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control input-dark" placeholder="+880 1XXX-XXXXXX" required>
              </div>
              <div class="col-12">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control input-dark" rows="2" placeholder="House no, street, area" required></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control input-dark" placeholder="Dhaka" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Area/Thana</label>
                <input type="text" name="state" class="form-control input-dark" placeholder="Gulshan" required>
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input type="checkbox" name="is_default" class="form-check-input" id="defaultAddress" style="width: 1.2em; height: 1.2em; background-color: rgba(255,255,255,0.08); border: 2px solid rgba(245,158,11,0.4);">
                  <label class="form-check-label ms-2" for="defaultAddress" style="color: rgba(245,230,204,0.8); cursor: pointer;">
                    Set as default address
                  </label>
                </div>
              </div>
              <div class="col-12">
                <div class="d-flex gap-2">
                  <button type="submit" class="btn btn-glow">
                    <i class="fas fa-save me-2"></i>Save Address
                  </button>
                  <button type="button" class="btn btn-glass" onclick="hideAddressForm()">
                    Cancel
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>

        <!-- Addresses List -->
        @if($addresses->count() > 0)
          <div class="row g-4">
            @foreach($addresses as $address)
              <div class="col-md-6">
                <div class="glass-card address-card-dashboard">
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    @if($address->is_default)
                      <span class="badge" style="background: rgba(245,158,11,0.2); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3);">
                        <i class="fas fa-star me-1"></i>Default
                      </span>
                    @endif
                    <div class="dropdown ms-auto">
                      <button class="btn btn-glass btn-sm" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis-v"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#" style="color: #f5e6cc;"><i class="fas fa-edit me-2"></i>Edit</a></li>
                        @if(!$address->is_default)
                          <li><a class="dropdown-item" href="#" style="color: #fbbf24;"><i class="fas fa-star me-2"></i>Set Default</a></li>
                        @endif
                        <li><hr class="dropdown-divider" style="border-color: rgba(255,255,255,0.1);"></li>
                        <li><a class="dropdown-item" href="#" style="color: #f43f5e;"><i class="fas fa-trash me-2"></i>Delete</a></li>
                      </ul>
                    </div>
                  </div>
                  <h6 style="color: #f5e6cc; margin-bottom: 0.5rem;">{{ $address->label ?? 'Home' }}</h6>
                  <p style="color: rgba(245,230,204,0.7); margin: 0; line-height: 1.6;">
                    <i class="fas fa-user me-2" style="color: #fbbf24;"></i>{{ $address->name }}<br>
                    <i class="fas fa-phone me-2" style="color: #fbbf24;"></i>{{ $address->phone }}<br>
                    <i class="fas fa-map-pin me-2" style="color: #fbbf24;"></i>{{ $address->address }}, {{ $address->city }}
                  </p>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="glass-card p-5 text-center">
            <i class="fas fa-map-marked-alt" style="font-size: 4rem; opacity: 0.3; margin-bottom: 1rem;"></i>
            <h5 style="color: #f5e6cc; margin-bottom: 0.5rem;">No addresses saved</h5>
            <p style="color: rgba(245,230,204,0.6); margin-bottom: 1.5rem;">
              Add your delivery address for faster checkout
            </p>
            <button class="btn btn-glow" onclick="showAddressForm()">
              <i class="fas fa-plus me-2"></i>Add Address
            </button>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

<script>
function showAddressForm() {
  document.getElementById('addressFormContainer').style.display = 'block';
  document.getElementById('addressFormContainer').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function hideAddressForm() {
  document.getElementById('addressFormContainer').style.display = 'none';
}
</script>
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
  .address-card-dashboard {
    padding: 1.5rem;
    transition: all 0.3s ease;
  }
  .address-card-dashboard:hover {
    border-color: rgba(245,158,11,0.3);
    transform: translateY(-3px);
  }

  /* Form container animation */
  #addressFormContainer {
    animation: slideDown 0.3s ease;
  }
  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>
@endpush
