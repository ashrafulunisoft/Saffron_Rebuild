@extends('frontend.layouts.app')

@section('title', 'Contact - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb-glass">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #f59e0b; text-decoration: none;">Home</a></li>
        <li class="breadcrumb-item active" style="color: #f5e6cc;">Contact</li>
      </ol>
    </nav>

    <div class="row g-5">
      <!-- Contact Form -->
      <div class="col-lg-6">
        <div class="glass-card p-4">
          <h4 style="color: #f5e6cc; margin-bottom: 1.5rem;">
            <i class="fas fa-envelope me-2" style="color: #fbbf24;"></i>Get in Touch
          </h4>
          <form>
            <div class="mb-3">
              <label class="form-label">Your Name</label>
              <input type="text" name="name" class="form-control input-dark" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control input-dark" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Subject</label>
              <input type="text" name="subject" class="form-control input-dark" placeholder="What is this about?">
            </div>
            <div class="mb-3">
              <label class="form-label">Message</label>
              <textarea name="message" class="form-control input-dark" rows="5" placeholder="Type your message here..." required></textarea>
            </div>
            <button type="submit" class="btn btn-glow">
              <i class="fas fa-paper-plane me-2"></i>Send Message
            </button>
          </form>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="col-lg-6">
        <div class="glass-card p-4 mb-4">
          <h4 style="color: #f5e6cc; margin-bottom: 1.5rem;">
            <i class="fas fa-map-marker-alt me-2" style="color: #fbbf24;"></i>Contact Information
          </h4>

          <div class="d-flex gap-3 mb-4">
            <div style="width: 50px; height: 50px; background: rgba(245,158,11,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="fas fa-phone" style="color: #fbbf24;"></i>
            </div>
            <div>
              <h6 style="color: #f5e6cc; margin-bottom: 0.25rem;">Phone</h6>
              <p style="color: rgba(245,230,204,0.7); margin: 0;">+880 1730 702000</p>
            </div>
          </div>

          <div class="d-flex gap-3 mb-4">
            <div style="width: 50px; height: 50px; background: rgba(245,158,11,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="fas fa-envelope" style="color: #fbbf24;"></i>
            </div>
            <div>
              <h6 style="color: #f5e6cc; margin-bottom: 0.25rem;">Email</h6>
              <p style="color: rgba(245,230,204,0.7); margin: 0;">info@saffronsweets.com.bd</p>
            </div>
          </div>

          <div class="d-flex gap-3">
            <div style="width: 50px; height: 50px; background: rgba(245,158,11,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="fas fa-clock" style="color: #fbbf24;"></i>
            </div>
            <div>
              <h6 style="color: #f5e6cc; margin-bottom: 0.25rem;">Business Hours</h6>
              <p style="color: rgba(245,230,204,0.7); margin: 0;">Mon - Sat: 9AM - 9PM<br>Sunday: 10AM - 6PM</p>
            </div>
          </div>
        </div>

        <!-- Social Links -->
        <div class="glass-card p-4">
          <h5 style="color: #f5e6cc; margin-bottom: 1rem;">Follow Us</h5>
          <div class="d-flex gap-2">
            <a href="#" class="btn btn-glass" style="color: #fbbf24;"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="btn btn-glass" style="color: #fbbf24;"><i class="fab fa-instagram"></i></a>
            <a href="#" class="btn btn-glass" style="color: #fbbf24;"><i class="fab fa-twitter"></i></a>
            <a href="#" class="btn btn-glass" style="color: #fbbf24;"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
