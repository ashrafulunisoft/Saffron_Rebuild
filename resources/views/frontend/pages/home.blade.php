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
            <div class="showcase-emoji">🎂</div>
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
            <div style="font-size:12rem;">🏪</div>
          </div>
          <div class="about-image-float aif-1 glass-card text-center p-3">
            <div class="about-badge">👨‍🍳</div>
            <div class="about-counter">50+</div>
            <div style="font-size:.8rem;color:rgba(245,230,204,0.6);">Expert Chefs</div>
          </div>
          <div class="about-image-float aif-2 glass-card text-center p-3">
            <div class="about-badge">🏆</div>
            <div class="about-counter">30+</div>
            <div style="font-size:.8rem;color:rgba(245,230,204,0.6);">Awards Won</div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <span class="section-badge animate-on-scroll">Who We Are</span>
        <h2 class="section-title mt-3 animate-on-scroll">
          Authentic Saffron<br/>
          <span class="gradient-text">Sweets & Traditional Bakery</span>
        </h2>
        <p class="mt-4 animate-on-scroll" style="color:rgba(245,230,204,0.75);line-height:1.9;font-size:1.05rem;">
          Welcome to Saffron, where tradition meets excellence. We bring you the finest collection of authentic Bengali sweets and premium bakery items, crafted with love and the purest saffron.
        </p>
        <p class="animate-on-scroll" style="color:rgba(245,230,204,0.7);line-height:1.9;">
          Our skilled artisans use time-honored recipes passed down through generations to create mouth-watering treats that will transport you to the streets of Bangladesh. From roshogolla to sandesh, from freshly baked cakes to artisan cookies – every bite is a celebration of flavor.
        </p>
        <div class="feature-list animate-on-scroll">
          <div class="feature-item">
            <div class="feature-icon-box">✓</div>
            <div><strong style="color:#f5e6cc;">100% Natural Ingredients</strong><br/><small style="color:rgba(245,230,204,0.5);">No preservatives, no artificial colors</small></div>
          </div>
          <div class="feature-item">
            <div class="feature-icon-box">👨‍🍳</div>
            <div><strong style="color:#f5e6cc;">Expert Chefs</strong><br/><small style="color:rgba(245,230,204,0.5);">Skilled artisans with decades of experience</small></div>
          </div>
          <div class="feature-item">
            <div class="feature-icon-box">🚚</div>
            <div><strong style="color:#f5e6cc;">Fast Delivery</strong><br/><small style="color:rgba(245,230,204,0.5);">Quick & safe delivery to your doorstep</small></div>
          </div>
          <div class="feature-item">
            <div class="feature-icon-box">💝</div>
            <div><strong style="color:#f5e6cc;">Made with Love</strong><br/><small style="color:rgba(245,230,204,0.5);">Crafted with passion and care</small></div>
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
          <div style="font-size:8rem;text-align:center;margin-bottom:1rem;">🍮</div>
          <h3 class="text-center" style="font-family:'Playfair Display',serif;color:#fbbf24;">Authentic Bengali Sweets</h3>
          <p class="text-center" style="color:rgba(245,230,204,0.7);">Indulge in the rich heritage of Bengal</p>
        </div>
      </div>
      <div class="col-lg-6 order-lg-1">
        <span class="section-badge animate-on-scroll">Our Specialty</span>
        <h2 class="section-title mt-3 animate-on-scroll">
          Authentic Bengali<br/>
          <span class="gradient-text">Sweets Collection</span>
        </h2>
        <p class="mt-4 animate-on-scroll" style="color:rgba(245,230,204,0.75);line-height:1.9;">
          Indulge in the rich heritage of Bengal with our exquisite collection of traditional sweets, crafted with love and the finest ingredients.
        </p>
        <p class="animate-on-scroll" style="color:rgba(245,230,204,0.7);line-height:1.9;">
          From the melt-in-your-mouth roshogolla to the delicate sandesh, our sweets are made using recipes passed down through generations. Each sweet is a celebration of authentic Bengali tradition, bringing you the true taste of home.
        </p>
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
        <a href="{{ route('shop.category', 'bengali-sweets') }}" class="btn btn-glow mt-4 animate-on-scroll">
          Discover Sweets <i class="fas fa-arrow-right ms-2"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- FEATURED PRODUCTS -->
<section class="section-gap" id="products">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-badge">Our Collection</span>
      <h2 class="section-title mt-3">
        Featured <span class="gradient-text">Products</span>
      </h2>
      <p style="color:rgba(245,230,204,0.7);">Handpicked favorites from our extensive collection</p>
    </div>

    <!-- Category Filters -->
    <div class="d-flex justify-content-center gap-2 mb-4 flex-wrap">
      <button class="filter-btn active" onclick="filterProd(this, 'all')">All Products</button>
      <button class="filter-btn" onclick="filterProd(this, 'bengali-sweets')">Bengali Sweets</button>
      <button class="filter-btn" onclick="filterProd(this, 'bakery')">Bakery</button>
      <button class="filter-btn" onclick="filterProd(this, 'cakes')">Cakes</button>
      <button class="filter-btn" onclick="filterProd(this, 'chocolates')">Chocolates</button>
    </div>

    <!-- Products Grid -->
    <div class="row g-4">
      @if(isset($featuredProducts) && $featuredProducts->count() > 0)
        @foreach($featuredProducts as $product)
        <div class="col-6 col-md-4 col-lg-3">
          <div class="product-card glass-card prod-item" data-cat="{{ $product->category->slug ?? 'bengali-sweets' }}">
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
                <span style="color:#fbbf24;">★★★★★</span>
                <small style="color:rgba(245,230,204,0.5);">({{ $product->reviews_count ?? 0 }})</small>
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
            <a href="{{ route('product.show', $product->slug) }}" class="prod-link"></a>
          </div>
        </div>
        @endforeach
      @else
        <!-- Demo products if no products available -->
        <div class="col-6 col-md-4 col-lg-3">
          <div class="product-card glass-card prod-item" data-cat="bengali-sweets">
            <div class="prod-badges">
              <span class="badge badge-sale">Bestseller</span>
            </div>
            <div class="prod-img">
              <div style="font-size: 4rem;">🍮</div>
            </div>
            <div class="prod-info">
              <span class="prod-cat">Bengali Sweets</span>
              <h6 class="prod-name">Premium Roshogolla</h6>
              <div class="prod-rating">
                <span style="color:#fbbf24;">★★★★★</span>
                <small style="color:rgba(245,230,204,0.5);">(128)</small>
              </div>
              <div class="prod-price">
                <span class="current-price">৳450</span>
              </div>
              <div class="prod-actions">
                <button class="btn-wishlist"><i class="far fa-heart"></i></button>
                <button class="btn-cart"><i class="fas fa-shopping-bag"></i></button>
              </div>
            </div>
          </div>
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
    </div>
  </div>
</section>

<!-- NEWSLETTER -->
<section class="section-gap">
  <div class="container">
    <div class="newsletter-card glass-card-glow text-center">
      <div style="font-size: 3rem; margin-bottom: 1rem;">📧</div>
      <h2 style="font-family:'Playfair Display',serif;color:#f5e6cc;">Stay Sweet with Updates</h2>
      <p style="color:rgba(245,230,204,0.7);margin-bottom:2rem;">Subscribe to get exclusive offers, new arrivals, and sweet surprises!</p>
      <form class="newsletter-form" style="max-width:500px;margin:0 auto;">
        <div class="input-group">
          <input type="email" class="form-control" placeholder="Enter your email" style="border-radius:12px 0 0 12px;padding:1rem;">
          <button class="btn btn-glow" type="submit" style="border-radius:0 12px 12px 0;padding:0 2rem;">Subscribe</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
// Product filter
function filterProd(btn, cat) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.prod-item').forEach(item => {
        item.style.display = (cat === 'all' || item.dataset.cat === cat) ? 'block' : 'none';
        if (item.style.display === 'block') {
            item.style.animation = 'fadeIn .5s ease';
        }
    });
}

// Scroll animation
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-in');
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
</script>
@endpush
