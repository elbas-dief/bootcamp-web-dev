# Tutorial: Login Sederhana dengan Middleware di Laravel 13

Tutorial ini membangun aplikasi web kecil yang menerapkan alur autentikasi manual — tanpa starter kit. Kamu akan membuat halaman publik, form register dan login, serta halaman dashboard yang hanya bisa dibuka setelah login menggunakan middleware buatan sendiri.

## Hasil Akhir

Setelah tutorial ini selesai, aplikasi memiliki endpoint berikut:

| Method | URI          | Keterangan                              |
|--------|--------------|-----------------------------------------|
| GET    | `/`          | Halaman home, bisa diakses siapa saja   |
| GET    | `/register`  | Form pendaftaran akun baru              |
| POST   | `/register`  | Proses simpan akun dan login otomatis   |
| GET    | `/login`     | Form login                              |
| POST   | `/login`     | Proses autentikasi                      |
| POST   | `/logout`    | Hapus sesi dan kembali ke home          |
| GET    | `/dashboard` | Halaman yang dijaga middleware login    |

Alur request yang dipelajari:

```text
Browser → Route → Middleware → Controller → View/Response
```

## Prasyarat

- PHP 8.2+ dan Composer sudah terpasang
- Laravel 13 kompatibel dengan PHP 8.2 ke atas
- MySQL 8.0+ atau MariaDB 10.4+ sudah berjalan
- Pemahaman dasar PHP dan konsep MVC

---

## 1. Buat Proyek Laravel 13

Pastikan Composer dan PHP yang memenuhi persyaratan Laravel 13 sudah tersedia. Buat proyek baru:

```bash
composer create-project laravel/laravel:^13.0 laravel-auth
cd laravel-auth
```

Jalankan server untuk memastikan proyek siap:

```bash
php artisan serve
```

Buka alamat yang ditampilkan Artisan, biasanya `http://127.0.0.1:8000`. Hentikan server dengan `Ctrl+C` sebelum melanjutkan jika terminal yang sama diperlukan.

## 2. Siapkan Database

Kita menggunakan MySQL. Pastikan MySQL sudah berjalan, lalu buat database baru:

```sql
CREATE DATABASE laravel_auth CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Sesuaikan bagian database di `.env` dengan kredensial MySQL kamu:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_auth
DB_USERNAME=root
DB_PASSWORD=
```

Isi `DB_USERNAME` dan `DB_PASSWORD` sesuai akun MySQL lokal kamu. Jangan commit file `.env` ke repository.

Jalankan migration bawaan:

```bash
php artisan migrate
```

Migration Laravel membuat tabel `users`, termasuk kolom `name`, `email`, `password`, dan `email_verified_at`. Kita menggunakan tabel tersebut untuk menyimpan akun.

## 3. Buat Controller

Dua controller dibutuhkan: satu untuk alur autentikasi, satu untuk dashboard.

```bash
php artisan make:controller AuthController
php artisan make:controller DashboardController
```

### `app/Http/Controllers/AuthController.php`

Controller ini menangani semua method yang berhubungan dengan sesi pengguna — form register/login, proses validasi dan simpan akun, serta logout.

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
```

Hal penting:

- `validate()` memeriksa input sebelum data diproses.
- `Hash::make()` menyimpan password sebagai hash, bukan teks biasa.
- `Auth::login()` membuat sesi login setelah registrasi.
- `Auth::attempt()` mencocokkan email dan password dengan akun tersimpan.
- Sesi diregenerasi setelah login untuk keamanan.

### `app/Http/Controllers/DashboardController.php`

```php
<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', ['user' => auth()->user()]);
    }
}
```

## 4. Buat Middleware Pemeriksa Login

Middleware berjalan di antara route dan controller. Tugasnya adalah memeriksa kondisi tertentu sebelum request diteruskan. Di sini kita membuatnya untuk memeriksa apakah pengguna sudah login.

```bash
php artisan make:middleware EnsureUserIsLoggedIn
```

Edit `app/Http/Middleware/EnsureUserIsLoggedIn.php`:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsLoggedIn
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
```

`auth()->check()` bernilai `true` jika ada pengguna yang sedang login. Jika belum login, middleware mengarahkan request ke halaman login. Jika sudah login, `$next($request)` meneruskan request ke middleware berikutnya atau controller.

### Daftarkan alias middleware

Pada Laravel 13, alias middleware aplikasi didaftarkan di `bootstrap/app.php`. Tambahkan import class:

```php
use App\Http\Middleware\EnsureUserIsLoggedIn;
```

Kemudian isi callback `withMiddleware` dengan alias berikut:

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'logged.in' => EnsureUserIsLoggedIn::class,
    ]);
})
```

Letakkan alias di callback `withMiddleware` yang sudah ada, jangan membuat rantai `withMiddleware` kedua. Alias `logged.in` sekarang dapat dipasang pada route.

## 5. Definisikan Endpoint di `routes/web.php`

Route menghubungkan URL dan HTTP method ke controller. Setiap baris menentukan: method → URI → action controller → (opsional) middleware dan nama.

Tambahkan route berikut. Hapus atau sesuaikan route contoh bawaan jika memiliki path yang sama.

```php
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('logged.in')
    ->name('dashboard');
```

Route `GET` menampilkan halaman/form. Route `POST` menerima data form dan menjalankan proses. `/` adalah home publik, sementara `/dashboard` melewati middleware `logged.in` sebelum controller dijalankan.

## 6. Buat View Form dan Halaman

Buat folder `resources/views/auth` jika belum tersedia. Kemudian buat file-file ini.

### `resources/views/home.blade.php`

```blade
<h1>Home</h1>
<p>Halaman ini bisa dibuka siapa saja.</p>
<a href="{{ route('register') }}">Daftar</a>
<a href="{{ route('login') }}">Login</a>
<a href="{{ route('dashboard') }}">Dashboard</a>
```

### `resources/views/auth/register.blade.php`

```blade
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
```

### `resources/views/auth/login.blade.php`

```blade
<h1>Login</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <input name="email" type="email" placeholder="Email" value="{{ old('email') }}" required>
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<a href="{{ route('register') }}">Belum punya akun? Daftar</a>
```

### `resources/views/dashboard.blade.php`

```blade
<h1>Dashboard</h1>
<p>Selamat datang, {{ $user->name }}.</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
```

`@csrf` menambahkan token perlindungan form Laravel. Sertakan pada setiap form `POST` yang dikirim ke aplikasi.

## 7. Coba Alurnya

Jalankan server terlebih dahulu:

```bash
php artisan serve
```

Kemudian ikuti langkah-langkah ini untuk memverifikasi setiap bagian aplikasi berjalan sesuai rencana:

1. Buka `/` — halaman home tampil tanpa perlu login.
2. Buka `/dashboard` **tanpa login** — middleware harus mengarahkanmu ke `/login`. Controller dashboard belum dijalankan sama sekali.
3. Daftar melalui `/register` dengan data valid — akun tersimpan, langsung login, diarahkan ke dashboard.
4. Logout, lalu login kembali melalui `/login`.
5. Coba email atau password yang salah — form login menampilkan pesan error tanpa mengosongkan kolom email.
6. Logout sekali lagi, buka `/dashboard` — middleware memblokir akses dan mengarahkan ke login.

Lihat seluruh endpoint yang terdaftar:

```bash
php artisan route:list
```

## 8. Ringkasan dan Latihan

### Alur yang Perlu Diingat

**Pengguna belum login membuka dashboard:**

```text
GET /dashboard
→ Route memilih DashboardController@index
→ Middleware logged.in memeriksa auth()->check()
→ Belum login: redirect ke /login
→ DashboardController tidak dijalankan
```

**Pengguna login dengan data benar:**

```text
POST /login
→ Route memilih AuthController@login
→ Validasi input dan Auth::attempt()
→ Sesi diregenerasi
→ Redirect ke /dashboard
→ Middleware logged.in meloloskan pengguna
→ DashboardController@index menampilkan halaman
```

### Konsep Kunci

| Komponen       | Peran                                                                 |
|----------------|-----------------------------------------------------------------------|
| **Route**      | Memetakan URL + method HTTP ke action controller                      |
| **Middleware** | Memeriksa kondisi request sebelum controller dijalankan               |
| **Controller** | Memvalidasi input, menjalankan logika, dan mengembalikan response     |
| **View**       | Halaman HTML yang diterima browser                                    |

Ingat: password selalu disimpan dengan `Hash::make()`, bukan sebagai teks biasa. Sesi wajib diregenerasi setelah login untuk mencegah *session fixation*.

### Latihan

1. **Redirect setelah login** — Setelah login berhasil, `redirect()->intended()` digunakan. Coba akses `/dashboard` langsung (tanpa login), lalu login — kemana kamu diarahkan? Ganti dengan `redirect()->route('dashboard')` dan amati perbedaannya.
2. **Middleware tambahan** — Buat middleware `EnsureUserIsGuest` yang mencegah pengguna yang sudah login membuka `/login` atau `/register`. Daftarkan alias `guest.only` dan pasang pada route tersebut.
3. **Flash message** — Setelah register berhasil, kirim pesan selamat datang menggunakan `session()->flash()` dan tampilkan di dashboard.
4. **Remember me** — Tambahkan checkbox "ingat saya" di form login dan gunakan parameter kedua `Auth::attempt($credentials, $remember)`.

### Referensi

- [Laravel 13 — Authentication](https://laravel.com/docs/13.x/authentication)
- [Laravel 13 — Middleware](https://laravel.com/docs/13.x/middleware)
- [Laravel 13 — Routing](https://laravel.com/docs/13.x/routing)
- [Laravel 13 — Validation](https://laravel.com/docs/13.x/validation)
