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
        <form method="POST" action="{{ route('login') }}" id="loginForm">
          @csrf
          <div class="mb-3">
            <label class="auth-label">Email Address</label>
            <div class="auth-input-group">
              <i class="fas fa-envelope"></i>
              <input type="email" class="auth-input" name="email" placeholder="your@email.com" required value="{{ old('email') }}">
            </div>
            @error('email')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
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
            @error('password')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
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
          <button type="submit" class="btn btn-glow w-100 py-3">
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
// Handle switching from login modal to register modal
document.addEventListener('DOMContentLoaded', function() {
    const switchBtn = document.getElementById('switchToRegisterBtn');
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
