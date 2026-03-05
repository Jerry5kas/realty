@props(['name' => 'images', 'label' => 'Upload Images', 'multiple' => true, 'maxFiles' => 10, 'existingImages' => [], 'folder' => '/properties'])

<div x-data="imagekitUploader({{ json_encode($existingImages) }}, {{ $multiple ? 'true' : 'false' }}, {{ $maxFiles }}, '{{ $folder }}')" x-init="init()">
    <label class="block text-sm font-medium mb-2" style="color: {{ $theme['primary_color'] }};">
        {{ $label }}
    </label>
    
    <!-- Upload Button -->
    <div class="mb-4">
        <button 
            type="button"
            @click="openUploader()"
            class="px-6 py-3 text-white rounded-xl font-medium hover:opacity-90 transition-all flex items-center gap-2"
            style="background-color: {{ $theme['secondary_color'] }};"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
            </svg>
            <span>Upload {{ $multiple ? 'Images' : 'Image' }}</span>
        </button>
        <p class="text-xs text-gray-500 mt-1">
            @if($multiple)
                Maximum {{ $maxFiles }} images allowed
            @else
                Single image upload
            @endif
        </p>
    </div>

    <!-- Image Preview Grid -->
    <div x-show="images.length > 0" class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <template x-for="(image, index) in images" :key="index">
            <div class="relative group">
                <img :src="image" :alt="'Image ' + (index + 1)" class="w-full h-32 object-cover rounded-lg border-2" style="border-color: {{ $theme['primary_color'] }};">
                <button 
                    type="button"
                    @click="removeImage(index)"
                    class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </template>
    </div>

    <!-- Hidden input to store image URLs -->
    <input type="hidden" name="{{ $name }}" x-model="imagesJson">
</div>

@once
@push('scripts')
<script src="https://unpkg.com/imagekit-javascript/dist/imagekit.min.js"></script>

<script>
function imagekitUploader(existingImages = [], multiple = true, maxFiles = 10, folder = '/properties') {
    return {
        images: existingImages,
        imagesJson: JSON.stringify(existingImages),
        multiple: multiple,
        maxFiles: maxFiles,
        folder: folder,
        
        init() {
            this.updateJson();
        },
        
        openUploader() {
            if (!this.multiple && this.images.length >= 1) {
                alert('Only one image is allowed. Please remove the existing image first.');
                return;
            }
            
            if (this.images.length >= this.maxFiles) {
                alert(`Maximum ${this.maxFiles} images allowed. Please remove some images first.`);
                return;
            }
            
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.multiple = this.multiple;
            
            input.onchange = async (e) => {
                const files = Array.from(e.target.files);
                
                if (files.length + this.images.length > this.maxFiles) {
                    alert(`You can only upload ${this.maxFiles - this.images.length} more image(s).`);
                    return;
                }
                
                for (const file of files) {
                    await this.uploadFile(file);
                }
            };
            
            input.click();
        },
        
        async uploadFile(file) {
            try {
                const formData = new FormData();
                formData.append('file', file);
                formData.append('fileName', file.name);
                formData.append('folder', this.folder);
                
                // Show loading placeholder
                const loadingIndex = this.images.length;
                this.images.push('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2YzZjRmNiIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiM5Y2EzYWYiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5VcGxvYWRpbmcuLi48L3RleHQ+PC9zdmc+');
                this.updateJson();
                
                const response = await fetch('{{ route('imagekit.upload') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    this.images[loadingIndex] = data.url;
                } else {
                    this.images.splice(loadingIndex, 1);
                    alert('Upload failed: ' + (data.message || 'Unknown error'));
                }
                
                this.updateJson();
            } catch (error) {
                console.error('Upload error:', error);
                // Remove loading placeholder
                const idx = this.images.indexOf('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2YzZjRmNiIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiM5Y2EzYWYiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5VcGxvYWRpbmcuLi48L3RleHQ+PC9zdmc+');
                if (idx > -1) {
                    this.images.splice(idx, 1);
                }
                this.updateJson();
                alert('Upload failed. Please try again.');
            }
        },
        
        removeImage(index) {
            this.images.splice(index, 1);
            this.updateJson();
        },
        
        updateJson() {
            this.imagesJson = JSON.stringify(this.images);
        }
    }
}
</script>
@endpush
@endonce
