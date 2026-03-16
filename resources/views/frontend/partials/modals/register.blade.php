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
          <div class="mb-3">
            <label class="auth-label">Full Name</label>
            <div class="auth-input-group">
              <i class="fas fa-user"></i>
              <input type="text" class="auth-input" name="name" placeholder="Enter your full name" required value="{{ old('name') }}">
            </div>
            @error('name')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>
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
            <label class="auth-label">Phone Number <span class="text-white-50">(Optional)</span></label>
            <div class="auth-input-group">
              <i class="fas fa-phone"></i>
              <input type="tel" class="auth-input" name="phone" placeholder="01XXXXXXXXX" value="{{ old('phone') }}">
            </div>
            @error('phone')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="auth-label">Password <span class="text-white-50">(min 8 characters)</span></label>
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
          <div class="mb-3">
            <label class="auth-label">Confirm Password</label>
            <div class="auth-input-group">
              <i class="fas fa-lock"></i>
              <input type="password" class="auth-input" name="password_confirmation" placeholder="Confirm your password" required>
              <button type="button" class="auth-toggle-pass" onclick="togglePassword(this)">
                <i class="fas fa-eye"></i>
              </button>
            </div>
            @error('password_confirmation')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-4">
            <label class="auth-label" style="display:block;margin-bottom:0.5rem;">
              <i class="fas fa-check-circle me-1"></i> Terms & Conditions
            </label>
            <div class="terms-agreement" style="display:flex;gap:0.75rem;align-items:center;flex-wrap:wrap;">
              <label class="terms-checkbox-btn" style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;background:rgba(59,130,246,0.1);border:1px solid rgba(59,130,246,0.3);border-radius:8px;cursor:pointer;transition:all 0.3s;">
                <input type="checkbox" name="terms" value="1" required id="termsCheckbox" style="width:auto;cursor:pointer;">
                <span style="color:rgba(245,230,204,0.8);font-size:0.9rem;cursor:pointer;">I agree to the terms</span>
              </label>
              <div style="display:flex;gap:0.5rem;align-items:center;">
                <a href="{{ route('terms') }}" class="btn btn-sm" style="background:rgba(139,92,246,0.2);color:#a855f7;border:1px solid rgba(139,92,246,0.3);padding:0.3rem 0.8rem;border-radius:6px;text-decoration:none;font-size:0.85rem;transition:all 0.3s;" data-bs-dismiss="modal">
                  <i class="fas fa-file-contract me-1"></i>Terms
                </a>
                <a href="{{ route('privacy') }}" class="btn btn-sm" style="background:rgba(59,130,246,0.2);color:var(--accent-blue);border:1px solid rgba(59,130,246,0.3);padding:0.3rem 0.8rem;border-radius:6px;text-decoration:none;font-size:0.85rem;transition:all 0.3s;" data-bs-dismiss="modal">
                  <i class="fas fa-shield-alt me-1"></i>Privacy
                </a>
              </div>
            </div>
            @error('terms')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>
          <button type="submit" class="btn btn-glow w-100 py-3">
            <i class="fas fa-user-plus me-2"></i>Create Account
          </button>
        </form>
        <style>
          .terms-checkbox-btn:hover {
            background: rgba(59,130,246,0.2) !important;
            border-color: rgba(59,130,246,0.5) !important;
            transform: translateY(-1px);
          }
          .terms-checkbox-btn input[type="checkbox"]:checked + span {
            color: #22c55e !important;
            font-weight: 600;
          }
          .terms-checkbox-btn input[type="checkbox"] {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(59,130,246,0.5);
            border-radius: 4px;
            cursor: pointer;
            position: relative;
            transition: all 0.3s;
          }
          .terms-checkbox-btn input[type="checkbox"]:checked {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border-color: #22c55e;
          }
          .terms-checkbox-btn input[type="checkbox"]:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 12px;
            left: 3px;
            top: -1px;
            font-weight: bold;
          }
        </style>
        <style>
          .terms-checkbox-btn:hover {
            background: rgba(59,130,246,0.2) !important;
            border-color: rgba(59,130,246,0.5) !important;
            transform: translateY(-1px);
          }
          .terms-checkbox-btn input[type="checkbox"]:checked + span {
            color: #22c55e !important;
            font-weight: 600;
          }
          .terms-checkbox-btn input[type="checkbox"] {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(59,130,246,0.5);
            border-radius: 4px;
            cursor: pointer;
            position: relative;
            transition: all 0.3s;
          }
          .terms-checkbox-btn input[type="checkbox"]:checked {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border-color: #22c55e;
          }
          .terms-checkbox-btn input[type="checkbox"]:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 12px;
            left: 3px;
            top: -1px;
            font-weight: bold;
          }
        </style>
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
