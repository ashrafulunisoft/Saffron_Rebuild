@extends('frontend.layouts.app')

@section('title', 'Home - Saffron Sweets & Bakery')

@section('content')
@php
    // Get sections from controller, ensure it exists
    if (!isset($sections)) {
        $sections = collect();
    }
@endphp

<!-- HERO SECTION -->
@php $hero = $sections->where('section_key', 'hero')->first(); @endphp
@if($hero && $hero->is_active)
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
    <div><div class="fc-text">{{ $sections->where('section_key', 'hero-stats-rating')->first()->title ?? '4.9' }} Rating</div><div class="fc-sub">{{ $sections->where('section_key', 'hero-stats-customers')->first()->subtitle ?? '15K+' }}</div></div>
  </div>
  <div class="floating-card fc-3">
    <div class="fc-icon">🚚</div>
    <div><div class="fc-text">Free Delivery</div><div class="fc-sub">On orders ৳1000+</div></div>
  </div>
  <div class="floating-card fc-4">
    <div class="fc-icon">🏆</div>
    <div><div class="fc-text">{{ $sections->where('section_key', 'hero-stats-years')->first()->title ?? '30+' }}</div><div class="fc-sub">{{ $sections->where('section_key', 'hero-stats-years')->first()->subtitle ?? 'Years' }}</div></div>
  </div>

  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 hero-content">
        @php $badge = $sections->where('section_key', 'hero-badge')->first(); @endphp
        @if($badge && $badge->is_active)
        <div class="section-badge mb-3 animate-on-scroll">
          <i class="fas {{ $badge->icon ?? 'fa-star' }} text-warning me-2"></i>{{ $badge->title }}
        </div>
        @else
        <div class="section-badge mb-3 animate-on-scroll">
          <i class="fas fa-star text-warning me-2"></i>Premium Quality Since 1995
        </div>
        @endif

        <h1 class="hero-title animate-on-scroll">
          {!! $hero->title !!}<br/>
          <span class="gradient-text">{{ $hero->subtitle }}</span>
        </h1>
        <p class="hero-sub animate-on-scroll">
          {!! $hero->content !!}
        </p>
        <div class="d-flex gap-3 flex-wrap animate-on-scroll">
          <a href="{{ $hero->button_url ?? route('shop') }}" class="btn btn-glow btn-lg px-4">
            <i class="fas fa-shopping-basket me-2"></i>{{ $hero->button_text }}
          </a>
          <a href="#about" class="btn btn-glass btn-lg px-4">
            <i class="fas fa-play-circle me-2"></i>Our Story
          </a>
        </div>
        
        <div class="hero-stats animate-on-scroll">
          @php $statProducts = $sections->where('section_key', 'hero-stats-products')->first(); @endphp
          @if($statProducts && $statProducts->is_active)
          <div class="stat-item">
            <span class="stat-num">{{ $statProducts->title }}</span>
            <span class="stat-label">{{ $statProducts->subtitle }}</span>
          </div>
          @endif
          
          @php $statCustomers = $sections->where('section_key', 'hero-stats-customers')->first(); @endphp
          @if($statCustomers && $statCustomers->is_active)
          <div class="stat-item">
            <span class="stat-num">{{ $statCustomers->title }}</span>
            <span class="stat-label">{{ $statCustomers->subtitle }}</span>
          </div>
          @endif
          
          @php $statYears = $sections->where('section_key', 'hero-stats-years')->first(); @endphp
          @if($statYears && $statYears->is_active)
          <div class="stat-item">
            <span class="stat-num">{{ $statYears->title }}</span>
            <span class="stat-label">{{ $statYears->subtitle }}</span>
          </div>
          @endif
          
          @php $statRating = $sections->where('section_key', 'hero-stats-rating')->first(); @endphp
          @if($statRating && $statRating->is_active)
          <div class="stat-item">
            <span class="stat-num">{{ $statRating->title }}</span>
            <span class="stat-label">{{ $statRating->subtitle }}</span>
          </div>
          @endif
        </div>
      </div>
      <div class="col-lg-6">
        <div class="hero-showcase animate-on-scroll">
          <div class="showcase-ring"></div>
          <div class="showcase-center">
            <div class="showcase-emoji">🎂</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@else
<!-- Default Hero Fallback -->
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6 hero-content">
        <h1 class="hero-title">
          Authentic Saffron<br/>
          <span class="gradient-text">Sweets & Bakery</span>
        </h1>
      </div>
    </div>
  </div>
</section>
@endif

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

@php $whoWeAre = $sections->where('section_key', 'who-we-are')->first(); @endphp
@if($whoWeAre && $whoWeAre->is_active)
<!-- WHO WE ARE / ABOUT -->
<section class="section-gap about-split" id="about">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <div class="about-image-container">
          <div class="glass-card-glow p-3 animate-on-scroll" style="height:100%;display:flex;align-items:center;justify-content:center;">
            <div style="font-size:12rem;">🏪</div>
          </div>
          <div class="about-image-float aif-1 glass-card text-center p-3">
            <div class="about-badge">👨‍🍳</div>
            <div class="about-counter">50+</div>
            <div style="font-size:.8rem;color:rgba(var(--theme-text-primary-rgb),0.6);">Expert Chefs</div>
          </div>
          <div class="about-image-float aif-2 glass-card text-center p-3">
            <div class="about-badge">🏆</div>
            <div class="about-counter">30+</div>
            <div style="font-size:.8rem;color:rgba(var(--theme-text-primary-rgb),0.6);">Awards Won</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <span class="section-badge animate-on-scroll">{{ $whoWeAre->title }}</span>
        <h2 class="section-title mt-3 animate-on-scroll">
          {!! $whoWeAre->title !!}<br/>
          <span class="gradient-text">{{ $whoWeAre->subtitle }}</span>
        </h2>
        <p class="mt-4 animate-on-scroll" style="color:rgba(var(--theme-text-primary-rgb),0.75);line-height:1.9;font-size:1.05rem;">
          {!! $whoWeAre->content !!}
        </p>
        @if($whoWeAre->button_url)
        <a href="{{ $whoWeAre->button_url }}" class="btn btn-glow mt-4 animate-on-scroll">
          <i class="fas fa-arrow-right me-2"></i>{{ $whoWeAre->button_text ?? 'Learn More' }}
        </a>
        @endif
      </div>
    </div>
  </div>
</section>
@endif

@php $specialty = $sections->where('section_key', 'specialty')->first(); @endphp
@if($specialty && $specialty->is_active)
<!-- SPECIALTY: BENGALI SWEETS -->
<section class="section-gap" style="background:linear-gradient(180deg, rgba(245,158,11,0.03), transparent);">
  <div class="container">
    <div class="text-center mb-5">
      @php $specialtySubtitle = $sections->where('section_key', 'specialty-subtitle')->first(); @endphp
      @if($specialtySubtitle && $specialtySubtitle->is_active)
      <span class="section-badge animate-on-scroll" style="background:linear-gradient(135deg,rgba(245,158,11,0.2),rgba(244,63,94,0.2));border-color:rgba(245,158,11,0.3);">
        <i class="fas {{ $specialtySubtitle->icon ?? 'fa-star' }} me-2"></i>{{ $specialtySubtitle->title }}
      </span>
      @else
      <span class="section-badge animate-on-scroll" style="background:linear-gradient(135deg,rgba(245,158,11,0.2),rgba(244,63,94,0.2));border-color:rgba(245,158,11,0.3);">
        <i class="fas fa-star me-2"></i>Premium Quality
      </span>
      @endif
      
      <h2 class="section-title mt-3 animate-on-scroll">{{ $specialty->title }}</h2>
      <p class="mt-3 animate-on-scroll" style="color:rgba(var(--theme-text-primary-rgb),0.6);max-width:600px;margin:0 auto;">
        {!! $specialty->content !!}
      </p>
    </div>

    <div class="row g-4">
      <div class="col-md-3 col-sm-6">
        <div class="glass-card p-4 text-center specialty-card animate-on-scroll">
          <div class="specialty-icon">🥛</div>
          <h6 style="color:var(--theme-text-primary);margin:1rem 0 0.5rem;">Pure Milk</h6>
          <p style="color:rgba(var(--theme-text-primary-rgb),0.6);font-size:0.9rem;">Farm fresh daily</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="glass-card p-4 text-center specialty-card animate-on-scroll">
          <div class="specialty-icon">🌸</div>
          <h6 style="color:var(--theme-text-primary);margin:1rem 0 0.5rem;">Real Saffron</h6>
          <p style="color:rgba(var(--theme-text-primary-rgb),0.6);font-size:0.9rem;">Kashmiri premium</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="glass-card p-4 text-center specialty-card animate-on-scroll">
          <div class="specialty-icon">♨️</div>
          <h6 style="color:var(--theme-text-primary);margin:1rem 0 0.5rem;">Fresh Daily</h6>
          <p style="color:rgba(var(--theme-text-primary-rgb),0.6);font-size:0.9rem;">Made every morning</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="glass-card p-4 text-center specialty-card animate-on-scroll">
          <div class="specialty-icon">📜</div>
          <h6 style="color:var(--theme-text-primary);margin:1rem 0 0.5rem;">Traditional</h6>
          <p style="color:rgba(var(--theme-text-primary-rgb),0.6);font-size:0.9rem;">Ancient recipes</p>
        </div>
      </div>
    </div>

    <div class="text-center mt-5">
      @if($specialty->button_url)
      <a href="{{ $specialty->button_url }}" class="btn btn-glow animate-on-scroll">
        <i class="fas fa-arrow-right me-2"></i>{{ $specialty->button_text ?? 'Explore Menu' }}
      </a>
      @endif
    </div>
  </div>
</section>
@endif

@php $chocolate = $sections->where('section_key', 'chocolate-paradise')->first(); @endphp
@if($chocolate && $chocolate->is_active)
<!-- CHOCOLATE PARADISE -->
<section class="specialty-section" style="background:linear-gradient(135deg, rgba(244,63,94,0.05), rgba(139,92,246,0.05));">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <div class="specialty-card animate-on-scroll" style="background:linear-gradient(135deg, rgba(244,63,94,0.1), rgba(168,85,247,0.1));">
          <div style="font-size:8rem;text-align:center;margin-bottom:1rem;">🍫</div>
          <h3 class="text-center" style="font-family:'Playfair Display',serif;color:var(--theme-text-secondary);">{{ $chocolate->title }}</h3>
          <p class="text-center" style="color:rgba(var(--theme-text-primary-rgb),0.7);">{{ $chocolate->subtitle }}</p>
        </div>
      </div>
      <div class="col-lg-6">
        <span class="section-badge animate-on-scroll" style="background:linear-gradient(135deg, rgba(244,63,94,0.2), rgba(168,85,247,0.2));border-color:rgba(244,63,94,0.3);">Chocolate Paradise</span>
        <h2 class="section-title mt-3 animate-on-scroll">
          {{ $chocolate->title }}<br/>
          <span class="gradient-text">{{ $chocolate->subtitle }}</span>
        </h2>
        <p class="mt-4 animate-on-scroll" style="color:rgba(var(--theme-text-primary-rgb),0.75);line-height:1.9;font-size:1.05rem;">
          {!! $chocolate->content !!}
        </p>
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
        @if($chocolate->button_url)
        <a href="{{ $chocolate->button_url }}" class="btn btn-glow mt-4 animate-on-scroll" style="background:linear-gradient(135deg, var(--theme-secondary), var(--theme-accent));">
          <i class="fas fa-heart me-2"></i>{{ $chocolate->button_text }}
        </a>
        @endif
      </div>
    </div>
  </div>
</section>
@endif

<!-- BROWSE CATEGORIES -->
@php $browseCategories = $sections->where('section_key', 'browse-categories')->first(); @endphp
@if($browseCategories && $browseCategories->is_active)
<section class="section-gap">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-badge animate-on-scroll">
        <i class="fas {{ $browseCategories->icon ?? 'fa-th-large' }} me-2"></i>Categories
      </span>
      <h2 class="section-title mt-3 animate-on-scroll">{{ $browseCategories->title }}</h2>
      <p class="mt-3 animate-on-scroll" style="color:rgba(var(--theme-text-primary-rgb),0.6);max-width:600px;margin:0 auto;">
        {!! $browseCategories->content !!}
      </p>
    </div>

    @if(isset($categories) && $categories->count() > 0)
    <div class="row g-4">
      @foreach($categories->take(8) as $category)
      <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="{{ route('shop.category', $category->slug) }}" class="text-decoration-none">
          <div class="category-card animate-on-scroll">
            <div class="category-icon">{{ $category->name_en[0] }}</div>
            <div class="category-info">
              <h5 style="color: var(--theme-text-primary);">{{ $category->name_en }}</h5>
              <p style="color: var(--text-60); font-size: 0.85rem;">{{ $category->products_count ?? 0 }} products</p>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @endif

    <div class="text-center mt-5">
      @if($browseCategories->button_url)
      <a href="{{ $browseCategories->button_url }}" class="btn btn-glass animate-on-scroll">
        <i class="fas fa-th-large me-2"></i>{{ $browseCategories->button_text }}
      </a>
      @endif
    </div>
  </div>
</section>
@endif

<!-- FEATURED PRODUCTS -->
@php $featuredTitle = $sections->where('section_key', 'featured-products-title')->first(); @endphp
@if($featuredTitle && $featuredTitle->is_active && isset($featuredProducts) && $featuredProducts->count() > 0)
<section class="section-gap">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-badge animate-on-scroll">
        <i class="fas fa-star text-warning me-2"></i>Featured
      </span>
      <h2 class="section-title mt-3 animate-on-scroll">{{ $featuredTitle->title }}</h2>
      <p class="mt-3 animate-on-scroll" style="color:rgba(var(--theme-text-primary-rgb),0.6);max-width:600px;margin:0-auto;">
        {!! $featuredTitle->subtitle ?? 'Our most popular items' !!}
      </p>
    </div>

    <div class="row g-4">
      @foreach($featuredProducts->take(8) as $index => $product)
      <div class="col-lg-3 col-md-4 col-sm-6">
        @include('frontend.partials.product-card', ['product' => $product, 'index' => $index])
      </div>
      @endforeach
    </div>

    <div class="text-center mt-5">
      @if($featuredTitle->button_url)
      <a href="{{ $featuredTitle->button_url }}" class="btn btn-glass animate-on-scroll">
        <i class="fas fa-arrow-right me-2"></i>{{ $featuredTitle->button_text }}
      </a>
      @endif
    </div>
  </div>
</section>
@endif

<!-- NEW ARRIVALS -->
@php $newArrivalsTitle = $sections->where('section_key', 'new-arrivals-title')->first(); @endphp
@if($newArrivalsTitle && $newArrivalsTitle->is_active && isset($newArrivals) && $newArrivals->count() > 0)
<section class="section-gap" style="background:linear-gradient(180deg, rgba(139,92,246,0.03), transparent);">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-badge animate-on-scroll" style="background:linear-gradient(135deg,rgba(139,92,246,0.2),rgba(59,130,246,0.2));border-color:rgba(139,92,246,0.3);">
        <i class="fas fa-sparkles me-2"></i>New
      </span>
      <h2 class="section-title mt-3 animate-on-scroll">{{ $newArrivalsTitle->title }}</h2>
      <p class="mt-3 animate-on-scroll" style="color:rgba(var(--theme-text-primary-rgb),0.6);max-width:600px;margin:0_auto;">
        {!! $newArrivalsTitle->subtitle ?? 'Just added to our menu' !!}
      </p>
    </div>

    <div class="row g-4">
      @foreach($newArrivals->take(4) as $index => $product)
      <div class="col-lg-3 col-md-6">
        @include('frontend.partials.product-card', ['product' => $product, 'index' => $index])
      </div>
      @endforeach
    </div>

    <div class="text-center mt-5">
      @if($newArrivalsTitle->button_url)
      <a href="{{ $newArrivalsTitle->button_url }}" class="btn btn-glow animate-on-scroll" style="background:linear-gradient(135deg, #8b5cf6, #6366f1);">
        <i class="fas fa-sparkles me-2"></i>{{ $newArrivalsTitle->button_text }}
      </a>
      @endif
    </div>
  </div>
</section>
@endif

<!-- BEST SELLERS -->
@php $bestSellersTitle = $sections->where('section_key', 'bestsellers-title')->first(); @endphp
@if(($bestSellersTitle && $bestSellersTitle->is_active) || (isset($bestSellers) && $bestSellers->count() > 0))
<section class="section-gap" style="background:linear-gradient(180deg, rgba(244,63,94,0.03), transparent);">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-badge animate-on-scroll" style="background:linear-gradient(135deg,rgba(244,63,94,0.2),rgba(245,158,11,0.2));border-color:rgba(244,63,94,0.3);">
        <i class="fas fa-fire me-2"></i>Top Rated
      </span>
      <h2 class="section-title mt-3 animate-on-scroll">
        Best 
        @if($bestSellersTitle)
          {{ $bestSellersTitle->title }}
        @else
          Sellers
        @endif
        <span id="sellers-text"></span>
      </h2>
      <p class="mt-3 animate-on-scroll" style="color:rgba(var(--theme-text-primary-rgb),0.6);max-width:600px;margin:0 auto;">
        Our most loved products that customers keep coming back for
      </p>
    </div>

    @if(isset($bestSellers) && $bestSellers->count() > 0)
    <div class="row g-4">
      @foreach($bestSellers as $index => $product)
      <div class="col-lg-4 col-md-6">
        <a href="{{ route('shop.product', $product->slug) }}" class="text-decoration-none">
          <div class="prod-card prod-item animate-on-scroll" style="border:1px solid rgba(245,158,11,{{ $index === 0 ? '0.3' : '0.2' }});">
            <div class="prod-img-wrapper">
              @if($product->image)
                <img src="{{ asset("storage/{$product->image}") }}" alt="{{ $product->name }}">
              @else
                <div class="prod-img-placeholder">
                  <i class="fas fa-cookie-bite"></i>
                </div>
              @endif
              <span class="prod-badge badge-hot" style="background:linear-gradient(135deg,{{ $index === 0 ? '#f43f5e,#e11d48' : ($index === 1 ? '#f59e0b,#d97706' : '#8b5cf6,#7c3aed') }});">#{{ $index + 1 }}</span>
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
                <button class="add-btn" onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price ?? $product->price }}, '{{ $product->image ?? '' }}', event)"><i class="fas fa-plus"></i></button>
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
    </div>
    @endif
  </div>
</section>
@endif

<!-- TESTIMONIALS -->
@php $testimonialsTitle = $sections->where('section_key', 'testimonials')->first(); @endphp
@if($testimonialsTitle && $testimonialsTitle->is_active)
<section class="section-gap testimonials-section" style="background:linear-gradient(180deg, rgba(139,92,246,0.03), transparent);">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-badge animate-on-scroll" style="background:linear-gradient(135deg,rgba(139,92,246,0.2),rgba(59,130,246,0.2));border-color:rgba(139,92,246,0.3);">
        <i class="fas {{ $testimonialsTitle->icon ?? 'fa-comments' }} me-2"></i>Reviews
      </span>
      <h2 class="section-title mt-3 animate-on-scroll">{{ $testimonialsTitle->title }}</h2>
      <p class="mt-3 animate-on-scroll" style="color:rgba(var(--theme-text-primary-rgb),0.6);max-width:600px;margin:0 auto;">
        {!! $testimonialsTitle->content !!}
      </p>
    </div>

    @if(isset($reviews) && $reviews->count() > 0)
    <div class="row g-4">
      @foreach($reviews as $review)
      <div class="col-md-4">
        <div class="testimonial-card animate-on-scroll">
          <div class="testimonial-header">
            @if($review->user && $review->user->avatar)
              <img src="{{ asset('storage/avatars/' . $review->user->avatar) }}" alt="{{ $review->user->name }}" class="testimonial-avatar">
            @else
              <div class="testimonial-avatar">{{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}</div>
            @endif
            <div class="testimonial-info">
              <h6 style="color: var(--theme-text-primary);">{{ $review->user->name }}</h6>
              <div class="testimonial-stars">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</div>
            </div>
          </div>
          <p style="color: var(--text-70); line-height: 1.8; font-style: italic;">
            "{{ $review->comment }}"
          </p>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>
@endif

@endsection

@push('scripts')
<script>
// Sellers text animation
const sellersWords = ['Sellers', 'Products', 'Deals', 'Offers'];
let sellersWordIndex = 0;
let sellersCharIndex = 0;
let sellersIsDeleting = false;
const sellersElement = document.getElementById('sellers-text');

if (sellersElement) {
    function typeSellersText() {
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
            typeSpeed = 2000;
            sellersIsDeleting = true;
        } else if (sellersIsDeleting && sellersCharIndex === 0) {
            sellersIsDeleting = false;
            sellersWordIndex = (sellersWordIndex + 1) % sellersWords.length;
            typeSpeed = 500;
        }

        setTimeout(typeSellersText, typeSpeed);
    }
    setTimeout(typeSellersText, 1000);
}
</script>
@endpush
