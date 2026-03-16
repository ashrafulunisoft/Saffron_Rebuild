@extends('frontend.layouts.app')

@section('title', 'Order #{{ $order->order_number }} - Saffron Sweets & Bakery')

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
          <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
              <h4 style="color: #f5e6cc; margin-bottom: 0.5rem;">
                <i class="fas fa-receipt me-2" style="color: #fbbf24;"></i>Order #{{ $order->order_number }}
              </h4>
              <p style="color: rgba(245,230,204,0.7); margin: 0;">
                Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}
              </p>
            </div>
            <div class="d-flex gap-2 align-items-center flex-wrap">
              <span class="status-badge status-{{ $order->status }}" style="font-size: 1rem; padding: 0.5rem 1rem;">
                {{ ucfirst($order->status) }}
              </span>
              @if($order->payment_status === 'unpaid')
                <span class="status-badge" style="background: rgba(245, 158, 11, 0.2); color: #fbbf24; font-size: 0.9rem; padding: 0.4rem 0.8rem;">
                  <i class="fas fa-clock me-1"></i> Unpaid
                </span>
              @elseif($order->payment_status === 'paid')
                <span class="status-badge" style="background: rgba(34, 197, 94, 0.2); color: #22c55e; font-size: 0.9rem; padding: 0.4rem 0.8rem;">
                  <i class="fas fa-check-circle me-1"></i> Paid
                </span>
              @endif

              <!-- Invoice Download Button -->
              <a href="{{ route('customer.orders.invoice', $order) }}" target="_blank" class="btn btn-glow" style="font-size: 0.9rem; padding: 0.5rem 1rem; text-decoration: none;">
                <i class="fas fa-file-invoice me-1"></i> Invoice
              </a>
            </div>
          </div>
        </div>

        <!-- Order Items -->
        <div class="glass-card p-4 mb-4">
          <h5 style="color: #f5e6cc; margin-bottom: 1.5rem;">
            <i class="fas fa-boxes me-2" style="color: #fbbf24;"></i>Order Items
          </h5>
          <div class="order-detail-items">
            @foreach($order->orderItems as $item)
              <div class="order-detail-item">
                <div style="width: 80px; height: 80px; border-radius: 12px; overflow: hidden; flex-shrink: 0;">
                  @if($item->product && $item->product->image)
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                  @else
                    <div style="width: 100%; height: 100%; background: rgba(245,158,11,0.1); display: flex; align-items: center; justify-content: center;">
                      <i class="fas fa-cookie" style="color: #fbbf24; font-size: 2rem;"></i>
                    </div>
                  @endif
                </div>
                <div style="flex: 1;">
                  <h6 style="color: #f5e6cc; margin-bottom: 0.25rem;">{{ $item->product->name ?? 'N/A' }}</h6>
                  <p style="color: rgba(245,230,204,0.6); font-size: 0.9rem; margin: 0;">
                    Qty: {{ $item->quantity }} × ৳{{ number_format($item->price) }}
                  </p>
                </div>
                <div style="text-align: right;">
                  <span style="color: #fbbf24; font-weight: 600;">৳{{ number_format($item->quantity * $item->price) }}</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Order Info -->
        <div class="row g-4 mb-4">
          <!-- Shipping Address -->
          <div class="col-md-6">
            <div class="glass-card p-4 h-100">
              <h5 style="color: #f5e6cc; margin-bottom: 1rem;">
                <i class="fas fa-map-marker-alt me-2" style="color: #fbbf24;"></i>Shipping Address
              </h5>
              @if($order->shipping_address)
                @php $address = json_decode($order->shipping_address, true); @endphp
                <div style="color: rgba(245,230,204,0.8);">
                  <p style="margin-bottom: 0.5rem; font-weight: 600; color: #f5e6cc;">{{ $address['first_name'] ?? '' }} {{ $address['last_name'] ?? '' }}</p>
                  <p style="margin-bottom: 0.25rem;">{{ $address['email'] ?? '' }}</p>
                  <p style="margin-bottom: 0.25rem;">{{ $address['phone'] ?? '' }}</p>
                  <p style="margin: 0;">{{ $address['address'] ?? '' }}, {{ $address['city'] ?? '' }}</p>
                </div>
              @else
                <p style="color: rgba(245,230,204,0.6);">No shipping address available</p>
              @endif
            </div>
          </div>

          <!-- Order Summary -->
          <div class="col-md-6">
            <div class="glass-card p-4 h-100">
              <h5 style="color: #f5e6cc; margin-bottom: 1rem;">
                <i class="fas fa-calculator me-2" style="color: #fbbf24;"></i>Order Summary
              </h5>
              <div class="d-flex justify-content-between mb-2">
                <span style="color: rgba(245,230,204,0.7);">Subtotal</span>
                <span style="color: #f5e6cc;">৳{{ number_format($order->total_amount) }}</span>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span style="color: rgba(245,230,204,0.7);">Delivery</span>
                <span style="color: #f5e6cc;">৳{{ number_format($order->final_amount - $order->total_amount + ($order->discount ?? 0)) }}</span>
              </div>
              @if($order->discount > 0)
              <div class="d-flex justify-content-between mb-2">
                <span style="color: rgba(245,230,204,0.7);">Discount</span>
                <span style="color: #22c55e;">-৳{{ number_format($order->discount) }}</span>
              </div>
              @if($order->coupon)
              <div class="d-flex justify-content-between mb-2" style="background: rgba(34, 197, 94, 0.1); padding: 0.5rem; border-radius: 8px; margin-top: 0.5rem;">
                <div>
                  <span style="color: rgba(245,230,204,0.7); font-size: 0.85rem;">
                    <i class="fas fa-ticket-alt me-1" style="color: #22c55e;"></i>Coupon Applied
                  </span>
                  <div style="color: #22c55e; font-weight: 600; font-size: 1.1rem; margin-top: 0.25rem;">
                    {{ $order->coupon->code }}
                  </div>
                </div>
                @if($order->coupon->discount_type === 'percentage')
                <div style="text-align: right;">
                  <span style="color: #22c55e; font-weight: 600;">{{ $order->coupon->value }}%</span>
                  <div style="color: rgba(245,230,204,0.5); font-size: 0.75rem;">{{ $order->coupon->description ?? 'Discount' }}</div>
                </div>
                @else
                <div style="text-align: right;">
                  <span style="color: #22c55e; font-weight: 600;">৳{{ number_format($order->coupon->value) }}</span>
                  <div style="color: rgba(245,230,204,0.5); font-size: 0.75rem;">{{ $order->coupon->description ?? 'Flat Discount' }}</div>
                </div>
                @endif
              </div>
              @endif
              @endif
              <hr style="border-color: rgba(255,255,255,0.1); margin: 0.75rem 0;">
              <div class="d-flex justify-content-between mb-2">
                <span style="color: rgba(245,230,204,0.7);">Payment Status</span>
                @if($order->payment_status === 'paid')
                  <span style="color: #22c55e; font-weight: 600;">
                    <i class="fas fa-check-circle me-1"></i> Paid
                  </span>
                @else
                  <span style="color: #fbbf24; font-weight: 600;">
                    <i class="fas fa-clock me-1"></i> Unpaid
                  </span>
                @endif
              </div>
              <div class="d-flex justify-content-between">
                <span style="color: #fbbf24; font-weight: 600;">Total</span>
                <span style="color: #fbbf24; font-weight: 600; font-size: 1.1rem;">৳{{ number_format($order->final_amount) }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Payment Section - Only for unpaid orders -->
        @if($order->payment_status === 'unpaid')
          <div class="glass-card payment-pulse p-4 mb-4" style="border: 1px solid rgba(245,158,11,0.3); background: linear-gradient(135deg, rgba(245,158,11,0.05), rgba(244,63,94,0.02));">
            <div class="row align-items-center">
              <div class="col-md-9">
                <h5 style="color: #fbbf24; margin-bottom: 0.5rem;">
                  <i class="fas fa-exclamation-circle me-2"></i>Payment Required
                </h5>
                <p style="color: rgba(245,230,204,0.7); margin: 0;">
                  Complete your payment of <strong style="color: #fbbf24;">৳{{ number_format($order->final_amount) }}</strong> to proceed with order processing
                </p>
                <div class="mt-2">
                  <small style="color: rgba(245,230,204,0.5);">
                    <i class="fas fa-shield-alt me-1"></i>Secure payment powered by SSLCommerz
                  </small>
                </div>
              </div>
              <div class="col-md-3 text-end">
                <form method="POST" action="{{ route('payment.pay') }}">
                  @csrf
                  <input type="hidden" name="order_id" value="{{ $order->id }}">
                  <button type="submit" class="btn btn-glow w-100">
                    <i class="fas fa-credit-card me-2"></i>Pay Now
                  </button>
                </form>
              </div>
            </div>
          </div>
        @endif

        <!-- Back Button -->
        <a href="{{ route('customer.orders') }}" class="btn btn-glass">
          <i class="fas fa-arrow-left me-2"></i>Back to Orders
        </a>
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
    background: rgba(245, 158, 11, 0.3);
    color: #fbbf24;
    padding: 0.2rem 0.5rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-left: auto;
  }
  .order-detail-items {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }
  .order-detail-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.06);
    border-radius: 12px;
    transition: all 0.3s ease;
  }
  .order-detail-item:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(245,158,11,0.2);
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

  /* Payment Alert Pulse Animation */
  @keyframes payment-pulse {
    0%, 100% {
      box-shadow: 0 0 5px rgba(245, 158, 11, 0.3),
                  0 0 10px rgba(245, 158, 11, 0.2);
    }
    50% {
      box-shadow: 0 0 15px rgba(245, 158, 11, 0.4),
                  0 0 25px rgba(245, 158, 11, 0.3);
    }
  }

  .payment-pulse {
    animation: payment-pulse 2s ease-in-out infinite;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .payment-pulse .col-md-9,
    .payment-pulse .col-md-3 {
      text-align: center !important;
    }

    .payment-pulse form {
      margin-top: 1rem;
    }

    .payment-pulse .btn-glow {
      width: 100%;
    }
  }
</style>
@endpush
