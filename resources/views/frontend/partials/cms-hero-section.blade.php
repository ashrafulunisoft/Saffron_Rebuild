@php
    $heroSection = isset($sections) ? $sections->where('section_key', 'hero')->first() : null;
    $title = $heroSection ? $heroSection->title : 'Authentic Saffron';
    $subtitle = $heroSection ? $heroSection->subtitle : 'Sweets & Bakery';
    $content = $heroSection ? $heroSection->content : 'Indulge in the rich heritage of Bengal with our exquisite collection of traditional sweets and premium bakery items.';
    $buttonText = $heroSection ? $heroSection->button_text : 'Shop Now';
    $buttonText2 = $heroSection && isset($heroSection->button_text_en) ? 'Our Story' : 'Our Story';
@endphp

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
          {!! $title !!}<br/>
          <span class="gradient-text">{{ $subtitle }}</span>
        </h1>
        <p class="hero-sub animate-on-scroll">
          {!! $content !!}
        </p>
        <div class="d-flex gap-3 flex-wrap animate-on-scroll">
          <a href="{{ $heroSection->button_url ?? route('shop') }}" class="btn btn-glow btn-lg px-4">
            <i class="fas fa-shopping-basket me-2"></i>{{ $buttonText }}
          </a>
          <a href="#about" class="btn btn-glass btn-lg px-4">
            <i class="fas fa-play-circle me-2"></i>{{ $buttonText2 }}
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
