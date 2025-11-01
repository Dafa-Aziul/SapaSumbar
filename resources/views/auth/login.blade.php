<!DOCTYPE html>
<html lang="id">
<head>
    <meta charapaet="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sapa Sumbar</title>
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
            background: linear-gradient(135deg, #03071E 0%, #370617 25%, #6A040F 50%, #9D0208 75%, #D00000 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

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

        .logo-section {
            text-align: center;
            margin-bottom: 8px; /* Ubah nilainya menjadi lebih kecil, misal 16px */
        }

        .logo-img {
            height: 180px;
            width: auto;
            margin-bottom: 12px;
            transform: scale(1.1);
            transform-origin: center;
        }

        .brand-text {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #9D0208 0%, #D00000 50%, #E85D04 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .brand-subtitle {
            font-size: 13px;
            color: #757575;
            font-weight: 400;
        }

        .form-title {
            font-size: 24px;
            font-weight: 600;
            color: #212121;
            margin-bottom: 8px;
            text-align: center;
        }

        .form-subtitle {
            font-size: 14px;
            color: #9E9E9E;
            text-align: center;
            margin-bottom: 32px;
        }

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
        }

        .form-input:focus {
            outline: none;
            border-color: #D00000;
            background-color: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(208, 0, 0, 0.1);
        }

        .form-input::placeholder {
            color: #9E9E9E;
        }

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

        .register-link {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #757575;
        }

        .register-link a {
            color: #D00000;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .register-link a:hover {
            color: #9D0208;
            text-decoration: underline;
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

            .brand-text {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="logo-section">
            <img
                src="{{ asset('image/SapaSumbar.png') }}"
                alt="Sapa Sumbar Logo"
                class="logo-img"
            >
        </div>

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

        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input
                    class="form-input"
                    type="email"
                    id="email"
                    name="email"
                    placeholder="nama@email.com"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input
                    class="form-input"
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password Anda"
                    required
                    autocomplete="current-password"
                >
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="{{ route('register.show') }}">Daftar sekarang</a>
        </div>
    </div>
</body>
</html>
