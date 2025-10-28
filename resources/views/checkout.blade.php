<!DOCTYPE html>
<html>

<head>
    <title>Checkout Midtrans</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>

<body>
    <h2>Test Checkout Midtrans</h2>
    <button id="pay-button">Bayar Sekarang</button>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.clientKey') }}"></script>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            window.snap.pay("{{ $snapToken }}", {
                onSuccess: function (result) { console.log(result); },
                onPending: function (result) { console.log(result); },
                onError: function (result) { console.log(result); },
                onClose: function () { alert('Transaksi ditutup tanpa pembayaran'); }
            })
        };
    </script>
</body>

</html>