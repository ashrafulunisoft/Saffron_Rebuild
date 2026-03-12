@extends('frontend.layouts.app')

@section('title', 'Shopping Cart - Saffron Sweets & Bakery')

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb-glass">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #f59e0b; text-decoration: none;">Home</a></li>
        <li class="breadcrumb-item active" style="color: #f5e6cc;">Shopping Cart</li>
      </ol>
    </nav>

    @if(false)
      <div class="row g-4">
        <!-- Cart empty state -->
      </div>
    @else
      <div class="text-center py-5 glass-card">
        <i class="fas fa-shopping-basket" style="font-size: 5rem; opacity: 0.3; margin-bottom: 1.5rem;"></i>
        <h3 style="color: #f5e6cc;">Your cart is empty</h3>
        <p style="color: rgba(245,230,204,0.6); margin-bottom: 2rem;">Looks like you haven't added anything to your cart yet.</p>
        <a href="{{ route('shop') }}" class="btn btn-glow btn-lg">
          <i class="fas fa-shopping-bag me-2"></i>Start Shopping
        </a>
      </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
function updateCart(rowId, qty) {
  if (qty < 1) return;

  fetch('/cart/update', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ rowId, quantity: qty })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      location.reload();
    }
  });
}

function removeFromCart(rowId) {
  if (confirm('Remove this item from cart?')) {
    fetch('/cart/remove', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ rowId })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        location.reload();
      }
    });
  }
}
</script>
@endpush
