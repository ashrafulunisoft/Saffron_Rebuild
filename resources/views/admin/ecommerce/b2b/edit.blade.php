@extends('layouts.admin')

@section('title', "Edit {$b2b->company_name} - B2B Customer")

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Edit B2B Customer <span class="text-white">সম্পাদনা করুন</span></h2>
        <p class="text-white mb-0">Update B2B customer information</p>
    </div>
    <a href="{{ route('admin.ecommerce.b2b.show', $b2b) }}" class="btn btn-outline">
        <i class="fas fa-arrow-left me-2"></i> Back to Customer
    </a>
</div>

<div class="glass-card-dark" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('admin.ecommerce.b2b.update', $b2b) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Company Info -->
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-primary border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-building me-2"></i>Company Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label text-white">Company Name <span class="text-danger">*</span></label>
                    <input type="text" name="company_name" class="form-control bg-dark text-white border-secondary"
                           value="{{ old('company_name', $b2b->company_name) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">Business Type <span class="text-danger">*</span></label>
                        <select name="business_type" class="form-select bg-dark text-white border-secondary" required>
                            <option value="retailer" @if(old('business_type', $b2b->business_type) === 'retailer') selected @endif>Retailer</option>
                            <option value="wholesaler" @if(old('business_type', $b2b->business_type) === 'wholesaler') selected @endif>Wholesaler</option>
                            <option value="distributor" @if(old('business_type', $b2b->business_type) === 'distributor') selected @endif>Distributor</option>
                            <option value="manufacturer" @if(old('business_type', $b2b->business_type) === 'manufacturer') selected @endif>Manufacturer</option>
                            <option value="reseller" @if(old('business_type', $b2b->business_type) === 'reseller') selected @endif>Reseller</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">Trade License Number</label>
                        <input type="text" name="trade_license_number" class="form-control bg-dark text-white border-secondary"
                               value="{{ old('trade_license_number', $b2b->trade_license_number) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">Tax ID</label>
                        <input type="text" name="tax_id" class="form-control bg-dark text-white border-secondary"
                               value="{{ old('tax_id', $b2b->tax_id) }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-info border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-address-book me-2"></i>Contact Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label text-white">Contact Person Name</label>
                    <input type="text" name="contact_person" class="form-control bg-dark text-white border-secondary"
                           value="{{ old('contact_person', $b2b->contact_person) }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">Contact Phone</label>
                        <input type="text" name="contact_phone" class="form-control bg-dark text-white border-secondary"
                               value="{{ old('contact_phone', $b2b->contact_phone) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">Contact Email</label>
                        <input type="email" name="contact_email" class="form-control bg-dark text-white border-secondary"
                               value="{{ old('contact_email', $b2b->contact_email) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-white">Billing Address</label>
                    <textarea name="billing_address" class="form-control bg-dark text-white border-secondary" rows="2">{{ old('billing_address', $b2b->billing_address) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-white">Shipping Address</label>
                    <textarea name="shipping_address" class="form-control bg-dark text-white border-secondary" rows="2">{{ old('shipping_address', $b2b->shipping_address) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Credit & Payment -->
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-warning border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-credit-card me-2"></i>Credit & Payment Terms</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">Credit Limit (৳) <span class="text-danger">*</span></label>
                        <input type="number" name="credit_limit" class="form-control bg-dark text-white border-secondary"
                               value="{{ old('credit_limit', $b2b->credit_limit) }}" min="0" step="0.01" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">Payment Terms <span class="text-danger">*</span></label>
                        <select name="payment_terms" class="form-select bg-dark text-white border-secondary" required>
                            <option value="cash_on_delivery" @if(old('payment_terms', $b2b->payment_terms) === 'cash_on_delivery') selected @endif>Cash on Delivery</option>
                            <option value="net_15" @if(old('payment_terms', $b2b->payment_terms) === 'net_15') selected @endif>Net 15 Days</option>
                            <option value="net_30" @if(old('payment_terms', $b2b->payment_terms) === 'net_30') selected @endif>Net 30 Days</option>
                            <option value="net_60" @if(old('payment_terms', $b2b->payment_terms) === 'net_60') selected @endif>Net 60 Days</option>
                            <option value="net_90" @if(old('payment_terms', $b2b->payment_terms) === 'net_90') selected @endif>Net 90 Days</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">Payment Days <span class="text-danger">*</span></label>
                        <input type="number" name="payment_days" class="form-control bg-dark text-white border-secondary"
                               value="{{ old('payment_days', $b2b->payment_days) }}" min="0" max="365" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">Current Balance</label>
                        <input type="number" name="current_balance" class="form-control bg-dark text-white border-secondary"
                               value="{{ old('current_balance', $b2b->current_balance) }}" min="0" step="0.01">
                        <small class="text-warning">Update if payment received</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing & Discounts -->
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-success border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-tags me-2"></i>Pricing & Discounts</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">Pricing Tier <span class="text-danger">*</span></label>
                        <select name="pricing_tier" class="form-select bg-dark text-white border-secondary" required>
                            <option value="standard" @if(old('pricing_tier', $b2b->pricing_tier) === 'standard') selected @endif>Standard</option>
                            <option value="silver" @if(old('pricing_tier', $b2b->pricing_tier) === 'silver') selected @endif>Silver</option>
                            <option value="gold" @if(old('pricing_tier', $b2b->pricing_tier) === 'gold') selected @endif>Gold</option>
                            <option value="platinum" @if(old('pricing_tier', $b2b->pricing_tier) === 'platinum') selected @endif>Platinum</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-white">Wholesale Discount (%) <span class="text-danger">*</span></label>
                        <input type="number" name="wholesale_discount" class="form-control bg-dark text-white border-secondary"
                               value="{{ old('wholesale_discount', $b2b->wholesale_discount) }}" min="0" max="100" step="0.01" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-secondary border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-sticky-note me-2"></i>Additional Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label text-white">Notes</label>
                    <textarea name="notes" class="form-control bg-dark text-white border-secondary" rows="3">{{ old('notes', $b2b->notes) }}</textarea>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive"
                           @if(old('is_active', $b2b->is_active)) checked @endif value="1">
                    <label class="form-check-label text-white" for="isActive">
                        Active Account
                    </label>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        @if($b2b->orders()->count() > 0)
            <div class="alert alert-warning mb-4">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Warning:</strong> This customer has {{ $b2b->orders()->count() }} order(s). Changes to credit limit or pricing will affect future orders only.
            </div>
        @endif

        <!-- Buttons -->
        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-gradient flex-grow-1">
                <i class="fas fa-save me-2"></i> Update Customer
            </button>
            <a href="{{ route('admin.ecommerce.b2b.show', $b2b) }}" class="btn btn-outline-secondary">
                <i class="fas fa-times me-2"></i> Cancel
            </a>
        </div>
    </form>
</div>

@endsection
