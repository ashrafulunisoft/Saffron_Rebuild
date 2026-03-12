@extends('frontend.layouts.app')

@section('title', 'About - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb-glass">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #f59e0b; text-decoration: none;">Home</a></li>
        <li class="breadcrumb-item active" style="color: #f5e6cc;">About Us</li>
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
