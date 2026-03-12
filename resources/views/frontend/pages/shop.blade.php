@extends('frontend.layouts.app')

@section('title', 'Shop - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb" style="background: rgba(255,255,255,0.05); padding: 0.8rem 1.5rem; border-radius: 12px; display: inline-flex;">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #f59e0b; text-decoration: none;">Home</a></li>
        <li class="breadcrumb-item active" style="color: #f5e6cc;">Shop</li>
      </ol>
    </nav>

    <div class="row g-4">
      <!-- Sidebar Filters -->
      <div class="col-lg-3">
        <div class="glass-card p-4">
          <h5 class="mb-4" style="color: #f5e6cc;">
            <i class="fas fa-filter me-2" style="color: #fbbf24;"></i>Filters
          </h5>

          <!-- Categories -->
          <div class="mb-4">
            <h6 style="color: #fbbf24; margin-bottom: 1rem;">Categories</h6>
            <div class="category-list">
              @foreach($categories as $cat)
              <a href="{{ route('shop.category', $cat->slug) }}" class="category-link">
                <span>{{ $cat->name }}</span>
                <span class="badge" style="background: rgba(245,158,11,0.2); color: #fbbf24;">{{ $cat->products_count }}</span>
              </a>
              @endforeach
            </div>
          </div>

          <!-- Price Range -->
          <div class="mb-4">
            <h6 style="color: #fbbf24; margin-bottom: 1rem;">Price Range</h6>
            <form action="{{ route('shop') }}" method="GET">
              <div class="row g-2">
                <div class="col-6">
                  <input type="number" name="min_price" class="form-control input-dark" placeholder="Min" value="{{ request('min_price') }}" style="color: white;">
                </div>
                <div class="col-6">
                  <input type="number" name="max_price" class="form-control input-dark" placeholder="Max" value="{{ request('max_price') }}" style="color: white;">
                </div>
              </div>
              <button type="submit" class="btn btn-glow w-100 mt-2">Filter</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Products Grid -->
      <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 style="color: #f5e6cc;">All Products <span class="text-muted">({{ $products->total() }})</span></h5>
          <select class="form-select input-dark" style="width: auto; color: white;" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <option value="">Sort by: Default</option>
            <option value="{{ route('shop', ['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
            <option value="{{ route('shop', ['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="{{ route('shop', ['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
          </select>
        </div>

        @if($products->count() > 0)
          <div class="row g-4">
            @foreach($products as $product)
            <div class="col-6 col-md-4 col-lg-4">
              <div class="product-card glass-card">
                <div class="prod-badges">
                  @if($product->is_featured)
                    <span class="badge badge-sale">Featured</span>
                  @endif
                  @if($product->stock < 10 && $product->stock > 0)
                    <span class="badge badge-stock">Low Stock</span>
                  @endif
                </div>
                <div class="prod-img">
                  @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                  @else
                    <div style="font-size: 4rem;">🍮</div>
                  @endif
                </div>
                <div class="prod-info">
                  <span class="prod-cat">{{ $product->category->name ?? 'Sweets' }}</span>
                  <h6 class="prod-name">{{ $product->name }}</h6>
                  <div class="prod-rating">
                    <span style="color: #fbbf24;">★★★★★</span>
                    <small style="color: rgba(245,230,204,0.5);">({{ $product->reviews_count ?? 0 }})</small>
                  </div>
                  <div class="prod-price">
                    <span class="current-price">৳{{ number_format($product->price) }}</span>
                    @if($product->compare_price)
                      <span class="old-price">৳{{ number_format($product->compare_price) }}</span>
                    @endif
                  </div>
                  <div class="prod-actions">
                    <button class="btn-wishlist" title="Add to Wishlist">
                      <i class="far fa-heart"></i>
                    </button>
                    <button class="btn-cart" onclick="addToCart(this)">
                      <i class="fas fa-shopping-bag"></i>
                    </button>
                  </div>
                </div>
                <a href="{{ route('shop.product', $product->slug) }}" class="prod-link"></a>
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
          <div class="text-center py-5 glass-card">
            <i class="fas fa-search" style="font-size: 4rem; opacity: 0.3; margin-bottom: 1rem;"></i>
            <h5 style="color: #f5e6cc;">No products found</h5>
            <p style="color: rgba(245,230,204,0.6);">Try adjusting your filters or browse our categories</p>
            <a href="{{ route('shop') }}" class="btn btn-glow mt-3">
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
<style>
  .category-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  .category-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    color: rgba(245,230,204,0.8);
    text-decoration: none;
    transition: all 0.3s ease;
  }
  .category-link:hover {
    background: rgba(245,158,11,0.1);
    color: #fbbf24;
  }
  .product-card {
    position: relative;
    overflow: hidden;
  }
  .prod-badges {
    position: absolute;
    top: 10px;
    left: 10px;
    z-index: 10;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
  }
  .badge-sale {
    background: linear-gradient(135deg, rgba(244,63,94,0.9), rgba(225,29,72,0.9));
    color: white;
    padding: 0.25rem 0.6rem;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
  }
  .badge-stock {
    background: linear-gradient(135deg, rgba(245,158,11,0.9), rgba(217,119,6,0.9));
    color: white;
    padding: 0.25rem 0.6rem;
    border-radius: 6px;
    font-size: 0.7rem;
    font-weight: 600;
  }
  .prod-img {
    position: relative;
    padding-top: 100%;
    overflow: hidden;
    background: rgba(255,255,255,0.05);
    border-radius: 12px;
  }
  .prod-img img, .prod-img > div {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    object-fit: cover;
  }
  .prod-info {
    padding: 1rem 0;
  }
  .prod-cat {
    font-size: 0.75rem;
    color: rgba(245,230,204,0.6);
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .prod-name {
    color: #f5e6cc;
    font-size: 1rem;
    font-weight: 600;
    margin: 0.5rem 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .prod-price {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
  }
  .current-price {
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    font-weight: 700;
    color: #fbbf24;
  }
  .old-price {
    font-size: 0.9rem;
    color: rgba(245,230,204,0.4);
    text-decoration: line-through;
  }
  .prod-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
  }
  .btn-wishlist, .btn-cart {
    flex: 1;
    padding: 0.6rem;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.15);
    background: rgba(255,255,255,0.05);
    color: rgba(245,230,204,0.8);
    cursor: pointer;
    transition: all 0.3s ease;
  }
  .btn-wishlist:hover {
    background: rgba(244,63,94,0.2);
    border-color: rgba(244,63,94,0.4);
    color: #f43f5e;
  }
  .btn-cart:hover {
    background: linear-gradient(135deg, #f59e0b, #f43f5e);
    border-color: transparent;
    color: white;
  }
  .prod-link {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 5;
  }
</style>
@endpush
