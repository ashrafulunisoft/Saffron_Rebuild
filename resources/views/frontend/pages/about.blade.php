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
      <span class="section-badge">Our Story</span>
      <h1 class="hero-title mt-3">
        About <span class="gradient-text">Saffron</span>
      </h1>
      <p style="color: rgba(245,230,204,0.7); max-width: 600px; margin: 0 auto;">
        Three generations of handcrafted sweetness, made with love and served with joy since 1995.
      </p>
    </div>

    <!-- Story Section -->
    <div class="row g-5 align-items-center mb-5">
      <div class="col-lg-6">
        <div class="glass-card-glow p-3 text-center" style="height: 100%;">
          <div style="font-size: 10rem;">🏪</div>
        </div>
      </div>
      <div class="col-lg-6">
        <h3 style="color: #f5e6cc; margin-bottom: 1.5rem;">Our Heritage</h3>
        <p style="color: rgba(245,230,204,0.75); line-height: 1.9; margin-bottom: 1rem;">
          Welcome to Saffron, where tradition meets excellence. Founded in 1995, we've been serving the finest authentic Bengali sweets and premium bakery items for over three decades.
        </p>
        <p style="color: rgba(245,230,204,0.7); line-height: 1.9;">
          What started as a small family business has grown into one of the most beloved sweet shops in Bangladesh. Our skilled artisans use time-honored recipes passed down through generations to create treats that bring joy to thousands of customers every day.
        </p>
      </div>
    </div>

    <!-- Values -->
    <div class="row g-4 mb-5">
      <div class="col-md-3">
        <div class="glass-card p-4 text-center">
          <div style="font-size: 3rem; margin-bottom: 1rem;">✨</div>
          <h5 style="color: #fbbf24;">Quality</h5>
          <p style="color: rgba(245,230,204,0.7); font-size: 0.9rem;">Only the finest ingredients</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="glass-card p-4 text-center">
          <div style="font-size: 3rem; margin-bottom: 1rem;">👨‍🍳</div>
          <h5 style="color: #fbbf24;">Tradition</h5>
          <p style="color: rgba(245,230,204,0.7); font-size: 0.9rem;">Authentic recipes</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="glass-card p-4 text-center">
          <div style="font-size: 3rem; margin-bottom: 1rem;">💝</div>
          <h5 style="color: #fbbf24;">Passion</h5>
          <p style="color: rgba(245,230,204,0.7); font-size: 0.9rem;">Made with love</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="glass-card p-4 text-center">
          <div style="font-size: 3rem; margin-bottom: 1rem;">🏆</div>
          <h5 style="color: #fbbf24;">Excellence</h5>
          <p style="color: rgba(245,230,204,0.7); font-size: 0.9rem;">30+ years of trust</p>
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
</style>
@endpush