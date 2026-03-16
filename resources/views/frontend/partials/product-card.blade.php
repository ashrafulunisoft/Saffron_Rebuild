@isset($product)
<a href="{{ route('shop.product', $product->slug) }}" class="text-decoration-none">
  <div class="prod-card prod-item {{ $animate ?? '' }}" {{ ($style ?? null) ? 'style="' . $style . '"' : '' }}>
    <div class="prod-img-wrapper">
      @if($product->image)
        <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name }}">
      @else
        <div class="prod-img-placeholder">
          <i class="fas fa-cookie-bite"></i>
        </div>
      @endif
      @isset($badge)
        <span class="prod-badge {{ $badge_class ?? 'badge-hot' }}" {{ ($badge_style ?? null) ? 'style="' . $badge_style . '"' : '' }}>
          {{ $badge }}
        </span>
      @endisset
      <button class="prod-wishlist" data-product-id="{{ $product->id }}" title="Add to Wishlist">
        <i class="far fa-heart"></i>
      </button>
    </div>
    <div class="prod-body">
      <div class="prod-cat">{{ $product->category->name_en ?? 'Sweets' }}</div>
      <h5 class="prod-name">{{ $product->name }}</h5>
      <div class="prod-stars">★★★★★ <small>({{ $product->approved_reviews_count ?? 0 }})</small></div>
      <div class="prod-footer">
        <div>
          <span class="price-new">৳{{ number_format($product->sale_price ?? $product->price) }}</span>
          @if($product->sale_price && $product->sale_price < $product->price)
            <span class="price-old">৳{{ number_format($product->price) }}</span>
          @endif
        </div>
        <button class="add-btn" onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price ?? $product->price }}, '{{ $product->image ?? '' }}', event)">
          <i class="fas fa-plus"></i>
        </button>
      </div>
    </div>
  </div>
</a>
@endisset
