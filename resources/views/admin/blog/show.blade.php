@extends('layouts.admin')

@section('title', 'View Blog Post - Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">BLOG MANAGEMENT</span>
                </div>
            </div>
            <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">View Post</h2>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-12">
                <a href="{{ route('admin.ecommerce.blog.edit', $blog) }}" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-edit me-2"></i> Edit Post / সম্পাদনা করুন
                </a>
                <a href="{{ route('admin.ecommerce.blog.index') }}" class="btn-gradient ms-2" style="padding: 0.75rem 1.5rem; border-radius: 100px; background: rgba(107, 114, 128, 0.3); text-decoration: none;">
                    <i class="fas fa-arrow-left me-2"></i> Back to List / তালিকায় ফিরুন
                </a>
            </div>
        </div>

        <!-- Post Header -->
        <div class="mb-4">
            @if($blog->featured_image)
                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title_en }}" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 16px; margin-bottom: 2rem;">
            @endif

            <div class="d-flex justify-content-between align-items-start mb-3">
                <div style="flex: 1;">
                    @if($blog->is_featured)
                        <span class="badge badge-visit-type mb-2" style="font-size: 0.85rem;">
                            <i class="fas fa-star me-1"></i> Featured Post
                        </span>
                    @endif
                    <h2 class="text-white fw-bold mb-2">{{ $blog->title_en }}</h2>
                    <h3 class="text-white mb-3" style="opacity: 0.8;">{{ $blog->title_bn }}</h3>
                </div>
                <div>
                    @if($blog->status === 'published')
                        <span class="badge badge-approved">Published</span>
                    @elseif($blog->status === 'draft')
                        <span class="badge badge-pending">Draft</span>
                    @else
                        <span class="badge badge-cancelled">Archived</span>
                    @endif
                </div>
            </div>

            <!-- Meta Info -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-user" style="color: var(--accent-blue);"></i>
                        <div>
                            <div class="text-white" style="opacity: 0.7; font-size: 0.8rem;">Author / লেখক</div>
                            <div class="text-white fw-semibold" style="font-size: 0.9rem;">{{ $blog->user->name }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-folder" style="color: var(--accent-blue);"></i>
                        <div>
                            <div class="text-white" style="opacity: 0.7; font-size: 0.8rem;">Category / বিভাগ</div>
                            <div class="text-white fw-semibold" style="font-size: 0.9rem;">{{ $blog->category ?? '—' }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-eye" style="color: var(--accent-blue);"></i>
                        <div>
                            <div class="text-white" style="opacity: 0.7; font-size: 0.8rem;">Views / দর্শন</div>
                            <div class="text-white fw-semibold" style="font-size: 0.9rem;">{{ $blog->views }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-calendar" style="color: var(--accent-blue);"></i>
                        <div>
                            <div class="text-white" style="opacity: 0.7; font-size: 0.8rem;">Created / তৈরি</div>
                            <div class="text-white fw-semibold" style="font-size: 0.9rem;">{{ $blog->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            @if($blog->tags)
            <div class="mb-4">
                <div class="text-white" style="opacity: 0.7; font-size: 0.85rem; margin-bottom: 0.5rem;">Tags / ট্যাগ:</div>
                @foreach($blog->tags_array as $tag)
                    <span class="badge badge-completed me-2" style="font-size: 0.85rem;">
                        {{ $tag }}
                    </span>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Content Cards -->
        <div class="row g-4">
            <div class="col-md-12">
                <div style="background: rgba(15, 23, 42, 0.6); padding: 2rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                    <div class="permission-title mb-3">English Content / ইংরেজি বিষয়বস্তু</div>
                    <div class="text-white" style="line-height: 1.8;">
                        {!! $blog->content_en !!}
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div style="background: rgba(15, 23, 42, 0.6); padding: 2rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                    <div class="permission-title mb-3">বাংলা বিষয়বস্তু (Bengali Content)</div>
                    <div class="text-white" style="line-height: 1.8;">
                        {!! $blog->content_bn !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Information -->
        @if($blog->meta_title || $blog->meta_description || $blog->meta_keywords)
        <div class="row g-4 mt-4">
            <div class="col-md-12">
                <div style="background: rgba(15, 23, 42, 0.6); padding: 2rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                    <div class="permission-title mb-3">SEO Information / SEO তথ্য</div>
                    <div class="row g-3">
                        @if($blog->meta_title)
                        <div class="col-md-12">
                            <div class="text-white" style="opacity: 0.7; font-size: 0.8rem;">Meta Title:</div>
                            <div class="text-white" style="font-size: 0.9rem;">{{ $blog->meta_title }}</div>
                        </div>
                        @endif
                        @if($blog->meta_description)
                        <div class="col-md-12">
                            <div class="text-white" style="opacity: 0.7; font-size: 0.8rem;">Meta Description:</div>
                            <div class="text-white" style="font-size: 0.9rem;">{{ $blog->meta_description }}</div>
                        </div>
                        @endif
                        @if($blog->meta_keywords)
                        <div class="col-md-12">
                            <div class="text-white" style="opacity: 0.7; font-size: 0.8rem;">Meta Keywords:</div>
                            <div class="text-white" style="font-size: 0.9rem;">{{ $blog->meta_keywords }}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@include('admin.ecommerce.partials.common-styles')
@endsection
