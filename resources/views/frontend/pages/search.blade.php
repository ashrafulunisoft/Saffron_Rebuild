@extends('frontend.layouts.app')

@section('title', 'Search Results - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <!-- Search Header -->
    <div class="glass-card p-4 mb-4">
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
          <h4 style="color: #f5e6cc; margin-bottom: 0.5rem;">
            <i class="fas fa-search me-2" style="color: #fbbf24;"></i>
            Search Results for "{{ $query }}"
          </h4>
          <p style="color: rgba(245,230,204,0.6); margin: 0;">Found {{ $products->total() }} products</p>
        </div>
        <a href="{{ route('shop') }}" class="btn btn-glass">
          <i class="fas fa-arrow-left me-2"></i>Back to Shop
        </a>
      </div>
    </div>

    @if($products->count() > 0)
      <div class="row g-4">
        @foreach($products as $product)
        <div class="col-6 col-md-4 col-lg-3">
          <div class="prod-card">
            <div class="prod-img-wrapper">
              @if($product->image)
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
              @else
                <div class="prod-img-placeholder">
                  <i class="fas fa-cookie-bite"></i>
                </div>
              @endif
              <button class="prod-wishlist" data-product-id="{{ $product->id }}" title="Add to Wishlist">
                <i class="far fa-heart"></i>
              </button>
            </div>
            <div class="prod-details">
              <span class="prod-cat">{{ $product->category->name_en ?? 'Sweets' }}</span>
              <h6 class="prod-title">{{ $product->name }}</h6>
              <div class="d-flex justify-content-between align-items-center">
                <span class="prod-price">৳{{ number_format($product->price) }}</span>
                <button class="prod-cart-btn" onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price ?? $product->price }}, '{{ $product->image ?? '' }}', event)">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <a href="{{ route('shop.product', $product->slug) }}" class="prod-link-overlay"></a>
          </div>
        </div>
        @endforeach
      </div>

      @if($products->hasPages())
      <div class="pagination-wrapper d-flex justify-content-center mt-5">
        {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
      </div>
      @endif
    @else
      <div class="text-center py-5 glass-card">
        <div style="font-size: 5rem; margin-bottom: 1.5rem; opacity: 0.4;">🔍</div>
        <h4 style="color: #f5e6cc; margin-bottom: 0.5rem;">No products found</h4>
        <p style="color: rgba(245,230,204,0.6); margin-bottom: 1.5rem;">Try searching for something else or browse our shop</p>
        <a href="{{ route('shop') }}" class="btn btn-glow">
          <i class="fas fa-store me-2"></i>Browse Shop
        </a>
      </div>
    @endif
  </div>
</div>

@push('styles')
<style>
  /* Product Card Styles - Matching Shop Page */
  .prod-card {
    position: relative;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
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

  .prod-wishlist.active {
    background: rgba(244,63,94,0.9);
    border-color: rgba(244,63,94,0.5);
    color: #fff;
  }

  .prod-wishlist.active i {
    font-weight: 900;
  }

  .prod-details {
    padding: 1rem;
  }

  .prod-cat {
    display: block;
    font-size: 0.7rem;
    color: rgba(245,230,204,0.5);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
  }

  .prod-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #f5e6cc;
    margin-bottom: 0.75rem;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: color 0.3s ease;
  }

  .prod-card:hover .prod-title {
    color: #fbbf24;
  }

  .prod-price {
    font-size: 1.1rem;
    font-weight: 700;
    color: #fbbf24;
  }

  .prod-cart-btn {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, rgba(245,158,11,0.2), rgba(244,63,94,0.15));
    border: 1px solid rgba(245,158,11,0.3);
    color: #fbbf24;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .prod-cart-btn:hover {
    background: linear-gradient(135deg, #f59e0b, #f43f5e);
    border-color: transparent;
    color: #fff;
    transform: scale(1.1);
  }

  .prod-link-overlay {
    position: absolute;
    inset: 0;
    z-index: 5;
  }

  /* Pagination Styles */
  .pagination-wrapper .pagination {
    gap: 0.5rem;
  }

  .pagination-wrapper .page-link {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: rgba(245,230,204,0.8);
    padding: 0.6rem 1rem;
    border-radius: 10px;
    transition: all 0.3s ease;
  }

  .pagination-wrapper .page-link:hover {
    background: rgba(245,158,11,0.2);
    border-color: rgba(245,158,11,0.3);
    color: #fbbf24;
    transform: translateY(-2px);
  }

  .pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, #f59e0b, #f43f5e);
    border-color: transparent;
    color: #fff;
    box-shadow: 0 4px 12px rgba(245,158,11,0.4);
  }

  .pagination-wrapper .page-item.disabled .page-link {
    opacity: 0.4;
    cursor: not-allowed;
  }
</style>
@endpush

@push('scripts')
<script>
// Get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
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

      // Heart animation
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

      // Update wishlist count in header
      if (data.wishlist_count !== undefined) {
        updateWishlistCountBadge(data.wishlist_count);
      }
    } else {
      // Revert visual state on error
      const icon = button.querySelector('i');
      button.classList.toggle('active');
      if (button.classList.contains('active')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
      } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
      }

      // Handle auth required
      if (data.requires_auth) {
        alert('Please login to add items to wishlist.');
        window.location.href = '/login';
      } else {
        alert(data.message || 'Failed to update wishlist');
      }
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert(error.message || 'Failed to update wishlist. Please try again.');
  });
}
</script>
@endpush

