@extends('frontend.layouts.app')

@section('title', 'Blog - Saffron Sweets & Bakery')

@section('content')
<!-- BLOG HERO -->
<section class="section-gap" style="background:linear-gradient(135deg,rgba(245,158,11,0.08),rgba(244,63,94,0.05));">
  <div class="container">
    <div class="text-center">
      <span class="section-badge">Our Blog</span>
      <h1 class="section-title mt-3">
        Latest <span class="gradient-text">News & Stories</span>
      </h1>
      <p class="mt-3" style="color:rgba(245,230,204,0.7);max-width:600px;margin:0 auto;">
        Discover recipes, baking tips, and sweet stories from our kitchen
      </p>
    </div>
  </div>
</section>

<!-- CATEGORY FILTERS -->
@if(isset($categories))
<section class="container" style="margin-top:-2rem;">
  <div class="d-flex justify-content-center gap-2 flex-wrap">
    <a href="{{ route('blog.index') }}" class="filter-btn {{ !request()->route('blog.category') ? 'active' : '' }}">All Posts</a>
    @foreach($categories as $category)
      <a href="{{ route('blog.category', $category) }}" class="filter-btn {{ request()->route('blog.category') == $category ? 'active' : '' }}">{{ $category }}</a>
    @endforeach
  </div>
</section>
@endif

<!-- FEATURED POSTS -->
@if(isset($featuredPosts) && $featuredPosts->count() > 0)
<section class="section-gap">
  <div class="container">
    <div class="row g-4">
      @foreach($featuredPosts as $post)
        <div class="col-lg-4 col-md-6">
          <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
            <div class="blog-card glass-card h-100" style="border:1px solid rgba(245,158,11,0.3);">
              @if($post->featured_image)
                <div class="blog-img">
                  <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                  <span class="blog-badge badge-featured">⭐ Featured</span>
                </div>
              @else
                <div class="blog-img blog-img-placeholder">
                  <div style="font-size:4rem;">📝</div>
                  <span class="blog-badge badge-featured">⭐ Featured</span>
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
    <h3 class="section-title mb-4">Recent Posts</h3>
    <div class="row g-4">
      @if(isset($posts) && $posts->count() > 0)
        @foreach($posts as $post)
          <div class="col-lg-4 col-md-6">
            <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
              <div class="blog-card glass-card h-100">
                @if($post->featured_image)
                  <div class="blog-img">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                    @if($post->is_featured)
                      <span class="blog-badge badge-featured">⭐ Featured</span>
                    @endif
                  </div>
                @else
                  <div class="blog-img blog-img-placeholder">
                    <div style="font-size:4rem;">📝</div>
                    @if($post->is_featured)
                      <span class="blog-badge badge-featured">⭐ Featured</span>
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
          <div style="font-size:4rem;margin-bottom:1rem;">📝</div>
          <h4 style="color:#f5e6cc;">No Blog Posts Yet</h4>
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
.blog-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  overflow: hidden;
}

.blog-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(245,158,11,0.2);
}

.blog-img {
  width: 100%;
  height: 200px;
  overflow: hidden;
  position: relative;
}

.blog-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.blog-card:hover .blog-img img {
  transform: scale(1.05);
}

.blog-img-placeholder {
  background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(244,63,94,0.1));
  display: flex;
  align-items: center;
  justify-content: center;
}

.blog-badge {
  position: absolute;
  top: 10px;
  right: 10px;
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
}

.badge-featured {
  background: linear-gradient(135deg, #f59e0b, #f43f5e);
  color: white;
}

.blog-body {
  padding: 1.5rem;
}

.blog-category {
  display: inline-block;
  padding: 4px 12px;
  background: linear-gradient(135deg, rgba(245,158,11,0.2), rgba(244,63,94,0.2));
  border-radius: 20px;
  font-size: 0.75rem;
  color: #fbbf24;
  margin-bottom: 0.75rem;
}

.blog-title {
  color: #f5e6cc;
  font-weight: 600;
  margin-bottom: 0.75rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.blog-excerpt {
  color: rgba(245,230,204,0.7);
  font-size: 0.9rem;
  margin-bottom: 1rem;
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
}
</style>
@endpush
