<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pesanan #{{ $order->id }} - Ya Kotor Ya Cuci</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#004D40', // Deep Teal
                        'primary-hover': '#00382E', // Darker Deep Teal
                        'secondary': '#E0F2F1', // Light Teal background
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-lg mx-auto bg-white rounded-xl shadow-lg p-8 space-y-6">

        <div class="text-center">
            <i class="fas fa-file-invoice-dollar text-5xl text-primary"></i>
            <h2 class="text-3xl font-bold text-gray-800 mt-4">Selesaikan Pembayaran</h2>
            <p class="text-gray-500 mt-1">Satu langkah terakhir untuk membuat sepatumu bersih kembali!</p>
        </div>

        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 space-y-3">
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-600">Nomor Pesanan:</span>
                <span class="font-semibold text-gray-800">#{{ $order->id }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-600">Layanan Dipilih:</span>
                <span class="font-semibold text-gray-800">{{ $order->service->name }}</span>
            </div>
            <hr>
            <div class="flex justify-between items-center text-lg">
                <span class="font-semibold text-gray-700">Total Tagihan:</span>
                <span class="font-bold text-primary text-xl">Rp
                    {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        @if (env('MIDTRANS_IS_PRODUCTION') == false)
            <div class="my-4 p-4 bg-secondary rounded-lg flex items-center justify-between">
                <div>
                    <h4 class="font-bold text-primary">Bingung Cara Bayar?</h4>
                    <p class="text-sm text-gray-700">Ini adalah mode tes. Lihat panduan untuk menyelesaikan pembayaran.</p>
                </div>
                <button id="open-tutorial-modal-btn"
                    class="px-4 py-2 bg-primary text-white font-semibold rounded-lg hover:bg-primary-hover transition-transform transform hover:scale-105">
                    Lihat Panduan
                </button>
            </div>
        @endif

        <div class="pt-4">
            <button id="pay-button"
                class="w-full flex items-center justify-center gap-3 py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-credit-card"></i>
                Pilih Metode Pembayaran
            </button>
            <a href="{{ route('customer.dashboard') }}"
                class="block text-center mt-4 text-sm text-gray-600 hover:text-primary hover:underline">Kembali ke
                Dashboard</a>
        </div>

    </div>

    @if (env('MIDTRANS_IS_PRODUCTION') == false)
        <x-payment-tutorial-modal />
    @endif

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');

        payButton.addEventListener('click', function () {
            payButton.disabled = true;
            payButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memuat Pembayaran...';

            window.snap.pay('{{ $order->snap_token }}', {
                onSuccess: function (result) {
                    window.location.href = "{{ route('customer.order.status') }}?order_id={{ $order->id }}&status=success";
                },
                onPending: function (result) {
                    window.location.href = "{{ route('customer.order.status') }}?order_id={{ $order->id }}&status=pending";
                },
                onError: function (result) {
                    window.location.href = "{{ route('customer.order.status') }}?order_id={{ $order->id }}&status=error";
                },
                onClose: function () {
                    payButton.disabled = false;
                    payButton.innerHTML = '<i class="fas fa-credit-card"></i> Pilih Metode Pembayaran';

                    console.log('Anda menutup pop-up tanpa menyelesaikan pembayaran.');
                }
            });
        });

        @if (env('MIDTRANS_IS_PRODUCTION') == false)
            document.addEventListener('DOMContentLoaded', function () {
                const tutorialModal = document.getElementById('payment-tutorial-modal');
                const openBtn = document.getElementById('open-tutorial-modal-btn');
                const closeBtnX = document.getElementById('close-tutorial-modal-x');
                const closeBtn = document.getElementById('close-tutorial-modal-btn');

                if (tutorialModal && openBtn && closeBtnX && closeBtn) {
                    const openModal = () => tutorialModal.classList.remove('hidden');
                    const closeModal = () => tutorialModal.classList.add('hidden');

                    openBtn.addEventListener('click', openModal);
                    closeBtnX.addEventListener('click', closeModal);
                    closeBtn.addEventListener('click', closeModal);

                    tutorialModal.addEventListener('click', (e) => {
                        if (e.target === tutorialModal) {
                            closeModal();
                        }
                    });
                }
            });
        @endif
    </script>
</body>

</html>