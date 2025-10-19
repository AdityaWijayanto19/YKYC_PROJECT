@extends('layouts.worker')

@section('title', 'History Pesanan')

@section('content')
    <div class="container mx-auto max-w-7xl px-4 py-8">

        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Riwayat Pesanan Saya</h1>
            <p class="text-gray-600 mt-1">Lihat semua pesanan yang telah Anda selesaikan.</p>
        </header>

        <section class="mb-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Pesanan Minggu Ini</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">
                    {{ $history->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])->count() }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Pesanan Bulan Ini</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">
                    {{ $history->whereBetween('updated_at', [now()->startOfMonth(), now()->endOfMonth()])->count() }}</p>
            </div>
        </section>

        <section class="mb-6 bg-white p-4 rounded-xl shadow-sm border border-gray-200">
            <form id="filterForm" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                    <input type="date" name="start_date" id="start_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                    <input type="date" name="end_date" id="end_date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="service_id" class="block text-sm font-medium text-gray-700">Jenis Layanan</label>
                    <select id="service_id" name="service_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Semua Layanan</option>
                        @foreach ($services as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-start-3 lg:col-start-4">
                    <button type="submit" id="filterBtn"
                        class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </section>

        <div id="historyContainer" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            @include('components.history-table-worker', ['history' => $history])
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('filterForm').addEventListener('submit', function (event) {
            event.preventDefault(); 

            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const serviceId = document.getElementById('service_id').value;
            const container = document.getElementById('historyContainer');
            
            container.innerHTML = '<div class="text-center py-10 text-gray-500">Memuat data...</div>';

            const url = `{{ route('worker.history-pesanan') }}?start_date=${startDate}&end_date=${endDate}&service_id=${serviceId}`;

            fetch(url, {
                headers: { 
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                container.innerHTML = buildTableHtml(data.history);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                container.innerHTML = '<div class="text-center py-10 text-red-500">Gagal memuat data.</div>';
            });
        });

        function buildTableHtml(historyData) {
            if (!historyData || historyData.length === 0) {
                return `<div class="text-center py-10 text-gray-500">Tidak ada riwayat pesanan yang cocok.</div>`;
            }

            let tableRows = historyData.map(order => {
                const statusClass = order.status.name === 'completed'
                    ? 'bg-green-100 text-green-800'
                    : 'bg-red-100 text-red-800';
                
                const formattedDate = new Date(order.updated_at).toLocaleDateString('id-ID', {
                    day: '2-digit', month: 'short', year: 'numeric'
                });

                return `
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#${order.order_id || order.id}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${order.user.name || 'N/A'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${order.service.name || 'N/A'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formattedDate}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusClass}">
                                <!-- PERBAIKAN DI SINI: Akses properti 'label' dari objek 'status' -->
                                ${order.status.label || order.status.name}
                            </span>
                        </td>
                    </tr>
                `;
            }).join('');

            return `
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Pesanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Layanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl. Selesai</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            ${tableRows}
                        </tbody>
                    </table>
                </div>
            `;
        }
    </script>
@endpush