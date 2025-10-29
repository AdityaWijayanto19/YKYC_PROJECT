<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi Akun</title>
    <style>
        /* Gaya dasar, sebagian besar styling ada di inline */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }
        .header {
            background-color: #004D40;
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .content {
            padding: 40px 30px;
            line-height: 1.6;
            color: #333333;
        }
        .code-box {
            background-color: #E0F2F1; 
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
            text-align: center;
        }
        .code {
            font-size: 36px;
            font-weight: 700;
            letter-spacing: 10px;
            color: #004D40; 
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ya Kotor Ya Cuci</h1>
            <p style="margin: 0; font-size: 16px;">Verifikasi Akun Anda</p>
        </div>
        <div class="content">
            <h2 style="color: #004D40;">Satu Langkah Lagi!</h2>
            <p>Halo,</p>
            <p>Terima kasih telah bergabung dengan kami. Gunakan kode di bawah ini untuk mengaktifkan akun Anda dan memulai petualangan bersih untuk sepatu kesayangan Anda.</p>
            
            <div class="code-box">
                <p style="margin: 0 0 10px 0; font-size: 14px;">Kode Aktivasi Anda:</p>
                <div class="code">{{ $code }}</div>
            </div>

            <p>Kode ini hanya berlaku selama <strong>10 menit</strong>. Mohon untuk tidak membagikan kode ini kepada siapa pun.</p>
            <p>Jika Anda tidak merasa mendaftar di Ya Kotor Ya Cuci, Anda bisa mengabaikan email ini.</p>
            <br>
            <p>Salam hangat,<br>Tim Ya Kotor Ya Cuci</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Ya Kotor Ya Cuci. Semua Hak Cipta Dilindungi.</p>
        </div>
    </div>
</body>
</html>