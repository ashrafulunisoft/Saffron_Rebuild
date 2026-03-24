@extends('frontend.layouts.app')

@section('title', $post->title . ' - Blog - Saffron Sweets & Bakery')

@section('content')
<!-- BLOG HERO -->
@if($post->featured_image)
<section style="padding-top:100px;padding-bottom:40px;background:linear-gradient(135deg,rgba(245,158,11,0.05),rgba(244,63,94,0.03));">
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol style="list-style:none;display:flex;gap:0.5rem;flex-wrap:wrap;font-size:0.9rem;">
        <li>
          <a href="{{ route('home') }}" style="color:rgba(245,230,204,0.6);text-decoration:none;">
            <i class="fas fa-home"></i>
          </a>
        </li>
        <li style="color:rgba(245,230,204,0.4);">/</li>
        <li>
          <a href="{{ route('blog.index') }}" style="color:rgba(245,230,204,0.6);text-decoration:none;">
            Blog
          </a>
        </li>
        <li style="color:rgba(245,230,204,0.4);">/</li>
        <li style="color:rgba(245,230,204,0.8);">{{ Str::limit($post->title, 35) }}</li>
      </ol>
    </nav>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="glass-card" style="padding:1.5rem;border-radius:16px;box-shadow:0 10px 40px rgba(0,0,0,0.3);">
          <!-- Blog Image Container -->
          <div style="position:relative;width:100%;border-radius:12px;background:rgba(245,230,204,0.02);margin-bottom:1.5rem;">
            @if($post->is_featured)
              <span style="position:absolute;top:15px;right:15px;background:linear-gradient(135deg,#f59e0b,#f43f5e);color:white;padding:6px 16px;border-radius:20px;font-size:0.75rem;font-weight:700;box-shadow:0 4px 12px rgba(245,158,11,0.4);z-index:2;">⭐ Featured</span>
            @endif
            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" style="width:100%;height:auto;display:block;border-radius:12px;">
          </div>
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
        <article class="glass-card" style="padding:2.5rem;border-radius:16px;">
          <!-- Post Header -->
          <div class="mb-4">
            @if($post->category)
              <span class="blog-category-badge">{{ $post->category }}</span>
            @endif
            <h1 style="color:#f5e6cc;font-family:'Playfair Display',serif;font-size:2.5rem;line-height:1.2;margin-top:1rem;">{{ $post->title }}</h1>

            <div class="d-flex flex-wrap gap-3 mt-3" style="color:rgba(245,230,204,0.6);font-size:0.9rem;padding-bottom:1rem;border-bottom:1px solid rgba(245,230,204,0.1);">
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
            <div style="background:linear-gradient(135deg,rgba(245,158,11,0.12),rgba(244,63,94,0.08));padding:1.5rem;border-left:4px solid #f59e0b;margin-bottom:2rem;border-radius:0 12px 12px 0;font-size:1.05rem;color:rgba(245,230,204,0.85);font-style:italic;">
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
              <strong style="color:#f5e6cc;font-size:0.9rem;">Tags:</strong>
              <div class="d-flex flex-wrap gap-2 mt-2">
                @foreach(explode(',', $post->tags) as $tag)
                  <span style="background:rgba(245,230,204,0.1);color:rgba(245,230,204,0.7);padding:6px 14px;border-radius:20px;font-size:0.85rem;">{{ trim($tag) }}</span>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Share Section -->
          <div class="mt-5 pt-4" style="border-top:1px solid rgba(245,230,204,0.1);">
            <strong style="color:#f5e6cc;font-size:0.9rem;">Share this post:</strong>
            <div class="d-flex gap-2 mt-2">
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="btn-share" style="background:#1877f2;">
                <i class="fab fa-facebook-f"></i> Facebook
              </a>
              <a href="https://wa.me/?text={{ $post->title }} - {{ url()->current() }}" target="_blank" class="btn-share" style="background:#25d366;">
                <i class="fab fa-whatsapp"></i> WhatsApp
              </a>
            </div>
          </div>
        </article>

        <!-- Back to Blog -->
        <div class="mt-4">
          <a href="{{ route('blog.index') }}" class="btn btn-glass" style="padding:0.75rem 1.5rem;border-radius:25px;">
            <i class="fas fa-arrow-left me-2"></i> Back to Blog
          </a>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <!-- Author Card -->
        @if($post->user)
          <div class="glass-card" style="padding:1.5rem;margin-bottom:1.5rem;border-radius:16px;">
            <h5 style="color:#f5e6cc;margin-bottom:1rem;font-size:1.1rem;">About the Author</h5>
            <div class="d-flex align-items-center gap-3">
              <div style="width:60px;height:60px;background:linear-gradient(135deg,#f59e0b,#f43f5e);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:white;font-weight:700;">
                {{ substr($post->user->name, 0, 1) }}
              </div>
              <div>
                <h6 style="color:#f5e6cc;margin:0;font-size:1rem;">{{ $post->user->name }}</h6>
                <small style="color:rgba(245,230,204,0.6);">Author</small>
              </div>
            </div>
          </div>
        @endif

        <!-- Related Posts -->
        @if(isset($relatedPosts) && $relatedPosts->count() > 0)
          <div class="glass-card" style="padding:1.5rem;border-radius:16px;">
            <h5 style="color:#f5e6cc;margin-bottom:1rem;font-size:1.1rem;">Related Posts</h5>
            <div class="d-flex flex-column gap-3">
              @foreach($relatedPosts as $related)
                <a href="{{ route('blog.show', $related->slug) }}" class="text-decoration-none">
                  <div class="d-flex gap-3" style="padding:0.75rem;background:rgba(245,230,204,0.05);border-radius:12px;transition:all 0.3s ease;">
                    @if($related->featured_image)
                      <div style="width:80px;height:60px;overflow:hidden;border-radius:8px;background:rgba(245,230,204,0.02);">
                        <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" style="width:100%;height:100%;object-fit:cover;">
                      </div>
                    @else
                      <div style="width:80px;height:60px;background:linear-gradient(135deg,rgba(245,158,11,0.1),rgba(244,63,94,0.1));border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:2rem;">📝</div>
                    @endif
                    <div style="flex:1;">
                      <h6 style="color:#f5e6cc;font-size:0.9rem;margin:0 0 0.25rem 0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $related->title }}</h6>
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
/* Blog Category Badge */
.blog-category-badge {
  display: inline-block;
  padding: 6px 16px;
  background: linear-gradient(135deg, rgba(245,158,11,0.25), rgba(244,63,94,0.15));
  border: 1px solid rgba(245,158,11,0.3);
  border-radius: 25px;
  font-size: 0.75rem;
  font-weight: 600;
  color: #fbbf24;
  letter-spacing: 0.5px;
  text-transform: uppercase;
}

/* Share Buttons */
.btn-share {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 18px;
  border: none;
  border-radius: 25px;
  color: white;
  font-size: 0.875rem;
  font-weight: 600;
  transition: all 0.3s ease;
  text-decoration: none;
}

.btn-share:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.3);
}

/* Blog Content Styles */
.blog-content h2 {
  color: #f5e6cc;
  font-family: 'Playfair Display', serif;
  margin-top: 2.5rem;
  margin-bottom: 1.25rem;
  font-size: 1.85rem;
  font-weight: 700;
}

.blog-content h3 {
  color: #f5e6cc;
  font-family: 'Playfair Display', serif;
  margin-top: 2rem;
  margin-bottom: 1rem;
  font-size: 1.55rem;
  font-weight: 600;
}

.blog-content p {
  margin-bottom: 1.25rem;
  line-height: 1.9;
}

.blog-content ul, .blog-content ol {
  margin-bottom: 1.5rem;
  padding-left: 1.75rem;
}

.blog-content li {
  margin-bottom: 0.6rem;
  line-height: 1.7;
}

.blog-content img {
  max-width: 100%;
  height: auto;
  display: block;
  margin: 2rem auto;
  border-radius: 12px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.2);
}

.blog-content blockquote {
  border-left: 4px solid #f59e0b;
  padding-left: 1.5rem;
  margin: 2rem 0;
  font-style: italic;
  color: rgba(245,230,204,0.8);
  background: rgba(245,158,11,0.05);
  padding: 1.5rem;
  border-radius: 0 12px 12px 0;
}

.blog-content a {
  color: #fbbf24;
  text-decoration: underline;
  transition: color 0.3s ease;
}

.blog-content a:hover {
  color: #f59e0b;
}

/* Related Post Hover */
a[style*="padding:0.75rem"] {
  transition: all 0.3s ease;
}

a[style*="padding:0.75rem"]:hover {
  transform: translateX(5px);
  background: rgba(245,230,204,0.08) !important;
}
</style>
@endpush
