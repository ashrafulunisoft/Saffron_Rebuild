@extends('frontend.layouts.app')

@section('title', 'Shopping Cart - Saffron Sweets & Bakery')

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
        <li class="breadcrumb-item active">
          <i class="fas fa-shopping-basket me-1"></i>Shopping Cart
        </li>
      </ol>
    </nav>

    @if($cartItems->count() > 0)
      <div class="row g-4">
        <!-- Cart Items -->
        <div class="col-lg-8">
          <div class="glass-card" style="padding: 2rem;">
            <h4 style="color: #f5e6cc; margin-bottom: 1.5rem;">
              <i class="fas fa-shopping-basket me-2"></i>Cart Items ({{ $cartItems->count() }})
            </h4>

            <div class="cart-items">
              @foreach($cartItems as $item)
                <div class="cart-item" data-cart-id="{{ $item->id }}" style="border-bottom: 1px solid rgba(245,230,204,0.1); padding-bottom: 1.5rem; margin-bottom: 1.5rem;">
                  <div class="row align-items-center g-3">
                    <!-- Product Image -->
                    <div class="col-3 col-md-2">
                      @if($item->product->image)
                        <img src="{{ asset('storage/products/' . $item->product->image) }}"
                             alt="{{ $item->product->name }}"
                             style="width: 100%; border-radius: 12px; aspect-ratio: 1; object-fit: cover;">
                      @else
                        <div style="width: 100%; aspect-ratio: 1; background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(244,63,94,0.1)); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                          🍰
                        </div>
                      @endif
                    </div>

                    <!-- Product Info -->
                    <div class="col-6 col-md-5">
                      <h6 class="cart-item-name" style="color: #f5e6cc; margin-bottom: 0.5rem;">
                        <a href="{{ route('shop.product', $item->product->slug) }}" style="color: inherit; text-decoration: none;">
                          {{ $item->product->name }}
                        </a>
                      </h6>
                      <p style="color: rgba(245,230,204,0.6); font-size: 0.9rem; margin: 0;">
                        {{ $item->product->category->name_en ?? 'Sweets' }}
                      </p>
                      <div style="margin-top: 0.5rem;">
                        @if($item->product->sale_price)
                          <span class="cart-item-price" style="color: #fbbf24; font-weight: 600; font-size: 1.1rem;">
                            ৳{{ number_format($item->product->sale_price) }}
                          </span>
                          <span style="color: rgba(245,230,204,0.4); text-decoration: line-through; margin-left: 0.5rem; font-size: 0.9rem;">
                            ৳{{ number_format($item->product->price) }}
                          </span>
                        @else
                          <span class="cart-item-price" style="color: #fbbf24; font-weight: 600; font-size: 1.1rem;">
                            ৳{{ number_format($item->product->price) }}
                          </span>
                        @endif
                      </div>
                    </div>

                    <!-- Quantity & Actions -->
                    <div class="col-3 col-md-5">
                      <div class="d-flex align-items-center justify-content-between">
                        <!-- Quantity Control -->
                        <div class="quantity-control" style="display: flex; align-items: center; gap: 0.5rem; background: rgba(245,230,204,0.05); border-radius: 8px; padding: 0.25rem;">
                          <button class="qty-btn qty-minus" data-cart-id="{{ $item->id }}"
                                  style="width: 32px; height: 32px; border: none; background: rgba(245,158,11,0.2); color: #fbbf24; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                                  {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                            <i class="fas fa-minus" style="font-size: 0.75rem;"></i>
                          </button>
                          <input type="number" value="{{ $item->quantity }}" min="1" max="10"
                                 class="qty-input"
                                 data-cart-id="{{ $item->id }}"
                                 style="width: 50px; text-align: center; border: none; background: transparent; color: #f5e6cc; font-weight: 600;"
                                 readonly>
                          <button class="qty-btn qty-plus" data-cart-id="{{ $item->id }}"
                                  style="width: 32px; height: 32px; border: none; background: rgba(245,158,11,0.2); color: #fbbf24; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                                  {{ $item->quantity >= 10 ? 'disabled' : '' }}>
                            <i class="fas fa-plus" style="font-size: 0.75rem;"></i>
                          </button>
                        </div>

                        <!-- Remove Button -->
                        <button class="remove-item-btn" data-cart-id="{{ $item->id }}"
                                style="border: none; background: rgba(244,63,94,0.1); color: #f43f5e; padding: 0.5rem; border-radius: 8px; cursor: pointer; transition: all 0.3s ease;"
                                onmouseover="this.style.background='rgba(244,63,94,0.2)'"
                                onmouseout="this.style.background='rgba(244,63,94,0.1)'">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </div>

                      <!-- Item Subtotal -->
                      <div style="text-align: right; margin-top: 0.5rem;">
                        <span style="color: rgba(245,230,204,0.6); font-size: 0.85rem;">Subtotal:</span>
                        <span class="item-subtotal" style="color: #fbbf24; font-weight: 600; margin-left: 0.5rem;">
                          ৳{{ number_format(($item->product->sale_price ?? $item->product->price) * $item->quantity) }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Cart Summary -->
        <div class="col-lg-4">
          <div class="glass-card" style="padding: 2rem; position: sticky; top: 100px;">
            <h4 style="color: #f5e6cc; margin-bottom: 1.5rem;">
              <i class="fas fa-receipt me-2"></i>Order Summary
            </h4>

            <div class="cart-totals" style="margin-bottom: 1.5rem;" data-subtotal="{{ number_format($subtotal) }}" data-shipping="{{ number_format($shipping) }}" data-total="{{ number_format($total) }}">
              <div class="d-flex justify-content-between mb-2">
                <span style="color: rgba(245,230,204,0.7);">Subtotal</span>
                <span style="color: #f5e6cc; font-weight: 600;">৳{{ number_format($subtotal) }}</span>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span style="color: rgba(245,230,204,0.7);">Shipping</span>
                @if($shipping === 0)
                  <span style="color: #10b981; font-weight: 600;">Free</span>
                @else
                  <span style="color: #f5e6cc; font-weight: 600;">৳{{ number_format($shipping) }}</span>
                @endif
              </div>
              @if($shipping === 0)
                <div style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 8px; padding: 0.75rem; margin-top: 1rem;">
                  <small style="color: #10b981;">
                    <i class="fas fa-check-circle me-1"></i>
                    Free shipping applied!
                  </small>
                </div>
              @else
                <div style="background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.3); border-radius: 8px; padding: 0.75rem; margin-top: 1rem;">
                  <small style="color: #fbbf24;">
                    <i class="fas fa-info-circle me-1"></i>
                    Add ৳{{ number_format(1000 - $subtotal) }} more for free shipping!
                  </small>
                </div>
              @endif
            </div>

            <div style="border-top: 1px solid rgba(245,230,204,0.1); padding-top: 1.5rem; margin-bottom: 1.5rem;">
              <div class="d-flex justify-content-between">
                <span style="color: #f5e6cc; font-size: 1.2rem; font-weight: 600;">Total</span>
                <span class="cart-total" style="color: #fbbf24; font-size: 1.5rem; font-weight: 700;">৳{{ number_format($total) }}</span>
              </div>
            </div>

            <a href="{{ route('checkout') }}" class="btn btn-glow w-100 btn-lg">
              <i class="fas fa-lock me-2"></i>Proceed to Checkout
            </a>

            <a href="{{ route('shop') }}" class="btn btn-glass w-100 mt-3">
              <i class="fas fa-arrow-left me-2"></i>Continue Shopping
            </a>
          </div>
        </div>
      </div>
    @else
      <!-- Empty Cart -->
      <div class="text-center py-5 glass-card">
        <div style="font-size: 5rem; margin-bottom: 1.5rem; opacity: 0.3;">🛒</div>
        <h3 style="color: #f5e6cc; margin-bottom: 1rem;">Your cart is empty</h3>
        <p style="color: rgba(245,230,204,0.6); margin-bottom: 2rem;">Looks like you haven't added anything to your cart yet.</p>
        <a href="{{ route('shop') }}" class="btn btn-glow btn-lg">
          <i class="fas fa-shopping-bag me-2"></i>Start Shopping
        </a>
      </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
// Get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
}

function updateCartQty(cartId, newQuantity) {
  if (newQuantity < 1 || newQuantity > 10) return;

  const cartItem = document.querySelector(`.cart-item[data-cart-id="${cartId}"]`);
  if (!cartItem) return;

  const qtyInput = cartItem.querySelector('.qty-input');
  const minusBtn = cartItem.querySelector('.qty-minus');
  const plusBtn = cartItem.querySelector('.qty-plus');

  // Store original value for revert
  const originalQty = parseInt(qtyInput.value);

  // Show loading state
  qtyInput.value = newQuantity;
  minusBtn.disabled = true;
  plusBtn.disabled = true;

  fetch('/cart/update', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': getCsrfToken(),
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify({ cart_id: cartId, quantity: newQuantity })
  })
  .then(async response => {
    const contentType = response.headers.get('content-type');

    if (contentType && contentType.includes('application/json')) {
      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.message || 'Failed to update cart');
      }
      return data;
    } else {
      const text = await response.text();
      throw new Error('Server error. Please try again.');
    }
  })
  .then(data => {
    if (data.success) {
      // Update cart count in header
      updateCartCountBadge(data.cart_count);

      // Update item subtotal
      const itemSubtotal = cartItem.querySelector('.item-subtotal');
      if (itemSubtotal && data.item_subtotal) {
        itemSubtotal.textContent = '৳' + data.item_subtotal;
      }

      // Update cart totals
      const cartTotal = document.querySelector('.cart-total');
      if (cartTotal && data.total) {
        cartTotal.textContent = '৳' + data.total;
      }

      // Update button states based on NEW quantity
      minusBtn.disabled = newQuantity <= 1;
      plusBtn.disabled = newQuantity >= 10;

      // Show brief success feedback
      qtyInput.style.color = '#10b981';
      setTimeout(() => {
        qtyInput.style.color = '#f5e6cc';
      }, 500);
    } else {
      alert(data.message || 'Failed to update cart');
      // Revert to original quantity
      qtyInput.value = originalQty;
      minusBtn.disabled = originalQty <= 1;
      plusBtn.disabled = originalQty >= 10;
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert(error.message || 'Failed to update cart. Please try again.');
    // Revert to original quantity
    qtyInput.value = originalQty;
    minusBtn.disabled = originalQty <= 1;
    plusBtn.disabled = originalQty >= 10;
  });
}

function removeFromCart(cartId) {
  if (!confirm('Remove this item from cart?')) return;

  const cartItem = document.querySelector(`.cart-item[data-cart-id="${cartId}"]`);
  if (!cartItem) return;

  // Show loading state
  cartItem.style.opacity = '0.5';
  cartItem.style.pointerEvents = 'none';

  fetch('/cart/remove', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': getCsrfToken(),
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify({ cart_id: cartId })
  })
  .then(async response => {
    const contentType = response.headers.get('content-type');

    if (contentType && contentType.includes('application/json')) {
      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.message || 'Failed to remove item');
      }
      return data;
    } else {
      const text = await response.text();
      throw new Error('Server error. Please try again.');
    }
  })
  .then(data => {
    if (data.success) {
      // Update cart count in header
      updateCartCountBadge(data.cart_count);

      // Animate and remove item from DOM
      cartItem.style.transition = 'all 0.3s ease';
      cartItem.style.transform = 'translateX(100%)';
      cartItem.style.opacity = '0';

      setTimeout(() => {
        cartItem.remove();

        // Check if cart is empty
        const remainingItems = document.querySelectorAll('.cart-item');
        if (remainingItems.length === 0) {
          location.reload();
        }
      }, 300);
    } else {
      alert(data.message || 'Failed to remove item');
      cartItem.style.opacity = '1';
      cartItem.style.pointerEvents = 'auto';
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert(error.message || 'Failed to remove item. Please try again.');
    cartItem.style.opacity = '1';
    cartItem.style.pointerEvents = 'auto';
  });
}

// Update cart count badge (shared function)
function updateCartCountBadge(count) {
  const cartBadges = document.querySelectorAll('.cart-count');
  cartBadges.forEach(badge => {
    if (count > 0) {
      badge.textContent = count > 9 ? '9+' : count;
      badge.classList.remove('d-none');
      badge.classList.add('d-flex');
    } else {
      badge.classList.add('d-none');
      badge.classList.remove('d-flex');
    }
  });
}

// Event listeners for quantity buttons
document.addEventListener('DOMContentLoaded', function() {
  // Handle increment button clicks
  document.querySelectorAll('.qty-plus').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const cartId = this.getAttribute('data-cart-id');
      const cartItem = this.closest('.cart-item');
      const qtyInput = cartItem.querySelector('.qty-input');
      const currentQty = parseInt(qtyInput.value);
      const newQty = currentQty + 1;
      updateCartQty(cartId, newQty);
    });
  });

  // Handle decrement button clicks
  document.querySelectorAll('.qty-minus').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const cartId = this.getAttribute('data-cart-id');
      const cartItem = this.closest('.cart-item');
      const qtyInput = cartItem.querySelector('.qty-input');
      const currentQty = parseInt(qtyInput.value);
      const newQty = currentQty - 1;
      updateCartQty(cartId, newQty);
    });
  });

  // Handle remove button clicks
  document.querySelectorAll('.remove-item-btn').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const cartId = this.getAttribute('data-cart-id');
      removeFromCart(cartId);
    });
  });
});
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
</style>
@endpush
