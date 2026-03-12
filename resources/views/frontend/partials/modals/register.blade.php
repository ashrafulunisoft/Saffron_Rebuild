<!-- REGISTER MODAL -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content auth-modal">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title">Create Account</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <p class="auth-subtitle">Join Saffron Sweets today</p>
        <form method="POST" action="{{ route('register') }}" id="registerForm">
          @csrf
          <div class="row g-3">
            <div class="col-6">
              <label class="auth-label">First Name</label>
              <div class="auth-input-group">
                <i class="fas fa-user"></i>
                <input type="text" class="auth-input" name="first_name" placeholder="John" required value="{{ old('first_name') }}">
              </div>
            </div>
            <div class="col-6">
              <label class="auth-label">Last Name</label>
              <div class="auth-input-group">
                <i class="fas fa-user"></i>
                <input type="text" class="auth-input" name="last_name" placeholder="Doe" required value="{{ old('last_name') }}">
              </div>
            </div>
          </div>
          <div class="mb-3 mt-3">
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
              <input type="password" class="auth-input" name="password" placeholder="Create password" required>
              <button type="button" class="auth-toggle-pass" onclick="togglePassword(this)">
                <i class="fas fa-eye"></i>
              </button>
            </div>
            @error('password')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-4">
            <label class="auth-checkbox" style="display:flex;align-items:center;gap:0.5rem;color:rgba(245,230,204,0.7);font-size:0.9rem;cursor:pointer;">
              <input type="checkbox" name="terms" required style="width:auto;">
              <span>I agree to the <a href="{{ route('terms') }}" class="auth-link" data-bs-dismiss="modal">Terms of Service</a> and <a href="{{ route('policy') }}" class="auth-link" data-bs-dismiss="modal">Privacy Policy</a></span>
            </label>
          </div>
          <button type="submit" class="btn btn-glow w-100 py-3">
            <i class="fas fa-user-plus me-2"></i>Create Account
          </button>
        </form>
        <div class="auth-divider"><span>or sign up with</span></div>
        <div class="d-flex gap-2">
          <button class="btn btn-social flex-fill"><i class="fab fa-google"></i> Google</button>
          <button class="btn btn-social flex-fill"><i class="fab fa-facebook-f"></i> Facebook</button>
        </div>
        <p class="auth-footer mt-4">
          Already have an account?
          <a href="#" class="auth-link" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a>
        </p>
      </div>
    </div>
  </div>
</div>
