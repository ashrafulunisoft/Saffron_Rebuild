<!-- LOGIN MODAL -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content auth-modal">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title">Welcome Back</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <p class="auth-subtitle">Sign in to access your account</p>
        <form id="loginForm" action="{{ route('login') }}" method="POST" novalidate>
          @csrf
          <div class="mb-3">
            <label class="auth-label">Email Address</label>
            <div class="auth-input-group">
              <i class="fas fa-envelope"></i>
              <input type="email" class="auth-input" name="email" placeholder="your@email.com" required value="{{ old('email') }}">
            </div>
            <div class="login-error text-danger small mt-1" data-field="email">
              @error('email'){{ $message }}@enderror
            </div>
          </div>
          <div class="mb-3">
            <label class="auth-label">Password</label>
            <div class="auth-input-group">
              <i class="fas fa-lock"></i>
              <input type="password" class="auth-input" name="password" placeholder="Enter your password" required>
              <button type="button" class="auth-toggle-pass" onclick="togglePassword(this)">
                <i class="fas fa-eye"></i>
              </button>
            </div>
            <div class="login-error text-danger small mt-1" data-field="password">
              @error('password'){{ $message }}@enderror
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-4">
            <label class="auth-checkbox" style="display:flex;align-items:center;gap:0.5rem;color:rgba(245,230,204,0.7);font-size:0.9rem;cursor:pointer;">
              <input type="checkbox" name="remember" style="width:auto;">
              <span>Remember me</span>
            </label>
            @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="auth-link">Forgot password?</a>
            @endif
          </div>
          <!-- General error message container -->
          <div class="login-general-error text-danger small mb-3" style="display:none;"></div>
          <button type="submit" class="btn btn-glow w-100 py-3" id="loginSubmitBtn">
            <i class="fas fa-sign-in-alt me-2"></i>Sign In
          </button>
        </form>
        {{-- <div class="auth-divider"><span>or continue with</span></div>
        <div class="d-flex gap-2">
          <button class="btn btn-social flex-fill"><i class="fab fa-google"></i> Google</button>
          <button class="btn btn-social flex-fill"><i class="fab fa-facebook-f"></i> Facebook</button>
        </div> --}}
        <p class="auth-footer mt-4">
          Don't have an account?
          <button type="button" class="btn btn-glow btn-sm" id="switchToRegisterBtn">Create Account</button>
        </p>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const loginSubmitBtn = document.getElementById('loginSubmitBtn');
    const switchBtn = document.getElementById('switchToRegisterBtn');

    // Handle login form submission via AJAX
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear previous errors
            document.querySelectorAll('.login-error').forEach(el => el.textContent = '');
            const generalError = document.querySelector('.login-general-error');
            if (generalError) {
                generalError.style.display = 'none';
                generalError.textContent = '';
            }

            // Disable button and show loading state
            const originalBtnContent = loginSubmitBtn.innerHTML;
            loginSubmitBtn.disabled = true;
            loginSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Signing in...';

            const formData = new FormData(loginForm);

            fetch(loginForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    // Login successful - redirect
                    window.location.href = response.url || '{{ route("customer.profile") }}';
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (!data) return; // Successful redirect

                // Re-enable button
                loginSubmitBtn.disabled = false;
                loginSubmitBtn.innerHTML = originalBtnContent;

                // Handle validation errors
                if (data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        const errorDiv = document.querySelector(`.login-error[data-field="${field}"]`);
                        if (errorDiv) {
                            errorDiv.textContent = data.errors[field][0];
                        }
                    });
                }

                // Handle general error (like "Invalid credentials")
                if (data.message) {
                    if (generalError) {
                        generalError.textContent = data.message;
                        generalError.style.display = 'block';
                    }
                    // Also show in email field error div as fallback
                    const emailError = document.querySelector('.login-error[data-field="email"]');
                    if (emailError && !data.errors) {
                        emailError.textContent = data.message;
                    }
                }
            })
            .catch(error => {
                console.error('Login error:', error);
                loginSubmitBtn.disabled = false;
                loginSubmitBtn.innerHTML = originalBtnContent;
                if (generalError) {
                    generalError.textContent = 'An error occurred. Please try again.';
                    generalError.style.display = 'block';
                }
            });
        });
    }

    // Handle switching from login modal to register modal
    if (switchBtn) {
        switchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const loginModalEl = document.getElementById('loginModal');
            const loginModal = bootstrap.Modal.getInstance(loginModalEl);

            // When login modal is fully hidden, open register modal
            loginModalEl.addEventListener('hidden.bs.modal', function handler() {
                loginModalEl.removeEventListener('hidden.bs.modal', handler);
                const registerModalEl = document.getElementById('registerModal');
                const registerModal = new bootstrap.Modal(registerModalEl);
                registerModal.show();
            });

            // Hide login modal
            if (loginModal) {
                loginModal.hide();
            }
        });
    }
});
</script>
