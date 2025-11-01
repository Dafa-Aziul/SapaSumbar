<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

<div class="container">
    <div class="col-md-4 mx-auto card p-4">
        <h4>Verifikasi OTP</h4>

        <p>OTP telah dikirim ke email: <strong>{{ $email }}</strong></p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf
            <input class="form-control mb-2" name="otp" placeholder="Masukkan OTP" required>
            <button type="submit" class="btn btn-primary w-100">Verifikasi</button>
        </form>
    </div>
</div>

</body>
</html>
