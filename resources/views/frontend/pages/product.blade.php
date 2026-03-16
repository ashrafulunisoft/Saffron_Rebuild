@extends('frontend.layouts.app')

@section('title', $product->name . ' - Saffron Sweets & Bakery')

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
          <i class="fas fa-box me-1"></i>{{ Str::limit($product->name ?? 'Product', 40) }}
        </li>
      </ol>
    </nav>

    <!-- Product Detail -->
    <div class="row g-5 mb-5">
      <!-- Product Images -->
      <div class="col-lg-6">
        <div class="glass-card p-4 mb-3">
          <div class="product-main-image">
            @if($product->image)
              <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name }}">
            @else
              <div class="product-image-placeholder">
                <i class="fas fa-cookie-bite"></i>
              </div>
            @endif
          </div>
        </div>
        <div class="d-flex gap-2 justify-content-center">
          <div class="product-thumb active">
            @if($product->image)
              <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name }}">
            @else
              <i class="fas fa-cookie-bite"></i>
            @endif
          </div>
        </div>

        <!-- Product Features -->
        <div class="row g-3 mt-4">
          <div class="col-6">
            <div class="feature-card">
              <i class="fas fa-leaf"></i>
              <span>100% Natural</span>
            </div>
          </div>
          <div class="col-6">
            <div class="feature-card">
              <i class="fas fa-truck"></i>
              <span>Fast Delivery</span>
            </div>
          </div>
          <div class="col-6">
            <div class="feature-card">
              <i class="fas fa-certificate"></i>
              <span>Premium Quality</span>
            </div>
          </div>
          <div class="col-6">
            <div class="feature-card">
              <i class="fas fa-headset"></i>
              <span>24/7 Support</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Product Info -->
      <div class="col-lg-6">
        <div class="product-badge-category">{{ $product->category->name_en ?? 'Sweets' }}</div>
        <h1 class="product-detail-title">{{ $product->name }}</h1>

        <div class="product-rating-row">
          <div class="stars">★★★★★</div>
          <span class="review-count">({{ $product->reviews_count ?? 0 }} reviews)</span>
          @if($product->stock > 0 && $product->stock < 10)
            <span class="stock-badge low-stock">Only {{ $product->stock }} left</span>
          @elseif($product->stock > 0)
            <span class="stock-badge in-stock">In Stock</span>
          @else
            <span class="stock-badge out-stock">Out of Stock</span>
          @endif
        </div>

        <div class="product-price-section">
          <span class="product-current-price">৳{{ number_format($product->price) }}</span>
          @if($product->compare_price)
            <span class="product-old-price">৳{{ number_format($product->compare_price) }}</span>
            <span class="discount-badge">
              {{ round((1 - $product->price / $product->compare_price) * 100) }}% OFF
            </span>
          @endif
        </div>

        <div class="product-description">
          <p>{{ $product->description ?? 'Experience the rich taste of our premium ' . $product->name . '. Made with the finest ingredients and traditional recipes, this delight is perfect for any occasion.' }}</p>
        </div>

        <!-- Quantity & Add to Cart -->
        <div class="product-actions">
          <div class="qty-selector-modern">
            <button class="qty-btn-modern" onclick="decreaseQty()">
              <i class="fas fa-minus"></i>
            </button>
            <span id="qtyValue" class="qty-value-modern">1</span>
            <button class="qty-btn-modern" onclick="increaseQty()">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          <button class="btn btn-glow btn-lg add-cart-btn" onclick="addToCartFromProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price ?? $product->price }}, '{{ $product->image ?? '' }}')">
            <i class="fas fa-shopping-bag me-2"></i>Add to Cart
          </button>
          <button class="btn btn-glass btn-lg wishlist-btn-modern" data-product-id="{{ $product->id }}" onclick="toggleProductWishlist({{ $product->id }}, this)">
            <i class="far fa-heart"></i>
          </button>
        </div>

        <!-- Product Meta -->
        <div class="glass-card product-meta-card">
          <div class="row g-3">
            <div class="col-sm-6">
              <div class="meta-item">
                <small class="meta-label">SKU:</small>
                <div class="meta-value">{{ $product->sku ?? 'N/A' }}</div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="meta-item">
                <small class="meta-label">Category:</small>
                <div class="meta-value">{{ $product->category->name_en ?? 'N/A' }}</div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="meta-item">
                <small class="meta-label">Availability:</small>
                <div class="meta-value">{{ $product->stock > 0 ? 'Available' : 'Out of Stock' }}</div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="meta-item">
                <small class="meta-label">Weight:</small>
                <div class="meta-value">{{ $product->weight ?? '250g' }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Product Details Tabs -->
    <div class="glass-card product-tabs-card mb-5">
      <ul class="nav product-tabs-nav" id="productTabs" role="tablist">
        <li class="nav-item">
          <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button">
            <i class="fas fa-align-left me-2"></i>Description
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="ingredients-tab" data-bs-toggle="tab" data-bs-target="#ingredients" type="button">
            <i class="fas fa-list me-2"></i>Ingredients
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="nutrition-tab" data-bs-toggle="tab" data-bs-target="#nutrition" type="button">
            <i class="fas fa-chart-pie me-2"></i>Nutrition
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">
            <i class="fas fa-star me-2"></i>Reviews ({{ $product->reviews_count ?? 0 }})
          </button>
        </li>
      </ul>
      <div class="tab-content product-tab-content" id="productTabsContent">
        <div class="tab-pane fade show active" id="description" role="tabpanel">
          <div class="product-tab-body">
            <h4>About this Product</h4>
            <p>{!! $product->description ?? 'Indulge in the exquisite taste of our ' . $product->name . '. Crafted with love and the finest ingredients, this delicious treat brings together traditional recipes and modern perfection. Each bite offers a perfect balance of flavors that will delight your taste buds.' !!}</p>
            <p>Perfect for celebrations, gifts, or simply treating yourself to something special. Our commitment to quality ensures that every product meets the highest standards of taste and freshness.</p>
          </div>
        </div>
        <div class="tab-pane fade" id="ingredients" role="tabpanel">
          <div class="product-tab-body">
            <h4>Ingredients</h4>
            <ul class="ingredients-list">
              <li><i class="fas fa-check text-success me-2"></i>Premium Flour</li>
              <li><i class="fas fa-check text-success me-2"></i>Fresh Dairy Products</li>
              <li><i class="fas fa-check text-success me-2"></i>Natural Sweeteners</li>
              <li><i class="fas fa-check text-success me-2"></i>Pure Ghee</li>
              <li><i class="fas fa-check text-success me-2"></i>Dried Fruits & Nuts</li>
              <li><i class="fas fa-check text-success me-2"></i>Natural Flavorings</li>
              <li><small class="text-muted">* May contain traces of nuts and dairy products</small></li>
            </ul>
          </div>
        </div>
        <div class="tab-pane fade" id="nutrition" role="tabpanel">
          <div class="product-tab-body">
            <h4>Nutritional Information</h4>
            <div class="row g-4">
              <div class="col-md-6">
                <div class="nutrition-item">
                  <span class="nutrition-label">Calories</span>
                  <span class="nutrition-value">280 kcal</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="nutrition-item">
                  <span class="nutrition-label">Protein</span>
                  <span class="nutrition-value">5g</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="nutrition-item">
                  <span class="nutrition-label">Carbohydrates</span>
                  <span class="nutrition-value">35g</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="nutrition-item">
                  <span class="nutrition-label">Fat</span>
                  <span class="nutrition-value">12g</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="nutrition-item">
                  <span class="nutrition-label">Fiber</span>
                  <span class="nutrition-value">2g</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="nutrition-item">
                  <span class="nutrition-label">Sugar</span>
                  <span class="nutrition-value">18g</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="reviews" role="tabpanel">
          <div class="product-tab-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h4>Customer Reviews</h4>
            </div>
            <div class="row mb-4">
              <div class="col-md-4 text-center">
                <div class="review-average">{{ number_format($product->averageRating, 1) }}</div>
                <div class="review-stars">{{ str_repeat('★', round($product->averageRating)) }}{{ str_repeat('☆', 5 - round($product->averageRating)) }}</div>
                <small class="text-muted">Based on {{ $product->reviews_count ?? 0 }} reviews</small>
              </div>
              <div class="col-md-8">
                @php
                  $ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
                  $totalReviews = $product->reviews_count ?? 0;
                  if($totalReviews > 0) {
                    foreach($product->reviews as $review) {
                      $ratingCounts[$review->rating] = ($ratingCounts[$review->rating] ?? 0) + 1;
                    }
                  }
                @endphp
                <div class="review-bars">
                  @for($i = 5; $i >= 1; $i--)
                  <div class="review-bar">
                    <span>{{ $i }} ★</span>
                    <div class="bar-bg"><div class="bar-fill" style="width: {{ $totalReviews > 0 ? ($ratingCounts[$i] / $totalReviews * 100) : 0 }}%;"></div></div>
                    <span>{{ $totalReviews > 0 ? round($ratingCounts[$i] / $totalReviews * 100) : 0 }}%</span>
                  </div>
                  @endfor
                </div>
              </div>
            </div>

            <!-- Review Form Section -->
            @auth
            <div class="review-form-section mt-5">
              <div class="glass-card p-4">
                <h5 class="mb-4" style="color: #fbbf24;">
                  <i class="fas fa-pen me-2"></i>Write Your Review
                </h5>
                <form id="reviewForm" method="POST" action="{{ route('product.review.store', $product) }}">
                  @csrf
                  <div class="row g-3">
                    <div class="col-12">
                      <label class="form-label">Your Rating <span class="text-danger">*</span></label>
                      <div class="star-rating-input">
                        @for($i = 1; $i <= 5; $i++)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required/>
                        <label for="star{{ $i }}" class="star-label">★</label>
                        @endfor
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="comment" class="form-label">Your Review <span class="text-danger">*</span></label>
                      <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Share your experience with this product..." required minlength="10" maxlength="1000" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #f5e6cc;"></textarea>
                      <small class="text-muted" style="color: rgba(245,230,204,0.5);">Minimum 10 characters, maximum 1000 characters</small>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-glow w-100">
                        <i class="fas fa-paper-plane me-2"></i>Submit Review
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            @else
            <div class="text-center py-4 mb-4">
              <p style="color: rgba(245,230,204,0.8); margin-bottom: 1rem;">
                <i class="fas fa-sign-in-alt me-2" style="color: #fbbf24;"></i>
                Please <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" style="color: #f59e0b; text-decoration: underline;">login</a> to write a review
              </p>
            </div>
            @endif

            <h6 class="mt-5 mb-4" style="color: #fbbf24;">Recent Reviews</h6>
            @if($product->reviews && $product->reviews->count() > 0)
              @foreach($product->reviews as $review)
              <div class="review-item">
                <div class="d-flex justify-content-between">
                  <div class="d-flex align-items-center">
                    <div class="review-avatar">{{ strtoupper(substr($review->user->name ?? 'A', 0, 1)) }}</div>
                  <div>
                    <h6 class="mb-0">
                      {{ $review->user->name ?? 'Anonymous' }}
                      @if(!$review->is_approved && auth()->id() === $review->user_id)
                      <span class="badge bg-warning text-dark ms-2" style="font-size: 0.7rem;">
                        <i class="fas fa-clock me-1"></i>Pending Approval
                      </span>
                      @endif
                    </h6>
                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                  </div>
                </div>
                <div class="review-stars">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</div>
              </div>
              <p class="mt-3 mb-0" style="color: rgba(245,230,204,0.8);">{{ $review->comment }}</p>
            </div>
            @endforeach
            @else
              <div class="text-center py-5">
                <i class="fas fa-star fa-3x mb-3" style="color: rgba(245,158,11,0.3);"></i>
                <p style="color: rgba(245,230,204,0.7);">No reviews yet. Be the first to review this product!</p>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Related Products -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <div class="related-products-section">
      <h3 class="section-title text-center mb-4">
        You May Also <span class="gradient-text">Like</span>
      </h3>
      <div class="row g-4">
        @foreach($relatedProducts->take(4) as $related)
        <div class="col-6 col-md-3">
          <div class="prod-card">
            <div class="prod-img-wrapper">
              @if($related->image)
                <img src="{{ asset("storage/{$related->image}") }}" alt="{{ $related->name }}">
              @else
                <div class="prod-img-placeholder">
                  <i class="fas fa-cookie-bite"></i>
                </div>
              @endif
              <button class="prod-wishlist" data-product-id="{{ $related->id }}" title="Add to Wishlist">
                <i class="far fa-heart"></i>
              </button>
            </div>
            <div class="prod-details">
              <span class="prod-cat">{{ $related->category->name_en ?? 'Sweets' }}</span>
              <h6 class="prod-title">{{ $related->name }}</h6>
              <div class="d-flex justify-content-between align-items-center">
                <span class="prod-price">৳{{ number_format($related->price) }}</span>
                <button class="prod-cart-btn" onclick="addToCart({{ $related->id }}, '{{ $related->name }}', {{ $related->sale_price ?? $related->price }}, '{{ $related->image ?? '' }}', event)">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <a href="{{ route('shop.product', $related->slug) }}" class="prod-link-overlay"></a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</div>
@endsection

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

  /* Product Image Styles */
  .product-main-image {
    position: relative;
    width: 100%;
    padding-top: 100%;
    overflow: hidden;
    border-radius: 12px;
    background: rgba(255,255,255,0.03);
  }

  .product-main-image img,
  .product-image-placeholder {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .product-image-placeholder {
    font-size: 5rem;
    color: rgba(245,230,204,0.3);
    background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(244,63,94,0.05));
  }

  .product-thumb {
    width: 80px;
    height: 80px;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    background: rgba(255,255,255,0.05);
  }

  .product-thumb.active {
    border-color: #fbbf24;
    transform: scale(1.05);
  }

  .product-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .product-thumb i {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    font-size: 2rem;
    color: rgba(245,230,204,0.5);
  }

  /* Feature Cards */
  .feature-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    transition: all 0.3s ease;
  }

  .feature-card:hover {
    background: rgba(245,158,11,0.15);
    border-color: rgba(245,158,11,0.3);
    transform: translateY(-3px);
  }

  .feature-card i {
    font-size: 1.5rem;
    color: #fbbf24;
    margin-bottom: 0.5rem;
  }

  .feature-card span {
    font-size: 0.8rem;
    color: rgba(245,230,204,0.8);
    text-align: center;
  }

  /* Product Info Styles */
  .product-badge-category {
    display: inline-block;
    padding: 0.4rem 1rem;
    background: rgba(245,158,11,0.15);
    border: 1px solid rgba(245,158,11,0.3);
    border-radius: 20px;
    color: #fbbf24;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
  }

  .product-detail-title {
    color: #f5e6cc;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.2;
  }

  .product-rating-row {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
  }

  .product-rating-row .stars {
    color: #fbbf24;
    font-size: 1.2rem;
  }

  .review-count {
    color: rgba(245,230,204,0.6);
    font-size: 0.9rem;
  }

  .stock-badge {
    padding: 0.3rem 0.8rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
  }

  .stock-badge.in-stock {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
  }

  .stock-badge.low-stock {
    background: rgba(245,158,11,0.2);
    color: #fbbf24;
    animation: pulse 2s infinite;
  }

  .stock-badge.out-stock {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
  }

  @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
  }

  /* Product Price Section */
  .product-price-section {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
  }

  .product-current-price {
    font-family: 'Playfair Display', serif;
    font-size: 3rem;
    font-weight: 700;
    color: #fbbf24;
  }

  .product-old-price {
    font-size: 1.5rem;
    color: rgba(245,230,204,0.4);
    text-decoration: line-through;
  }

  .discount-badge {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 700;
  }

  /* Product Description */
  .product-description {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
  }

  .product-description p {
    color: rgba(245,230,204,0.8);
    line-height: 1.8;
    margin: 0;
  }

  /* Product Actions */
  .product-actions {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    align-items: center;
  }

  .qty-selector-modern {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 12px;
    overflow: hidden;
  }

  .qty-btn-modern {
    width: 45px;
    height: 50px;
    background: transparent;
    border: none;
    color: rgba(245,230,204,0.8);
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .qty-btn-modern:hover {
    background: rgba(245,158,11,0.15);
    color: #fbbf24;
  }

  .qty-value-modern {
    width: 60px;
    text-align: center;
    font-size: 1.2rem;
    font-weight: 700;
    color: #f5e6cc;
  }

  .add-cart-btn {
    flex: 1;
    padding: 1rem 2rem;
    font-size: 1.1rem;
  }

  .wishlist-btn-modern {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .wishlist-btn-modern i {
    font-size: 1.2rem;
    transition: all 0.3s ease;
  }

  .wishlist-btn-modern:hover i {
    color: #f43f5e;
    transform: scale(1.2);
  }

  /* Product Meta Card */
  .product-meta-card {
    padding: 1.5rem;
  }

  .meta-item {
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
  }

  .meta-item:last-child {
    border-bottom: none;
  }

  .meta-label {
    color: rgba(245,230,204,0.6);
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .meta-value {
    color: #f5e6cc;
    font-size: 1rem;
    font-weight: 500;
    margin-top: 0.25rem;
  }

  /* Product Tabs */
  .product-tabs-card {
    padding: 0;
    overflow: hidden;
  }

  .product-tabs-nav {
    display: flex;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    background: rgba(255,255,255,0.03);
    padding: 0 1rem;
    overflow-x: auto;
  }

  .product-tabs-nav .nav-item {
    flex: 0 0 auto;
  }

  .product-tabs-nav .nav-link {
    padding: 1.2rem 1.5rem;
    color: rgba(245,230,204,0.7);
    background: transparent;
    border: none;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
    white-space: nowrap;
  }

  .product-tabs-nav .nav-link:hover {
    color: #fbbf24;
    background: rgba(245,158,11,0.1);
  }

  .product-tabs-nav .nav-link.active {
    color: #fbbf24;
    background: transparent;
    border-bottom-color: #fbbf24;
  }

  .product-tab-content {
    padding: 2rem;
  }

  .product-tab-body h4 {
    color: #f5e6cc;
    margin-bottom: 1.5rem;
    font-size: 1.5rem;
  }

  .product-tab-body p {
    color: rgba(245,230,204,0.8);
    line-height: 1.8;
    margin-bottom: 1rem;
  }

  /* Ingredients List */
  .ingredients-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .ingredients-list li {
    padding: 0.75rem 0;
    color: rgba(245,230,204,0.8);
    border-bottom: 1px solid rgba(255,255,255,0.05);
    display: flex;
    align-items: center;
  }

  .ingredients-list li:last-child {
    border-bottom: none;
  }

  /* Nutrition Items */
  .nutrition-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    transition: all 0.3s ease;
  }

  .nutrition-item:hover {
    background: rgba(245,158,11,0.1);
    border-color: rgba(245,158,11,0.2);
  }

  .nutrition-label {
    color: rgba(245,230,204,0.8);
    font-size: 0.95rem;
  }

  .nutrition-value {
    color: #fbbf24;
    font-size: 1.1rem;
    font-weight: 700;
  }

  /* Reviews Section */
  .review-average {
    font-size: 4rem;
    font-weight: 700;
    color: #fbbf24;
    line-height: 1;
  }

  .review-stars {
    color: #fbbf24;
    font-size: 1.5rem;
    margin: 0.5rem 0;
  }

  .review-bars {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }

  .review-bar {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 0.85rem;
    color: rgba(245,230,204,0.7);
  }

  .review-bar .bar-bg {
    flex: 1;
    height: 8px;
    background: rgba(255,255,255,0.1);
    border-radius: 4px;
    overflow: hidden;
  }

  .review-bar .bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #fbbf24, #f59e0b);
    border-radius: 4px;
  }

  .review-item {
    padding: 1.5rem;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    margin-top: 1rem;
  }

  .review-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f59e0b, #f43f5e);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.2rem;
    margin-right: 1rem;
  }

  /* Related Products */
  .related-products-section {
    margin-top: 4rem;
  }

  /* Product Card Styles for Related Products */
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
    height: 200px;
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
    font-size: 3.5rem;
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
    top: 10px;
    right: 10px;
    width: 38px;
    height: 38px;
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

  /* Responsive */
  @media (max-width: 768px) {
    .product-detail-title {
      font-size: 1.8rem;
    }

    .product-current-price {
      font-size: 2rem;
    }

    .product-actions {
      flex-direction: column;
    }

    .qty-selector-modern {
      width: 100%;
      justify-content: center;
    }

    .add-cart-btn {
      width: 100%;
    }

    .product-tabs-nav {
      flex-wrap: nowrap;
    }

    .product-tabs-nav .nav-link {
      padding: 1rem;
      font-size: 0.9rem;
    }
  }

  /* Breadcrumb Styles */
  .breadcrumb-glass {
    background: rgba(255,255,255,0.05);
    padding: 0.8rem 1.5rem;
    border-radius: 12px;
    display: inline-flex;
    border: 1px solid rgba(255,255,255,0.1);
  }

  .breadcrumb-glass .breadcrumb-item {
    display: flex;
    align-items: center;
  }

  .breadcrumb-glass .breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: rgba(245,230,204,0.4);
    font-size: 0.8rem;
    margin: 0 0.75rem;
  }

  .breadcrumb-glass .breadcrumb-item a {
    color: #f59e0b;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .breadcrumb-glass .breadcrumb-item a:hover {
    color: #fbbf24;
    text-decoration: underline;
  }

  .breadcrumb-glass .breadcrumb-item.active {
    color: #f5e6cc;
  }

  /* Star Rating Input Styles */
  .star-rating-input {
    display: inline-flex;
    flex-direction: row-reverse;
    justify-content: center;
    gap: 0.5rem;
  }

  .star-rating-input input {
    display: none;
  }

  .star-rating-input label {
    font-size: 2rem;
    color: rgba(245,230,204,0.3);
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .star-rating-input label:hover,
  .star-rating-input label:hover ~ label {
    color: #fbbf24;
    transform: scale(1.1);
  }

  .star-rating-input input:checked ~ label {
    color: #fbbf24;
  }

  .star-rating-input label:active {
    transform: scale(0.9);
  }

  /* Review Form Section - Mobile Responsive */
  .review-form-section {
    margin-top: 2rem;
  }

  .review-form-section .glass-card {
    border: 1px solid rgba(245, 158, 11, 0.2);
    background: rgba(15, 23, 42, 0.6);
  }

  .review-form-section .form-label {
    color: #f5e6cc;
    font-weight: 500;
    margin-bottom: 0.5rem;
  }

  .review-form-section .form-control:focus {
    background: rgba(255, 255, 255, 0.08);
    border-color: #f59e0b;
    color: #f5e6cc;
    box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
  }

  /* Mobile Responsive Star Rating */
  @media (max-width: 768px) {
    .star-rating-input {
      transform: scale(0.9);
      transform-origin: left;
    }

    .star-rating-input label {
      font-size: 1.5rem;
    }

    .review-form-section .glass-card {
      padding: 1rem !important;
    }

    .review-form-section h5 {
      font-size: 1.1rem;
    }
  }

  @media (max-width: 480px) {
    .star-rating-input {
      transform: scale(0.8);
      transform-origin: left;
    }

    .star-rating-input label {
      font-size: 1.2rem;
    }
  }

  /* Responsive Review Form */
  @media (max-width: 768px) {
    .review-form-section .col-12 {
      padding-left: 0.5rem;
      padding-right: 0.5rem;
    }

    .review-form-section textarea {
      font-size: 0.9rem;
    }
  }
</style>
@endpush

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

// Toggle wishlist for main product button
function toggleProductWishlist(productId, button) {
  // Check authentication first
  if (!window.requireAuth()) {
    return; // Stop if user is not authenticated
  }

  const icon = button.querySelector('i');
  const isActive = button.classList.contains('active');

  // Toggle visual state immediately for better UX
  if (isActive) {
    button.classList.remove('active');
    icon.classList.remove('fas');
    icon.classList.add('far');
    button.style.background = '';
  } else {
    button.classList.add('active');
    icon.classList.remove('far');
    icon.classList.add('fas');
    button.style.background = 'rgba(244,63,94,0.2)';
  }

  // Make API call to toggle wishlist
  toggleWishlist(productId, button);
}

// Get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
}

// Add to Cart from product page (with quantity selector)
function addToCartFromProduct(productId, productName, price, image) {
  const qty = document.getElementById('qtyValue');
  const quantity = parseInt(qty.textContent);
  const button = document.querySelector('.add-cart-btn');
  const originalHTML = button.innerHTML;

  // Show loading state
  button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding...';
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
      quantity: quantity
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
      button.innerHTML = '<i class="fas fa-check me-2"></i>Added!';
      button.style.background = 'linear-gradient(135deg, #10b981, #059669)';

      // Show toast notification
      showToast(`${quantity} item(s) added to cart successfully!`);

      setTimeout(() => {
        button.innerHTML = originalHTML;
        button.style.background = '';
        button.disabled = false;
        // Reset quantity to 1
        qty.textContent = '1';
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

// Add to Cart for related products
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

// Toggle wishlist for main product button
function toggleProductWishlist(productId, button) {
  // Check authentication first
  if (!window.requireAuth()) {
    return; // Stop if user is not authenticated
  }

  const icon = button.querySelector('i');
  const isActive = button.classList.contains('active');

  // Toggle visual state immediately for better UX
  if (isActive) {
    button.classList.remove('active');
    icon.classList.remove('fas');
    icon.classList.add('far');
    button.style.background = '';
  } else {
    button.classList.add('active');
    icon.classList.remove('far');
    icon.classList.add('fas');
    button.style.background = 'rgba(244,63,94,0.2)';
  }

  // Make API call to toggle wishlist
  toggleWishlist(productId, button);
}

// Toggle wishlist for related products
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
      icon.style.transform = 'scale(1.3)';
      setTimeout(() => {
        icon.style.transform = 'scale(1)';
      }, 200);
    }

    // Make API call to toggle wishlist
    toggleWishlist(productId, this);
  });
});

// Notification Function
function showNotification(type, message) {
  const notification = document.createElement('div');
  notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
  notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px; background: ' + (type === 'success' ? 'rgba(34, 197, 94, 0.95)' : 'rgba(239, 68, 68, 0.95)') + '; backdrop-filter: blur(20px); border: 1px solid ' + (type === 'success' ? 'rgba(34, 197, 94, 0.3)' : 'rgba(239, 68, 68, 0.3)') + '; color: #fff;';
  notification.innerHTML = `
    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="filter: brightness(0) invert(1);"></button>
  `;

  document.body.appendChild(notification);

  setTimeout(() => {
    notification.remove();
  }, 5000);
}

// Review Form Submission (No Modal)
const reviewForm = document.getElementById('reviewForm');
if (reviewForm) {
  reviewForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;

    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';

    fetch(this.action, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Accept': 'application/json'
      },
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Show success message
        showNotification('success', data.message);

        // Reset form
        reviewForm.reset();

        // Reset star rating visual
        const starInputs = document.querySelectorAll('.star-rating-input input');
        starInputs.forEach(input => {
          input.checked = false;
          input.nextElementSibling.style.color = 'rgba(245,230,204,0.3)';
        });

        // Refresh the page after a short delay to show the new review
        setTimeout(() => {
          location.reload();
        }, 2000);
      } else {
        showNotification('error', data.message || 'Failed to submit review. Please try again.');
      }
    })
    .catch(error => {
      console.error('Error submitting review:', error);
      showNotification('error', 'An error occurred. Please try again.');
    })
    .finally(() => {
      submitBtn.disabled = false;
      submitBtn.innerHTML = originalText;
    });
  });
}

// Star Rating Interaction
const starInputs = document.querySelectorAll('.star-rating-input input');
starInputs.forEach(input => {
  input.addEventListener('change', function() {
    // Reset all stars
    starInputs.forEach(inp => {
      inp.nextElementSibling.style.color = 'rgba(245,230,204,0.3)';
    });

    // Highlight selected and previous stars
    let currentInput = this;
    while (currentInput) {
      currentInput.nextElementSibling.style.color = '#fbbf24';
      currentInput = currentInput.previousElementSibling?.previousElementSibling;
    }
  });
});
</script>
@endpush
