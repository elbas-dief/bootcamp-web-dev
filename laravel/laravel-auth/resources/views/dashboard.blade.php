<div>
    <h1>Dashboard</h1>
    <p>Selamat datang, {{ $user->name }}.</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

</div>
