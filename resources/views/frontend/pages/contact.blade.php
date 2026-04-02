@extends('frontend.layouts.app')

@section('title', 'Contact - Saffron Sweets & Bakery')

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
          <i class="fas fa-envelope me-1"></i>Contact
        </li>
      </ol>
    </nav>

    <div class="row g-5">
      <!-- Contact Form -->
      <div class="col-lg-6">
        <div class="glass-card p-4">
          <h4 style="color: var(--theme-text-primary); margin-bottom: 1.5rem;">
            <i class="fas fa-envelope me-2" style="color: var(--theme-text-secondary);"></i>Get in Touch
          </h4>

          @if(session('success'))
            <div class="alert alert-success" style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac; margin-bottom: 1.5rem;">
              <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
          @endif

          <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">Your Name</label>
              <input type="text" name="name" class="form-control input-dark" placeholder="Enter your name" value="{{ old('name') }}" required>
              @error('name')
                <div class="text-danger" style="color: #f43f5e; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control input-dark" placeholder="Enter your email" value="{{ old('email') }}" required>
              @error('email')
                <div class="text-danger" style="color: #f43f5e; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Subject</label>
              <input type="text" name="subject" class="form-control input-dark" placeholder="What is this about?" value="{{ old('subject') }}">
              @error('subject')
                <div class="text-danger" style="color: #f43f5e; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Message</label>
              <textarea name="message" class="form-control input-dark" rows="5" placeholder="Type your message here..." required>{{ old('message') }}</textarea>
              @error('message')
                <div class="text-danger" style="color: #f43f5e; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-glow">
              <i class="fas fa-paper-plane me-2"></i>Send Message
            </button>
          </form>
        </div>
      </div>

      <!-- Contact Info -->
      <div class="col-lg-6">
        @if($cmsSections && isset($cmsSections['contact_info']))
        <div class="glass-card p-4 mb-4">
          <h4 style="color: var(--theme-text-primary); margin-bottom: 1.5rem;">
            <i class="fas fa-map-marker-alt me-2" style="color: var(--theme-text-secondary);"></i>{!! $cmsSections['contact_info']->title_en ?? 'Contact Information' !!}
          </h4>

          @php
            $contactContent = $cmsSections['contact_info']->content_en;
            $lines = explode("\n", trim($contactContent));
            $contactItems = [];

            // Parse content in groups of 3: label, icon/identifier, value
            $nonEmptyLines = array_values(array_filter($lines, function($line) {
                return trim($line) !== '';
            }));

            for ($i = 0; $i < count($nonEmptyLines); $i += 2) {
                if (isset($nonEmptyLines[$i + 1])) {
                    $label = trim($nonEmptyLines[$i]);
                    $value = trim($nonEmptyLines[$i + 1]);

                    // Map labels to icons
                    $iconMap = [
                        'phone' => 'fa-phone',
                        'email' => 'fa-envelope',
                        'business hours' => 'fa-clock',
                        'address' => 'fa-map-marker-alt'
                    ];

                    $icon = $iconMap[strtolower($label)] ?? 'fa-info-circle';

                    $contactItems[] = [
                        'label' => $label,
                        'value' => $value,
                        'icon' => $icon
                    ];
                }
            }
          @endphp

          @foreach($contactItems as $item)
          <div class="d-flex gap-3 mb-4">
            <div style="width: 50px; height: 50px; background: rgba(245,158,11,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="fas {{ $item['icon'] }}" style="color: var(--theme-text-secondary);"></i>
            </div>
            <div>
              <h6 style="color: var(--theme-text-primary); margin-bottom: 0.25rem;">{{ ucfirst($item['label']) }}</h6>
              <p style="color: var(--text-70); margin: 0;">{!! nl2br($item['value']) !!}</p>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <div class="glass-card p-4 mb-4">
          <h4 style="color: var(--theme-text-primary); margin-bottom: 1.5rem;">
            <i class="fas fa-map-marker-alt me-2" style="color: var(--theme-text-secondary);"></i>Contact Information
          </h4>

          <div class="d-flex gap-3 mb-4">
            <div style="width: 50px; height: 50px; background: rgba(245,158,11,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="fas fa-phone" style="color: var(--theme-text-secondary);"></i>
            </div>
            <div>
              <h6 style="color: var(--theme-text-primary); margin-bottom: 0.25rem;">Phone</h6>
              <p style="color: var(--text-70); margin: 0;">+880 1730 702000</p>
            </div>
          </div>

          <div class="d-flex gap-3 mb-4">
            <div style="width: 50px; height: 50px; background: rgba(245,158,11,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="fas fa-envelope" style="color: var(--theme-text-secondary);"></i>
            </div>
            <div>
              <h6 style="color: var(--theme-text-primary); margin-bottom: 0.25rem;">Email</h6>
              <p style="color: var(--text-70); margin: 0;">info@saffronsweets.com.bd</p>
            </div>
          </div>

          <div class="d-flex gap-3">
            <div style="width: 50px; height: 50px; background: rgba(245,158,11,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
              <i class="fas fa-clock" style="color: var(--theme-text-secondary);"></i>
            </div>
            <div>
              <h6 style="color: var(--theme-text-primary); margin-bottom: 0.25rem;">Business Hours</h6>
              <p style="color: var(--text-70); margin: 0;">Mon - Sat: 9AM - 9PM<br>Sunday: 10AM - 6PM</p>
            </div>
          </div>
        </div>
        @endif

        <!-- Social Links -->
        @if($cmsSections && isset($cmsSections['social_links']) && $cmsSections['social_links']->content_en)
        @php
            $socialContent = $cmsSections['social_links']->content_en;
            $lines = explode("\n", trim($socialContent));
            $socialLinks = [];

            // Filter out empty lines and create platform-url pairs
            $nonEmptyLines = array_values(array_filter($lines, function($line) {
                return trim($line) !== '';
            }));

            for ($i = 0; $i < count($nonEmptyLines); $i += 2) {
                if (isset($nonEmptyLines[$i + 1])) {
                    $socialLinks[] = [
                        'platform' => trim($nonEmptyLines[$i]),
                        'url' => trim($nonEmptyLines[$i + 1])
                    ];
                }
            }

            $iconMap = [
                'facebook' => 'fa-facebook-f',
                'instagram' => 'fa-instagram',
                'twitter' => 'fa-twitter',
                'youtube' => 'fa-youtube',
                'linkedin' => 'fa-linkedin-in',
                'tiktok' => 'fa-tiktok'
            ];
        @endphp
        <div class="glass-card p-4">
          <h5 style="color: var(--theme-text-primary); margin-bottom: 1rem;">{!! $cmsSections['social_links']->title_en ?? 'Follow Us' !!}</h5>
          <div class="d-flex gap-2">
            @foreach($socialLinks as $social)
            @php
                $platformLower = strtolower($social['platform']);
                $iconClass = $iconMap[$platformLower] ?? 'fa-link';
            @endphp
            <a href="{{ $social['url'] }}" target="_blank" class="btn btn-glass" style="color: var(--theme-text-secondary);">
              <i class="fab {{ $iconClass }}"></i>
            </a>
            @endforeach
          </div>
        </div>
        @else
        <div class="glass-card p-4">
          <h5 style="color: var(--theme-text-primary); margin-bottom: 1rem;">Follow Us</h5>
          <div class="d-flex gap-2">
            <a href="#" class="btn btn-glass" style="color: var(--theme-text-secondary);"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="btn btn-glass" style="color: var(--theme-text-secondary);"><i class="fab fa-instagram"></i></a>
            <a href="#" class="btn btn-glass" style="color: var(--theme-text-secondary);"><i class="fab fa-twitter"></i></a>
            <a href="#" class="btn btn-glass" style="color: var(--theme-text-secondary);"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
        @endif
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