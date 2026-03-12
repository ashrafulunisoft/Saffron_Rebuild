@extends('frontend.layouts.app')

@section('title', 'My Wishlist - Saffron Sweets & Bakery')

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
            <a href="{{ route('customer.wishlist') }}" class="customer-nav-item active">
              <i class="fas fa-heart me-2"></i> Wishlist
            </a>
            <a href="{{ route('customer.addresses') }}" class="customer-nav-item">
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
          <h4 style="color: #f5e6cc; margin-bottom: 0.5rem;">
            <i class="fas fa-heart me-2" style="color: #f43f5e;"></i>My Wishlist
          </h4>
          <p style="color: rgba(245,230,204,0.7); margin: 0;">
            Items you've saved for later
          </p>
        </div>

        <!-- Wishlist Items -->
        @if($wishlist->count() > 0)
          <div class="row g-4">
            @foreach($wishlist as $item)
              <div class="col-6 col-md-4 col-lg-3">
                <div class="prod-card">
                  <div class="prod-img-wrapper">
                    @if($item->product && $item->product->image)
                      <img src="{{ asset('storage/products/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                    @else
                      <div class="prod-img-placeholder">
                        <i class="fas fa-cookie"></i>
                      </div>
                    @endif
                    <button class="prod-wishlist prod-wishlisted" data-product="{{ $item->product->id ?? '' }}">
                      <i class="fas fa-heart"></i>
                    </button>
                    @if($item->product && $item->product->stock < 10)
                      <span class="prod-badge-low">Low Stock</span>
                    @elseif($item->product && $item->product->is_new)
                      <span class="prod-badge-new">New</span>
                    @endif
                  </div>
                  <div class="prod-details">
                    <h5 class="prod-title">{{ $item->product->name ?? 'N/A' }}</h5>
                    <p class="prod-cat">{{ $item->product->category->name_en ?? 'General' }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <span class="prod-price">৳{{ number_format($item->product->price ?? 0) }}</span>
                      <button class="prod-cart-btn">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="glass-card p-5 text-center">
            <i class="fas fa-heart" style="font-size: 4rem; opacity: 0.3; color: #f43f5e; margin-bottom: 1rem;"></i>
            <h5 style="color: #f5e6cc; margin-bottom: 0.5rem;">Your wishlist is empty</h5>
            <p style="color: rgba(245,230,204,0.6); margin-bottom: 1.5rem;">
              Save your favorite treats for later
            </p>
            <a href="{{ route('shop') }}" class="btn btn-glow">
              <i class="fas fa-shopping-bag me-2"></i>Explore Products
            </a>
          </div>
        @endif
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
