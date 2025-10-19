@php
    $isEdit = isset($user);
@endphp

<form action="{{ $isEdit ? route('admin.worker.update', $user->id) : route('admin.worker.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold text-navy-dark mb-4">Foto Profil</h3>
                <div class="mb-4">
                    <img id="photo-preview"
                         src="{{ $isEdit && $user->avatar ? asset('storage/' . $user->avatar) : 'https://via.placeholder.com/150' }}"
                         alt="Preview" class="w-32 h-32 rounded-full mx-auto object-cover">
                </div>
                <label for="photo" class="block text-sm font-medium text-blue-medium mb-2">Upload Foto</label>
                <input type="file" id="photo" name="photo" class="w-full text-sm text-slate-500
                    file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold
                    file:bg-blue-pale file:text-navy-primary hover:file:bg-blue-light"/>
                <p class="text-xs text-blue-light mt-2">Format: JPG, PNG. Maks: 2MB.</p>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold text-navy-dark mb-6">Informasi Worker</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-blue-medium mb-1">Nama Lengkap</label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name', $user->name ?? '') }}"
                               class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium" required>
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-blue-medium mb-1">Alamat Email</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email', $user->email ?? '') }}"
                               class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium" required>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-blue-medium mb-1">Jenis Worker</label>
                        <select id="type" name="type" class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                            <option value="Keliling" {{ old('type', $user->worker->worker_type ?? '') == 'Keliling' ? 'selected' : '' }}>Keliling</option>
                            <option value="Mangkal" {{ old('type', $user->worker->worker_type ?? '') == 'Mangkal' ? 'selected' : '' }}>Mangkal</option>
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-blue-medium mb-1">Status</label>
                        <select id="status" name="status" class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                            <option value="aktif" {{ old('status', ($user->worker->is_active ?? false) ? 'aktif' : 'nonaktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', ($user->worker->is_active ?? false) ? 'aktif' : 'nonaktif') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 flex justify-end gap-4">
        <a href="{{ route('admin.worker.index') }}" class="bg-slate-200 text-slate-800 font-semibold py-2 px-6 rounded-lg hover:bg-slate-300 transition-colors">
            Batal
        </a>
        <button type="submit" class="bg-navy-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-opacity-90 transition-colors">
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Worker' }}
        </button>
    </div>
</form>

@push('scripts')
<script>
    document.getElementById('photo')?.addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('photo-preview').src = URL.createObjectURL(file);
        }
    });
</script>
@endpush