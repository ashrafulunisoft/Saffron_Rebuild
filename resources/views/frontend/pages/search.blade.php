@extends('frontend.layouts.app')

@section('title', 'Search Results - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <div class="glass-card p-4 mb-4">
      <h4 style="color: #f5e6cc;">
        <i class="fas fa-search me-2" style="color: #fbbf24;"></i>
        Search Results for "{{ $query }}"
      </h4>
      <p style="color: rgba(245,230,204,0.6);">Found {{ $products->total() }} products</p>
    </div>

    @if($products->count() > 0)
      <div class="row g-4">
        @foreach($products as $product)
        <div class="col-6 col-md-4 col-lg-3">
          <div class="product-card glass-card">
            <div class="prod-img">
              @if($product->image)
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
              @else
                <div style="font-size: 4rem;">🍮</div>
              @endif
            </div>
            <div class="prod-info" style="padding: 1rem 0;">
              <span class="prod-cat">{{ $product->category->name_en ?? 'Sweets' }}</span>
              <h6 class="prod-name">{{ $product->name }}</h6>
              <div class="prod-price">
                <span class="current-price">৳{{ number_format($product->price) }}</span>
              </div>
              <div class="prod-actions">
                <button class="btn-wishlist">
                  <i class="far fa-heart"></i>
                </button>
                <button class="btn-cart">
                  <i class="fas fa-shopping-bag"></i>
                </button>
              </div>
            </div>
            <a href="{{ route('shop.product', $product->slug) }}" class="prod-link"></a>
          </div>
        </div>
        @endforeach
      </div>

      @if($products->hasPages())
      <div class="d-flex justify-content-center mt-5">
        {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
      </div>
      @endif
    @else
      <div class="text-center py-5 glass-card">
        <i class="fas fa-search" style="font-size: 4rem; opacity: 0.3; margin-bottom: 1rem;"></i>
        <h5 style="color: #f5e6cc;">No products found</h5>
        <p style="color: rgba(245,230,204,0.6);">Try searching for something else or browse our shop</p>
        <a href="{{ route('shop') }}" class="btn btn-glow mt-3">
          <i class="fas fa-store me-2"></i>Browse Shop
        </a>
      </div>
    @endif
  </div>
</div>
