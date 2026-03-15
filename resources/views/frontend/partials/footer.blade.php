<footer class="footer-section" id="contact">
  <div class="container">
    <div class="row g-5">
      <div class="col-6 col-lg">
        <div class="footer-brand d-flex align-items-center gap-3">
          <div class="brand-icon"><i class="fas fa-cookie-bite"></i></div>
          <div>
            <div class="brand-name">Saffron</div>
            <div class="brand-sub">Sweets & Bakery</div>
          </div>
        </div>
        <p class="footer-text">
          Three generations of handcrafted sweetness. Made with love, served with joy since 1995. Experience the authentic taste of tradition.
        </p>
        <div class="footer-social">
          <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="col-6 col-lg">
        <h5 class="footer-title">Quick Links</h5>
        <ul class="footer-links">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('shop') }}">Products</a></li>
          <li><a href="{{ route('cart') }}">Cart</a></li>
          <li><a href="{{ route('about') }}">About Us</a></li>
          <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg">
        <h5 class="footer-title">Customer Service</h5>
        <ul class="footer-links">
          <li><a href="{{ route('faq') }}">FAQ</a></li>
          <li><a href="{{ route('return') }}">Return Policy</a></li>
          <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
          <li><a href="{{ route('terms') }}">Terms of Service</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg">
        <h5 class="footer-title">Categories</h5>
        <ul class="footer-links">
          <li><a href="{{ route('shop.category', 'bengali-sweets') }}">Bengali Sweets</a></li>
          <li><a href="{{ route('shop.category', 'chocolates') }}">Chocolates</a></li>
          <li><a href="{{ route('shop.category', 'bakery') }}">Bakery</a></li>
          <li><a href="{{ route('shop.category', 'cakes') }}">Custom Cakes</a></li>
          <li><a href="{{ route('shop.category', 'gift-hampers') }}">Gift Hampers</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg">
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
      </div>
    </div>
    <div class="footer-bottom">
      <p class="footer-copy">© {{ date('Y') }} Saffron Sweets & Bakery. All rights reserved. Crafted with 💝</p>
      <div class="footer-legal-links">
        <a href="{{ route('privacy') }}">Privacy Policy</a>
        <span class="mx-2">|</span>
        <a href="{{ route('terms') }}">Terms of Service</a>
        <span class="mx-2">|</span>
        <a href="{{ route('return') }}">Return Policy</a>
      </div>
      <div class="payment-icons">
        <span title="Visa">💳</span>
        <span title="MasterCard">🏦</span>
        <span title="bKash">📱</span>
        <span title="SSL Secure">🔐</span>
      </div>
    </div>
  </div>
</footer>

<!-- BACK TO TOP BUTTON -->
<button id="backToTop" class="nav-icon-btn" onclick="window.scrollTo({top:0,behavior:'smooth'});" style="position:fixed;bottom:100px;right:20px;z-index:998;opacity:0;visibility:hidden;transition:all .3s ease;width:50px;height:50px;font-size:1.2rem;">
  <i class="fas fa-arrow-up"></i>
</button>
