@extends('frontend.layouts.app')

@section('title', $post->title . ' - Blog - Saffron Sweets & Bakery')

@section('content')
<!-- BLOG HERO -->
@if($post->featured_image)
<section class="section-gap" style="padding:3rem 0;background:linear-gradient(135deg,rgba(245,158,11,0.05),rgba(244,63,94,0.05));">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="glass-card" style="overflow:hidden;">
          <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" style="width:100%;height:400px;object-fit:cover;">
          @if($post->is_featured)
            <span class="badge" style="position:absolute;top:20px;right:20px;background:linear-gradient(135deg,#f59e0b,#f43f5e);color:white;padding:8px 16px;border-radius:20px;font-size:0.875rem;">⭐ Featured Post</span>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
@endif

<!-- BLOG CONTENT -->
<section class="section-gap">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <article class="glass-card" style="padding:2rem;">
          <!-- Post Header -->
          <div class="mb-4">
            @if($post->category)
              <span class="badge" style="background:linear-gradient(135deg,rgba(245,158,11,0.2),rgba(244,63,94,0.2));color:#fbbf24;padding:6px 14px;border-radius:20px;font-size:0.875rem;">{{ $post->category }}</span>
            @endif
            <h1 class="mt-3" style="color:#f5e6cc;font-family:'Playfair Display',serif;font-size:2.5rem;line-height:1.2;">{{ $post->title }}</h1>

            <div class="d-flex flex-wrap gap-3 mt-3" style="color:rgba(245,230,204,0.6);font-size:0.9rem;">
              @if($post->user)
                <span><i class="far fa-user"></i> {{ $post->user->name }}</span>
              @endif
              @if($post->published_at)
                <span><i class="far fa-calendar"></i> {{ $post->published_at->format('F d, Y') }}</span>
              @endif
              <span><i class="far fa-eye"></i> {{ $post->views }} views</span>
            </div>
          </div>

          <!-- Post Excerpt -->
          @if($post->excerpt)
            <div class="blog-excerpt-highlight" style="background:linear-gradient(135deg,rgba(245,158,11,0.1),rgba(244,63,94,0.1));padding:1.5rem;border-left:4px solid #f59e0b;margin-bottom:2rem;border-radius:0 12px 12px 0;font-size:1.1rem;color:rgba(245,230,204,0.8);font-style:italic;">
              {{ $post->excerpt }}
            </div>
          @endif

          <!-- Post Content -->
          <div class="blog-content" style="color:rgba(245,230,204,0.85);line-height:1.9;font-size:1.05rem;">
            {!! $post->content !!}
          </div>

          <!-- Tags -->
          @if($post->tags)
            <div class="mt-5 pt-4" style="border-top:1px solid rgba(245,230,204,0.1);">
              <strong style="color:#f5e6cc;">Tags:</strong>
              <div class="d-flex flex-wrap gap-2 mt-2">
                @foreach(explode(',', $post->tags) as $tag)
                  <span class="badge" style="background:rgba(245,230,204,0.1);color:rgba(245,230,204,0.7);padding:6px 12px;border-radius:20px;font-size:0.85rem;">{{ trim($tag) }}</span>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Share Section -->
          <div class="mt-5 pt-4" style="border-top:1px solid rgba(245,230,204,0.1);">
            <strong style="color:#f5e6cc;">Share this post:</strong>
            <div class="d-flex gap-2 mt-2">
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-sm" style="background:#1877f2;color:white;border:none;">
                <i class="fab fa-facebook-f"></i> Facebook
              </a>
              <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $post->title }}" target="_blank" class="btn btn-sm" style="background:#000000;color:white;border:none;">
                <i class="fab fa-x-twitter"></i> Twitter
              </a>
              <a href="https://wa.me/?text={{ $post->title }} - {{ url()->current() }}" target="_blank" class="btn btn-sm" style="background:#25d366;color:white;border:none;">
                <i class="fab fa-whatsapp"></i> WhatsApp
              </a>
            </div>
          </div>
        </article>

        <!-- Back to Blog -->
        <div class="mt-4">
          <a href="{{ route('blog.index') }}" class="btn btn-glass">
            <i class="fas fa-arrow-left me-2"></i> Back to Blog
          </a>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <!-- Author Card -->
        @if($post->user)
          <div class="glass-card mb-4" style="padding:1.5rem;">
            <h5 style="color:#f5e6cc;margin-bottom:1rem;">About the Author</h5>
            <div class="d-flex align-items-center gap-3">
              <div style="width:60px;height:60px;background:linear-gradient(135deg,#f59e0b,#f43f5e);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:white;">
                {{ substr($post->user->name, 0, 1) }}
              </div>
              <div>
                <h6 style="color:#f5e6cc;margin:0;">{{ $post->user->name }}</h6>
                <small style="color:rgba(245,230,204,0.6);">Author</small>
              </div>
            </div>
          </div>
        @endif

        <!-- Related Posts -->
        @if(isset($relatedPosts) && $relatedPosts->count() > 0)
          <div class="glass-card" style="padding:1.5rem;">
            <h5 style="color:#f5e6cc;margin-bottom:1rem;">Related Posts</h5>
            <div class="d-flex flex-column gap-3">
              @foreach($relatedPosts as $related)
                <a href="{{ route('blog.show', $related->slug) }}" class="text-decoration-none">
                  <div class="d-flex gap-3">
                    @if($related->featured_image)
                      <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" style="width:80px;height:60px;object-fit:cover;border-radius:8px;">
                    @else
                      <div style="width:80px;height:60px;background:linear-gradient(135deg,rgba(245,158,11,0.1),rgba(244,63,94,0.1));border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:2rem;">📝</div>
                    @endif
                    <div style="flex:1;">
                      <h6 style="color:#f5e6cc;font-size:0.95rem;margin:0 0 0.25rem 0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $related->title }}</h6>
                      <small style="color:rgba(245,230,204,0.5);">{{ $related->published_at ? $related->published_at->format('M d') : '' }}</small>
                    </div>
                  </div>
                </a>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endsection

@push('styles')
<style>
.blog-content h2 {
  color: #f5e6cc;
  font-family: 'Playfair Display', serif;
  margin-top: 2rem;
  margin-bottom: 1rem;
  font-size: 1.75rem;
}

.blog-content h3 {
  color: #f5e6cc;
  font-family: 'Playfair Display', serif;
  margin-top: 1.5rem;
  margin-bottom: 0.75rem;
  font-size: 1.5rem;
}

.blog-content p {
  margin-bottom: 1rem;
}

.blog-content ul, .blog-content ol {
  margin-bottom: 1.5rem;
  padding-left: 1.5rem;
}

.blog-content li {
  margin-bottom: 0.5rem;
}

.blog-content img {
  max-width: 100%;
  height: auto;
  border-radius: 12px;
  margin: 1.5rem 0;
}

.blog-content blockquote {
  border-left: 4px solid #f59e0b;
  padding-left: 1.5rem;
  margin: 1.5rem 0;
  font-style: italic;
  color: rgba(245,230,204,0.8);
}

.blog-content a {
  color: #fbbf24;
  text-decoration: underline;
}

.blog-content a:hover {
  color: #f59e0b;
}

.blog-excerpt-highlight {
  animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
@endpush
