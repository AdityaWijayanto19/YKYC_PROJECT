@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    {{-- Kontainer utama untuk konten halaman dengan padding --}}
    <div class="p-8">

        <!-- Header Konten -->
        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-navy-dark">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="text-blue-medium mt-1">Semoga hari Anda produktif dalam mengelola sistem hari ini.</p>
            </div>
            <div class="flex items-center gap-3 mt-4 sm:mt-0">
                <img src="{{ Auth::user()->avatar ?? 'https://i.pravatar.cc/40?u=' . Auth::user()->email }}" class="w-10 h-10 rounded-full object-cover" alt="User Avatar">
                <div>
                    <span class="font-semibold text-navy-dark">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </header>

        {{-- Grid Layout Utama --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- KOLOM KONTEN KIRI (2/3) --}}
            <div class="lg:col-span-2 space-y-8">

                <!-- Banner Statistik -->
                <section class="bg-navy-primary p-6 rounded-2xl grid grid-cols-1 sm:grid-cols-3 gap-6 text-white shadow-lg">
                    <div>
                        <p class="text-sm text-blue-pale">Hari ini</p>
                        <p class="text-2xl font-bold mt-1">Rp{{ number_format($incomeToday, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-pale">Bulan ini</p>
                        <p class="text-2xl font-bold mt-1">Rp{{ number_format($incomeThisMonth, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-pale">Tahun ini</p>
                        <p class="text-2xl font-bold mt-1">Rp{{ number_format($incomeThisYear, 0, ',', '.') }}</p>
                    </div>
                </section>

                <!-- Grafik Pendapatan -->
                <section class="bg-white p-6 rounded-2xl shadow-md">
                    <h2 class="text-xl font-bold text-navy-dark mb-4">Grafik Pendapatan (6 Bulan Terakhir)</h2>
                    <div>
                        <canvas id="revenueChart"></canvas>
                    </div>
                </section>

                <!-- Transaction History -->
                <section>
                    <h2 class="text-xl font-bold text-navy-dark mb-4">Transaksi Terakhir Hari Ini</h2>
                    <div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
                        <table class="w-full text-left min-w-[600px]">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-3 px-2 font-semibold text-blue-medium">Customer</th>
                                    <th class="py-3 px-2 font-semibold text-blue-medium">Status Bayar</th>
                                    <th class="py-3 px-2 font-semibold text-blue-medium">Tanggal</th>
                                    <th class="py-3 px-2 font-semibold text-blue-medium">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($todayTransactions as $transaction)
                                    <tr class="border-b hover:bg-slate-50">
                                        <td class="py-4 px-2 flex items-center gap-3">
                                            <img src="{{ $transaction->user->avatar ?? 'https://i.pravatar.cc/40?u=' . $transaction->user->email }}" class="w-10 h-10 rounded-full object-cover" alt="{{ $transaction->user->name }}">
                                            <div>
                                                <p class="font-semibold text-navy-dark">{{ $transaction->user->name }}</p>
                                                <p class="text-sm text-blue-light">{{ $transaction->user->email }}</p>
                                            </div>
                                        </td>
                                        <td class="px-2">
                                            @if($transaction->payment_status == 'paid')
                                                <span class="text-sm text-status-success bg-green-100 px-3 py-1 rounded-full font-semibold">&#9679; Success</span>
                                            @else
                                                <span class="text-sm text-status-pending bg-amber-100 px-3 py-1 rounded-full font-semibold capitalize">&#9679; {{ $transaction->payment_status }}</span>
                                            @endif
                                        </td>
                                        <td class="px-2 text-blue-medium">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                                        <td class="px-2 font-semibold text-navy-dark">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-10 text-blue-medium">Belum ada transaksi hari ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            {{-- =============================================== --}}
            {{-- SIDEBAR KANAN (1/3) --}}
            {{-- =============================================== --}}
            <aside class="lg:col-span-1 space-y-8">
                <!-- Calendar -->
                <div id="calendar-widget" class="bg-white p-6 rounded-2xl shadow-md">
                    <div class="flex justify-between items-center mb-4">
                        <h3 id="month-year" class="text-lg font-bold text-navy-dark">October 2023</h3>
                        <div class="flex gap-2">
                            <button id="prev-month" class="w-6 h-6 rounded-md hover:bg-slate-100 text-blue-medium">&lt;</button>
                            <button id="next-month" class="w-6 h-6 rounded-md hover:bg-slate-100 text-blue-medium">&gt;</button>
                        </div>
                    </div>
                    <div id="calendar-grid" class="grid grid-cols-7 text-center text-sm text-blue-medium">
                        <span class="py-2">Sen</span><span class="py-2">Sel</span><span class="py-2">Rab</span><span
                            class="py-2">Kam</span><span class="py-2">Jum</span><span class="py-2">Sab</span><span
                            class="py-2">Min</span>
                        <!-- Tanggal akan di-generate oleh JavaScript -->
                    </div>
                </div>

                <!-- Meetings / Schedule -->
                <div class="bg-white p-6 rounded-2xl shadow-md space-y-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-navy-dark">Schedule</h3>
                        {{-- TODO: Buat route untuk halaman tambah jadwal --}}
                        <a href="#" class="flex items-center justify-center w-6 h-6 rounded-md hover:bg-slate-100 text-blue-medium font-bold text-xl leading-none">+</a>
                    </div>

                    {{-- Logika untuk menampilkan jadwal atau pesan kosong --}}
                    @if(empty($schedules))
                        <!-- Konten Saat Jadwal Kosong -->
                        <div class="text-center py-10 px-4 border-2 border-dashed rounded-xl">
                            <div class="text-4xl text-slate-300 mb-2">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <p class="font-semibold text-navy-dark">Belum ada jadwal</p>
                            <p class="text-sm text-blue-medium">Klik tombol '+' untuk menambahkan jadwal baru.</p>
                        </div>
                    @else
                        {{-- Lakukan looping jika variabel $schedules ada isinya --}}
                        @foreach($schedules as $schedule)
                            <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50">
                                <div class="bg-white p-3 rounded-full text-lg"><i class="fas fa-file-invoice text-navy-primary"></i></div>
                                <div>
                                    <p class="font-semibold text-navy-dark">{{ $schedule->title }}</p>
                                    <p class="text-sm text-blue-medium">{{ $schedule->description }}</p>
                                </div>
                                <span class="ml-auto text-sm text-blue-medium">{{ $schedule->schedule_date->format('H:i') }}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </aside>

        </div>
    </div>
@endsection

@push('scripts')
    {{-- Library untuk Grafik --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Script untuk Kalender
        document.addEventListener('DOMContentLoaded', function () {
              const monthYearElement = document.getElementById('month-year');
            const prevMonthButton = document.getElementById('prev-month');
            const nextMonthButton = document.getElementById('next-month');
            const calendarGrid = document.getElementById('calendar-grid');

            let currentDate = new Date();

            function renderCalendar() {
                // Mengatur ulang grid kalender
                calendarGrid.innerHTML = `
                                    <span class="py-2">Sen</span><span class="py-2">Sel</span><span class="py-2">Rab</span>
                                    <span class="py-2">Kam</span><span class="py-2">Jum</span><span class="py-2">Sab</span>
                                    <span class="py-2">Min</span>
                                `;

                const today = new Date();
                const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
                const lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

                // Menampilkan bulan dan tahun saat ini
                monthYearElement.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });

                // Menambahkan spasi untuk hari pertama dalam seminggu
                // getDay() mengembalikan 0 untuk Minggu, 1 untuk Senin, dst.
                // Kita sesuaikan agar Senin menjadi hari pertama (0)
                let startingDay = firstDayOfMonth.getDay();
                if (startingDay === 0) { // Jika hari pertama adalah Minggu
                    startingDay = 6; // Ubah menjadi 6 agar sesuai dengan grid (Mon-Sun)
                } else {
                    startingDay -= 1;
                }

                for (let i = 0; i < startingDay; i++) {
                    const emptySpan = document.createElement('span');
                    emptySpan.className = 'py-2 text-slate-400';
                    calendarGrid.appendChild(emptySpan);
                }

                // Mengisi tanggal dalam bulan
                for (let day = 1; day <= lastDayOfMonth.getDate(); day++) {
                    const dateSpan = document.createElement('span');
                    dateSpan.className = 'py-2 cursor-pointer relative';
                    dateSpan.textContent = day;

                    // Menambahkan penanda untuk hari ini
                    if (day === today.getDate() &&
                        currentDate.getMonth() === today.getMonth() &&
                        currentDate.getFullYear() === today.getFullYear()) {

                        const todayMarker = document.createElement('span');
                        todayMarker.className = 'absolute inset-0 w-8 h-8 mx-auto bg-navy-primary text-white rounded-full flex items-center justify-center';
                        todayMarker.textContent = day;
                        dateSpan.textContent = ''; // Hapus teks tanggal asli
                        dateSpan.appendChild(todayMarker);
                    }

                    calendarGrid.appendChild(dateSpan);
                }
            }

            // Event listener untuk tombol bulan sebelumnya
            prevMonthButton.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });

            // Event listener untuk tombol bulan berikutnya
            nextMonthButton.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });

            // Render kalender saat pertama kali halaman dimuat
            renderCalendar();
        });

        // Script untuk Grafik Pendapatan
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Pendapatan',
                    data: @json($chartData),
                    backgroundColor: 'rgba(5, 38, 89, 0.8)', // Warna navy-primary dengan opacity
                    borderColor: 'rgba(5, 38, 89, 1)',
                    borderWidth: 1,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return 'Rp' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endpush