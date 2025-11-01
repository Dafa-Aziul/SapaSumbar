<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
<h2>Register User</h2>
@if ($errors->any())
    <div style="color:red;">{{ implode(', ', $errors->all()) }}</div>
@endif

<form action="{{ route('register.submit') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="no_wa" placeholder="Nomor WhatsApp" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required><br>
    <button type="submit">Daftar</button>
</form>
</body>
</html>
