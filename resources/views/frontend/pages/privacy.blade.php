@extends('frontend.layouts.app')

@section('title', 'Privacy Policy - Saffron Sweets & Bakery')

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

  .policy-section p {
    color: var(--text-85);
    line-height: 1.8;
    margin-bottom: 1rem;
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
    content: "•";
    position: absolute;
    left: 0;
    color: #f59e0b;
    font-weight: 700;
    font-size: 1.2rem;
  }

  .highlight-box {
    background: rgba(245,158,11,0.08);
    border-left: 4px solid #f59e0b;
    padding: 1.25rem 1.5rem;
    border-radius: 8px;
    margin: 1.5rem 0;
  }

  .data-table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
  }

  .data-table th {
    background: rgba(245,158,11,0.15);
    color: #f59e0b;
    padding: 1rem;
    text-align: left;
    border-bottom: 2px solid rgba(245,158,11,0.3);
  }

  .data-table td {
    padding: 1rem;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    color: var(--text-85);
  }

  .data-table tr:hover td {
    background: rgba(255,255,255,0.02);
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
        <li class="breadcrumb-item active">Privacy Policy</li>
      </ol>
    </nav>

    <!-- Page Header -->
    <div class="text-center mb-5">
      <h1 style="color: var(--theme-text-primary); font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">
        <i class="fas fa-shield-alt me-2" style="color: #f59e0b;"></i>Privacy Policy
      </h1>
      <p style="color: var(--text-70); font-size: 1.1rem; max-width: 700px; margin: 0 auto;">
        Your privacy is important to us. Learn how we collect, use, and protect your personal information.
      </p>
    </div>

    <div class="row">
      <div class="col-lg-8 mx-auto">

        <!-- Last Updated -->
        @if($cmsSections && isset($cmsSections['privacy_last_updated']))
        <div class="highlight-box">
          <p style="color: var(--text-85); margin: 0; font-size: 0.95rem;">
            @if($cmsSections['privacy_last_updated']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['privacy_last_updated']->icon }}</span>
            @endif
            <strong>Last Updated:</strong> {{ $cmsSections['privacy_last_updated']->content_en }}
          </p>
        </div>
        @else
        <div class="highlight-box">
          <p style="color: var(--text-85); margin: 0; font-size: 0.95rem;">
            <strong>Last Updated:</strong> March 15, 2026 | <strong>Effective Date:</strong> March 15, 2026
          </p>
        </div>
        @endif

        <!-- Introduction -->
        @if($cmsSections && isset($cmsSections['privacy_introduction']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['privacy_introduction']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['privacy_introduction']->icon }}</span>
            @else
            <i class="fas fa-info-circle me-2"></i>
            @endif
            {!! $cmsSections['privacy_introduction']->title_en !!}
          </h4>
          @foreach(explode("\n\n", trim($cmsSections['privacy_introduction']->content_en)) as $paragraph)
            @if(trim($paragraph))
              <p>{!! trim($paragraph) !!}</p>
            @endif
          @endforeach
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-info-circle me-2"></i>Introduction</h4>
          <p>
            Saffron Sweets & Bakery ("we," "our," or "us") respects your privacy and is committed to protecting your personal data. This privacy policy explains how we collect, use, disclose, and safeguard your information when you visit our website saffronsweets.com.bd and use our services.
          </p>
          <p>
            By using our website and services, you agree to the collection and use of information in accordance with this policy. If you disagree with any part of this policy, please do not use our website or services.
          </p>
        </div>
        @endif

        <!-- Information We Collect -->
        @if($cmsSections && isset($cmsSections['info_collect_personal']) && isset($cmsSections['info_collect_order']) && isset($cmsSections['info_collect_technical']))
        <div class="policy-section">
          <h4><i class="fas fa-database me-2"></i>Information We Collect</h4>
          <p>We collect several types of information to provide and improve our services:</p>

          <h5 style="color: var(--theme-text-primary); margin: 1.5rem 0 0.75rem 0; font-size: 1.1rem;">
            @if($cmsSections['info_collect_personal']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['info_collect_personal']->icon }}</span>
            @endif
            {!! $cmsSections['info_collect_personal']->title_en !!}
          </h5>
          <ul>
            @foreach(explode("\n", trim($cmsSections['info_collect_personal']->content_en)) as $item)
              @if(trim($item))
                <li>{{ trim($item) }}</li>
              @endif
            @endforeach
          </ul>

          <h5 style="color: var(--theme-text-primary); margin: 1.5rem 0 0.75rem 0; font-size: 1.1rem;">
            @if($cmsSections['info_collect_order']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['info_collect_order']->icon }}</span>
            @endif
            {!! $cmsSections['info_collect_order']->title_en !!}
          </h5>
          <ul>
            @foreach(explode("\n", trim($cmsSections['info_collect_order']->content_en)) as $item)
              @if(trim($item))
                <li>{{ trim($item) }}</li>
              @endif
            @endforeach
          </ul>

          <h5 style="color: var(--theme-text-primary); margin: 1.5rem 0 0.75rem 0; font-size: 1.1rem;">
            @if($cmsSections['info_collect_technical']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['info_collect_technical']->icon }}</span>
            @endif
            {!! $cmsSections['info_collect_technical']->title_en !!}
          </h5>
          <ul>
            @foreach(explode("\n", trim($cmsSections['info_collect_technical']->content_en)) as $item)
              @if(trim($item))
                <li>{{ trim($item) }}</li>
              @endif
            @endforeach
          </ul>
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-database me-2"></i>Information We Collect</h4>
          <p>We collect several types of information to provide and improve our services:</p>

          <h5 style="color: var(--theme-text-primary); margin: 1.5rem 0 0.75rem 0; font-size: 1.1rem;">Personal Information</h5>
          <ul>
            <li>Name, email address, phone number</li>
            <li>Delivery address and billing information</li>
            <li>Account credentials (username, encrypted password)</li>
            <li>Profile information (date of birth, gender - optional)</li>
            <li>Payment information (processed securely through payment gateways)</li>
          </ul>

          <h5 style="color: var(--theme-text-primary); margin: 1.5rem 0 0.75rem 0; font-size: 1.1rem;">Order Information</h5>
          <ul>
            <li>Products viewed, added to cart, or purchased</li>
            <li>Order history and transaction details</li>
            <li>Wishlist items</li>
            <li>Delivery preferences and instructions</li>
          </ul>

          <h5 style="color: var(--theme-text-primary); margin: 1.5rem 0 0.75rem 0; font-size: 1.1rem;">Technical Information</h5>
          <ul>
            <li>IP address, browser type, and device information</li>
            <li>Operating system and browsing behavior</li>
            <li>Cookies and similar tracking technologies</li>
            <li>Pages visited and time spent on website</li>
          </ul>
        </div>
        @endif

        <!-- How We Use Your Information -->
        @if($cmsSections && isset($cmsSections['how_use_info']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['how_use_info']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['how_use_info']->icon }}</span>
            @else
            <i class="fas fa-cogs me-2"></i>
            @endif
            {!! $cmsSections['how_use_info']->title_en !!}
          </h4>
          <p>We use the collected information for various purposes:</p>
          <ul>
            @foreach(explode("\n", trim($cmsSections['how_use_info']->content_en)) as $item)
              @if(trim($item))
                @php
                  $parts = explode(': ', trim($item), 2);
                  $label = $parts[0] ?? '';
                  $desc = $parts[1] ?? '';
                @endphp
                <li><strong>{{ $label }}:</strong> {{ $desc }}</li>
              @endif
            @endforeach
          </ul>
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-cogs me-2"></i>How We Use Your Information</h4>
          <p>We use the collected information for various purposes:</p>
          <ul>
            <li><strong>Order Processing:</strong> To process, fulfill, and deliver your orders</li>
            <li><strong>Account Management:</strong> To create and manage your account</li>
            <li><strong>Communication:</strong> To send order confirmations, updates, and notifications</li>
            <li><strong>Customer Support:</strong> To respond to your inquiries and provide assistance</li>
            <li><strong>Payment Processing:</strong> To process transactions securely</li>
            <li><strong>Personalization:</strong> To recommend products and improve your shopping experience</li>
            <li><strong>Marketing:</strong> To send promotional offers (with your consent)</li>
            <li><strong>Analytics:</strong> To analyze website usage and improve our services</li>
            <li><strong>Fraud Prevention:</strong> To detect and prevent fraudulent activities</li>
            <li><strong>Legal Compliance:</strong> To comply with legal obligations</li>
          </ul>
        </div>
        @endif

        <!-- Data Sharing & Disclosure -->
        @if($cmsSections && isset($cmsSections['data_sharing']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['data_sharing']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['data_sharing']->icon }}</span>
            @else
            <i class="fas fa-share-alt me-2"></i>
            @endif
            {!! $cmsSections['data_sharing']->title_en !!}
          </h4>
          @php
            $content = $cmsSections['data_sharing']->content_en;
            $parts = explode("\n\n", trim($content));
            $intro = $parts[0] ?? '';
            $tableData = $parts[1] ?? '';
            $note = $parts[2] ?? '';
          @endphp
          @if($intro)
          <p>{!! $intro !!}</p>
          @endif

          @if($tableData)
          <table class="data-table">
            <thead>
              <tr>
                <th>Third Party</th>
                <th>Purpose</th>
              </tr>
            </thead>
            <tbody>
              @foreach(explode("\n", trim($tableData)) as $row)
                @if(trim($row) && strpos($row, '|') !== false)
                  @php
                    $cols = explode('|', trim($row));
                    $party = trim($cols[0] ?? '');
                    $purpose = trim($cols[1] ?? '');
                  @endphp
                  @if($party && $purpose)
                  <tr>
                    <td>{{ $party }}</td>
                    <td>{{ $purpose }}</td>
                  </tr>
                  @endif
                @endif
              @endforeach
            </tbody>
          </table>
          @endif

          @if($note && strpos($note, 'Note:') !== false)
          <div class="highlight-box" style="margin-top: 1.5rem;">
            <p style="color: var(--text-85); margin: 0; font-size: 0.95rem;">
              <strong>Note:</strong> {!! trim(str_replace('Note:', '', $note)) !!}
            </p>
          </div>
          @endif
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-share-alt me-2"></i>Data Sharing & Disclosure</h4>
          <p>We respect your privacy and do not sell your personal data. We may share your information only in the following circumstances:</p>

          <table class="data-table">
            <thead>
              <tr>
                <th>Third Party</th>
                <th>Purpose</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Payment Gateways (bKash, Nagad, SSL Commerz)</td>
                <td>Process payments securely</td>
              </tr>
              <tr>
                <td>Delivery Partners</td>
                <td>Deliver your orders</td>
              </tr>
              <tr>
                <td>Service Providers (Hosting, Email, Analytics)</td>
                <td>Operate our website and services</td>
              </tr>
              <tr>
                <td>Legal Authorities</td>
                <td>Comply with legal requirements</td>
              </tr>
              <tr>
                <td>Business Partners (with consent)</td>
                <td>Special promotions and offers</td>
              </tr>
            </tbody>
          </table>

          <div class="highlight-box" style="margin-top: 1.5rem;">
            <p style="color: var(--text-85); margin: 0; font-size: 0.95rem;">
              <strong>Note:</strong> We share only the minimum necessary information required for the specified purpose. All third parties are bound by confidentiality obligations.
            </p>
          </div>
        </div>
        @endif

        <!-- Cookies & Tracking -->
        @if($cmsSections && isset($cmsSections['cookies_tracking']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['cookies_tracking']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['cookies_tracking']->icon }}</span>
            @else
            <i class="fas fa-cookie-bite me-2"></i>
            @endif
            {!! $cmsSections['cookies_tracking']->title_en !!}
          </h4>
          @php
            $content = $cmsSections['cookies_tracking']->content_en;
            $parts = explode("\n\n", trim($content));
            $uses = $parts[0] ?? '';
            $cookieTypes = $parts[1] ?? '';
            $footer = $parts[2] ?? '';
          @endphp

          @if($uses)
          <p>We use cookies and similar tracking technologies to:</p>
          <ul>
            @foreach(explode("\n", trim($uses)) as $item)
              @if(trim($item))
                <li>{{ trim($item) }}</li>
              @endif
            @endforeach
          </ul>
          @endif

          @if($cookieTypes && strpos($cookieTypes, 'Cookie Types') !== false)
          @php
            $lines = explode("\n", trim($cookieTypes));
            $tableLines = array_slice($lines, 1); // Skip the "Cookie Types:" heading
          @endphp
          <h5 style="color: var(--theme-text-primary); margin: 1.5rem 0 0.75rem 0; font-size: 1.1rem;">Types of Cookies We Use</h5>
          <table class="data-table">
            <thead>
              <tr>
                <th>Cookie Type</th>
                <th>Purpose</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tableLines as $row)
                @if(trim($row) && strpos($row, '|') !== false)
                  @php
                    $cols = explode('|', trim($row));
                    $type = trim($cols[0] ?? '');
                    $purpose = trim($cols[1] ?? '');
                  @endphp
                  @if($type && $purpose)
                  <tr>
                    <td>{{ $type }}</td>
                    <td>{{ $purpose }}</td>
                  </tr>
                  @endif
                @endif
              @endforeach
            </tbody>
          </table>
          @endif

          @if($footer)
          <p style="margin-top: 1rem;">
            {!! $footer !!}
          </p>
          @endif
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-cookie-bite me-2"></i>Cookies & Tracking Technologies</h4>
          <p>We use cookies and similar tracking technologies to:</p>
          <ul>
            <li>Remember your login credentials and preferences</li>
            <li>Keep items in your shopping cart</li>
            <li>Analyze website traffic and user behavior</li>
            <li>Personalize content and advertisements</li>
            <li>Improve website functionality and performance</li>
          </ul>

          <h5 style="color: var(--theme-text-primary); margin: 1.5rem 0 0.75rem 0; font-size: 1.1rem;">Types of Cookies We Use</h5>
          <table class="data-table">
            <thead>
              <tr>
                <th>Cookie Type</th>
                <th>Purpose</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Essential Cookies</td>
                <td>Required for basic website functionality</td>
              </tr>
              <tr>
                <td>Analytics Cookies</td>
                <td>Help us understand user behavior</td>
              </tr>
              <tr>
                <td>Functionality Cookies</td>
                <td>Remember preferences and settings</td>
              </tr>
              <tr>
                <td>Advertising Cookies</td>
                <td>Display relevant ads (with consent)</td>
              </tr>
            </tbody>
          </table>

          <p style="margin-top: 1rem;">
            You can manage cookie preferences through your browser settings. However, disabling cookies may affect website functionality.
          </p>
        </div>
        @endif

        <!-- Data Security -->
        @if($cmsSections && isset($cmsSections['data_security']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['data_security']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['data_security']->icon }}</span>
            @else
            <i class="fas fa-lock me-2"></i>
            @endif
            {!! $cmsSections['data_security']->title_en !!}
          </h4>
          @php
            $content = $cmsSections['data_security']->content_en;
            $parts = explode("\n\n", trim($content));
            $measures = $parts[0] ?? '';
            $note = $parts[1] ?? '';
          @endphp

          @if($measures)
          <p>We implement industry-standard security measures to protect your information:</p>
          <ul>
            @foreach(explode("\n", trim($measures)) as $item)
              @if(trim($item) && strpos($item, ':') !== false)
                @php
                  $itemParts = explode(': ', trim($item), 2);
                  $label = $itemParts[0] ?? '';
                  $desc = $itemParts[1] ?? '';
                @endphp
                <li><strong>{{ $label }}:</strong> {{ $desc }}</li>
              @endif
            @endforeach
          </ul>
          @endif

          @if($note && strpos($note, 'Important') !== false)
          <div class="highlight-box" style="margin-top: 1.5rem;">
            <p style="color: var(--text-85); margin: 0; font-size: 0.95rem;">
              <strong>Important:</strong> {!! trim(str_replace('Important:', '', $note)) !!}
            </p>
          </div>
          @endif
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-lock me-2"></i>Data Security</h4>
          <p>We implement industry-standard security measures to protect your information:</p>
          <ul>
            <li><strong>SSL Encryption:</strong> All data transmission is encrypted using SSL/TLS</li>
            <li><strong>Secure Payment:</strong> Payment processing through PCI DSS compliant gateways</li>
            <li><strong>Password Hashing:</strong> Passwords are stored using bcrypt hashing</li>
            <li><strong>Access Control:</strong> Limited access to personal data on a need-to-know basis</li>
            <li><strong>Regular Audits:</strong> Periodic security assessments and updates</li>
            <li><strong>Data Backup:</strong> Secure backup with disaster recovery plan</li>
          </ul>

          <div class="highlight-box" style="margin-top: 1.5rem;">
            <p style="color: var(--text-85); margin: 0; font-size: 0.95rem;">
              <strong>Important:</strong> While we take all reasonable measures to protect your data, no method of transmission over the internet is 100% secure. We cannot guarantee absolute security.
            </p>
          </div>
        </div>
        @endif

        <!-- Your Rights -->
        @if($cmsSections && isset($cmsSections['privacy_rights']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['privacy_rights']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['privacy_rights']->icon }}</span>
            @else
            <i class="fas fa-user-shield me-2"></i>
            @endif
            {!! $cmsSections['privacy_rights']->title_en !!}
          </h4>
          @php
            $content = $cmsSections['privacy_rights']->content_en;
            $parts = explode("\n\n", trim($content));
            $rights = $parts[0] ?? '';
            $contact = $parts[1] ?? '';
          @endphp

          @if($rights)
          <p>You have the following rights regarding your personal data:</p>
          <ul>
            @foreach(explode("\n", trim($rights)) as $item)
              @if(trim($item) && strpos($item, ':') !== false)
                @php
                  $itemParts = explode(': ', trim($item), 2);
                  $label = $itemParts[0] ?? '';
                  $desc = $itemParts[1] ?? '';
                @endphp
                <li><strong>{{ $label }}:</strong> {{ $desc }}</li>
              @endif
            @endforeach
          </ul>
          @endif

          @if($contact)
          <p style="margin-top: 1rem;">
            {!! $contact !!}
          </p>
          @endif
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-user-shield me-2"></i>Your Privacy Rights</h4>
          <p>You have the following rights regarding your personal data:</p>
          <ul>
            <li><strong>Access:</strong> Request a copy of your personal data</li>
            <li><strong>Correction:</strong> Update or correct inaccurate information</li>
            <li><strong>Deletion:</strong> Request deletion of your personal data (subject to legal obligations)</li>
            <li><strong>Objection:</strong> Object to processing of your personal data</li>
            <li><strong>Restriction:</strong> Request restriction of data processing</li>
            <li><strong>Data Portability:</strong> Receive your data in a structured format</li>
            <li><strong>Withdraw Consent:</strong> Withdraw consent at any time (where processing is based on consent)</li>
          </ul>

          <p style="margin-top: 1rem;">
            To exercise these rights, contact us at privacy@saffronsweets.com.bd. We'll respond within 30 days.
          </p>
        </div>
        @endif

        <!-- Data Retention -->
        @if($cmsSections && isset($cmsSections['data_retention']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['data_retention']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['data_retention']->icon }}</span>
            @else
            <i class="fas fa-archive me-2"></i>
            @endif
            {!! $cmsSections['data_retention']->title_en !!}
          </h4>
          @php
            $content = $cmsSections['data_retention']->content_en;
            $parts = explode("\n\n", trim($content));
            $periods = $parts[0] ?? '';
            $footer = $parts[1] ?? '';
          @endphp

          @if($periods)
          <p>We retain your personal data for the following periods:</p>
          <ul>
            @foreach(explode("\n", trim($periods)) as $item)
              @if(trim($item) && strpos($item, ':') !== false)
                @php
                  $itemParts = explode(': ', trim($item), 2);
                  $label = $itemParts[0] ?? '';
                  $desc = $itemParts[1] ?? '';
                @endphp
                <li><strong>{{ $label }}:</strong> {{ $desc }}</li>
              @endif
            @endforeach
          </ul>
          @endif

          @if($footer)
          <p style="margin-top: 1rem;">
            {!! $footer !!}
          </p>
          @endif
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-archive me-2"></i>Data Retention</h4>
          <p>We retain your personal data for the following periods:</p>
          <ul>
            <li><strong>Account Information:</strong> Until account deletion</li>
            <li><strong>Order History:</strong> 5 years from purchase date (legal requirement)</li>
            <li><strong>Payment Records:</strong> 5 years (tax & legal requirement)</li>
            <li><strong>Communication Logs:</strong> 2 years</li>
            <li><strong>Analytics Data:</strong> Aggregated and anonymized after 26 months</li>
          </ul>

          <p style="margin-top: 1rem;">
            After the retention period, data is securely deleted or anonymized unless required for legal proceedings.
          </p>
        </div>
        @endif

        <!-- Children's Privacy -->
        @if($cmsSections && isset($cmsSections['children_privacy']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['children_privacy']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['children_privacy']->icon }}</span>
            @else
            <i class="fas fa-child me-2"></i>
            @endif
            {!! $cmsSections['children_privacy']->title_en !!}
          </h4>
          @foreach(explode("\n\n", trim($cmsSections['children_privacy']->content_en)) as $paragraph)
            @if(trim($paragraph))
              <p>{!! trim($paragraph) !!}</p>
            @endif
          @endforeach
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-child me-2"></i>Children's Privacy</h4>
          <p>
            Our services are not intended for children under 13. We do not knowingly collect personal information from children under 13. If you're a parent or guardian and believe your child has provided us with personal data, please contact us immediately.
          </p>
          <p>
            If we become aware that we've collected personal data from a child under 13 without parental consent, we'll take steps to remove that information.
          </p>
        </div>
        @endif

        <!-- Third-Party Links -->
        @if($cmsSections && isset($cmsSections['third_party_links']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['third_party_links']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['third_party_links']->icon }}</span>
            @else
            <i class="fas fa-external-link-alt me-2"></i>
            @endif
            {!! $cmsSections['third_party_links']->title_en !!}
          </h4>
          <p>{!! $cmsSections['third_party_links']->content_en !!}</p>
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-external-link-alt me-2"></i>Third-Party Websites</h4>
          <p>
            Our website may contain links to third-party websites (social media, payment gateways, delivery partners). We are not responsible for the privacy practices of these third parties. We encourage you to review their privacy policies.
          </p>
        </div>
        @endif

        <!-- Changes to This Policy -->
        @if($cmsSections && isset($cmsSections['policy_changes']))
        <div class="policy-section">
          <h4>
            @if($cmsSections['policy_changes']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['policy_changes']->icon }}</span>
            @else
            <i class="fas fa-edit me-2"></i>
            @endif
            {!! $cmsSections['policy_changes']->title_en !!}
          </h4>
          @php
            $content = $cmsSections['policy_changes']->content_en;
            $parts = explode("\n\n", trim($content));
            $intro = $parts[0] ?? '';
            $methods = $parts[1] ?? '';
            $footer = $parts[2] ?? '';
          @endphp

          @if($intro)
          <p>{!! $intro !!}</p>
          @endif

          @if($methods)
          <ul>
            @foreach(explode("\n", trim($methods)) as $item)
              @if(trim($item))
                <li>{{ trim($item) }}</li>
              @endif
            @endforeach
          </ul>
          @endif

          @if($footer)
          <p>{!! $footer !!}</p>
          @endif
        </div>
        @else
        <div class="policy-section">
          <h4><i class="fas fa-edit me-2"></i>Changes to This Privacy Policy</h4>
          <p>
            We may update this privacy policy from time to time. We'll notify you of any changes by:
          </p>
          <ul>
            <li>Posting the new policy on this page with an updated "Last Modified" date</li>
            <li>Sending an email notification for significant changes</li>
            <li>Displaying a prominent notice on our website</li>
          </ul>
          <p>
            Your continued use of our services after the effective date constitutes acceptance of the updated policy.
          </p>
        </div>
        @endif

        <!-- Contact Us -->
        @if($cmsSections && isset($cmsSections['privacy_contact']))
        <div class="policy-section" style="background: rgba(245,158,11,0.08); border-color: rgba(245,158,11,0.2);">
          <h4>
            @if($cmsSections['privacy_contact']->icon)
            <span style="margin-right: 0.5rem;">{{ $cmsSections['privacy_contact']->icon }}</span>
            @else
            <i class="fas fa-envelope me-2"></i>
            @endif
            {!! $cmsSections['privacy_contact']->title_en !!}
          </h4>
          @php
            $content = $cmsSections['privacy_contact']->content_en;
            $parts = explode("\n\n", trim($content));
            $intro = $parts[0] ?? '';
            $contacts = $parts[1] ?? '';
            $footer = $parts[2] ?? '';
          @endphp

          @if($intro)
          <p>{!! $intro !!}</p>
          @endif

          @if($contacts)
          <div style="margin-top: 1.5rem;">
            @foreach(explode("\n", trim($contacts)) as $line)
              @if(trim($line) && strpos($line, '|') !== false)
                @php
                  $cols = explode('|', trim($line));
                  $label = trim($cols[0] ?? '');
                  $value = trim($cols[1] ?? '');
                @endphp
                @if($label && $value)
                <div style="margin-bottom: 1rem;">
                  <strong style="color: #f59e0b;">{{ $label }}:</strong>
                  @if(strtolower($label) == 'email')
                  <a href="mailto:{{ $value }}" style="color: var(--text-85); margin-left: 0.5rem;">{{ $value }}</a>
                  @elseif(strtolower($label) == 'phone')
                  <a href="tel:{{ $value }}" style="color: var(--text-85); margin-left: 0.5rem;">{{ $value }}</a>
                  @else
                  <span style="color: var(--text-85); margin-left: 0.5rem;">{{ $value }}</span>
                  @endif
                </div>
                @endif
              @endif
            @endforeach
          </div>
          @endif

          @if($footer)
          <p style="margin-top: 1.5rem;">
            {!! $footer !!}
          </p>
          @endif
        </div>
        @else
        <div class="policy-section" style="background: rgba(245,158,11,0.08); border-color: rgba(245,158,11,0.2);">
          <h4><i class="fas fa-envelope me-2"></i>Contact Us</h4>
          <p>If you have questions, concerns, or requests regarding this privacy policy or our data practices, please contact us:</p>

          <div style="margin-top: 1.5rem;">
            <div style="margin-bottom: 1rem;">
              <strong style="color: #f59e0b;">Email:</strong>
              <a href="mailto:privacy@saffronsweets.com.bd" style="color: var(--text-85); margin-left: 0.5rem;">privacy@saffronsweets.com.bd</a>
            </div>
            <div style="margin-bottom: 1rem;">
              <strong style="color: #f59e0b;">Phone:</strong>
              <a href="tel:+8801730702000" style="color: var(--text-85); margin-left: 0.5rem;">+880 1730 702000</a>
            </div>
            <div style="margin-bottom: 1rem;">
              <strong style="color: #f59e0b;">Address:</strong>
              <span style="color: var(--text-85); margin-left: 0.5rem;">Dhaka, Bangladesh</span>
            </div>
          </div>

          <p style="margin-top: 1.5rem;">
            We'll respond to your privacy-related inquiries within 30 days.
          </p>
        </div>
        @endif

        <!-- Policy Version -->
        <div class="text-center mt-4">
          <p style="color: var(--text-50); font-size: 0.85rem; margin: 0;">
            Version 1.0 | Effective Date: March 15, 2026
          </p>
        </div>

      </div>
    </div>
  </div>
</div>
