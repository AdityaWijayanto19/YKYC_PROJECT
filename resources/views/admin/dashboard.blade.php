{{-- Memasukkan konten ke dalam slot 'content' di layout --}}
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    {{-- Kontainer utama untuk konten halaman dengan padding --}}
    <div class="p-8">

        <!-- Header Konten -->
        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-navy-dark">Selamat Datang Admin!</h1>
                <p class="text-blue-medium mt-1">Semoga hari Anda produktif dalam mengelola sistem hari ini.</p>
            </div>
            <div class="flex items-center gap-6 mt-4 sm:mt-0">
                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/40?u=jhontosan" class="w-10 h-10 rounded-full" alt="User Avatar">
                    <div>
                        <span class="font-semibold text-navy-dark">Jhontosan</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Grid Layout Utama: Konten Kiri (main) dan Kanan (aside) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- =============================================== --}}
            {{-- KOLOM KONTEN KIRI (2/3) --}}
            {{-- =============================================== --}}
            <div class="lg:col-span-2 space-y-8">

                <!-- Banner Statistik -->
                <section class="bg-navy-primary p-6 rounded-2xl grid grid-cols-1 sm:grid-cols-3 gap-6 text-white shadow-lg">
                    <div>
                        <div class="flex items-start gap-2 mt-1">
                            <p class="text-sm text-blue-pale">Hari ini</p>
                            <span class="text-xs font-light bg-white/20 px-2 py-1 rounded-full">+2.4%</span>
                        </div>
                        <div class="flex items-center">
                            <p class="text-2xl font-bold">Rp125.000</p>
                        </div>
                        <p class="text-xs text-blue-pale mt-1">Bulan sebelumnya Rp67.000</p>
                    </div>

                    <div>
                        <div class="flex items-start gap-2 mt-1">
                            <p class="text-sm text-blue-pale">Bulan ini</p>
                            <span class="text-xs font-light bg-white/20 px-2 py-1 rounded-full">+1.4%</span>
                        </div>
                        <div class="flex items-center">
                            <p class="text-2xl font-bold">Rp1.500.000</p>
                        </div>
                        <p class="text-xs text-blue-pale mt-1">Bulan sebelumnya Rp790.000</p>
                    </div>

                    <div>
                        <div class="flex items-start gap-2 mt-1">
                            <p class="text-sm text-blue-pale">Tahun ini</p>
                            <span class="text-xs font-light bg-white/20 px-2 py-1 rounded-full">+4.3%</span>
                        </div>
                        <div class="flex items-center">
                            <p class="text-2xl font-bold">Rp47.000.000</p>
                        </div>
                        <p class="text-xs text-blue-pale mt-1">Tahun sebelumnya Rp39.000.000</p>
                    </div>
                </section>

                <!-- Total Sales & Cost -->
                <section class="bg-white p-6 rounded-2xl shadow-md">
                    <div class="flex flex-col md:flex-row justify-between items-start">
                        <div>
                            <h2 class="text-xl font-bold text-navy-dark">Total Pendapatan</h2>
                            <p class="text-sm text-blue-light">Last 60 days <span
                                    class="text-sm text-status-success bg-green-100 px-2 py-1 rounded-full align-middle font-semibold">+5.4%</span>
                            </p>
                            <p class="text-4xl font-bold text-navy-primary my-4">Rp150.000.000</p>
                            <p class="text-sm text-blue-medium">+8.20k vs prev. 60 days</p>
                        </div>
                        <!-- Chart Placeholder -->
                        <div class="h-24 w-full md:w-1/2 flex items-end gap-3 justify-center mt-6">
                            <div class="w-full h-1/3 bg-blue-pale rounded-t-lg transition-transform hover:scale-105"></div>
                            <div class="w-full h-2/3 bg-navy-primary rounded-t-lg transition-transform hover:scale-105">
                            </div>
                            <div class="w-full h-1/2 bg-blue-pale rounded-t-lg transition-transform hover:scale-105"></div>
                            <div
                                class="w-full h-full bg-navy-primary rounded-t-lg relative transition-transform hover:scale-105">
                                <span
                                    class="absolute -top-7 left-1/2 -translate-x-1/2 text-xs bg-navy-dark text-white px-2 py-1 rounded-md whitespace-nowrap">60%</span>
                            </div>
                            <div class="w-full h-1/3 bg-blue-pale rounded-t-lg transition-transform hover:scale-105"></div>
                        </div>
                    </div>
                </section>

                <!-- Transaction History -->
                <section>
                    <h2 class="text-xl font-bold text-navy-dark mb-4">Transaction History</h2>
                    <div class="bg-white p-6 rounded-2xl shadow-md">
                        <table class="w-full text-left min-w-[600px]">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-3 px-2 font-semibold text-blue-medium">Customer</th>
                                    <th class="py-3 px-2 font-semibold text-blue-medium">Status</th>
                                    <th class="py-3 px-2 font-semibold text-blue-medium">Date</th>
                                    <th class="py-3 px-2 font-semibold text-blue-medium">Invoice</th>
                                    <th class="py-3 px-2 font-semibold text-blue-medium">People</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b hover:bg-slate-50">
                                    <td class="py-4 px-2 flex items-center gap-3">
                                        <img src="https://i.pravatar.cc/40?u=flyod" class="w-10 h-10 rounded-full"
                                            alt="Flyod">
                                        <div>
                                            <p class="font-semibold text-navy-dark">Flyod Johntosan</p>
                                            <p class="text-sm text-blue-light">johntosan@gmail.com</p>
                                        </div>
                                    </td>
                                    <td class="px-2"><span
                                            class="text-sm text-status-success bg-green-100 px-3 py-1 rounded-full font-semibold">&#9679;
                                            Success</span></td>
                                    <td class="px-2 text-blue-medium">Nov 02, 2021</td>
                                    <td class="px-2 font-semibold text-navy-dark">$100,00</td>
                                    <td class="px-2 flex items-center -space-x-2">
                                        <img src="https://i.pravatar.cc/24?u=person1"
                                            class="w-6 h-6 rounded-full border-2 border-white" alt="person1">
                                        <img src="https://i.pravatar.cc/24?u=person2"
                                            class="w-6 h-6 rounded-full border-2 border-white" alt="person2">
                                        <span
                                            class="w-6 h-6 rounded-full border-2 border-white bg-slate-200 flex items-center justify-center text-xs font-bold text-blue-medium">+6</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50">
                                    <td class="py-4 px-2 flex items-center gap-3">
                                        <img src="https://i.pravatar.cc/40?u=flyod2" class="w-10 h-10 rounded-full"
                                            alt="Flyod 2">
                                        <div>
                                            <p class="font-semibold text-navy-dark">Flyod Johntosan</p>
                                            <p class="text-sm text-blue-light">johntosan@gmail.com</p>
                                        </div>
                                    </td>
                                    <td class="px-2"><span
                                            class="text-sm text-status-pending bg-amber-100 px-3 py-1 rounded-full font-semibold">&#9679;
                                            Pending</span></td>
                                    <td class="px-2 text-blue-medium">Nov 02, 2021</td>
                                    <td class="px-2 font-semibold text-navy-dark">$100,00</td>
                                    <td class="px-2 flex items-center -space-x-2">
                                        <img src="https://i.pravatar.cc/24?u=person3"
                                            class="w-6 h-6 rounded-full border-2 border-white" alt="person3">
                                        <img src="https://i.pravatar.cc/24?u=person4"
                                            class="w-6 h-6 rounded-full border-2 border-white" alt="person4">
                                    </td>
                                </tr>
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
                            <button id="prev-month"
                                class="w-6 h-6 rounded-md hover:bg-slate-100 text-blue-medium">&lt;</button>
                            <button id="next-month"
                                class="w-6 h-6 rounded-md hover:bg-slate-100 text-blue-medium">&gt;</button>
                        </div>
                    </div>
                    <div id="calendar-grid" class="grid grid-cols-7 text-center text-sm text-blue-medium">
                        <span class="py-2">Sen</span><span class="py-2">Sel</span><span class="py-2">Rab</span><span
                            class="py-2">Kam</span><span class="py-2">Jum</span><span class="py-2">Sab</span><span
                            class="py-2">Min</span>
                        <!-- Tanggal akan di-generate oleh JavaScript -->
                    </div>
                </div>

                <!-- Meetings -->
                <div class="bg-white p-6 rounded-2xl shadow-md space-y-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-navy-dark">Schedule</h3>
                        <a href="#"
                            class="flex items-center justify-center w-6 h-6 rounded-md hover:bg-slate-100 text-blue-medium font-bold text-xl leading-none">+</a>
                    </div>

                    <!-- Konten Saat Jadwal Kosong -->
                    <div class="text-center py-10 px-4 border-2 border-dashed rounded-xl">
                        <div class="text-4xl text-slate-300 mb-2">
                            <!-- Anda bisa menggunakan ikon dari Font Awesome atau library ikon lainnya -->
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <p class="font-semibold text-navy-dark">Belum ada jadwal</p>
                        <p class="text-sm text-blue-medium">Klik tombol '+' untuk menambahkan jadwal baru.</p>
                    </div>

                    {{-- <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50">
                        <div class="bg-white p-3 rounded-full text-lg"><i class="fas fa-desktop text-navy-primary"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-navy-dark">Meeting with Client</p>
                            <p class="text-sm text-blue-medium">Google Meet</p>
                        </div>
                        <span class="ml-auto text-sm text-blue-medium">12 PM</span>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50">
                        <div class="bg-white p-3 rounded-full text-lg"><i class="fas fa-file-invoice text-navy-primary"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-navy-dark">Weekly Report</p>
                            <p class="text-sm text-blue-medium">Google Meet</p>
                        </div>
                        <span class="ml-auto text-sm text-blue-medium">03 PM</span>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50">
                        <div class="bg-white p-3 rounded-full text-lg"><i class="fas fa-book-open text-navy-primary"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-navy-dark">Daily Scrum Meeting</p>
                            <p class="text-sm text-blue-medium">Google Meet</p>
                        </div>
                        <span class="ml-auto text-sm text-blue-medium">05 PM</span>
                    </div> --}}
                </div>
            </aside>

        </div>
    </div>

@endsection

{{-- Contoh jika Anda perlu menambahkan script khusus untuk halaman ini --}}
@push('scripts')
    <script>
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
    </script>
@endpush