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
      <!-- Mobile Close Button -->
      <div class="d-lg-none w-100 d-flex justify-content-end mb-3">
        <button class="btn btn-close-menu" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-label="Close">
          <i class="fas fa-times"></i>
        </button>
      </div>
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
                <!-- Desktop: Dynamic Categories Grid -->
                <div class="col-12 d-none d-md-block">
                  @if(isset($navCategories) && $navCategories->count() > 0)
                    <div class="row g-3">
                      @php
                        // Emoji mapping for categories
                        $categoryEmojis = [
                          'breads' => '🍞',
                          'cakes' => '🎂',
                          'cake' => '🎂',
                          'cookies-biscuits' => '🍪',
                          'traditional-sweets' => '🍬',
                          'sweet' => '🍮',
                          'sweets' => '🍬',
                          'dairy-products' => '🥛',
                          'buns-rolls' => '🥯',
                          'pastries-savories' => '🥧',
                          'bengali-sweets' => '🍬',
                          'bakery' => '🥐',
                          'chocolates' => '🍫',
                          'cookies' => '🍪',
                          'pastries' => '🥧',
                        ];

                        // Group categories by chunks for 4 columns (3 categories per column)
                        $categoriesChunked = $navCategories->chunk(3);
                      @endphp

                      @foreach($categoriesChunked as $categoryChunk)
                        <div class="col-6 col-lg-3">
                          <div class="glass-mega-col">
                            @foreach($categoryChunk as $category)
                              @php
                                $emoji = $categoryEmojis[$category->slug] ?? '🍰';
                              @endphp

                              @if($loop->first)
                                <h6 class="glass-mega-title">
                                  <span class="mega-icon">{{ $emoji }}</span> {{ $category->name_en }}
                                </h6>
                                <ul class="glass-mega-list">
                              @endif

                              <li>
                                <a href="{{ route('shop.category', $category->slug) }}" class="mega-link">
                                  <span class="link-dot"></span>{{ $category->name_en }}
                                  @if($category->products_count > 0)
                                    <small class="text-muted opacity-75">({{ $category->products_count }})</small>
                                  @endif
                                </a>
                              </li>

                              @if($loop->last)
                                </ul>
                              @endif
                            @endforeach
                          </div>
                        </div>
                      @endforeach
                    </div>
                  @else
                    <div class="text-center py-4">
                      <p class="text-muted">No categories available</p>
                    </div>
                  @endif

                  <!-- Quick Links -->
                  <div class="glass-mega-tags mt-3">
                    <span class="mega-tag-label">Quick Links:</span>
                    <a href="{{ route('shop') }}" class="mega-tag">All Products</a>
                    <a href="{{ route('shop') }}?featured=1" class="mega-tag">Featured</a>
                    <a href="{{ route('shop') }}?sort=newest" class="mega-tag">New Arrivals</a>
                    <a href="{{ route('shop') }}?sort=popular" class="mega-tag">Popular</a>
                  </div>
                </div>

                <!-- Mobile: Category List View -->
                <div class="col-12 d-md-none">
                  <div class="mobile-shop-categories">
                    <h5 class="mobile-shop-title">
                      <i class="fas fa-store"></i> Browse Categories
                    </h5>

                    @if(isset($navCategories) && $navCategories->count() > 0)
                      @foreach($navCategories as $category)
                        <a href="{{ route('shop.category', $category->slug) }}" class="mobile-category-item">
                          <div class="mobile-category-icon">
                            @php
                              $categoryEmojis = [
                                'breads' => '🍞',
                                'cakes' => '🎂',
                                'cake' => '🎂',
                                'cookies-biscuits' => '🍪',
                                'traditional-sweets' => '🍬',
                                'sweet' => '🍮',
                                'sweets' => '🍬',
                                'dairy-products' => '🥛',
                                'buns-rolls' => '🥯',
                                'pastries-savories' => '🥧',
                                'bengali-sweets' => '🍬',
                                'bakery' => '🥐',
                                'chocolates' => '🍫',
                                'cookies' => '🍪',
                                'pastries' => '🥧',
                              ];
                              $emoji = $categoryEmojis[$category->slug] ?? '🍰';
                            @endphp
                            {{ $emoji }}
                          </div>
                          <div class="mobile-category-content">
                            <div class="mobile-category-name">{{ $category->name_en }}</div>
                            @if($category->products_count > 0)
                              <div class="mobile-category-count">{{ $category->products_count }} products</div>
                            @endif
                          </div>
                        </a>
                      @endforeach
                    @endif

                    <div class="mobile-shop-quicklinks">
                      <a href="{{ route('shop') }}" class="mobile-quicklink">
                        <i class="fas fa-th-large"></i>
                        <span>All Products</span>
                      </a>
                      <a href="{{ route('shop') }}?featured=1" class="mobile-quicklink">
                        <i class="fas fa-star"></i>
                        <span>Featured</span>
                      </a>
                      <a href="{{ route('shop') }}?sort=newest" class="mobile-quicklink">
                        <i class="fas fa-sparkles"></i>
                        <span>New Arrivals</span>
                      </a>
                    </div>
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
          <a class="nav-link {{ request()->routeIs('blog.index') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
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
        <!-- Search Bar with Icon -->
        <form action="{{ route('search') }}" method="GET" class="d-none d-lg-flex position-relative">
          <input type="text" name="q" class="form-control search-input" placeholder="Search treats..." value="{{ request('q') }}">
          <button type="submit" class="search-icon-btn" title="Search">
            <i class="fas fa-search"></i>
          </button>
        </form>

        <a href="{{ route('search') }}" class="nav-icon-btn d-lg-none" title="Search">
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

          @auth
            <a href="{{ route('customer.wishlist') }}" class="nav-icon-btn position-relative" title="Wishlist">
              <i class="fas fa-heart"></i>
              <span class="cart-badge wishlist-count d-none">0</span>
            </a>
          @endauth
          <a href="{{ route('cart') }}" class="nav-icon-btn position-relative" title="Cart">
            <i class="fas fa-shopping-bag"></i>
            <span class="cart-badge cart-count d-none">0</span>
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

<script>
// Fetch and update cart count on page load
document.addEventListener('DOMContentLoaded', function() {
  fetchCartCount();
  fetchWishlistCount();
});

function fetchCartCount() {
  fetch('/cart/count')
    .then(response => response.json())
    .then(data => {
      updateCartCountBadge(data.count);
    })
    .catch(error => console.error('Error fetching cart count:', error));
}

function fetchWishlistCount() {
  fetch('/wishlist/check')
    .then(response => response.json())
    .then(data => {
      // For now just fetch count - you can enhance this
      if (data.count !== undefined) {
        updateWishlistCountBadge(data.count);
      }
    })
    .catch(error => console.error('Error fetching wishlist count:', error));
}

function updateCartCountBadge(count) {
  const cartBadges = document.querySelectorAll('.cart-count');
  cartBadges.forEach(badge => {
    if (count > 0) {
      badge.textContent = count > 9 ? '9+' : count;
      badge.classList.remove('d-none');
      badge.classList.add('d-flex');
    } else {
      badge.classList.add('d-none');
      badge.classList.remove('d-flex');
    }
  });
}

function updateWishlistCountBadge(count) {
  const wishlistBadges = document.querySelectorAll('.wishlist-count');
  wishlistBadges.forEach(badge => {
    if (count > 0) {
      badge.textContent = count > 9 ? '9+' : count;
      badge.classList.remove('d-none');
      badge.classList.add('d-flex');
    } else {
      badge.classList.add('d-none');
      badge.classList.remove('d-flex');
    }
  });
}
</script>
