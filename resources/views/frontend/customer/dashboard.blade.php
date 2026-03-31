@extends('frontend.layouts.app')

@section('title', 'My Dashboard - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <div class="row g-4">
      <!-- Sidebar -->
      <div class="col-lg-3">
        <div class="glass-card p-4">
          @include('frontend.customer.partials.sidebar')
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

          <!-- Available Coupons -->
          <div id="coupons"></div>
          @php
            $availableCoupons = \App\Models\Coupon::where(function($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })->where(function($q) {
                $q->whereNull('usage_limit')->orWhereRaw('usage_count < usage_limit');
            })->orderBy('created_at', 'desc')->get();
          @endphp
          @if($availableCoupons->count() > 0)
          <div class="glass-card p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 style="color: #f5e6cc; margin: 0;">
                <i class="fas fa-ticket-alt me-2" style="color: #fbbf24;"></i>Available Coupons
              </h5>
              <span class="badge" style="background: rgba(34, 197, 94, 0.2); color: #22c55e; border: 1px solid rgba(34, 197, 94, 0.3);">
                {{ $availableCoupons->count() }} Active
              </span>
            </div>

            <div class="row g-3">
              @foreach($availableCoupons as $coupon)
                @php
                  $customerUsage = $coupon->getCustomerUsageCount(auth()->id());
                @endphp
                <div class="col-md-6 col-lg-4">
                  <div class="coupon-card">
                    <div class="coupon-discount">
                      @if($coupon->type === 'percent')
                        <span class="discount-value">{{ $coupon->value }}%</span>
                        <span class="discount-label">OFF</span>
                        @if($coupon->max_discount)
                          <small class="max-discount">Max ৳{{ number_format($coupon->max_discount) }}</small>
                        @endif
                      @else
                        <span class="discount-value">৳{{ number_format($coupon->value) }}</span>
                        <span class="discount-label">FLAT</span>
                      @endif
                    </div>
                    <div class="coupon-details">
                      <div class="coupon-code" onclick="copyCouponCode('{{ $coupon->code }}')">
                        <span>{{ $coupon->code }}</span>
                        <i class="fas fa-copy"></i>
                      </div>
                      <div class="coupon-meta">
                        @if($coupon->expires_at)
                          <small><i class="far fa-calendar me-1"></i>Expires: {{ $coupon->expires_at->format('M d, Y') }}</small>
                        @else
                          <small><i class="far fa-calendar me-1"></i>No expiry</small>
                        @endif
                        <small class="mt-1 d-block">
                          <i class="fas fa-user-check me-1"></i>You used: {{ $customerUsage }} time(s)
                        </small>
                        @if($coupon->usage_limit)
                          @php $remaining = $coupon->usage_limit - $coupon->usage_count; @endphp
                          <small class="mt-1 d-block {{ $remaining <= 5 ? 'text-warning' : '' }}">
                            <i class="fas fa-fire me-1"></i>{{ $remaining }} left for everyone
                          </small>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
          @endif

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
                      <td>{{ $order->orderItems->count() }} items</td>
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

  /* Coupon Card Styles */
  .coupon-card {
    background: linear-gradient(135deg, rgba(15, 23, 42, 0.8), rgba(30, 41, 59, 0.6));
    border: 1px dashed rgba(245, 158, 11, 0.4);
    border-radius: 16px;
    padding: 1.25rem;
    height: 100%;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
  }
  .coupon-card::before {
    content: '';
    position: absolute;
    top: 50%;
    left: -10px;
    width: 20px;
    height: 20px;
    background: #0f172a;
    border-radius: 50%;
    transform: translateY(-50%);
  }
  .coupon-card::after {
    content: '';
    position: absolute;
    top: 50%;
    right: -10px;
    width: 20px;
    height: 20px;
    background: #0f172a;
    border-radius: 50%;
    transform: translateY(-50%);
  }
  .coupon-card:hover {
    border-color: rgba(245, 158, 11, 0.8);
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(245, 158, 11, 0.2);
  }
  .coupon-discount {
    text-align: center;
    padding: 0.5rem 0;
  }
  .discount-value {
    display: block;
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  .discount-label {
    font-size: 0.75rem;
    color: rgba(245, 230, 204, 0.6);
    text-transform: uppercase;
    letter-spacing: 2px;
  }
  .max-discount {
    display: block;
    color: rgba(245, 230, 204, 0.5);
    font-size: 0.75rem;
    margin-top: 0.25rem;
  }
  .coupon-code {
    background: rgba(245, 158, 11, 0.15);
    border: 1px solid rgba(245, 158, 11, 0.3);
    border-radius: 8px;
    padding: 0.5rem 0.75rem;
    margin: 1rem 0;
    font-family: 'Courier New', monospace;
    font-weight: 700;
    color: #fbbf24;
    font-size: 0.9rem;
    letter-spacing: 1px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
  }
  .coupon-code:hover {
    background: rgba(245, 158, 11, 0.25);
  }
  .coupon-code i {
    opacity: 0.6;
    transition: opacity 0.3s ease;
  }
  .coupon-code:hover i {
    opacity: 1;
  }
  .coupon-meta {
    border-top: 1px dashed rgba(255, 255, 255, 0.1);
    padding-top: 0.75rem;
    margin-top: 0.75rem;
  }
  .coupon-meta small {
    color: rgba(245, 230, 204, 0.5);
    display: block;
    font-size: 0.75rem;
  }
  .coupon-meta small i {
    width: 16px;
    text-align: center;
  }
  .text-warning {
    color: #fbbf24 !important;
  }
</style>
@endpush

@push('scripts')
<script>
function copyCouponCode(code) {
  navigator.clipboard.writeText(code).then(function() {
    // Show toast notification
    const toast = document.createElement('div');
    toast.className = 'coupon-toast';
    toast.innerHTML = '<i class="fas fa-check-circle"></i> Coupon code copied: <strong>' + code + '</strong>';
    document.body.appendChild(toast);

    setTimeout(function() {
      toast.classList.add('show');
    }, 10);

    setTimeout(function() {
      toast.classList.remove('show');
      setTimeout(function() {
        toast.remove();
      }, 300);
    }, 3000);
  }).catch(function(err) {
    console.error('Failed to copy:', err);
  });
}
</script>
<style>
.coupon-toast {
  position: fixed;
  bottom: 30px;
  left: 50%;
  transform: translateX(-50%) translateY(100px);
  background: linear-gradient(135deg, #22c55e, #16a34a);
  color: white;
  padding: 1rem 2rem;
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(34, 197, 94, 0.4);
  z-index: 10000;
  opacity: 0;
  transition: all 0.3s ease;
}
.coupon-toast.show {
  opacity: 1;
  transform: translateX(-50%) translateY(0);
}
.coupon-toast i {
  margin-right: 0.5rem;
}
.coupon-toast strong {
  background: rgba(255,255,255,0.2);
  padding: 0.2rem 0.5rem;
  border-radius: 4px;
  margin-left: 0.5rem;
}
</style>
@endpush
