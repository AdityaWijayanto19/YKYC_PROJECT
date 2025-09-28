<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pesanan #{{ $order->id }}</title>

    <!-- PENTING: Script dari Midtrans untuk menampilkan Pop-up (mode Sandbox) -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            text-align: center;
            margin-top: 5rem;
            background-color: #f7fafc;
        }

        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }

        #pay-button {
            background-color: #3490dc;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        #pay-button:hover {
            background-color: #2779bd;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Selesaikan Pembayaran Anda</h2>
        <p>Pesanan: <strong>#{{ $order->id }}</strong></p>
        <p>Layanan: <strong>{{ $order->service->name }}</strong></p>
        <hr style="margin: 1.5rem 0;">
        <h3>Total Tagihan: <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></h3>

        <button id="pay-button">Bayar Sekarang</button>
    </div>

    <script type="text/javascript">
        // Ambil tombol pembayaran dari HTML
        var payButton = document.getElementById('pay-button');

        // Tambahkan event listener untuk 'click' pada tombol tersebut
        payButton.addEventListener('click', function () {
            // Panggil fungsi snap.pay() dari Midtrans dengan Snap Token dari order
            window.snap.pay('{{ $order->snap_token }}', {
                onSuccess: function (result) {
                    /* Notifikasi pembayaran berhasil! */
                    alert("Pembayaran berhasil!");
                    // Arahkan ke halaman dashboard atau daftar pesanan
                    window.location.href = '/dashboard';
                },
                onPending: function (result) {
                    /* Pembayaran belum selesai */
                    alert("Menunggu pembayaran Anda.");
                },
                onError: function (result) {
                    /* Terjadi kesalahan */
                    alert("Pembayaran gagal!");
                },
                onClose: function () {
                    /* Pengguna menutup pop-up tanpa membayar */
                    alert('Anda menutup pop-up tanpa menyelesaikan pembayaran.');
                }
            });
        });
    </script>

</body>

</html>