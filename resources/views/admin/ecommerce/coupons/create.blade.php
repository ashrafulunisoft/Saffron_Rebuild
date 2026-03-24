@extends('layouts.admin')

@section('title', 'Create Coupon - Saffron Admin')

@section('content')
<div class="role-container" style="max-width: 1000px;">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0;">COUPON MANAGEMENT</span>
                </div>
            </div>
            <h2 class="fw-800 mb-0 text-white letter-spacing-1" style="font-size: 2rem;">Add Coupon</h2>
        </div>

        <form action="{{ route('admin.ecommerce.coupons.store') }}" method="POST">
            @csrf

            <!-- Section 1: Coupon Details -->
            <div class="permission-title">Coupon Details</div>
            <div class="row g-4 mb-5">
                <div class="col-md-12">
                    <label class="form-label">Coupon Code <span class="text-danger">*</span></label>
                    <input type="text"
                               name="code"
                               class="input-dark input-custom"
                               placeholder="e.g., SUMMER2026, WELCOME10"
                               value="{{ old('code') }}"
                               required
                               style="text-transform: uppercase;"
                               autofocus>
                    <small class="text-muted">Enter a unique code (will be converted to uppercase)</small>
                    @error('code')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Discount Type <span class="text-danger">*</span></label>
                    <div class="position-relative">
                        <select name="type" class="input-dark input-custom" required>
                            <option value="percent" @if(old('type') === 'percent') selected @endif>Percentage (%)</option>
                            <option value="fixed" @if(old('type') === 'fixed') selected @endif>Fixed Amount (৳)</option>
                        </select>
                    </div>
                    @error('type')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Discount Value <span class="text-danger">*</span></label>
                    <input type="number"
                               name="value"
                               class="input-dark input-custom"
                               placeholder="e.g., 10"
                               step="0.01"
                               min="0"
                               value="{{ old('value') }}"
                               required>
                    <small class="text-muted">Percentage (e.g., 10 for 10%) or Fixed Amount</small>
                    @error('value')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Section 2: Discount Settings -->
            <div class="permission-title">Discount Settings</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">Maximum Discount</label>
                    <input type="number"
                               name="max_discount"
                               class="input-dark input-custom"
                               placeholder="e.g., 500"
                               step="0.01"
                               min="0"
                               value="{{ old('max_discount') }}">
                    <small class="text-muted">Maximum discount amount (for percentage discounts)</small>
                    @error('max_discount')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Usage Limit</label>
                    <input type="number"
                               name="usage_limit"
                               class="input-dark input-custom"
                               placeholder="e.g., 100"
                               min="1"
                               value="{{ old('usage_limit') }}">
                    <small class="text-muted">Leave empty for unlimited usage</small>
                    @error('usage_limit')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Expiration Date</label>
                    <input type="datetime-local"
                               name="expires_at"
                               class="input-dark input-custom"
                               value="{{ old('expires_at') }}">
                    <small class="text-muted">Leave empty for no expiration</small>
                    @error('expires_at')
                        <div class="text-danger mt-2" style="font-size: 0.8rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex justify-content-end gap-3 mt-5 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="{{ route('admin.ecommerce.coupons.index') }}" class="btn-outline btn-reset" style="text-decoration: none; padding: 0.75rem 2rem; border-radius: 100px; display: inline-flex; align-items: center;">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
                <button type="submit" class="btn-gradient btn-create" style="padding: 0.75rem 2rem; border-radius: 100px;">
                    <i class="fas fa-check-circle me-2"></i>Create Coupon
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
@include('admin.ecommerce.partials.common-styles')

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

    .form-label {
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
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

    

    select.input-dark,
    input[type="datetime-local"].input-dark {
        padding-left: 1rem;
    }

    select.input-dark {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='rgba(255,255,255,0.5)'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1rem;
        padding-right: 2.75rem;
    }


    .text-muted {
        color: rgba(255, 255, 255, 0.5) !important;
    }

    .text-danger {
        color: #ef4444 !important;
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

    .role-container {
        margin: 0 auto;
    }
</style>
@endpush
@endsection
