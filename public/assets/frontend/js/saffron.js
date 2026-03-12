/**
 * Saffron Sweets & Bakery - Main JavaScript
 * E-commerce functionality with glassmorphism design
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functionality
    initNavbar();
    initProductFilters();
    initProductThumbnails();
    initQuantitySelector();
    initCountdown();
    initScrollAnimations();
    initCartFunctionality();
    initWishlistFunctionality();
    initFormValidation();
    initSmoothScroll();
});

/**
 * Navbar functionality - Sticky header and scroll effects
 */
function initNavbar() {
    const navbar = document.querySelector('.navbar-glass');
    const topBar = document.querySelector('.top-bar');
    
    if (!navbar) return;
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
            if (topBar) topBar.style.transform = 'translateY(-100%)';
        } else {
            navbar.classList.remove('scrolled');
            if (topBar) topBar.style.transform = 'translateY(0)';
        }
    });
    
    // Smooth transition for top bar
    if (topBar) {
        topBar.style.transition = 'transform 0.3s ease';
    }
}

/**
 * Product filtering functionality
 */
function initProductFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const productItems = document.querySelectorAll('.product-item');
    
    if (!filterBtns.length) return;
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            
            productItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.style.display = 'block';
                    // Add animation
                    item.style.animation = 'fadeInUp 0.5s ease';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
}

/**
 * Product thumbnail switching on product details page
 */
function initProductThumbnails() {
    const thumbItems = document.querySelectorAll('.thumb-item');
    const mainImage = document.getElementById('mainImage');
    
    if (!thumbItems.length || !mainImage) return;
    
    thumbItems.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Remove active class from all thumbnails
            thumbItems.forEach(t => t.classList.remove('active'));
            // Add active class to clicked thumbnail
            this.classList.add('active');
            
            // Update main image with animation
            const newImg = this.getAttribute('data-img');
            mainImage.style.opacity = '0';
            
            setTimeout(() => {
                mainImage.src = newImg;
                mainImage.style.opacity = '1';
            }, 200);
        });
    });
    
    // Add transition for smooth fade
    if (mainImage) {
        mainImage.style.transition = 'opacity 0.3s ease';
    }
}

/**
 * Quantity selector functionality
 */
function initQuantitySelector() {
    const decreaseBtn = document.getElementById('decreaseQty');
    const increaseBtn = document.getElementById('increaseQty');
    const qtyInput = document.getElementById('qtyInput');
    
    if (!qtyInput) return;
    
    if (decreaseBtn) {
        decreaseBtn.addEventListener('click', function() {
            let value = parseInt(qtyInput.value);
            if (value > 1) {
                qtyInput.value = value - 1;
            }
        });
    }
    
    if (increaseBtn) {
        increaseBtn.addEventListener('click', function() {
            let value = parseInt(qtyInput.value);
            let max = parseInt(qtyInput.getAttribute('max')) || 10;
            if (value < max) {
                qtyInput.value = value + 1;
            }
        });
    }
    
    // Ensure valid input
    qtyInput.addEventListener('change', function() {
        let value = parseInt(this.value);
        let min = parseInt(this.getAttribute('min')) || 1;
        let max = parseInt(this.getAttribute('max')) || 10;
        
        if (isNaN(value) || value < min) {
            this.value = min;
        } else if (value > max) {
            this.value = max;
        }
    });
}

/**
 * Countdown timer for promotional banners
 */
function initCountdown() {
    const daysEl = document.getElementById('days');
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');
    
    if (!daysEl || !hoursEl || !minutesEl || !secondsEl) return;
    
    // Set deadline to 2 days from now
    const deadline = new Date();
    deadline.setDate(deadline.getDate() + 2);
    
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = deadline - now;
        
        if (distance < 0) {
            // Reset countdown
            deadline.setDate(deadline.getDate() + 2);
            return;
        }
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        daysEl.textContent = String(days).padStart(2, '0');
        hoursEl.textContent = String(hours).padStart(2, '0');
        minutesEl.textContent = String(minutes).padStart(2, '0');
        secondsEl.textContent = String(seconds).padStart(2, '0');
    }
    
    updateCountdown();
    setInterval(updateCountdown, 1000);
}

/**
 * Scroll animations using Intersection Observer
 */
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll(
        '.feature-card, .category-card, .product-card, .testimonial-card, .about-img-main, .about-img-floating'
    );
    
    if (!animatedElements.length) return;
    
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    animatedElements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(el);
    });
}

/**
 * Cart functionality
 */
function initCartFunctionality() {
    const addToCartBtns = document.querySelectorAll('.add-to-cart, .add-to-cart-btn');
    const cartBadge = document.querySelector('.cart-badge');
    const removeBtns = document.querySelectorAll('.btn-remove');
    
    // Update cart count
    let cartCount = 5; // Initial count from HTML
    
    addToCartBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Animation feedback
            this.innerHTML = '<i class="fas fa-check me-2"></i>Added!';
            this.classList.add('btn-success');
            this.classList.remove('btn-saffron');
            
            // Update cart count
            cartCount++;
            if (cartBadge) {
                cartBadge.textContent = cartCount;
                cartBadge.classList.add('pulse');
                setTimeout(() => cartBadge.classList.remove('pulse'), 1000);
            }
            
            // Show toast notification
            showToast('Item added to cart successfully!');
            
            // Reset button after delay
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-shopping-bag me-2"></i>Add to Cart';
                this.classList.remove('btn-success');
                this.classList.add('btn-saffron');
            }, 2000);
        });
    });
    
    // Remove item from cart
    removeBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const cartItem = this.closest('.cart-item');
            cartItem.style.opacity = '0';
            cartItem.style.transform = 'translateX(100%)';
            
            setTimeout(() => {
                cartItem.remove();
                cartCount--;
                if (cartBadge) cartBadge.textContent = cartCount;
            }, 300);
        });
    });
}

/**
 * Wishlist functionality
 */
function initWishlistFunctionality() {
    const wishlistBtns = document.querySelectorAll('.product-wishlist, .btn-wishlist');
    const wishlistBadge = document.querySelector('.nav-icon .badge:not(.cart-badge)');
    
    let wishlistCount = 3; // Initial count from HTML
    
    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const icon = this.querySelector('i');
            
            if (this.classList.contains('active')) {
                // Remove from wishlist
                this.classList.remove('active');
                icon.classList.remove('fas');
                icon.classList.add('far');
                wishlistCount--;
                showToast('Item removed from wishlist');
            } else {
                // Add to wishlist
                this.classList.add('active');
                icon.classList.remove('far');
                icon.classList.add('fas');
                wishlistCount++;
                showToast('Item added to wishlist!');
            }
            
            if (wishlistBadge) {
                wishlistBadge.textContent = wishlistCount;
            }
        });
    });
}

/**
 * Form validation
 */
function initFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
    
    // Newsletter form special handling
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            if (email) {
                showToast('Thank you for subscribing!');
                this.reset();
            }
        });
    }
}

/**
 * Smooth scroll for anchor links
 */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                const navbarHeight = document.querySelector('.navbar').offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * Toast notification system
 */
function showToast(message, type = 'success') {
    // Remove existing toasts
    const existingToast = document.querySelector('.custom-toast');
    if (existingToast) {
        existingToast.remove();
    }
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = 'custom-toast';
    toast.innerHTML = `
        <div class="toast-content">
            <i class="fas fa-check-circle"></i>
            <span>${message}</span>
        </div>
    `;
    
    // Add styles
    toast.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: linear-gradient(135deg, #d4a574 0%, #b8935f 100%);
        color: white;
        padding: 15px 25px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        transform: translateX(120%);
        transition: transform 0.3s ease;
    `;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after delay
    setTimeout(() => {
        toast.style.transform = 'translateX(120%)';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

/**
 * Variant selection on product page
 */
document.querySelectorAll('.variant-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Remove active from siblings
        this.parentElement.querySelectorAll('.variant-btn').forEach(b => {
            b.classList.remove('active');
        });
        // Add active to clicked
        this.classList.add('active');
    });
});

/**
 * Payment method selection (Checkout page)
 */
document.querySelectorAll('input[name="payment"]').forEach(radio => {
    radio.addEventListener('change', function() {
        // Update active state on cards
        document.querySelectorAll('.payment-method-card').forEach(card => {
            card.classList.remove('active');
        });
        this.closest('.payment-method-card').classList.add('active');
        
        // Show/hide relevant forms
        const cardForm = document.getElementById('cardPaymentForm');
        const bkashForm = document.getElementById('bkashPaymentForm');
        
        if (cardForm) cardForm.style.display = 'none';
        if (bkashForm) bkashForm.style.display = 'none';
        
        if (this.value === 'card' && cardForm) {
            cardForm.style.display = 'block';
        } else if (this.value === 'bkash' && bkashForm) {
            bkashForm.style.display = 'block';
        }
    });
});

/**
 * Delivery option selection
 */
document.querySelectorAll('input[name="delivery"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.delivery-option-card').forEach(card => {
            card.classList.remove('active');
        });
        this.closest('.delivery-option-card').classList.add('active');
    });
});

/**
 * Product tabs functionality
 */
document.querySelectorAll('#productTab .nav-link').forEach(tab => {
    tab.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Remove active from all tabs
        document.querySelectorAll('#productTab .nav-link').forEach(t => {
            t.classList.remove('active');
        });
        
        // Add active to clicked tab
        this.classList.add('active');
        
        // Show corresponding content
        const target = this.getAttribute('data-bs-target');
        document.querySelectorAll('.tab-pane').forEach(pane => {
            pane.classList.remove('show', 'active');
        });
        document.querySelector(target).classList.add('show', 'active');
    });
});

/**
 * Coupon code application
 */
document.querySelector('.summary-coupon .btn')?.addEventListener('click', function() {
    const input = document.querySelector('.summary-coupon input');
    if (input && input.value.trim() !== '') {
        showToast('Coupon code applied successfully!');
        input.value = '';
    } else {
        showToast('Please enter a valid coupon code', 'error');
    }
});

/**
 * Image zoom functionality (simple lightbox)
 */
document.querySelector('.image-zoom-icon')?.addEventListener('click', function() {
    const img = document.getElementById('mainImage');
    if (img) {
        // Create modal
        const modal = document.createElement('div');
        modal.className = 'image-modal';
        modal.innerHTML = `
            <div class="modal-backdrop" style="
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.9);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
                cursor: pointer;
            ">
                <img src="${img.src}" style="max-width: 90%; max-height: 90%; border-radius: 10px;">
                <button style="
                    position: absolute;
                    top: 20px;
                    right: 20px;
                    background: white;
                    border: none;
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    cursor: pointer;
                    font-size: 1.2rem;
                "><i class="fas fa-times"></i></button>
            </div>
        `;
        
        document.body.appendChild(modal);
        document.body.style.overflow = 'hidden';
        
        // Close on click
        modal.addEventListener('click', function(e) {
            if (e.target === modal || e.target.closest('button') || e.target.classList.contains('modal-backdrop')) {
                modal.remove();
                document.body.style.overflow = '';
            }
        });
    }
});

/**
 * Lazy loading for images
 */
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img.lazy').forEach(img => {
        imageObserver.observe(img);
    });
}

/**
 * Parallax effect for hero section
 */
window.addEventListener('scroll', function() {
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        const scrolled = window.pageYOffset;
        const heroBg = heroSection.querySelector('.hero-bg');
        if (heroBg) {
            heroBg.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    }
});

// Add CSS animation keyframes dynamically
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.2);
        }
    }
    
    .pulse {
        animation: pulse 0.5s ease;
    }
    
    .product-wishlist.active {
        background: #ff6b6b;
        color: white;
    }
    
    .btn-success {
        background: #28a745 !important;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4) !important;
    }
    
    /* Loading skeleton animation */
    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }
        100% {
            background-position: 1000px 0;
        }
    }
    
    .skeleton {
        animation: shimmer 2s infinite linear;
        background: linear-gradient(to right, #f0f0f0 4%, #e0e0e0 25%, #f0f0f0 36%);
        background-size: 1000px 100%;
    }
`;
document.head.appendChild(style);

// Preload critical images
function preloadImages() {
    const imagesToPreload = [
        'https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?w=500',
        'https://images.unsplash.com/photo-1601050690597-df0568f70950?w=400'
    ];
    
    imagesToPreload.forEach(src => {
        const img = new Image();
        img.src = src;
    });
}

// Call preload after page load
window.addEventListener('load', preloadImages);
