<!-- Cart Sidebar -->
<div class="offcanvas offcanvas-end cart-sidebar" id="cartSidebar" tabindex="-1" aria-labelledby="cartSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="cartSidebarLabel">
            <i class="fas fa-shopping-bag me-2"></i>Shopping Cart
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div class="text-center py-5">
            <i class="fas fa-shopping-basket" style="font-size: 4rem; opacity: 0.3; margin-bottom: 1rem;"></i>
            <p style="color: var(--text-60);">Your cart is empty</p>
            <a href="{{ route('shop') }}" class="btn btn-glow btn-sm mt-3" data-bs-dismiss="offcanvas">
                <i class="fas fa-shopping-bag me-2"></i>Start Shopping
            </a>
        </div>
    </div>
</div>
