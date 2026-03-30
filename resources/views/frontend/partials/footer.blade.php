<footer class="footer-section" id="contact">
  <div class="container">
    <div class="row g-4 g-lg-5">
      <!-- Row 1: Brand Section - Full width on mobile -->
      <div class="col-12 col-lg-3">
        <div class="footer-brand d-flex align-items-center gap-3">
          <div class="brand-icon"><i class="fas fa-cookie-bite"></i></div>
          <div>
            <div class="brand-name">Saffron</div>
            <div class="brand-sub">Sweets & Bakery</div>
          </div>
        </div>
        @if($footerSections && isset($footerSections['footer_brand_description']))
        <p class="footer-text">
          {!! $footerSections['footer_brand_description']->content_en !!}
        </p>
        @else
        <p class="footer-text">
          Three generations of handcrafted sweetness. Made with love, served with joy since 1995. Experience the authentic taste of tradition.
        </p>
        @endif
        @if($footerSections && isset($footerSections['footer_social_links']))
        <div class="footer-social">
          @php
            $socialContent = $footerSections['footer_social_links']->content_en;
            $lines = explode("\n", trim($socialContent));
            $iconMap = [
                'facebook' => 'fa-facebook-f',
                'instagram' => 'fa-instagram',
                'twitter' => 'fa-twitter',
                'youtube' => 'fa-youtube'
            ];
          @endphp
          @foreach($lines as $line)
            @if(trim($line) && strpos($line, '|') !== false)
              @php
                $cols = explode('|', trim($line));
                $platform = strtolower(trim($cols[0] ?? ''));
                $url = trim($cols[1] ?? '#');
                $iconClass = $iconMap[$platform] ?? 'fa-link';
              @endphp
              <a href="{{ $url }}" class="social-btn" target="_blank"><i class="fab {{ $iconClass }}"></i></a>
            @endif
          @endforeach
        </div>
        @else
        <div class="footer-social">
          <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
        </div>
        @endif
      </div>

      <!-- Row 2: Quick Links - col-md-6 for side by side on mobile -->
      <div class="col-md-6 col-lg-3">
        @if($footerSections && isset($footerSections['footer_quick_links']))
        <h5 class="footer-title">{!! $footerSections['footer_quick_links']->title_en !!}</h5>
        <ul class="footer-links">
          @php
            $linksContent = $footerSections['footer_quick_links']->content_en;
            $lines = explode("\n", trim($linksContent));
          @endphp
          @foreach($lines as $line)
            @if(trim($line) && strpos($line, '|') !== false)
              @php
                $cols = explode('|', trim($line));
                $key = trim($cols[0] ?? '');
                $url = trim($cols[1] ?? '#');
                $label = trim($cols[2] ?? ucfirst($key));
              @endphp
              <li><a href="{{ $url }}">{{ $label }}</a></li>
            @endif
          @endforeach
        </ul>
        @else
        <h5 class="footer-title">Quick Links</h5>
        <ul class="footer-links">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('shop') }}">Products</a></li>
          <li><a href="{{ route('cart') }}">Cart</a></li>
          <li><a href="{{ route('about') }}">About Us</a></li>
          <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
        @endif
      </div>
      <!-- Row 2: Customer Service - Side by side with Quick Links on mobile -->
      <div class="col-md-6 col-lg-3">
        @if($footerSections && isset($footerSections['footer_customer_service']))
        <h5 class="footer-title">{!! $footerSections['footer_customer_service']->title_en !!}</h5>
        <ul class="footer-links">
          @php
            $serviceContent = $footerSections['footer_customer_service']->content_en;
            $lines = explode("\n", trim($serviceContent));
          @endphp
          @foreach($lines as $line)
            @if(trim($line) && strpos($line, '|') !== false)
              @php
                $cols = explode('|', trim($line));
                $key = trim($cols[0] ?? '');
                $url = trim($cols[1] ?? '#');
                $label = trim($cols[2] ?? ucfirst($key));
              @endphp
              <li><a href="{{ $url }}">{{ $label }}</a></li>
            @endif
          @endforeach
        </ul>
        @else
        <h5 class="footer-title">Customer Service</h5>
        <ul class="footer-links">
          <li><a href="{{ route('faq') }}">FAQ</a></li>
          <li><a href="{{ route('return') }}">Return Policy</a></li>
          <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
          <li><a href="{{ route('terms') }}">Terms of Service</a></li>
        </ul>
        @endif
      </div>
      <!-- Row 3: Contact Us - Full width on mobile -->
      <div class="col-12 col-lg">
        @if($footerSections && isset($footerSections['footer_contact']))
        <h5 class="footer-title">{!! $footerSections['footer_contact']->title_en !!}</h5>
        @php
          $contactContent = $footerSections['footer_contact']->content_en;
          $lines = explode("\n", trim($contactContent));
          $iconMap = [
              'address' => 'fa-map-marker-alt',
              'phone' => 'fa-phone',
              'email' => 'fa-envelope',
              'hours' => 'fa-clock'
          ];
        @endphp
        @foreach($lines as $line)
          @if(trim($line) && strpos($line, '|') !== false)
            @php
              $cols = explode('|', trim($line));
              $key = strtolower(trim($cols[0] ?? ''));
              $value = trim($cols[1] ?? '');
              $icon = $iconMap[$key] ?? 'fa-info-circle';
            @endphp
            @if($key == 'hours')
            <div class="footer-contact-item">
              <i class="fas {{ $icon }}"></i>
              <span>{!! nl2br($value) !!}</span>
            </div>
            @else
            <div class="footer-contact-item">
              <i class="fas {{ $icon }}"></i>
              <span>{{ $value }}</span>
            </div>
            @endif
          @endif
        @endforeach
        @else
        <h5 class="footer-title">Contact Us</h5>
        <div class="footer-contact-item">
          <i class="fas fa-map-marker-alt"></i>
          <span>Jahir Smart Tower, 205/1,<br/>Begum Rokeya Sharani, Dhaka-1207</span>
        </div>
        <div class="footer-contact-item">
          <i class="fas fa-phone"></i>
          <span>+880 1730 702000</span>
        </div>
        <div class="footer-contact-item">
          <i class="fas fa-envelope"></i>
          <span>info@saffronsweets.com.bd</span>
        </div>
        <div class="footer-contact-item">
          <i class="fas fa-clock"></i>
          <span>Mon-Sat: 9AM-9PM<br/>Sun: 10AM-6PM</span>
        </div>
        @endif
      </div>
    </div>
    <div class="footer-bottom">
      @if($footerSections && isset($footerSections['footer_copyright']))
      <p class="footer-copy">
        @php
          $copyrightText = str_replace('{year}', date('Y'), $footerSections['footer_copyright']->content_en);
        @endphp
        {!! $copyrightText !!}
      </p>
      @else
      <p class="footer-copy">© {{ date('Y') }} Saffron Sweets & Bakery. All rights reserved. Crafted with 💝</p>
      @endif

      <div class="footer-legal-links">
        <a href="{{ route('privacy') }}">Privacy Policy</a>
        <span class="mx-2">|</span>
        <a href="{{ route('terms') }}">Terms of Service</a>
        <span class="mx-2">|</span>
        <a href="{{ route('return') }}">Return Policy</a>
      </div>

      @if($footerSections && isset($footerSections['footer_payment_icons']))
      <div class="payment-icons">
        @php
          $paymentContent = $footerSections['footer_payment_icons']->content_en;
          $lines = explode("\n", trim($paymentContent));
        @endphp
        @foreach($lines as $line)
          @if(trim($line) && strpos($line, '|') !== false)
            @php
              $cols = explode('|', trim($line));
              $name = trim($cols[0] ?? '');
              $icon = trim($cols[1] ?? '');
            @endphp
            <span title="{{ $name }}">{{ $icon }}</span>
          @endif
        @endforeach
      </div>
      @else
      <div class="payment-icons">
        <span title="Visa">💳</span>
        <span title="MasterCard">🏦</span>
        <span title="bKash">📱</span>
        <span title="SSL Secure">🔐</span>
      </div>
      @endif
    </div>
  </div>
</footer>

<!-- BACK TO TOP BUTTON -->
<button id="backToTop" class="nav-icon-btn" onclick="window.scrollTo({top:0,behavior:'smooth'});" style="position:fixed;bottom:100px;right:20px;z-index:998;opacity:0;visibility:hidden;transition:all .3s ease;width:50px;height:50px;font-size:1.2rem;">
  <i class="fas fa-arrow-up"></i>
</button>
