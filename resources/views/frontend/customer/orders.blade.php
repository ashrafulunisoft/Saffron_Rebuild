@extends('frontend.layouts.app')

@section('title', 'My Orders - Saffron Sweets & Bakery')

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
            <span class="badge" style="background: rgba(245,158,11,0.2); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3);">
              Customer
            </span>
          </div>

          <!-- Navigation Menu -->
          <nav class="customer-nav">
            <a href="{{ route('customer.dashboard') }}" class="customer-nav-item">
              <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a href="{{ route('customer.orders') }}" class="customer-nav-item active">
              <i class="fas fa-shopping-bag me-2"></i> My Orders
              @if(auth()->user()->orders()->count() > 0)
                <span class="nav-badge">{{ auth()->user()->orders()->count() }}</span>
              @endif
            </a>
            <a href="{{ route('customer.wishlist') }}" class="customer-nav-item">
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
            <i class="fas fa-shopping-bag me-2" style="color: #fbbf24;"></i>My Orders
          </h4>
          <p style="color: rgba(245,230,204,0.7); margin: 0;">
            Track and manage all your orders
          </p>
        </div>

        <!-- Orders List -->
        @if($orders->count() > 0)
          <div class="row g-4">
            @foreach($orders as $order)
              <div class="col-12">
                <div class="glass-card order-card-dashboard">
                  <div class="row align-items-center">
                    <div class="col-md-2">
                      <div class="order-icon-dashboard">
                        <i class="fas fa-box"></i>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <h6 style="color: #fbbf24; margin-bottom: 0.25rem;">#{{ $order->order_number }}</h6>
                      <small style="color: rgba(245,230,204,0.6);">{{ $order->created_at->format('M d, Y') }}</small>
                    </div>
                    <div class="col-md-2">
                      <span class="status-badge status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                      </span>
                    </div>
                    <div class="col-md-2">
                      <span style="color: #f5e6cc; font-weight: 600;">৳{{ number_format($order->final_amount) }}</span>
                    </div>
                    <div class="col-md-3 text-end">
                      <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-glow btn-sm">
                        <i class="fas fa-eye me-2"></i>View Details
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          <!-- Pagination -->
          @if($orders->hasPages())
            <div class="mt-4">
              {{ $orders->appends(request()->query())->links() }}
            </div>
          @endif
        @else
          <div class="glass-card p-5 text-center">
            <i class="fas fa-shopping-basket" style="font-size: 4rem; opacity: 0.3; margin-bottom: 1rem;"></i>
            <h5 style="color: #f5e6cc; margin-bottom: 0.5rem;">No Orders Yet</h5>
            <p style="color: rgba(245,230,204,0.6); margin-bottom: 1.5rem;">
              Start exploring our delicious collection
            </p>
            <a href="{{ route('shop') }}" class="btn btn-glow">
              <i class="fas fa-shopping-bag me-2"></i>Start Shopping
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
  .nav-badge {
    margin-left: auto;
    background: linear-gradient(135deg, #f43f5e, #e11d48);
    color: white;
    padding: 0.2rem 0.6rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
  }
  .order-card-dashboard {
    padding: 1.25rem;
    transition: all 0.3s ease;
  }
  .order-card-dashboard:hover {
    border-color: rgba(245,158,11,0.3);
    transform: translateY(-3px);
  }
  .order-icon-dashboard {
    width: 50px;
    height: 50px;
    background: rgba(245,158,11,0.1);
    border: 1px solid rgba(245,158,11,0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fbbf24;
    font-size: 1.25rem;
  }
  .status-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: capitalize;
    display: inline-block;
  }
  .status-pending {
    background: rgba(245, 158, 11, 0.2);
    color: #fbbf24;
  }
  .status-processing {
    background: rgba(59, 130, 246, 0.2);
    color: #3b82f6;
  }
  .status-delivered {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
  }
  .status-cancelled {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
  }
</style>
@endpush
