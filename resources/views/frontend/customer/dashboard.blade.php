@extends('frontend.layouts.app')

@section('title', 'My Dashboard - Saffron Sweets & Bakery')

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
              {{ ucfirst(auth()->user()->roles->first()->name ?? 'Customer') }}
            </span>
          </div>

          <!-- Navigation Menu -->
          <nav class="customer-nav">
            <a href="{{ route('customer.dashboard') }}" class="customer-nav-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
              <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a href="{{ route('customer.orders') }}" class="customer-nav-item {{ request()->routeIs('customer.orders*') ? 'active' : '' }}">
              <i class="fas fa-shopping-bag me-2"></i> My Orders
              @if(auth()->user()->orders()->count() > 0)
                <span class="nav-badge">{{ auth()->user()->orders()->count() }}</span>
              @endif
            </a>
            <a href="{{ route('customer.wishlist') }}" class="customer-nav-item {{ request()->routeIs('customer.wishlist') ? 'active' : '' }}">
              <i class="fas fa-heart me-2"></i> Wishlist
              @if(auth()->user()->wishlist_count > 0)
                <span class="nav-badge">{{ auth()->user()->wishlist_count }}</span>
              @endif
            </a>
            <a href="{{ route('customer.addresses') }}" class="customer-nav-item {{ request()->routeIs('customer.addresses*') ? 'active' : '' }}">
              <i class="fas fa-map-marker-alt me-2"></i> Addresses
            </a>
            <a href="{{ route('customer.profile') }}" class="customer-nav-item {{ request()->routeIs('customer.profile') ? 'active' : '' }}">
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
        <!-- Dashboard Overview -->
        @if(request()->routeIs('customer.dashboard'))
          <!-- Welcome Message -->
          <div class="glass-card p-4 mb-4">
            <h4 style="color: #f5e6cc; margin-bottom: 0.5rem;">
              <i class="fas fa-sun me-2" style="color: #fbbf24;"></i>
              Welcome back, {{ auth()->user()->name }}!
            </h4>
            <p style="color: rgba(245,230,204,0.7);">
              Here's what's happening with your account today.
            </p>
          </div>

          <!-- Stats Cards -->
          <div class="row g-4 mb-4">
            <div class="col-md-3">
              <div class="stat-card-dashboard">
                <div class="stat-icon-dashboard" style="background: rgba(59, 130, 246, 0.2);">
                  <i class="fas fa-shopping-bag" style="color: #3b82f6;"></i>
                </div>
                <div>
                  <h3 style="color: #f5e6cc; margin: 0;">{{ auth()->user()->orders()->count() }}</h3>
                  <small style="color: rgba(245,230,204,0.6);">Total Orders</small>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card-dashboard">
                <div class="stat-icon-dashboard" style="background: rgba(34, 197, 94, 0.2);">
                  <i class="fas fa-check-circle" style="color: #22c55e;"></i>
                </div>
                <div>
                  <h3 style="color: #f5e6cc; margin: 0;">{{ auth()->user()->orders()->where('status', 'delivered')->count() }}</h3>
                  <small style="color: rgba(245,230,204,0.6);">Completed</small>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card-dashboard">
                <div class="stat-icon-dashboard" style="background: rgba(245, 158, 11, 0.2);">
                  <i class="fas fa-clock" style="color: #f59e0b;"></i>
                </div>
                <div>
                  <h3 style="color: #f5e6cc; margin: 0;">{{ auth()->user()->orders()->where('status', 'pending')->count() }}</h3>
                  <small style="color: rgba(245,230,204,0.6);">Pending</small>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card-dashboard">
                <div class="stat-icon-dashboard" style="background: rgba(244, 63, 94, 0.2);">
                  <i class="fas fa-heart" style="color: #f43f5e;"></i>
                </div>
                <div>
                  <h3 style="color: #f5e6cc; margin: 0;">{{ auth()->user()->wishlist_count ?? 0 }}</h3>
                  <small style="color: rgba(245,230,204,0.6);">Wishlist</small>
                </div>
              </div>
            </div>
          </div>

          <!-- Recent Orders -->
          <div class="glass-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 style="color: #f5e6cc; margin: 0;">
                <i class="fas fa-history me-2" style="color: #fbbf24;"></i>Recent Orders
              </h5>
              <a href="{{ route('customer.orders') }}" class="btn-link">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>

            @if(auth()->user()->orders()->count() > 0)
              <div class="table-responsive">
                <table class="table-custom-dashboard">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Date</th>
                      <th>Items</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach(auth()->user()->orders()->latest()->limit(5)->get() as $order)
                    <tr>
                      <td>
                        <span style="color: #fbbf24; font-weight: 600;">#{{ $order->order_number }}</span>
                      </td>
                      <td>{{ $order->created_at->format('M d, Y') }}</td>
                      <td>{{ $order->items_count ?? $order->items->count() }} items</td>
                      <td>৳{{ number_format($order->final_amount) }}</td>
                      <td>
                        <span class="status-badge status-{{ $order->status }}">
                          {{ ucfirst($order->status) }}
                        </span>
                      </td>
                      <td>
                        <a href="{{ route('customer.orders.show', $order) }}" class="btn-view-sm" title="View Order">
                          <i class="fas fa-eye"></i>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <div class="text-center py-5">
                <i class="fas fa-shopping-basket" style="font-size: 4rem; opacity: 0.3; margin-bottom: 1rem;"></i>
                <p style="color: rgba(245,230,204,0.6);">No orders yet</p>
                <a href="{{ route('shop') }}" class="btn btn-glow btn-sm mt-3">
                  <i class="fas fa-shopping-bag me-2"></i>Start Shopping
                </a>
              </div>
            @endif
          </div>
        @endif

        <!-- Orders Page -->
        @if(request()->routeIs('customer.orders'))
          @yield('customer-orders-content')
        @endif

        <!-- Wishlist Page -->
        @if(request()->routeIs('customer.wishlist'))
          @yield('customer-wishlist-content')
        @endif

        <!-- Profile Page -->
        @if(request()->routeIs('customer.profile'))
          @yield('customer-profile-content')
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
    position: relative;
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
  .stat-card-dashboard {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    transition: all 0.3s ease;
  }
  .stat-card-dashboard:hover {
    transform: translateY(-5px);
    border-color: rgba(245,158,11,0.3);
    box-shadow: 0 10px 30px rgba(245,158,11,0.2);
  }
  .stat-icon-dashboard {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
  }
  .table-custom-dashboard {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
  }
  .table-custom-dashboard thead th {
    background: rgba(15, 23, 42, 0.6);
    color: #fbbf24;
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }
  .table-custom-dashboard tbody tr {
    border-bottom: 1px solid rgba(255,255,255,0.05);
    transition: all 0.3s ease;
  }
  .table-custom-dashboard tbody tr:hover {
    background: rgba(245,158,11,0.05);
  }
  .table-custom-dashboard td {
    padding: 1rem;
    color: rgba(245,230,204,0.8);
  }
  .status-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: capitalize;
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
  .btn-view-sm {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: rgba(245,158,11,0.1);
    border: 1px solid rgba(245,158,11,0.3);
    color: #fbbf24;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
  }
  .btn-view-sm:hover {
    background: rgba(245,158,11,0.2);
    transform: scale(1.1);
  }
  .btn-link {
    color: #fbbf24;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
  }
  .btn-link:hover {
    color: #f59e0b;
  }
</style>
@endpush
