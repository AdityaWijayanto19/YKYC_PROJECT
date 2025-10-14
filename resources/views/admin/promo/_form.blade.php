{{-- Styling khusus untuk toggle switch dan area upload file --}}
<style>
    .toggle-checkbox:checked {
        right: 0;
        border-color: #1a3a64; /* navy-primary */
    }
    .toggle-checkbox:checked + .toggle-label {
        background-color: #1a3a64; /* navy-primary */
    }
    .file-drop-area.is-dragging {
        border-color: #1a3a64; /* navy-primary */
        background-color: #f0f4f8;
    }
</style>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Kolom Kiri: Input Utama --}}
    <div class="lg:col-span-2 space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-blue-medium mb-1">Judul Promo</label>
            <input type="text" id="title" name="title" value="{{ old('title', $promo->title ?? '') }}" 
                   class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium @error('title') border-red-500 @enderror" required>
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        
        <div>
            <label class="block text-sm font-medium text-blue-medium mb-1">Gambar Promo</label>
            <div id="file-drop-area" class="file-drop-area relative flex flex-col items-center justify-center w-full h-64 p-4 border-2 border-blue-pale border-dashed rounded-lg cursor-pointer transition-colors">
                <div id="preview-container" class="absolute inset-0 p-2 @unless(isset($promo) && $promo->image_path) hidden @endunless">
                    <img id="image-preview" src="{{ isset($promo) ? asset('storage/' . $promo->image_path) : '' }}" class="w-full h-full object-contain" alt="Image Preview">
                </div>
                <div id="upload-prompt" class="text-center @if(isset($promo) && $promo->image_path) opacity-0 hover:opacity-100 bg-black/50 transition-opacity flex flex-col items-center justify-center absolute inset-0 text-white @endif">
                    <svg class="w-10 h-10 mx-auto text-blue-light" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                    <p class="mt-2 text-sm"><span class="font-semibold">Klik untuk memilih</span> atau seret & lepas</p>
                    <p class="text-xs text-blue-light">PNG, JPG, GIF, WEBP (maks. 2MB)</p>
                </div>
                <input type="file" id="image_path" name="image_path" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
            </div>
            @error('image_path')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
    </div>
    
    {{-- Kolom Kanan: Status --}}
    <div class="lg:col-span-1">
        <label for="is_active" class="block text-sm font-medium text-blue-medium mb-1">Status</label>
        <div class="flex items-center gap-4">
             <div class="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
                <input type="hidden" name="is_active" value="0"> {{-- Nilai default jika checkbox tidak dicentang --}}
                <input type="checkbox" name="is_active" id="toggle" value="1" 
                       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" 
                       @checked(old('is_active', $promo->is_active ?? true))>
                <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
            </div>
            <span id="status-text" class="font-semibold text-navy-dark">
                {{ old('is_active', $promo->is_active ?? true) ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>
    </div>
</div>

<div class="mt-8 flex justify-end gap-4 border-t pt-6">
    <a href="{{ route('admin.promo.index') }}" class="bg-slate-200 text-slate-800 font-semibold py-2 px-6 rounded-lg hover:bg-slate-300 transition-colors">Batal</a>
    <button type="submit" class="bg-navy-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-opacity-90 transition-colors">Simpan Promo</button>
</div>

{{-- JavaScript untuk interaktivitas form --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- Logic untuk Toggle Switch ---
        const toggle = document.getElementById('toggle');
        const statusText = document.getElementById('status-text');
        toggle.addEventListener('change', function() {
            statusText.textContent = this.checked ? 'Aktif' : 'Nonaktif';
        });

        // --- Logic untuk Area Upload Gambar ---
        const dropArea = document.getElementById('file-drop-area');
        const fileInput = document.getElementById('image_path');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const uploadPrompt = document.getElementById('upload-prompt');

        // Fungsi untuk menampilkan pratinjau
        function showPreview(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
                uploadPrompt.classList.add('opacity-0', 'hover:opacity-100', 'bg-black/50', 'text-white');
            }
            reader.readAsDataURL(file);
        }

        // Event listener untuk input file standar
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                showPreview(fileInput.files[0]);
            }
        });

        // Event listener untuk drag and drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
            }, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.add('is-dragging'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.remove('is-dragging'), false);
        });

        dropArea.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length > 0) {
                fileInput.files = files;
                showPreview(files[0]);
            }
        }, false);
    });
</script>