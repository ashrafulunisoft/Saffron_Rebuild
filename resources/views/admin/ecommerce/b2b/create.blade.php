@extends('layouts.admin')

@section('title', 'Add B2B Customer - Saffron Admin')

@section('content')
<div class="role-container" style="max-width: 950px;">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0;">B2B / WHOLESALE</span>
                </div>
            </div>
            <h2 class="fw-800 mb-0 text-white letter-spacing-1" style="font-size: 2rem;">Add B2B Customer</h2>
        </div>

        <form action="{{ route('admin.ecommerce.b2b.store') }}" method="POST">
            @csrf

            <!-- Section 1: Company Information -->
            <div class="permission-title">Company Information</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">User Account *</label>
                    <div class="position-relative">
                        <select name="user_id" class="input-dark input-custom" required>
                            <option value="">Select user...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <small class="text-muted" style="font-size: 0.75rem; opacity: 0.6;">Link to existing user account</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Business Type *</label>
                    <div class="position-relative">
                        <select name="business_type" class="input-dark input-custom" required>
                            <option value="">Select type...</option>
                            <option value="retailer" @if(old('business_type') === 'retailer') selected @endif>Retailer</option>
                            <option value="wholesaler" @if(old('business_type') === 'wholesaler') selected @endif>Wholesaler</option>
                            <option value="distributor" @if(old('business_type') === 'distributor') selected @endif>Distributor</option>
                            <option value="manufacturer" @if(old('business_type') === 'manufacturer') selected @endif>Manufacturer</option>
                            <option value="reseller" @if(old('business_type') === 'reseller') selected @endif>Reseller</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Company Name *</label>
                    <input type="text" name="company_name" class="input-dark input-custom" placeholder="e.g., ABC Trading Co." value="{{ old('company_name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Trade License Number</label>
                    <input type="text" name="trade_license_number" class="input-dark input-custom" placeholder="License number" value="{{ old('trade_license_number') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tax ID</label>
                    <input type="text" name="tax_id" class="input-dark input-custom" placeholder="Tax identification number" value="{{ old('tax_id') }}">
                </div>
            </div>

            <!-- Section 2: Contact Information -->
            <div class="permission-title">Contact Information</div>
            <div class="row g-4 mb-5">
                <div class="col-md-12">
                    <label class="form-label">Contact Person</label>
                    <input type="text" name="contact_person" class="input-dark input-custom" placeholder="Primary contact person" value="{{ old('contact_person') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Contact Phone</label>
                    <input type="text" name="contact_phone" class="input-dark input-custom" placeholder="+880 1XXX-XXXXXX" value="{{ old('contact_phone') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Contact Email</label>
                    <input type="email" name="contact_email" class="input-dark input-custom" placeholder="business@email.com" value="{{ old('contact_email') }}">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Billing Address</label>
                    <div class="position-relative">
                        <textarea name="billing_address" class="input-dark input-custom" rows="2" placeholder="Complete billing address">{{ old('billing_address') }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Shipping Address</label>
                    <div class="position-relative">
                        <textarea name="shipping_address" class="input-dark input-custom" rows="2" placeholder="Complete shipping address">{{ old('shipping_address') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 3: Credit & Payment Terms -->
            <div class="permission-title">Credit & Payment Terms</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">Credit Limit (৳) *</label>
                    <input type="number" name="credit_limit" class="input-dark input-custom" placeholder="0.00" value="{{ old('credit_limit', 0) }}" min="0" step="0.01" required>
                    <small class="text-muted" style="font-size: 0.75rem; opacity: 0.6;">Maximum credit amount allowed</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Payment Terms *</label>
                    <div class="position-relative">
                        <select name="payment_terms" class="input-dark input-custom" required>
                            <option value="cash_on_delivery" @if(old('payment_terms') === 'cash_on_delivery') selected @endif>Cash on Delivery</option>
                            <option value="net_15" @if(old('payment_terms') === 'net_15') selected @endif>Net 15 Days</option>
                            <option value="net_30" @if(old('payment_terms') === 'net_30') selected @endif>Net 30 Days</option>
                            <option value="net_60" @if(old('payment_terms') === 'net_60') selected @endif>Net 60 Days</option>
                            <option value="net_90" @if(old('payment_terms') === 'net_90') selected @endif>Net 90 Days</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Payment Days *</label>
                    <input type="number" name="payment_days" class="input-dark input-custom" placeholder="0" value="{{ old('payment_days', 0) }}" min="0" max="365" required>
                    <small class="text-muted" style="font-size: 0.75rem; opacity: 0.6;">Days allowed for payment (0 = immediate)</small>
                </div>
            </div>

            <!-- Section 4: Pricing & Discounts -->
            <div class="permission-title">Pricing & Discounts</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">Pricing Tier *</label>
                    <div class="position-relative">
                        <select name="pricing_tier" class="input-dark input-custom" required>
                            <option value="standard" @if(old('pricing_tier') === 'standard') selected @endif>Standard</option>
                            <option value="silver" @if(old('pricing_tier') === 'silver') selected @endif>Silver</option>
                            <option value="gold" @if(old('pricing_tier') === 'gold') selected @endif>Gold</option>
                            <option value="platinum" @if(old('pricing_tier') === 'platinum') selected @endif>Platinum</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Wholesale Discount (%) *</label>
                    <input type="number" name="wholesale_discount" class="input-dark input-custom" placeholder="0.00" value="{{ old('wholesale_discount', 0) }}" min="0" max="100" step="0.01" required>
                    <small class="text-muted" style="font-size: 0.75rem; opacity: 0.6;">Discount on wholesale orders</small>
                </div>
            </div>

            <!-- Section 5: Approval Status -->
            <div class="permission-title">Approval Status</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">Status *</label>
                    <div class="position-relative">
                        <select name="approval_status" class="input-dark input-custom" required>
                            <option value="pending" @if(old('approval_status') === 'pending') selected @endif>Pending Approval</option>
                            <option value="approved" @if(old('approval_status') === 'approved') selected @endif>Approved (Active)</option>
                            <option value="rejected" @if(old('approval_status') === 'rejected') selected @endif>Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Notes</label>
                    <div class="position-relative">
                        <textarea name="notes" class="input-dark input-custom" rows="3" placeholder="Additional notes about this customer...">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex justify-content-end gap-3 mt-5 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="{{ route('admin.ecommerce.b2b.index') }}" class="btn-outline btn-reset" style="text-decoration: none; padding: 0.75rem 2rem; border-radius: 100px; display: inline-flex; align-items: center;">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
                <button type="submit" class="btn-gradient btn-create" style="padding: 0.75rem 2rem; border-radius: 100px;">
                    <i class="fas fa-check-circle me-2"></i>Create B2B Customer
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<style>
    .permission-title {
        color: var(--accent-blue);
        font-size: 0.85rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid rgba(59, 130, 246, 0.3);
    }

    .input-dark {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        transition: 0.3s;
        width: 100%;
    }

    .input-dark:focus {
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        outline: none;
    }

    .input-dark::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }

    .input-custom {
        font-size: 0.9rem;
    }

    textarea.input-dark {
        padding-left: 1rem;
        padding-top: 0.75rem;
        resize: vertical;
    }

    

    select.input-dark {
        padding-left: 1rem;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='rgba(255,255,255,0.5)'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1rem;
        padding-right: 2.75rem;
    }


    .form-label {
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .text-muted {
        color: rgba(255, 255, 255, 0.5) !important;
    }

    .btn-gradient {
        background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
        color: #fff;
        border: none;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        transition: 0.3s;
    }

    .btn-outline:hover {
        border-color: var(--accent-blue);
        background: rgba(59, 130, 246, 0.1);
    }

    .glass-card-dark {
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), 0 0 40px rgba(59, 130, 246, 0.1);
    }

    .logo-vms {
        background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: #fff;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }

    .letter-spacing-1 {
        letter-spacing: 1px;
    }

    .text-shadow-white {
        text-shadow: 0 2px 10px rgba(255, 255, 255, 0.3);
    }

    .text-shadow-blue {
        text-shadow: 0 2px 10px rgba(59, 130, 246, 0.5);
    }
</style>
@endpush
@endsection
