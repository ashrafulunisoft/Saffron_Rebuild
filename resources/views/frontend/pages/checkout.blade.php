@extends('frontend.layouts.app')

@section('title', 'Checkout - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb-glass">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #f59e0b; text-decoration: none;">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('shop') }}" style="color: #f59e0b; text-decoration: none;">Shop</a></li>
        <li class="breadcrumb-item active" style="color: #f5e6cc;">Checkout</li>
      </ol>
    </nav>

    <form method="POST" action="{{ route('checkout.store') }}">
      @csrf
      <div class="row g-4">
        <!-- Billing Details -->
        <div class="col-lg-8">
          <div class="glass-card p-4 mb-4">
            <h5 class="mb-4" style="color: #f5e6cc;">
              <i class="fas fa-truck me-2" style="color: #fbbf24;"></i>Billing & Shipping Information
            </h5>

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">First Name *</label>
                <input type="text" name="first_name" class="form-control input-dark" placeholder="John" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Last Name *</label>
                <input type="text" name="last_name" class="form-control input-dark" placeholder="Doe" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Email Address *</label>
                <input type="email" name="email" class="form-control input-dark" placeholder="john@example.com" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone Number *</label>
                <input type="tel" name="phone" class="form-control input-dark" placeholder="+880 1XXXXXXXXX" required>
              </div>
              <div class="col-12">
                <label class="form-label">Delivery Address *</label>
                <textarea name="address" class="form-control input-dark" rows="2" placeholder="House/Road/Area" required></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">City *</label>
                <select name="city" class="form-select input-dark" required>
                  <option value="">Select City</option>
                  <option value="dhaka">Dhaka</option>
                  <option value="chittagong">Chittagong</option>
                  <option value="sylhet">Sylhet</option>
                  <option value="rajshahi">Rajshahi</option>
                  <option value="khulna">Khulna</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Payment Method -->
          <div class="glass-card p-4">
            <h5 class="mb-4" style="color: #f5e6cc;">
              <i class="fas fa-credit-card me-2" style="color: #fbbf24;"></i>Payment Method
            </h5>

            <div class="row g-3">
              <div class="col-md-4">
                <label class="payment-option-card" style="display: block; padding: 1.5rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; cursor: pointer; transition: all 0.3s ease;">
                  <input type="radio" name="payment_method" value="cod" class="d-none" required>
                  <div class="d-flex align-items-center gap-3">
                    <div style="font-size: 2rem;">💵</div>
                    <div>
                      <h6 class="mb-0" style="color: #f5e6cc;">Cash on Delivery</h6>
                      <small style="color: rgba(245,230,204,0.6);">Pay when you receive</small>
                    </div>
                  </div>
                </label>
              </div>
              <div class="col-md-4">
                <label class="payment-option-card" style="display: block; padding: 1.5rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; cursor: pointer; transition: all 0.3s ease;">
                  <input type="radio" name="payment_method" value="bkash" class="d-none">
                  <div class="d-flex align-items-center gap-3">
                    <div style="font-size: 2rem;">📱</div>
                    <div>
                      <h6 class="mb-0" style="color: #f5e6cc;">bKash</h6>
                      <small style="color: rgba(245,230,204,0.6);">Mobile payment</small>
                    </div>
                  </div>
                </label>
              </div>
              <div class="col-md-4">
                <label class="payment-option-card" style="display: block; padding: 1.5rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; cursor: pointer; transition: all 0.3s ease;">
                  <input type="radio" name="payment_method" value="card" class="d-none">
                  <div class="d-flex align-items-center gap-3">
                    <div style="font-size: 2rem;">💳</div>
                    <div>
                      <h6 class="mb-0" style="color: #f5e6cc;">Card Payment</h6>
                      <small style="color: rgba(245,230,204,0.6);">Credit/Debit card</small>
                    </div>
                  </div>
                </label>
              </div>
            </div>
          </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
          <div class="glass-card p-4">
            <h5 class="mb-4" style="color: #f5e6cc;">
              <i class="fas fa-receipt me-2" style="color: #fbbf24;"></i>Order Summary
            </h5>

            <div class="cart-items mb-4">
              <p class="text-center" style="color: rgba(245,230,204,0.6);">Your cart is empty</p>
            </div>

            <div class="order-totals">
              <div class="d-flex justify-content-between mb-2">
                <span style="color: rgba(245,230,204,0.7);">Subtotal:</span>
                <span style="color: #f5e6cc;">৳0</span>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span style="color: rgba(245,230,204,0.7);">Tax:</span>
                <span style="color: #f5e6cc;">৳0</span>
              </div>
              <div class="d-flex justify-content-between mb-3 pt-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <span style="color: #f5e6cc; font-weight: 600;">Total:</span>
                <span style="color: #fbbf24; font-weight: 700; font-size: 1.2rem;">৳0</span>
              </div>
            </div>

            <button type="submit" class="btn btn-glow w-100 py-3" disabled>
              <i class="fas fa-lock me-2"></i>Place Order
            </button>

            <p class="text-center mt-3 mb-0" style="font-size: 0.8rem; color: rgba(245,230,204,0.5);">
              <i class="fas fa-shield-alt me-1"></i>Your payment information is secure
            </p>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@push('styles')
<style>
  .payment-option-card:hover {
    border-color: rgba(245,158,11,0.4) !important;
    background: rgba(245,158,11,0.05);
  }
  .payment-option-card input:checked + div {
    color: #fbbf24;
  }
  .payment-option-card:has(input:checked) {
    border-color: #f59e0b !important;
    background: rgba(245,158,11,0.1);
  }
  .input-dark {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: #f5e6cc;
  }
  .input-dark:focus {
    background: rgba(255,255,255,0.08);
    border-color: rgba(245,158,11,0.4);
    color: #f5e6cc;
    box-shadow: 0 0 0 3px rgba(245,158,11,0.1);
  }
  .form-label {
    color: rgba(245,230,204,0.8);
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
  }
</style>
@endpush
