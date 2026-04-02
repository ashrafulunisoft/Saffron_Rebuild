@extends('frontend.layouts.app')

@section('title', 'About - Saffron Sweets & Bakery')

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
        <li class="breadcrumb-item active">
          <i class="fas fa-info-circle me-1"></i>About Us
        </li>
      </ol>
    </nav>

    <!-- Hero Section -->
    <div class="text-center mb-5">
      @if($cmsSections && isset($cmsSections['our_story']))
        <span class="section-badge">{{ $cmsSections['our_story']->title_en ?? 'Our Story' }}</span>
        <h1 class="hero-title mt-3">
          {!! $cmsSections['our_story']->subtitle_en ?? 'About <span class="gradient-text">Saffron</span>' !!}
        </h1>
        @if($cmsSections['our_story']->content_en)
        <p style="color: var(--text-70); max-width: 600px; margin: 0 auto;">
          {!! Str::limit(strip_tags($cmsSections['our_story']->content_en), 150) !!}
        </p>
        @endif
      @endif
    </div>

    <!-- Our Beginning Section -->
    @if($cmsSections && isset($cmsSections['our_beginning']))
    <div class="row g-5 align-items-center mb-5">
      <div class="col-lg-6">
        <div class="glass-card-glow p-3 text-center animate-on-scroll" style="height: 100%;">
          <div style="font-size: 10rem;" class="animate-on-scroll">
            {{ $cmsSections['our_beginning']->icon ?? '🏠' }}
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <h3 class="animate-on-scroll" style="color: var(--theme-text-primary); margin-bottom: 1.5rem;">
          {!! $cmsSections['our_beginning']->title_en ?? 'Our Beginning' !!}
        </h3>
        <p style="color: var(--text-75); line-height: 1.9; margin-bottom: 1rem;">
          {!! $cmsSections['our_beginning']->subtitle_en ?? 'Where Tradition Meets Excellence' !!}
        </p>
        <p class="animate-on-scroll" style="color: var(--text-75); line-height: 1.9; margin-bottom: 1rem;">
          {!! $cmsSections['our_beginning']->content_en !!}
        </p>
      </div>
    </div>
    @endif

    <!-- Heritage Section -->
    @if($cmsSections && isset($cmsSections['our_heritage']))
    <div class="row g-5 align-items-center mb-5">
      <div class="col-lg-6 order-lg-2">
        <div class="glass-card-glow p-3 text-center animate-on-scroll" style="height: 100%;">
          <div style="font-size: 10rem;" class="animate-on-scroll">
            {{ $cmsSections['our_heritage']->icon ?? '🏛️' }}
          </div>
        </div>
      </div>
      <div class="col-lg-6 order-lg-1">
        <h3 class="animate-on-scroll" style="color: var(--theme-text-primary); margin-bottom: 1.5rem;">
          {!! $cmsSections['our_heritage']->title_en ?? 'Our Heritage' !!}
        </h3>
        <p style="color: var(--text-75); line-height: 1.9; margin-bottom: 1rem;">
          {!! $cmsSections['our_heritage']->subtitle_en ?? 'Three Generations of Excellence' !!}
        </p>
        <p class="animate-on-scroll" style="color: var(--text-70); line-height: 1.9;">
          {!! $cmsSections['our_heritage']->content_en ?? 'Our heritage content.' !!}
        </p>
      </div>
    </div>
    @endif

    <!-- Core Values Section -->
    @if($cmsSections && isset($cmsSections['our_core_values']))
    <div class="text-center mb-5 animate-on-scroll">
      <h2 style="color: var(--theme-text-primary); margin-bottom: 1rem;">
        {!! $cmsSections['our_core_values']->title_en ?? 'Our Core Values' !!}
      </h2>
      @if($cmsSections['our_core_values']->subtitle_en)
      <p style="color: var(--text-75); max-width: 700px; margin: 0 auto 2rem auto;">
        {!! $cmsSections['our_core_values']->subtitle_en !!}
      </p>
      @endif
    </div>
    @endif

    <!-- Value Cards -->
    <div class="row g-4 mb-5">
      <div class="col-md-3">
        <div class="glass-card p-4 text-center animate-on-scroll">
          <div style="font-size: 3rem; margin-bottom: 1rem;">✨</div>
          <h5 style="color: var(--theme-text-secondary);">Quality</h5>
          <p style="color: var(--text-70); font-size: 0.9rem;">Only the finest ingredients</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="glass-card p-4 text-center animate-on-scroll">
          <div style="font-size: 3rem; margin-bottom: 1rem;">👨‍🍳</div>
          <h5 style="color: var(--theme-text-secondary);">Tradition</h5>
          <p style="color: var(--text-70); font-size: 0.9rem;">Authentic recipes</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="glass-card p-4 text-center animate-on-scroll">
          <div style="font-size: 3rem; margin-bottom: 1rem;">💝</div>
          <h5 style="color: var(--theme-text-secondary);">Passion</h5>
          <p style="color: var(--text-70); font-size: 0.9rem;">Made with love</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="glass-card p-4 text-center animate-on-scroll">
          <div style="font-size: 3rem; margin-bottom: 1rem;">🏆</div>
          <h5 style="color: var(--theme-text-secondary);">Excellence</h5>
          <p style="color: var(--text-70); font-size: 0.9rem;">30+ years of trust</p>
        </div>
      </div>
    </div>
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
  background: var(--theme-menu-hover);
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
  color: var(--theme-text-secondary);
  transform: translateX(3px);
}

.breadcrumb-modern .breadcrumb-item.active {
  color: var(--theme-text-primary);
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
</style>
@endpush