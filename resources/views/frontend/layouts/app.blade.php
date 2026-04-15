<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Saffron Sweets & Bakery | Authentic Bengali Sweets & Premium Bakery')</title>

    <!-- Favicon - Saffron Cookie Icon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='45' fill='%23f59e0b'/><circle cx='30' cy='35' r='8' fill='%2392400e'/><circle cx='55' cy='25' r='6' fill='%23924e00'/><circle cx='70' cy='45' r='7' fill='%2378350f'/><circle cx='40' cy='60' r='5' fill='%2345102e'/><circle cx='65' cy='70' r='6' fill='%23783e0f'/><circle cx='25' cy='55' r='5' fill='%23784509'/></svg>">
    <link rel="apple-touch-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='45' fill='%23f59e0b'/><circle cx='30' cy='35' r='8' fill='%23924e00'/><circle cx='55' cy='25' r='6' fill='%23924e00'/><circle cx='70' cy='45' r='7' fill='%23783e0f'/><circle cx='40' cy='60' r='5' fill='%23783e0f'/><circle cx='65' cy='70' r='6' fill='%23924e00'/><circle cx='25' cy='55' r='5' fill='%23783e0f'/></svg>">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    @stack('styles')
    @php
        // Get theme settings
        $theme = \App\Models\ThemeSetting::getActive();

        // Convert hex to RGB for rgba() usage
        $textPrimaryHex = str_replace('#', '', $theme->text_primary);
        $textPrimaryRgb = sscanf($textPrimaryHex, '%02x%02x%02x');
        $textPrimaryRgbString = implode(', ', $textPrimaryRgb);

        $primaryHex = str_replace('#', '', $theme->primary_color);
        $primaryRgb = sscanf($primaryHex, '%02x%02x%02x');
        $primaryRgbString = implode(', ', $primaryRgb);

        $secondaryHex = str_replace('#', '', $theme->secondary_color);
        $secondaryRgb = sscanf($secondaryHex, '%02x%02x%02x');
        $secondaryRgbString = implode(', ', $secondaryRgb);
    @endphp
    <style>
    :root {
        /* Theme Colors from Database */
        --theme-primary: {{ $theme->primary_color }};
        --theme-primary-light: {{ $theme->primary_color_light }};
        --theme-primary-dark: {{ $theme->primary_color_dark }};
        --theme-primary-rgb: {{ $primaryRgbString }};
        --theme-secondary: {{ $theme->secondary_color }};
        --theme-secondary-dark: {{ $theme->secondary_color_dark }};
        --theme-secondary-rgb: {{ $secondaryRgbString }};
        --theme-accent: {{ $theme->accent_color }};
        --theme-text-primary: {{ $theme->text_primary }};
        --theme-text-secondary: {{ $theme->text_secondary }};
        --theme-text-primary-rgb: {{ $textPrimaryRgbString }};
        --theme-btn-gradient: linear-gradient(135deg, {{ $theme->btn_gradient_start }}, {{ $theme->btn_gradient_end }});
        --theme-menu-hover: linear-gradient(90deg, {{ $theme->menu_hover_start }}, {{ $theme->menu_hover_end }});

        /* Text color with opacity variations */
        --text-100: rgba({{ $textPrimaryRgbString }}, 1);
        --text-95: rgba({{ $textPrimaryRgbString }}, 0.95);
        --text-90: rgba({{ $textPrimaryRgbString }}, 0.9);
        --text-85: rgba({{ $textPrimaryRgbString }}, 0.85);
        --text-80: rgba({{ $textPrimaryRgbString }}, 0.8);
        --text-75: rgba({{ $textPrimaryRgbString }}, 0.75);
        --text-70: rgba({{ $textPrimaryRgbString }}, 0.7);
        --text-65: rgba({{ $textPrimaryRgbString }}, 0.65);
        --text-60: rgba({{ $textPrimaryRgbString }}, 0.6);
        --text-55: rgba({{ $textPrimaryRgbString }}, 0.55);
        --text-50: rgba({{ $textPrimaryRgbString }}, 0.5);
        --text-45: rgba({{ $textPrimaryRgbString }}, 0.45);
        --text-40: rgba({{ $textPrimaryRgbString }}, 0.4);
        --text-35: rgba({{ $textPrimaryRgbString }}, 0.35);
        --text-30: rgba({{ $textPrimaryRgbString }}, 0.3);
        --text-25: rgba({{ $textPrimaryRgbString }}, 0.25);
        --text-20: rgba({{ $textPrimaryRgbString }}, 0.2);
        --text-15: rgba({{ $textPrimaryRgbString }}, 0.15);
        --text-10: rgba({{ $textPrimaryRgbString }}, 0.1);
        --text-08: rgba({{ $textPrimaryRgbString }}, 0.08);
        --text-05: rgba({{ $textPrimaryRgbString }}, 0.05);
        --text-03: rgba({{ $textPrimaryRgbString }}, 0.03);
        --text-02: rgba({{ $textPrimaryRgbString }}, 0.02);

        /* Legacy variables for backward compatibility */
        --amber: {{ $theme->primary_color }};
        --amber-dark: {{ $theme->primary_color_dark }};
        --amber-light: {{ $theme->primary_color_light }};
        --rose: {{ $theme->secondary_color }};
        --rose-dark: {{ $theme->secondary_color_dark }};
        --gold: {{ $theme->primary_color_light }};

        /* Glass Effect */
        --glass-bg: {{ $theme->glass_bg }};
        --glass-border: {{ $theme->glass_border }};
        --glass-blur: blur(20px);
    }

    * { margin:0; padding:0; box-sizing:border-box; }
    html { scroll-behavior:smooth; }

    body {
        font-family:'Poppins',sans-serif;
        background: linear-gradient(135deg, {{ $theme->bg_gradient_1 }} 0%, {{ $theme->bg_gradient_2 }} 20%, {{ $theme->bg_gradient_3 }} 40%, {{ $theme->bg_gradient_4 }} 60%, {{ $theme->bg_gradient_2 }} 80%, {{ $theme->bg_gradient_5 }} 100%);
        min-height:100vh;
        color: var(--theme-text-primary);
        overflow-x:hidden;
    }

/* Animated Background Particles */
.particles-container {
  position:fixed; top:0; left:0; width:100%; height:100%;
  pointer-events:none; z-index:0; overflow:hidden;
}
.particle {
  position:absolute; border-radius:50%; opacity:0.3;
  animation:float-particle 20s infinite linear;
}
@keyframes float-particle {
  0% { transform:translateY(100vh) rotate(0deg); opacity:0; }
  10% { opacity:0.3; }
  90% { opacity:0.3; }
  100% { transform:translateY(-100vh) rotate(720deg); opacity:0; }
}

/* Glowing Orbs Background */
.orb {
  position:fixed; border-radius:50%; filter:blur(80px);
  pointer-events:none; z-index:0; opacity:0.4;
  animation:orb-pulse 8s ease-in-out infinite;
}
.orb-1 { width:500px; height:500px; background:radial-gradient(circle, rgba(245,158,11,0.4), transparent); top:-100px; right:-100px; }
.orb-2 { width:400px; height:400px; background:radial-gradient(circle, rgba(244,63,94,0.3), transparent); bottom:20%; left:-100px; animation-delay:2s; }
.orb-3 { width:300px; height:300px; background:radial-gradient(circle, rgba(139,92,246,0.3), transparent); top:40%; right:10%; animation-delay:4s; }
@keyframes orb-pulse {
  0%,100% { transform:scale(1); opacity:0.4; }
  50% { transform:scale(1.2); opacity:0.6; }
}

/* PAGES */
.page { display:block !important; }
@keyframes fadeIn { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }

/* GLASSMORPHISM */
.glass-card {
  background:rgba(255,255,255,0.07);
  backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(20px);
  border:1px solid rgba(255,255,255,0.12);
  border-radius:24px;
  transition:all .4s cubic-bezier(0.4, 0, 0.2, 1);
}
.glass-card:hover {
  background:rgba(255,255,255,0.12);
  border-color:rgba(245,158,11,0.4);
  transform:translateY(-8px);
  box-shadow:0 25px 80px rgba(245,158,11,0.2), 0 0 40px rgba(245,158,11,0.1);
}
.glass-card-glow {
  background:rgba(255,255,255,0.05);
  backdrop-filter:blur(20px);
  border:1px solid rgba(255,255,255,0.1);
  border-radius:24px;
  box-shadow:0 0 60px rgba(245,158,11,0.15), inset 0 1px 0 rgba(255,255,255,0.1);
}
.glass-nav {
  /* background: rgba(15,10,0,0.75); */
  backdrop-filter: blur(24px);
  -webkit-backdrop-filter: blur(24px);
  border-bottom: 1px solid rgba(255,255,255,0.08);
  transition: all .3s ease;
}
.glass-nav.scrolled {
  /* background: #ffffff; */
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
}

/* NAVBAR */
.navbar { padding:1rem 0; z-index:1000; }
.brand-icon {
  width:48px; height:48px;
  background:var(--theme-btn-gradient);
  border-radius:14px; display:flex; align-items:center; justify-content:center;
  font-size:1.3rem; color:#fff;
  box-shadow:0 4px 20px rgba(245,158,11,0.5), 0 0 20px rgba(245,158,11,0.3);
  animation:brand-glow 3s ease-in-out infinite;
}
@keyframes brand-glow {
  0%,100% { box-shadow:0 4px 20px rgba(245,158,11,0.5), 0 0 20px rgba(245,158,11,0.3); }
  50% { box-shadow:0 4px 30px rgba(245,158,11,0.7), 0 0 40px rgba(245,158,11,0.5); }
}
.brand-name { font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:700; color:var(--theme-text-secondary); }
.brand-sub { font-size:.7rem; color:var(--text-60); letter-spacing:.1em; text-transform:uppercase; }

.navbar .nav-link {
  color:var(--text-80)!important; font-size:.9rem; font-weight:500;
  padding:.5rem 1rem!important; border-radius:10px;
  position:relative; transition:all .3s ease;
}
.navbar .nav-link::before {
  content:''; position:absolute; bottom:0; left:50%;
  width:0; height:2px; background:var(--theme-menu-hover);
  transition:all .3s ease; transform:translateX(-50%);
}
.navbar .nav-link:hover::before, .navbar .nav-link.active::before { width:60%; }
.navbar .nav-link:hover, .navbar .nav-link.active { color:var(--theme-text-secondary)!important; background:rgba(245,158,11,0.1); }

.nav-icon-btn {
  width:44px; height:44px; border-radius:14px;
  background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.12);
  color:var(--text-85); display:inline-flex; align-items:center; justify-content:center;
  transition:all .3s cubic-bezier(0.4,0,0.2,1); position:relative;
  font-size:1.05rem;
}
.nav-icon-btn:hover {
  background:linear-gradient(135deg,rgba(245,158,11,0.25),rgba(244,63,94,0.15));
  border-color:rgba(245,158,11,0.4);
  color:var(--theme-text-secondary); transform:translateY(-3px) scale(1.05);
  box-shadow:0 12px 30px rgba(245,158,11,0.35);
}
.nav-icon-btn:active {
  transform:translateY(-1px) scale(0.98);
}

/* Mobile Menu Close Button */
.btn-close-menu {
  width:44px; height:44px; border-radius:14px;
  background:rgba(244,63,94,0.15); border:1px solid rgba(244,63,94,0.3);
  color:#f43f5e; display:inline-flex; align-items:center; justify-content:center;
  transition:all .3s cubic-bezier(0.4,0,0.2,1);
  font-size:1.3rem;
}
.btn-close-menu:hover {
  background:rgba(244,63,94,0.25);
  border-color:rgba(244,63,94,0.5);
  color:#ff6b8a; transform:scale(1.1);
  box-shadow:0 8px 25px rgba(244,63,94,0.3);
}
.btn-close-menu:active {
  transform:scale(0.95);
}

/* Dropdown Menu Styles */
.dropdown-menu {
  background: rgba(15, 10, 0, 0.95);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 12px;
  padding: 0.5rem;
  min-width: 200px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.4);
}
.dropdown-item {
  color: var(--text-80);
  padding: 0.6rem 1rem;
  border-radius: 8px;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  text-decoration: none;
  background: transparent;
  border: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  font-size: 0.9rem;
}
.dropdown-item:hover {
  background: rgba(245,158,11,0.15);
  color: var(--theme-text-secondary);
  transform: translateX(5px);
}
.dropdown-item:focus {
  background: rgba(245,158,11,0.15);
  color: var(--theme-text-secondary);
  outline: none;
}
.dropdown-item i {
  width: 20px;
  text-align: center;
}
.dropdown-divider {
  border-color: rgba(255,255,255,0.1);
  margin: 0.5rem 0;
}
.dropdown-menu.show {
  animation: dropdownFadeIn 0.3s ease;
}
@keyframes dropdownFadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Search Input Field */
.search-input {
  width: 220px;
  height: 44px;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 14px;
  padding: 0.6rem 2.5rem 0.6rem 1rem;
  color: var(--theme-text-primary);
  font-size: 0.9rem;
  transition: all 0.3s ease;
}

.search-input:focus {
  background: rgba(255,255,255,0.12);
  border-color: rgba(245,158,11,0.4);
  color: var(--theme-text-primary);
  outline: none;
  box-shadow: 0 0 0 3px rgba(245,158,11,0.1);
}

.search-input::placeholder {
  color: var(--text-50);
}
.mobile-search-input::placeholder {
  color: var(--text-40);
}

.search-icon-btn {
  position: absolute;
  right: 8px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: var(--text-60);
  padding: 0.5rem;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 0.95rem;
}

.search-icon-btn:hover {
  color: var(--theme-text-secondary);
}

.search-icon-btn:active {
  transform: translateY(-50%) scale(0.95);
}

/* Search Autocomplete Dropdown */
.search-suggest-dropdown {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: rgb(214 161 133 / 97%);
  backdrop-filter: blur(25px);
  border: 1px solid rgba(245, 158, 11, 0.2);
  border-radius: 12px;
  margin-top: 4px;
  max-height: 400px;
  overflow-y: auto;
  z-index: 9999;
  box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5);
}
.search-suggest-dropdown.show {
  display: block;
}
.search-suggest-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.6rem 0.75rem;
  text-decoration: none;
  color: rgba(245, 230, 204, 0.85);
  transition: all 0.2s ease;
  border-bottom: 1px solid rgba(255, 255, 255, 0.04);
}
.search-suggest-item:hover {
  background: rgba(245, 158, 11, 0.1);
}
.search-suggest-item:last-of-type {
  border-bottom: none;
}
.suggest-img {
  width: 40px;
  height: 40px;
  border-radius: 8px;
  overflow: hidden;
  background: rgba(245, 230, 204, 0.05);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.suggest-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.suggest-img i {
  color: rgba(245, 230, 204, 0.3);
  font-size: 1.2rem;
}
.suggest-info {
  flex: 1;
  min-width: 0;
}
.suggest-name {
  font-size: 0.85rem;
  font-weight: 500;
  color: var(--theme-text-primary);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.suggest-name mark {
  background: rgba(245, 158, 11, 0.3);
  color: var(--theme-text-secondary);
  border-radius: 2px;
  padding: 0 2px;
}
.suggest-cat {
  font-size: 0.7rem;
  color: rgba(245, 230, 204, 0.4);
  margin-top: 1px;
}
.suggest-price {
  text-align: right;
  flex-shrink: 0;
}
.suggest-price span {
  display: block;
  font-size: 0.85rem;
  font-weight: 600;
  color: var(--theme-text-secondary);
}
.suggest-price small {
  font-size: 0.7rem;
  color: rgba(245, 230, 204, 0.35);
  text-decoration: line-through;
}
.search-suggest-empty {
  padding: 1.5rem;
  text-align: center;
  color: rgba(245, 230, 204, 0.4);
  font-size: 0.9rem;
}
.search-suggest-empty i {
  margin-right: 0.5rem;
}
.search-suggest-footer {
  padding: 0.5rem;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  text-align: center;
}
.search-suggest-footer a {
  display: block;
  padding: 0.5rem;
  color: var(--theme-text-secondary);
  text-decoration: none;
  font-size: 0.8rem;
  border-radius: 8px;
  transition: all 0.2s ease;
}
.search-suggest-footer a:hover {
  background: rgba(245, 158, 11, 0.1);
}

/* Glassmorphism Input Fields */
.input-dark,
.form-control.input-dark,
.input-dark.form-control {
  background: rgba(255, 255, 255, 0.08) !important;
  border: 1px solid rgba(255, 255, 255, 0.15) !important;
  color: var(--theme-text-primary) !important;
  border-radius: 12px !important;
  padding: 0.75rem 1rem !important;
  font-size: 0.95rem !important;
  transition: all 0.3s ease !important;
}

.input-dark:focus,
.form-control.input-dark:focus,
.input-dark.form-control:focus {
  background: rgba(255, 255, 255, 0.12) !important;
  border-color: rgba(245, 158, 11, 0.4) !important;
  color: var(--theme-text-primary) !important;
  box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1) !important;
  outline: none !important;
}

.input-dark::placeholder,
.form-control.input-dark::placeholder {
  color: rgba(245, 230, 204, 0.5) !important;
}

.input-dark:-webkit-autofill,
.input-dark:-webkit-autofill:hover,
.input-dark:-webkit-autofill:focus,
.input-dark:-webkit-autofill:active {
  -webkit-text-fill-color: var(--theme-text-primary) !important;
  -webkit-box-shadow: 0 0 0 1000px rgba(15, 10, 0, 0.8) inset !important;
  box-shadow: 0 0 0 1000px rgba(15, 10, 0, 0.8) inset !important;
  transition: background-color 5000s ease-in-out 0s;
  caret-color: var(--theme-text-primary) !important;
  background-color: rgba(15, 10, 0, 0.8) !important;
  background-image: none !important;
}
.input-dark:-webkit-autofill::first-line {
  color: var(--theme-text-primary) !important;
  font-size: 0.95rem !important;
}
/* Fix for autofill in password/email fields */
input[type="email"].input-dark:-webkit-autofill,
input[type="password"].input-dark:-webkit-autofill,
input[type="email"].input-dark:-webkit-autofill:hover,
input[type="password"].input-dark:-webkit-autofill:hover,
input[type="email"].input-dark:-webkit-autofill:focus,
input[type="password"].input-dark:-webkit-autofill:focus,
input[type="email"].input-dark:-webkit-autofill:active,
input[type="password"].input-dark:-webkit-autofill:active {
  -webkit-text-fill-color: var(--theme-text-primary) !important;
  -webkit-box-shadow: 0 0 0 1000px rgba(15, 10, 0, 0.8) inset !important;
  box-shadow: 0 0 0 1000px rgba(15, 10, 0, 0.8) inset !important;
  transition: background-color 5000s ease-in-out 0s;
  caret-color: var(--theme-text-primary) !important;
  background-color: rgba(15, 10, 0, 0.8) !important;
  background-image: none !important;
  color: var(--theme-text-primary) !important;
}
input[type="email"].input-dark:-webkit-autofill::first-line,
input[type="password"].input-dark:-webkit-autofill::first-line {
  color: var(--theme-text-primary) !important;
  font-size: 0.95rem !important;
}
/* Firefox autofill fix */
input[type="email"].input-dark:-moz-autofill,
input[type="password"].input-dark:-moz-autofill {
  filter: none !important;
  background-color: rgba(15, 10, 0, 0.8) !important;
  color: var(--theme-text-primary) !important;
}
/* Enhanced autofill with animation delay trick */
@keyframes autofillFix {
  0%, 100% {
    background-color: rgba(15, 10, 0, 0.8);
    color: var(--theme-text-primary);
  }
}
input[type="email"].input-dark,
input[type="password"].input-dark,
input.input-dark {
  animation: autofillFix 1s infinite;
  animation-delay: 1s;
}

/* Form Labels */
.form-label {
  color: rgba(245, 230, 204, 0.85);
  font-size: 0.9rem;
  font-weight: 500;
  margin-bottom: 0.5rem;
  display: block;
}

/* Select Dropdown Styling */
.form-select.input-dark,
select.input-dark {
  background: rgba(255, 255, 255, 0.08) !important;
  border: 1px solid rgba(255, 255, 255, 0.15) !important;
  color: var(--theme-text-primary) !important;
  border-radius: 12px !important;
  padding: 0.75rem 1rem !important;
  font-size: 0.95rem !important;
  transition: all 0.3s ease !important;
}

.form-select.input-dark:focus,
select.input-dark:focus {
  background: rgba(255, 255, 255, 0.12) !important;
  border-color: rgba(245, 158, 11, 0.4) !important;
  color: var(--theme-text-primary) !important;
  box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1) !important;
  outline: none !important;
}

.form-select.input-dark option,
select.input-dark option {
  background: #1a0f05;
  color: var(--theme-text-primary);
}

/* Textarea styling */
textarea.input-dark,
textarea.form-control.input-dark {
  resize: vertical;
  min-height: 100px;
}

/* Email and Password input fixes */
input[type="email"].input-dark,
input[type="password"].input-dark {
  background: rgba(15, 10, 0, 0.6) !important;
  background-color: rgba(15, 10, 0, 0.6) !important;
  border: 1px solid rgba(255, 255, 255, 0.15) !important;
  color: var(--theme-text-primary) !important;
  border-radius: 12px !important;
  padding: 0.75rem 1rem !important;
  font-size: 0.95rem !important;
  transition: all 0.3s ease !important;
  -webkit-appearance: none !important;
  appearance: none !important;
}
input[type="email"].input-dark:focus,
input[type="password"].input-dark:focus {
  background: rgba(255, 255, 255, 0.12) !important;
  background-color: rgba(255, 255, 255, 0.12) !important;
  border-color: rgba(245, 158, 11, 0.4) !important;
  color: var(--theme-text-primary) !important;
  box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1) !important;
  outline: none !important;
}
input[type="email"].input-dark::placeholder,
input[type="password"].input-dark::placeholder {
  color: rgba(245, 230, 204, 0.5) !important;
}
/* Strong autofill override for email and password */
input[type="email"].input-dark:-webkit-autofill,
input[type="password"].input-dark:-webkit-autofill,
input[type="email"].input-dark:-webkit-autofill:hover,
input[type="password"].input-dark:-webkit-autofill:hover,
input[type="email"].input-dark:-webkit-autofill:focus,
input[type="password"].input-dark:-webkit-autofill:focus {
  -webkit-text-fill-color: var(--theme-text-primary) !important;
  -webkit-box-shadow: 0 0 0 1000px rgba(15, 10, 0, 0.6) inset !important;
  box-shadow: 0 0 0 1000px rgba(15, 10, 0, 0.6) inset !important;
  background-color: rgba(15, 10, 0, 0.6) !important;
  background-image: none !important;
  color: var(--theme-text-primary) !important;
  transition: background-color 5000s ease-in-out 0s !important;
}
input[type="email"].input-dark:-webkit-autofill::first-line,
input[type="password"].input-dark:-webkit-autofill::first-line {
  color: var(--theme-text-primary) !important;
}

/* ============================================
   TRANSPARENT GLASS MEGA MENU
   ============================================ */
.glass-mega-dropdown {
  position: static !important;
}

.glass-mega-dropdown .dropdown-toggle::after {
  display: none;
}

.glass-mega-dropdown.show .dropdown-toggle i {
  transform: rotate(180deg);
}

.glass-mega-menu {
  position: absolute;
  left: 0;
  right: 0;
  top: 100%;
  width: 100%;
  padding: 2.5rem 0;
  margin-top: 0;
  /* background: rgba(15, 10, 0, 0.98); */
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(80px) saturate(1.8);
  -webkit-backdrop-filter: blur(80px) saturate(1.8);
  border: none;
  border-top: 1px solid rgba(245, 158, 11, 0.15);
  border-bottom: 1px solid rgba(245, 158, 11, 0.1);
  border-radius: 0 0 30px 30px;
  box-shadow:
    0 30px 80px rgba(0, 0, 0, 0.5),
    0 0 60px rgba(245, 158, 11, 0.1),
    inset 0 1px 0 rgba(255, 255, 255, 0.05);
  animation: megaMenuFade 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: hidden;
}

@keyframes megaMenuFade {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Glassmorphism overlay effect */
.glass-mega-menu::before {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse at 20% 0%, rgba(245, 158, 11, 0.08) 0%, transparent 50%),
    radial-gradient(ellipse at 80% 100%, rgba(244, 63, 94, 0.06) 0%, transparent 50%);
  pointer-events: none;
}

/* Featured Section */
.glass-mega-featured {
  position: relative;
  padding: 2rem;
  height: 100%;
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.12), rgba(244, 63, 94, 0.08));
  border: 1px solid rgba(245, 158, 11, 0.2);
  border-radius: 24px;
  overflow: hidden;
  transition: all 0.4s ease;
}

.glass-mega-featured::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -50%;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle, rgba(245, 158, 11, 0.15), transparent 70%);
  animation: featuredGlow 4s ease-in-out infinite;
}

@keyframes featuredGlow {
  0%, 100% { opacity: 0.5; transform: scale(1); }
  50% { opacity: 1; transform: scale(1.1); }
}

.glass-mega-featured:hover {
  transform: translateY(-5px);
  border-color: rgba(245, 158, 11, 0.4);
  box-shadow: 0 20px 50px rgba(245, 158, 11, 0.2);
}

.mega-featured-img {
  position: relative;
  width: 100px;
  height: 100px;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.5rem;
  animation: float 3s ease-in-out infinite;
}

.mega-featured-title {
  font-family: 'Playfair Display', serif;
  font-size: 1.4rem;
  font-weight: 700;
  color: var(--theme-text-primary);
  margin-bottom: 0.75rem;
  position: relative;
}

.mega-featured-desc {
  font-size: 0.9rem;
  color: rgba(245, 230, 204, 0.7);
  line-height: 1.6;
  margin-bottom: 1.5rem;
  position: relative;
}

.mega-featured-link {
  display: inline-flex;
  align-items: center;
  color: var(--theme-text-secondary);
  font-weight: 600;
  font-size: 0.9rem;
  text-decoration: none;
  position: relative;
  transition: all 0.3s ease;
}

.mega-featured-link::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;
  background: var(--theme-menu-hover);
  transition: width 0.3s ease;
}

.mega-featured-link:hover {
  color: #f59e0b;
}

.mega-featured-link:hover::after {
  width: 100%;
}

.mega-featured-link i {
  transition: transform 0.3s ease;
}

.mega-featured-link:hover i {
  transform: translateX(5px);
}

/* Menu Columns */
.glass-mega-col {
  padding: 1.5rem;
  background: transparent;
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 20px;
  height: 100%;
  transition: all 0.4s ease;
}

.glass-mega-col:hover {
  background: transparent;
  border-color: rgba(0, 0, 0, 0.2);
  transform: translateY(-3px);
}

.glass-mega-title {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  font-size: 1rem;
  font-weight: 600;
  color: var(--theme-text-primary);
  margin-bottom: 1.25rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid rgba(245, 158, 11, 0.2);
}

.mega-icon {
  font-size: 1.3rem;
}

.glass-mega-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.glass-mega-list li {
  margin-bottom: 0.5rem;
}

.mega-link {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.5rem 0;
  color: #000000;
  font-size: 0.9rem;
  text-decoration: none;
  transition: all 0.3s ease;
  position: relative;
}

.link-dot {
  width: 6px;
  height: 6px;
  background: rgba(245, 158, 11, 0.4);
  border-radius: 50%;
  transition: all 0.3s ease;
}

.mega-link:hover {
  color: #000000;
  padding-left: 5px;
}

.mega-link:hover .link-dot {
  background: var(--theme-primary);
  box-shadow: 0 0 10px rgba(245, 158, 11, 0.6);
  transform: scale(1.3);
}

/* Quick Tags */
.glass-mega-tags {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  flex-wrap: wrap;
  padding: 1rem 1.5rem;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
}

.mega-tag-label {
  font-size: 0.85rem;
  color: #000000;
  font-weight: 500;
}

.mega-tag {
  padding: 0.35rem 1rem;
  background: rgba(245, 158, 11, 0.1);
  border: 1px solid rgba(245, 158, 11, 0.2);
  border-radius: 100px;
  color: var(--theme-text-secondary);
  font-size: 0.8rem;
  font-weight: 500;
  text-decoration: none;
  transition: all 0.3s ease;
}

.mega-tag:hover {
  background: rgba(245, 158, 11, 0.25);
  border-color: rgba(245, 158, 11, 0.4);
  color: #000000;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(245, 158, 11, 0.2);
}

/* Responsive */
@media (max-width: 991px) {
  .glass-mega-menu {
    position: relative;
    left: auto;
    right: auto;
    padding: 1.5rem;
    border-radius: 20px;
    margin-top: 0.5rem;
    background: rgba(15, 10, 0, 0.9);
    max-height: 80vh;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
  }

  .glass-mega-menu .container {
    padding-bottom: 1rem;
  }

  .glass-mega-featured {
    margin-bottom: 1.5rem;
  }

  .glass-mega-col {
    margin-bottom: 1rem;
  }

  .mega-chevron {
    font-size: 0.6rem;
    margin-right: 0.5rem;
  }
}

/* SIZE BUTTONS */
.size-btn {
  min-width: 60px;
  padding: 0.6rem 1.2rem;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 12px;
  color: var(--text-80);
  font-size: 0.9rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
}
.size-btn:hover {
  background: rgba(245,158,11,0.15);
  border-color: rgba(245,158,11,0.4);
  color: var(--theme-text-secondary);
  transform: translateY(-2px);
}
.size-btn.active {
  background: var(--theme-btn-gradient);
  border-color: transparent;
  color: #fff;
  box-shadow: 0 4px 15px rgba(245,158,11,0.4);
}

/* QTY SELECTOR */
.qty-selector {
  display: inline-flex;
  align-items: center;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 14px;
  padding: 4px;
  gap: 4px;
}
.qty-selector span {
  min-width: 50px;
  text-align: center;
  font-size: 1.2rem;
  font-weight: 700;
  color: var(--theme-text-primary);
}
.qty-btn {
  width: 38px;
  height: 38px;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 10px;
  color: var(--theme-text-primary);
  font-size: 0.75rem;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}
.qty-btn:hover {
  background: var(--theme-btn-gradient);
  border-color: transparent;
  color: #fff;
  transform: scale(1.05);
}

.cart-badge {
  position:absolute; top:-4px; right:-4px;
  background:linear-gradient(135deg, var(--theme-secondary), var(--theme-secondary-dark));
  color:#fff; border-radius:50%; width:22px; height:22px;
  font-size:.75rem; display:flex; align-items:center; justify-content:center;
  font-weight:700; animation:badge-pulse 2s infinite;
  box-shadow:0 3px 10px rgba(244,63,94,0.4);
  border:2px solid rgba(15,10,0,0.8);
}
@keyframes badge-pulse {
  0%,100% { transform:scale(1); }
  50% { transform:scale(1.15); }
}

/* AUTH MODALS */
.auth-modal {
  background: rgba(15, 10, 0, 0.95);
  backdrop-filter: blur(30px);
  -webkit-backdrop-filter: blur(30px);
  border: 1px solid rgba(245, 158, 11, 0.2);
  border-radius: 24px;
  overflow: hidden;
}
.auth-modal .modal-header {
  padding: 1.5rem 1.5rem 0.5rem;
}
.auth-modal .modal-title {
  font-family: 'Playfair Display', serif;
  font-size: 1.6rem;
  font-weight: 700;
  color: var(--theme-text-primary);
}
.auth-modal .btn-close {
  filter: invert(1);
  opacity: 0.6;
  transition: opacity 0.3s ease;
}
.auth-modal .btn-close:hover {
  opacity: 1;
}
.auth-subtitle {
  color: rgba(245, 230, 204, 0.6);
  font-size: 0.95rem;
  margin-bottom: 1.5rem;
}
.auth-label {
  display: block;
  font-size: 0.85rem;
  font-weight: 500;
  color: var(--theme-text-secondary);
  margin-bottom: 0.5rem;
}
.auth-input-group {
  display: flex;
  align-items: center;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 12px;
  padding: 0 1rem;
  transition: all 0.3s ease;
}
.auth-input-group:focus-within {
  background: rgba(255, 255, 255, 0.08);
  border-color: rgba(245, 158, 11, 0.4);
  box-shadow: 0 0 20px rgba(245, 158, 11, 0.15);
}
.auth-input-group i {
  color: rgba(245, 230, 204, 0.5);
  font-size: 0.9rem;
}
.auth-input {
  flex: 1;
  background: transparent;
  border: none;
  color: var(--theme-text-primary);
  padding: 0.85rem 0.75rem;
  font-size: 0.95rem;
  outline: none;
}
.auth-input::placeholder {
  color: rgba(245, 230, 204, 0.4);
}
.auth-toggle-pass {
  background: none;
  border: none;
  color: rgba(245, 230, 204, 0.5);
  cursor: pointer;
  padding: 0;
  font-size: 0.9rem;
  transition: color 0.3s ease;
}
.auth-toggle-pass:hover {
  color: var(--theme-text-secondary);
}
.auth-checkbox {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.85rem;
  color: rgba(245, 230, 204, 0.7);
  cursor: pointer;
}
.auth-checkbox input {
  display: none;
}
.auth-checkbox .checkmark {
  width: 18px;
  height: 18px;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}
.auth-checkbox .checkmark::after {
  content: '\f00c';
  font-family: 'Font Awesome 6 Free';
  font-weight: 900;
  font-size: 0.65rem;
  color: #fff;
  opacity: 0;
  transform: scale(0);
  transition: all 0.3s ease;
}
.auth-checkbox input:checked + .checkmark {
  background: var(--theme-btn-gradient);
  border-color: transparent;
}
.auth-checkbox input:checked + .checkmark::after {
  opacity: 1;
  transform: scale(1);
}
.auth-link {
  color: var(--theme-text-secondary);
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}
.auth-link:hover {
  color: #f59e0b;
}
.auth-divider {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin: 1.5rem 0;
  color: rgba(245, 230, 204, 0.4);
  font-size: 0.85rem;
}
.auth-divider::before,
.auth-divider::after {
  content: '';
  flex: 1;
  height: 1px;
  background: rgba(255, 255, 255, 0.1);
}
.btn-social {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.12);
  color: var(--theme-text-primary);
  padding: 0.75rem;
  border-radius: 12px;
  font-size: 0.9rem;
  font-weight: 500;
  transition: all 0.3s ease;
}
.btn-social:hover {
  background: rgba(255, 255, 255, 0.1);
  border-color: rgba(245, 158, 11, 0.3);
  color: var(--theme-text-secondary);
  transform: translateY(-2px);
}
.btn-social i {
  margin-right: 0.5rem;
}
.auth-footer {
  text-align: center;
  color: rgba(245, 230, 204, 0.6);
  font-size: 0.9rem;
  margin-bottom: 0;
}

/* =====================
   USER PROFILE PAGE
   ===================== */
.profile-header {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 24px;
  overflow: hidden;
  margin-bottom: 1.5rem;
}
.profile-cover {
  height: 120px;
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.3), rgba(244, 63, 94, 0.2));
  position: relative;
}
.profile-cover::after {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at top, rgba(245, 158, 11, 0.2), transparent);
}
.profile-info {
  display: flex;
  align-items: flex-end;
  padding: 0 2rem 1.5rem;
  position: relative;
  gap: 1.5rem;
}
.profile-avatar {
  width: 100px;
  height: 100px;
  background: var(--theme-btn-gradient);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  font-weight: 700;
  color: #fff;
  margin-top: -50px;
  border: 4px solid rgba(15, 10, 0, 0.9);
  position: relative;
}
.profile-avatar-edit {
  position: absolute;
  bottom: 0;
  right: 0;
  width: 32px;
  height: 32px;
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  color: var(--theme-text-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
}
.profile-avatar-edit:hover {
  background: rgba(245, 158, 11, 0.3);
  color: var(--theme-text-secondary);
}
.profile-details {
  flex: 1;
}
.profile-name {
  font-family: 'Playfair Display', serif;
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--theme-text-primary);
  margin-bottom: 0.25rem;
}
.profile-email, .profile-phone {
  color: rgba(245, 230, 204, 0.6);
  font-size: 0.9rem;
  margin-bottom: 0.25rem;
}
.profile-actions {
  display: flex;
  gap: 0.75rem;
}

/* Profile Sidebar */
.profile-sidebar {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 20px;
  padding: 1rem;
}
.profile-menu {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}
.profile-menu-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.85rem 1rem;
  background: transparent;
  border: 1px solid transparent;
  border-radius: 12px;
  color: rgba(245, 230, 204, 0.7);
  font-size: 0.95rem;
  cursor: pointer;
  transition: all 0.3s ease;
  text-align: left;
}
.profile-menu-item:hover {
  background: rgba(255, 255, 255, 0.05);
  color: var(--theme-text-primary);
}
.profile-menu-item.active {
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(244, 63, 94, 0.1));
  border-color: rgba(245, 158, 11, 0.3);
  color: var(--theme-text-secondary);
}
.profile-menu-item i {
  width: 20px;
  text-align: center;
}

/* Profile Tabs */
.profile-tab {
  display: none;
}
.profile-tab.active {
  display: block;
  animation: fadeIn 0.3s ease;
}

/* Admin Tabs */
.admin-tab {
  display: none;
}
.admin-tab.active {
  display: block;
  animation: fadeIn 0.3s ease;
}

/* =====================
   INVOICE PAGE
   ===================== */
.invoice-paper {
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.3);
  padding: 3rem;
  color: #333;
  max-width: 900px;
  margin: 0 auto;
}
.invoice-header {
  border-bottom: 2px solid #f59e0b;
  padding-bottom: 1.5rem;
  margin-bottom: 1.5rem;
}
.invoice-brand {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1rem;
}
.invoice-logo {
  width: 60px;
  height: 60px;
  background: var(--theme-btn-gradient);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  color: #fff;
}
.invoice-brand-name {
  font-family: 'Playfair Display', serif;
  font-size: 1.5rem;
  font-weight: 700;
  color: #1a1a1a;
  margin: 0;
}
.invoice-brand-sub {
  color: #666;
  font-size: 0.9rem;
  margin: 0;
}
.invoice-company-info {
  font-size: 0.85rem;
  color: #555;
  line-height: 1.6;
}
.invoice-company-info p {
  margin: 0.25rem 0;
}
.invoice-title {
  font-family: 'Playfair Display', serif;
  font-size: 2.5rem;
  font-weight: 700;
  color: #f59e0b;
  margin: 0 0 1rem;
  letter-spacing: 2px;
}
.invoice-meta {
  font-size: 0.9rem;
  color: #555;
}
.invoice-meta p {
  margin: 0.35rem 0;
}
.invoice-meta strong {
  color: #333;
}
.invoice-box {
  background: #f9f9f9;
  border-radius: 8px;
  padding: 1.25rem;
  height: 100%;
}
.invoice-box-title {
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #888;
  margin-bottom: 0.75rem;
}
.invoice-customer-name {
  font-weight: 700;
  font-size: 1.1rem;
  color: #1a1a1a;
  margin-bottom: 0.5rem;
}
.invoice-customer-info {
  font-size: 0.9rem;
  color: #555;
  line-height: 1.6;
  margin: 0;
}
.invoice-table-wrapper {
  margin: 2rem 0;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  overflow: hidden;
}
.invoice-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.95rem;
}
.invoice-table thead {
  background: var(--theme-btn-gradient);
  color: #fff;
}
.invoice-table th {
  padding: 1rem;
  font-weight: 600;
  text-align: left;
}
.invoice-table td {
  padding: 1rem;
  border-bottom: 1px solid #e0e0e0;
  color: #333;
}
.invoice-table tbody tr:last-child td {
  border-bottom: none;
}
.invoice-table tbody tr:hover {
  background: #fafafa;
}
.invoice-summary {
  background: #f9f9f9;
  border-radius: 8px;
  padding: 1.5rem;
}
.invoice-summary-row {
  display: flex;
  justify-content: space-between;
  padding: 0.5rem 0;
  font-size: 0.95rem;
  color: #555;
}
.invoice-summary-row.total {
  font-size: 1.1rem;
  font-weight: 700;
  color: #1a1a1a;
}
.invoice-summary-row.total span:last-child {
  color: #f59e0b;
  font-size: 1.3rem;
}
.invoice-summary-row.total-paid {
  font-weight: 600;
  color: #059669;
}
.invoice-summary-row.balance {
  font-weight: 600;
  color: #1a1a1a;
}
.invoice-summary-divider {
  height: 1px;
  background: #ddd;
  margin: 0.75rem 0;
}
.invoice-notes {
  font-size: 0.9rem;
  color: #555;
}
.invoice-notes h6 {
  color: #1a1a1a;
  font-weight: 600;
  margin-bottom: 0.5rem;
}
.invoice-notes p {
  line-height: 1.6;
  margin-bottom: 1rem;
}
.invoice-payment-info {
  margin-top: 1.5rem;
  padding-top: 1.5rem;
  border-top: 1px dashed #ddd;
}
.invoice-payment-info h6 {
  margin-bottom: 0.75rem;
}
.invoice-payment-info p {
  margin: 0.35rem 0;
}
.invoice-footer {
  margin-top: 2rem;
  padding-top: 2rem;
  border-top: 2px solid #f59e0b;
}
.invoice-signature {
  margin-top: 1rem;
}
.signature-line {
  width: 200px;
  height: 1px;
  background: #333;
  margin-bottom: 0.5rem;
}
.invoice-signature p {
  font-size: 0.85rem;
  color: #666;
  margin: 0;
}
.invoice-stamp {
  display: inline-block;
  padding: 0.5rem 2rem;
  border: 3px solid #059669;
  color: #059669;
  font-size: 1.5rem;
  font-weight: 700;
  letter-spacing: 3px;
  transform: rotate(-5deg);
  border-radius: 8px;
}
.invoice-footer-text {
  text-align: center;
  margin-top: 2rem;
  padding-top: 1.5rem;
  border-top: 1px solid #eee;
  font-size: 0.85rem;
  color: #888;
}
.invoice-footer-text p {
  margin: 0.35rem 0;
}
@media print {
  body { background: #fff !important; }
  .navbar, .invoice-actions, .glass-card.mt-4 { display: none !important; }

/* Ensure content is visible above background effects */
body > div[style*="z-index"] {
  position: relative;
  z-index: 1;
}

/* Page content wrapper */
.page-content-wrapper {
  position: relative;
  z-index: 1;
}

/* Ensure all sections appear above background */
section {
  position: relative;
  z-index: 1;
}

/* Main container content */
.container {
  position: relative;
  z-index: 2;
}
  .invoice-paper { box-shadow: none; padding: 0; max-width: 100%; }
  .page { padding-top: 0 !important; }
}

/* Profile Stats */
.profile-stat-card {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  padding: 1.25rem;
  text-align: center;
  transition: all 0.3s ease;
}
.profile-stat-card:hover {
  background: rgba(255, 255, 255, 0.06);
  transform: translateY(-3px);
}
.stat-icon {
  width: 44px;
  height: 44px;
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(244, 63, 94, 0.1));
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 0.75rem;
  color: var(--theme-text-secondary);
  font-size: 1.1rem;
}
.stat-value {
  font-family: 'Playfair Display', serif;
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--theme-text-primary);
}
.stat-label {
  font-size: 0.85rem;
  color: rgba(245, 230, 204, 0.6);
}

/* Orders List */
.profile-orders-list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
.profile-order-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 1.25rem;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 12px;
  transition: all 0.3s ease;
}
.profile-order-item:hover {
  background: rgba(255, 255, 255, 0.06);
  border-color: rgba(245, 158, 11, 0.15);
}
.order-id {
  font-weight: 600;
  color: var(--theme-text-primary);
}
.order-date {
  font-size: 0.85rem;
  color: rgba(245, 230, 204, 0.5);
}
.order-items {
  font-size: 0.9rem;
  color: rgba(245, 230, 204, 0.6);
}
.order-amount {
  font-family: 'Playfair Display', serif;
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--theme-text-secondary);
}
.order-status {
  padding: 0.4rem 0.8rem;
  border-radius: 100px;
  font-size: 0.8rem;
  font-weight: 600;
}
.order-status.delivered {
  background: rgba(16, 185, 129, 0.15);
  color: #34d399;
}
.order-status.processing {
  background: rgba(245, 158, 11, 0.15);
  color: var(--theme-text-secondary);
}
.order-status.cancelled {
  background: rgba(244, 63, 94, 0.15);
  color: #f43f5e;
}

/* Order Cards */
.profile-order-card {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  padding: 1.25rem;
  transition: all 0.3s ease;
}
.profile-order-card:hover {
  border-color: rgba(245, 158, 11, 0.2);
}
.order-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}
.order-products {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  margin-bottom: 1rem;
}
.order-product {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}
.order-product-img {
  width: 48px;
  height: 48px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
}
.order-product-name {
  font-weight: 600;
  color: var(--theme-text-primary);
  font-size: 0.95rem;
}
.order-product-meta {
  font-size: 0.85rem;
  color: rgba(245, 230, 204, 0.5);
}
.order-card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 1rem;
  border-top: 1px solid rgba(255, 255, 255, 0.06);
}
.order-total {
  color: rgba(245, 230, 204, 0.6);
}
.order-total strong {
  color: var(--theme-text-secondary);
  font-size: 1.1rem;
}
.order-actions {
  display: flex;
  gap: 0.5rem;
}

/* Address Cards */
.address-card {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  padding: 1.25rem;
  position: relative;
  transition: all 0.3s ease;
}
.address-card:hover {
  border-color: rgba(245, 158, 11, 0.2);
}
.address-card.default {
  border-color: rgba(245, 158, 11, 0.3);
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.05), rgba(244, 63, 94, 0.03));
}
.address-badge {
  position: absolute;
  top: 1rem;
  right: 1rem;
  padding: 0.25rem 0.6rem;
  background: var(--theme-btn-gradient);
  color: #fff;
  font-size: 0.75rem;
  font-weight: 600;
  border-radius: 100px;
}
.address-title {
  font-weight: 600;
  color: var(--theme-text-primary);
  margin-bottom: 0.5rem;
}
.address-text {
  color: rgba(245, 230, 204, 0.7);
  font-size: 0.9rem;
  margin-bottom: 0.25rem;
}
.address-city {
  color: rgba(245, 230, 204, 0.5);
  font-size: 0.85rem;
  margin-bottom: 0.5rem;
}
.address-phone {
  color: rgba(245, 230, 204, 0.6);
  font-size: 0.85rem;
}
.address-actions {
  display: flex;
  gap: 0.5rem;
  margin-top: 1rem;
}

/* Wishlist */
.profile-wishlist {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
.wishlist-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 12px;
  transition: all 0.3s ease;
}
.wishlist-item:hover {
  background: rgba(255, 255, 255, 0.05);
}
.wishlist-img {
  width: 60px;
  height: 60px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.75rem;
}
.wishlist-info {
  flex: 1;
}
.wishlist-info h6 {
  color: var(--theme-text-primary);
  margin-bottom: 0.25rem;
}
.wishlist-price {
  color: var(--theme-text-secondary);
  font-weight: 600;
  margin: 0;
}
.wishlist-old {
  color: rgba(245, 230, 204, 0.4);
  text-decoration: line-through;
  font-weight: 400;
  font-size: 0.9rem;
  margin-left: 0.5rem;
}
.wishlist-actions {
  display: flex;
  gap: 0.5rem;
}

/* =====================
   ORDER DETAILS PAGE
   ===================== */
.order-timeline {
  position: relative;
  padding-left: 30px;
}
.order-timeline::before {
  content: '';
  position: absolute;
  left: 15px;
  top: 0;
  bottom: 0;
  width: 2px;
  background: rgba(255, 255, 255, 0.1);
}
.timeline-item {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  padding-bottom: 1.5rem;
  position: relative;
}
.timeline-item:last-child {
  padding-bottom: 0;
}
.timeline-icon {
  width: 32px;
  height: 32px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
  color: rgba(245, 230, 204, 0.5);
  margin-left: -30px;
  z-index: 1;
  border: 2px solid rgba(15, 10, 0, 0.9);
}
.timeline-item.completed .timeline-icon {
  background: linear-gradient(135deg, #10b981, #059669);
  color: #fff;
}
.timeline-item.active .timeline-icon {
  background: var(--theme-btn-gradient);
  color: #fff;
  animation: pulse-icon 2s infinite;
}
@keyframes pulse-icon {
  0%, 100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4); }
  50% { box-shadow: 0 0 0 10px rgba(245, 158, 11, 0); }
}
.timeline-content {
  flex: 1;
  padding-top: 0.25rem;
}
.timeline-title {
  font-weight: 600;
  color: var(--theme-text-primary);
  font-size: 0.95rem;
}
.timeline-item.completed .timeline-title {
  color: #34d399;
}
.timeline-item.active .timeline-title {
  color: var(--theme-text-secondary);
}
.timeline-date {
  font-size: 0.85rem;
  color: rgba(245, 230, 204, 0.5);
  margin-top: 0.25rem;
}

/* Order Detail Items */
.order-detail-items {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
.order-detail-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 12px;
  transition: all 0.3s ease;
}
.order-detail-item:hover {
  background: rgba(255, 255, 255, 0.05);
  border-color: rgba(245, 158, 11, 0.15);
}
.order-detail-img {
  width: 60px;
  height: 60px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.75rem;
}
.order-detail-info {
  flex: 1;
}
.order-detail-info h6 {
  color: var(--theme-text-primary);
  margin-bottom: 0.25rem;
  font-size: 1rem;
}
.order-detail-variant {
  color: rgba(245, 230, 204, 0.5);
  font-size: 0.85rem;
  margin: 0;
}
.order-detail-price {
  color: rgba(245, 230, 204, 0.6);
  font-size: 0.9rem;
  margin: 0.25rem 0 0;
}
.order-detail-total {
  font-family: 'Playfair Display', serif;
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--theme-text-secondary);
  min-width: 70px;
  text-align: right;
}

/* Order Summary */
.order-summary-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.6rem 0;
  color: rgba(245, 230, 204, 0.7);
  font-size: 0.95rem;
}
.order-summary-row.total {
  font-weight: 600;
  color: var(--theme-text-primary);
  font-size: 1rem;
}
.order-summary-divider {
  height: 1px;
  background: rgba(255, 255, 255, 0.1);
  margin: 0.75rem 0;
}
.order-payment-method {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-top: 1rem;
  padding-top: 1rem;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}
.order-payment-method i {
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--theme-text-secondary);
}
.order-payment-method span {
  color: var(--theme-text-primary);
  font-size: 0.9rem;
}
.order-payment-method small {
  color: rgba(245, 230, 204, 0.5);
}

/* Order Address */
.order-address {
  position: relative;
}
.order-address-type {
  display: inline-block;
  padding: 0.25rem 0.75rem;
  background: rgba(245, 158, 11, 0.15);
  border-radius: 100px;
  color: var(--theme-text-secondary);
  font-size: 0.8rem;
  font-weight: 600;
  margin-bottom: 0.75rem;
}
.order-address-text {
  color: var(--theme-text-primary);
  font-size: 0.95rem;
  margin-bottom: 0.25rem;
}
.order-address-city {
  color: rgba(245, 230, 204, 0.5);
  font-size: 0.9rem;
  margin-bottom: 0.5rem;
}
.order-address-phone {
  color: rgba(245, 230, 204, 0.6);
  font-size: 0.85rem;
}

/* Delivery Info */
.delivery-info-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.5rem 0;
  font-size: 0.9rem;
}
.delivery-info-row span:first-child {
  color: rgba(245, 230, 204, 0.5);
}
.delivery-info-row span:last-child {
  color: var(--theme-text-primary);
  font-weight: 500;
}

/* Responsive */
@media (max-width: 991px) {
  .profile-info {
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 0 1rem 1.5rem;
  }
  .profile-details {
    margin-top: 0.5rem;
  }
  .profile-actions {
    width: 100%;
    justify-content: center;
    margin-top: 1rem;
  }
  .profile-menu {
    flex-direction: row;
    overflow-x: auto;
    padding-bottom: 0.5rem;
  }
  .profile-menu-item {
    white-space: nowrap;
    padding: 0.6rem 1rem;
  }
  .profile-order-item {
    flex-wrap: wrap;
    gap: 0.5rem;
  }
  /* Order Details Mobile */
  .order-detail-item {
    flex-wrap: wrap;
  }
  .order-detail-total {
    width: 100%;
    text-align: left;
    margin-top: 0.5rem;
    padding-left: 76px;
  }
  .order-timeline {
    padding-left: 25px;
  }
  .timeline-icon {
    margin-left: -25px;
    width: 28px;
    height: 28px;
    font-size: 0.7rem;
  }
}

/* BUTTONS */
.btn-glow {
  background:var(--theme-btn-gradient);
  border:none; color:#fff; border-radius:14px; font-weight:600;
  padding:.8rem 2rem; position:relative; overflow:hidden;
  box-shadow:0 4px 25px rgba(245,158,11,0.4);
  transition:all .3s ease;
}
.btn-glow::before {
  content:''; position:absolute; top:0; left:-100%;
  width:100%; height:100%;
  background:linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
  transition:left .5s ease;
}
.btn-glow:hover::before { left:100%; }
.btn-glow:hover {
  transform:translateY(-3px); box-shadow:0 10px 40px rgba(245,158,11,0.5);
  color:#fff;
}
.btn-glass {
  background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2);
  color:var(--theme-text-primary); border-radius:14px; font-weight:500;
  backdrop-filter:blur(10px); transition:all .3s ease;
}
.btn-glass:hover {
  background:rgba(255,255,255,0.15); border-color:rgba(245,158,11,0.5);
  color:var(--theme-text-secondary); transform:translateY(-2px);
}

/* GRADIENT TEXT */
.gradient-text {
  background:linear-gradient(135deg, var(--theme-text-secondary), #f43f5e, #a78bfa, var(--theme-text-secondary));
  background-size:300% 300%;
  -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
  animation:gradient-shift 5s ease infinite;
}
@keyframes gradient-shift {
  0% { background-position:0% 50%; }
  50% { background-position:100% 50%; }
  100% { background-position:0% 50%; }
}

/* SECTION STYLES */
.section-badge {
  display:inline-block;
  background:linear-gradient(135deg, rgba(245,158,11,0.2), rgba(244,63,94,0.2));
  border:1px solid rgba(245,158,11,0.3); color:var(--theme-text-secondary);
  font-size:.8rem; font-weight:600; padding:.4rem 1rem;
  border-radius:100px; letter-spacing:.05em; text-transform:uppercase;
  backdrop-filter:blur(10px);
}
.section-title { font-family:'Playfair Display',serif; font-size:2.8rem; font-weight:700; color:var(--theme-text-primary); line-height:1.2; }
.section-gap { position:relative; z-index:1; padding:6rem 0; }

/* HERO SECTION */
.hero-section {
  min-height:100vh; position:relative; display:flex; align-items:center;
  padding-top:100px; overflow:hidden; z-index: 1;
}
.hero-bg-pattern {
  position:absolute; inset:0;
  background-image:
    radial-gradient(circle at 20% 50%, rgba(245,158,11,0.1) 0%, transparent 50%),
    radial-gradient(circle at 80% 80%, rgba(244,63,94,0.08) 0%, transparent 50%),
    radial-gradient(circle at 40% 20%, rgba(139,92,246,0.06) 0%, transparent 40%);
  pointer-events:none;
}
.hero-grid {
  position:absolute; inset:0;
  background-image:linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                   linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
  background-size:60px 60px;
  pointer-events:none; opacity:0.5;
}

.floating-card {
  position:absolute; padding:1rem 1.5rem;
  background:rgba(255,255,255,0.08); backdrop-filter:blur(20px);
  border:1px solid rgba(255,255,255,0.15); border-radius:20px;
  display:flex; align-items:center; gap:1rem;
  animation:float 6s ease-in-out infinite;
  box-shadow:0 10px 40px rgba(0,0,0,0.2); z-index: 3;
}
.floating-card.fc-1 { top:18%; right:8%; animation-delay:0s; }
.floating-card.fc-2 { top:38%; right:8%; animation-delay:1.5s; }
.floating-card.fc-3 { top:58%; right:8%; animation-delay:3s; animation:float 6s ease-in-out infinite; }
.floating-card.fc-4 { top:78%; right:8%; animation-delay:4.5s; }
@keyframes float {
  0%,100% { transform:translateY(0) rotate(0deg); }
  50% { transform:translateY(-20px) rotate(2deg); }
}
@keyframes floatSlideLeft {
  0%,100% { transform:translate(0, 0) rotate(0deg); }
  25% { transform:translate(-10px, -15px) rotate(-1deg); }
  50% { transform:translate(0, -25px) rotate(0deg); }
  75% { transform:translate(10px, -15px) rotate(1deg); }
}
.fc-icon { font-size:2.5rem; }
.fc-text { font-size:.9rem; font-weight:600; color:var(--theme-text-primary); }
.fc-sub { font-size:.75rem; color:var(--text-60); }

.hero-content { position:relative; z-index:2; }
.hero-title {
  font-family:'Playfair Display',serif; font-size:4.5rem; font-weight:900;
  color:var(--theme-text-primary); line-height:1.1; margin-bottom:1.5rem;
  text-shadow:0 10px 40px rgba(0,0,0,0.3);
}
.hero-sub { font-size:1.2rem; color:var(--text-70); line-height:1.8; max-width:550px; margin-bottom:2rem; }

.hero-stats { display:flex; gap:2rem; margin-top:3rem; }
.stat-item { text-align:center; padding:1rem 1.5rem; background:rgba(255,255,255,0.05); border-radius:16px; border:1px solid rgba(255,255,255,0.1); }
.stat-num { font-family:'Playfair Display',serif; font-size:2.2rem; font-weight:700; color:var(--theme-text-secondary); display:block; }
.stat-label { font-size:.75rem; color:var(--text-60); text-transform:uppercase; letter-spacing:.1em; }

/* HERO 3D SHOWCASE */
.hero-showcase {
  position:relative; height:500px; display:flex; align-items:center; justify-content:center;
}
.showcase-ring {
  position:absolute; width:400px; height:400px;
  border:2px solid rgba(245,158,11,0.2); border-radius:50%;
  animation:rotate-ring 20s linear infinite;
}
.showcase-ring::before {
  content:''; position:absolute; inset:20px;
  border:1px solid rgba(244,63,94,0.15); border-radius:50%;
}
@keyframes rotate-ring {
  from { transform:rotate(0deg); }
  to { transform:rotate(360deg); }
}
.showcase-center {
  width:300px; height:300px; border-radius:50%;
  background:linear-gradient(135deg, rgba(245,158,11,0.2), rgba(244,63,94,0.15));
  backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,0.2);
  display:flex; align-items:center; justify-content:center;
  box-shadow:0 0 100px rgba(245,158,11,0.3), inset 0 0 60px rgba(255,255,255,0.1);
  animation:pulse-glow 4s ease-in-out infinite;
}
@keyframes pulse-glow {
  0%,100% { box-shadow:0 0 100px rgba(245,158,11,0.3), inset 0 0 60px rgba(255,255,255,0.1); transform:scale(1); }
  50% { box-shadow:0 0 140px rgba(245,158,11,0.5), inset 0 0 80px rgba(255,255,255,0.15); transform:scale(1.02); }
}
.showcase-emoji { font-size:8rem; animation:float-emoji 4s ease-in-out infinite; filter:drop-shadow(0 20px 40px rgba(0,0,0,0.3)); }
@keyframes float-emoji {
  0%,100% { transform:translateY(0); }
  50% { transform:translateY(-15px); }
}

/* MARQUEE */
.marquee-section {
  background:linear-gradient(90deg, rgba(245,158,11,0.1), rgba(244,63,94,0.1));
  border-top:1px solid rgba(255,255,255,0.08); border-bottom:1px solid rgba(255,255,255,0.08);
  padding:1.5rem 0; overflow:hidden;
}
.marquee-track {
  display:flex; gap:3rem; white-space:nowrap;
  animation:marquee 30s linear infinite;
}
.marquee-item { display:flex; align-items:center; gap:.8rem; font-size:1rem; font-weight:500; color:var(--text-80); }
.marquee-item i { color:#f59e0b; font-size:1.2rem; }
@keyframes marquee { from { transform:translateX(0); } to { transform:translateX(-50%); } }

/* WHO WE ARE SECTION */
.about-split {
  position:relative; min-height:600px;
  background:linear-gradient(135deg, rgba(245,158,11,0.05), rgba(244,63,94,0.05));
}
.about-image-container {
  position:relative; height:100%; min-height:500px;
}
.about-image-main {
  position:absolute; width:80%; height:80%; object-fit:cover; border-radius:30px;
  top:10%; left:10%;
  box-shadow:0 30px 80px rgba(0,0,0,0.4);
}
.about-image-float {
  position:absolute; padding:1.5rem; background:rgba(255,255,255,0.1);
  backdrop-filter:blur(20px); border-radius:20px;
  border:1px solid rgba(255,255,255,0.2);
  box-shadow:0 20px 60px rgba(0,0,0,0.3);
}
.aif-1 { bottom:5%; left:5%; animation:float 5s ease-in-out infinite; }
.aif-2 { top:5%; right:5%; animation:float 5s ease-in-out infinite 2s; }
.about-badge { font-size:3rem; }
.about-counter { font-family:'Playfair Display',serif; font-size:3rem; font-weight:700; color:var(--theme-text-secondary); }
.feature-list { display:flex; flex-direction:column; gap:1.2rem; margin-top:2rem; }
.feature-item { display:flex; align-items:center; gap:1rem; padding:1rem; background:rgba(255,255,255,0.05); border-radius:16px; border:1px solid rgba(255,255,255,0.08); transition:all .3s ease; }
.feature-item:hover { background:rgba(245,158,11,0.1); border-color:rgba(245,158,11,0.3); transform:translateX(10px); }
.feature-icon-box { width:50px; height:50px; background:linear-gradient(135deg, rgba(245,158,11,0.3), rgba(244,63,94,0.3)); border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.5rem; }

/* SPECIALTY SECTIONS */
.specialty-section { padding:6rem 0; position:relative; overflow:hidden; }
.specialty-bg { position:absolute; inset:0; pointer-events:none; }
.specialty-bg::before {
  content:''; position:absolute; width:600px; height:600px; border-radius:50%;
  background:radial-gradient(circle, rgba(var(--theme-primary-rgb,245,158,11),0.1), transparent 60%);
  top:50%; left:0; transform:translateY(-50%);
}
.specialty-card {
  padding:3rem; border-radius:30px;
  background:linear-gradient(135deg, rgba(245,158,11,0.1), rgba(255,255,255,0.05));
  border:1px solid rgba(255,255,255,0.1);
  position:relative; overflow:hidden;
}
.specialty-card::before {
  content:''; position:absolute; top:-50%; right:-50%;
  width:100%; height:100%;
  background:radial-gradient(circle, rgba(245,158,11,0.2), transparent 70%);
}
.specialty-features { display:grid; grid-template-columns:repeat(2, 1fr); gap:1.5rem; margin-top:2rem; }
.sf-item { display:flex; align-items:center; gap:1rem; padding:1rem; background:rgba(255,255,255,0.05); border-radius:16px; transition:all .3s ease; }
.sf-item:hover { background:rgba(245,158,11,0.15); transform:translateY(-5px); }
.sf-icon { font-size:2rem; }
.sf-title { font-size:1rem; font-weight:600; color:var(--theme-text-primary); }
.sf-desc { font-size:.8rem; color:var(--text-60); }

/* CATEGORIES */
.category-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(130px, 1fr)); gap:1rem; }
.cat-card {
  text-decoration:none!important; padding:1.2rem 0.8rem; border-radius:16px;
  background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1);
  text-align:center; transition:all .4s ease; position:relative; overflow:hidden;
}
.cat-card::before {
  content:''; position:absolute; inset:0;
  background:linear-gradient(135deg, rgba(245,158,11,0.2), rgba(244,63,94,0.2));
  opacity:0; transition:opacity .4s ease;
}
.cat-card:hover::before { opacity:1; }
.cat-card:hover {
  transform:translateY(-5px) scale(1.02);
  border-color:rgba(245,158,11,0.4);
  box-shadow:0 15px 40px rgba(245,158,11,0.2);
}
.cat-emoji { font-size:2.5rem; margin-bottom:0.6rem; position:relative; z-index:1; transition:transform .4s ease; }
.cat-card:hover .cat-emoji { transform:scale(1.15) rotate(5deg); }
.cat-name { font-size:0.95rem; font-weight:600; color:var(--theme-text-primary); position:relative; z-index:1; }
.cat-count { font-size:.75rem; color:var(--text-50); position:relative; z-index:1; }

/* PRODUCTS */
.filter-bar { display:flex; gap:.8rem; flex-wrap:wrap; justify-content:center; margin-bottom:3rem; }
.filter-btn {
  padding:.6rem 1.5rem; border-radius:100px; font-size:.9rem; font-weight:500;
  background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1);
  color:var(--text-70); cursor:pointer; transition:all .3s ease;
  text-decoration:none;
}
.filter-btn.active, .filter-btn:hover {
  background:linear-gradient(135deg, rgba(245,158,11,0.3), rgba(244,63,94,0.3));
  border-color:rgba(245,158,11,0.5); color:var(--theme-text-secondary);
  box-shadow:0 5px 20px rgba(245,158,11,0.3);
}

/* MOBILE SHOP CATEGORIES */
.mobile-shop-categories {
  padding:1rem 0;
}

.mobile-shop-title {
  color:var(--theme-text-primary);
  font-size:1.1rem;
  font-weight:600;
  margin-bottom:1rem;
  padding-bottom:0.75rem;
  border-bottom:1px solid rgba(var(--theme-text-primary-rgb),0.15);
  display:flex;
  align-items:center;
  gap:0.5rem;
}

.mobile-category-item {
  display:flex;
  align-items:center;
  gap:1rem;
  padding:1rem;
  background:rgba(var(--theme-text-primary-rgb),0.04);
  border:1px solid rgba(var(--theme-text-primary-rgb),0.08);
  border-radius:12px;
  margin-bottom:0.75rem;
  text-decoration:none;
  transition:all 0.3s ease;
}

.mobile-category-item:hover {
  background:rgba(var(--theme-text-primary-rgb),0.08);
  border-color:rgba(245,158,11,0.3);
  transform:translateX(5px);
}

.mobile-category-icon {
  width:45px;
  height:45px;
  background:linear-gradient(135deg, rgba(var(--theme-primary-rgb,245,158,11),0.15), rgba(var(--theme-secondary-rgb,244,63,94),0.1));
  border:1px solid rgba(var(--theme-primary-rgb,245,158,11),0.2);
  border-radius:10px;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:1.5rem;
  flex-shrink:0;
}

.mobile-category-content {
  flex:1;
  min-width:0;
}

.mobile-category-name {
  color:var(--theme-text-primary);
  font-size:0.95rem;
  font-weight:500;
  margin-bottom:0.15rem;
}

.mobile-category-count {
  font-size:0.8rem;
  color:var(--text-50);
}

.mobile-shop-quicklinks {
  display:flex;
  flex-direction:column;
  gap:0.5rem;
  margin-top:1rem;
  padding-top:1rem;
  border-top:1px solid rgba(var(--theme-text-primary-rgb),0.1);
}

.mobile-quicklink {
  display:flex;
  align-items:center;
  gap:0.75rem;
  padding:0.85rem 1rem;
  background:linear-gradient(135deg, rgba(245,158,11,0.1), rgba(244,63,94,0.08));
  border:1px solid rgba(var(--theme-primary-rgb,245,158,11),0.2);
  border-radius:10px;
  color:var(--theme-text-primary);
  text-decoration:none;
  font-size:0.9rem;
  font-weight:500;
  transition:all 0.3s ease;
}

.mobile-quicklink:hover {
  background:linear-gradient(135deg, rgba(245,158,11,0.2), rgba(244,63,94,0.15));
  border-color:rgba(245,158,11,0.4);
  transform:translateX(3px);
}

.mobile-quicklink i {
  color:var(--theme-text-secondary);
  font-size:1rem;
}

.prod-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:2rem; }
.prod-card {
  border-radius:24px; overflow:hidden;
  background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1);
  transition:all .4s cubic-bezier(0.4, 0, 0.2, 1);
}
.prod-card:hover {
  transform:translateY(-12px);
  box-shadow:0 30px 80px rgba(0,0,0,0.3), 0 0 40px rgba(245,158,11,0.1);
  border-color:rgba(245,158,11,0.3);
}
.prod-img {
  height:220px; background:linear-gradient(135deg, rgba(var(--theme-primary-rgb,245,158,11),0.15), rgba(var(--theme-secondary-rgb,244,63,94),0.1));
  display:flex; align-items:center; justify-content:center; position:relative; overflow:hidden;
}
.prod-emoji { font-size:6rem; transition:all .5s ease; }
.prod-card:hover .prod-emoji { transform:scale(1.15) rotate(5deg); }
.prod-badge {
  position:absolute; top:15px; left:15px;
  padding:.4rem .8rem; border-radius:8px; font-size:.75rem; font-weight:700;
  background:var(--theme-btn-gradient);
  color:#fff;
}
.badge-hot { background:var(--theme-btn-gradient); color:#fff; }
.badge-new { background:var(--theme-btn-gradient); color:#fff; }
.badge-sale { background:linear-gradient(135deg, var(--theme-secondary), var(--theme-secondary-dark)); color:#fff; }
.prod-actions {
  position:absolute; right:15px; top:15px;
  display:flex; flex-direction:column; gap:.6rem;
  opacity:0; transform:translateX(20px); transition:all .3s ease;
}
.prod-card:hover .prod-actions { opacity:1; transform:translateX(0); }
.act-btn {
  width:40px; height:40px; border-radius:12px;
  background:rgba(15,10,0,0.8); backdrop-filter:blur(10px);
  border:1px solid rgba(255,255,255,0.1); color:var(--theme-text-primary);
  display:flex; align-items:center; justify-content:center; cursor:pointer;
  transition:all .3s ease;
}
.act-btn:hover { background:rgba(245,158,11,0.3); color:var(--theme-text-secondary); transform:scale(1.1); }
.prod-body { padding:1.5rem; }
.prod-cat { font-size:.75rem; color:var(--theme-text-secondary); font-weight:600; text-transform:uppercase; letter-spacing:.1em; }
.prod-name { font-family:'Playfair Display',serif; font-size:1.2rem; font-weight:600; color:var(--theme-text-primary); margin:.5rem 0; }
.prod-stars { color:var(--theme-text-secondary); font-size:.9rem; margin-bottom:1rem; }
.prod-footer { display:flex; align-items:center; justify-content:space-between; }
.price-new { font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:700; color:var(--theme-text-secondary); }
.price-old { font-size:.9rem; color:var(--text-40); text-decoration:line-through; margin-left:.5rem; }
.add-btn {
  width:44px; height:44px; border-radius:12px;
  background:var(--theme-btn-gradient); border:none; color:#fff;
  display:flex; align-items:center; justify-content:center; cursor:pointer;
  transition:all .3s ease;
}
.add-btn:hover { transform:scale(1.1) rotate(90deg); box-shadow:0 8px 25px rgba(var(--theme-primary-rgb,245,158,11),0.5); }

/* BESTSELLER STATS */
.bestseller-stats {
  display: flex;
  align-items: center;
  justify-content: space-around;
  padding: 1rem 1.5rem;
  background: rgba(255,255,255,0.03);
  border-top: 1px solid rgba(255,255,255,0.08);
  margin-top: auto;
}
.bestseller-stats .stat-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.85rem;
  color: var(--text-70);
}
.bestseller-stats .stat-item i {
  color: var(--theme-text-secondary);
}

/* BESTSELLER BANNER */
.bestseller-banner {
  background: linear-gradient(135deg, rgba(245,158,11,0.15), rgba(244,63,94,0.1));
  border: 1px solid rgba(245,158,11,0.2);
  border-radius: 24px;
  padding: 2.5rem;
  position: relative;
  overflow: hidden;
}
.bestseller-banner::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -10%;
  width: 300px;
  height: 300px;
  background: radial-gradient(circle, rgba(var(--theme-primary-rgb,245,158,11),0.1), transparent 70%);
  pointer-events: none;
}

/* PROMO CARDS */
.promo-section { padding:4rem 0; }
.promo-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(350px, 1fr)); gap:2rem; }
.promo-card {
  padding:3rem; border-radius:30px; position:relative; overflow:hidden;
  background:linear-gradient(135deg, rgba(var(--theme-primary-rgb,245,158,11),0.15), rgba(var(--theme-secondary-rgb,244,63,94),0.1));
  border:1px solid rgba(var(--theme-primary-rgb,245,158,11),0.2);
  transition:all .4s ease;
}
.promo-card:hover { transform:translateY(-8px); box-shadow:0 30px 60px rgba(var(--theme-primary-rgb,245,158,11),0.2); }
.promo-card.pink {
  background:linear-gradient(135deg, rgba(var(--theme-secondary-rgb,244,63,94),0.15), rgba(var(--theme-accent-rgb,139,92,246),0.1));
  border-color:rgba(var(--theme-secondary-rgb,244,63,94),0.2);
}
.promo-emoji { font-size:5rem; margin-bottom:1rem; }
.promo-title { font-family:'Playfair Display',serif; font-size:1.8rem; color:var(--theme-text-primary); margin-bottom:1rem; }
.promo-text { color:var(--text-70); margin-bottom:1.5rem; }

/* TESTIMONIALS */
.testi-section { padding:6rem 0; background:linear-gradient(180deg, rgba(var(--theme-primary-rgb,245,158,11),0.05), transparent); }
.testi-carousel { position:relative; }
.testi-card {
  padding:2.5rem; border-radius:30px;
  background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1);
  transition:all .4s ease; height:100%;
}
.testi-card:hover {
  background:rgba(255,255,255,0.08);
  transform:translateY(-8px);
  box-shadow:0 20px 60px rgba(0,0,0,0.2);
}
.testi-quote { font-size:3rem; color:#f59e0b; opacity:0.3; margin-bottom:1rem; }
.testi-text { font-style:italic; color:var(--text-80); line-height:1.8; font-size:1.05rem; margin-bottom:2rem; }
.testi-author { display:flex; align-items:center; gap:1rem; }
.testi-avatar { width:60px; height:60px; border-radius:50%; background:var(--theme-btn-gradient); display:flex; align-items:center; justify-content:center; font-size:1.8rem; }
.testi-name { font-weight:600; color:var(--theme-text-primary); }
.testi-role { font-size:.85rem; color:var(--text-50); }
.testi-stars { color:var(--theme-text-secondary); margin-top:.5rem; }

/* INSTAGRAM GALLERY */
.insta-section { padding:5rem 0; }
.insta-grid { display:grid; grid-template-columns:repeat(6, 1fr); gap:1rem; }
.insta-item {
  aspect-ratio:1; border-radius:20px; overflow:hidden;
  background:linear-gradient(135deg, rgba(245,158,11,0.2), rgba(244,63,94,0.2));
  position:relative; cursor:pointer; transition:all .4s ease;
}
.insta-item:hover { transform:scale(1.05) rotate(2deg); z-index:10; box-shadow:0 20px 50px rgba(0,0,0,0.3); }
.insta-item::before {
  content:'📸'; position:absolute; inset:0; display:flex; align-items:center; justify-content:center;
  font-size:2.5rem; opacity:0.5; transition:all .3s ease;
}
.insta-item:hover::before { opacity:1; transform:scale(1.2); }
.insta-overlay {
  position:absolute; inset:0; background:rgba(0,0,0,0.6);
  display:flex; align-items:center; justify-content:center; gap:1rem;
  opacity:0; transition:opacity .3s ease;
}
.insta-item:hover .insta-overlay { opacity:1; }
.insta-stat { color:#fff; font-size:.9rem; display:flex; align-items:center; gap:.3rem; }

/* NEWSLETTER */
.newsletter-section {
  padding:6rem 0; position:relative;
  background:linear-gradient(135deg, rgba(245,158,11,0.1), rgba(244,63,94,0.1));
}
.newsletter-card {
  padding:4rem; border-radius:40px; text-align:center;
  background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1);
  position:relative; overflow:hidden;
}
.newsletter-card::before {
  content:''; position:absolute; top:-50%; left:-50%; width:200%; height:200%;
  background:radial-gradient(circle, rgba(var(--theme-primary-rgb,245,158,11),0.1), transparent 60%);
  animation:rotate-slow 30s linear infinite;
}
@keyframes rotate-slow { from { transform:rotate(0deg); } to { transform:rotate(360deg); } }
.newsletter-content { position:relative; z-index:1; }
.newsletter-title { font-family:'Playfair Display',serif; font-size:2.5rem; color:var(--theme-text-primary); margin-bottom:1rem; }
.newsletter-form { max-width:500px; margin:2rem auto 0; display:flex; gap:1rem; }
.newsletter-input {
  flex:1; padding:1rem 1.5rem; border-radius:16px;
  background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.2);
  color:var(--theme-text-primary); font-size:1rem; transition:all .3s ease;
}
.newsletter-input:focus { outline:none; border-color:#f59e0b; background:rgba(255,255,255,0.12); }
.newsletter-input::placeholder { color:var(--text-40); }

/* FOOTER */
.footer-section {
  /* background: #ffffff; */
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  padding: 5rem 0 2rem;
}
.footer-brand { margin-bottom:1.5rem; }
.footer-text { color:var(--text-60); line-height:1.8; margin-bottom:2rem; }
.footer-social { display:flex; gap:1rem; }
.social-btn {
  width:45px; height:45px; border-radius:14px;
  background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1);
  color:var(--text-70); display:flex; align-items:center; justify-content:center;
  font-size:1.1rem; transition:all .3s ease;
}
.social-btn:hover {
  background:var(--theme-btn-gradient); color:#fff;
  transform:translateY(-5px); box-shadow:0 10px 30px rgba(245,158,11,0.4);
}
.footer-title {
  font-family:'Playfair Display',serif; font-size:1.2rem; color:var(--theme-text-secondary);
  margin-bottom:1.5rem;
}
.footer-links { list-style:none; padding:0; }
.footer-links li { margin-bottom:.8rem; }
.footer-links a {
  color:var(--text-60); text-decoration:none; font-size:.95rem;
  transition:all .3s ease; display:inline-flex; align-items:center; gap:.5rem;
}
.footer-links a::before {
  content:'→'; opacity:0; transform:translateX(-10px); transition:all .3s ease;
}
.footer-links a:hover { color:var(--theme-text-secondary); padding-left:5px; }
.footer-links a:hover::before { opacity:1; transform:translateX(0); }
.footer-contact-item { display:flex; gap:1rem; margin-bottom:1rem; color:var(--text-70); font-size:.95rem; }
.footer-contact-item i { color:#f59e0b; margin-top:3px; min-width:20px; }
.footer-contact-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
.footer-contact-grid .footer-contact-item { margin-bottom:0; }
@media (max-width:400px) {
  .footer-contact-grid { grid-template-columns:1fr; }
}
.footer-bottom {
  border-top:1px solid rgba(255,255,255,0.08);
  padding-top:2rem; margin-top:3rem;
  display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem;
}
.footer-copy { color:var(--text-40); font-size:.9rem; }
.footer-legal-links { display:flex; align-items:center; gap:0.5rem; color:var(--text-50); font-size:.85rem; }
.footer-legal-links a { color:var(--text-60); text-decoration:none; transition:all 0.3s ease; }
.footer-legal-links a:hover { color:#f59e0b; }
.payment-icons { display:flex; gap:1.5rem; font-size:2rem; }

/* RESPONSIVE */
@media (max-width:991px) {
  .hero-title { font-size:3rem; }
  .section-title { font-size:2.2rem; }
  .floating-card { display:none; }
  .insta-grid { grid-template-columns:repeat(3, 1fr); }
  .showcase-ring { width:300px; height:300px; }
  .showcase-center { width:220px; height:220px; }
  .showcase-emoji { font-size:5rem; }
}
@media (max-width:768px) {
  .hero-title { font-size:2.5rem; }
  .section-title { font-size:1.8rem; }
  .hero-stats { flex-wrap:wrap; }
  .promo-grid { grid-template-columns:1fr; }
  .insta-grid { grid-template-columns:repeat(2, 1fr); }
  .newsletter-form { flex-direction:column; }
  .specialty-features { grid-template-columns:1fr; }
  .footer-section { padding:3rem 0 1.5rem; }
  .footer-title { font-size:1.05rem; margin-bottom:.8rem; }
  .footer-bottom { flex-direction:column; text-align:center; gap:.8rem; }
  .footer-legal-links { justify-content:center; flex-wrap:wrap; }
  .payment-icons { justify-content:center; }
  .footer-copy { width:100%; text-align:center; }
  .footer-links li { margin-bottom:.5rem; }
  .footer-links a { font-size:.82rem; }
}
@media (max-width:575px) {
  .footer-section .row { gap:1.5rem !important; }
  .footer-contact-item { font-size:.85rem; }
  .footer-contact-item i { font-size:.85rem; }
  .footer-text { font-size:.9rem; margin-bottom:1rem; }

  /* Global Mobile Pagination */
  .pagination { flex-wrap:wrap; justify-content:center; gap:.35rem; }
  .pagination .page-link { padding:.4rem .65rem; font-size:.8rem; min-width:34px; text-align:center; }
}

/* TESTIMONIALS */
.testimonial-card {
  padding: 2rem;
  transition: all 0.3s ease;
}
.testimonial-card:hover {
  transform: translateY(-5px);
}
.testimonial-avatar {
  font-size: 3rem;
  margin-bottom: 1rem;
}
.testimonial-stars {
  color: var(--theme-text-secondary);
  font-size: 1rem;
  margin-bottom: 1rem;
  letter-spacing: 2px;
}
.testimonial-text {
  color: rgba(245, 230, 204, 0.85);
  font-style: italic;
  margin-bottom: 1.5rem;
  line-height: 1.6;
}
.testimonial-name {
  color: var(--theme-text-primary);
  font-family: 'Playfair Display', serif;
  font-weight: 600;
  margin-bottom: 0.25rem;
}
.testimonial-role {
  color: rgba(245, 230, 204, 0.6);
  font-size: 0.85rem;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* ANIMATIONS */
.animate-on-scroll { opacity:0; transform:translateY(30px); transition:all .8s ease; }
.animate-on-scroll.animated { opacity:1; transform:translateY(0); }

/* SCROLLBAR */
::-webkit-scrollbar { width:10px; }
::-webkit-scrollbar-track { background:#0f0a00; }
::-webkit-scrollbar-thumb { background:var(--theme-btn-gradient); border-radius:5px; }
::-webkit-scrollbar-thumb:hover { background:linear-gradient(180deg, var(--theme-text-secondary), var(--theme-primary)); }
</style>
    </style>
</head>
<body>
    <!-- Preloader -->
    <div id="sitePreloader" style="position:fixed;inset:0;z-index:99999;background:#0f0a00;display:flex;flex-direction:column;align-items:center;justify-content:center;transition:opacity 0.5s ease;">
      <div style="margin-bottom:1.5rem;">
        <i class="fas fa-cookie-bite" style="font-size:3.5rem;background:var(--theme-btn-gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;animation:preloaderBounce 1s ease-in-out infinite;"></i>
      </div>
      <div style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:700;background:var(--theme-btn-gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Saffron</div>
      <div style="color:rgba(245,230,204,0.5);font-size:0.8rem;margin-top:0.25rem;">Sweets & Bakery</div>
      <div style="margin-top:1.5rem;width:120px;height:3px;border-radius:3px;background:rgba(245,158,11,0.15);overflow:hidden;">
        <div style="width:40%;height:100%;border-radius:3px;background:var(--theme-btn-gradient);animation:preloaderBar 1.2s ease-in-out infinite;"></div>
      </div>
    </div>
    <style>
    @keyframes preloaderBounce { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }
    @keyframes preloaderBar { 0%{transform:translateX(-100%)} 100%{transform:translateX(350%)} }
    </style>

    <!-- Particles Container -->
    <div class="particles-container" id="particles"></div>

    <!-- Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Main Wrapper with proper z-index -->
    <div style="position: relative; z-index: 1; min-height: 100vh; display: flex; flex-direction: column;">
        <!-- Navigation -->
        @include('frontend.partials.navigation')

        <!-- Main Content -->
        <div style="flex: 1;">
            @yield('content')
        </div>

        <!-- Footer -->
        @php
            $footerSections = \App\Models\CmsSection::where('cms_page_id', 9)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->keyBy('section_key');
        @endphp
        @include('frontend.partials.footer', ['footerSections' => $footerSections])
    </div>

    <!-- Cart Sidebar -->
    @include('frontend.partials.cart-sidebar')

    <!-- Login Modal -->
    @include('frontend.partials.modals.login')

    <!-- Register Modal -->
    @include('frontend.partials.modals.register')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
// Generate particles
const particlesContainer = document.getElementById('particles');
if (particlesContainer) {
    for (let i = 0; i < 30; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.width = Math.random() * 6 + 2 + 'px';
        particle.style.height = particle.style.width;
        particle.style.background = Math.random() > 0.5 ? 'rgba(245,158,11,0.4)' : 'rgba(244,63,94,0.3)';
        particle.style.animationDelay = Math.random() * 20 + 's';
        particle.style.animationDuration = Math.random() * 10 + 15 + 's';
        particlesContainer.appendChild(particle);
    }
}

// Scroll effects
let lastScroll = 0;
window.addEventListener('scroll', () => {
    const nav = document.getElementById('navbar');
    const currentScroll = window.scrollY;

    // Navbar effect
    if (nav) {
        if (currentScroll > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    }

    lastScroll = currentScroll;
});

// Toggle password visibility
document.querySelectorAll('.auth-toggle-pass').forEach(btn => {
    btn.addEventListener('click', function() {
        const input = this.parentElement.querySelector('input');
        const icon = this.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            if (icon) {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        } else {
            input.type = 'password';
            if (icon) {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    });
});

// Toast notification function
function showToast(message, type = 'success') {
    // Create toast element if it doesn't exist
    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        toastContainer.style.zIndex = '9999';
        document.body.appendChild(toastContainer);
    }

    const toastId = 'toast-' + Date.now();
    const toastHTML = `
        <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header" style="background: ${type === 'success' ? 'rgba(16, 185, 129, 0.2)' : 'rgba(244, 63, 94, 0.2)'}; color: var(--theme-text-primary); border-color: ${type === 'success' ? 'rgba(16, 185, 129, 0.3)' : 'rgba(244, 63, 94, 0.3)'};">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2" style="color: ${type === 'success' ? '#34d399' : '#f43f5e'}"></i>
                <strong class="me-auto">${type === 'success' ? 'Success' : 'Error'}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" style="filter: invert(1);"></button>
            </div>
            <div class="toast-body" style="background: rgba(15, 10, 0, 0.95); color: var(--theme-text-primary);">
                ${message}
            </div>
        </div>
    `;

    toastContainer.insertAdjacentHTML('beforeend', toastHTML);
    const toastElement = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastElement, { delay: 3000 });
    toast.show();

    toastElement.addEventListener('hidden.bs.toast', () => {
        toastElement.remove();
    });
}

// Quantity selector
function changeQty(element, delta) {
    const input = element.parentElement.querySelector('input[type="number"]');
    if (input) {
        let newValue = parseInt(input.value) + delta;
        if (newValue >= 1) {
            input.value = newValue;
        }
    }
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Scroll animations for animate-on-scroll elements
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
});

// Global authentication check
window.isAuthenticated = function() {
    return @json(auth()->check());
};

// Show login modal if not authenticated
window.requireAuth = function() {
    if (!window.isAuthenticated()) {
        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
        return false;
    }
    return true;
};
    </script>

    @stack('scripts')

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', 'success');
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', 'error');
            });
        </script>
    @endif

    <!-- Mobile Bottom Navigation -->
    <nav class="mobile-bottom-nav" id="mobileBottomNav">
        <a href="{{ route('home') }}" class="mobile-nav-item {{ request()->is('/') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('shop') }}" class="mobile-nav-item {{ request()->is('shop') || request()->is('category/*') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i>
            <span>Category</span>
        </a>
        <a href="{{ route('cart') }}" class="mobile-nav-item {{ request()->is('cart') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Cart</span>
        </a>
        @auth
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}" class="mobile-nav-item {{ request()->is('admin*') ? 'active' : '' }}">
                    <i class="fas fa-user"></i>
                    <span>Account</span>
                </a>
            @else
                <a href="{{ route('profile') }}" class="mobile-nav-item {{ request()->is('profile') || request()->is('orders*') || request()->is('wishlist*') ? 'active' : '' }}">
                    <i class="fas fa-user"></i>
                    <span>Account</span>
                </a>
            @endif
        @else
            <a href="#" class="mobile-nav-item" data-bs-toggle="modal" data-bs-target="#loginModal">
                <i class="fas fa-user"></i>
                <span>Account</span>
            </a>
        @endauth
    </nav>
    <style>
    .mobile-bottom-nav {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 9999;
        background: rgba(255,255,255,0.27);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-top: 1px solid rgba(255,255,255,0.15);
        box-shadow: 0 -4px 20px rgba(0,0,0,0.03);
        padding: 8px 0 calc(8px + env(safe-area-inset-bottom, 8px));
        justify-content: space-around;
        align-items: center;
    }
    .mobile-nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: var(--text-40, #aaa);
        font-size: 0.6rem;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        min-width: 58px;
    }
    .mobile-nav-item i {
        font-size: 1.15rem;
        margin-bottom: 2px;
        transition: all 0.3s ease;
    }
    .mobile-nav-item.active {
        background: var(--theme-btn-gradient);
        color: #fff;
        box-shadow: 0 4px 15px rgba(var(--theme-primary-rgb, 245,158,11), 0.35);
    }
    .mobile-nav-item.active i {
        transform: scale(1.1);
    }
    .mobile-nav-item:not(.active):hover {
        color: var(--theme-primary, #f59e0b);
        background: rgba(var(--theme-primary-rgb, 245,158,11), 0.1);
    }
    @media (max-width: 767px) {
        .mobile-bottom-nav {
            display: flex;
        }
        body {
            padding-bottom: 76px;
        }
    }
    </style>

    <!-- Welcome Coupon Modal (homepage only, first visit per session) -->
    @if(request()->is('/') && isset($activeCoupons) && $activeCoupons->count() > 0)
    <div id="couponModalOverlay" style="display:none;position:fixed;inset:0;z-index:10001;background:rgba(0,0,0,0.7);backdrop-filter:blur(8px);align-items:center;justify-content:center;padding:1rem;">
      <div id="couponModal" style="background:linear-gradient(135deg,rgba(15,10,0,0.97),rgba(30,20,5,0.97));border:1px solid rgba(245,158,11,0.3);border-radius:20px;max-width:500px;width:100%;max-height:85vh;overflow-y:auto;position:relative;">
        <!-- Close -->
        <button id="couponModalClose" style="position:absolute;top:12px;right:12px;background:rgba(255,255,255,0.1);border:none;color:rgba(255,255,255,0.6);width:32px;height:32px;border-radius:50%;cursor:pointer;font-size:1rem;z-index:2;display:flex;align-items:center;justify-content:center;">
          <i class="fas fa-times"></i>
        </button>
        <!-- Header -->
        <div style="text-align:center;padding:2rem 1.5rem 1rem;">
          <div style="font-size:2.5rem;margin-bottom:0.5rem;"><i class="fas fa-gift" style="background:var(--theme-btn-gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;"></i></div>
          <h3 style="font-family:'Playfair Display',serif;font-size:1.5rem;color:#fff;margin-bottom:0.25rem;">Welcome to Saffron!</h3>
          <p style="color:rgba(255,255,255,0.5);font-size:0.85rem;">Grab your exclusive discounts below</p>
        </div>
        <!-- Coupons -->
        <div style="padding:0 1.5rem 1.5rem;">
          @foreach($activeCoupons as $coupon)
          <div style="background:linear-gradient(135deg,rgba(245,158,11,0.12),rgba(244,63,94,0.08));border:1px dashed rgba(245,158,11,0.4);border-radius:14px;padding:1rem;margin-bottom:0.75rem;display:flex;align-items:center;gap:1rem;">
            <div style="min-width:70px;text-align:center;">
              <div style="font-size:1.6rem;font-weight:800;background:var(--theme-btn-gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                {{ $coupon->type === 'percent' ? $coupon->value . '%' : '৳' . number_format($coupon->value) }}
              </div>
              <div style="font-size:0.65rem;color:rgba(255,255,255,0.4);text-transform:uppercase;letter-spacing:1px;">OFF</div>
            </div>
            <div style="flex:1;min-width:0;">
              <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:0.25rem;">
                <span style="background:var(--theme-btn-gradient);color:#fff;font-size:0.7rem;font-weight:700;padding:2px 10px;border-radius:6px;letter-spacing:1px;">{{ $coupon->code }}</span>
              </div>
              <p style="font-size:0.75rem;color:rgba(255,255,255,0.5);margin:0;">
                Use code <strong style="color:#f59e0b;">{{ $coupon->code }}</strong> at checkout
                @if($coupon->expires_at) · Expires {{ \Carbon\Carbon::parse($coupon->expires_at)->format('M d') }}@endif
              </p>
            </div>
            <button onclick="navigator.clipboard.writeText('{{ $coupon->code }}');this.innerHTML='<i class=\'fas fa-check\'></i> Copied';this.style.background='var(--theme-btn-gradient)';this.style.color='#fff';this.style.borderColor='transparent';" style="background:transparent;border:1px solid rgba(245,158,11,0.4);color:#f59e0b;font-size:0.7rem;font-weight:600;padding:6px 14px;border-radius:8px;cursor:pointer;white-space:nowrap;transition:all 0.3s;">
              <i class="fas fa-copy"></i> Copy
            </button>
          </div>
          @endforeach
        </div>
        <!-- Footer -->
        <div style="text-align:center;padding:0 1.5rem 1.5rem;">
          <a href="{{ route('shop') }}" style="display:inline-block;background:var(--theme-btn-gradient);color:#fff;padding:0.7rem 2rem;border-radius:12px;text-decoration:none;font-weight:600;font-size:0.9rem;box-shadow:0 4px 15px rgba(245,158,11,0.3);">
            <i class="fas fa-shopping-bag me-2"></i>Shop Now
          </a>
        </div>
      </div>
    </div>
    @endif
    <script>
    // Preloader dismiss - runs on ALL pages
    window.addEventListener('load', function(){
      var preloader = document.getElementById('sitePreloader');
      if(preloader){
        preloader.style.opacity = '0';
        setTimeout(function(){ preloader.style.display = 'none'; }, 500);
      }
      // Coupon modal - only if element exists (homepage)
      if(!sessionStorage.getItem('couponModalShown')){
        setTimeout(function(){
          var overlay = document.getElementById('couponModalOverlay');
          if(overlay){
            overlay.style.display = 'flex';
            sessionStorage.setItem('couponModalShown', '1');
          }
        }, 2000);
      }
    });
    // Close coupon modal
    var couponClose = document.getElementById('couponModalClose');
    if(couponClose){
      couponClose.addEventListener('click', function(){
        document.getElementById('couponModalOverlay').style.display = 'none';
      });
    }
    var couponOverlay = document.getElementById('couponModalOverlay');
    if(couponOverlay){
      couponOverlay.addEventListener('click', function(e){
        if(e.target === this) this.style.display = 'none';
      });
    }
    document.addEventListener('keydown', function(e){
      if(e.key === 'Escape'){
        var m = document.getElementById('couponModalOverlay');
        if(m) m.style.display = 'none';
      }
    });
    </script>

</body>
</html>
