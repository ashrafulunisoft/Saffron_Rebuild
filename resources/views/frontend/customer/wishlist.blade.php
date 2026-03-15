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
              @if($item->product)
              <div class="col-6 col-md-4 col-lg-3">
                <div class="prod-card h-100">
                  <div class="prod-img-wrapper">
                    @if($item->product->image)
                      <img src="{{ asset('storage/products/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                    @else
                      <div class="prod-img-placeholder">
                        <i class="fas fa-cookie-bite"></i>
                      </div>
                    @endif
                    <button class="prod-wishlist active" data-product-id="{{ $item->product->id }}" title="Remove from Wishlist">
                      <i class="fas fa-heart"></i>
                    </button>
                    @if($item->product->stock < 10 && $item->product->stock > 0)
                      <span class="prod-badge-low">Low Stock</span>
                    @elseif($item->product->is_new)
                      <span class="prod-badge-new">New</span>
                    @endif
                  </div>
                  <div class="prod-details">
                    <span class="prod-cat">{{ $item->product->category->name_en ?? 'Sweets' }}</span>
                    <h6 class="prod-title">{{ $item->product->name }}</h6>
                    <div class="d-flex justify-content-between align-items-center">
                      <span class="prod-price">৳{{ number_format($item->product->price) }}</span>
                      <button class="prod-cart-btn" onclick="addToCart({{ $item->product->id }}, '{{ $item->product->name }}', {{ $item->product->sale_price ?? $item->product->price }}, '{{ $item->product->image ?? '' }}', event)">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>
                  <a href="{{ route('shop.product', $item->product->slug) }}" class="prod-link-overlay"></a>
                </div>
              </div>
              @endif
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

  /* Product Card Styles - Matching Shop Page */
  .prod-card {
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    height: 100%;
  }

  .prod-card:hover {
    transform: translateY(-8px);
    border-color: rgba(245,158,11,0.3);
    box-shadow: 0 20px 40px rgba(245,158,11,0.15);
  }

  .prod-img-wrapper {
    position: relative;
    width: 100%;
    height: 220px;
    overflow: hidden;
    background: linear-gradient(135deg, rgba(245,158,11,0.08), rgba(244,63,94,0.05));
    border-radius: 16px 16px 0 0;
  }

  .prod-img-wrapper img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .prod-card:hover .prod-img-wrapper img {
    transform: scale(1.15);
  }

  .prod-img-placeholder {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: rgba(245,230,204,0.5);
    background: linear-gradient(135deg, rgba(245,158,11,0.15), rgba(244,63,94,0.1));
    position: relative;
    overflow: hidden;
  }

  .prod-img-placeholder::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(244,63,94,0.05));
    animation: shimmer 3s ease-in-out infinite;
  }

  .prod-img-placeholder i {
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 4px 12px rgba(245,158,11,0.4));
    animation: float 3s ease-in-out infinite;
  }

  @keyframes shimmer {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 1; }
  }

  @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-5px); }
  }

  .prod-wishlist {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(15, 23, 42, 0.9);
    backdrop-filter: blur(12px);
    border: 1.5px solid rgba(255,255,255,0.15);
    color: rgba(245,230,204,0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 10;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  }

  .prod-wishlist:hover {
    background: rgba(244,63,94,0.9);
    border-color: rgba(244,63,94,0.5);
    color: #fff;
    transform: scale(1.15);
    box-shadow: 0 6px 20px rgba(244,63,94,0.5);
  }

  .prod-wishlist:active {
    transform: scale(1.05);
  }

  .prod-wishlist.active {
    background: rgba(244,63,94,0.9);
    border-color: rgba(244,63,94,0.5);
    color: #fff;
  }

  .prod-wishlist.active i {
    font-weight: 900;
  }

  .prod-badge-low,
  .prod-badge-new {
    position: absolute;
    top: 12px;
    left: 12px;
    padding: 0.25rem 0.6rem;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    z-index: 10;
  }

  .prod-badge-low {
    background: linear-gradient(135deg, rgba(245,158,11,0.9), rgba(217,119,6,0.9));
    color: white;
  }

  .prod-badge-new {
    background: linear-gradient(135deg, rgba(34,197,94,0.9), rgba(22,163,74,0.9));
    color: white;
  }

  .prod-details {
    padding: 1rem;
  }

  .prod-cat {
    font-size: 0.7rem;
    color: rgba(245,230,204,0.5);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.25rem;
    display: block;
  }

  .prod-title {
    color: #f5e6cc;
    font-size: 0.95rem;
    font-weight: 600;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.4;
    margin-bottom: 0.5rem;
    transition: color 0.3s ease;
  }

  .prod-card:hover .prod-title {
    color: #fbbf24;
  }

  .prod-price {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    font-weight: 700;
    color: #fbbf24;
  }

  .prod-cart-btn {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, #f59e0b, #f43f5e);
    border: none;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .prod-cart-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(245,158,11,0.4);
  }

  .prod-link-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 5;
  }
</style>
@endpush

@push('scripts')
<script>
// Get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
}

// Toggle wishlist functionality
document.querySelectorAll('.prod-wishlist').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();

    const productId = this.getAttribute('data-product-id');
    const icon = this.querySelector('i');
    const isActive = this.classList.contains('active');

    // Toggle visual state immediately for better UX
    if (isActive) {
      this.classList.remove('active');
      icon.classList.remove('fas');
      icon.classList.add('far');
    } else {
      this.classList.add('active');
      icon.classList.remove('far');
      icon.classList.add('fas');
      icon.style.transform = 'scale(1.3)';
      setTimeout(() => {
        icon.style.transform = 'scale(1)';
      }, 200);
    }

    // Make API call to toggle wishlist
    toggleWishlist(productId, this);
  });
});

// Toggle wishlist function
function toggleWishlist(productId, button) {
  fetch('/wishlist/toggle', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': getCsrfToken(),
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify({ product_id: productId })
  })
  .then(async response => {
    const contentType = response.headers.get('content-type');
    if (contentType && contentType.includes('application/json')) {
      const data = await response.json();
      if (!response.ok) {
        throw new Error(data.message || 'Failed to update wishlist');
      }
      return data;
    } else {
      const text = await response.text();
      throw new Error('Server error. Please try again.');
    }
  })
  .then(data => {
    if (data.success) {
      showToast(data.message);

      // Update wishlist count badge in header
      if (data.wishlist_count !== undefined) {
        updateWishlistCountBadge(data.wishlist_count);
      }

      // If removed from wishlist, remove the product card from DOM
      if (!data.in_wishlist) {
        const productCard = button.closest('.prod-card');
        productCard.style.transition = 'all 0.3s ease';
        productCard.style.opacity = '0';
        productCard.style.transform = 'scale(0.9)';

        setTimeout(() => {
          productCard.remove();

          // Check if wishlist is empty
          const remainingItems = document.querySelectorAll('.prod-card');
          if (remainingItems.length === 0) {
            location.reload();
          }
        }, 300);
      }
    } else {
      // Revert visual state on error
      const icon = button.querySelector('i');
      button.classList.toggle('active');
      icon.classList.toggle('fas');
      icon.classList.toggle('far');
      alert(data.message || 'Failed to update wishlist');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert(error.message || 'Failed to update wishlist. Please try again.');
  });
}

// Add to Cart function
function addToCart(productId, productName, price, image, event) {
  event.preventDefault();
  event.stopPropagation();

  const button = event.target.closest('.prod-cart-btn');
  const originalHTML = button.innerHTML;

  // Show loading state
  button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
  button.disabled = true;

  fetch('/cart/add', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': getCsrfToken(),
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify({
      product_id: productId,
      quantity: 1
    })
  })
  .then(async response => {
    const contentType = response.headers.get('content-type');
    if (contentType && contentType.includes('application/json')) {
      const data = await response.json();
      if (!response.ok) {
        throw new Error(data.message || 'Failed to add to cart');
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

      // Show success state
      button.innerHTML = '<i class="fas fa-check"></i>';
      button.style.background = 'linear-gradient(135deg, #10b981, #059669)';

      // Show toast notification
      showToast('Item added to cart successfully!');

      setTimeout(() => {
        button.innerHTML = originalHTML;
        button.style.background = '';
        button.disabled = false;
      }, 2000);
    } else {
      alert(data.message || 'Failed to add to cart');
      button.innerHTML = originalHTML;
      button.disabled = false;
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert(error.message || 'Failed to add to cart. Please try again.');
    button.innerHTML = originalHTML;
    button.disabled = false;
  });
}

// Update cart count badge
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

// Update wishlist count badge
function updateWishlistCountBadge(count) {
  const wishlistBadges = document.querySelectorAll('.wishlist-count');
  wishlistBadges.forEach(badge => {
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

// Show toast notification
function showToast(message) {
  // Create toast element if it doesn't exist
  let toast = document.querySelector('.cart-toast');
  if (!toast) {
    toast = document.createElement('div');
    toast.className = 'cart-toast';
    toast.style.cssText = `
      position: fixed;
      top: 100px;
      right: 20px;
      background: linear-gradient(135deg, #10b981, #059669);
      color: white;
      padding: 1rem 1.5rem;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
      z-index: 9999;
      animation: slideIn 0.3s ease;
    `;
    document.body.appendChild(toast);
  }

  toast.innerHTML = `<i class="fas fa-check-circle me-2"></i>${message}`;

  // Add animation keyframes if not exists
  if (!document.querySelector('#toast-animation')) {
    const style = document.createElement('style');
    style.id = 'toast-animation';
    style.textContent = `
      @keyframes slideIn {
        from {
          transform: translateX(400px);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }
    `;
    document.head.appendChild(style);
  }

  setTimeout(() => {
    toast.remove();
  }, 3000);
}
</script>
@endpush
