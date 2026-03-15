@props([
    'productId' => null,
    'productName' => null,
    'price' => null,
    'image' => null,
    'buttonClass' => 'btn btn-glow btn-sm',
    'buttonText' => 'Add to Cart',
    'iconClass' => 'fas fa-plus'
])

<button class="add-to-cart-btn {{ $buttonClass }}"
        data-product-id="{{ $productId }}"
        data-product-name="{{ $productName }}"
        data-price="{{ $price }}"
        data-image="{{ $image }}"
        style="cursor: pointer;">
  <i class="{{ $iconClass }} me-1"></i>
  <span>{{ $buttonText }}</span>
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

  addToCartButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();

      const productId = this.dataset.productId;
      const productName = this.dataset.productName;
      const price = this.dataset.price;
      const image = this.dataset.image;

      // Show loading state
      const originalText = this.querySelector('span').textContent;
      this.querySelector('span').textContent = 'Adding...';
      this.disabled = true;

      fetch('/cart/add', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
          product_id: productId,
          quantity: 1
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Update cart count
          updateCartCountBadge(data.cart_count);

          // Show success message
          this.querySelector('span').textContent = 'Added!';
          this.style.background = 'linear-gradient(135deg, #10b981, #059669)';

          setTimeout(() => {
            this.querySelector('span').textContent = originalText;
            this.style.background = '';
            this.disabled = false;
          }, 2000);
        } else {
          alert(data.message || 'Failed to add to cart');
          this.querySelector('span').textContent = originalText;
          this.disabled = false;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Failed to add to cart. Please try again.');
        this.querySelector('span').textContent = originalText;
        this.disabled = false;
      });
    });
  });
});
</script>
