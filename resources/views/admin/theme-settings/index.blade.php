@extends('layouts.admin')

@section('title', 'Theme Settings - Admin')

@push('styles')
<style>
    .color-picker-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .color-picker-input {
        width: 60px;
        height: 44px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        padding: 0;
        background: transparent;
    }
    .color-picker-input::-webkit-color-swatch-wrapper {
        padding: 0;
    }
    .color-picker-input::-webkit-color-swatch {
        border: 2px solid rgba(255,255,255,0.2);
        border-radius: 8px;
    }
    .color-hex-input {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 10px;
        padding: 0.6rem 1rem;
        color: #fff;
        font-family: monospace;
        font-size: 0.9rem;
        width: 120px;
    }
    .color-hex-input:focus {
        outline: none;
        border-color: var(--accent-blue, #3b82f6);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }
    .theme-preview-card {
        background: linear-gradient(135deg, {{ $theme->bg_gradient_1 ?? '#0f0a00' }} 0%, {{ $theme->bg_gradient_2 ?? '#1a0a00' }} 50%, {{ $theme->bg_gradient_3 ?? '#0f0502' }} 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(255,255,255,0.1);
    }
    .preview-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .preview-btn-primary {
        background: linear-gradient(135deg, {{ $theme->btn_gradient_start ?? '#f59e0b' }}, {{ $theme->btn_gradient_end ?? '#f43f5e' }});
        color: white;
    }
    .preview-btn-secondary {
        background: rgba(255,255,255,0.1);
        color: {{ $theme->text_primary ?? '#f5e6cc' }};
        border: 1px solid rgba(255,255,255,0.2);
    }
    .preview-menu-item {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .preview-menu-item:hover {
        background: linear-gradient(90deg, {{ $theme->menu_hover_start ?? '#f59e0b' }}, {{ $theme->menu_hover_end ?? '#f43f5e' }});
        color: white;
    }
    .setting-section {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .setting-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .setting-section-title i {
        color: var(--accent-blue, #3b82f6);
    }
    .color-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }
    .color-row:last-child {
        border-bottom: none;
    }
    .color-label {
        color: rgba(255,255,255,0.8);
        font-size: 0.95rem;
    }
    .color-label small {
        display: block;
        color: rgba(255,255,255,0.5);
        font-size: 0.8rem;
        margin-top: 2px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, #8b5cf6, #ec4899);">T</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">THEME SETTINGS</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Theme Customization</h2>
                <button type="button" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;" onclick="resetTheme()">
                    <i class="fas fa-undo me-2"></i>Reset to Default
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.3); color: #22c55e; margin-bottom: 1.5rem; border-radius: 12px;">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1);"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.3); color: white; margin-bottom: 1.5rem; border-radius: 12px;">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1);"></button>
            </div>
        @endif

        <div class="row">
            <!-- Preview Section -->
            <div class="col-lg-4 mb-4">
                <div class="setting-section">
                    <div class="setting-section-title">
                        <i class="fas fa-eye"></i>
                        Live Preview
                    </div>
                    <div class="theme-preview-card" id="themePreviewCard">
                        <div style="margin-bottom: 1rem;">
                            <div id="previewMenu" style="display: flex; gap: 0.5rem; margin-bottom: 1.5rem;">
                                <span class="preview-menu-item" style="cursor: pointer;">Home</span>
                                <span class="preview-menu-item" style="cursor: pointer;">Shop</span>
                                <span class="preview-menu-item" style="cursor: pointer;">About</span>
                            </div>
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <h4 id="previewTitle" style="color: {{ $theme->text_secondary ?? '#fbbf24' }}; margin-bottom: 0.5rem;">Welcome to Saffron</h4>
                            <p id="previewText" style="color: {{ $theme->text_primary ?? '#f5e6cc' }}; opacity: 0.8; font-size: 0.9rem; margin-bottom: 1.5rem;">
                                Premium sweets and bakery items with authentic taste.
                            </p>
                        </div>
                        <div style="display: flex; gap: 0.75rem;">
                            <button id="previewBtnPrimary" class="preview-btn preview-btn-primary">
                                Shop Now
                            </button>
                            <button id="previewBtnSecondary" class="preview-btn preview-btn-secondary">
                                Learn More
                            </button>
                        </div>
                    </div>
                    <small style="color: rgba(255,255,255,0.5); display: block; text-align: center;">
                        <i class="fas fa-info-circle me-1"></i>Preview updates automatically as you change colors
                    </small>
                </div>
            </div>

            <!-- Settings Form -->
            <div class="col-lg-8">
                <form action="{{ route('admin.ecommerce.theme-settings.update') }}" method="POST" id="themeSettingsForm">
                    @csrf
                    @method('PUT')

                    <!-- Primary Colors -->
                    <div class="setting-section">
                        <div class="setting-section-title">
                            <i class="fas fa-palette"></i>
                            Primary Colors
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="color-row">
                                    <div class="color-label">
                                        Primary Color
                                        <small>Main brand color</small>
                                    </div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="primary_color" value="{{ $theme->primary_color }}" class="color-picker-input" data-preview="primary">
                                        <input type="text" value="{{ $theme->primary_color }}" class="color-hex-input" data-linked="primary_color" maxlength="7">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="color-row">
                                    <div class="color-label">
                                        Primary Light
                                        <small>Lighter variant</small>
                                    </div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="primary_color_light" value="{{ $theme->primary_color_light }}" class="color-picker-input" data-preview="primary-light">
                                        <input type="text" value="{{ $theme->primary_color_light }}" class="color-hex-input" data-linked="primary_color_light" maxlength="7">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="color-row">
                                    <div class="color-label">
                                        Primary Dark
                                        <small>Darker variant</small>
                                    </div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="primary_color_dark" value="{{ $theme->primary_color_dark }}" class="color-picker-input">
                                        <input type="text" value="{{ $theme->primary_color_dark }}" class="color-hex-input" data-linked="primary_color_dark" maxlength="7">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Secondary Colors -->
                    <div class="setting-section">
                        <div class="setting-section-title">
                            <i class="fas fa-fill-drip"></i>
                            Secondary Colors
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="color-row">
                                    <div class="color-label">
                                        Secondary Color
                                        <small>Accent highlights</small>
                                    </div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="secondary_color" value="{{ $theme->secondary_color }}" class="color-picker-input" data-preview="secondary">
                                        <input type="text" value="{{ $theme->secondary_color }}" class="color-hex-input" data-linked="secondary_color" maxlength="7">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="color-row">
                                    <div class="color-label">
                                        Secondary Dark
                                        <small>Darker variant</small>
                                    </div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="secondary_color_dark" value="{{ $theme->secondary_color_dark }}" class="color-picker-input">
                                        <input type="text" value="{{ $theme->secondary_color_dark }}" class="color-hex-input" data-linked="secondary_color_dark" maxlength="7">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Accent Color -->
                    <div class="setting-section">
                        <div class="setting-section-title">
                            <i class="fas fa-star"></i>
                            Accent Color
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="color-row">
                                    <div class="color-label">
                                        Accent Color
                                        <small>Special highlights</small>
                                    </div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="accent_color" value="{{ $theme->accent_color ?? '#8b5cf6' }}" class="color-picker-input">
                                        <input type="text" value="{{ $theme->accent_color ?? '#8b5cf6' }}" class="color-hex-input" data-linked="accent_color" maxlength="7">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Background Gradient -->
                    <div class="setting-section">
                        <div class="setting-section-title">
                            <i class="fas fa-image"></i>
                            Background Gradient Colors
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="color-row">
                                    <div class="color-label">Gradient 1</div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="bg_gradient_1" value="{{ $theme->bg_gradient_1 }}" class="color-picker-input" data-preview="bg">
                                        <input type="text" value="{{ $theme->bg_gradient_1 }}" class="color-hex-input" data-linked="bg_gradient_1" maxlength="7">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="color-row">
                                    <div class="color-label">Gradient 2</div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="bg_gradient_2" value="{{ $theme->bg_gradient_2 }}" class="color-picker-input" data-preview="bg">
                                        <input type="text" value="{{ $theme->bg_gradient_2 }}" class="color-hex-input" data-linked="bg_gradient_2" maxlength="7">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="color-row">
                                    <div class="color-label">Gradient 3</div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="bg_gradient_3" value="{{ $theme->bg_gradient_3 }}" class="color-picker-input" data-preview="bg">
                                        <input type="text" value="{{ $theme->bg_gradient_3 }}" class="color-hex-input" data-linked="bg_gradient_3" maxlength="7">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="color-row">
                                    <div class="color-label">Gradient 4</div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="bg_gradient_4" value="{{ $theme->bg_gradient_4 }}" class="color-picker-input" data-preview="bg">
                                        <input type="text" value="{{ $theme->bg_gradient_4 }}" class="color-hex-input" data-linked="bg_gradient_4" maxlength="7">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="color-row">
                                    <div class="color-label">Gradient 5</div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="bg_gradient_5" value="{{ $theme->bg_gradient_5 }}" class="color-picker-input" data-preview="bg">
                                        <input type="text" value="{{ $theme->bg_gradient_5 }}" class="color-hex-input" data-linked="bg_gradient_5" maxlength="7">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Button & Menu Gradients -->
                    <div class="setting-section">
                        <div class="setting-section-title">
                            <i class="fas fa-magic"></i>
                            Button & Menu Hover Gradients
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="color-row">
                                    <div class="color-label">
                                        Button Start
                                        <small>Gradient start</small>
                                    </div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="btn_gradient_start" value="{{ $theme->btn_gradient_start }}" class="color-picker-input" data-preview="btn">
                                        <input type="text" value="{{ $theme->btn_gradient_start }}" class="color-hex-input" data-linked="btn_gradient_start" maxlength="7">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="color-row">
                                    <div class="color-label">
                                        Button End
                                        <small>Gradient end</small>
                                    </div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="btn_gradient_end" value="{{ $theme->btn_gradient_end }}" class="color-picker-input" data-preview="btn">
                                        <input type="text" value="{{ $theme->btn_gradient_end }}" class="color-hex-input" data-linked="btn_gradient_end" maxlength="7">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="color-row">
                                    <div class="color-label">
                                        Menu Hover Start
                                        <small>On hover</small>
                                    </div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="menu_hover_start" value="{{ $theme->menu_hover_start }}" class="color-picker-input" data-preview="menu">
                                        <input type="text" value="{{ $theme->menu_hover_start }}" class="color-hex-input" data-linked="menu_hover_start" maxlength="7">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="color-row">
                                    <div class="color-label">
                                        Menu Hover End
                                        <small>On hover</small>
                                    </div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="menu_hover_end" value="{{ $theme->menu_hover_end }}" class="color-picker-input" data-preview="menu">
                                        <input type="text" value="{{ $theme->menu_hover_end }}" class="color-hex-input" data-linked="menu_hover_end" maxlength="7">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Text Colors -->
                    <div class="setting-section">
                        <div class="setting-section-title">
                            <i class="fas fa-font"></i>
                            Text Colors
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="color-row">
                                    <div class="color-label">
                                        Primary Text
                                        <small>Main text color</small>
                                    </div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="text_primary" value="{{ $theme->text_primary }}" class="color-picker-input" data-preview="text">
                                        <input type="text" value="{{ $theme->text_primary }}" class="color-hex-input" data-linked="text_primary" maxlength="7">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="color-row">
                                    <div class="color-label">
                                        Secondary Text
                                        <small>Brand/titles</small>
                                    </div>
                                    <div class="color-picker-wrapper">
                                        <input type="color" name="text_secondary" value="{{ $theme->text_secondary }}" class="color-picker-input" data-preview="text-secondary">
                                        <input type="text" value="{{ $theme->text_secondary }}" class="color-hex-input" data-linked="text_secondary" maxlength="7">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <button type="button" class="btn btn-outline-light px-4 py-2" onclick="resetTheme()">
                            <i class="fas fa-undo me-2"></i>Reset to Default
                        </button>
                        <button type="submit" class="btn-gradient px-5 py-2" style="border-radius: 100px; border: none;">
                            <i class="fas fa-save me-2"></i>Save Theme Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Reset Form (hidden) -->
<form action="{{ route('admin.ecommerce.theme-settings.reset') }}" method="POST" id="resetThemeForm">
    @csrf
    @method('POST')
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sync color picker with hex input
    document.querySelectorAll('.color-picker-input').forEach(picker => {
        picker.addEventListener('input', function() {
            const hexInput = this.nextElementSibling;
            hexInput.value = this.value.toUpperCase();
            updatePreview();
        });
    });

    // Sync hex input with color picker
    document.querySelectorAll('.color-hex-input').forEach(hexInput => {
        hexInput.addEventListener('input', function() {
            let value = this.value;
            if (!value.startsWith('#')) {
                value = '#' + value;
            }
            if (/^#[0-9A-Fa-f]{6}$/.test(value)) {
                const picker = this.previousElementSibling;
                picker.value = value;
                updatePreview();
            }
        });

        // Format on blur
        hexInput.addEventListener('blur', function() {
            let value = this.value.trim();
            if (!value.startsWith('#')) {
                value = '#' + value;
            }
            if (/^#[0-9A-Fa-f]{6}$/.test(value)) {
                this.value = value.toUpperCase();
            }
        });
    });

    // Live preview update
    function updatePreview() {
        const form = document.getElementById('themeSettingsForm');
        const formData = new FormData(form);

        // Get all values
        const colors = {};
        for (let [key, value] of formData.entries()) {
            colors[key] = value;
        }

        // Update preview card background
        const previewCard = document.getElementById('themePreviewCard');
        previewCard.style.background = `linear-gradient(135deg, ${colors.bg_gradient_1} 0%, ${colors.bg_gradient_2} 50%, ${colors.bg_gradient_3} 100%)`;

        // Update button gradient
        const primaryBtn = document.getElementById('previewBtnPrimary');
        primaryBtn.style.background = `linear-gradient(135deg, ${colors.btn_gradient_start}, ${colors.btn_gradient_end})`;

        // Update menu hover
        document.querySelectorAll('.preview-menu-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.background = `linear-gradient(90deg, ${colors.menu_hover_start}, ${colors.menu_hover_end})`;
                this.style.color = 'white';
            });
            item.addEventListener('mouseleave', function() {
                this.style.background = 'transparent';
                this.style.color = colors.text_primary;
            });
        });

        // Update text colors
        document.getElementById('previewTitle').style.color = colors.text_secondary;
        document.getElementById('previewText').style.color = colors.text_primary;
        document.getElementById('previewBtnSecondary').style.color = colors.text_primary;
    }

    // Reset theme function
    window.resetTheme = function() {
        if (confirm('Are you sure you want to reset the theme to default settings?')) {
            document.getElementById('resetThemeForm').submit();
        }
    };
});
</script>
@endpush
