@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
    <div class="p-8">
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-navy-dark">Manajemen Pesanan</h1>
                <p class="text-blue-medium mt-1">Kontrol dan monitor semua alur pesanan dari awal hingga selesai.</p>
            </div>
        </header>

        <div class="bg-white p-6 rounded-2xl shadow-md">

            <form action="{{ route('admin.pesanan.index') }}" method="GET">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                    <div class="relative w-full sm:w-1/3">
                        <input type="text" name="search" placeholder="Cari ID Pesanan atau Customer..."
                            value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-blue-light"></i>
                    </div>
                    <div class="flex gap-4">
                        <select name="status_id" class="border border-blue-pale rounded-lg py-2 px-3 focus:outline-none">
                            <option value="all">Semua Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" @selected(request('status_id') == $status->id)>
                                    {{ $status->label }}</option>
                            @endforeach
                        </select>
                        <input type="date" name="date" value="{{ request('date') }}"
                            class="border border-blue-pale rounded-lg py-2 px-3 focus:outline-none text-blue-medium">
                        <button type="submit"
                            class="bg-navy-primary text-white font-semibold px-4 rounded-lg hover:bg-opacity-90">Filter</button>
                    </div>
                </div>
            </form>

            <div class="overflow-hidden">
                <table class="w-full text-left min-w-[900px]">
                    <thead>
                        <tr class="border-b bg-slate-50">
                            <th class="py-3 px-4 font-semibold text-blue-medium">ID PESANAN</th>
                            <th class="py-3 px-4 font-semibold text-blue-medium">CUSTOMER</th>
                            <th class="py-3 px-4 font-semibold text-blue-medium">TANGGAL</th>
                            <th class="py-3 px-4 font-semibold text-blue-medium">TOTAL</th>
                            <th class="py-3 px-4 font-semibold text-blue-medium text-center">STATUS</th>
                            <th class="py-3 px-4 font-semibold text-blue-medium text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="border-b hover:bg-slate-50" id="order-row-{{ $order->id }}">
                                <td class="py-4 px-4 font-semibold text-navy-dark">{{ $order->order_id }}</td>
                                <td class="px-4 text-blue-medium">{{ $order->user->name ?? 'N/A' }}</td>
                                <td class="px-4 text-blue-medium">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="px-4 font-semibold text-navy-dark">Rp
                                    {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="px-4 text-center status-badge-cell">
                                    @if ($order->status)
                                        {!! $order->status->getBadgeHtml() !!}
                                    @else
                                        {{-- Tampilan fallback jika status tidak ada --}}
                                        <span class="text-sm text-gray-800 bg-gray-100 px-3 py-1 rounded-full font-semibold">
                                            Tanpa Status
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 text-center">
                                    <button class="open-detail-modal text-blue-medium hover:text-navy-primary p-2 text-sm"
                                        data-id="{{ $order->id }}">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 text-blue-medium">Tidak ada data pesanan yang cocok.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL DETAIL PESANAN (Sekarang dengan ID untuk data dinamis) --}}
    <div id="order-detail-modal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden z-50">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl transform transition-all">
            <div class="flex justify-between items-center p-6 border-b">
                <h3 id="modal-title" class="text-xl font-bold text-navy-dark">Detail Pesanan</h3>
                <button class="close-modal text-2xl text-blue-light hover:text-navy-dark">&times;</button>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 max-h-[70vh] overflow-y-auto">
                <div>
                    <h4 class="font-semibold text-navy-dark mb-2">Informasi Customer</h4>
                    <div class="text-sm space-y-2 text-blue-medium">
                        <p><strong>Nama:</strong> <span id="modal-customer-name">-</span></p>
                        <p><strong>Email:</strong> <span id="modal-customer-email">-</span></p>
                        <p><strong>Telepon:</strong> <span id="modal-customer-phone">-</span></p>
                        <p><strong>Alamat:</strong> <span id="modal-customer-address">-</span></p>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-navy-dark mb-2">Informasi Pesanan</h4>
                    <div class="text-sm space-y-2 text-blue-medium">
                        <p><strong>Layanan:</strong> <span id="modal-service-name">-</span></p>
                        <p><strong>Worker:</strong> <span id="modal-worker-name">-</span></p>
                        <p><strong>Tgl Pesan:</strong> <span id="modal-order-date">-</span></p>
                        <p><strong>Pembayaran:</strong> <span id="modal-payment-status">-</span></p>
                        <p><strong>Total Harga:</strong> <span id="modal-total-price"
                                class="font-bold text-navy-primary">-</span></p>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <form id="update-status-form">
                        <label for="modal-status-select" class="block text-sm font-semibold text-navy-dark mb-1">Ubah Status
                            Pesanan</label>
                        <select id="modal-status-select" name="status_id"
                            class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                            {{-- Opsi status akan diisi oleh JavaScript --}}
                        </select>
                    </form>
                </div>
            </div>

            <div class="flex justify-end gap-4 p-6 bg-slate-50 rounded-b-2xl">
                <button
                    class="close-modal bg-slate-200 text-slate-800 font-semibold py-2 px-4 rounded-lg hover:bg-slate-300">Tutup</button>
                <button id="save-status-btn"
                    class="bg-navy-primary text-white font-semibold py-2 px-4 rounded-lg hover:bg-opacity-90">Simpan
                    Perubahan</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Tambahkan meta tag untuk CSRF token agar AJAX aman --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('order-detail-modal');
            const closeModalButtons = document.querySelectorAll('.close-modal');
            const openModalButtons = document.querySelectorAll('.open-detail-modal');
            const saveStatusBtn = document.getElementById('save-status-btn');
            let currentOrderId = null;
            const allStatuses = @json($statuses);

            const showModal = () => modal.classList.remove('hidden');
            const hideModal = () => modal.classList.add('hidden');

            // Event untuk membuka modal dan mengambil data
            openModalButtons.forEach(button => {
                button.addEventListener('click', function () {
                    currentOrderId = this.dataset.id;
                    fetch(`/admin/pesanan/${currentOrderId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Isi data ke dalam modal
                            document.getElementById('modal-title').textContent = `Detail Pesanan #${data.order_id}`;
                            document.getElementById('modal-customer-name').textContent = data.user?.name || 'N/A';
                            document.getElementById('modal-customer-email').textContent = data.user?.email || 'N/A';
                            document.getElementById('modal-customer-phone').textContent = data.user?.number_phone || 'N/A';
                            document.getElementById('modal-customer-address').textContent = data.user?.customer?.address || 'N/A';
                            document.getElementById('modal-service-name').textContent = data.service?.name || 'N/A';
                            document.getElementById('modal-worker-name').textContent = data.worker?.user?.name || 'Belum Ditugaskan';
                            document.getElementById('modal-order-date').textContent = new Date(data.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                            document.getElementById('modal-payment-status').textContent = data.payment_status?.toUpperCase() || 'N/A';
                            document.getElementById('modal-total-price').textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.total_price);

                            // Isi dropdown status
                            const statusSelect = document.getElementById('modal-status-select');
                            statusSelect.innerHTML = ''; // Kosongkan dulu
                            allStatuses.forEach(status => {
                                const option = document.createElement('option');
                                option.value = status.id;
                                option.textContent = status.label;
                                if (status.id === data.status_id) {
                                    option.selected = true;
                                }
                                statusSelect.appendChild(option);
                            });

                            showModal();
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            // Event untuk menyimpan status baru
            saveStatusBtn.addEventListener('click', function () {
                const statusSelect = document.getElementById('modal-status-select');
                const newStatusId = statusSelect.value;

                fetch(`/admin/pesanan/${currentOrderId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ status_id: newStatusId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update badge status di tabel tanpa refresh halaman
                            const orderRow = document.getElementById(`order-row-${currentOrderId}`);
                            if (orderRow) {
                                const statusCell = orderRow.querySelector('.status-badge-cell');
                                statusCell.innerHTML = data.new_status_html;
                            }
                            alert(data.message);
                            hideModal();
                        } else {
                            alert('Gagal memperbarui status.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            // Events untuk menutup modal
            closeModalButtons.forEach(button => button.addEventListener('click', hideModal));
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    hideModal();
                }
            });
        });
    </script>
@endpush