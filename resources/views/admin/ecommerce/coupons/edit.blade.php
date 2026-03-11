@extends('layouts.admin')

@section('title', 'Edit Coupon - Saffron Admin')

@section('content')
<div class="header-section">
    <div>
        <h2 class="fw-bold text-white mb-1">Edit Coupon <span class="text-white">কুপন সম্পাদনা করুন</span></h2>
        <p class="text-white mb-0">Update coupon details</p>
    </div>
    <a href="{{ route('admin.ecommerce.coupons.index') }}" class="btn btn-outline">
        <i class="fas fa-arrow-left me-2"></i> Back to Coupons
    </a>
</div>

<div class="glass-card-dark" style="max-width: 700px; margin: 0 auto;">
    <form action="{{ route('admin.ecommerce.coupons.update', $coupon) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Coupon Details -->
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-secondary border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-ticket-alt text-primary me-2"></i>Coupon Details</h5>
            </div>
            <div class="card-body">
                <!-- Coupon Code -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Coupon Code <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="code"
                           class="form-control bg-dark text-white border-secondary"
                           placeholder="e.g., SUMMER2026, WELCOME10"
                           value="{{ old('code', $coupon->code) }}"
                           required
                           style="text-transform: uppercase;"
                           autofocus>
                    @error('code')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Discount Type -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Discount Type <span class="text-danger">*</span>
                    </label>
                    <select name="type" class="form-select bg-dark text-white border-secondary" required>
                        <option value="percent" @if(old('type', $coupon->type) === 'percent') selected @endif>
                            Percentage % - শতাংশ
                        </option>
                        <option value="fixed" @if(old('type', $coupon->type) === 'fixed') selected @endif>
                            Fixed Amount - নির্দিষ্ট পরিমাণ
                        </option>
                    </select>
                    @error('type')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Discount Value -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Discount Value <span class="text-danger">*</span>
                    </label>
                    <input type="number"
                           name="value"
                           class="form-control bg-dark text-white border-secondary"
                           placeholder="e.g., 10 or 10.00"
                           step="0.01"
                           min="0"
                           value="{{ old('value', $coupon->value) }}"
                           required>
                    @error('value')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Discount Settings -->
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-warning border-secondary">
                <h5 class="mb-0 text-white"><i class="fas fa-cog text-warning me-2"></i>Discount Settings</h5>
            </div>
            <div class="card-body">
                <!-- Max Discount (for percentage only) -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Maximum Discount <span class="text-info">(Optional)</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-secondary text-white">৳</span>
                        <input type="number"
                               name="max_discount"
                               class="form-control bg-dark text-white border-secondary"
                               placeholder="e.g., 500"
                               step="0.01"
                               min="0"
                               value="{{ old('max_discount', $coupon->max_discount) }}">
                    </div>
                    <small class="text-muted">Maximum discount amount (for percentage discounts only)</small>
                    @error('max_discount')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Expiration Date -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Expiration Date <span class="text-info">(Optional)</span>
                    </label>
                    <input type="datetime-local"
                           name="expires_at"
                           class="form-control bg-dark text-white border-secondary"
                           value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d\TH:i') : '') }}">
                    <small class="text-muted">Leave empty for no expiration</small>
                    @error('expires_at')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Usage Limit -->
                <div class="mb-3">
                    <label class="form-label text-white">
                        Usage Limit <span class="text-info">(Optional)</span>
                    </label>
                    <input type="number"
                           name="usage_limit"
                           class="form-control bg-dark text-white border-secondary"
                           placeholder="e.g., 100"
                           min="1"
                           value="{{ old('usage_limit', $coupon->usage_limit) }}">
                    <small class="text-muted">Maximum number of times this coupon can be used (leave empty for unlimited)</small>
                    @error('usage_limit')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Coupon Info -->
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header bg-info border-secondary">
                <h6 class="mb-0 text-white"><i class="fas fa-info-circle me-2"></i>Current Statistics</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="text-muted small">Coupon ID:</label>
                        <div><code class="text-warning">#{{ $coupon->id }}</code></div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="text-muted small">Times Used:</label>
                        <div><span class="badge bg-primary">{{ $coupon->usage_count }}</span></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Created:</label>
                        <div class="text-white">{{ $coupon->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Orders Using Coupon:</label>
                        <div><span class="badge bg-success">{{ $coupon->orders()->count() }}</span></div>
                    </div>
                </div>

                @if($coupon->orders()->count() > 0)
                    <div class="alert alert-warning mt-3 mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> This coupon has been used in {{ $coupon->orders()->count() }} order(s). Changes will affect future uses only.
                    </div>
                @endif
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-gradient flex-grow-1">
                <i class="fas fa-save me-2"></i> Update Coupon / আপডেট করুন
            </button>
            <a href="{{ route('admin.ecommerce.coupons.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-times me-2"></i> Cancel
            </a>
        </div>
    </form>
</div>

@endsection
