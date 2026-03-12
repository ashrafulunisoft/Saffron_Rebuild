@extends('frontend.layouts.app')

@section('title', $product->name . ' - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb-glass">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #f59e0b; text-decoration: none;">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('shop') }}" style="color: #f59e0b; text-decoration: none;">Shop</a></li>
        <li class="breadcrumb-item active" style="color: #f5e6cc;">{{ $product->name }}</li>
      </ol>
    </nav>

    <!-- Product Detail -->
    <div class="row g-5">
      <!-- Product Images -->
      <div class="col-lg-5">
        <div class="glass-card p-4 text-center">
          @if($product->image)
            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100%; max-height: 400px;">
          @else
            <div style="font-size: 10rem;">🍮</div>
          @endif
        </div>
        <div class="d-flex gap-2 justify-content-center mt-3">
          <button class="thumb-btn active">
            @if($product->image)
              <img src="{{ asset('storage/products/' . $product->image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
            @else
              <span style="font-size: 2rem;">🍮</span>
            @endif
          </button>
        </div>
        <!-- Product Features -->
        <div class="row g-2 mt-3">
          <div class="col-6">
            <div class="glass-card p-2 text-center small">
              <i class="fas fa-shield-alt" style="color: #fbbf24;"></i>
              <span style="color: rgba(245,230,204,0.7);">100% Natural</span>
            </div>
          </div>
          <div class="col-6">
            <div class="glass-card p-2 text-center small">
              <i class="fas fa-truck" style="color: #fbbf24;"></i>
              <span style="color: rgba(245,230,204,0.7);">Free Delivery</span>
            </div>
          </div>
          <div class="col-6">
            <div class="glass-card p-2 text-center small">
              <i class="fas fa-undo" style="color: #fbbf24;"></i>
              <span style="color: rgba(245,230,204,0.7);">Easy Returns</span>
            </div>
          </div>
          <div class="col-6">
            <div class="glass-card p-2 text-center small">
              <i class="fas fa-lock" style="color: #fbbf24;"></i>
              <span style="color: rgba(245,230,204,0.7);">Secure Payment</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Product Info -->
      <div class="col-lg-7">
        <span class="section-badge">{{ $product->category->name ?? 'Sweets' }}</span>
        <h1 class="hero-title mt-2" style="font-size: 2.5rem;">
          {{ $product->name }}
        </h1>

        <div class="d-flex align-items-center gap-3 mt-3 mb-3 flex-wrap">
          <div style="color: #fbbf24; font-size: 1.3rem;">★★★★★</div>
          <span style="color: rgba(245,230,204,0.6);">({{ $product->reviews_count ?? 0 }} reviews)</span>
          @if($product->stock > 0)
            <span class="badge" style="background: rgba(34, 197, 94, 0.2); color: #22c55e;">In Stock</span>
          @else
            <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #ef4444;">Out of Stock</span>
          @endif
        </div>

        <div class="d-flex align-items-center gap-3 mb-4">
          <span style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 700; color: #fbbf24;">
            ৳{{ number_format($product->price) }}
          </span>
          @if($product->compare_price)
            <span style="font-size: 1.2rem; color: rgba(245,230,204,0.4); text-decoration: line-through;">
              ৳{{ number_format($product->compare_price) }}
            </span>
            <span style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 0.3rem 0.8rem; border-radius: 8px; font-size: 0.8rem; font-weight: 700;">
              {{ round((1 - $product->price / $product->compare_price) * 100) }}% OFF
            </span>
          @endif
        </div>

        <p style="color: rgba(245,230,204,0.75); line-height: 1.8; margin-bottom: 2rem;">
          {{ $product->description }}
        </p>

        <!-- Quantity & Add to Cart -->
        <div class="d-flex gap-3 mb-4">
          <div class="qty-selector">
            <button class="qty-btn" onclick="decreaseQty()">
              <i class="fas fa-minus"></i>
            </button>
            <span id="qtyValue">1</span>
            <button class="qty-btn" onclick="increaseQty()">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          <button class="btn btn-glow btn-lg flex-grow-1" onclick="addToCart(this)">
            <i class="fas fa-shopping-bag me-2"></i>Add to Cart
          </button>
          <button class="btn btn-glass btn-lg" onclick="toggleWishlist(this)">
            <i class="far fa-heart"></i>
          </button>
        </div>

        <!-- Product Meta -->
        <div class="glass-card p-3">
          <div class="row g-3">
            <div class="col-sm-6">
              <small style="color: rgba(245,230,204,0.6);">SKU:</small>
              <div style="color: #f5e6cc;">{{ $product->sku ?? 'N/A' }}</div>
            </div>
            <div class="col-sm-6">
              <small style="color: rgba(245,230,204,0.6);">Category:</small>
              <div style="color: #f5e6cc;">{{ $product->category->name ?? 'N/A' }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="mt-5">
      <h3 class="section-title text-center mb-4">
        Related <span class="gradient-text">Products</span>
      </h3>
      <div class="row g-4">
        @foreach($relatedProducts->take(4) as $related)
        <div class="col-6 col-md-3">
          <div class="product-card glass-card">
            <div class="prod-img">
              @if($related->image)
                <img src="{{ asset('storage/products/' . $related->image) }}" alt="{{ $related->name }}">
              @else
                <div style="font-size: 3rem;">🍮</div>
              @endif
            </div>
            <div class="prod-info" style="padding: 0.75rem 0;">
              <h6 class="prod-name" style="font-size: 0.9rem;">{{ $related->name }}</h6>
              <div class="prod-price">
                <span class="current-price" style="font-size: 1rem;">৳{{ number_format($related->price) }}</span>
              </div>
            </div>
            <a href="{{ route('shop.product', $related->slug) }}" class="prod-link"></a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
function increaseQty() {
  const qty = document.getElementById('qtyValue');
  const val = parseInt(qty.textContent);
  if (val < 10) qty.textContent = val + 1;
}

function decreaseQty() {
  const qty = document.getElementById('qtyValue');
  const val = parseInt(qty.textContent);
  if (val > 1) qty.textContent = val - 1;
}

function toggleWishlist(btn) {
  const icon = btn.querySelector('i');
  if (icon.classList.contains('far')) {
    icon.classList.remove('far');
    icon.classList.add('fas');
    btn.style.background = 'rgba(244,63,94,0.2)';
  } else {
    icon.classList.remove('fas');
    icon.classList.add('far');
    btn.style.background = '';
  }
}
</script>
@endpush
