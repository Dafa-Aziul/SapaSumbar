<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

<div class="container text-center">
    <h3>Selamat datang, {{ Auth::user()->name }} 👋</h3>
    <p>Email: {{ Auth::user()->email }}</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger mt-3">Logout</button>
    </form>
</div>

</body>
</html>
