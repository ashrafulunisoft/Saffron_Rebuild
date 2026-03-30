@extends('frontend.layouts.app')

@section('title', 'Blog - Saffron Sweets & Bakery')

@section('content')
<!-- BLOG HERO -->
<section style="background:linear-gradient(135deg,rgba(245,158,11,0.12),rgba(244,63,94,0.08));padding-top:140px;padding-bottom:4rem;position:relative;overflow:hidden;">
  <div style="position:absolute;top:0;left:0;width:100%;height:100%;background-image:url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 1440 320\"><path fill=\"rgba(245,158,11,0.05)\" d=\"M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z\"></path></svg>');background-repeat:no-repeat;background-position:bottom;background-size:cover;opacity:0.3;"></div>
  <div class="container" style="position:relative;">
    <div class="text-center">
      <span class="section-badge animate-on-scroll">📝 Our Blog</span>
      <h1 class="section-title mt-3 animate-on-scroll" style="font-size:3rem;">
        Latest <span class="gradient-text">News & Stories</span>
      </h1>
      <p class="mt-3 animate-on-scroll" style="color:rgba(245,230,204,0.8);max-width:600px;margin:0 auto;font-size:1.1rem;line-height:1.7;">
        Discover authentic Bengali recipes, baking tips, and sweet stories from our kitchen
      </p>
    </div>
  </div>
</section>

<!-- CATEGORY FILTERS -->
@if(isset($categories))
<section class="container" style="margin-top:-2rem;position:relative;">
  <div class="glass-card" style="padding:1rem;">
    <div class="d-flex justify-content-center gap-2 flex-wrap">
      <a href="{{ route('blog.index') }}" class="filter-btn {{ !request()->route('blog.category') ? 'active' : '' }}">
        <i class="fas fa-th-large me-2"></i>All Posts
      </a>
      @foreach($categories as $category)
      <a href="{{ route('blog.category', $category) }}" class="filter-btn {{ request()->route('blog.category') == $category ? 'active' : '' }}">
        {{ $category }}
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- FEATURED POSTS -->
@if(isset($featuredPosts) && $featuredPosts->count() > 0)
<section class="section-gap">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title">Featured <span class="gradient-text">Posts</span></h2>
    </div>
    <div class="row g-4">
      @foreach($featuredPosts as $post)
        <div class="col-lg-4 col-md-6">
          <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
            <div class="blog-card glass-card h-100 animate-on-scroll" style="border:2px solid rgba(245,158,11,0.3);">
              @if($post->featured_image)
                <div class="blog-img">
                  <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                  <span class="blog-badge">⭐ Featured</span>
                </div>
              @else
                <div class="blog-img blog-img-placeholder">
                  <div style="font-size:4rem;">📝</div>
                  <span class="blog-badge">⭐ Featured</span>
                </div>
              @endif
              <div class="blog-body">
                @if($post->category)
                  <span class="blog-category">{{ $post->category }}</span>
                @endif
                <h5 class="blog-title">{{ $post->title }}</h5>
                <p class="blog-excerpt">{{ Str::limit(strip_tags($post->excerpt ?? $post->content), 120) }}</p>
                <div class="blog-meta">
                  <span><i class="far fa-calendar"></i> {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Unpublished' }}</span>
                  <span><i class="far fa-eye"></i> {{ $post->views ?? 0 }}</span>
                  @if($post->user)
                    <span><i class="far fa-user"></i> {{ $post->user->name }}</span>
                  @endif
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- ALL POSTS -->
<section class="section-gap">
  <div class="container">
    @if(isset($featuredPosts) && $featuredPosts->count() > 0)
      <div class="text-center mb-5">
        <h2 class="section-title">All <span class="gradient-text">Posts</span></h2>
      </div>
    @endif

    <div class="row g-4">
      @if(isset($posts) && $posts->count() > 0)
        @foreach($posts as $post)
          <div class="col-lg-4 col-md-6">
            <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
              <div class="blog-card glass-card h-100 animate-on-scroll">
                @if($post->featured_image)
                  <div class="blog-img">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                    @if($post->is_featured)
                      <span class="blog-badge">⭐ Featured</span>
                    @endif
                  </div>
                @else
                  <div class="blog-img blog-img-placeholder">
                    <div style="font-size:4rem;">📝</div>
                    @if($post->is_featured)
                      <span class="blog-badge">⭐ Featured</span>
                    @endif
                  </div>
                @endif
                <div class="blog-body">
                  @if($post->category)
                    <span class="blog-category">{{ $post->category }}</span>
                  @endif
                  <h5 class="blog-title">{{ $post->title }}</h5>
                  <p class="blog-excerpt">{{ Str::limit(strip_tags($post->excerpt ?? $post->content), 100) }}</p>
                  <div class="blog-meta">
                    <span><i class="far fa-calendar"></i> {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Unpublished' }}</span>
                    <span><i class="far fa-eye"></i> {{ $post->views ?? 0 }}</span>
                    @if($post->user)
                      <span><i class="far fa-user"></i> {{ $post->user->name }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      @else
        <div class="col-12 text-center py-5">
          <div style="font-size:4rem;margin-bottom:1rem;opacity:0.5;">📝</div>
          <h4 style="color:#f5e6cc;font-family:'Playfair Display',serif;">No Blog Posts Yet</h4>
          <p style="color:rgba(245,230,204,0.6);">Check back soon for exciting stories and recipes!</p>
        </div>
      @endif
    </div>

    <!-- PAGINATION -->
    @if(isset($posts) && $posts->hasPages())
      <div class="d-flex justify-content-center mt-5">
        {{ $posts->appends(request()->query())->links() }}
      </div>
    @endif
  </div>
</section>
@endsection

@push('styles')
<style>
/* Blog Card Enhanced Styles */
.blog-card {
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: hidden;
  border-radius: 16px;
}

.blog-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(245,158,11,0.3);
}

.blog-img {
  position: relative;
  width: 100%;
  overflow: hidden;
  border-radius: 16px 16px 0 0;
  background: linear-gradient(135deg, rgba(245,158,11,0.08), rgba(244,63,94,0.05));
  min-height: 200px;
}

.blog-img img {
  width: 100%;
  height: auto;
  display: block;
  transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.blog-card:hover .blog-img img {
  transform: scale(1.08);
}

.blog-img-placeholder {
  background: linear-gradient(135deg, rgba(245,158,11,0.15), rgba(244,63,94,0.1));
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 200px;
}

.blog-badge {
  position: absolute;
  top: 15px;
  right: 15px;
  padding: 6px 16px;
  border-radius: 25px;
  font-size: 0.75rem;
  font-weight: 700;
  background: linear-gradient(135deg, #f59e0b, #f43f5e);
  color: white;
  box-shadow: 0 4px 12px rgba(245,158,11,0.4);
  z-index: 2;
}

.blog-body {
  padding: 1.75rem;
}

.blog-category {
  display: inline-block;
  padding: 6px 16px;
  background: linear-gradient(135deg, rgba(245,158,11,0.25), rgba(244,63,94,0.15));
  border: 1px solid rgba(245,158,11,0.3);
  border-radius: 25px;
  font-size: 0.75rem;
  font-weight: 600;
  color: #fbbf24;
  margin-bottom: 1rem;
  letter-spacing: 0.5px;
  text-transform: uppercase;
}

.blog-title {
  color: #f5e6cc;
  font-weight: 700;
  font-size: 1.15rem;
  margin-bottom: 0.75rem;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  font-family: 'Playfair Display', serif;
}

.blog-excerpt {
  color: rgba(245,230,204,0.75);
  font-size: 0.9rem;
  margin-bottom: 1rem;
  line-height: 1.6;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.blog-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  font-size: 0.8rem;
  color: rgba(245,230,204,0.6);
  padding-top: 1rem;
  border-top: 1px solid rgba(245,230,204,0.1);
}

.blog-meta i {
  margin-right: 4px;
  color: #fbbf24;
}

/* Animation for cards */
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

.animate-on-scroll {
  animation: fadeInUp 0.6s ease-out;
}
</style>
@endpush
