<!-- User Profile Card -->
<div class="text-center mb-4">
  <div class="customer-avatar">
    @if(auth()->user()->avatar)
      <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
    @else
      <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
    @endif
  </div>
  <h5 class="mt-3" style="color: var(--theme-text-primary);">{{ auth()->user()->name }}</h5>
  <p style="color: var(--text-60); font-size: 0.9rem;">{{ auth()->user()->email }}</p>
  <span class="badge" style="background: rgba(245,158,11,0.2); color: var(--theme-text-secondary); border: 1px solid rgba(245,158,11,0.3);">
    {{ ucfirst(auth()->user()->roles->first()?->name ?? 'Customer') }}
  </span>
</div>

<!-- Navigation Menu -->
<nav class="customer-nav">
  <a href="{{ route('customer.dashboard') }}" class="customer-nav-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
  </a>
  <a href="{{ route('customer.orders') }}" class="customer-nav-item {{ request()->routeIs('customer.orders*') ? 'active' : '' }}">
    <i class="fas fa-shopping-bag me-2"></i> My Orders
    @if(auth()->user()->orders()->count() > 0)
      <span class="nav-badge">{{ auth()->user()->orders()->count() }}</span>
    @endif
  </a>
  <a href="{{ route('customer.wishlist') }}" class="customer-nav-item {{ request()->routeIs('customer.wishlist') ? 'active' : '' }}">
    <i class="fas fa-heart me-2"></i> Wishlist
    @if(auth()->user()->wishlist_count > 0)
      <span class="nav-badge">{{ auth()->user()->wishlist_count }}</span>
    @endif
  </a>
  <a href="{{ route('customer.addresses') }}" class="customer-nav-item {{ request()->routeIs('customer.addresses*') ? 'active' : '' }}">
    <i class="fas fa-map-marker-alt me-2"></i> Addresses
  </a>
  @php
    $activeCouponsCount = \App\Models\Coupon::where(function($q) {
        $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
    })->where(function($q) {
        $q->whereNull('usage_limit')->orWhereRaw('usage_count < usage_limit');
    })->count();
  @endphp
  <a href="{{ route('customer.dashboard') }}#coupons" class="customer-nav-item {{ str_contains(request()->url(), '#coupons') ? 'active' : '' }}">
    <i class="fas fa-ticket-alt me-2"></i> Coupons
    @if($activeCouponsCount > 0)
      <span class="nav-badge">{{ $activeCouponsCount }}</span>
    @endif
  </a>
  <a href="{{ route('customer.profile') }}" class="customer-nav-item {{ request()->routeIs('customer.profile') ? 'active' : '' }}">
    <i class="fas fa-user-edit me-2"></i> Profile Settings
  </a>
  <hr style="border-color: rgba(255,255,255,0.1); margin: 1rem 0;">
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="customer-nav-item w-100" style="color: #f43f5e;">
      <i class="fas fa-sign-out-alt me-2"></i> Logout
    </button>
  </form>
</nav>

@push('styles')
<style>
  .customer-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f59e0b, #f43f5e);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 2rem;
    color: white;
    font-weight: 700;
    overflow: hidden;
  }
  .customer-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .customer-nav {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  .customer-nav-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    border-radius: 12px;
    color: var(--text-80);
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
  }
  .customer-nav-item:hover {
    background: rgba(245,158,11,0.1);
    color: var(--theme-text-secondary);
    transform: translateX(5px);
  }
  .customer-nav-item.active {
    background: linear-gradient(135deg, rgba(245,158,11, 0.2), rgba(244,63,94, 0.1));
    color: var(--theme-text-secondary);
    border: 1px solid rgba(245,158,11, 0.3);
  }
  .nav-badge {
    margin-left: auto;
    background: linear-gradient(135deg, #f43f5e, #e11d48);
    color: white;
    padding: 0.2rem 0.6rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
  }
</style>
@endpush
