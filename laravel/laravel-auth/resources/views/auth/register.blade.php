<div>
    <h1>Register</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf
    <input name="name" placeholder="Nama" value="{{ old('name') }}" required>
    <input name="email" type="email" placeholder="Email" value="{{ old('email') }}" required>
    <input name="password" type="password" placeholder="Password" required>
    <input name="password_confirmation" type="password" placeholder="Ulangi password" required>
    <button type="submit">Daftar</button>
</form>

<a href="{{ route('login') }}">Sudah punya akun? Login</a>
</div>
