@extends('frontend.layouts.app')

@section('title', 'Shopping Cart - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb-glass">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #f59e0b; text-decoration: none;">Home</a></li>
        <li class="breadcrumb-item active" style="color: #f5e6cc;">Shopping Cart</li>
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
                      <h6 style="color: #f5e6cc; margin-bottom: 0.5rem;">
                        <a href="{{ route('shop.product', $item->product->slug) }}" style="color: inherit; text-decoration: none;">
                          {{ $item->product->name }}
                        </a>
                      </h6>
                      <p style="color: rgba(245,230,204,0.6); font-size: 0.9rem; margin: 0;">
                        {{ $item->product->category->name_en ?? 'Sweets' }}
                      </p>
                      <div style="margin-top: 0.5rem;">
                        @if($item->product->sale_price)
                          <span style="color: #fbbf24; font-weight: 600; font-size: 1.1rem;">
                            ৳{{ number_format($item->product->sale_price) }}
                          </span>
                          <span style="color: rgba(245,230,204,0.4); text-decoration: line-through; margin-left: 0.5rem; font-size: 0.9rem;">
                            ৳{{ number_format($item->product->price) }}
                          </span>
                        @else
                          <span style="color: #fbbf24; font-weight: 600; font-size: 1.1rem;">
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
                          <button class="qty-btn" onclick="updateCartQty({{ $item->id }}, {{ $item->quantity - 1 }})"
                                  style="width: 32px; height: 32px; border: none; background: rgba(245,158,11,0.2); color: #fbbf24; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                                  {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                            <i class="fas fa-minus" style="font-size: 0.75rem;"></i>
                          </button>
                          <input type="number" value="{{ $item->quantity }}" min="1" max="10"
                                 class="qty-input"
                                 data-cart-id="{{ $item->id }}"
                                 style="width: 50px; text-align: center; border: none; background: transparent; color: #f5e6cc; font-weight: 600;"
                                 readonly>
                          <button class="qty-btn" onclick="updateCartQty({{ $item->id }}, {{ $item->quantity + 1 }})"
                                  style="width: 32px; height: 32px; border: none; background: rgba(245,158,11,0.2); color: #fbbf24; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                                  {{ $item->quantity >= 10 ? 'disabled' : '' }}>
                            <i class="fas fa-plus" style="font-size: 0.75rem;"></i>
                          </button>
                        </div>

                        <!-- Remove Button -->
                        <button onclick="removeFromCart({{ $item->id }})"
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

            <div style="margin-bottom: 1.5rem;">
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
function updateCartQty(cartId, quantity) {
  if (quantity < 1 || quantity > 10) return;

  const cartItem = document.querySelector(`[data-cart-id="${cartId}"]`);
  if (cartItem) {
    const qtyInput = cartItem.querySelector('.qty-input');
    qtyInput.value = quantity;
  }

  fetch('/cart/update', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ cart_id: cartId, quantity: quantity })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Update cart count in header
      updateCartCount(data.cart_count);

      // Reload to update all calculations
      location.reload();
    } else {
      alert(data.message || 'Failed to update cart');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Failed to update cart. Please try again.');
  });
}

function removeFromCart(cartId) {
  if (confirm('Remove this item from cart?')) {
    fetch('/cart/remove', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ cart_id: cartId })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Update cart count in header
        updateCartCount(data.cart_count);

        // Remove item from DOM
        const cartItem = document.querySelector(`[data-cart-id="${cartId}"]`);
        if (cartItem) {
          cartItem.remove();

          // Check if cart is empty
          const remainingItems = document.querySelectorAll('.cart-item');
          if (remainingItems.length === 0) {
            location.reload();
          }
        }
      } else {
        alert(data.message || 'Failed to remove item');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Failed to remove item. Please try again.');
    });
  }
}

function updateCartCount(count) {
  const cartCountElements = document.querySelectorAll('.cart-count');
  cartCountElements.forEach(element => {
    element.textContent = count;
  });
}
</script>
@endpush
