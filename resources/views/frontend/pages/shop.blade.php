@extends('frontend.layouts.app')

@section('title', 'Shop - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <!-- Header Row: Breadcrumb, Product Count, Sort -->
    <div class="shop-header-row mb-4">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb-modern mb-0">
          <li class="breadcrumb-item">
            <a href="{{ route('home') }}">
              <i class="fas fa-home me-1"></i>Home
            </a>
          </li>
          <li class="breadcrumb-item active">
            <i class="fas fa-store me-1"></i>Shop
          </li>
        </ol>
      </nav>

      <!-- Product Count & Sort -->
      <div class="shop-header-actions">
        <div class="product-count">
          <span class="count-label">Showing</span>
          <span class="count-number">{{ $products->total() }}</span>
          <span class="count-label">products</span>
        </div>
        <select class="form-select input-dark sort-select" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
          <option value="">Sort by: Default</option>
          <option value="{{ route('shop', ['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
          <option value="{{ route('shop', ['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
          <option value="{{ route('shop', ['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
        </select>
      </div>
    </div>

    <div class="row g-4">
      <!-- Sidebar Filters -->
      <div class="col-lg-3">
        <div class="glass-card p-4">
          <h5 class="mb-4" style="color: var(--theme-text-primary);">
            <i class="fas fa-filter me-2" style="color: var(--theme-text-secondary);"></i>Filters
          </h5>

          <!-- Categories -->
          <div class="mb-4">
            <h6 style="color: var(--theme-text-secondary); margin-bottom: 1rem;">Categories</h6>
            <div class="category-list">
              @foreach($categories as $cat)
                @php
                  $catIcons = [
                    'breads' => 'fa-bread-slice',
                    'cakes' => 'fa-cake-candles',
                    'cookies-biscuits' => 'fa-cookie-bite',
                    'traditional-sweets' => 'fa-candy-cane',
                    'dairy-products' => 'fa-cheese',
                    'buns-rolls' => 'fa-stroopwafel',
                    'pastries-savories' => 'fa-pie-chart',
                  ];
                  $catIcon = $catIcons[$cat->slug] ?? 'fa-utensils';
                @endphp
              <a href="{{ route('shop.category', $cat->slug) }}" class="category-link">
                <span><i class="fas {{ $catIcon }} me-2" style="color:var(--theme-text-secondary);width:18px;text-align:center;"></i>{{ $cat->name_en }}</span>
                {{--<span class="badge" style="background: rgba(245,158,11,0.2); color: var(--theme-text-secondary);">{{ $cat->products_count ?? 0 }}</span>--}}
              </a>
              @endforeach
            </div>
          </div>

          <!-- Price Range -->
          <div class="mb-4">
            <h6 style="color: var(--theme-text-secondary); margin-bottom: 1rem;">Price Range</h6>
            <form action="{{ route('shop') }}" method="GET">
              <div class="row g-2">
                <div class="col-6">
                  <input type="number" name="min_price" class="form-control input-dark" placeholder="Min" value="{{ request('min_price') }}">
                </div>
                <div class="col-6">
                  <input type="number" name="max_price" class="form-control input-dark" placeholder="Max" value="{{ request('max_price') }}">
                </div>
              </div>
              <button type="submit" class="btn btn-glow w-100 mt-2">
                <i class="fas fa-search me-2"></i>Filter
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- Products Grid -->
      <div class="col-lg-9">

        @if($products->count() > 0)
          <div class="row g-3">
            @foreach($products as $product)
            <div class="col-6 col-md-4 col-lg-3 col-xl-3">
              <div class="slider-product-card">
                <a href="{{ route('shop.product', $product->slug) }}" class="text-decoration-none">
                  <!-- Product Image -->
                  <div class="product-card-img">
                    @if($product->image)
                      <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name }}" loading="lazy">
                    @else
                      <div class="prod-img-placeholder">
                        <i class="fas fa-cookie-bite"></i>
                      </div>
                    @endif

                    <!-- Category Badge (Top Left) -->
                    <span class="product-category-badge">{{ $product->category->name_en ?? 'Sweets' }}</span>
                    @if($product->is_featured)
                      <span class="product-category-badge" style="left:auto;right:10px;background:var(--theme-btn-gradient);color:#fff;">FEATURED</span>
                    @endif
                    @if($product->stock < 10 && $product->stock > 0)
                      <span class="product-category-badge" style="left:auto;right:10px;background:rgba(239,68,68,0.9);color:#fff;">LOW STOCK</span>
                    @endif

                    <!-- Wishlist Icon (Top Right) -->
                    <button class="product-wishlist-btn prod-wishlist" data-product-id="{{ $product->id }}" title="Add to Wishlist" onclick="event.preventDefault(); event.stopPropagation();">
                      <i class="far fa-heart"></i>
                    </button>

                    <!-- Add to Cart (On Hover) -->
                    <div class="product-cart-overlay">
                      <button class="product-cart-btn" onclick="event.preventDefault(); event.stopPropagation(); addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price ?? $product->price }}, '{{ $product->image ?? '' }}', event);">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Add to Cart</span>
                      </button>
                    </div>
                  </div>

                  <!-- Product Info -->
                  <div class="product-card-info">
                    <div class="product-card-category">{{ $product->category->name_en ?? 'Sweets' }}</div>
                    <h5 class="product-card-name">{{ $product->name }}</h5>

                    <!-- Rating -->
                    <div class="product-card-rating">
                      <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                          @if($i <= ($product->avg_rating ?? 5))
                            <i class="fas fa-star"></i>
                          @else
                            <i class="far fa-star"></i>
                          @endif
                        @endfor
                      </div>
                      <span class="rating-count">({{ $product->reviews_count ?? 0 }})</span>
                    </div>

                    <!-- Price Row -->
                    <div class="product-card-price">
                      <div class="price-info">
                        <span class="current-price">৳{{ number_format($product->price) }}</span>
                        @if($product->compare_price && $product->compare_price > $product->price)
                          <span class="original-price">৳{{ number_format($product->compare_price) }}</span>
                          @php
                            $shopDiscount = round(($product->compare_price - $product->price) / $product->compare_price * 100);
                          @endphp
                          @if($shopDiscount > 0)
                            <span class="discount-badge">-{{ $shopDiscount }}%</span>
                          @endif
                        @endif
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            @endforeach
          </div>

          <!-- Pagination -->
          @if($products->hasPages())
          <div class="d-flex justify-content-center mt-5">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
          </div>
          @endif
        @else
          <div class="glass-card p-5 text-center">
            <i class="fas fa-search" style="font-size: 4rem; opacity: 0.3; margin-bottom: 1rem;"></i>
            <h5 style="color: var(--theme-text-primary); margin-bottom: 0.5rem;">No products found</h5>
            <p style="color: var(--text-60); margin-bottom: 1.5rem;">Try adjusting your filters or browse our categories</p>
            <a href="{{ route('shop') }}" class="btn btn-glow">
              <i class="fas fa-redo me-2"></i>Clear Filters
            </a>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/new-arrivals.css') }}">
<style>
  /* Shop page grid override for slider-product-card */
  .row > [class*="col-"] > .slider-product-card {
    flex: none;
    max-width: 100%;
    min-width: 0;
    width: 100%;
    background: var(--glass-bg, rgba(255,255,255,0.08));
    border: 1px solid var(--glass-border, rgba(255,255,255,0.15));
    backdrop-filter: var(--glass-blur, blur(20px));
    -webkit-backdrop-filter: var(--glass-blur, blur(20px));
  }
  .row > [class*="col-"] > .slider-product-card:hover {
    background: var(--glass-bg, rgba(255,255,255,0.08));
    border-color: var(--theme-primary, #f59e0b);
  }
  .row > [class*="col-"] > .slider-product-card .product-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  /* Card text colors for transparent background */
  .row > [class*="col-"] > .slider-product-card .product-card-name,
  .row > [class*="col-"] > .slider-product-card .current-price {
    color: var(--theme-text-primary);
  }

  /* Mobile: Completely hide wishlist & add-to-cart buttons */
  @media (max-width: 767px), (hover: none) {
    .row > [class*="col-"] > .slider-product-card .product-wishlist-btn {
      display: none !important;
    }
    .row > [class*="col-"] > .slider-product-card .product-cart-overlay {
      display: none !important;
    }
  }
</style>
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
    background: var(--theme-menu-hover);
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

  /* Shop Header Row */
  .shop-header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
  }

  .shop-header-actions {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    flex-wrap: wrap;
  }

  .product-count {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-80);
    font-size: 0.9rem;
  }

  .product-count .count-label {
    color: var(--text-60);
  }

  .product-count .count-number {
    color: var(--theme-text-secondary);
    font-weight: 700;
    font-size: 1.1rem;
  }

  .sort-select {
    width: auto !important;
    min-width: 200px;
    cursor: pointer;
  }

  .category-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }

  .category-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.6rem 0.75rem;
    border-radius: 8px;
    color: var(--text-80);
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid transparent;
  }

  .category-link:hover {
    background: rgba(245,158,11,0.15);
    color: var(--theme-text-secondary);
    border-color: rgba(245,158,11,0.2);
    transform: translateX(3px);
  }

  /* Product Card Styles */
  .prod-card {
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
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
    color: var(--text-50);
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
    color: var(--text-80);
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
    color: var(--text-50);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.25rem;
    display: block;
  }

  .prod-title {
    color: var(--theme-text-primary);
    font-size: 0.95rem;
    font-weight: 600;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.4;
    margin-bottom: 0.5rem;
  }

  .prod-price {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--theme-text-secondary);
  }

  .prod-cart-btn {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: var(--theme-btn-gradient);
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

  /* Pagination Styling */
  .pagination {
    display: flex;
    gap: 0.5rem;
  }

  .pagination .page-link {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: var(--text-80);
    border-radius: 10px;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
  }

  .pagination .page-link:hover {
    background: rgba(245,158,11,0.15);
    border-color: rgba(245,158,11,0.3);
    color: var(--theme-text-secondary);
  }

  .pagination .page-item.active .page-link {
    background: var(--theme-btn-gradient);
    border-color: transparent;
    color: white;
  }

  .pagination .disabled .page-link {
    color: var(--text-30);
    pointer-events: none;
  }

  /* Responsive Styles */
  @media (max-width: 991px) {
    .shop-header-row {
      flex-direction: column;
      align-items: flex-start;
      gap: 1rem;
    }

    .shop-header-actions {
      width: 100%;
      justify-content: space-between;
    }

    .sort-select {
      flex: 1;
      max-width: 200px;
    }
  }

  @media (max-width: 576px) {
    .shop-header-actions {
      flex-direction: column;
      align-items: stretch;
      gap: 1rem;
    }

    .product-count {
      justify-content: center;
    }

    .sort-select {
      max-width: 100%;
    }

    /* Mobile Pagination Fix */
    .pagination {
      flex-wrap: wrap;
      justify-content: center;
      gap: 0.35rem;
    }
    .pagination .page-link {
      padding: 0.4rem 0.65rem;
      font-size: 0.8rem;
      min-width: 34px;
      text-align: center;
    }
    .pagination .page-item.active .page-link {
      padding: 0.4rem 0.65rem;
    }
  }
</style>
@endpush

@push('scripts')
<script>
// Toggle wishlist
document.querySelectorAll('.prod-wishlist').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();

    // Check authentication first
    if (!window.requireAuth()) {
      return; // Stop if user is not authenticated
    }

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

// Get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
}

// Add to Cart function
function addToCart(productId, productName, price, image, event) {
  event.preventDefault();
  event.stopPropagation();

  const button = event.target.closest('.product-cart-btn, .prod-cart-btn');
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
</script>
@endpush
