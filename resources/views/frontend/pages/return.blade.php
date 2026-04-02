@extends('frontend.layouts.app')

@section('title', 'Return Policy - Saffron Sweets & Bakery')

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
    color: var(--text-40);
    font-size: 0.8rem;
    margin: 0 0.75rem;
  }

  .breadcrumb-glass .breadcrumb-item a {
    color: #f59e0b;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .breadcrumb-glass .breadcrumb-item a:hover {
    color: var(--theme-text-secondary);
    text-decoration: underline;
  }

  .breadcrumb-glass .breadcrumb-item.active {
    color: var(--theme-text-primary);
  }

  /* Policy Section Styles */
  .policy-section {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 1.5rem;
  }

  .policy-section h4 {
    color: #f59e0b;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid rgba(245,158,11,0.2);
    font-size: 1.25rem;
  }

  .policy-section ul {
    list-style: none;
    padding-left: 0;
  }

  .policy-section ul li {
    position: relative;
    padding-left: 1.75rem;
    margin-bottom: 0.75rem;
    color: var(--text-85);
    line-height: 1.7;
  }

  .policy-section ul li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #f59e0b;
    font-weight: 700;
  }

  .highlight-box {
    background: rgba(245,158,11,0.08);
    border-left: 4px solid #f59e0b;
    padding: 1.25rem 1.5rem;
    border-radius: 8px;
    margin: 1.5rem 0;
  }

  .contact-box {
    background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(251,191,36,0.05));
    border: 1px solid rgba(245,158,11,0.2);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
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
        <li class="breadcrumb-item active">Return Policy</li>
      </ol>
    </nav>

    <!-- Page Header -->
    <div class="text-center mb-5">
      <h1 style="color: var(--theme-text-primary); font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">
        <i class="fas fa-undo me-2" style="color: #f59e0b;"></i>Return & Refund Policy
      </h1>
      <p style="color: var(--text-70); font-size: 1.1rem; max-width: 700px; margin: 0 auto;">
        Your satisfaction is our priority. Learn about our return and refund policies.
      </p>
    </div>

    <div class="row">
      <div class="col-lg-8 mx-auto">

        <!-- Important Notice -->
        @if($cmsSections && isset($cmsSections['important_notice']))
        <div class="highlight-box">
          <h5 style="color: var(--theme-text-secondary); margin-bottom: 0.75rem;">
            @if($cmsSections['important_notice']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['important_notice']->icon }}</span>
            @endif
            {!! $cmsSections['important_notice']->title_en !!}
          </h5>
          <p style="color: var(--text-90); margin: 0; line-height: 1.7;">
            {!! $cmsSections['important_notice']->content_en !!}
          </p>
        </div>
        @else
        <div class="highlight-box">
          <h5 style="color: var(--theme-text-secondary); margin-bottom: 0.75rem;">
            <i class="fas fa-exclamation-triangle me-2"></i>Important Notice
          </h5>
          <p style="color: var(--text-90); margin: 0; line-height: 1.7;">
            Due to the perishable nature of our sweets and bakery products, we have specific return policies to ensure product quality and food safety. Please read this policy carefully before making a purchase.
          </p>
        </div>
        @endif

        <!-- Return Eligibility -->
        @if($cmsSections && isset($cmsSections['return_eligibility']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['return_eligibility']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['return_eligibility']->icon }}</span>
            @else
            <i class="fas fa-check-circle me-2"></i>
            @endif
            {!! $cmsSections['return_eligibility']->title_en !!}
          </h4>
          @php
            $content = $cmsSections['return_eligibility']->content_en;
            $lines = explode("\n", trim($content));
          @endphp
          <ul>
            @foreach($lines as $line)
              @if(trim($line))
                <li>{{ trim($line) }}</li>
              @endif
            @endforeach
          </ul>
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-check-circle me-2"></i>Return Eligibility</h4>
          <p style="color: var(--text-80); margin-bottom: 1rem; line-height: 1.7;">
            You may request a return or exchange in the following circumstances:
          </p>
          <ul>
            <li>Wrong products delivered (items different from your order)</li>
            <li>Damaged products received (broken packaging, spoiled items)</li>
            <li>Missing items in your order</li>
            <li>Poor quality or freshness issues (must be reported within 2 hours)</li>
            <li>Manufacturing defects or foreign objects in products</li>
          </ul>
        </div>
        @endif

        <!-- Time Frame -->
        @if($cmsSections && isset($cmsSections['time_frame_returns']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['time_frame_returns']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['time_frame_returns']->icon }}</span>
            @else
            <i class="fas fa-clock me-2"></i>
            @endif
            {!! $cmsSections['time_frame_returns']->title_en !!}
          </h4>
          @php
            $content = $cmsSections['time_frame_returns']->content_en;
            $parts = explode("\n\n", trim($content));
          @endphp
          @if(count($parts) > 1)
            <ul>
              @foreach(array_slice($parts, 0, count($parts) - 1) as $item)
                @if(trim($item))
                  <li>{!! nl2br(trim($item)) !!}</li>
                @endif
              @endforeach
            </ul>
            @if(isset($parts[count($parts) - 1]) && trim($parts[count($parts) - 1]))
            <div class="highlight-box" style="margin-top: 1.5rem;">
              <p style="color: var(--text-85); margin: 0; font-size: 0.95rem;">
                <strong>Note:</strong> {!! trim($parts[count($parts) - 1]) !!}
              </p>
            </div>
            @endif
          @else
            <ul>
              @foreach(explode("\n", trim($content)) as $line)
                @if(trim($line))
                  <li>{!! nl2br(trim($line)) !!}</li>
                @endif
              @endforeach
            </ul>
          @endif
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-clock me-2"></i>Time Frame for Returns</h4>
          <ul>
            <li><strong>Same-day returns:</strong> Must be reported within 2 hours of delivery</li>
            <li><strong>Damaged/incorrect items:</strong> Report within 2 hours of delivery</li>
            <li><strong>Quality issues:</strong> Must contact us within 2 hours, with photo evidence</li>
            <li><strong>Missing items:</strong> Report within 2 hours of delivery</li>
          </ul>
          <div class="highlight-box" style="margin-top: 1.5rem;">
            <p style="color: var(--text-85); margin: 0; font-size: 0.95rem;">
              <strong>Note:</strong> No returns will be accepted after the specified time frames or if the products have been consumed partially.
            </p>
          </div>
        </div>
        @endif

        <!-- Non-Returnable Items -->
        @if($cmsSections && isset($cmsSections['non_returnable_items']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['non_returnable_items']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['non_returnable_items']->icon }}</span>
            @else
            <i class="fas fa-ban me-2"></i>
            @endif
            {!! $cmsSections['non_returnable_items']->title_en !!}
          </h4>
          @php
            $content = $cmsSections['non_returnable_items']->content_en;
            $parts = explode("\n", trim($content), 2);
          @endphp
          @if(isset($parts[0]) && trim($parts[0]))
          <p style="color: var(--text-80); margin-bottom: 1rem; line-height: 1.7;">
            {!! trim($parts[0]) !!}
          </p>
          @endif
          @if(isset($parts[1]))
          <ul>
            @foreach(explode("\n", trim($parts[1])) as $line)
              @if(trim($line))
                <li>{{ trim($line) }}</li>
              @endif
            @endforeach
          </ul>
          @endif
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-ban me-2"></i>Non-Returnable Items</h4>
          <p style="color: var(--text-80); margin-bottom: 1rem; line-height: 1.7;">
            The following items cannot be returned or exchanged:
          </p>
          <ul>
            <li>Products that have been partially or fully consumed</li>
            <li>Items returned after the specified time frame</li>
            <li>Products without original packaging (if applicable)</li>
            <li>Items damaged due to customer mishandling</li>
            <li>Personalized/custom orders (unless there's a quality issue)</li>
            <li>Items marked as "Final Sale" or "Non-Returnable"</li>
            <li>Temperature-sensitive products that were not properly stored after delivery</li>
          </ul>
        </div>
        @endif

        <!-- Return Process -->
        @if($cmsSections && isset($cmsSections['how_to_request_return']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['how_to_request_return']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['how_to_request_return']->icon }}</span>
            @else
            <i class="fas fa-list-ol me-2"></i>
            @endif
            {!! $cmsSections['how_to_request_return']->title_en !!}
          </h4>
          @php
            $content = $cmsSections['how_to_request_return']->content_en;
            $parts = explode("\n", trim($content), 2);
          @endphp
          @if(isset($parts[0]) && trim($parts[0]))
          <p style="color: var(--text-80); margin-bottom: 1rem; line-height: 1.7;">
            {!! trim($parts[0]) !!}
          </p>
          @endif
          @if(isset($parts[1]))
          <ul>
            @foreach(explode("\n", trim($parts[1])) as $line)
              @if(trim($line))
                <li>{!! nl2br(trim($line)) !!}</li>
              @endif
            @endforeach
          </ul>
          @endif
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-list-ol me-2"></i>How to Request a Return</h4>
          <p style="color: var(--text-80); margin-bottom: 1rem; line-height: 1.7;">
            Follow these simple steps to request a return or refund:
          </p>
          <ul>
            <li><strong>Step 1:</strong> Contact our customer service immediately at +880 1730 702000</li>
            <li><strong>Step 2:</strong> Provide your order number and describe the issue</li>
            <li><strong>Step 3:</strong> Send clear photos of damaged/incorrect items (if applicable)</li>
            <li><strong>Step 4:</strong> Our team will review your request within 1-2 hours</li>
            <li><strong>Step 5:</strong> If approved, we'll arrange replacement or process refund</li>
          </ul>
        </div>
        @endif

        <!-- Refund Policy -->
        @if($cmsSections && isset($cmsSections['refund_policy']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['refund_policy']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['refund_policy']->icon }}</span>
            @else
            <i class="fas fa-money-bill-wave me-2"></i>
            @endif
            {!! $cmsSections['refund_policy']->title_en !!}
          </h4>
          @php
            $content = $cmsSections['refund_policy']->content_en;
            $parts = explode("\n", trim($content), 2);
          @endphp
          @if(isset($parts[0]) && trim($parts[0]))
          <p style="color: var(--text-80); margin-bottom: 1rem; line-height: 1.7;">
            {!! trim($parts[0]) !!}
          </p>
          @endif
          @if(isset($parts[1]))
          <ul style="list-style: disc; padding-left: 1.5rem;">
            @foreach(explode("\n", trim($parts[1])) as $line)
              @if(trim($line))
                <li style="padding-left: 0;">{!! nl2br(trim($line)) !!}</li>
              @endif
            @endforeach
          </ul>
          @endif
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-money-bill-wave me-2"></i>Refund Policy</h4>
          <p style="color: var(--text-80); margin-bottom: 1rem; line-height: 1.7;">
            Refunds are processed based on the payment method and circumstances:
          </p>
          <ul style="list-style: disc; padding-left: 1.5rem;">
            <li style="padding-left: 0;"><strong>Cash on Delivery (COD):</strong> Refund will be processed to your bKash/Nagad/Rocket account within 5-7 business days</li>
            <li style="padding-left: 0;"><strong>bKash/Nagad/Rocket:</strong> Refund to the same number within 3-5 business days</li>
            <li style="padding-left: 0;"><strong>Credit/Debit Card:</strong> Refund to the same card within 7-10 business days (depends on bank)</li>
            <li style="padding-left: 0;"><strong>Replacement:</strong> Free replacement will be delivered within 24-48 hours (depending on product availability)</li>
          </ul>
        </div>
        @endif

        <!-- Delivery Charges -->
        @if($cmsSections && isset($cmsSections['delivery_charges_returns']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['delivery_charges_returns']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['delivery_charges_returns']->icon }}</span>
            @else
            <i class="fas fa-truck me-2"></i>
            @endif
            {!! $cmsSections['delivery_charges_returns']->title_en !!}
          </h4>
          <ul>
            @foreach(explode("\n", trim($cmsSections['delivery_charges_returns']->content_en)) as $line)
              @if(trim($line))
                <li>{!! nl2br(trim($line)) !!}</li>
              @endif
            @endforeach
          </ul>
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-truck me-2"></i>Delivery Charges for Returns</h4>
          <ul>
            <li><strong>Valid returns (our fault):</strong> No additional delivery charges for replacement items</li>
            <li><strong>Invalid returns (customer error):</strong> Customer bears return delivery cost</li>
            <li><strong>Refund only cases:</strong> Original delivery charges are non-refundable</li>
          </ul>
        </div>
        @endif

        <!-- Cancellations -->
        @if($cmsSections && isset($cmsSections['order_cancellations']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['order_cancellations']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['order_cancellations']->icon }}</span>
            @else
            <i class="fas fa-times-circle me-2"></i>
            @endif
            {!! $cmsSections['order_cancellations']->title_en !!}
          </h4>
          <ul>
            @foreach(explode("\n", trim($cmsSections['order_cancellations']->content_en)) as $line)
              @if(trim($line))
                <li>{!! nl2br(trim($line)) !!}</li>
              @endif
            @endforeach
          </ul>
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-times-circle me-2"></i>Order Cancellations</h4>
          <ul>
            <li><strong>Before processing:</strong> Full refund if cancelled within 30 minutes of order placement</li>
            <li><strong>After processing but before delivery:</strong> 10% cancellation fee applies</li>
            <li><strong>After dispatch:</strong> Cannot be cancelled (follow return process instead)</li>
            <li><strong>Custom orders:</strong> Cannot be cancelled once production has started</li>
          </ul>
        </div>
        @endif

        <!-- Contact for Returns -->
        <div class="contact-box">
          <h4 style="color: var(--theme-text-primary); margin-bottom: 1rem;">Need Help With a Return?</h4>
          <p style="color: var(--text-80); margin-bottom: 1.5rem;">
            Our customer support team is here to assist you with any return or refund requests.
          </p>
          <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="tel:+8801730702000" class="btn btn-glow">
              <i class="fas fa-phone me-2"></i>Call Us
            </a>
            <a href="{{ route('contact') }}" class="btn btn-glass">
              <i class="fas fa-envelope me-2"></i>Email Us
            </a>
          </div>
          <div class="mt-4" style="color: var(--text-70);">
            <small>
              <i class="fas fa-clock me-1"></i>Support Hours: Sat-Thu, 9AM-9PM
            </small>
          </div>
        </div>

        <!-- Policy Version -->
        <div class="text-center mt-4">
          <p style="color: var(--text-50); font-size: 0.85rem; margin: 0;">
            Last updated: March 2026 | Version 1.0
          </p>
        </div>

      </div>
    </div>
  </div>
</div>
