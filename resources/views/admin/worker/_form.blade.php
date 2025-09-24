{{-- File ini akan di-include oleh create.blade.php dan edit.blade.php --}}

{{-- Cek apakah kita sedang dalam mode edit (ada variabel $worker) atau mode tambah --}}
@php
    $isEdit = isset($worker);
@endphp

<form action="{{ $isEdit ? '#' : '#' }}" method="POST" enctype="multipart/form-data">
    @csrf
    {{-- Blade directive untuk method spoofing saat edit --}}
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kolom Kiri: Info Profil --}}
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold text-navy-dark mb-4">Foto Profil</h3>
                <!-- Photo Preview -->
                <div class="mb-4">
                    <img id="photo-preview" 
                         src="{{ $isEdit ? 'https://i.pravatar.cc/150?u='.$worker['email'] : 'https://via.placeholder.com/150' }}" 
                         alt="Preview" class="w-32 h-32 rounded-full mx-auto object-cover">
                </div>
                <label for="photo" class="block text-sm font-medium text-blue-medium mb-2">Upload Foto</label>
                <input type="file" id="photo" name="photo" class="w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-pale file:text-navy-primary
                    hover:file:bg-blue-light"/>
                <p class="text-xs text-blue-light mt-2">Format: JPG, PNG, GIF. Maks: 2MB.</p>
            </div>
        </div>

        {{-- Kolom Kanan: Detail Data --}}
        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold text-navy-dark mb-6">Informasi Worker</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Depan -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-blue-medium mb-1">Nama Depan</label>
                        <input type="text" id="first_name" name="first_name" 
                               value="{{ old('first_name', $worker['first_name'] ?? '') }}"
                               class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium" required>
                    </div>
                    <!-- Nama Belakang -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-blue-medium mb-1">Nama Belakang</label>
                        <input type="text" id="last_name" name="last_name" 
                               value="{{ old('last_name', $worker['last_name'] ?? '') }}"
                               class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                    </div>
                    <!-- Email -->
                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-blue-medium mb-1">Alamat Email</label>
                        <input type="email" id="email" name="email" 
                               value="{{ old('email', $worker['email'] ?? '') }}"
                               class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium" required>
                    </div>
                    <!-- Jenis Worker -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-blue-medium mb-1">Jenis Worker</label>
                        <select id="type" name="type" class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                            <option value="keliling" {{ old('type', $worker['type'] ?? '') == 'keliling' ? 'selected' : '' }}>Keliling</option>
                            <option value="mangkal" {{ old('type', $worker['type'] ?? '') == 'mangkal' ? 'selected' : '' }}>Mangkal</option>
                        </select>
                    </div>
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-blue-medium mb-1">Status</label>
                        <select id="status" name="status" class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                            <option value="aktif" {{ old('status', $worker['status'] ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $worker['status'] ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="mt-8 flex justify-end gap-4">
        <a href="#" class="bg-slate-200 text-slate-800 font-semibold py-2 px-6 rounded-lg hover:bg-slate-300 transition-colors">
            Batal
        </a>
        <button type="submit" class="bg-navy-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-opacity-90 transition-colors">
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Worker' }}
        </button>
    </div>
</form>

@push('scripts')
<script>
    // Script untuk live preview gambar
    document.getElementById('photo').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('photo-preview').src = URL.createObjectURL(file);
        }
    });
</script>
@endpush