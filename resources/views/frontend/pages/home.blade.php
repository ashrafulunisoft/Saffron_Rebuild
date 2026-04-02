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
        <a href="{{ $cmsSections['chocolate-paradise']->button_url }}" class="btn btn-glow mt-4 animate-on-scroll" style="background:linear-gradient(135deg, #f43f5e, #a855f7);">
          {{ $cmsSections['chocolate-paradise']->button_text_en ?? 'Discover Chocolates' }} <i class="fas fa-arrow-right ms-2"></i>
        </a>
        @else
        <a href="{{ route('shop') }}" class="btn btn-glow mt-4 animate-on-scroll" style="background:linear-gradient(135deg, #f43f5e, #a855f7);">
          Discover Chocolates <i class="fas fa-arrow-right ms-2"></i>
        </a>
        @endif
      </div>
    </div>
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
    <div class="text-center mb-5">
      @if($cmsSections && isset($cmsSections['featured_products']))
        <span class="section-badge">{{ $cmsSections['featured_products']->title_en ?? 'Our Collection' }}</span>
        <h2 class="section-title mt-3">
          {!! $cmsSections['featured_products']->subtitle_en ?? 'Featured <span class="gradient-text">Products</span>' !!}
        </h2>
        @if($cmsSections['featured_products']->content_en)
        <p style="color:var(--text-70);">{!! $cmsSections['featured_products']->content_en !!}</p>
        @endif
      @else
        <span class="section-badge">Our Collection</span>
        <h2 class="section-title mt-3">
          Featured <span class="gradient-text">Products</span>
        </h2>
        <p style="color:var(--text-70);">Handpicked favorites from our extensive collection</p>
      @endif
    </div>

    <!-- Category Filters -->
    <div class="d-flex justify-content-center gap-2 mb-4 flex-wrap">
      <button class="filter-btn active" onclick="filterFeaturedProd(this, 'all')">All Products</button>
      @foreach($categories as $category)
        <button class="filter-btn" onclick="filterFeaturedProd(this, '{{ $category->slug }}')">{{ $category->name_en }}</button>
      @endforeach
    </div>

    <!-- Products Grid -->
    <div class="row g-4" id="featured-products-grid">
      @if(isset($featuredProducts) && $featuredProducts->count() > 0)
        @foreach($featuredProducts as $product)
        <div class="col-6 col-md-4 col-lg-3">
          <a href="{{ route('shop.product', $product->slug) }}" class="text-decoration-none">
            <div class="prod-card prod-item" data-cat="{{ $product->category->slug ?? 'breads' }}">
              <div class="prod-img-wrapper">
                @if($product->image)
                  <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy" decoding="async">
                @else
                  <div class="prod-img-placeholder">
                    <i class="fas fa-cookie-bite"></i>
                  </div>
                @endif
                @if($product->is_featured)
                  <span class="prod-badge badge-hot">FEATURED</span>
                @endif
                <button class="prod-wishlist" data-product-id="{{ $product->id }}" title="Add to Wishlist">
                  <i class="far fa-heart"></i>
                </button>
              </div>
              <div class="prod-body">
                <div class="prod-cat">{{ $product->category->name_en ?? 'Sweets' }}</div>
                <h5 class="prod-name">{{ $product->name }}</h5>
                <div class="prod-stars">★★★★★ <small>({{ $product->reviews_count ?? 0 }})</small></div>
                <div class="prod-footer">
                  <div>
                    <span class="price-new">৳{{ number_format($product->price) }}</span>
                    @if($product->compare_price)
                      <span class="price-old">৳{{ number_format($product->compare_price) }}</span>
                    @endif
                  </div>
                  <button class="add-btn" onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price ?? $product->price }}, '{{ $product->image ?? '' }}', event)"><i class="fas fa-shopping-bag"></i></button>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      @else
        <div class="col-12 text-center py-5">
          <p style="color:var(--text-60);">No products available at the moment.</p>
        </div>
      @endif
    </div>

    <div class="text-center mt-5">
      <a href="{{ route('shop') }}" class="btn btn-glow btn-lg">
        View All Products <i class="fas fa-arrow-right ms-2"></i>
      </a>
    </div>
  </div>
</section>

<!-- NEW ARRIVALS -->
<section class="section-gap" id="new-arrivals">
  <div class="container">
    <div class="text-center mb-5">
      @if($cmsSections && isset($cmsSections['new-arrivals']))
        <span class="section-badge animate-on-scroll"><i class="fas fa-sparkles me-2"></i>{{ $cmsSections['new-arrivals']->title_en ?? 'Just Launched' }}</span>
        <h2 class="section-title mt-3 animate-on-scroll">
          {!! $cmsSections['new-arrivals']->subtitle_en ?? 'New <span class="gradient-text">Arrivals</span>' !!}
        </h2>
        @if($cmsSections['new-arrivals']->content_en)
        <p class="mt-3 animate-on-scroll" style="color:var(--text-60);max-width:600px;margin:0 auto;">
          {!! $cmsSections['new-arrivals']->content_en !!}
        </p>
        @endif
      @else
        <span class="section-badge animate-on-scroll"><i class="fas fa-sparkles me-2"></i>Just Launched</span>
        <h2 class="section-title mt-3 animate-on-scroll">New <span class="gradient-text">Arrivals</span></h2>
        <p class="mt-3 animate-on-scroll" style="color:var(--text-60);max-width:600px;margin:0 auto;">Discover our latest creations - fresh from the oven and ready to delight your taste buds</p>
      @endif
    </div>

    <div class="row g-4">
      @if(isset($newArrivals) && $newArrivals->count() > 0)
        @foreach($newArrivals as $product)
        <div class="col-lg-3 col-md-6">
          <a href="{{ route('shop.product', $product->slug) }}" class="text-decoration-none">
            <div class="prod-card prod-item animate-on-scroll">
              <div class="prod-img-wrapper">
                @if($product->image)
                  <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name_en }}" loading="lazy" decoding="async">
                @else
                  <div class="prod-img-placeholder">
                    <i class="fas fa-cookie-bite"></i>
                  </div>
                @endif
                <span class="prod-badge badge-new">NEW</span>
                <button class="prod-wishlist" data-product-id="{{ $product->id }}" title="Add to Wishlist">
                  <i class="far fa-heart"></i>
                </button>
              </div>
              <div class="prod-body">
                <div class="prod-cat">{{ $product->category->name_en ?? 'Sweets' }}</div>
                <h5 class="prod-name">{{ $product->name_en }}</h5>
                <div class="prod-stars">★★★★★ <small>({{ $product->reviews_count ?? 0 }})</small></div>
                <div class="prod-footer">
                  <div>
                    <span class="price-new">৳{{ number_format($product->price) }}</span>
                    @if($product->sale_price)
                      <span class="price-old">৳{{ number_format($product->sale_price) }}</span>
                    @endif
                  </div>
                  <button class="add-btn" onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price ?? $product->price }}, '{{ $product->image ?? '' }}', event)"><i class="fas fa-shopping-bag"></i></button>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      @else
        <div class="col-12 text-center py-5">
          <p style="color:var(--text-60);">No new arrivals available at the moment.</p>
        </div>
      @endif
    </div>

    <div class="text-center mt-5">
      @if($cmsSections && isset($cmsSections['new-arrivals']) && $cmsSections['new-arrivals']->button_url)
      <a href="{{ $cmsSections['new-arrivals']->button_url }}" class="btn btn-glow">
        <i class="fas fa-arrow-right me-2"></i>{{ $cmsSections['new-arrivals']->button_text_en ?? 'View All New Arrivals' }}
      </a>
      @else
      <a href="{{ route('shop') }}" class="btn btn-glow">
        <i class="fas fa-arrow-right me-2"></i>View All New Arrivals
      </a>
      @endif
    </div>
  </div>
</section>

<!-- BEST SELLERS -->
<section class="section-gap" style="background:linear-gradient(180deg, rgba(244,63,94,0.03), transparent);">
  <div class="container">
    <div class="text-center mb-5">
      @if($cmsSections && isset($cmsSections['best-offers']))
        <span class="section-badge animate-on-scroll" style="background:linear-gradient(135deg,rgba(244,63,94,0.2),rgba(245,158,11,0.2));border-color:rgba(244,63,94,0.3);"><i class="fas fa-fire me-2"></i>{{ $cmsSections['best-offers']->title_en ?? 'Top Rated' }}</span>
        <h2 class="section-title mt-3 animate-on-scroll">
          {!! $cmsSections['best-offers']->subtitle_en ?? 'Best <span class="gradient-text">Offers</span>' !!}
        </h2>
        @if($cmsSections['best-offers']->content_en)
        <p class="mt-3 animate-on-scroll" style="color:var(--text-60);max-width:600px;margin:0 auto;">
          {!! $cmsSections['best-offers']->content_en !!}
        </p>
        @endif
      @else
        <span class="section-badge animate-on-scroll" style="background:linear-gradient(135deg,rgba(244,63,94,0.2),rgba(245,158,11,0.2));border-color:rgba(244,63,94,0.3);"><i class="fas fa-fire me-2"></i>Top Rated</span>
        <h2 class="section-title mt-3 animate-on-scroll">Best <span id="sellers-text" style="background:linear-gradient(135deg,#f43f5e,#f59e0b);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"></span></h2>
        <p class="mt-3 animate-on-scroll" style="color:var(--text-60);max-width:600px;margin:0 auto;">Our most loved products that customers keep coming back for</p>
      @endif
    </div>

    <div class="row g-4">
      @if(isset($bestSellers) && $bestSellers->count() > 0)
        @foreach($bestSellers as $index => $product)
          <div class="col-lg-4 col-md-6">
            <a href="{{ route('shop.product', $product->slug) }}" class="text-decoration-none">
              <div class="prod-card prod-item animate-on-scroll" style="border:1px solid rgba(245,158,11,{{ $index === 0 ? '0.3' : '0.2' }});">
                <div class="prod-img-wrapper">
                  @if($product->image)
                    <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name }}" loading="lazy" decoding="async">
                  @else
                    <div class="prod-img-placeholder">
                      <i class="fas fa-cookie-bite"></i>
                    </div>
                  @endif
                  <span class="prod-badge badge-hot" style="background:linear-gradient(135deg,{{ $index === 0 ? '#f43f5e,#e11d48' : ($index === 1 ? '#f59e0b,#d97706' : '#8b5cf6,#7c3aed') }});">#{{ $index + 1 }} {{ $index === 0 ? 'BESTSELLER' : ($index === 1 ? 'TOP RATED' : 'POPULAR') }}</span>
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
                      <span class="price-new">৳{{ number_format($product->price) }}</span>
                      @if($product->sale_price)
                        <span class="price-old">৳{{ number_format($product->sale_price) }}</span>
                      @endif
                    </div>
                    <button class="add-btn" onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price ?? $product->price }}, '{{ $product->image ?? '' }}', event)"><i class="fas fa-shopping-bag"></i></button>
                  </div>
                </div>
                <div class="bestseller-stats">
                  <div class="stat-item">
                    <i class="fas fa-shopping-bag"></i>
                    <span>{{ $product->order_items_count ?? 0 }} sold</span>
                  </div>
                  <div class="stat-item">
                    <i class="fas fa-heart"></i>
                    <span>{{ $product->approved_reviews_count ?? 0 }} reviews</span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      @else
        <div class="col-12 text-center py-5">
          <p style="color:var(--text-60);">No best-selling products available at the moment.</p>
        </div>
      @endif
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
    <div class="text-center mb-5">
      <span class="section-badge">Testimonials</span>
      <h2 class="section-title mt-3">
        What Our <span class="gradient-text">Customers Say</span>
      </h2>
    </div>
    <div class="row g-4">
      @if(isset($reviews) && $reviews->count() > 0)
        <!-- Show real reviews from database -->
        @foreach($reviews as $review)
          <div class="col-md-4">
            <div class="testimonial-card glass-card text-center">
              <div class="testimonial-avatar">
                @if($review->user && $review->user->name)
                  {{ substr($review->user->name, 0, 1) }}
                @else
                  👤
                @endif
              </div>
              <div class="testimonial-stars">
                @for($i = 1; $i <= 5; $i++)
                  @if($i <= $review->rating)
                    ★
                  @else
                    ☆
                  @endif
                @endfor
              </div>
              <p class="testimonial-text">"{{ $review->comment }}"</p>
              <h6 class="testimonial-name">
                @if($review->user)
                  {{ $review->user->name }}
                @else
                  Anonymous
                @endif
              </h6>
              <small class="testimonial-role">
                @if($review->product)
                  Verified Buyer - {{ $review->product->name }}
                @else
                  Verified Buyer
                @endif
              </small>
            </div>
          </div>
        @endforeach
      @else
        <!-- Show demo reviews when no reviews in database -->
        <div class="col-md-4">
          <div class="testimonial-card glass-card text-center">
            <div class="testimonial-avatar">👩</div>
            <div class="testimonial-stars">★★★★★</div>
            <p class="testimonial-text">"The best roshogolla I've ever had! Absolutely authentic taste and the delivery was super fast. Highly recommended!"</p>
            <h6 class="testimonial-name">Fatima Rahman</h6>
            <small class="testimonial-role">Dhaka</small>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-card glass-card text-center">
            <div class="testimonial-avatar">👨</div>
            <div class="testimonial-stars">★★★★★</div>
            <p class="testimonial-text">"Ordered a custom cake for my daughter's birthday. It was perfect! Beautiful design and delicious taste. Thank you Saffron!"</p>
            <h6 class="testimonial-name">Rahul Ahmed</h6>
            <small class="testimonial-role">Chittagong</small>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-card glass-card text-center">
            <div class="testimonial-avatar">👩</div>
            <div class="testimonial-stars">★★★★★</div>
            <p class="testimonial-text">"Their chocolate collection is amazing! Perfect for gifting. The packaging is beautiful and the quality is top-notch."</p>
            <h6 class="testimonial-name">Nusrat Jahan</h6>
            <small class="testimonial-role">Sylhet</small>
          </div>
        </div>
      @endif
    </div>
  </div>
</section>

<!-- BLOG SECTION -->
@if(isset($blogPosts) && $blogPosts->count() > 0)
<section class="section-gap">
  <div class="container">
    <div class="text-center mb-5">
      @if($cmsSections && isset($cmsSections['blog']))
        <span class="section-badge animate-on-scroll">{{ $cmsSections['blog']->title_en ?? 'Latest News' }}</span>
        <h2 class="section-title mt-3 animate-on-scroll">
          {!! $cmsSections['blog']->subtitle_en ?? 'From Our <span class="gradient-text">Blog</span>' !!}
        </h2>
        @if($cmsSections['blog']->content_en)
        <p class="mt-3 animate-on-scroll" style="color:var(--text-70);">
          {!! $cmsSections['blog']->content_en !!}
        </p>
        @endif
      @else
        <span class="section-badge animate-on-scroll">Latest News</span>
        <h2 class="section-title mt-3 animate-on-scroll">From Our <span class="gradient-text">Blog</span></h2>
        <p class="mt-3 animate-on-scroll" style="color:var(--text-70);">Discover recipes, stories, and sweet updates from our kitchen</p>
      @endif
    </div>

    <div class="row g-4">
      @foreach($blogPosts as $post)
        <div class="col-lg-4 col-md-6">
          <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
            <div class="blog-card glass-card animate-on-scroll h-100">
              @if($post->featured_image)
                <div class="blog-img">
                  <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" loading="lazy" decoding="async">
                  @if($post->is_featured)
                    <span class="blog-badge badge-featured">⭐ Featured</span>
                  @endif
                </div>
              @else
                <div class="blog-img blog-img-placeholder">
                  <div style="font-size:4rem;">📝</div>
                  @if($post->is_featured)
                    <span class="blog-badge badge-featured">⭐ Featured</span>
                  @endif
                </div>
              @endif
              <div class="blog-body">
                @if($post->category)
                  <span class="blog-category">{{ $post->category }}</span>
                @endif
                <h5 class="blog-title">{{ Str::limit($post->title, 60) }}</h5>
                <p class="blog-excerpt">{{ Str::limit(strip_tags($post->excerpt ?? $post->content), 100) }}</p>
                <div class="blog-meta">
                  <span><i class="far fa-calendar"></i> {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Unpublished' }}</span>
                  <span><i class="far fa-eye"></i> {{ $post->views ?? 0 }}</span>
                  @if($post->user)
                    <span><i class="far fa-user"></i> {{ $post->user->name }}</span>
                  @endif
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
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
              <a href="{{ route('shop') }}" class="btn btn-glow btn-sm" style="background:linear-gradient(135deg, #f43f5e, #a855f7);">Send a Gift</a>
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

    const featuredGrid = document.getElementById('featured-products-grid');
    if (featuredGrid) {
        let shown = 0;
        const maxAll = 12;

        featuredGrid.querySelectorAll('.prod-item').forEach(item => {
            const column = item.closest('.col-6, .col-md-4, .col-lg-3');
            if (cat === 'all') {
                // "All Products": show only first 12
                if (shown < maxAll) {
                    item.style.display = 'block';
                    if (column) column.style.display = 'block';
                    item.style.animation = 'fadeIn .5s ease';
                    shown++;
                } else {
                    item.style.display = 'none';
                    if (column) column.style.display = 'none';
                }
            } else {
                // Category filter: show all matching products
                if (item.dataset.cat === cat) {
                    item.style.display = 'block';
                    if (column) column.style.display = 'block';
                    item.style.animation = 'fadeIn .5s ease';
                } else {
                    item.style.display = 'none';
                    if (column) column.style.display = 'none';
                }
            }
        });
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

    const button = event.target.closest('.add-btn');
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
@endpush

@push('styles')
<style>
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
  background: linear-gradient(135deg, #f59e0b, #f43f5e);
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
  color: #fbbf24;
  margin-bottom: 0.75rem;
}

.blog-title {
  color: #f5e6cc;
  font-weight: 600;
  margin-bottom: 0.75rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.blog-excerpt {
  color: rgba(245,230,204,0.7);
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
  color: rgba(245,230,204,0.6);
  padding-top: 1rem;
  border-top: 1px solid rgba(245,230,204,0.1);
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
  color: #f5e6cc;
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
</style>
@endpush
