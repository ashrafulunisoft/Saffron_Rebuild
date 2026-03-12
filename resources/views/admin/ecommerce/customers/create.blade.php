@extends('layouts.admin')

@section('title', 'Add Customer - Saffron Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">CUSTOMER MANAGEMENT</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Add Customer</h2>
                <a href="{{ route('admin.ecommerce.customers.index') }}" class="btn-outline" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>

        <!-- Create Customer Form -->
        <div style="max-width: 800px; margin: 0 auto;">
            <form method="POST" action="{{ route('admin.ecommerce.customers.store') }}">
                @csrf

                <!-- Account Information -->
                <div style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; padding: 2rem; margin-bottom: 2rem;">
                    <h6 class="fw-800 mb-4 text-white" style="font-size: 1rem;">
                        <i class="fas fa-user-circle me-2" style="color: var(--accent-blue);"></i>Account Information
                    </h6>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="text"
                                           name="name"
                                           class="input-dark"
                                           placeholder="Enter customer name"
                                           value="{{ old('name') }}"
                                           required
                                           style="padding-left: 1rem;">
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="email"
                                           name="email"
                                           class="input-dark"
                                           placeholder="customer@example.com"
                                           value="{{ old('email') }}"
                                           required
                                           style="padding-left: 1rem;">
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label">Phone Number</label>
                                <div class="position-relative">
                                    <input type="text"
                                           name="phone"
                                           class="input-dark"
                                           placeholder="+880 1XXX-XXXXXX"
                                           value="{{ old('phone') }}"
                                           style="padding-left: 1rem;">
                                </div>
                                @error('phone')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label">Role</label>
                                <select name="role" class="input-dark" style="padding-left: 1rem;">
                                    <option value="">Select Role (Optional)</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <small class="text-muted" style="font-size: 0.75rem;">If no role selected, "customer" role will be assigned</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Information -->
                <div style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; padding: 2rem; margin-bottom: 2rem;">
                    <h6 class="fw-800 mb-4 text-white" style="font-size: 1rem;">
                        <i class="fas fa-lock me-2" style="color: #fbbf24;"></i>Security Information
                    </h6>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="input-dark"
                                           placeholder="Enter password"
                                           required
                                           minlength="8"
                                           style="padding-left: 1rem;">
                                    <button type="button"
                                            class="btn-toggle-password"
                                            onclick="togglePassword('password', this)"
                                            style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: rgba(255,255,255,0.5); cursor: pointer;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <small class="text-muted" style="font-size: 0.75rem;">Minimum 8 characters</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           class="input-dark"
                                           placeholder="Confirm password"
                                           required
 minlength="8"
                                           style="padding-left: 1rem;">
                                    <button type="button"
                                            class="btn-toggle-password"
                                            onclick="togglePassword('password_confirmation', this)"
                                            style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: rgba(255,255,255,0.5); cursor: pointer;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Options -->
                <div style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; padding: 2rem; margin-bottom: 2rem;">
                    <h6 class="fw-800 mb-4 text-white" style="font-size: 1rem;">
                        <i class="fas fa-cog me-2" style="color: #a855f7);"></i>Additional Options
                    </h6>

                    <div class="form-check" style="padding: 0.5rem 1rem; background: rgba(15, 23, 42, 0.4); border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                        <input class="form-check-input"
                               type="checkbox"
                               name="send_email"
                               id="send_email"
                               value="1"
                               style="background: rgba(15, 23, 42, 0.6); border-color: rgba(255,255,255,0.2);">
                        <label class="form-check-label" for="send_email" style="color: rgba(255,255,255,0.8); margin-left: 0.5rem; cursor: pointer;">
                            Send welcome email to customer with login credentials
                        </label>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex gap-3">
                    <button type="submit" class="btn-gradient" style="padding: 0.75rem 2.5rem; border-radius: 100px; border: none; cursor: pointer; position: relative; overflow: hidden; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);">
                        <i class="fas fa-save me-2"></i>Create Customer
                    </button>
                    <a href="{{ route('admin.ecommerce.customers.index') }}" class="btn-outline" style="padding: 0.75rem 2rem; border-radius: 100px; text-decoration: none;">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
@include('admin.ecommerce.partials.common-styles')

<style>
    /* Fade In Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    form {
        animation: fadeInUp 0.6s ease-out;
    }

    .input-dark {
        transition: all 0.3s ease;
    }

    .input-dark:focus {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3),
                    0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    .btn-gradient {
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-gradient::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .btn-gradient:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-gradient:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4),
                    0 0 40px rgba(59, 130, 246, 0.2),
                    inset 0 0 20px rgba(255, 255, 255, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
function togglePassword(fieldId, button) {
    const field = document.getElementById(fieldId);
    const icon = button.querySelector('i');

    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endpush
@endsection
