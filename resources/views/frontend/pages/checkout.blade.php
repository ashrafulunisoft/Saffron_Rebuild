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

    <form method="POST" action="{{ route('checkout.store') }}" id="checkoutForm" novalidate>
      @csrf
      <div class="row g-4">
        <!-- Billing Details -->
        <div class="col-lg-8">
          <div class="glass-card p-4 mb-4">
            <h5 class="mb-4" style="color: var(--theme-text-primary);">
              <i class="fas fa-truck me-2" style="color: var(--theme-text-secondary);"></i>Billing & Shipping Information
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
                <select name="city" class="form-select input-dark" id="citySelect" required>
                  <option value="">Select City</option>
                  <option value="dhaka">Dhaka</option>
                  <option value="chittagong">Chittagong</option>
                  <option value="sylhet">Sylhet</option>
                  <option value="rajshahi">Rajshahi</option>
                  <option value="khulna">Khulna</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Shipping Location *</label>
                <select name="shipping_location" class="form-select input-dark" id="shippingLocationSelect" required>
                  <option value="">Select Shipping Location</option>
                  <option value="inside_dhaka" {{ old('shipping_location') == 'inside_dhaka' ? 'selected' : (old('shipping_location') ? '' : 'selected') }}>Inside Dhaka</option>
                  <option value="outside_dhaka" {{ old('shipping_location') == 'outside_dhaka' ? 'selected' : '' }}>Outside Dhaka</option>
                </select>
                <small class="text-white-50 mt-1" style="font-size: 0.8rem;">
                  @if($isFreeShipping)
                    <span style="color: #22c55e;"><i class="fas fa-gift me-1"></i>Free shipping applied!</span>
                  @else
                    Inside: ৳{{ number_format($shippingInsideDhaka) }} | Outside: ৳{{ number_format($shippingOutsideDhaka) }}
                  @endif
                </small>
              </div>
            </div>
          </div>

          <!-- Payment Method -->
          <div class="glass-card p-4">
            <h5 class="mb-4" style="color: var(--theme-text-primary);">
              <i class="fas fa-credit-card me-2" style="color: var(--theme-text-secondary);"></i>Payment Method
            </h5>

            <div class="row g-3">
              <div class="col-md-4">
                <label class="payment-option-card" style="display: block; padding: 1.5rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; cursor: pointer; transition: all 0.3s ease;">
                  <input type="radio" name="payment_method" value="cod" class="d-none payment-radio" required>
                  <div class="d-flex align-items-center gap-3">
                    <div style="font-size: 2rem;">💵</div>
                    <div>
                      <h6 class="mb-0" style="color: var(--theme-text-primary);">Cash on Delivery</h6>
                      <small style="color: var(--text-60);">Pay when you receive</small>
                    </div>
                  </div>
                </label>
              </div>
              <div class="col-md-4">
                <label class="payment-option-card" style="display: block; padding: 1.5rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; cursor: pointer; transition: all 0.3s ease;">
                  <input type="radio" name="payment_method" value="bkash" class="d-none payment-radio">
                  <div class="d-flex align-items-center gap-3">
                    <div style="font-size: 2rem;">📱</div>
                    <div>
                      <h6 class="mb-0" style="color: var(--theme-text-primary);">bKash</h6>
                      <small style="color: var(--text-60);">Mobile payment</small>
                    </div>
                  </div>
                </label>
              </div>
              <div class="col-md-4">
                <label class="payment-option-card" style="display: block; padding: 1.5rem; border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; cursor: pointer; transition: all 0.3s ease;">
                  <input type="radio" name="payment_method" value="card" class="d-none payment-radio">
                  <div class="d-flex align-items-center gap-3">
                    <div style="font-size: 2rem;">💳</div>
                    <div>
                      <h6 class="mb-0" style="color: var(--theme-text-primary);">Card Payment</h6>
                      <small style="color: var(--text-60);">Credit/Debit card</small>
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
            <h5 class="mb-4" style="color: var(--theme-text-primary);">
              <i class="fas fa-receipt me-2" style="color: var(--theme-text-secondary);"></i>Order Summary
            </h5>

            <div class="cart-items mb-4">
              <p class="text-center" style="color: var(--text-60);">Your cart is empty</p>
            </div>

            <!-- Coupon Code Section -->
            <div class="mb-4">
              <label style="color: var(--theme-text-primary); font-weight: 500; margin-bottom: 0.5rem; display: block;">
                <i class="fas fa-tag me-2" style="color: var(--theme-text-secondary);"></i>Coupon Code
              </label>
              <div class="input-group">
                <input type="text" id="checkoutCouponInput" class="form-control input-dark" placeholder="Enter coupon code" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: var(--theme-text-primary);">
                <button class="btn btn-glow" type="button" id="checkoutApplyCouponBtn" onclick="applyCheckoutCoupon()">
                  Apply
                </button>
              </div>
              <div id="checkoutCouponMessage" style="margin-top: 0.5rem; font-size: 0.85rem;"></div>
            </div>

            <div class="order-totals">
              <div class="d-flex justify-content-between mb-2">
                <span style="color: var(--text-70);">Subtotal:</span>
                <span id="checkoutSubtotal" style="color: var(--theme-text-primary);">৳{{ number_format($totalAmount) }}</span>
              </div>
              <div class="d-flex justify-content-between mb-2" id="checkoutDiscountRow" style="display: none;">
                <span style="color: var(--text-70);">Discount:</span>
                <span id="checkoutDiscount" style="color: #10b981;">-৳0</span>
              </div>
              <div class="d-flex justify-content-between mb-2" id="checkoutShippingRow">
                <span style="color: var(--text-70);">Shipping:</span>
                <span id="checkoutShipping" style="color: var(--theme-text-primary);">৳{{ number_format($shipping) }}</span>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span style="color: var(--text-70);">Tax:</span>
                <span style="color: var(--theme-text-primary);">৳0</span>
              </div>
              <div class="d-flex justify-content-between mb-3 pt-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <span style="color: var(--theme-text-primary); font-weight: 600;">Total:</span>
                <span id="checkoutTotal" style="color: var(--theme-text-secondary); font-weight: 700; font-size: 1.2rem;">৳{{ number_format($total) }}</span>
              </div>
            </div>

            <button type="submit" id="placeOrderBtn" class="btn btn-glow w-100 py-3" disabled>
              <i class="fas fa-lock me-2"></i>Place Order
            </button>

            <p class="text-center mt-3 mb-0" style="font-size: 0.8rem; color: var(--text-50);">
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
// Initialize totals from backend
const subtotal = {{ number_format($totalAmount, 2, '.', '') }};
const shippingInsideDhaka = {{ number_format($shippingInsideDhaka, 2, '.', '') }};
const shippingOutsideDhaka = {{ number_format($shippingOutsideDhaka, 2, '.', '') }};
const freeShippingThreshold = {{ number_format($freeShippingThreshold, 2, '.', '') }};
const isFreeShipping = {{ $isFreeShipping ? 'true' : 'false' }};

let currentShipping = {{ number_format($shipping, 2, '.', '') }};

// Function to update order totals
function updateOrderTotals() {
  const shippingLocation = document.getElementById('shippingLocationSelect').value;
  let shipping = 0;

  if (isFreeShipping) {
    shipping = 0;
  } else {
    if (shippingLocation === 'inside_dhaka') {
      shipping = shippingInsideDhaka;
    } else if (shippingLocation === 'outside_dhaka') {
      shipping = shippingOutsideDhaka;
    } else {
      shipping = shippingInsideDhaka; // Default to inside dhaka
    }
  }

  currentShipping = shipping;
  const total = parseFloat(subtotal) + parseFloat(shipping);

  // Update the display values
  document.getElementById('checkoutSubtotal').textContent = '৳' + numberFormat(subtotal);
  document.getElementById('checkoutShipping').textContent = '৳' + numberFormat(shipping);
  document.getElementById('checkoutTotal').textContent = '৳' + numberFormat(total);
}

// Format number with commas
function numberFormat(num) {
  return parseFloat(num).toLocaleString('en-BD', {
    minimumFractionDigits: 0,
    maximumFractionDigits: 0
  });
}

// Listen for shipping location changes
document.addEventListener('DOMContentLoaded', function() {
  // Setup form validation IMMEDIATELY to prevent premature submission
  setupFormValidation();

  // Setup shipping location change listener
  const shippingLocationSelect = document.getElementById('shippingLocationSelect');
  if (shippingLocationSelect) {
    shippingLocationSelect.addEventListener('change', updateOrderTotals);
  }

  // Initialize totals immediately (before cart data loads)
  updateOrderTotals();

  // Fetch cart data and re-initialize totals
  fetchCartData().then(() => {
    updateOrderTotals();
  });
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

    return true; // Return success

  } catch (error) {
    console.error('Error fetching cart:', error);
    window.location.href = '/cart';
    return false;
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
          <h6 class="mb-1" style="color: var(--theme-text-primary); font-size: 0.9rem;">${name}</h6>
          <small style="color: var(--text-60);">Qty: ${qty}</small>
        </div>
        <span style="color: var(--theme-text-secondary); font-weight: 600;">${price}</span>
      </div>
    `;
  });

  cartItemsContainer.innerHTML = itemsHTML;

  // Don't overwrite totals - they are dynamically calculated based on shipping location
  // The totals are already initialized in updateOrderTotals()
}

// Setup form validation
function setupFormValidation() {
  const form = document.getElementById('checkoutForm');
  const submitBtn = document.getElementById('placeOrderBtn');

  if (!form) {
    console.error('Checkout form not found!');
    return;
  }

  // Handle form submission - this is the most reliable method
  form.addEventListener('submit', function(e) {
    console.log('=== FORM SUBMIT TRIGGERED ===');

    // Check if payment method is selected
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const paymentSelected = Array.from(paymentMethods).some(method => method.checked);

    console.log('Payment method selected:', paymentSelected);

    if (!paymentSelected) {
      console.log('❌ No payment method selected - PREVENTING SUBMISSION');

      // Prevent the form from submitting
      e.preventDefault();
      e.stopPropagation();
      e.stopImmediatePropagation();

      // Show error toast
      showToast('Please select a payment method to place your order', 'error');

      // Shake the payment method section to draw attention
      const paymentCards = document.querySelectorAll('.payment-option-card');
      if (paymentCards.length > 0) {
        const paymentSection = paymentCards[0].closest('.glass-card');
        if (paymentSection) {
          paymentSection.style.animation = 'shake 0.5s ease-in-out';
          paymentSection.classList.add('payment-section-error');

          setTimeout(() => {
            paymentSection.style.animation = '';
            paymentSection.classList.remove('payment-section-error');
          }, 2000);

          // Scroll to payment section
          paymentSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      }

      return false;
    }

    console.log('✅ Form is valid, allowing submission');

    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';

    // Allow the form to submit naturally
    return true;
  }, false); // Use capture phase = false

  console.log('✅ Form validation setup complete');
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
    color: var(--theme-text-secondary);
    transform: translateX(3px);
  }

  .breadcrumb-modern .breadcrumb-item.active {
    color: var(--theme-text-primary);
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
    color: var(--theme-text-secondary);
  }
  .payment-option-card:has(input:checked) {
    border-color: #f59e0b !important;
    background: rgba(245,158,11,0.1);
  }
  .input-dark {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: var(--theme-text-primary);
  }
  .input-dark:focus {
    background: rgba(255,255,255,0.08);
    border-color: rgba(245,158,11,0.4);
    color: var(--theme-text-primary);
    box-shadow: 0 0 0 3px rgba(245,158,11,0.1);
  }
  .form-label {
    color: var(--text-80);
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
  }

  /* Shake animation for validation */
  @keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-10px); }
    20%, 40%, 60%, 80% { transform: translateX(10px); }
  }

  /* Payment section highlight */
  .payment-section-error {
    border: 2px solid #f43f5e !important;
    box-shadow: 0 0 20px rgba(244, 63, 94, 0.3);
  }
</style>
@endpush
