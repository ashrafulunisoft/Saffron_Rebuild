@extends('frontend.layouts.app')

@section('title', 'Checkout - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb-modern">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">
            <i class="fas fa-home me-1"></i>Home
          </a>
        </li>
        <li class="breadcrumb-item">
          <a href="{{ route('shop') }}">
            <i class="fas fa-store me-1"></i>Shop
          </a>
        </li>
        <li class="breadcrumb-item active">
          <i class="fas fa-credit-card me-1"></i>Checkout
        </li>
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

            <!-- Coupon Code Section -->
            <div class="mb-4">
              <label style="color: #f5e6cc; font-weight: 500; margin-bottom: 0.5rem; display: block;">
                <i class="fas fa-tag me-2" style="color: #fbbf24;"></i>Coupon Code
              </label>
              <div class="input-group">
                <input type="text" id="checkoutCouponInput" class="form-control input-dark" placeholder="Enter coupon code" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #f5e6cc;">
                <button class="btn btn-glow" type="button" id="checkoutApplyCouponBtn" onclick="applyCheckoutCoupon()">
                  Apply
                </button>
              </div>
              <div id="checkoutCouponMessage" style="margin-top: 0.5rem; font-size: 0.85rem;"></div>
            </div>

            <div class="order-totals">
              <div class="d-flex justify-content-between mb-2">
                <span style="color: rgba(245,230,204,0.7);">Subtotal:</span>
                <span id="checkoutSubtotal" style="color: #f5e6cc;">৳0</span>
              </div>
              <div class="d-flex justify-content-between mb-2" id="checkoutDiscountRow" style="display: none;">
                <span style="color: rgba(245,230,204,0.7);">Discount:</span>
                <span id="checkoutDiscount" style="color: #10b981;">-৳0</span>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span style="color: rgba(245,230,204,0.7);">Tax:</span>
                <span style="color: #f5e6cc;">৳0</span>
              </div>
              <div class="d-flex justify-content-between mb-3 pt-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <span style="color: #f5e6cc; font-weight: 600;">Total:</span>
                <span id="checkoutTotal" style="color: #fbbf24; font-weight: 700; font-size: 1.2rem;">৳0</span>
              </div>
            </div>

            <button type="submit" id="placeOrderBtn" class="btn btn-glow w-100 py-3" disabled>
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

@push('scripts')
<script>
// Fetch cart data on page load
document.addEventListener('DOMContentLoaded', function() {
  fetchCartData();
  setupFormValidation();
});

// Fetch cart data from backend
async function fetchCartData() {
  try {
    const response = await fetch('/cart');
    if (!response.ok) throw new Error('Failed to fetch cart data');

    const html = await response.text();
    const parser = new DOMParser();
    const doc = parser.parseFromString(html, 'text/html');

    // Extract cart items from the cart page
    const cartItems = doc.querySelectorAll('.cart-item');

    if (cartItems.length === 0) {
      window.location.href = '/cart';
      return;
    }

    // Display cart items
    displayCartItems(doc);

    // Enable place order button
    document.getElementById('placeOrderBtn').disabled = false;

  } catch (error) {
    console.error('Error fetching cart:', error);
    window.location.href = '/cart';
  }
}

// Display cart items in checkout summary
function displayCartItems(doc) {
  const cartItemsContainer = document.querySelector('.cart-items');
  const cartItems = doc.querySelectorAll('.cart-item');

  let itemsHTML = '';

  cartItems.forEach(item => {
    const name = item.querySelector('.cart-item-name')?.textContent || 'Product';
    const qty = item.querySelector('.qty-input')?.value || '1';
    const price = item.querySelector('.cart-item-price')?.textContent || '৳0';

    itemsHTML += `
      <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
        <div>
          <h6 class="mb-1" style="color: #f5e6cc; font-size: 0.9rem;">${name}</h6>
          <small style="color: rgba(245,230,204,0.6);">Qty: ${qty}</small>
        </div>
        <span style="color: #fbbf24; font-weight: 600;">${price}</span>
      </div>
    `;
  });

  cartItemsContainer.innerHTML = itemsHTML;

  // Extract totals
  const subtotal = doc.querySelector('[data-subtotal]')?.getAttribute('data-subtotal') || '0';
  const shipping = doc.querySelector('[data-shipping]')?.getAttribute('data-shipping') || '0';
  const total = doc.querySelector('[data-total]')?.getAttribute('data-total') || '0';

  // Update totals
  const totalsHTML = `
    <div class="d-flex justify-content-between mb-2">
      <span style="color: rgba(245,230,204,0.7);">Subtotal:</span>
      <span style="color: #f5e6cc;">৳${subtotal}</span>
    </div>
    <div class="d-flex justify-content-between mb-2">
      <span style="color: rgba(245,230,204,0.7);">Shipping:</span>
      <span style="color: #f5e6cc;">৳${shipping}</span>
    </div>
    <div class="d-flex justify-content-between mb-2">
      <span style="color: rgba(245,230,204,0.7);">Tax:</span>
      <span style="color: #f5e6cc;">৳0</span>
    </div>
    <div class="d-flex justify-content-between mb-3 pt-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
      <span style="color: #f5e6cc; font-weight: 600;">Total:</span>
      <span style="color: #fbbf24; font-weight: 700; font-size: 1.2rem;">৳${total}</span>
    </div>
  `;

  document.querySelector('.order-totals').innerHTML = totalsHTML;
}

// Setup form validation
function setupFormValidation() {
  const form = document.querySelector('form');
  const submitBtn = document.getElementById('placeOrderBtn');
  const requiredFields = form.querySelectorAll('[required]');

  // Check if all required fields are filled
  function checkFormValidity() {
    let isValid = true;

    requiredFields.forEach(field => {
      if (field.type === 'radio') {
        const radioGroup = form.querySelectorAll(`[name="${field.name}"]`);
        const isChecked = Array.from(radioGroup).some(radio => radio.checked);
        if (!isChecked) isValid = false;
      } else {
        if (!field.value.trim()) isValid = false;
      }
    });

    submitBtn.disabled = !isValid;
  }

  // Add event listeners to all required fields
  requiredFields.forEach(field => {
    field.addEventListener('change', checkFormValidity);
    field.addEventListener('input', checkFormValidity);
  });

  // Initial check
  checkFormValidity();

  // Handle form submission
  form.addEventListener('submit', function(e) {
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
  });
}

// Apply coupon code in checkout
function applyCheckoutCoupon() {
  const couponInput = document.getElementById('checkoutCouponInput');
  const couponCode = couponInput.value.trim();
  const messageDiv = document.getElementById('checkoutCouponMessage');
  const applyBtn = document.getElementById('checkoutApplyCouponBtn');
  const discountRow = document.getElementById('checkoutDiscountRow');
  const discountAmount = document.getElementById('checkoutDiscount');
  const checkoutTotal = document.getElementById('checkoutTotal');

  if (!couponCode) {
    messageDiv.innerHTML = '<span style="color: #f43f5e;"><i class="fas fa-exclamation-circle me-1"></i>Please enter a coupon code</span>';
    return;
  }

  // Show loading state
  applyBtn.disabled = true;
  applyBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
  messageDiv.innerHTML = '';

  fetch('/cart/apply-coupon', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify({ coupon_code: couponCode })
  })
  .then(async response => {
    const contentType = response.headers.get('content-type');

    if (contentType && contentType.includes('application/json')) {
      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.message || 'Invalid coupon code');
      }
      return data;
    } else {
      const text = await response.text();
      throw new Error('Server error. Please try again.');
    }
  })
  .then(data => {
    if (data.success) {
      // Show success message
      messageDiv.innerHTML = `<span style="color: #10b981;"><i class="fas fa-check-circle me-1"></i>${data.message}</span>`;

      // Update discount display
      if (data.discount > 0) {
        discountRow.style.display = 'flex';
        discountAmount.textContent = `-৳${data.discount}`;

        // Update total
        if (checkoutTotal && data.new_total) {
          checkoutTotal.textContent = `৳${data.new_total}`;
        }
      }

      // Disable coupon input after successful application
      couponInput.disabled = true;
      applyBtn.innerHTML = '<i class="fas fa-check"></i> Applied';
      applyBtn.classList.remove('btn-glow');
      applyBtn.classList.add('btn-success');
    } else {
      messageDiv.innerHTML = `<span style="color: #f43f5e;"><i class="fas fa-times-circle me-1"></i>${data.message}</span>`;
      applyBtn.disabled = false;
      applyBtn.innerHTML = 'Apply';
    }
  })
  .catch(error => {
    console.error('Error:', error);
    messageDiv.innerHTML = `<span style="color: #f43f5e;"><i class="fas fa-exclamation-circle me-1"></i>${error.message || 'Failed to apply coupon'}</span>`;
    applyBtn.disabled = false;
    applyBtn.innerHTML = 'Apply';
  });
}
</script>
@endpush

@push('styles')
<style>
  /* Modern Breadcrumb Styles */
  .breadcrumb-modern {
    display: flex;
    align-items: center;
    list-style: none;
    padding: 1rem 1.5rem;
    margin: 0;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    overflow: hidden;
    position: relative;
  }

  .breadcrumb-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #f59e0b, #f43f5e);
    border-radius: 16px 16px 0 0;
  }

  .breadcrumb-modern .breadcrumb-item {
    display: flex;
    align-items: center;
    color: rgba(245, 230, 204, 0.7);
    font-size: 0.9rem;
    font-weight: 500;
    position: relative;
  }

  .breadcrumb-modern .breadcrumb-item + .breadcrumb-item {
    margin-left: 1rem;
    padding-left: 1.5rem;
  }

  .breadcrumb-modern .breadcrumb-item + .breadcrumb-item::before {
    content: '\f105';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    position: absolute;
    left: 0;
    color: rgba(245, 158, 11, 0.5);
    font-size: 0.8rem;
  }

  .breadcrumb-modern .breadcrumb-item a {
    color: #f59e0b;
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    background: transparent;
  }

  .breadcrumb-modern .breadcrumb-item a:hover {
    background: rgba(245, 158, 11, 0.15);
    color: #fbbf24;
    transform: translateX(3px);
  }

  .breadcrumb-modern .breadcrumb-item.active {
    color: #f5e6cc;
    font-weight: 600;
    display: flex;
    align-items: center;
    padding: 0.4rem 0.8rem;
    background: rgba(245, 158, 11, 0.1);
    border-radius: 8px;
    border: 1px solid rgba(245, 158, 11, 0.2);
  }

  .breadcrumb-modern .breadcrumb-item i {
    font-size: 0.85rem;
    opacity: 0.8;
  }

  /* Responsive Breadcrumb */
  @media (max-width: 768px) {
    .breadcrumb-modern {
      padding: 0.75rem 1rem;
      font-size: 0.85rem;
    }

    .breadcrumb-modern .breadcrumb-item + .breadcrumb-item {
      margin-left: 0.5rem;
      padding-left: 1rem;
    }

    .breadcrumb-modern .breadcrumb-item a,
    .breadcrumb-modern .breadcrumb-item.active {
      padding: 0.3rem 0.6rem;
    }
  }

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
