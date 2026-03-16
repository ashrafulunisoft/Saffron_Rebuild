@extends('layouts.admin')

@section('title', 'CMS Pages - Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">CMS PAGES</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">CMS Pages</h2>
                <a href="{{ route('admin.ecommerce.cms.create') }}" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-plus me-2"></i>Add New Page
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.3); color: #22c55e;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- CMS Pages Table -->
        <div class="table-responsive">
            <table class="table table-dark table-hover" id="cmsTable">
                <thead>
                    <tr style="border-bottom: 2px solid rgba(255,255,255,0.1);">
                        <th style="color: rgba(255,255,255,0.7); font-weight: 600;">Page Title / শিরোনাম</th>
                        <th style="color: rgba(255,255,255,0.7); font-weight: 600;">Slug / স্লাগ</th>
                        <th style="color: rgba(255,255,255,0.7); font-weight: 600;">Status / অবস্থা</th>
                        <th style="color: rgba(255,255,255,0.7); font-weight: 600;">Created / তৈরি</th>
                        <th style="color: rgba(255,255,255,0.7); font-weight: 600;">Actions / পদক্ষেপ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(139, 92, 246, 0.2)); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-file-alt" style="color: var(--accent-blue);"></i>
                                </div>
                                <div>
                                    <div style="color: white; font-weight: 600;">{{ $page->title_en }}</div>
                                    <div style="color: rgba(255,255,255,0.5); font-size: 0.85rem;">{{ $page->title_bn ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <code style="background: rgba(59, 130, 246, 0.2); color: var(--accent-blue); padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.9rem;">{{ $page->slug }}</code>
                        </td>
                        <td>
                            @if($page->is_active)
                                <span style="background: rgba(34, 197, 94, 0.2); color: #22c55e; padding: 0.25rem 0.75rem; border-radius: 100px; font-size: 0.85rem; font-weight: 500;">
                                    <i class="fas fa-check-circle me-1"></i>Active
                                </span>
                            @else
                                <span style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.75rem; border-radius: 100px; font-size: 0.85rem; font-weight: 500;">
                                    <i class="fas fa-times-circle me-1"></i>Inactive
                                </span>
                            @endif
                        </td>
                        <td style="color: rgba(255,255,255,0.7);">
                            {{ $page->created_at->format('M d, Y') }}
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.ecommerce.cms.edit', $page) }}" class="btn btn-sm" style="background: rgba(59, 130, 246, 0.2); color: var(--accent-blue); border: 1px solid rgba(59, 130, 246, 0.3); padding: 0.4rem 0.8rem; border-radius: 8px; text-decoration: none;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.ecommerce.cms.destroy', $page) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this page?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 0.4rem 0.8rem; border-radius: 8px;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div style="color: rgba(255,255,255,0.5);">
                                <i class="fas fa-file-alt" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                                <p>No CMS pages found. / কোনো পেজ পাওয়া যায়নি</p>
                                <a href="{{ route('admin.ecommerce.cms.create') }}" class="btn-gradient" style="padding: 0.5rem 1.5rem; border-radius: 100px; text-decoration: none; margin-top: 1rem; display: inline-block;">
                                    <i class="fas fa-plus me-2"></i>Create First Page
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pages->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div style="color: rgba(255,255,255,0.7);">
                Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} of {{ $pages->total() }} pages
            </div>
            {{ $pages->links('pagination::bootstrap-4') }}
        </div>
        @endif
    </div>
</div>
@endsection
