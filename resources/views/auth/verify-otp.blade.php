<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Sapa Sumbar</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|roboto:400,500,700" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Roboto', sans-serif;
            /* Menggunakan background gradien yang sama dengan halaman login */
            background: linear-gradient(135deg, #03071E 0%, #370617 25%, #6A040F 50%, #9D0208 75%, #D00000 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Menggunakan kelas .login-container yang sama untuk konsistensi */
        .login-container {
            background: #FFFFFF;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 450px;
            padding: 32px 40px 40px 40px;
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #D00000 0%, #DC2F02 25%, #E85D04 50%, #F48C06 75%, #FAA307 100%);
        }

        /* Menambahkan logo untuk konsistensi branding */
        .logo-section {
            text-align: center;
            margin-bottom: 24px; /* Disesuaikan sedikit untuk halaman OTP */
        }

        .logo-img {
            height: 160px; /* Sedikit lebih kecil agar fokus ke form */
            width: auto;
            margin-bottom: 12px;
            transform: scale(1.05);
            transform-origin: center;
        }

        /* Judul form */
        .form-title {
            font-size: 24px;
            font-weight: 600;
            color: #212121;
            margin-bottom: 8px;
            text-align: center;
        }

        /* Subjudul form / Info email */
        .form-subtitle {
            font-size: 14px;
            color: #616161; /* Sedikit lebih gelap dari abu-abu biasa */
            text-align: center;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .form-subtitle strong {
            color: #212121;
            font-weight: 600;
        }

        /* Gaya untuk alert (info dan error) */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            line-height: 1.5;
        }

        .alert-info {
            background-color: #E3F2FD;
            color: #1976D2;
            border: 1px solid #BBDEFB;
        }

        .alert-danger {
            background-color: #FFEBEE;
            color: #C62828;
            border: 1px solid #FFCDD2;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #212121;
            margin-bottom: 8px;
        }

        /* Menggunakan .form-input untuk input OTP */
        .form-input {
            width: 100%;
            padding: 14px 16px;
            font-size: 15px;
            border: 2px solid #E0E0E0;
            border-radius: 12px;
            background-color: #FAFAFA;
            color: #212121;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
            text-align: center; /* Opsional: bagus untuk input OTP */
            letter-spacing: 2px; /* Opsional: memberi jarak antar angka */
        }

        .form-input:focus {
            outline: none;
            border-color: #D00000;
            background-color: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(208, 0, 0, 0.1);
        }

        .form-input::placeholder {
            color: #9E9E9E;
            letter-spacing: normal;
        }

        /* Menggunakan .btn-login untuk tombol verifikasi */
        .btn-login {
            width: 100%;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            color: #FFFFFF;
            background: linear-gradient(135deg, #D00000 0%, #DC2F02 50%, #E85D04 100%);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(208, 0, 0, 0.3);
            margin-top: 8px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(208, 0, 0, 0.4);
            background: linear-gradient(135deg, #9D0208 0%, #D00000 50%, #DC2F02 100%);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 32px 24px;
                border-radius: 16px;
            }

            .logo-img {
                height: 140px;
                transform: scale(1.05);
            }

            .form-title {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <!-- Menggunakan struktur dan kelas yang sama dengan login -->
    <div class="login-container">

        <!-- Logo Section (diambil dari login.html) -->
        <div class="logo-section">
            <img
                src="{{ asset('image/SapaSumbar.png') }}"
                alt="Sapa Sumbar Logo"
                class="logo-img"
            >
        </div>

        <!-- Judul dan Subjudul Baru -->
        <h4 class="form-title">Verifikasi OTP</h4>
        <p class="form-subtitle">
            Kode OTP telah dikirim ke email: <br><strong>{{ $email }}</strong>
        </p>

        <!-- Alert (Struktur sama, akan otomatis ter-style) -->
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Verifikasi -->
        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="otp">Kode OTP</label>
                <input
                    class="form-input"
                    type="text"
                    id="otp"
                    name="otp"
                    placeholder="Masukkan 6 digit OTP"
                    required
                >
            </div>

            <button type="submit" class="btn-login">Verifikasi</button>
        </form>
    </div>
</body>
</html>
