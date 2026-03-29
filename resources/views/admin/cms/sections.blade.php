@extends('layouts.admin')

@section('title', 'Manage Sections - Admin')

@section('content')
<div class="container-fluid">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem; background: linear-gradient(135deg, var(--accent-blue), #8b5cf6);">S</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">SAFFRON</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">CMS SECTIONS - {{ $cms->title }}</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.ecommerce.cms.index') }}" class="btn btn-sm" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-arrow-left me-2"></i>Back to Pages
                </a>
                <a href="{{ route('admin.ecommerce.cms.sections.create', $cms) }}" class="btn-gradient" style="padding: 0.75rem 1.5rem; border-radius: 100px; text-decoration: none;">
                    <i class="fas fa-plus me-2"></i>Add Section
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(34, 197, 94, 0.2); border: 1px solid rgba(34, 197, 94, 0.3); color: #22c55e;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.3); color: white; margin-bottom: 1.5rem; border-radius: 12px;">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1);"></button>
            </div>
        @endif

        <!-- Sections Table -->
        <div class="table-responsive">
            <table class="table table-dark table-hover">
                <thead>
                    <tr style="border-bottom: 2px solid rgba(255,255,255,0.1);">
                        <th style="color: rgba(255,255,255,0.7); font-weight: 600;">Section Key</th>
                        <th style="color: rgba(255,255,255,0.7); font-weight: 600;">Title (EN)</th>
                        {{-- <th style="color: rgba(255,255,255,0.7); font-weight: 600;">Title (BN)</th> --}}
                        <th style="color: rgba(255,255,255,0.7); font-weight: 600;">Content</th>
                        <th style="color: rgba(255,255,255,0.7); font-weight: 600;">Status</th>
                        <th style="color: rgba(255,255,255,0.7); font-weight: 600;">Order</th>
                        <th style="color: rgba(255,255,255,0.7); font-weight: 600;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cms->sections()->ordered()->get() as $section)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td>
                            <code style="background: rgba(59, 130, 246, 0.2); color: var(--accent-blue); padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.9rem;">{{ $section->section_key }}</code>
                        </td>
                        <td style="color: white; font-weight: 500;">{{ $section->title_en }}</td>
                        {{-- <td style="color: rgba(255,255,255,0.6);">{{ $section->title_bn ?? 'N/A' }}</td> --}}
                        <td>
                            <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: rgba(255,255,255,0.6);">
                                {{ \Illuminate\Support\Str::limit(strip_tags($section->content_en ?? ''), 100) }}
                            </div>
                        </td>
                        <td>
                            @if($section->is_active)
                                <span style="background: rgba(34, 197, 94, 0.2); color: #22c55e; padding: 0.25rem 0.75rem; border-radius: 100px; font-size: 0.85rem;">
                                    Active
                                </span>
                            @else
                                <span style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.75rem; border-radius: 100px; font-size: 0.85rem;">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td style="color: rgba(255,255,255,0.7);">{{ $section->sort_order }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.ecommerce.cms.sections.edit', [$cms, $section]) }}" class="btn btn-sm" style="background: rgba(59, 130, 246, 0.2); color: var(--accent-blue); border: 1px solid rgba(59, 130, 246, 0.3); padding: 0.4rem 0.8rem; border-radius: 8px; text-decoration: none;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {{-- <form action="{{ route('admin.ecommerce.cms.sections.destroy', [$cms, $section]) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 0.4rem 0.8rem; border-radius: 8px;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> --}}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div style="color: rgba(255,255,255,0.5);">
                                <i class="fas fa-puzzle-piece" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                                <p>No sections found. Create your first section!</p>
                                <a href="{{ route('admin.ecommerce.cms.sections.create', $cms) }}" class="btn-gradient" style="padding: 0.5rem 1.5rem; border-radius: 100px; text-decoration: none; margin-top: 1rem; display: inline-block;">
                                    <i class="fas fa-plus me-2"></i>Create Section
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
