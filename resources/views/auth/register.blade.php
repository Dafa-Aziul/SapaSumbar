<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

<div class="container">
    <div class="col-md-4 mx-auto card p-4">
        <h4>Register</h4>

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

        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <input class="form-control mb-2" name="name" placeholder="Nama" value="{{ old('name') }}" required>
            <input class="form-control mb-2" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input class="form-control mb-2" name="no_wa" placeholder="Nomor WhatsApp" value="{{ old('no_wa') }}" required>
            <input class="form-control mb-2" type="password" name="password" placeholder="Password" required>
            <input class="form-control mb-2" type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </form>
    </div>
</div>

</body>
</html>
