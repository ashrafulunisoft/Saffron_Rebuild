<!-- ===================== NAVBAR ===================== -->
<nav class="navbar navbar-expand-lg fixed-top glass-nav" id="navbar">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('home') }}">
      <div class="brand-icon"><i class="fas fa-cookie-bite"></i></div>
      <div>
        <div class="brand-name">Saffron</div>
        <div class="brand-sub">Sweets & Bakery</div>
      </div>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav mx-auto gap-2">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>

        <!-- TRANSPARENT GLASS MEGA MENU -->
        <li class="nav-item dropdown glass-mega-dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="glassMegaMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            Shop <i class="fas fa-chevron-down ms-1" style="font-size:.7rem;transition:transform .3s ease;"></i>
          </a>
          <div class="dropdown-menu glass-mega-menu" aria-labelledby="glassMegaMenu">
            <div class="container">
              <div class="row g-4">
                <!-- 4 Column Menu Structure -->
                <div class="col-12">
                  <div class="row g-3">
                    <!-- Column 1: Bengali Sweets -->
                    <div class="col-6 col-lg-3">
                      <div class="glass-mega-col">
                        <h6 class="glass-mega-title">
                          <span class="mega-icon">🍬</span> Bengali Sweets
                        </h6>
                        <ul class="glass-mega-list">
                          <li><a href="{{ route('shop.category', 'bengali-sweets') }}" class="mega-link"><span class="link-dot"></span>Roshogolla</a></li>
                          <li><a href="{{ route('shop.category', 'bengali-sweets') }}" class="mega-link"><span class="link-dot"></span>Sandesh</a></li>
                          <li><a href="{{ route('shop.category', 'bengali-sweets') }}" class="mega-link"><span class="link-dot"></span>Rasmalai</a></li>
                          <li><a href="{{ route('shop.category', 'bengali-sweets') }}" class="mega-link"><span class="link-dot"></span>Gulab Jamun</a></li>
                          <li><a href="{{ route('shop.category', 'bengali-sweets') }}" class="mega-link"><span class="link-dot"></span>Kheer</a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- Column 2: Bakery Essentials -->
                    <div class="col-6 col-lg-3">
                      <div class="glass-mega-col">
                        <h6 class="glass-mega-title">
                          <span class="mega-icon">🍞</span> Bakery Essentials
                        </h6>
                        <ul class="glass-mega-list">
                          <li><a href="{{ route('shop.category', 'bakery') }}" class="mega-link"><span class="link-dot"></span>Fresh Bread</a></li>
                          <li><a href="{{ route('shop.category', 'bakery') }}" class="mega-link"><span class="link-dot"></span>Artisan Sourdough</a></li>
                          <li><a href="{{ route('shop.category', 'bakery') }}" class="mega-link"><span class="link-dot"></span>Baguettes</a></li>
                          <li><a href="{{ route('shop.category', 'bakery') }}" class="mega-link"><span class="link-dot"></span>Whole Wheat</a></li>
                          <li><a href="{{ route('shop.category', 'bakery') }}" class="mega-link"><span class="link-dot"></span>Gluten Free</a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- Column 3: Sweet Treats -->
                    <div class="col-6 col-lg-3">
                      <div class="glass-mega-col">
                        <h6 class="glass-mega-title">
                          <span class="mega-icon">🧁</span> Sweet Treats
                        </h6>
                        <ul class="glass-mega-list">
                          <li><a href="{{ route('shop.category', 'cakes') }}" class="mega-link"><span class="link-dot"></span>Cakes</a></li>
                          <li><a href="{{ route('shop.category', 'cakes') }}" class="mega-link"><span class="link-dot"></span>Cupcakes</a></li>
                          <li><a href="{{ route('shop.category', 'pastries') }}" class="mega-link"><span class="link-dot"></span>Pastries</a></li>
                          <li><a href="{{ route('shop.category', 'cookies') }}" class="mega-link"><span class="link-dot"></span> Cookies</a></li>
                          <li><a href="{{ route('shop.category', 'macarons') }}" class="mega-link"><span class="link-dot"></span>Macarons</a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- Column 4: Chocolates -->
                    <div class="col-6 col-lg-3">
                      <div class="glass-mega-col">
                        <h6 class="glass-mega-title">
                          <span class="mega-icon">🍫</span> Chocolates
                        </h6>
                        <ul class="glass-mega-list">
                          <li><a href="{{ route('shop.category', 'chocolates') }}" class="mega-link"><span class="link-dot"></span>Chocolates</a></li>
                          <li><a href="{{ route('shop.category', 'chocolates') }}" class="mega-link"><span class="link-dot"></span>Truffles</a></li>
                          <li><a href="{{ route('shop.category', 'chocolates') }}" class="mega-link"><span class="link-dot"></span>Gummies</a></li>
                          <li><a href="{{ route('shop.category', 'chocolates') }}" class="mega-link"><span class="link-dot"></span>Hard Candy</a></li>
                          <li><a href="{{ route('shop.category', 'chocolates') }}" class="mega-link"><span class="link-dot"></span>Fudge</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <!-- Quick Tags -->
                  <div class="glass-mega-tags mt-3">
                    <span class="mega-tag-label">Popular:</span>
                    <a href="#" class="mega-tag">Premium Box</a>
                    <a href="#" class="mega-tag">Sugar Free</a>
                    <a href="#" class="mega-tag">Same Day</a>
                    <a href="#" class="mega-tag">Gift Wrap</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
        </li>

        @auth
          <li class="nav-item d-lg-none">
            <a class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}" href="{{ route('customer.dashboard') }}">
              <i class="fas fa-user me-2"></i>My Dashboard
            </a>
          </li>
        @endauth
      </ul>

      <div class="d-flex align-items-center gap-2">
        <!-- Search Icon Only -->
        <a href="{{ route('search') }}" class="nav-icon-btn" title="Search">
          <i class="fas fa-search"></i>
        </a>

        <div class="nav-icons-group d-flex align-items-center gap-2">
          @guest
            <a href="#" class="nav-icon-btn d-none d-sm-flex" title="Profile" data-bs-toggle="modal" data-bs-target="#loginModal">
              <i class="fas fa-user"></i>
            </a>
          @else
            <a href="{{ route('customer.dashboard') }}" class="nav-icon-btn d-none d-sm-flex" title="Dashboard">
              <i class="fas fa-user"></i>
            </a>
          @endguest

          <a href="#" class="nav-icon-btn" title="Wishlist">
            <i class="fas fa-heart"></i>
          </a>
          <a href="{{ route('cart') }}" class="nav-icon-btn position-relative" title="Cart">
            <i class="fas fa-shopping-bag"></i>
            <span class="cart-badge d-none">0</span>
          </a>
        </div>

        <!-- Auth Buttons -->
        @guest
          <a href="#" class="btn btn-glass btn-sm d-none d-md-block" style="padding:.5rem 1.2rem;" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
          <button class="btn btn-glow btn-sm" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
        @else
          <div class="dropdown d-none d-md-block">
            <button class="btn btn-glass btn-sm dropdown-toggle" style="padding:.5rem 1.2rem;" type="button" data-bs-toggle="dropdown">
              <i class="fas fa-user-circle me-2"></i>{{ auth()->user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="background: rgba(15, 10, 0, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1);">
              <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}" style="color: #f5e6cc;"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
              <li><a class="dropdown-item" href="{{ route('customer.orders') }}" style="color: #f5e6cc;"><i class="fas fa-shopping-bag me-2"></i>My Orders</a></li>
              <li><a class="dropdown-item" href="{{ route('customer.wishlist') }}" style="color: #f5e6cc;"><i class="fas fa-heart me-2"></i>Wishlist</a></li>
              <li><a class="dropdown-item" href="{{ route('customer.profile') }}" style="color: #f5e6cc;"><i class="fas fa-user-edit me-2"></i>Profile</a></li>
              <li><hr class="dropdown-divider" style="border-color: rgba(255,255,255,0.1);"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item w-100" style="color: #f43f5e;"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                </form>
              </li>
            </ul>
          </div>
        @endguest
      </div>
    </div>
  </div>
</nav>
