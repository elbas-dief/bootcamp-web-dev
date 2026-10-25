# Setup Laravel 13, Breeze, dan Role Management Manual

Tutorial ini membuat proyek Laravel 13 menggunakan Composer, memasang Laravel Breeze, lalu menambahkan role management manual menggunakan kolom `role` pada tabel `users` dan middleware pemeriksa role — tanpa package tambahan.

## Prasyarat

- PHP 8.3 atau lebih baru.
- Composer.
- Node.js dan npm untuk memasang serta menjalankan aset frontend.

## 1. Buat Proyek Laravel 13 dengan Composer

Jalankan perintah berikut di terminal:

```bash
composer create-project laravel/laravel:^13.0 laravel-breeze-app
cd laravel-breeze-app
```

Perintah pertama membuat aplikasi Laravel 13 baru di folder `laravel-breeze-app`. Perintah kedua masuk ke folder proyek. Pada tahap ini kita belum memasang starter kit atau Breeze.

## 2. Pasang Breeze

Tambahkan Breeze sebagai dependency pengembangan:

```bash
composer require laravel/breeze --dev
```

Lalu jalankan installer Breeze dengan stack Blade:

```bash
php artisan breeze:install blade
```

Kita memilih `blade` agar halaman autentikasi dibuat menggunakan Blade, template bawaan Laravel. Installer menambahkan route, controller, request, view autentikasi, dan kebutuhan aset frontend ke proyek.

> Gunakan proyek baru atau pastikan file yang akan dibuat installer belum berisi kode penting. Installer menyalin file seperti `routes/web.php` dan beberapa resource Breeze ke proyek.

## 3. Siapkan Database

Proyek Laravel baru umumnya dikonfigurasi menggunakan SQLite secara default. Periksa konfigurasi database pada `.env`, lalu jalankan migration:

```bash
php artisan migrate
```

Migration membuat tabel yang dibutuhkan, termasuk `users` untuk akun pengguna. Jika kamu memilih database lain, isi koneksi database yang sesuai di `.env` sebelum menjalankan migration.

## 4. Jalankan Aplikasi

Jalankan server Laravel:

```bash
php artisan serve
```

Buka alamat yang ditampilkan di terminal, biasanya `http://127.0.0.1:8000`.

## 5. Coba Fitur Autentikasi

- Buka `/register` untuk membuat akun.
- Buka `/login` untuk masuk.
- Setelah login, buka `/dashboard`.
- Gunakan menu aplikasi untuk logout.

Periksa route yang dipasang Breeze:

```bash
php artisan route:list
```

## 6. Lokasi File Penting

- `routes/auth.php` — route registrasi, login, logout, reset password, dan verifikasi email.
- `routes/web.php` — route halaman web, termasuk dashboard, serta pemuatan `routes/auth.php`.
- `app/Http/Controllers/Auth/` — controller untuk alur autentikasi.
- `app/Http/Requests/Auth/` — validasi request, termasuk login.
- `resources/views/auth/` — halaman autentikasi berbasis Blade.
- `resources/views/profile/` — halaman pengelolaan profil.
- `app/Models/User.php` — model pengguna.

---

## 7. Tambahkan Kolom `role` pada Tabel `users`

Role disimpan langsung di tabel `users` sebagai kolom enum dengan nilai `'user'` atau `'admin'`. Buat migration baru — jangan mengedit migration yang sudah dijalankan:

```bash
php artisan make:migration add_role_to_users_table --table=users
```

Buka migration yang baru dibuat dan isi method `up()` dan `down()`:

```php
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['user', 'admin'])->default('user')->after('email');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
    });
}
```

Jalankan migration:

```bash
php artisan migrate
```

### Perbarui Model `User`

Buka `app/Models/User.php`. Tambahkan `'role'` ke dalam `$fillable`:

```php
protected $fillable = [
    'name',
    'email',
    'password',
    'role',
];
```

Tambahkan juga method helper di dalam class `User` untuk memeriksa apakah pengguna adalah admin:

```php
public function isAdmin(): bool
{
    return $this->role === 'admin';
}
```

Method ini memudahkan pemeriksaan role di controller maupun view tanpa mengulang string `'admin'` di banyak tempat.

## 8. Buat Middleware Pemeriksa Role Admin

Middleware ini berjalan sebelum controller dan menolak akses jika pengguna bukan admin.

```bash
php artisan make:middleware EnsureUserIsAdmin
```

Isi `app/Http/Middleware/EnsureUserIsAdmin.php`:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
```

`$request->user()?->isAdmin()` menggunakan null-safe operator — jika pengguna belum login, ekspresi bernilai `null` (falsy) dan akses ditolak. Middleware ini dipasang setelah `auth`, sehingga saat dijalankan pengguna sudah pasti terautentikasi.

### Daftarkan Alias Middleware

Pada Laravel 13, alias middleware didaftarkan di `bootstrap/app.php`. Tambahkan import:

```php
use App\Http\Middleware\EnsureUserIsAdmin;
```

Kemudian tambahkan alias di dalam callback `withMiddleware` yang sudah ada:

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'admin' => EnsureUserIsAdmin::class,
    ]);
})
```

## 9. Buat Route dan Halaman Admin

Tambahkan route admin yang dilindungi dua middleware: `auth` memastikan pengguna sudah login, `admin` memastikan rolenya adalah admin.

### Buat controller admin

```bash
php artisan make:controller AdminController
```

Isi `app/Http/Controllers/AdminController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('name')->get();

        return view('admin.data-user', compact('users'));
    }
}
```

Buat folder `resources/views/admin`, lalu buat `resources/views/admin/data-user.blade.php`:

```blade
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium mb-4">Daftar Pengguna</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b py-2 pr-4">Nama</th>
                            <th class="border-b py-2 pr-4">Email</th>
                            <th class="border-b py-2">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="py-2 pr-4">{{ $user->name }}</td>
                                <td class="py-2 pr-4">{{ $user->email }}</td>
                                <td class="py-2">{{ $user->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
```

View ini menggunakan layout `x-app-layout` bawaan Breeze agar tampilannya konsisten dengan halaman dashboard pengguna.

### Daftarkan route admin

Di `routes/web.php`, pastikan route `dashboard` untuk user biasa **tidak di-comment**. Breeze setelah login selalu melakukan `redirect()->intended(route('dashboard'))` — jika route bernama `dashboard` tidak ada, semua user akan error saat login.

Berikut isi lengkap `routes/web.php` yang benar setelah role management ditambahkan:

```php
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route dashboard user biasa — wajib ada, Breeze redirect ke sini setelah login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route khusus admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/data-user', [AdminController::class, 'index'])->name('data-user');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
```

`prefix('admin')` membuat URI menjadi `/admin/data-user`. Kedua middleware dijalankan berurutan — `auth` lebih dulu, baru `admin` — sehingga pengguna yang belum login tidak sampai ke pemeriksaan role.

> **Catatan:** Route `dashboard` (user biasa) dan `admin.data-user` (admin) adalah dua route terpisah dengan nama berbeda. Jangan hapus atau comment route `dashboard` milik user biasa.

### Tambahkan link "Data User" di Navbar

Link "Data User" harus ditambahkan di **dua tempat** dalam file `resources/views/layouts/navigation.blade.php`:

- **Desktop navigation** — div dengan class `sm:flex`, menampilkan link horizontal di navbar atas (layar ≥640px)
- **Mobile navigation** — div dengan class `pt-2 pb-3 space-y-1`, menampilkan link vertikal saat hamburger diklik (layar <640px)

Jika hanya ditambahkan di salah satu, pengguna di perangkat lain tidak akan melihat link tersebut.

Berikut isi lengkap `resources/views/layouts/navigation.blade.php` setelah link ditambahkan:

```blade
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if(Auth::user()->isAdmin())
                    <x-nav-link :href="route('admin.data-user')" :active="request()->routeIs('admin.data-user')">
                        {{ __('Data User') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Mobile Navigation Links -->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @if(Auth::user()->isAdmin())
            <x-responsive-nav-link :href="route('admin.data-user')" :active="request()->routeIs('admin.data-user')">
                {{ __('Data User') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
```

`@if(Auth::user()->isAdmin())` menyembunyikan link dari tampilan HTML pengguna non-admin. Route tetap terlindungi middleware `admin` di sisi server — menyembunyikan link di navbar bukan pengganti proteksi server.

## 10. Set Role Admin via Tinker

Saat registrasi, semua akun mendapat role `'user'` secara default. Untuk mempromosikan akun menjadi admin, gunakan Tinker:

```bash
php artisan tinker
```

Kemudian jalankan:

```php
$user = \App\Models\User::where('email', 'ayu@example.com')->firstOrFail();
$user->role = 'admin';
$user->save();
```

Keluar dari Tinker dengan `exit`.

## 11. Coba Alur Role

1. Jalankan `php artisan serve`.
2. Register dua akun berbeda.
3. Promosikan salah satu ke `'admin'` via Tinker (langkah 10).
4. Login sebagai akun **non-admin**, buka `http://127.0.0.1:8000/admin/data-user` — harus mendapat error **403 Akses ditolak**.
5. Login sebagai akun **admin**, buka `/admin/data-user` — halaman daftar pengguna tampil, link "Data User" muncul di navbar.
6. Logout akun admin, buka `/admin/data-user` — Breeze mengarahkan ke `/login` (middleware `auth` bekerja lebih dulu).

Periksa seluruh route yang terdaftar:

```bash
php artisan route:list
```

---

## Alur Setup Singkat

```text
Composer membuat Laravel 13
    → Composer memasang laravel/breeze
    → breeze:install blade membuat scaffolding autentikasi
    → migration membuat tabel database
    → migration tambahan menambahkan kolom role ke users
    → middleware EnsureUserIsAdmin dibuat dan didaftarkan alias 'admin'
    → route admin dilindungi middleware auth + admin
    → role diset via Tinker
```

## Ringkasan Perintah

```bash
composer create-project laravel/laravel:^13.0 laravel-breeze-app
cd laravel-breeze-app
composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan migrate
php artisan make:migration add_role_to_users_table --table=users
php artisan migrate
php artisan make:middleware EnsureUserIsAdmin
php artisan make:controller AdminController
php artisan serve
```

## Referensi

- [Laravel Breeze di GitHub](https://github.com/laravel/breeze)
- [Laravel 13 — Middleware](https://laravel.com/docs/13.x/middleware)
- [Laravel 13 — Authorization (Gates & Policies)](https://laravel.com/docs/13.x/authorization)
- [Laravel 13 project skeleton](https://github.com/laravel/laravel/blob/13.x/composer.json)
