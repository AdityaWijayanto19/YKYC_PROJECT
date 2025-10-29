<div id="payment-tutorial-modal" class="fixed inset-0 bg-black bg-opacity-60 z-50 hidden p-4 backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] flex flex-col m-auto">
        
        <div class="p-5 border-b flex justify-between items-center">
            <h3 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-magic-wand-sparkles text-primary mr-2"></i>
                Cara Simulasi Pembayaran (Sandbox Mode)
            </h3>
            <button id="close-tutorial-modal-x" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="p-6 space-y-4 overflow-y-auto">
            <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 p-4 rounded-md" role="alert">
                <p class="font-semibold">Ini adalah Mode Simulasi!</p>
                <p class="text-sm">Anda tidak akan menggunakan uang sungguhan. Ikuti langkah-langkah di bawah ini untuk menyelesaikan pembayaran tes.</p>
            </div>

            <div class="space-y-3">

                <details class="group border rounded-lg p-4 cursor-pointer">
                    <summary class="font-semibold text-lg text-gray-700 list-none flex justify-between items-center">
                        1. Kartu Kredit / Debit (Visa, Mastercard)
                        <i class="fas fa-chevron-down group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <div class="mt-4 text-gray-600 space-y-2 pl-2 border-l-2 border-primary">
                        <p>Gunakan salah satu nomor kartu tes di bawah ini. Tanggal kadaluarsa bisa diisi dengan tanggal di masa depan (misal: 12/29) dan CVC bisa diisi 3 angka acak (misal: 123).</p>
                        <ul class="list-disc list-inside bg-gray-50 p-3 rounded-md">
                            <li>Nomor Kartu Valid: <code class="font-mono text-primary">4811111111111111</code></li>
                            <li>Nomor Kartu Gagal: <code class="font-mono text-primary">4811111111111112</code></li>
                        </ul>
                        <p>Setelah klik "Bayar", Anda akan diarahkan ke halaman 3D Secure (halaman OTP). Cukup klik tombol <strong>"OK"</strong> untuk berhasil atau <strong>"Failed"</strong> untuk menggagalkan transaksi.</p>
                    </div>
                </details>

                <details class="group border rounded-lg p-4 cursor-pointer">
                    <summary class="font-semibold text-lg text-gray-700 list-none flex justify-between items-center">
                        2. GoPay / QRIS
                        <i class="fas fa-chevron-down group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <div class="mt-4 text-gray-600 space-y-2 pl-2 border-l-2 border-primary">
                        <p>Anda akan melihat sebuah kode QR di layar. <strong>JANGAN scan dengan aplikasi GoPay asli Anda.</strong></p>
                        <p>Di halaman pembayaran Midtrans itu, cari dan klik tombol <strong>"Simulate Payment"</strong> atau <strong>"Bayar"</strong> yang berada di bawah atau di samping kode QR untuk menyelesaikan transaksi secara otomatis.</p>
                    </div>
                </details>

                <details class="group border rounded-lg p-4 cursor-pointer">
                    <summary class="font-semibold text-lg text-gray-700 list-none flex justify-between items-center">
                        3. Virtual Account (Transfer Bank)
                        <i class="fas fa-chevron-down group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <div class="mt-4 text-gray-600 space-y-2 pl-2 border-l-2 border-primary">
                        <p>Anda akan diberikan sebuah nomor Virtual Account. <strong>JANGAN transfer dari aplikasi m-banking asli Anda.</strong></p>
                        <p>Di halaman yang sama, cari dan klik tombol <strong>"Simulate Payment"</strong>. Ini akan secara otomatis menandai tagihan VA tersebut sebagai "Lunas".</p>
                    </div>
                </details>

            </div>
            <hr class="my-4">
            <p class="text-center text-gray-700 font-medium">Setelah pembayaran simulasi berhasil, Anda akan otomatis diarahkan kembali ke halaman status pesanan di situs kami.</p>
        </div>

        <div class="flex items-center justify-end p-5 border-t bg-gray-50 rounded-b-lg">
            <button id="close-tutorial-modal-btn" type="button" class="px-6 py-2 text-white bg-primary rounded-lg hover:bg-primary-hover focus:outline-none transition">
                Saya Mengerti
            </button>
        </div>
    </div>
</div>