@extends('frontend.layouts.app')

@section('title', 'Home - Saffron Sweets & Bakery')

@section('content')

<!-- HERO SECTION -->
<section class="hero-section">
  <div class="hero-bg-pattern"></div>
  <div class="hero-grid"></div>

  <!-- Floating Cards -->
  <div class="floating-card fc-1">
    <div class="fc-icon">🍪</div>
    <div><div class="fc-text">Fresh Daily</div><div class="fc-sub">Baked with love</div></div>
  </div>
  <div class="floating-card fc-2">
    <div class="fc-icon">⭐</div>
    <div><div class="fc-text">4.9 Rating</div><div class="fc-sub">15K+ Reviews</div></div>
  </div>
  <div class="floating-card fc-3">
    <div class="fc-icon">🚚</div>
    <div><div class="fc-text">Free Delivery</div><div class="fc-sub">On orders ৳1000+</div></div>
  </div>
  <div class="floating-card fc-4">
    <div class="fc-icon">🏆</div>
    <div><div class="fc-text">Since 1995</div><div class="fc-sub">30+ Years</div></div>
  </div>

  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 hero-content">
        @if($cmsSections && isset($cmsSections['hero']))
          <div class="section-badge mb-3 animate-on-scroll">
            🎂 <i class="fas fa-star text-warning me-2"></i>{{ $cmsSections['hero']->subtitle_en ?? 'Premium Quality Since 1995' }}
          </div>
          <h1 class="hero-title animate-on-scroll">
            {!! $cmsSections['hero']->title_en !!}
          </h1>
          <p class="hero-sub animate-on-scroll">
            {!! $cmsSections['hero']->content_en !!}
          </p>
          <div class="d-flex gap-3 flex-wrap animate-on-scroll">
            @if($cmsSections['hero']->button_url)
            <a href="{{ $cmsSections['hero']->button_url }}" class="btn btn-glow btn-lg px-4">
              <i class="fas fa-shopping-basket me-2"></i>{{ $cmsSections['hero']->button_text_en ?? 'Shop Now' }}
            </a>
            @endif
            <a href="#about" class="btn btn-glass btn-lg px-4">
              <i class="fas fa-play-circle me-2"></i>Our Story
            </a>
          </div>
        @else
          <div class="section-badge mb-3 animate-on-scroll">
            <i class="fas fa-star text-warning me-2"></i>Premium Quality Since 1995
          </div>
          <h1 class="hero-title animate-on-scroll">
            Authentic Saffron<br/>
            <span class="gradient-text">Sweets & Bakery</span>
          </h1>
          <p class="hero-sub animate-on-scroll">
            Indulge in the rich heritage of Bengal with our exquisite collection of traditional sweets and premium bakery items, crafted with love and the purest saffron.
          </p>
          <div class="d-flex gap-3 flex-wrap animate-on-scroll">
            <a href="{{ route('shop') }}" class="btn btn-glow btn-lg px-4">
              <i class="fas fa-shopping-basket me-2"></i>Shop Now
            </a>
            <a href="#about" class="btn btn-glass btn-lg px-4">
              <i class="fas fa-play-circle me-2"></i>Our Story
            </a>
          </div>
        @endif
        <div class="hero-stats animate-on-scroll">
          <div class="stat-item">
            <span class="stat-num">250+</span>
            <span class="stat-label">Products</span>
          </div>
          <div class="stat-item">
            <span class="stat-num">15K+</span>
            <span class="stat-label">Happy Customers</span>
          </div>
          <div class="stat-item">
            <span class="stat-num">30+</span>
            <span class="stat-label">Years Experience</span>
          </div>
          <div class="stat-item">
            <span class="stat-num">4.9★</span>
            <span class="stat-label">Rating</span>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="hero-showcase animate-on-scroll">
          <div class="showcase-ring"></div>
          <div class="showcase-center">
            <div class="showcase-emoji">{{ $cmsSections['hero']->icon ?? '🎂' }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MARQUEE -->
<section class="marquee-section">
  <div class="marquee-track">
    <div class="marquee-item"><i class="fas fa-check-circle"></i> 100% Natural Ingredients</div>
    <div class="marquee-item"><i class="fas fa-check-circle"></i> Traditional Recipes</div>
    <div class="marquee-item"><i class="fas fa-check-circle"></i> Halal Certified</div>
    <div class="marquee-item"><i class="fas fa-check-circle"></i> Fresh Daily Production</div>
    <div class="marquee-item"><i class="fas fa-check-circle"></i> Same Day Delivery</div>
    <div class="marquee-item"><i class="fas fa-check-circle"></i> Gift Packaging Available</div>
    <div class="marquee-item"><i class="fas fa-check-circle"></i> 100% Natural Ingredients</div>
    <div class="marquee-item"><i class="fas fa-check-circle"></i> Traditional Recipes</div>
    <div class="marquee-item"><i class="fas fa-check-circle"></i> Halal Certified</div>
    <div class="marquee-item"><i class="fas fa-check-circle"></i> Fresh Daily Production</div>
    <div class="marquee-item"><i class="fas fa-check-circle"></i> Same Day Delivery</div>
    <div class="marquee-item"><i class="fas fa-check-circle"></i> Gift Packaging Available</div>
  </div>
</section>

<!-- CATEGORIES - EXPLORE OUR DELICIOUS COLLECTION -->
<section class="section-gap">
  <div class="container">
    <div class="text-center mb-5">
      @if($cmsSections && isset($cmsSections['browse-categories']))
        <span class="section-badge animate-on-scroll">{{ $cmsSections['browse-categories']->title_en ?? 'Browse Categories' }}</span>
        <h2 class="section-title mt-3 animate-on-scroll">
          {!! $cmsSections['browse-categories']->subtitle_en ?? 'Explore Our <span class="gradient-text">Delicious</span> Collection' !!}
        </h2>
        @if($cmsSections['browse-categories']->content_en)
        <p class="mt-3 animate-on-scroll" style="color:var(--text-70);max-width:700px;margin-left:auto;margin-right:auto;">
          {!! $cmsSections['browse-categories']->content_en !!}
        </p>
        @endif
      @else
        <span class="section-badge animate-on-scroll">Browse Categories</span>
        <h2 class="section-title mt-3 animate-on-scroll">Explore Our <span class="gradient-text">Delicious</span> Collection</h2>
      @endif
    </div>
    <div class="category-grid animate-on-scroll">
      @foreach($categories as $category)
        @php
          // Emoji mapping for categories
          $emojis = [
            'breads' => '🍞',
            'cakes' => '🎂',
            'cake' => '🎂',
            'cookies-biscuits' => '🍪',
            'traditional-sweets' => '🍬',
            'sweet' => '🍮',
            'dairy-products' => '🥛',
            'buns-rolls' => '🥯',
            'pastries-savories' => '🥧',
            'bengali-sweets' => '🍬',
            'bakery' => '🥐',
            'chocolates' => '🍫',
            'cookies' => '🍪',
            'pastries' => '🥧',
          ];

          $emoji = $emojis[$category->slug] ?? '🍰';
        @endphp
        <a href="{{ route('shop.category', $category->slug) }}" class="cat-card">
          <div class="cat-emoji">{{ $emoji }}</div>
          <div class="cat-name">{{ $category->name_en }}</div>
          <div class="cat-count">{{ $category->products_count }} items</div>
        </a>
      @endforeach
    </div>
  </div>
</section>

<!-- FEATURED PRODUCTS -->
<section class="section-gap" id="products">
  <div class="container">
    <!-- Section Header - Center Aligned -->
    <div class="text-center mb-4">
      @if($cmsSections && isset($cmsSections['featured_products']))
        <span class="section-badge animate-on-scroll">{{ $cmsSections['featured_products']->title_en ?? 'Our Collection' }}</span>
        <h2 class="section-title mt-3 animate-on-scroll">
          {!! $cmsSections['featured_products']->subtitle_en ?? 'Featured <span class="gradient-text">Products</span>' !!}
        </h2>
        @if($cmsSections['featured_products']->content_en)
        <p class="mt-2 animate-on-scroll" style="color:var(--text-60);max-width:600px;margin-left:auto;margin-right:auto;">
          {!! $cmsSections['featured_products']->content_en !!}
        </p>
        @endif
      @else
        <span class="section-badge animate-on-scroll">Our Collection</span>
        <h2 class="section-title mt-3 animate-on-scroll">
          Featured <span class="gradient-text">Products</span>
        </h2>
        <p class="mt-2 animate-on-scroll" style="color:var(--text-60);max-width:600px;margin-left:auto;margin-right:auto;">Handpicked favorites from our extensive collection</p>
      @endif
      <div class="mt-3">
        <a href="{{ route('shop') }}" class="btn btn-glow btn-sm">
          <i class="fas fa-th-large me-2"></i>View All
        </a>
      </div>
    </div>

    <!-- Category Filters - Center -->
    <div class="d-flex justify-content-center gap-2 mb-4 flex-wrap">
      <button class="filter-btn active" onclick="filterFeaturedProd(this, 'all')">All Products</button>
      @foreach($categories as $category)
        <button class="filter-btn" onclick="filterFeaturedProd(this, '{{ $category->slug }}')">{{ $category->name_en }}</button>
      @endforeach
    </div>

    <!-- Products Slider Container -->
    <div class="new-arrivals-slider-wrapper animate-on-scroll" id="featuredSliderWrapper">
      <button class="slider-nav-btn slider-prev" id="featuredPrev" aria-label="Previous">
        <i class="fas fa-chevron-left"></i>
      </button>

      <div class="new-arrivals-slider" id="featuredSlider">
        @if(isset($featuredProducts) && $featuredProducts->count() > 0)
          @foreach($featuredProducts as $product)
          <div class="slider-product-card" data-cat="{{ $product->category->slug ?? 'breads' }}">
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
                  <span class="product-category-badge" style="left:auto;right:10px;background:linear-gradient(135deg,{$themePrimary},{$themeSecondary});color:#fff;">FEATURED</span>
                @endif

                <!-- Wishlist Icon (Top Right) -->
                <button class="product-wishlist-btn prod-wishlist" data-product-id="{{ $product->id }}" title="Add to Wishlist">
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
                        $featDiscount = round(($product->compare_price - $product->price) / $product->compare_price * 100);
                      @endphp
                      @if($featDiscount > 0)
                        <span class="discount-badge">-{{ $featDiscount }}%</span>
                      @endif
                    @endif
                  </div>
                </div>
              </div>
            </a>
          </div>
          @endforeach

          <!-- View All Products Card -->
          <div class="slider-product-card view-all-trigger-card">
            <a href="{{ route('shop') }}" class="text-decoration-none" style="width:100%;height:100%;display:flex;">
              <div class="view-all-card-content">
                <div class="view-all-icon"><i class="fas fa-arrow-right"></i></div>
                <h4>View All Products</h4>
                <p>Explore our complete collection</p>
              </div>
            </a>
          </div>
        @else
          <div class="text-center py-5" style="width:100%;">
            <p style="color:var(--text-60);">No products available at the moment.</p>
          </div>
        @endif
      </div>

      <button class="slider-nav-btn slider-next" id="featuredNext" aria-label="Next">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    <div class="text-center mt-5">
      <a href="{{ route('shop') }}" class="btn btn-glow btn-lg">
        View All Products <i class="fas fa-arrow-right ms-2"></i>
      </a>
    </div>
  </div>
</section>

<!-- WHO WE ARE / ABOUT -->
<section class="section-gap about-split" id="about">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <div class="about-image-container">
          <div class="glass-card-glow p-3 animate-on-scroll" style="height:100%;display:flex;align-items:center;justify-content:center;">
            <div style="font-size:12rem;">{{ $cmsSections['who-we-are']->icon ?? '🏪' }}</div>
          </div>
          <div class="about-image-float aif-1 glass-card text-center p-3">
            <div class="about-badge">👨‍🍳</div>
            <div class="about-counter">50+</div>
            <div style="font-size:.8rem;color:var(--text-60);">Expert Chefs</div>
          </div>
          <div class="about-image-float aif-2 glass-card text-center p-3">
            <div class="about-badge">🏆</div>
            <div class="about-counter">30+</div>
            <div style="font-size:.8rem;color:var(--text-60);">Awards Won</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        @if($cmsSections && isset($cmsSections['who-we-are']))
          <span class="section-badge animate-on-scroll">{{ $cmsSections['who-we-are']->title_en ?? 'Who We Are' }}</span>
          <h2 class="section-title mt-3 animate-on-scroll">
            {!! $cmsSections['who-we-are']->subtitle_en ?? 'Authentic Saffron<br/><span class="gradient-text">Sweets & Traditional Bakery</span>' !!}
          </h2>
          <p class="mt-4 animate-on-scroll" style="color:var(--text-75);line-height:1.9;font-size:1.05rem;">
            {!! $cmsSections['who-we-are']->content_en ?? 'Welcome to Saffron, where tradition meets excellence.' !!}
          </p>
        @else
          <span class="section-badge animate-on-scroll">Who We Are</span>
          <h2 class="section-title mt-3 animate-on-scroll">
            Authentic Saffron<br/>
            <span class="gradient-text">Sweets & Traditional Bakery</span>
          </h2>
          <p class="mt-4 animate-on-scroll" style="color:var(--text-75);line-height:1.9;font-size:1.05rem;">
            Welcome to Saffron, where tradition meets excellence. We bring you the finest collection of authentic Bengali sweets and premium bakery items, crafted with love and the purest saffron.
          </p>
          <p class="animate-on-scroll" style="color:var(--text-70);line-height:1.9;">
            Our skilled artisans use time-honored recipes passed down through generations to create mouth-watering treats that will transport you to the streets of Bangladesh. From roshogolla to sandesh, from freshly baked cakes to artisan cookies – every bite is a celebration of flavor.
          </p>
        @endif
        <div class="feature-list animate-on-scroll">
          <div class="feature-item">
            <div class="feature-icon-box">✓</div>
            <div><strong style="color:var(--theme-text-primary);">100% Natural Ingredients</strong><br/><small style="color:var(--text-50);">No preservatives, no artificial colors</small></div>
          </div>
          <div class="feature-item">
            <div class="feature-icon-box">👨‍🍳</div>
            <div><strong style="color:var(--theme-text-primary);">Expert Chefs</strong><br/><small style="color:var(--text-50);">Skilled artisans with decades of experience</small></div>
          </div>
          <div class="feature-item">
            <div class="feature-icon-box">🚚</div>
            <div><strong style="color:var(--theme-text-primary);">Fast Delivery</strong><br/><small style="color:var(--text-50);">Quick & safe delivery to your doorstep</small></div>
          </div>
          <div class="feature-item">
            <div class="feature-icon-box">💝</div>
            <div><strong style="color:var(--theme-text-primary);">Made with Love</strong><br/><small style="color:var(--text-50);">Crafted with passion and care</small></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- NEW ARRIVALS - SLIDER SECTION -->
<section class="section-gap" id="new-arrivals">
  <div class="container">
    <!-- Section Header -->
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-5">
      <div class="flex-grow-1">
        @if($cmsSections && isset($cmsSections['new-arrivals']))
          <span class="section-badge animate-on-scroll"><i class="fas fa-sparkles me-2"></i>{{ $cmsSections['new-arrivals']->title_en ?? 'Just Launched' }}</span>
          <h2 class="section-title mt-3 animate-on-scroll">
            {!! $cmsSections['new-arrivals']->subtitle_en ?? 'New <span class="gradient-text">Arrivals</span>' !!}
          </h2>
          @if($cmsSections['new-arrivals']->content_en)
          <p class="mt-2 animate-on-scroll" style="color:var(--text-60);max-width:500px;">
            {!! $cmsSections['new-arrivals']->content_en !!}
          </p>
          @endif
        @else
          <span class="section-badge animate-on-scroll"><i class="fas fa-sparkles me-2"></i>Just Launched</span>
          <h2 class="section-title mt-3 animate-on-scroll">New <span class="gradient-text">Arrivals</span></h2>
          <p class="mt-2 animate-on-scroll" style="color:var(--text-60);max-width:500px;">Discover our latest creations - fresh from the oven and ready to delight your taste buds</p>
        @endif
      </div>
      <div class="flex-shrink-0">
        @if($cmsSections && isset($cmsSections['new-arrivals']) && $cmsSections['new-arrivals']->button_url)
          <a href="{{ $cmsSections['new-arrivals']->button_url }}" class="btn btn-glow btn-sm">
            <i class="fas fa-th-large me-2"></i>View All
          </a>
        @else
          <a href="{{ route('shop') }}" class="btn btn-glow btn-sm">
            <i class="fas fa-th-large me-2"></i>View All
          </a>
        @endif
      </div>
    </div>

    <!-- Products Slider Container -->
    <div class="new-arrivals-slider-wrapper animate-on-scroll">
      <!-- Navigation Buttons -->
      <button class="slider-nav-btn slider-prev" id="newArrivalsPrev" aria-label="Previous">
        <i class="fas fa-chevron-left"></i>
      </button>

      <!-- Slider Track -->
      <div class="new-arrivals-slider" id="newArrivalsSlider">
        @if(isset($newArrivals) && $newArrivals->count() > 0)
          @foreach($newArrivals as $index => $product)
            <div class="slider-product-card">
              <a href="{{ route('shop.product', $product->slug) }}" class="text-decoration-none">
                <!-- Product Image -->
                <div class="product-card-img">
                  @if($product->image)
                    <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name_en }}" loading="lazy">
                  @else
                    <div class="prod-img-placeholder">
                      <i class="fas fa-cookie-bite"></i>
                    </div>
                  @endif

                  <!-- Category Badge (Top Left) -->
                  <span class="product-category-badge">{{ $product->category->name_en ?? 'Sweets' }}</span>

                  <!-- Wishlist Icon (Top Right) -->
                  <button class="product-wishlist-btn prod-wishlist" data-product-id="{{ $product->id }}" title="Add to Wishlist">
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
                  <!-- Category -->
                  <div class="product-card-category">{{ $product->category->name_en ?? 'Sweets' }}</div>

                  <!-- Product Name (2 lines max) -->
                  <h5 class="product-card-name">{{ $product->name_en }}</h5>

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
                      @if($product->sale_price && $product->sale_price < $product->price)
                        <span class="original-price">৳{{ number_format($product->sale_price) }}</span>
                        @php
                          $discount = round(($product->price - $product->sale_price) / $product->price * 100);
                        @endphp
                        @if($discount > 0)
                          <span class="discount-badge">-{{ $discount }}%</span>
                        @endif
                      @endif
                    </div>
                    @if($product->coupon_code)
                      <span class="coupon-badge"><i class="fas fa-tag"></i> {{ $product->coupon_code }}</span>
                    @endif
                  </div>
                </div>
              </a>
            </div>
          @endforeach

          <!-- View All Products Card - Last card in slider -->
          <div class="slider-product-card view-all-trigger-card">
            @if($cmsSections && isset($cmsSections['new-arrivals']) && $cmsSections['new-arrivals']->button_url)
              <a href="{{ $cmsSections['new-arrivals']->button_url }}" class="text-decoration-none" style="width:100%;height:100%;display:flex;">
            @else
              <a href="{{ route('shop') }}" class="text-decoration-none" style="width:100%;height:100%;display:flex;">
            @endif
              <div class="view-all-card-content">
                <div class="view-all-icon"><i class="fas fa-arrow-right"></i></div>
                <h4>View All Products</h4>
                <p>Explore our complete collection</p>
              </div>
            </a>
          </div>
        @else
          <div class="col-12 text-center py-5">
            <p style="color:var(--text-60);">No new arrivals available at the moment.</p>
          </div>
        @endif
      </div>

      <!-- Navigation Buttons -->
      <button class="slider-nav-btn slider-next" id="newArrivalsNext" aria-label="Next">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    <!-- Bottom View All Button -->
    <div class="text-center mt-5">
      @if($cmsSections && isset($cmsSections['new-arrivals']) && $cmsSections['new-arrivals']->button_url)
        <a href="{{ $cmsSections['new-arrivals']->button_url }}" class="btn btn-glow">
          <i class="fas fa-arrow-right me-2"></i>{{ $cmsSections['new-arrivals']->button_text_en ?? 'View All New Arrivals' }}
        </a>
      @else
        <a href="{{ route('shop') }}" class="btn btn-glow">
          <i class="fas fa-arrow-right me-2"></i>View All Products
        </a>
      @endif
    </div>
  </div>
</section>

<!-- SPECIALTY: BENGALI SWEETS -->
<section class="specialty-section" id="specialty">
  <div class="specialty-bg"></div>
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6 order-lg-2">
        <div class="specialty-card animate-on-scroll">
          <div style="font-size:8rem;text-align:center;margin-bottom:1rem;">
            @if($cmsSections && isset($cmsSections['specialty']) && $cmsSections['specialty']->icon)
              {{ $cmsSections['specialty']->icon }}
            @else
              🍮
            @endif
          </div>
          @if($cmsSections && isset($cmsSections['specialty']))
          <h3 class="text-center" style="font-family:'Playfair Display',serif;color:var(--theme-text-secondary);">Authentic Bengali Sweets</h3>
          @else
          <h3 class="text-center" style="font-family:'Playfair Display',serif;color:var(--theme-text-secondary);">Authentic Bengali Sweets</h3>
          @endif
        </div>
      </div>
      <div class="col-lg-6 order-lg-1">
        @if($cmsSections && isset($cmsSections['specialty']))
          <span class="section-badge animate-on-scroll">{{ $cmsSections['specialty']->title_en ?? 'Our Specialty' }}</span>
          <h2 class="section-title mt-3 animate-on-scroll">
            {!! $cmsSections['specialty']->subtitle_en ?? 'Authentic Bengali<br/><span class="gradient-text">Sweets Collection</span>' !!}
          </h2>
          <p class="mt-4 animate-on-scroll" style="color:var(--text-75);line-height:1.9;">
            {!! $cmsSections['specialty']->content_en ?? 'Indulge in the rich heritage of Bengal.' !!}
          </p>
        @else
          <span class="section-badge animate-on-scroll">Our Specialty</span>
          <h2 class="section-title mt-3 animate-on-scroll">
            Authentic Bengali<br/>
            <span class="gradient-text">Sweets Collection</span>
          </h2>
          <p class="mt-4 animate-on-scroll" style="color:var(--text-75);line-height:1.9;">
            Indulge in the rich heritage of Bengal with our exquisite collection of traditional sweets, crafted with love and the finest ingredients.
          </p>
          <p class="animate-on-scroll" style="color:var(--text-70);line-height:1.9;">
            From the melt-in-your-mouth roshogolla to the delicate sandesh, our sweets are made using recipes passed down through generations. Each sweet is a celebration of authentic Bengali tradition, bringing you the true taste of home.
          </p>
        @endif
        <div class="specialty-features animate-on-scroll">
          <div class="sf-item">
            <div class="sf-icon">🥛</div>
            <div><div class="sf-title">Pure Milk</div><div class="sf-desc">Farm fresh daily</div></div>
          </div>
          <div class="sf-item">
            <div class="sf-icon">🌸</div>
            <div><div class="sf-title">Real Saffron</div><div class="sf-desc">Kashmiri premium</div></div>
          </div>
          <div class="sf-item">
            <div class="sf-icon">♨️</div>
            <div><div class="sf-title">Fresh Daily</div><div class="sf-desc">Made every morning</div></div>
          </div>
          <div class="sf-item">
            <div class="sf-icon">📜</div>
            <div><div class="sf-title">Traditional</div><div class="sf-desc">Ancient recipes</div></div>
          </div>
        </div>
        @if($cmsSections && isset($cmsSections['specialty']) && $cmsSections['specialty']->button_url)
        <a href="{{ $cmsSections['specialty']->button_url }}" class="btn btn-glow mt-4 animate-on-scroll">
          {{ $cmsSections['specialty']->button_text_en ?? 'Discover' }} <i class="fas fa-arrow-right ms-2"></i>
        </a>
        @else
        <a href="{{ route('shop.category', 'traditional-sweets') }}" class="btn btn-glow mt-4 animate-on-scroll">
          Discover Sweets <i class="fas fa-arrow-right ms-2"></i>
        </a>
        @endif
      </div>
    </div>
  </div>
</section>

@php
// Get theme colors for dynamic gradients
$themePrimary = $theme->primary_color ?? '#f59e0b';
$themeSecondary = $theme->secondary_color ?? '#f43f5e';
$themeAccent = $theme->accent_color ?? '#8b5cf6';

// Convert hex to RGB for rgba usage
function hexToRgb($hex) {
    $hex = str_replace('#', '', $hex);
    return [
        'r' => hexdec(substr($hex, 0, 2)),
        'g' => hexdec(substr($hex, 2, 2)),
        'b' => hexdec(substr($hex, 4, 2))
    ];
}

$primaryRgb = hexToRgb($themePrimary);
$secondaryRgb = hexToRgb($themeSecondary);

// Category section configurations with icons, colors, and descriptions - NOW DYNAMIC
$categoryConfigs = [
    'cakes' => [
        'icon' => '🎂',
        'badge_icon' => 'fas fa-birthday-cake',
        'gradient' => "linear-gradient(135deg,rgba({$secondaryRgb['r']},{$secondaryRgb['g']},{$secondaryRgb['b']},0.08),rgba({$primaryRgb['r']},{$primaryRgb['g']},{$primaryRgb['b']},0.05))",
        'badge_gradient' => "linear-gradient(135deg,{$themeSecondary},{$themePrimary})",
        'badge_text' => '🎂 CAKES',
        'description' => 'Delicious handcrafted cakes for every celebration, made with premium ingredients and love'
    ],
    'traditional-sweets' => [
        'icon' => '🍬',
        'badge_icon' => 'fas fa-cookie',
        'gradient' => "linear-gradient(135deg,rgba({$primaryRgb['r']},{$primaryRgb['g']},{$primaryRgb['b']},0.05),rgba({$primaryRgb['r']},{$primaryRgb['g']},{$primaryRgb['b']},0.03))",
        'badge_gradient' => "linear-gradient(135deg,{$themePrimary},{$themeSecondary})",
        'badge_text' => '🍬 TRADITIONAL',
        'description' => 'Experience the rich heritage of Bengal with our authentic traditional sweets'
    ],
    'cookies-biscuits' => [
        'icon' => '🍪',
        'badge_icon' => 'fas fa-cookie-bite',
        'gradient' => "linear-gradient(135deg,rgba({$primaryRgb['r']},{$primaryRgb['g']},{$primaryRgb['b']},0.05),rgba({$secondaryRgb['r']},{$secondaryRgb['g']},{$secondaryRgb['b']},0.03))",
        'badge_gradient' => "linear-gradient(135deg,{$themePrimary},{$themeSecondary})",
        'badge_text' => '🍪 COOKIES',
        'description' => 'Freshly baked crispy cookies and biscuits, perfect for your tea time'
    ],
    'pastries-savories' => [
        'icon' => '🥧',
        'badge_icon' => 'fas fa-pie-chart',
        'gradient' => "linear-gradient(135deg,rgba({$secondaryRgb['r']},{$secondaryRgb['g']},{$secondaryRgb['b']},0.05),rgba({$primaryRgb['r']},{$primaryRgb['g']},{$primaryRgb['b']},0.03))",
        'badge_gradient' => "linear-gradient(135deg,{$themeSecondary},{$themePrimary})",
        'badge_text' => '🥧 PASTRIES',
        'description' => 'Flaky pastries and savory delights, baked fresh every day'
    ],
    'breads' => [
        'icon' => '🍞',
        'badge_icon' => 'fas fa-bread-slice',
        'gradient' => "linear-gradient(135deg,rgba({$primaryRgb['r']},{$primaryRgb['g']},{$primaryRgb['b']},0.05),rgba({$secondaryRgb['r']},{$secondaryRgb['g']},{$secondaryRgb['b']},0.03))",
        'badge_gradient' => "linear-gradient(135deg,{$themePrimary},{$themeSecondary})",
        'badge_text' => '🍞 BREADS',
        'description' => 'Freshly baked breads for your daily needs, soft and delicious'
    ],
    'buns-rolls' => [
        'icon' => '🥯',
        'badge_icon' => 'fas fa-hamburger',
        'gradient' => "linear-gradient(135deg,rgba({$secondaryRgb['r']},{$secondaryRgb['g']},{$secondaryRgb['b']},0.05),rgba({$primaryRgb['r']},{$primaryRgb['g']},{$primaryRgb['b']},0.03))",
        'badge_gradient' => "linear-gradient(135deg,{$themeSecondary},{$themePrimary})",
        'badge_text' => '🥯 BUNS & ROLLS',
        'description' => 'Soft buns and rolls, perfect for burgers, sandwiches, and more'
    ],
    'dairy-products' => [
        'icon' => '🥛',
        'badge_icon' => 'fas fa-glass-whiskey',
        'gradient' => "linear-gradient(135deg,rgba({$primaryRgb['r']},{$primaryRgb['g']},{$primaryRgb['b']},0.05),rgba({$secondaryRgb['r']},{$secondaryRgb['g']},{$secondaryRgb['b']},0.03))",
        'badge_gradient' => "linear-gradient(135deg,{$themePrimary},{$themeSecondary})",
        'badge_text' => '🥛 DAIRY',
        'description' => 'Fresh dairy products, pure and wholesome for your daily nutrition'
    ],
];
@endphp

@foreach($categoryProducts ?? [] as $slug => $data)
    @php
        $config = $categoryConfigs[$slug] ?? [
            'icon' => '🍰',
            'badge_icon' => 'fas fa-star',
            'gradient' => "linear-gradient(135deg,rgba({$primaryRgb['r']},{$primaryRgb['g']},{$primaryRgb['b']},0.05),rgba({$secondaryRgb['r']},{$secondaryRgb['g']},{$secondaryRgb['b']},0.03))",
            'badge_gradient' => "linear-gradient(135deg,{$themePrimary},{$themeSecondary})",
            'badge_text' => '⭐ FEATURED',
            'description' => 'Discover our delicious products'
        ];
        $category = $data['category'];
        $products = $data['products'];
        $sectionId = str_replace(['-', '&', ' '], ['', '-', '-'], $slug);
    @endphp

    @if($products->count() > 0)
    <section class="section-gap" id="category-{{ $sectionId }}" style="background:{{ $config['gradient'] }};">
        <div class="container">
            <!-- Section Header - Left title, Right View All -->
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-5">
                <div class="flex-grow-1">
                    <span class="section-badge animate-on-scroll" style="background:{{ $config['badge_gradient'] }}40;border-color:{{ $config['badge_gradient'] }};">
                        <i class="{{ $config['badge_icon'] }} me-2"></i>{{ $category->name_en }}
                    </span>
                    <h2 class="section-title mt-3 animate-on-scroll">
                        {{ $category->name_en }} <span class="gradient-text">Collection</span>
                    </h2>
                    <p class="mt-2 animate-on-scroll" style="color:var(--text-60);max-width:500px;">
                        {{ $config['description'] }}
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ route('shop.category', $category->slug) }}" class="btn btn-glow btn-sm" style="background:{{ $config['badge_gradient'] }};">
                        <i class="fas fa-th-large me-2"></i>View All
                    </a>
                </div>
            </div>

            <!-- Products Slider Container -->
            <div class="new-arrivals-slider-wrapper animate-on-scroll">
                <button class="slider-nav-btn slider-prev" id="catSliderPrev-{{ $sectionId }}" aria-label="Previous">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="new-arrivals-slider" id="catSlider-{{ $sectionId }}">
                    @foreach($products as $product)
                    <div class="slider-product-card">
                        <a href="{{ route('shop.product', $product->slug) }}" class="text-decoration-none">
                            <!-- Product Image -->
                            <div class="product-card-img">
                                @if($product->image)
                                    <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name_en }}" loading="lazy">
                                @else
                                    <div class="prod-img-placeholder">
                                        <i class="fas fa-cookie-bite"></i>
                                    </div>
                                @endif

                                <!-- Category Badge (Top Left) -->
                                <span class="product-category-badge">{{ $product->category->name_en ?? 'Sweets' }}</span>

                                <!-- Wishlist Icon (Top Right) -->
                                <button class="product-wishlist-btn prod-wishlist" data-product-id="{{ $product->id }}" title="Add to Wishlist">
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
                                <h5 class="product-card-name">{{ $product->name_en }}</h5>

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
                                        @if($product->sale_price && $product->sale_price < $product->price)
                                            <span class="original-price">৳{{ number_format($product->sale_price) }}</span>
                                            @php
                                                $catDiscount = round(($product->price - $product->sale_price) / $product->price * 100);
                                            @endphp
                                            @if($catDiscount > 0)
                                                <span class="discount-badge">-{{ $catDiscount }}%</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach

                    <!-- View All Products Card - Last card in slider -->
                    <div class="slider-product-card view-all-trigger-card">
                        <a href="{{ route('shop.category', $category->slug) }}" class="text-decoration-none" style="width:100%;height:100%;display:flex;">
                            <div class="view-all-card-content">
                                <div class="view-all-icon"><i class="fas fa-arrow-right"></i></div>
                                <h4>View All {{ $category->name_en }}</h4>
                                <p>Explore the full collection</p>
                            </div>
                        </a>
                    </div>
                </div>

                <button class="slider-nav-btn slider-next" id="catSliderNext-{{ $sectionId }}" aria-label="Next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Bottom View All Button -->
            <div class="text-center mt-5">
                <a href="{{ route('shop.category', $category->slug) }}" class="btn btn-glow" style="background:{{ $config['badge_gradient'] }};">
                    <i class="fas fa-arrow-right me-2"></i>View All {{ $category->name_en }}
                </a>
            </div>
        </div>
    </section>
    @endif
@endforeach

<!-- CHOCOLATE PARADISE -->
<section class="specialty-section" style="background:linear-gradient(135deg, rgba(244,63,94,0.05), rgba(139,92,246,0.05));">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <div class="specialty-card animate-on-scroll" style="background:linear-gradient(135deg, rgba(244,63,94,0.1), rgba(168,85,247,0.1));">
          <div style="font-size:8rem;text-align:center;margin-bottom:1rem;">
            @if($cmsSections && isset($cmsSections['chocolate-paradise']) && $cmsSections['chocolate-paradise']->icon)
              {{ $cmsSections['chocolate-paradise']->icon }}
            @else
              🍫
            @endif
          </div>
          @if($cmsSections && isset($cmsSections['chocolate-paradise']))
          <h3 class="text-center" style="font-family:'Playfair Display',serif;color:var(--theme-text-secondary);">Premium Chocolates</h3>
          @else
          <h3 class="text-center" style="font-family:'Playfair Display',serif;color:var(--theme-text-secondary);">Premium Chocolates</h3>
          @endif
        </div>
      </div>
      <div class="col-lg-6">
        @if($cmsSections && isset($cmsSections['chocolate-paradise']))
          <span class="section-badge animate-on-scroll" style="background:linear-gradient(135deg, rgba(244,63,94,0.2), rgba(168,85,247,0.2));border-color:rgba(244,63,94,0.3);">{{ $cmsSections['chocolate-paradise']->title_en ?? 'Chocolate Paradise' }}</span>
          <h2 class="section-title mt-3 animate-on-scroll">
            {!! $cmsSections['chocolate-paradise']->subtitle_en ?? 'Premium Chocolate &<br/><span class="gradient-text">Cocoa Delights</span>' !!}
          </h2>
          <p class="mt-4 animate-on-scroll" style="color:var(--text-75);line-height:1.9;">
            {!! $cmsSections['chocolate-paradise']->content_en ?? 'Experience the ultimate indulgence.' !!}
          </p>
        @else
          <span class="section-badge animate-on-scroll" style="background:linear-gradient(135deg, rgba(244,63,94,0.2), rgba(168,85,247,0.2));border-color:rgba(244,63,94,0.3);">Chocolate Paradise</span>
          <h2 class="section-title mt-3 animate-on-scroll">
            Premium Chocolate &<br/>
            <span class="gradient-text">Cocoa Delights</span>
          </h2>
          <p class="mt-4 animate-on-scroll" style="color:var(--text-75);line-height:1.9;">
            Experience the ultimate indulgence with our exquisite collection of handcrafted chocolates, made from the finest cocoa beans sourced from around the world.
          </p>
          <p class="animate-on-scroll" style="color:var(--text-70);line-height:1.9;">
            From silky smooth dark chocolate to creamy milk chocolate truffles, our master chocolatiers create artisanal pieces that will delight your senses. Each chocolate is carefully crafted to deliver an unforgettable taste experience.
          </p>
        @endif
        <div class="specialty-features animate-on-scroll">
          <div class="sf-item">
            <div class="sf-icon">🍫</div>
            <div><div class="sf-title">Premium Cocoa</div><div class="sf-desc">Finest quality beans</div></div>
          </div>
          <div class="sf-item">
            <div class="sf-icon">👨‍🍳</div>
            <div><div class="sf-title">Expert Makers</div><div class="sf-desc">Master chocolatiers</div></div>
          </div>
          <div class="sf-item">
            <div class="sf-icon">🎁</div>
            <div><div class="sf-title">Gift Ready</div><div class="sf-desc">Beautiful packaging</div></div>
          </div>
          <div class="sf-item">
            <div class="sf-icon">💝</div>
            <div><div class="sf-title">Artisan Crafted</div><div class="sf-desc">Made with love</div></div>
          </div>
        </div>
        @if($cmsSections && isset($cmsSections['chocolate-paradise']) && $cmsSections['chocolate-paradise']->button_url)
        <a href="{{ $cmsSections['chocolate-paradise']->button_url }}" class="btn btn-glow mt-4 animate-on-scroll" style="background:linear-gradient(135deg, var(--theme-secondary), var(--theme-accent));">
          {{ $cmsSections['chocolate-paradise']->button_text_en ?? 'Discover Chocolates' }} <i class="fas fa-arrow-right ms-2"></i>
        </a>
        @else
        <a href="{{ route('shop') }}" class="btn btn-glow mt-4 animate-on-scroll" style="background:linear-gradient(135deg, var(--theme-secondary), var(--theme-accent));">
          Discover Chocolates <i class="fas fa-arrow-right ms-2"></i>
        </a>
        @endif
      </div>
    </div>
  </div>
</section>

<!-- BEST SELLERS / BEST OFFERS -->
<section class="section-gap" style="background:linear-gradient(180deg, rgba(244,63,94,0.03), transparent);">
  <div class="container">
    <!-- Section Header - Left title, Right View All -->
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-5">
      <div class="flex-grow-1">
        @if($cmsSections && isset($cmsSections['best-offers']))
          <span class="section-badge animate-on-scroll" style="background:linear-gradient(135deg,rgba(244,63,94,0.2),rgba(245,158,11,0.2));border-color:rgba(244,63,94,0.3);"><i class="fas fa-fire me-2"></i>{{ $cmsSections['best-offers']->title_en ?? 'Top Rated' }}</span>
          <h2 class="section-title mt-3 animate-on-scroll">
            {!! $cmsSections['best-offers']->subtitle_en ?? 'Best <span class="gradient-text">Offers</span>' !!}
          </h2>
          @if($cmsSections['best-offers']->content_en)
          <p class="mt-2 animate-on-scroll" style="color:var(--text-60);max-width:500px;">
            {!! $cmsSections['best-offers']->content_en !!}
          </p>
          @endif
        @else
          <span class="section-badge animate-on-scroll" style="background:linear-gradient(135deg,rgba(244,63,94,0.2),rgba(245,158,11,0.2));border-color:rgba(244,63,94,0.3);"><i class="fas fa-fire me-2"></i>Top Rated</span>
          <h2 class="section-title mt-3 animate-on-scroll">Best <span id="sellers-text" style="background:var(--theme-btn-gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"></span></h2>
          <p class="mt-2 animate-on-scroll" style="color:var(--text-60);max-width:500px;">Our most loved products that customers keep coming back for</p>
        @endif
      </div>
      <div class="flex-shrink-0">
        <a href="{{ route('shop') }}" class="btn btn-glow btn-sm">
          <i class="fas fa-th-large me-2"></i>View All
        </a>
      </div>
    </div>

    <!-- Products Slider Container -->
    <div class="new-arrivals-slider-wrapper animate-on-scroll">
      <button class="slider-nav-btn slider-prev" id="bestSellersPrev" aria-label="Previous">
        <i class="fas fa-chevron-left"></i>
      </button>

      <div class="new-arrivals-slider" id="bestSellersSlider">
        @if(isset($bestSellers) && $bestSellers->count() > 0)
          @foreach($bestSellers as $index => $product)
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

                <!-- Rank Badge (Top Left) -->
                <span class="product-category-badge" style="background:linear-gradient(135deg,{{ $index === 0 ? "{$themeSecondary},{$themePrimary}" : ($index === 1 ? "{$themePrimary},{$themeSecondary}" : "{$themeAccent},#7c3aed") }});color:#fff;">#{{ $index + 1 }} {{ $index === 0 ? 'BESTSELLER' : ($index === 1 ? 'TOP RATED' : 'POPULAR') }}</span>

                <!-- Wishlist Icon (Top Right) -->
                <button class="product-wishlist-btn prod-wishlist" data-product-id="{{ $product->id }}" title="Add to Wishlist">
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
                  <span class="rating-count">({{ $product->approved_reviews_count ?? 0 }})</span>
                </div>

                <!-- Price Row -->
                <div class="product-card-price">
                  <div class="price-info">
                    <span class="current-price">৳{{ number_format($product->price) }}</span>
                    @if($product->sale_price && $product->sale_price < $product->price)
                      <span class="original-price">৳{{ number_format($product->sale_price) }}</span>
                      @php
                        $bestDiscount = round(($product->price - $product->sale_price) / $product->price * 100);
                      @endphp
                      @if($bestDiscount > 0)
                        <span class="discount-badge">-{{ $bestDiscount }}%</span>
                      @endif
                    @endif
                  </div>
                </div>

                <!-- Sold / Reviews stats -->
                <div class="product-card-stats">
                  <span class="stat-pill"><i class="fas fa-shopping-bag"></i> {{ $product->order_items_count ?? 0 }} sold</span>
                  <span class="stat-pill"><i class="fas fa-heart"></i> {{ $product->approved_reviews_count ?? 0 }} reviews</span>
                </div>
              </div>
            </a>
          </div>
          @endforeach

          <!-- View All Products Card -->
          <div class="slider-product-card view-all-trigger-card">
            <a href="{{ route('shop') }}" class="text-decoration-none" style="width:100%;height:100%;display:flex;">
              <div class="view-all-card-content">
                <div class="view-all-icon"><i class="fas fa-arrow-right"></i></div>
                <h4>View All Products</h4>
                <p>Explore our best sellers</p>
              </div>
            </a>
          </div>
        @else
          <div class="text-center py-5" style="width:100%;">
            <p style="color:var(--text-60);">No best-selling products available at the moment.</p>
          </div>
        @endif
      </div>

      <button class="slider-nav-btn slider-next" id="bestSellersNext" aria-label="Next">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    @if(isset($bestSellers) && $bestSellers->count() > 0)
    <!-- Customer Choice Award Banner -->
    <div class="bestseller-banner mt-5 animate-on-scroll">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="d-flex align-items-center gap-4">
            <div style="font-size:5rem;">🏆</div>
            <div>
              <h4 style="color:var(--theme-text-primary);margin-bottom:0.5rem;font-family:'Playfair Display',serif;">Customer's Choice Award 2026</h4>
              <p style="color:var(--text-70);margin:0;">Our {{ $bestSellers->first()->name }} has been voted the best by our customers!</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
          <div class="d-flex gap-4 justify-content-lg-end justify-content-center">
            <div class="text-center">
              <div style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;color:var(--theme-text-secondary);">{{ $bestSellers->sum('order_items_count') }}+</div>
              <div style="font-size:0.85rem;color:var(--text-60);">Total Orders</div>
            </div>
            <div class="text-center">
              <div style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;color:var(--theme-text-secondary);">{{ $bestSellers->first()->order_items_count ?? 0 }}</div>
              <div style="font-size:0.85rem;color:var(--text-60);">Best Seller</div>
            </div>
            <div class="text-center">
              <div style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;color:var(--theme-text-secondary);">#1</div>
              <div style="font-size:0.85rem;color:var(--text-60);">Top Rated</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="section-gap" style="background:linear-gradient(135deg,rgba(245,158,11,0.08),rgba(244,63,94,0.05));">
  <div class="container">
    <!-- Section Header - Left title, Right empty for balance -->
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-5">
      <div class="flex-grow-1">
        <span class="section-badge animate-on-scroll"><i class="fas fa-quote-left me-2"></i>Testimonials</span>
        <h2 class="section-title mt-3 animate-on-scroll">
          What Our <span class="gradient-text">Customers Say</span>
        </h2>
        <p class="mt-2 animate-on-scroll" style="color:var(--text-60);max-width:500px;">Real reviews from our happy customers who love our sweets and bakery products</p>
      </div>
    </div>

    <!-- Testimonials Slider Container -->
    <div class="new-arrivals-slider-wrapper animate-on-scroll">
      <button class="slider-nav-btn slider-prev" id="testimonialPrev" aria-label="Previous">
        <i class="fas fa-chevron-left"></i>
      </button>

      <div class="new-arrivals-slider" id="testimonialSlider">
        @if(isset($reviews) && $reviews->count() > 0)
          @foreach($reviews as $review)
          <div class="slider-product-card testimonial-card-clickable"
               data-name="@if($review->user){{ $review->user->name }}@else Anonymous @endif"
               data-initial="@if($review->user && $review->user->name){{ substr($review->user->name, 0, 1) }}@else👤@endif"
               data-rating="{{ $review->rating }}"
               data-comment="{{ htmlspecialchars($review->comment) }}"
               data-product="@if($review->product){{ $review->product->name }}@endif"
               data-date="{{ $review->created_at ? $review->created_at->format('M d, Y') : '' }}">
            <a href="javascript:void(0)" class="text-decoration-none" onclick="return false;">
              <!-- Testimonial Top - Avatar & Stars -->
              <div class="product-card-img" style="aspect-ratio:auto;padding:1.5rem 1.5rem 0.5rem;background:linear-gradient(135deg,rgba(var(--theme-primary-rgb,245,158,11),0.08),rgba(var(--theme-secondary-rgb,244,63,94),0.05));">
                <div style="display:flex;align-items:center;gap:0.75rem;">
                  <div style="width:48px;height:48px;border-radius:50%;background:var(--theme-btn-gradient);display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;font-weight:700;flex-shrink:0;">
                    @if($review->user && $review->user->name)
                      {{ substr($review->user->name, 0, 1) }}
                    @else
                      👤
                    @endif
                  </div>
                  <div style="min-width:0;">
                    <div style="font-weight:600;color:var(--theme-text-primary);font-size:0.9rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                      @if($review->user)
                        {{ $review->user->name }}
                      @else
                        Anonymous
                      @endif
                    </div>
                    <div style="display:flex;align-items:center;gap:0.5rem;">
                      <div style="color:var(--theme-text-secondary);font-size:0.75rem;">
                        @for($i = 1; $i <= 5; $i++)
                          @if($i <= $review->rating)
                            <i class="fas fa-star"></i>
                          @else
                            <i class="far fa-star"></i>
                          @endif
                        @endfor
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Testimonial Body -->
              <div class="product-card-info">
                <p style="font-size:0.85rem;color:var(--text-70);line-height:1.7;margin:0 0 0.75rem;display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;overflow:hidden;font-style:italic;">
                  "{{ $review->comment }}"
                </p>

                <div class="product-card-stats">
                  <span class="stat-pill"><i class="fas fa-check-circle"></i> Verified Buyer</span>
                  @if($review->product)
                    <span class="stat-pill"><i class="fas fa-box"></i> {{ Str::limit($review->product->name, 20) }}</span>
                  @endif
                  <span class="stat-pill" style="margin-left:auto;"><i class="fas fa-expand-alt"></i> Read more</span>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        @else
          <!-- Demo reviews when no reviews in database -->
          <div class="slider-product-card testimonial-card-clickable"
               data-name="Fatima Rahman"
               data-initial="F"
               data-rating="5"
               data-comment="The best roshogolla I've ever had! Absolutely authentic taste and the delivery was super fast. Highly recommended!"
               data-product=""
               data-date="">
            <a href="javascript:void(0)" class="text-decoration-none" onclick="return false;">
              <div class="product-card-img" style="aspect-ratio:auto;padding:1.5rem 1.5rem 0.5rem;background:linear-gradient(135deg,rgba(var(--theme-primary-rgb,245,158,11),0.08),rgba(var(--theme-secondary-rgb,244,63,94),0.05));">
                <div style="display:flex;align-items:center;gap:0.75rem;">
                  <div style="width:48px;height:48px;border-radius:50%;background:var(--theme-btn-gradient);display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;font-weight:700;flex-shrink:0;">F</div>
                  <div>
                    <div style="font-weight:600;color:var(--theme-text-primary);font-size:0.9rem;">Fatima Rahman</div>
                    <div style="color:var(--theme-text-secondary);font-size:0.75rem;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                  </div>
                </div>
              </div>
              <div class="product-card-info">
                <p style="font-size:0.85rem;color:var(--text-70);line-height:1.7;margin:0 0 0.75rem;font-style:italic;">"The best roshogolla I've ever had! Absolutely authentic taste and the delivery was super fast. Highly recommended!"</p>
                <div class="product-card-stats">
                  <span class="stat-pill"><i class="fas fa-check-circle"></i> Verified Buyer</span>
                  <span class="stat-pill"><i class="fas fa-map-marker-alt"></i> Dhaka</span>
                  <span class="stat-pill" style="margin-left:auto;"><i class="fas fa-expand-alt"></i> Read more</span>
                </div>
              </div>
            </a>
          </div>
          <div class="slider-product-card testimonial-card-clickable"
               data-name="Rahul Ahmed"
               data-initial="R"
               data-rating="5"
               data-comment="Ordered a custom cake for my daughter's birthday. It was perfect! Beautiful design and delicious taste. Thank you Saffron!"
               data-product=""
               data-date="">
            <a href="javascript:void(0)" class="text-decoration-none" onclick="return false;">
              <div class="product-card-img" style="aspect-ratio:auto;padding:1.5rem 1.5rem 0.5rem;background:linear-gradient(135deg,rgba(var(--theme-primary-rgb,245,158,11),0.08),rgba(var(--theme-secondary-rgb,244,63,94),0.05));">
                <div style="display:flex;align-items:center;gap:0.75rem;">
                  <div style="width:48px;height:48px;border-radius:50%;background:var(--theme-btn-gradient);display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;font-weight:700;flex-shrink:0;">R</div>
                  <div>
                    <div style="font-weight:600;color:var(--theme-text-primary);font-size:0.9rem;">Rahul Ahmed</div>
                    <div style="color:var(--theme-text-secondary);font-size:0.75rem;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                  </div>
                </div>
              </div>
              <div class="product-card-info">
                <p style="font-size:0.85rem;color:var(--text-70);line-height:1.7;margin:0 0 0.75rem;font-style:italic;">"Ordered a custom cake for my daughter's birthday. It was perfect! Beautiful design and delicious taste. Thank you Saffron!"</p>
                <div class="product-card-stats">
                  <span class="stat-pill"><i class="fas fa-check-circle"></i> Verified Buyer</span>
                  <span class="stat-pill"><i class="fas fa-map-marker-alt"></i> Chittagong</span>
                  <span class="stat-pill" style="margin-left:auto;"><i class="fas fa-expand-alt"></i> Read more</span>
                </div>
              </div>
            </a>
          </div>
          <div class="slider-product-card testimonial-card-clickable"
               data-name="Nusrat Jahan"
               data-initial="N"
               data-rating="5"
               data-comment="Their chocolate collection is amazing! Perfect for gifting. The packaging is beautiful and the quality is top-notch."
               data-product=""
               data-date="">
            <a href="javascript:void(0)" class="text-decoration-none" onclick="return false;">
              <div class="product-card-img" style="aspect-ratio:auto;padding:1.5rem 1.5rem 0.5rem;background:linear-gradient(135deg,rgba(var(--theme-primary-rgb,245,158,11),0.08),rgba(var(--theme-secondary-rgb,244,63,94),0.05));">
                <div style="display:flex;align-items:center;gap:0.75rem;">
                  <div style="width:48px;height:48px;border-radius:50%;background:var(--theme-btn-gradient);display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;font-weight:700;flex-shrink:0;">N</div>
                  <div>
                    <div style="font-weight:600;color:var(--theme-text-primary);font-size:0.9rem;">Nusrat Jahan</div>
                    <div style="color:var(--theme-text-secondary);font-size:0.75rem;"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                  </div>
                </div>
              </div>
              <div class="product-card-info">
                <p style="font-size:0.85rem;color:var(--text-70);line-height:1.7;margin:0 0 0.75rem;font-style:italic;">"Their chocolate collection is amazing! Perfect for gifting. The packaging is beautiful and the quality is top-notch."</p>
                <div class="product-card-stats">
                  <span class="stat-pill"><i class="fas fa-check-circle"></i> Verified Buyer</span>
                  <span class="stat-pill"><i class="fas fa-map-marker-alt"></i> Sylhet</span>
                  <span class="stat-pill" style="margin-left:auto;"><i class="fas fa-expand-alt"></i> Read more</span>
                </div>
              </div>
            </a>
          </div>
        @endif
      </div>

      <button class="slider-nav-btn slider-next" id="testimonialNext" aria-label="Next">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
  </div>

  <!-- Review Modal -->
  <div class="review-modal-overlay" id="reviewModalOverlay">
    <div class="review-modal" id="reviewModal">
      <button class="review-modal-close" id="reviewModalClose" aria-label="Close">
        <i class="fas fa-times"></i>
      </button>

      <div class="review-modal-header">
        <div class="review-modal-avatar" id="modalAvatar">👤</div>
        <div class="review-modal-user">
          <div class="review-modal-name" id="modalName">Customer</div>
          <div class="review-modal-stars" id="modalStars"></div>
          <div class="review-modal-meta">
            <span class="stat-pill"><i class="fas fa-check-circle"></i> Verified Buyer</span>
            <span class="stat-pill" id="modalProduct"></span>
            <span class="stat-pill" id="modalDate"></span>
          </div>
        </div>
      </div>

      <div class="review-modal-body">
        <i class="fas fa-quote-left review-modal-quote-icon"></i>
        <p id="modalComment">Review text here</p>
      </div>
    </div>
  </div>
</section>

<!-- BLOG SECTION -->
@if(isset($blogPosts) && $blogPosts->count() > 0)
<section class="section-gap">
  <div class="container">
    <!-- Section Header - Left title, Right View All -->
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-5">
      <div class="flex-grow-1">
        @if($cmsSections && isset($cmsSections['blog']))
          <span class="section-badge animate-on-scroll">{{ $cmsSections['blog']->title_en ?? 'Latest News' }}</span>
          <h2 class="section-title mt-3 animate-on-scroll">
            {!! $cmsSections['blog']->subtitle_en ?? 'From Our <span class="gradient-text">Blog</span>' !!}
          </h2>
          @if($cmsSections['blog']->content_en)
          <p class="mt-2 animate-on-scroll" style="color:var(--text-60);max-width:500px;">
            {!! $cmsSections['blog']->content_en !!}
          </p>
          @endif
        @else
          <span class="section-badge animate-on-scroll">Latest News</span>
          <h2 class="section-title mt-3 animate-on-scroll">From Our <span class="gradient-text">Blog</span></h2>
          <p class="mt-2 animate-on-scroll" style="color:var(--text-60);max-width:500px;">Discover recipes, stories, and sweet updates from our kitchen</p>
        @endif
      </div>
      <div class="flex-shrink-0">
        @if($cmsSections && isset($cmsSections['blog']) && $cmsSections['blog']->button_url)
          <a href="{{ $cmsSections['blog']->button_url }}" class="btn btn-glow btn-sm">
            <i class="fas fa-th-large me-2"></i>View All
          </a>
        @else
          <a href="{{ route('blog.index') }}" class="btn btn-glow btn-sm">
            <i class="fas fa-th-large me-2"></i>View All
          </a>
        @endif
      </div>
    </div>

    <!-- Blog Slider Container -->
    <div class="new-arrivals-slider-wrapper animate-on-scroll">
      <button class="slider-nav-btn slider-prev" id="blogPrev" aria-label="Previous">
        <i class="fas fa-chevron-left"></i>
      </button>

      <div class="new-arrivals-slider" id="blogSlider">
        @foreach($blogPosts as $post)
        <div class="slider-product-card">
          <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
            <!-- Blog Image -->
            <div class="product-card-img">
              @if($post->featured_image)
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" loading="lazy">
              @else
                <div class="prod-img-placeholder">
                  <i class="fas fa-newspaper"></i>
                </div>
              @endif

              <!-- Category Badge (Top Left) -->
              @if($post->category)
                <span class="product-category-badge">{{ $post->category }}</span>
              @endif

              <!-- Featured Badge (Top Right) -->
              @if($post->is_featured)
                <span class="product-category-badge" style="left:auto;right:10px;background:linear-gradient(135deg,var(--theme-secondary),var(--theme-primary));color:#fff;">⭐ Featured</span>
              @endif
            </div>

            <!-- Blog Info -->
            <div class="product-card-info">
              @if($post->category)
                <div class="product-card-category">{{ $post->category }}</div>
              @endif

              <h5 class="product-card-name">{{ Str::limit($post->title, 60) }}</h5>

              <p style="font-size:0.8rem;color:var(--text-60);margin:0 0 0.75rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;line-height:1.5;">
                {{ Str::limit(strip_tags($post->excerpt ?? $post->content), 100) }}
              </p>

              <!-- Meta -->
              <div class="product-card-stats" style="margin-top:auto;">
                <span class="stat-pill"><i class="far fa-calendar"></i> {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Unpublished' }}</span>
                <span class="stat-pill"><i class="far fa-eye"></i> {{ $post->views ?? 0 }}</span>
                @if($post->user)
                  <span class="stat-pill"><i class="far fa-user"></i> {{ $post->user->name }}</span>
                @endif
              </div>
            </div>
          </a>
        </div>
        @endforeach

        <!-- View All Blog Card -->
        <div class="slider-product-card view-all-trigger-card">
          @if($cmsSections && isset($cmsSections['blog']) && $cmsSections['blog']->button_url)
            <a href="{{ $cmsSections['blog']->button_url }}" class="text-decoration-none" style="width:100%;height:100%;display:flex;">
          @else
            <a href="{{ route('blog.index') }}" class="text-decoration-none" style="width:100%;height:100%;display:flex;">
          @endif
            <div class="view-all-card-content">
              <div class="view-all-icon"><i class="fas fa-arrow-right"></i></div>
              <h4>View All Posts</h4>
              <p>Read more stories from our kitchen</p>
            </div>
          </a>
        </div>
      </div>

      <button class="slider-nav-btn slider-next" id="blogNext" aria-label="Next">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    <div class="text-center mt-5">
      @if($cmsSections && isset($cmsSections['blog']) && $cmsSections['blog']->button_url)
      <a href="{{ $cmsSections['blog']->button_url }}" class="btn btn-glow">
        {{ $cmsSections['blog']->button_text_en ?? 'View All Posts' }} <i class="fas fa-arrow-right ms-2"></i>
      </a>
      @else
      <a href="{{ route('blog.index') }}" class="btn btn-glow">
        View All Posts <i class="fas fa-arrow-right ms-2"></i>
      </a>
      @endif
    </div>
  </div>
</section>
@endif

<!-- PROMO CARDS -->
<section class="section-gap">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="glass-card p-4 h-100 animate-on-scroll" style="background:linear-gradient(135deg, rgba(245,158,11,0.08), rgba(244,63,94,0.05));">
          <div class="d-flex align-items-center gap-4">
            <div style="font-size:4rem;">🎂</div>
            <div>
              <h4 style="color:var(--theme-text-primary);font-family:'Playfair Display',serif;margin-bottom:0.5rem;">Custom Cakes</h4>
              <p style="color:var(--text-70);margin-bottom:1rem;">Personalize your celebration with our master bakers</p>
              <a href="{{ route('shop') }}" class="btn btn-glow btn-sm">Order Custom Cake</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="glass-card p-4 h-100 animate-on-scroll" style="background:linear-gradient(135deg, rgba(244,63,94,0.08), rgba(139,92,246,0.05));">
          <div class="d-flex align-items-center gap-4">
            <div style="font-size:4rem;">🎁</div>
            <div>
              <h4 style="color:var(--theme-text-primary);font-family:'Playfair Display',serif;margin-bottom:0.5rem;">Gift Hampers</h4>
              <p style="color:var(--text-70);margin-bottom:1rem;">Curated sweet boxes with premium packaging</p>
              <a href="{{ route('shop') }}" class="btn btn-glow btn-sm" style="background:linear-gradient(135deg, var(--theme-secondary), var(--theme-accent));">Send a Gift</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- NEWSLETTER -->
<section class="section-gap">
  <div class="container">
    <div class="newsletter-card glass-card-glow text-center">
      <div style="font-size: 3rem; margin-bottom: 1rem;">📧</div>
      <h2 style="font-family:'Playfair Display',serif;color:var(--theme-text-primary);">Stay Sweet with Updates</h2>
      <p style="color:var(--text-70);margin-bottom:2rem;">Subscribe to get exclusive offers, new arrivals, and sweet surprises!</p>
      <form id="newsletterForm" class="newsletter-form" style="max-width:500px;margin:0 auto;">
        @csrf
        <div class="input-group">
          <input type="email" name="email" id="newsletterEmail" class="form-control" placeholder="Enter your email" style="border-radius:12px 0 0 12px;padding:1rem;" required>
          <button class="btn btn-glow" type="submit" id="subscribeBtn" style="border-radius:0 12px 12px 0;padding:0 2rem;">
            <span class="btn-text">Subscribe</span>
            <span class="btn-loading" style="display:none;"><i class="fas fa-spinner fa-spin"></i> Subscribing...</span>
          </button>
        </div>
        <div id="newsletterMessage" style="margin-top:1rem;font-size:0.9rem;"></div>
      </form>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
// Newsletter subscription
document.addEventListener('DOMContentLoaded', function() {
    const newsletterForm = document.getElementById('newsletterForm');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('newsletterEmail').value;
            const subscribeBtn = document.getElementById('subscribeBtn');
            const btnText = subscribeBtn.querySelector('.btn-text');
            const btnLoading = subscribeBtn.querySelector('.btn-loading');
            const messageDiv = document.getElementById('newsletterMessage');

            // Show loading state
            subscribeBtn.disabled = true;
            btnText.style.display = 'none';
            btnLoading.style.display = 'inline';
            messageDiv.innerHTML = '';

            fetch('/subscribe', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ email: email })
            })
            .then(async response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    const data = await response.json();
                    if (!response.ok) {
                        throw new Error(data.message || 'Subscription failed');
                    }
                    return data;
                } else {
                    throw new Error('Something went wrong. Please try again.');
                }
            })
            .then(data => {
                if (data.success) {
                    messageDiv.innerHTML = `<span style="color:#22c55e;"><i class="fas fa-check-circle me-1"></i>${data.message}</span>`;
                    document.getElementById('newsletterEmail').value = '';
                } else {
                    messageDiv.innerHTML = `<span style="color:#f43f5e;"><i class="fas fa-exclamation-circle me-1"></i>${data.message}</span>`;
                }
            })
            .catch(error => {
                console.error('Subscription error:', error);
                messageDiv.innerHTML = `<span style="color:#f43f5e;"><i class="fas fa-exclamation-circle me-1"></i>${error.message}</span>`;
            })
            .finally(() => {
                // Reset button state
                subscribeBtn.disabled = false;
                btnText.style.display = 'inline';
                btnLoading.style.display = 'none';
            });
        });
    }
});
</script>

<script>
// Featured Products filter (only filters within Featured Products section)
function filterFeaturedProd(btn, cat) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const featuredSlider = document.getElementById('featuredSlider');
    if (featuredSlider) {
        featuredSlider.querySelectorAll('.slider-product-card[data-cat]').forEach(card => {
            if (cat === 'all') {
                card.style.display = 'block';
                card.style.animation = 'fadeIn .5s ease';
            } else {
                if (card.dataset.cat === cat) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn .5s ease';
                } else {
                    card.style.display = 'none';
                }
            }
        });
        // Scroll back to start on filter change
        featuredSlider.scrollTo({ left: 0, behavior: 'smooth' });
    }
}

// On page load: show only 12 products for "All Products"
(function() {
    const allBtn = document.querySelector('.filter-btn.active');
    if (allBtn) {
        filterFeaturedProd(allBtn, 'all');
    }
})();

// Scroll animation
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-in');
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

// "Best Sellers" text typing animation
const sellersWords = ['Sellers', 'Products', 'Deals', 'Offers'];
let sellersWordIndex = 0;
let sellersCharIndex = 0;
let sellersIsDeleting = false;
const sellersElement = document.getElementById('sellers-text');

function typeSellersText() {
    if (!sellersElement) return;

    const currentWord = sellersWords[sellersWordIndex];

    if (sellersIsDeleting) {
        sellersElement.textContent = currentWord.substring(0, sellersCharIndex - 1);
        sellersCharIndex--;
    } else {
        sellersElement.textContent = currentWord.substring(0, sellersCharIndex + 1);
        sellersCharIndex++;
    }

    let typeSpeed = sellersIsDeleting ? 50 : 100;

    if (!sellersIsDeleting && sellersCharIndex === currentWord.length) {
        // Word completed, pause before deleting
        typeSpeed = 2000;
        sellersIsDeleting = true;
    } else if (sellersIsDeleting && sellersCharIndex === 0) {
        // Deletion completed, move to next word
        sellersIsDeleting = false;
        sellersWordIndex = (sellersWordIndex + 1) % sellersWords.length;
        typeSpeed = 500;
    }

    setTimeout(typeSellersText, typeSpeed);
}

// Start the animation when page loads
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(typeSellersText, 1000);
});

// Add to Cart function
function addToCart(productId, productName, price, image, event) {
    event.preventDefault();
    event.stopPropagation();

    const button = event.target.closest('.product-cart-btn, .add-btn');
    if (!button) return;
    const originalHTML = button.innerHTML;

    // Show loading state
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    button.disabled = true;

    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(async response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers.get('content-type'));

        // Get response text first
        const text = await response.text();
        console.log('Response text:', text);

        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            const data = JSON.parse(text);
            console.log('Response data:', data);

            if (!response.ok) {
                throw new Error(data.message || 'Failed to add to cart');
            }
            return data;
        } else {
            // Response is not JSON - probably an error page
            console.error('Non-JSON response:', text);
            throw new Error('Server error. Please try again.');
        }
    })
    .then(data => {
        console.log('Processing data:', data);

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
        console.error('Full error:', error);
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
    // Remove existing toast if any
    const existingToast = document.querySelector('.cart-toast');
    if (existingToast) {
        existingToast.remove();
    }

    // Create toast element
    const toast = document.createElement('div');
    toast.className = 'cart-toast';
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        z-index: 9999;
        animation: slideIn 0.3s ease;
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Add CSS for toast animations
const style = document.createElement('style');
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
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Wishlist functionality
document.querySelectorAll('.wishlist-btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();

    // Check authentication first
    if (!window.requireAuth()) {
      return; // Stop if user is not authenticated
    }

    const productId = this.getAttribute('data-product-id');
    const icon = this.querySelector('i');
    const isActive = icon.classList.contains('fas');

    // Toggle visual state immediately for better UX
    if (isActive) {
      icon.classList.remove('fas');
      icon.classList.add('far');
    } else {
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

// Product card wishlist buttons
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
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}',
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
      icon.classList.toggle('fas');
      icon.classList.toggle('far');

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

<script>
// New Arrivals Slider Navigation
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('newArrivalsSlider');
    const prevBtn = document.getElementById('newArrivalsPrev');
    const nextBtn = document.getElementById('newArrivalsNext');

    if (!slider || !prevBtn || !nextBtn) return;

    // Calculate scroll amount based on visible cards
    function getScrollAmount() {
        const cardWidth = slider.querySelector('.slider-product-card')?.offsetWidth || 200;
        const gap = 20; // gap between cards
        return (cardWidth + gap) * 2; // Scroll 2 cards at a time
    }

    // Update button states
    function updateButtons() {
        const maxScroll = slider.scrollWidth - slider.clientWidth;
        prevBtn.disabled = slider.scrollLeft <= 10;
        nextBtn.disabled = slider.scrollLeft >= maxScroll - 10;

        prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
        nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
    }

    // Scroll to previous
    prevBtn.addEventListener('click', function() {
        slider.scrollBy({
            left: -getScrollAmount(),
            behavior: 'smooth'
        });
    });

    // Scroll to next
    nextBtn.addEventListener('click', function() {
        slider.scrollBy({
            left: getScrollAmount(),
            behavior: 'smooth'
        });
    });

    // Update buttons on scroll
    slider.addEventListener('scroll', updateButtons);

    // Initial button state
    updateButtons();

    // Touch/drag support
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.style.cursor = 'grabbing';
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.style.cursor = 'grab';
    });

    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.style.cursor = 'grab';
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2;
        slider.scrollLeft = scrollLeft - walk;
    });

    // Set initial cursor
    slider.style.cursor = 'grab';

    // View All trigger card click handler
    const viewAllTrigger = slider.querySelector('.view-all-trigger-card');
    if (viewAllTrigger) {
        viewAllTrigger.addEventListener('click', function() {
            @if($cmsSections && isset($cmsSections['new-arrivals']) && $cmsSections['new-arrivals']->button_url)
                window.location.href = "{{ $cmsSections['new-arrivals']->button_url }}";
            @else
                window.location.href = "{{ route('shop') }}";
            @endif
        });
    }
});
</script>

<script>
// Category Collection Sliders Navigation
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all category sliders dynamically
    document.querySelectorAll('[id^="catSlider-"]').forEach(function(sliderEl) {
        const sectionId = sliderEl.id.replace('catSlider-', '');
        const prevBtn = document.getElementById('catSliderPrev-' + sectionId);
        const nextBtn = document.getElementById('catSliderNext-' + sectionId);

        if (!prevBtn || !nextBtn) return;

        function getScrollAmount() {
            const cardWidth = sliderEl.querySelector('.slider-product-card')?.offsetWidth || 200;
            const gap = 20;
            return (cardWidth + gap) * 2;
        }

        function updateButtons() {
            const maxScroll = sliderEl.scrollWidth - sliderEl.clientWidth;
            prevBtn.disabled = sliderEl.scrollLeft <= 10;
            nextBtn.disabled = sliderEl.scrollLeft >= maxScroll - 10;
            prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
            nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
        }

        prevBtn.addEventListener('click', function() {
            sliderEl.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', function() {
            sliderEl.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
        });

        sliderEl.addEventListener('scroll', updateButtons);
        updateButtons();

        // Touch/drag support
        let isDown = false;
        let startX;
        let scrollLeft;

        sliderEl.addEventListener('mousedown', (e) => {
            isDown = true;
            sliderEl.style.cursor = 'grabbing';
            startX = e.pageX - sliderEl.offsetLeft;
            scrollLeft = sliderEl.scrollLeft;
        });

        sliderEl.addEventListener('mouseleave', () => {
            isDown = false;
            sliderEl.style.cursor = 'grab';
        });

        sliderEl.addEventListener('mouseup', () => {
            isDown = false;
            sliderEl.style.cursor = 'grab';
        });

        sliderEl.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - sliderEl.offsetLeft;
            const walk = (x - startX) * 2;
            sliderEl.scrollLeft = scrollLeft - walk;
        });

        sliderEl.style.cursor = 'grab';
    });
});
</script>

<script>
// Best Sellers Slider Navigation
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('bestSellersSlider');
    const prevBtn = document.getElementById('bestSellersPrev');
    const nextBtn = document.getElementById('bestSellersNext');

    if (!slider || !prevBtn || !nextBtn) return;

    function getScrollAmount() {
        const cardWidth = slider.querySelector('.slider-product-card')?.offsetWidth || 200;
        const gap = 20;
        return (cardWidth + gap) * 2;
    }

    function updateButtons() {
        const maxScroll = slider.scrollWidth - slider.clientWidth;
        prevBtn.disabled = slider.scrollLeft <= 10;
        nextBtn.disabled = slider.scrollLeft >= maxScroll - 10;
        prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
        nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
    }

    prevBtn.addEventListener('click', function() {
        slider.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', function() {
        slider.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
    });

    slider.addEventListener('scroll', updateButtons);
    updateButtons();

    // Touch/drag support
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.style.cursor = 'grabbing';
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.style.cursor = 'grab';
    });

    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.style.cursor = 'grab';
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2;
        slider.scrollLeft = scrollLeft - walk;
    });

    slider.style.cursor = 'grab';
});
</script>

<script>
// Featured Products Slider Navigation
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('featuredSlider');
    const prevBtn = document.getElementById('featuredPrev');
    const nextBtn = document.getElementById('featuredNext');

    if (!slider || !prevBtn || !nextBtn) return;

    function getScrollAmount() {
        const cardWidth = slider.querySelector('.slider-product-card')?.offsetWidth || 200;
        const gap = 20;
        return (cardWidth + gap) * 2;
    }

    function updateButtons() {
        const maxScroll = slider.scrollWidth - slider.clientWidth;
        prevBtn.disabled = slider.scrollLeft <= 10;
        nextBtn.disabled = slider.scrollLeft >= maxScroll - 10;
        prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
        nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
    }

    prevBtn.addEventListener('click', function() {
        slider.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', function() {
        slider.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
    });

    slider.addEventListener('scroll', updateButtons);
    updateButtons();

    // Touch/drag support
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.style.cursor = 'grabbing';
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.style.cursor = 'grab';
    });

    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.style.cursor = 'grab';
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2;
        slider.scrollLeft = scrollLeft - walk;
    });

    slider.style.cursor = 'grab';
});
</script>

<script>
// Blog Slider Navigation
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('blogSlider');
    const prevBtn = document.getElementById('blogPrev');
    const nextBtn = document.getElementById('blogNext');

    if (!slider || !prevBtn || !nextBtn) return;

    function getScrollAmount() {
        const cardWidth = slider.querySelector('.slider-product-card')?.offsetWidth || 200;
        const gap = 20;
        return (cardWidth + gap) * 2;
    }

    function updateButtons() {
        const maxScroll = slider.scrollWidth - slider.clientWidth;
        prevBtn.disabled = slider.scrollLeft <= 10;
        nextBtn.disabled = slider.scrollLeft >= maxScroll - 10;
        prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
        nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
    }

    prevBtn.addEventListener('click', function() {
        slider.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', function() {
        slider.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
    });

    slider.addEventListener('scroll', updateButtons);
    updateButtons();

    // Touch/drag support
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.style.cursor = 'grabbing';
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.style.cursor = 'grab';
    });

    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.style.cursor = 'grab';
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2;
        slider.scrollLeft = scrollLeft - walk;
    });

    slider.style.cursor = 'grab';
});
</script>

<script>
// Testimonials Slider Navigation
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('testimonialSlider');
    const prevBtn = document.getElementById('testimonialPrev');
    const nextBtn = document.getElementById('testimonialNext');

    if (!slider || !prevBtn || !nextBtn) return;

    function getScrollAmount() {
        const cardWidth = slider.querySelector('.slider-product-card')?.offsetWidth || 200;
        const gap = 20;
        return (cardWidth + gap) * 2;
    }

    function updateButtons() {
        const maxScroll = slider.scrollWidth - slider.clientWidth;
        prevBtn.disabled = slider.scrollLeft <= 10;
        nextBtn.disabled = slider.scrollLeft >= maxScroll - 10;
        prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
        nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
    }

    prevBtn.addEventListener('click', function() {
        slider.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', function() {
        slider.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
    });

    slider.addEventListener('scroll', updateButtons);
    updateButtons();

    // Touch/drag support
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.style.cursor = 'grabbing';
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.style.cursor = 'grab';
    });

    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.style.cursor = 'grab';
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2;
        slider.scrollLeft = scrollLeft - walk;
    });

    slider.style.cursor = 'grab';
});
</script>

<script>
// Review Modal
document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('reviewModalOverlay');
    const modal = document.getElementById('reviewModal');
    const closeBtn = document.getElementById('reviewModalClose');

    if (!overlay || !modal || !closeBtn) return;

    // Open modal on card click
    document.querySelectorAll('.testimonial-card-clickable').forEach(function(card) {
        card.addEventListener('click', function() {
            const name = card.dataset.name || 'Anonymous';
            const initial = card.dataset.initial || '👤';
            const rating = parseInt(card.dataset.rating) || 5;
            const comment = card.dataset.comment || '';
            const product = card.dataset.product || '';
            const date = card.dataset.date || '';

            // Fill modal content
            document.getElementById('modalAvatar').textContent = initial;
            document.getElementById('modalName').textContent = name;
            document.getElementById('modalComment').textContent = '"' + comment + '"';

            // Stars
            var starsHtml = '';
            for (var i = 1; i <= 5; i++) {
                starsHtml += i <= rating
                    ? '<i class="fas fa-star"></i>'
                    : '<i class="far fa-star"></i>';
            }
            document.getElementById('modalStars').innerHTML = starsHtml;

            // Product pill
            var productPill = document.getElementById('modalProduct');
            if (product) {
                productPill.innerHTML = '<i class="fas fa-box"></i> ' + product;
                productPill.style.display = '';
            } else {
                productPill.style.display = 'none';
            }

            // Date pill
            var datePill = document.getElementById('modalDate');
            if (date) {
                datePill.innerHTML = '<i class="far fa-calendar"></i> ' + date;
                datePill.style.display = '';
            } else {
                datePill.style.display = 'none';
            }

            // Show modal
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    // Close modal
    function closeModal() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    closeBtn.addEventListener('click', closeModal);

    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) closeModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
});
</script>
@endpush

@push('styles')
<style>
/* Product Card Stats - Small Pill Badges */
.product-card-stats {
  display: flex;
  gap: 0.4rem;
  margin-top: 0.6rem;
  flex-wrap: wrap;
}

.stat-pill {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 3px 8px;
  background: rgba(var(--theme-primary-rgb, 245, 158, 11), 0.08);
  border: 1px solid rgba(var(--theme-primary-rgb, 245, 158, 11), 0.15);
  border-radius: 20px;
  font-size: 0.65rem;
  color: var(--text-60);
  white-space: nowrap;
  line-height: 1.4;
}

.stat-pill i {
  font-size: 0.6rem;
  color: var(--theme-text-secondary);
}

@media (max-width: 767px) {
  .stat-pill {
    padding: 2px 6px;
    font-size: 0.6rem;
    gap: 3px;
  }
  .stat-pill i {
    font-size: 0.55rem;
  }
}

/* Testimonial Card Clickable */
.testimonial-card-clickable {
  cursor: pointer;
}

@media (max-width: 575px) {
  .testimonial-card-clickable .product-card-img > div {
    flex-wrap: wrap;
  }
  .testimonial-card-clickable .product-card-img > div > div:last-child {
    min-width: 0;
    flex: 1 1 100%;
  }
  .testimonial-card-clickable .product-card-img > div > div:last-child > div:first-child {
    white-space: normal;
    overflow: visible;
    text-overflow: unset;
    font-size: 0.8rem;
    line-height: 1.3;
  }
}

/* Review Modal */
.review-modal-overlay {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(8px);
  z-index: 10000;
  align-items: center;
  justify-content: center;
  padding: 1rem;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.review-modal-overlay.active {
  display: flex;
  opacity: 1;
}

.review-modal {
  background: rgba(15, 10, 0, 0.97);
  backdrop-filter: blur(30px);
  border: 1px solid rgba(245, 158, 11, 0.2);
  border-radius: 24px;
  max-width: 520px;
  width: 100%;
  max-height: 85vh;
  overflow-y: auto;
  padding: 2rem;
  position: relative;
  animation: reviewModalIn 0.3s ease;
}

@keyframes reviewModalIn {
  from { transform: scale(0.9) translateY(20px); opacity: 0; }
  to { transform: scale(1) translateY(0); opacity: 1; }
}

.review-modal-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.12);
  color: var(--theme-text-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 0.9rem;
}

.review-modal-close:hover {
  background: rgba(244, 63, 94, 0.3);
  transform: scale(1.1);
}

.review-modal-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.review-modal-avatar {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background: var(--theme-btn-gradient);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  color: #fff;
  font-weight: 700;
  flex-shrink: 0;
}

.review-modal-name {
  font-weight: 700;
  color: var(--theme-text-primary);
  font-size: 1.05rem;
  margin-bottom: 0.25rem;
}

.review-modal-stars {
  color: var(--theme-text-secondary);
  font-size: 0.85rem;
  margin-bottom: 0.5rem;
}

.review-modal-meta {
  display: flex;
  gap: 0.4rem;
  flex-wrap: wrap;
}

.review-modal-body {
  position: relative;
  padding: 1rem 0 0;
}

.review-modal-quote-icon {
  font-size: 1.5rem;
  color: var(--theme-text-secondary);
  opacity: 0.3;
  margin-bottom: 0.5rem;
  display: block;
}

.review-modal-body p {
  font-size: 0.95rem;
  color: var(--text-80);
  line-height: 1.8;
  margin: 0;
  font-style: italic;
}

@media (max-width: 767px) {
  .review-modal {
    padding: 1.5rem;
    border-radius: 18px;
    max-height: 90vh;
  }
  .review-modal-avatar {
    width: 44px;
    height: 44px;
    font-size: 1.2rem;
  }
  .review-modal-name {
    font-size: 0.95rem;
  }
  .review-modal-body p {
    font-size: 0.9rem;
    line-height: 1.7;
  }
}

/* Blog Card Styles */
.blog-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  overflow: hidden;
}

.blog-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(245,158,11,0.2);
}

.blog-img {
  position: relative;
  width: 100%;
  overflow: hidden;
  border-radius: 12px 12px 0 0;
  background: linear-gradient(135deg, rgba(245,158,11,0.05), rgba(244,63,94,0.05));
}

.blog-img img {
  width: 100%;
  height: auto;
  display: block;
  transition: transform 0.3s ease;
}

.blog-card:hover .blog-img img {
  transform: scale(1.05);
}

.blog-img-placeholder {
  background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(244,63,94,0.1));
  display: flex;
  align-items: center;
  justify-content: center;
}

.blog-badge {
  position: absolute;
  top: 10px;
  right: 10px;
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
}

.badge-featured {
  background: var(--theme-btn-gradient);
  color: white;
}

.blog-body {
  padding: 1.5rem;
}

.blog-category {
  display: inline-block;
  padding: 4px 12px;
  background: linear-gradient(135deg, rgba(245,158,11,0.2), rgba(244,63,94,0.2));
  border-radius: 20px;
  font-size: 0.75rem;
  color: var(--theme-text-secondary);
  margin-bottom: 0.75rem;
}

.blog-title {
  color: var(--theme-text-primary);
  font-weight: 600;
  margin-bottom: 0.75rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.blog-excerpt {
  color: var(--text-70);
  font-size: 0.9rem;
  margin-bottom: 1rem;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.blog-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  font-size: 0.8rem;
  color: var(--text-60);
  padding-top: 1rem;
  border-top: 1px solid var(--text-10);
}

.blog-meta i {
  margin-right: 4px;
}

/* Product Image Wrapper - Homepage */
.prod-img-wrapper {
  position: relative;
  width: 100%;
  aspect-ratio: 1;
  overflow: hidden;
  border-radius: 12px 12px 0 0;
  background: linear-gradient(135deg, rgba(245,158,11,0.05), rgba(244,63,94,0.05));
}

.prod-img-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.prod-card:hover .prod-img-wrapper img {
  transform: scale(1.05);
}

.prod-img-placeholder {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 3rem;
  background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(244,63,94,0.1));
}

.prod-wishlist {
  position: absolute;
  top: 10px;
  right: 10px;
  width: 35px;
  height: 35px;
  border-radius: 50%;
  background: rgba(15, 23, 42, 0.8);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  color: var(--theme-text-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 2;
}

.prod-wishlist:hover {
  background: rgba(244, 63, 94, 0.8);
  color: white;
  transform: scale(1.1);
}

.prod-wishlist.active {
  background: rgba(244, 63, 94, 0.9);
  color: white;
}

.prod-wishlist.active i {
  font-weight: 900;
}

/* =============================================
   NEW ARRIVALS SECTION - COMPLETE STYLES
   ============================================= */

/* Slider Wrapper - Contains the track and navigation */
.new-arrivals-slider-wrapper {
  position: relative;
  padding: 0 50px;
}

/* Slider Track - The scrollable container */
.new-arrivals-slider {
  display: flex;
  flex-wrap: nowrap;
  gap: 1.25rem;
  overflow-x: auto;
  scroll-behavior: smooth;
  scroll-snap-type: x mandatory;
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none;
  -ms-overflow-style: none;
  padding: 0.5rem 0;
}

.new-arrivals-slider::-webkit-scrollbar {
  display: none;
}

/* Product Card */
.slider-product-card {
  flex: 0 0 calc((100% - 6.25rem) / 6);
  max-width: calc((100% - 6.25rem) / 6);
  min-width: 200px;
  background: rgba(255,255,255,0.05);
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.3s ease;
  scroll-snap-align: start;
  border: 1px solid rgba(255,255,255,0.1);
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

.slider-product-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 30px rgba(var(--theme-primary-rgb, 245, 158, 11), 0.15);
  border-color: var(--theme-primary, #f59e0b);
}

/* View All Trigger Card - Appears after 8 products */
.view-all-trigger-card {
  background: linear-gradient(135deg, rgba(var(--theme-primary-rgb, 245, 158, 11), 0.1), rgba(var(--theme-secondary-rgb, 244, 63, 94), 0.1));
  border: 2px dashed var(--theme-primary, #f59e0b);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  min-height: 350px;
}

.view-all-trigger-card:hover {
  background: linear-gradient(135deg, rgba(var(--theme-primary-rgb, 245, 158, 11), 0.2), rgba(var(--theme-secondary-rgb, 244, 63, 94), 0.15));
  transform: translateY(-8px);
}

.view-all-card-content {
  text-align: center;
  padding: 2rem;
}

.view-all-icon {
  width: 60px;
  height: 60px;
  margin: 0 auto 1rem;
  border-radius: 50%;
  background: var(--theme-btn-gradient, linear-gradient(135deg, #f59e0b, #f43f5e));
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.5rem;
  transition: transform 0.3s ease;
}

.view-all-trigger-card:hover .view-all-icon {
  transform: scale(1.1);
}

.view-all-card-content h4 {
  color: var(--theme-text-primary, #1a1a2e);
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.view-all-card-content p {
  color: var(--text-60, #666);
  font-size: 0.875rem;
  margin: 0;
}

/* Product Card Image Container */
.product-card-img {
  position: relative;
  width: 100%;
  aspect-ratio: 1;
  overflow: hidden;
  background: linear-gradient(135deg, rgba(var(--theme-primary-rgb, 245, 158, 11), 0.05), rgba(var(--theme-secondary-rgb, 244, 63, 94), 0.05));
}

.product-card-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.slider-product-card:hover .product-card-img img {
  transform: scale(1.08);
}

.prod-img-placeholder {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 3rem;
  color: var(--theme-primary, #f59e0b);
  background: linear-gradient(135deg, rgba(var(--theme-primary-rgb, 245, 158, 11), 0.1), rgba(var(--theme-secondary-rgb, 244, 63, 94), 0.1));
}

/* Category Badge - Top Left */
.product-category-badge {
  position: absolute;
  top: 10px;
  left: 10px;
  padding: 4px 10px;
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(244, 63, 94, 0.15));
  border: 1px solid rgba(245, 158, 11, 0.3);
  backdrop-filter: blur(10px);
  color: var(--theme-primary, #f59e0b);
  font-size: 0.7rem;
  font-weight: 600;
  border-radius: 20px;
  z-index: 2;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Wishlist Button - Top Right */
.product-wishlist-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: rgba(15, 23, 42, 0.8);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  color: var(--theme-text-primary, #fff);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 2;
  opacity: 0;
  transform: scale(0.8);
}

.slider-product-card:hover .product-wishlist-btn {
  opacity: 1;
  transform: scale(1);
}

.product-wishlist-btn:hover {
  background: rgba(244, 63, 94, 0.9);
  color: white;
  transform: scale(1.1);
}

.product-wishlist-btn.active {
  background: rgba(244, 63, 94, 0.9);
  color: white;
}

.product-wishlist-btn.active i {
  font-weight: 900;
}

/* Add to Cart Overlay - On Image Hover */
.product-cart-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 1rem;
  background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
  transform: translateY(100%);
  transition: transform 0.3s ease;
  z-index: 2;
}

.slider-product-card:hover .product-cart-overlay {
  transform: translateY(0);
}

.product-cart-btn {
  width: 100%;
  padding: 0.75rem 1rem;
  background: var(--theme-btn-gradient, linear-gradient(135deg, #f59e0b, #f43f5e));
  border: none;
  border-radius: 8px;
  color: white;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.product-cart-btn:hover {
  transform: scale(1.02);
  box-shadow: 0 4px 15px rgba(var(--theme-primary-rgb, 245, 158, 11), 0.4);
}

/* Product Card Info */
.product-card-info {
  padding: 1rem;
}

/* Category Name */
.product-card-category {
  font-size: 0.75rem;
  color: var(--theme-primary, #f59e0b);
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 0.5rem;
}

/* Product Name - 2 lines max */
.product-card-name {
  font-size: 0.95rem;
  font-weight: 600;
  color: var(--theme-text-primary, #1a1a2e);
  margin: 0 0 0.5rem 0;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  min-height: 2.8em;
}

/* Rating */
.product-card-rating {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 0.75rem;
}

.rating-stars {
  display: flex;
  gap: 2px;
}

.rating-stars i {
  font-size: 0.75rem;
  color: #f59e0b;
}

.rating-stars i.far {
  color: #ddd;
}

.rating-count {
  font-size: 0.75rem;
  color: var(--text-60, #666);
}

/* Price Row */
.product-card-price {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.price-info {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  flex-wrap: wrap;
}

.current-price {
  font-size: 1rem;
  font-weight: 700;
  color: var(--theme-text-primary, #1a1a2e);
}

.original-price {
  font-size: 0.85rem;
  color: var(--text-50, #999);
  text-decoration: line-through;
}

.discount-badge {
  padding: 2px 8px;
  background: rgba(244, 63, 94, 0.15);
  color: #f43f5e;
  font-size: 0.7rem;
  font-weight: 600;
  border-radius: 4px;
}

.coupon-badge {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 4px 8px;
  background: linear-gradient(135deg, rgba(var(--theme-primary-rgb, 245, 158, 11), 0.1), rgba(var(--theme-secondary-rgb, 244, 63, 94), 0.1));
  color: var(--theme-primary, #f59e0b);
  font-size: 0.7rem;
  font-weight: 500;
  border-radius: 4px;
  border: 1px dashed var(--theme-primary, #f59e0b);
}

/* Navigation Buttons */
.slider-nav-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  color: var(--theme-text-primary, #1a1a2e);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 10;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.slider-nav-btn:hover {
  background: var(--theme-primary, #f59e0b);
  color: white;
  border-color: var(--theme-primary, #f59e0b);
  box-shadow: 0 4px 15px rgba(var(--theme-primary-rgb, 245, 158, 11), 0.3);
}

.slider-nav-btn.slider-prev {
  left: 0;
}

.slider-nav-btn.slider-next {
  right: 0;
}

.slider-nav-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

/* Placeholder Card */
.slider-placeholder {
  opacity: 0.6;
}

.slider-placeholder .product-card-img,
.slider-placeholder .product-card-info {
  opacity: 0.7;
}

/* =============================================
   RESPONSIVE STYLES
   ============================================= */

/* Large Desktop - 6 cards visible */
@media (min-width: 1400px) {
  .slider-product-card {
    flex: 0 0 calc((100% - 6.25rem) / 6);
    max-width: calc((100% - 6.25rem) / 6);
    min-width: 200px;
  }
}

/* Desktop - 5 cards visible */
@media (max-width: 1399px) {
  .slider-product-card {
    flex: 0 0 calc((100% - 5rem) / 5);
    max-width: calc((100% - 5rem) / 5);
    min-width: 180px;
  }
}

/* Tablet Landscape - 4 cards visible */
@media (max-width: 1199px) {
  .slider-product-card {
    flex: 0 0 calc((100% - 3.75rem) / 4);
    max-width: calc((100% - 3.75rem) / 4);
    min-width: 160px;
  }
}

/* Tablet Portrait - 3 cards visible */
@media (max-width: 991px) {
  .slider-product-card {
    flex: 0 0 calc((100% - 2.5rem) / 3);
    max-width: calc((100% - 2.5rem) / 3);
    min-width: 140px;
  }

  .new-arrivals-slider-wrapper {
    padding: 0 45px;
  }

  .slider-nav-btn {
    width: 40px;
    height: 40px;
  }
}

/* Mobile Landscape - 2 cards visible */
@media (max-width: 767px) {
  .slider-product-card {
    flex: 0 0 calc((100% - 1rem) / 2);
    max-width: calc((100% - 1rem) / 2);
    min-width: 140px;
  }

  .new-arrivals-slider {
    gap: 1rem;
  }

  .new-arrivals-slider-wrapper {
    padding: 0 40px;
  }

  .slider-nav-btn {
    width: 36px;
    height: 36px;
    font-size: 0.875rem;
  }

  .product-card-info {
    padding: 0.75rem;
  }

  .product-card-name {
    font-size: 0.875rem;
  }

  .current-price {
    font-size: 0.9rem;
  }

  .view-all-trigger-card {
    min-height: 280px;
  }
}

/* Mobile Portrait - 2 cards visible */
@media (max-width: 575px) {
  .slider-product-card {
    flex: 0 0 calc((100% - 0.75rem) / 2);
    max-width: calc((100% - 0.75rem) / 2);
    min-width: 130px;
  }

  .new-arrivals-slider {
    gap: 0.75rem;
  }

  .new-arrivals-slider-wrapper {
    padding: 0 35px;
  }

  .slider-nav-btn {
    width: 32px;
    height: 32px;
    font-size: 0.75rem;
  }

  .product-category-badge {
    font-size: 0.6rem;
    padding: 3px 6px;
  }

  .product-wishlist-btn {
    width: 30px;
    height: 30px;
    font-size: 0.75rem;
  }

  .product-card-info {
    padding: 0.6rem;
  }

  .product-card-category {
    font-size: 0.65rem;
  }

  .product-card-name {
    font-size: 0.8rem;
    min-height: 2.4em;
  }

  .rating-stars i {
    font-size: 0.65rem;
  }

  .current-price {
    font-size: 0.85rem;
  }

  .original-price {
    font-size: 0.75rem;
  }

  .view-all-trigger-card {
    min-height: 240px;
  }

  .view-all-icon {
    width: 50px;
    height: 50px;
    font-size: 1.25rem;
  }

  .view-all-card-content h4 {
    font-size: 0.9rem;
  }

  .view-all-card-content p {
    font-size: 0.75rem;
  }
}

/* Touch devices - show wishlist always visible */
@media (hover: none) {
  .product-wishlist-btn {
    opacity: 1;
    transform: scale(1);
  }

  .product-cart-overlay {
    transform: translateY(0);
    background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
    padding: 0.4rem;
  }

  .product-cart-btn {
    padding: 0.35rem 0.5rem;
    font-size: 0.7rem;
    border-radius: 6px;
  }

  .product-cart-btn span {
    display: none;
  }

  .product-cart-btn i {
    font-size: 0.85rem;
  }
}

@media (max-width: 575px) {
  .product-cart-overlay {
    padding: 0.35rem;
  }

  .product-cart-btn {
    padding: 0.3rem;
    font-size: 0.65rem;
  }

  .product-cart-btn span {
    display: none;
  }
}
</style>
@endpush
