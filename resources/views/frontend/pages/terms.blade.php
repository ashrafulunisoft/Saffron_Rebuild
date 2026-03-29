@extends('frontend.layouts.app')

@section('title', $page->title . ' - Saffron Sweets & Bakery')

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
          <i class="fas fa-file-contract me-1"></i>{{ $page->title }}
        </li>
      </ol>
    </nav>

    <!-- Terms Content -->
    <div class="glass-card p-4">
      <h2 class="text-center mb-4" style="color: #f5e6cc;">
        <i class="fas fa-file-contract me-2" style="color: #fbbf24;"></i>{{ $page->title }}
      </h2>

      @if($page->sections && count($page->sections) > 0)
        <!-- CMS Sections -->
        @foreach($page->sections->sortBy('sort_order') as $index => $section)
        <div class="policy-section">
          <h4 style="color: #fbbf24; margin-bottom: 1rem;">
            @if($section->icon)
            <span style="margin-right: 0.5rem;">{{ $section->icon }}</span>
            @endif
            {{ $index + 1 }}. {!! $section->title_en !!}
          </h4>
          @if($section->section_key == 'terms_contact')
            @php
              $content = $section->content_en;
              $parts = explode("\n\n", trim($content));
              $intro = $parts[0] ?? '';
              $contacts = $parts[1] ?? '';
            @endphp
            @if($intro)
            <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
              {!! $intro !!}
            </p>
            @endif
            @if($contacts)
            <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
              @foreach(explode("\n", trim($contacts)) as $line)
                @if(trim($line) && strpos($line, '|') !== false)
                  @php
                    $cols = explode('|', trim($line));
                    $label = trim($cols[0] ?? '');
                    $value = trim($cols[1] ?? '');
                  @endphp
                  @if($label && $value)
                    <i class="fas fa-{{ $label == 'Email' ? 'envelope' : 'phone' }} me-2" style="color: #fbbf24;"></i>{{ $label }}: {{ $value }}<br>
                  @endif
                @endif
              @endforeach
            </p>
            @endif
          @else
            <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
              {!! $section->content_en !!}
            </p>
          @endif
        </div>
        @endforeach

        <p style="color: rgba(245,230,204,0.6); text-align: center; margin-top: 2rem; font-size: 0.9rem;">
          Last Updated: March 2026
        </p>
      @else
        <!-- Default Content -->
        <div class="policy-section">
          <h4 style="color: #fbbf24; margin-bottom: 1rem;">1. Acceptance of Terms</h4>
          <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
            By accessing and using the Saffron Sweets & Bakery website, you accept and agree to be bound by the terms and provisions of this agreement. If you do not agree to abide by these terms, please do not use this service.
          </p>
        </div>

        <div class="policy-section">
          <h4 style="color: #fbbf24; margin-bottom: 1rem;">2. Products and Services</h4>
          <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
            All products displayed on our website are subject to availability. We reserve the right to discontinue any product at any time. We strive to provide accurate product descriptions and images, but we do not warrant that descriptions are error-free.
          </p>
        </div>

        <div class="policy-section">
          <h4 style="color: #fbbf24; margin-bottom: 1rem;">3. Pricing and Payment</h4>
          <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
            All prices are in BDT (Bangladeshi Taka) and are subject to change without notice. We reserve the right to modify prices or discontinue products at any time. Payment is due at the time of placing your order. We accept cash on delivery, bKash, Nagad, and major credit/debit cards.
          </p>
        </div>

        <div class="policy-section">
          <h4 style="color: #fbbf24; margin-bottom: 1rem;">4. Orders and Delivery</h4>
          <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
            We reserve the right to accept or decline any order. Delivery times are estimates and cannot be guaranteed. We are not liable for any delays in delivery. Once an order is placed, you will receive an order confirmation via email or SMS.
          </p>
        </div>

        <div class="policy-section">
          <h4 style="color: #fbbf24; margin-bottom: 1rem;">5. Returns and Refunds</h4>
          <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
            Due to the perishable nature of our products, we cannot accept returns or exchanges. However, if you receive a damaged or incorrect order, please contact us within 24 hours of delivery, and we will work to resolve the issue.
          </p>
        </div>

        <div class="policy-section">
          <h4 style="color: #fbbf24; margin-bottom: 1rem;">6. User Accounts</h4>
          <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
            You are responsible for maintaining the confidentiality of your account information. You agree to notify us immediately of any unauthorized use of your account. We are not liable for any loss or damage arising from your failure to protect your account information.
          </p>
        </div>

        <div class="policy-section">
          <h4 style="color: #fbbf24; margin-bottom: 1rem;">7. Intellectual Property</h4>
          <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
            All content on this website, including text, graphics, logos, images, and software, is the property of Saffron Sweets & Bakery or its content suppliers and is protected by copyright and other intellectual property laws.
          </p>
        </div>

        <div class="policy-section">
          <h4 style="color: #fbbf24; margin-bottom: 1rem;">8. Limitation of Liability</h4>
          <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
            Saffron Sweets & Bakery shall not be liable for any indirect, incidental, special, or consequential damages arising out of or in connection with the use of our products or services.
          </p>
        </div>

        <div class="policy-section">
          <h4 style="color: #fbbf24; margin-bottom: 1rem;">9. Privacy Policy</h4>
          <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
            Your use of our website is also governed by our Privacy Policy. Please review our Privacy Policy, which also governs the website and informs users of our data collection practices.
          </p>
        </div>

        <div class="policy-section">
          <h4 style="color: #fbbf24; margin-bottom: 1rem;">10. Changes to Terms</h4>
          <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
            We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting to the website. Your continued use of the website following the posting of changes constitutes your acceptance of such changes.
          </p>
        </div>

        <div class="policy-section">
          <h4 style="color: #fbbf24; margin-bottom: 1rem;">11. Contact Information</h4>
          <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
            If you have any questions about these Terms & Conditions, please contact us at:
          </p>
          <p style="color: rgba(245,230,204,0.8); line-height: 1.8;">
            <i class="fas fa-envelope me-2" style="color: #fbbf24;"></i>info@saffronsweets.com.bd<br>
            <i class="fas fa-phone me-2" style="color: #fbbf24;"></i>+880 1730 702000
          </p>
        </div>

        <p style="color: rgba(245,230,204,0.6); text-align: center; margin-top: 2rem; font-size: 0.9rem;">
          Last Updated: March 2026
        </p>
      @endif
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

/* Policy Section Styles */
.policy-section {
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 16px;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
}

/* Responsive Design */
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
