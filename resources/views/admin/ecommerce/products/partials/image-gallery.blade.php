{{-- Product Image Gallery Component --}}

<!-- Image Upload Section -->
<div class="card bg-dark border-secondary mb-4">
    <div class="card-header bg-info border-secondary">
        <h5 class="mb-0 text-white"><i class="fas fa-images me-2"></i>Product Images / পণ্যের ছবি</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label text-white">
                Upload Images <span class="text-info">(Max 2MB per image)</span>
            </label>
            <input type="file"
                   class="form-control bg-dark text-white border-secondary"
                   id="imageUpload"
                   accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                   multiple>
            <small class="text-muted mt-2 d-block">You can select multiple images at once. JPG, PNG, GIF, WebP formats supported.</small>
        </div>

        <!-- Upload Progress -->
        <div id="uploadProgress" class="d-none mb-3">
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%"></div>
            </div>
            <small class="text-info mt-2 d-block">Uploading images...</small>
        </div>

        <!-- Image Gallery -->
        @if(isset($product) && $product->images->count() > 0)
            <div class="row" id="imageGallery">
                @foreach($product->images as $image)
                    <div class="col-md-3 mb-3 image-item" data-image-id="{{ $image->id }}">
                        <div class="card bg-secondary border-0 h-100">
                            <div class="card-body p-2 text-center position-relative">
                                {{-- Primary Badge --}}
                                @if($image->is_primary)
                                    <span class="position-absolute top-0 start-0 badge bg-primary">Primary</span>
                                @endif

                                {{-- Image --}}
                                <img src="{{ asset('storage/' . $image->image) }}"
                                     alt="{{ $product->name_en }}"
                                     class="img-fluid rounded mb-2"
                                     style="max-height: 150px; object-fit: cover; width: 100%;">

                                {{-- Action Buttons --}}
                                <div class="btn-group w-100" role="group">
                                    @if(!$image->is_primary)
                                        <button type="button"
                                                class="btn btn-sm btn-warning set-primary-btn"
                                                data-url="{{ route('admin.ecommerce.products.images.primary', [$product, $image]) }}"
                                                title="Set as Primary">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-sm btn-primary" disabled>
                                            <i class="fas fa-star"></i>
                                        </button>
                                    @endif
                                    <button type="button"
                                            class="btn btn-sm btn-danger delete-image-btn"
                                            data-url="{{ route('admin.ecommerce.products.images.destroy', [$product, $image]) }}"
                                            title="Delete Image">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-4" id="noImagesMessage">
                <i class="fas fa-image text-muted fs-1 mb-3 d-block"></i>
                <p class="text-white">No images uploaded yet. Upload images above!</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const productId = '{{ isset($product) ? $product->id : "new" }}';

    // Handle image upload
    const imageUpload = document.getElementById('imageUpload');
    if (imageUpload) {
        imageUpload.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            if (files.length === 0) return;

            // Show progress
            const uploadProgress = document.getElementById('uploadProgress');
            uploadProgress.classList.remove('d-none');

            // Upload each file
            files.forEach(file => {
                uploadImage(file);
            });
        });
    }

    // Upload single image
    function uploadImage(file) {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('_token', '{{ csrf_token() }}');

        fetch(`{{ route('admin.ecommerce.products.images.store', isset($product) ? $product : 0) }}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Hide progress
                document.getElementById('uploadProgress').classList.add('d-none');

                // Clear file input
                document.getElementById('imageUpload').value = '';

                // Show success message
                showAlert('success', data.message);

                // Reload page or append image to gallery
                setTimeout(() => location.reload(), 1000);
            } else {
                showAlert('error', 'Failed to upload image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'Error uploading image');
        });
    }

    // Set primary image
    document.querySelectorAll('.set-primary-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const url = this.dataset.url;

            if (!confirm('Set this image as primary? এই ছবিটি প্রাথমিক হিসাবে সেট করবেন?')) return;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    setTimeout(() => location.reload(), 1000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Error setting primary image');
            });
        });
    });

    // Delete image
    document.querySelectorAll('.delete-image-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const url = this.dataset.url;

            if (!confirm('Delete this image? এই ছবি মুছে ফেলবেন?')) return;

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    // Remove image from gallery
                    const imageItem = this.closest('.image-item');
                    imageItem.remove();

                    // Check if no images left
                    const gallery = document.getElementById('imageGallery');
                    if (gallery && gallery.children.length === 0) {
                        document.getElementById('noImagesMessage').classList.remove('d-none');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Error deleting image');
            });
        });
    });

    // Show alert helper
    function showAlert(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
        alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(alertDiv);

        setTimeout(() => alertDiv.remove(), 3000);
    }
});
</script>
@endpush
