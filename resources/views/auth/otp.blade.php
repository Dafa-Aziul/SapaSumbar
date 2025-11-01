<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP</title>
</head>
<body>
    <h2>Masukkan Kode OTP</h2>

    @if ($errors->any())
        <div style="color:red;">
            {{ $errors->first('otp') }}
        </div>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf
        <input type="text" name="otp" placeholder="Masukkan kode OTP">
        <button type="submit">Verifikasi</button>
    </form>
</body>
</html>
