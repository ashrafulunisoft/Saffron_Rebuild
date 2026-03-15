@extends('frontend.layouts.app')

@section('title', 'FAQ - Saffron Sweets & Bakery')

@push('styles')
<style>
  /* Breadcrumb Styles */
  .breadcrumb-glass {
    background: rgba(255,255,255,0.05);
    padding: 0.8rem 1.5rem;
    border-radius: 12px;
    display: inline-flex;
    border: 1px solid rgba(255,255,255,0.1);
  }

  .breadcrumb-glass .breadcrumb-item {
    display: flex;
    align-items: center;
  }

  .breadcrumb-glass .breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: rgba(245,230,204,0.4);
    font-size: 0.8rem;
    margin: 0 0.75rem;
  }

  .breadcrumb-glass .breadcrumb-item a {
    color: #f59e0b;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .breadcrumb-glass .breadcrumb-item a:hover {
    color: #fbbf24;
    text-decoration: underline;
  }

  .breadcrumb-glass .breadcrumb-item.active {
    color: #f5e6cc;
  }

  /* FAQ Accordion Styles */
  .faq-accordion {
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 1rem;
  }

  .faq-item {
    border-bottom: 1px solid rgba(255,255,255,0.08);
  }

  .faq-item:last-child {
    border-bottom: none;
  }

  .faq-question {
    width: 100%;
    background: transparent;
    border: none;
    padding: 1.25rem 1.5rem;
    text-align: left;
    color: #f5e6cc;
    font-size: 1.05rem;
    font-weight: 500;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
    cursor: pointer;
  }

  .faq-question:hover {
    background: rgba(245,158,11,0.08);
  }

  .faq-question i {
    color: #f59e0b;
    transition: transform 0.3s ease;
  }

  .faq-question[aria-expanded="true"] i {
    transform: rotate(180deg);
  }

  .faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
  }

  .faq-answer[aria-hidden="false"] {
    max-height: 500px;
  }

  .faq-answer-inner {
    padding: 0 1.5rem 1.25rem 1.5rem;
    color: rgba(245,230,204,0.8);
    line-height: 1.7;
  }

  .faq-category {
    color: #f59e0b;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
    font-weight: 600;
  }
</style>
@endpush

@section('content')
<div style="padding-top: 120px; padding-bottom: 60px;">
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb-glass">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">FAQ</li>
      </ol>
    </nav>

    <!-- Page Header -->
    <div class="text-center mb-5">
      <h1 style="color: #f5e6cc; font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">
        <i class="fas fa-question-circle me-2" style="color: #f59e0b;"></i>Frequently Asked Questions
      </h1>
      <p style="color: rgba(245,230,204,0.7); font-size: 1.1rem; max-width: 700px; margin: 0 auto;">
        Find answers to common questions about our products, ordering, delivery, and more.
      </p>
    </div>

    <div class="row g-4">
      <div class="col-lg-8 mx-auto">

        <!-- Ordering & Payment -->
        <div class="mb-4">
          <h3 style="color: #f59e0b; margin-bottom: 1rem; font-size: 1.3rem;">
            <i class="fas fa-shopping-cart me-2"></i>Ordering & Payment
          </h3>

          <div class="faq-accordion">
            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Ordering</div>
                  How do I place an order?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  Browse our products, add items to your cart, and proceed to checkout. You'll need to create an account or log in to complete your purchase. Follow the step-by-step instructions to enter your delivery address and payment information.
                </div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Payment</div>
                  What payment methods do you accept?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  We accept cash on delivery (COD), bKash, Nagad, Rocket, and all major credit/debit cards. For online payments, you'll be redirected to a secure payment gateway.
                </div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Payment</div>
                  Is my payment information secure?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  Absolutely! We use industry-standard SSL encryption and secure payment gateways to ensure your payment information is protected. We never store your complete credit card details on our servers.
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Delivery & Shipping -->
        <div class="mb-4">
          <h3 style="color: #f59e0b; margin-bottom: 1rem; font-size: 1.3rem;">
            <i class="fas fa-truck me-2"></i>Delivery & Shipping
          </h3>

          <div class="faq-accordion">
            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Delivery</div>
                  What are your delivery areas?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  We currently deliver across Dhaka city. We're working hard to expand our delivery network to other cities. Enter your address during checkout to check if delivery is available in your area.
                </div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Delivery</div>
                  How long does delivery take?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  For orders within Dhaka: Same-day delivery for orders placed before 2 PM, next-day delivery for orders placed after 2 PM. Delivery time is typically 3-6 hours depending on your location.
                </div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Delivery</div>
                  What are the delivery charges?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  Delivery charge starts from ৳50 within Dhaka city, depending on your location. Free delivery is available for orders above ৳500.
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Products & Quality -->
        <div class="mb-4">
          <h3 style="color: #f59e0b; margin-bottom: 1rem; font-size: 1.3rem;">
            <i class="fas fa-cookie-bite me-2"></i>Products & Quality
          </h3>

          <div class="faq-accordion">
            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Products</div>
                  How fresh are your products?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  All our products are freshly made daily. We take pride in using premium ingredients and traditional recipes to ensure the highest quality. Sweets and bakery items are prepared in small batches throughout the day.
                </div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Products</div>
                  Do you offer custom orders for special occasions?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  Yes! We specialize in custom cakes, sweet boxes, and bakery items for weddings, birthdays, corporate events, and festivals. Please contact us at least 48-72 hours in advance for custom orders. Call us at +880 1730 702000.
                </div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Products</div>
                  Are your products vegetarian?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  Most of our sweets are vegetarian (made without eggs). However, some cakes and bakery items contain eggs. Please check the product description or contact us if you have specific dietary requirements.
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Returns & Refunds -->
        <div class="mb-4">
          <h3 style="color: #f59e0b; margin-bottom: 1rem; font-size: 1.3rem;">
            <i class="fas fa-undo me-2"></i>Returns & Refunds
          </h3>

          <div class="faq-accordion">
            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Returns</div>
                  What is your return policy?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  Due to the perishable nature of our products, we cannot accept returns. However, if you receive a damaged or incorrect order, please contact us within 2 hours of delivery. We'll either replace the items or issue a refund. For detailed policy, please visit our Returns page.
                </div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Refunds</div>
                  How do I request a refund?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  If you're eligible for a refund, contact our customer service at +880 1730 702000 or email info@saffronsweets.com.bd. Refunds are processed within 5-7 business days to your original payment method.
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Account & Support -->
        <div class="mb-4">
          <h3 style="color: #f59e0b; margin-bottom: 1rem; font-size: 1.3rem;">
            <i class="fas fa-user-headset me-2"></i>Account & Support
          </h3>

          <div class="faq-accordion">
            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Account</div>
                  Do I need to create an account to order?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  Yes, creating an account allows you to track your orders, save addresses, view order history, and enjoy exclusive member discounts. It only takes a minute to register!
                </div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Support</div>
                  How can I contact customer support?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  Our customer support team is available Mon-Sat, 9AM-9PM. Call us at +880 1730 702000, email info@saffronsweets.com.bd, or message us on Facebook/Instagram. We typically respond within 30 minutes during business hours.
                </div>
              </div>
            </div>

            <div class="faq-item">
              <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                <div>
                  <div class="faq-category">Loyalty</div>
                  Do you have a loyalty program?
                </div>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="faq-answer" aria-hidden="true">
                <div class="faq-answer-inner">
                  Yes! Earn 1 point for every ৳10 spent. Collect 100 points and get ৳50 off your next order. Premium members get exclusive discounts, early access to new products, and special birthday treats!
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Still Have Questions -->
        <div class="glass-card p-4 text-center mt-4" style="background: rgba(245,158,11,0.08); border-color: rgba(245,158,11,0.2);">
          <h4 style="color: #f5e6cc; margin-bottom: 1rem;">Still Have Questions?</h4>
          <p style="color: rgba(245,230,204,0.7); margin-bottom: 1.5rem;">
            Can't find the answer you're looking for? Our friendly team is here to help!
          </p>
          <a href="{{ route('contact') }}" class="btn btn-glow">
            <i class="fas fa-envelope me-2"></i>Contact Us
          </a>
        </div>

      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
function toggleFaq(button) {
  const answer = button.nextElementSibling;
  const isExpanded = button.getAttribute('aria-expanded') === 'true';

  // Close all other FAQs in the same accordion
  const accordion = button.closest('.faq-accordion');
  accordion.querySelectorAll('.faq-question').forEach(btn => {
    if (btn !== button) {
      btn.setAttribute('aria-expanded', 'false');
      btn.nextElementSibling.setAttribute('aria-hidden', 'true');
    }
  });

  // Toggle current FAQ
  button.setAttribute('aria-expanded', !isExpanded);
  answer.setAttribute('aria-hidden', isExpanded);
}
</script>
@endpush
