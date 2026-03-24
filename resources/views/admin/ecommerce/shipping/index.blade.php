@extends('layouts.admin')

@section('title', 'Shipping Settings - Saffron Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">SHIPPING SETTINGS</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Shipping Charges</h2>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); color: #22c55e;">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #ef4444;">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Shipping Settings Form -->
        <div style="max-width: 800px; margin: 0 auto;">
            <form action="{{ route('admin.ecommerce.shipping.update') }}" method="POST" class="shipping-form">
                @csrf

                <!-- Inside Dhaka -->
                <div class="mb-4">
                    <label class="form-label text-white mb-3" style="font-size: 1rem; font-weight: 600;">
                        <i class="fas fa-map-marker-alt me-2" style="color: var(--accent-blue);"></i>
                        Inside Dhaka Shipping Charge
                    </label>
                    <div class="input-group">
                        <span class="input-group-text" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff;">৳</span>
                        <input type="number"
                               name="inside_dhaka"
                               class="form-control"
                               value="{{ $shippingSettings['inside_dhaka'] }}"
                               min="0"
                               step="1"
                               required
                               style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; height: 50px; font-size: 1.1rem;">
                        <span class="input-group-text" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6);">BDT</span>
                    </div>
                    <small class="text-white-50 mt-2" style="font-size: 0.85rem;">
                        Shipping charge for deliveries inside Dhaka city
                    </small>
                    @error('inside_dhaka')
                        <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Outside Dhaka -->
                <div class="mb-4">
                    <label class="form-label text-white mb-3" style="font-size: 1rem; font-weight: 600;">
                        <i class="fas fa-map-marker-alt me-2" style="color: var(--accent-pink);"></i>
                        Outside Dhaka Shipping Charge
                    </label>
                    <div class="input-group">
                        <span class="input-group-text" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff;">৳</span>
                        <input type="number"
                               name="outside_dhaka"
                               class="form-control"
                               value="{{ $shippingSettings['outside_dhaka'] }}"
                               min="0"
                               step="1"
                               required
                               style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; height: 50px; font-size: 1.1rem;">
                        <span class="input-group-text" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6);">BDT</span>
                    </div>
                    <small class="text-white-50 mt-2" style="font-size: 0.85rem;">
                        Shipping charge for deliveries outside Dhaka city
                    </small>
                    @error('outside_dhaka')
                        <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Free Shipping Threshold -->
                <div class="mb-5">
                    <label class="form-label text-white mb-3" style="font-size: 1rem; font-weight: 600;">
                        <i class="fas fa-gift me-2" style="color: #22c55e;"></i>
                        Free Shipping Threshold
                    </label>
                    <div class="input-group">
                        <span class="input-group-text" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff;">৳</span>
                        <input type="number"
                               name="free_shipping_threshold"
                               class="form-control"
                               value="{{ $shippingSettings['free_shipping_threshold'] }}"
                               min="0"
                               step="1"
                               required
                               style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; height: 50px; font-size: 1.1rem;">
                        <span class="input-group-text" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6);">BDT</span>
                    </div>
                    <small class="text-white-50 mt-2" style="font-size: 0.85rem;">
                        Orders above this amount will qualify for free shipping
                    </small>
                    @error('free_shipping_threshold')
                        <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Info Cards -->
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 16px; padding: 1.5rem;">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 50px; height: 50px; background: rgba(59, 130, 246, 0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-truck" style="color: var(--accent-blue); font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="text-white mb-1 fw-bold" style="font-size: 0.95rem;">Inside Dhaka</h6>
                                    <p class="mb-0" style="color: rgba(255,255,255,0.6); font-size: 0.85rem;">৳{{ number_format($shippingSettings['inside_dhaka']) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 16px; padding: 1.5rem;">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 50px; height: 50px; background: rgba(139, 92, 246, 0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-shipping-fast" style="color: #8b5cf6; font-size: 1.5rem;"></i>
                                </div>
                                <div>
                                    <h6 class="text-white mb-1 fw-bold" style="font-size: 0.95rem;">Outside Dhaka</h6>
                                    <p class="mb-0" style="color: rgba(255,255,255,0.6); font-size: 0.85rem;">৳{{ number_format($shippingSettings['outside_dhaka']) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex gap-3 justify-content-end">
                    <a href="{{ route('admin.dashboard') }}" class="btn" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 0.75rem 2rem; border-radius: 100px;">
                        <i class="fas fa-arrow-left me-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-gradient" style="padding: 0.75rem 2rem; border-radius: 100px;">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-control:focus, .input-group-text:focus {
        background: rgba(255,255,255,0.08) !important;
        border-color: var(--accent-blue) !important;
        color: #fff !important;
        box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25) !important;
    }

    .form-control::placeholder {
        color: rgba(255,255,255,0.4);
    }

    .input-group-text {
        font-weight: 600;
    }
</style>
@endpush
