# Tutorial CRUD Buku dengan Laravel 13 + Blade

Tutorial ini membahas cara membuat fitur **CRUD (Create, Read, Update, Delete)** untuk data buku menggunakan Laravel dan Blade (server-side rendering, bukan REST API). Fokusnya adalah **semua route `book`** yang ada di `routes/web.php`, beserta alur request dari route → controller → model → view.

## 1. Hasil Akhir

Setelah mengikuti tutorial ini, kamu punya halaman web untuk mengelola buku dengan route berikut:

| Method   | URI                | Controller Action        | Nama Route     | Fungsi                                  |
| -------- | ------------------ | ------------------------ | -------------- | --------------------------------------- |
| `GET`    | `/book`            | `BookController@index`   | `book.index`   | Menampilkan daftar semua buku           |
| `GET`    | `/create-book`     | `BookController@create`  | `book.create`  | Menampilkan form tambah buku            |
| `POST`   | `/create-book`     | `BookController@store`   | `book.store`   | Memvalidasi & menyimpan buku baru       |
| `GET`    | `/edit-book/{id}`  | `BookController@edit`    | `book.edit`    | Menampilkan form edit buku              |
| `PUT`    | `/edit-book/{id}`  | `BookController@update`  | `book.update`  | Memvalidasi & memperbarui buku          |
| `DELETE` | `/delete-book/{id}`| `BookController@destroy` | `book.delete`  | Menghapus buku                          |

> Catatan: method `show` (detail buku) sudah ada di controller dan view `show-book.blade.php`, tetapi **belum punya route** di repo ini. Lihat bagian [Latihan](#10-latihan-dan-langkah-selanjutnya).

## 2. Prasyarat dan Setup Proyek

- PHP `^8.3` dan Composer
- Laravel `^13.17` (sesuai `composer.json`)
- Database: MySQL 8+ (atau MariaDB), dengan ekstensi PHP `pdo_mysql`

```bash
php -v
composer -V

composer install
cp .env.example .env
php artisan key:generate
```

Jika membuat proyek dari nol:

```bash
composer create-project laravel/laravel php-live-blade
cd php-live-blade
```

## 3. Konfigurasi Database

Buat database kosong terlebih dahulu, misalnya lewat terminal MySQL:

```sql
CREATE DATABASE php_live_blade CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Lalu ubah bagian database pada `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=php_live_blade
DB_USERNAME=root
DB_PASSWORD=
```

- Isi `DB_USERNAME` dan `DB_PASSWORD` sesuai MySQL di komputermu. Jangan commit `.env` atau kredensial asli.
- Setelah mengubah `.env`, bersihkan cache konfigurasi jika perlu: `php artisan config:clear`.
- Cek koneksi dengan `php artisan migrate:status`. Jika muncul error `Access denied` atau `Unknown database`, periksa kembali nilai di atas.
- Pada MySQL, kolom `$table->year('year')` bertipe `YEAR` (rentang 1901–2155), sehingga validasi `min:1900` pada form sebaiknya dibaca sebagai batas bawah praktis, bukan 1900 persis. Gunakan tahun 1901 ke atas saat mencoba.

## 4. Data Layer: Migration, Model, Seeder

### 4.1 Migration

```bash
php artisan make:migration create_table_book
```

File: `database/migrations/2026_10_10_031130_create_table_book.php`

```php
public function up(): void
{
    Schema::create('book', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('author');
        $table->year('year');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('book');
}
```

Perhatikan nama tabel adalah `book` (tunggal), bukan `books` seperti konvensi Laravel. Itu sebabnya model harus menyebutkannya secara eksplisit.

### 4.2 Model

```bash
php artisan make:model Book
```

File: `app/Models/Book.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';                          // nama tabel non-standar
    protected $fillable = ['title', 'author', 'year'];  // kolom yang boleh mass-assignment
}
```

- `$table` wajib karena tabelnya `book`, bukan `books`.
- `$fillable` wajib agar `Book::create($validated)` dan `$book->update($validated)` bisa mengisi kolom (perlindungan *mass assignment*).

### 4.3 Seeder (data contoh)

```bash
php artisan make:seeder BookSeeder
```

File: `database/seeders/BookSeeder.php`

```php
use Illuminate\Support\Facades\DB;

public function run(): void
{
    $book = [
        ['title' => 'The Great Gatsby',      'author' => 'F. Scott Fitzgerald', 'year' => 1925],
        ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee',          'year' => 1960],
        ['title' => '1984',                  'author' => 'George Orwell',       'year' => 1949],
    ];

    DB::table('book')->insert($book);
}
```

`DatabaseSeeder` di repo ini belum memanggil `BookSeeder`, jadi jalankan dengan `--class`:

```bash
php artisan migrate
php artisan db:seed --class=BookSeeder
```

> Seeder ini memakai `insert` biasa, sehingga menjalankannya dua kali akan menggandakan data. Gunakan `php artisan migrate:fresh --seed --seeder=BookSeeder` untuk mengulang dari awal.

## 5. Route

File: `routes/web.php`

```php
use App\Http\Controllers\BookController;

Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::get('/create-book', [BookController::class, 'create'])->name('book.create');
Route::post('/create-book', [BookController::class, 'store'])->name('book.store');
Route::get('/edit-book/{id}', [BookController::class, 'edit'])->name('book.edit');
Route::put('/edit-book/{id}', [BookController::class, 'update'])->name('book.update');
Route::delete('/delete-book/{id}', [BookController::class, 'destroy'])->name('book.delete');
```

Poin penting:

- **Satu URI, beda method.** `/create-book` dipakai oleh `GET` (form) dan `POST` (simpan). Begitu juga `/edit-book/{id}` untuk `GET` dan `PUT`.
- **`{id}`** adalah *route parameter*; nilainya diteruskan ke argumen `$id` di controller.
- **`->name()`** memberi nama route sehingga di Blade cukup memakai `route('book.store')` tanpa menulis URL manual.
- Browser HTML hanya mengenal `GET` dan `POST`. Untuk `PUT` dan `DELETE`, form memakai `method="POST"` plus `@method('PUT')` / `@method('DELETE')` (*method spoofing*).
- Semua route `web` otomatis dilindungi CSRF, sehingga setiap form wajib memakai `@csrf`.

Cek daftar route:

```bash
php artisan route:list --path=book
```

## 6. Controller

```bash
php artisan make:controller BookController
```

File: `app/Http/Controllers/BookController.php`. Kita bahas per route.

### 6.1 `GET /book` → `index()`

```php
public function index()
{
    $book = Book::all();
    return view('book.book', compact('book'));
}
```

Alur: request masuk → `BookController@index` → `Book::all()` mengambil semua baris tabel `book` → data dikirim ke view `resources/views/book/book.blade.php` sebagai variabel `$book`.

### 6.2 `GET /create-book` → `create()`

```php
public function create()
{
    return view('book.create-book');
}
```

Hanya menampilkan form kosong.

### 6.3 `POST /create-book` → `store()`

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'title'  => 'required|min:3',
        'author' => 'required|min:3',
        'year'   => 'required',
    ]);

    Book::create($validated);

    return redirect()->route('book.create')->with('success', 'Success create book');
}
```

- `validate()` memeriksa input. Jika gagal, Laravel otomatis **redirect kembali** ke form dengan status `302`, mengisi `$errors` dan input lama (`old()`).
- Hanya field yang lolos validasi (`$validated`) yang disimpan, sehingga field tambahan dari klien diabaikan.
- Setelah sukses, user diarahkan kembali ke form create dengan flash message `success`, supaya bisa menambah buku berikutnya. Jika ingin langsung ke daftar, ganti dengan `redirect()->route('book.index')`.
- Validasi `year` di sini baru `required`. Di `update()` aturannya lebih ketat (`integer|min:1900|max:2100`). Sebaiknya samakan, lihat latihan.

### 6.4 `GET /edit-book/{id}` → `edit()`

```php
public function edit(string $id)
{
    $book = Book::findOrFail($id);

    return view('book.edit-book', [
        'book' => $book,
    ]);
}
```

`findOrFail` mengembalikan halaman **404** jika `id` tidak ditemukan, sehingga view tidak pernah menerima `null`.

### 6.5 `PUT /edit-book/{id}` → `update()`

```php
public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'title'  => 'required|min:3',
        'author' => 'required|min:3',
        'year'   => 'required|integer|min:1900|max:2100',
    ]);

    $book = Book::findOrFail($id);
    $book->update($validated);

    return redirect()->route('book.index')->with('success', 'Success updated data book');
}
```

Urutannya: validasi → cari data → update → redirect ke daftar.

### 6.6 `DELETE /delete-book/{id}` → `destroy()`

```php
public function destroy(string $id)
{
    $book = Book::findOrFail($id);
    $book->delete();

    return redirect()->route('book.index')->with('success', 'Success deleted data book');
}
```

> Method `show()` juga ada di controller (`Book::findOrFail($id)` lalu `view('book.show-book')`), tetapi belum dihubungkan ke route.

## 7. View Blade

Semua view ada di `resources/views/book/` dan memakai Tailwind CSS via CDN untuk styling sederhana.

### 7.1 Daftar buku: `book.blade.php`

Bagian inti untuk menampilkan data dan aksi:

```blade
@foreach ($book as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->title }}</td>
        <td>{{ $item->author }}</td>
        <td>{{ $item->year }}</td>
        <td>
            <a href="/edit-book/{{ $item->id }}">Edit</a>

            <form action="/delete-book/{{ $item->id }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
@endforeach
```

- `{{ }}` otomatis meng-*escape* HTML (aman dari XSS).
- Tombol Delete dibuat sebagai **form `POST` + `@method('DELETE')`**, bukan link, karena penghapusan tidak boleh dilakukan lewat `GET`.
- Tombol "Add Book" mengarah ke `/create-book`.
- Versi yang lebih rapi memakai nama route: `route('book.edit', $item->id)` dan `route('book.delete', $item->id)`.

Flash message `success` dari `update()`/`destroy()` dikirim ke halaman ini, tetapi `book.blade.php` di repo ini belum menampilkannya. Tambahkan di atas tabel:

```blade
@if (session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded" role="alert">
        {{ session('success') }}
    </div>
@endif
```

### 7.2 Form tambah: `create-book.blade.php`

```blade
@if (session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('book.store') }}" method="POST">
    @csrf

    <input type="text" name="title" id="title" required>
    <input type="text" name="author" id="author" required>
    <input type="number" name="year" id="year" min="1900" max="2100" required>

    <button type="submit">Save Book</button>
</form>
```

- `name="title"`, `name="author"`, `name="year"` harus sama dengan key di `validate()` dan `$fillable`.
- Atribut `required`, `min`, `max` di HTML hanya validasi sisi browser. **Validasi sebenarnya tetap di controller.**
- `$errors` selalu tersedia di view; `$errors->any()` bernilai `true` jika ada error validasi.
- Agar input tidak hilang saat validasi gagal, isi `value="{{ old('title') }}"` dan seterusnya.

### 7.3 Form edit: `edit-book.blade.php`

```blade
<form action="{{ route('book.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ old('title', $book->title) }}" required>
    <input type="text" name="author" value="{{ old('author', $book->author) }}" required>
    <input type="number" name="year" min="1900" max="2100" value="{{ old('year', $book->year) }}" required>

    <button type="submit">Update Book</button>
</form>
```

- `@method('PUT')` membuat Laravel memperlakukan request `POST` ini sebagai `PUT`, sesuai `Route::put('/edit-book/{id}')`.
- `old('title', $book->title)` memakai input sebelumnya jika validasi gagal, dan jatuh ke nilai di database jika tidak ada.
- Di repo ini field `title` masih memakai `$book['title']` tanpa `old()`. Gunakan pola `old('title', $book->title)` seperti field lain agar konsisten.

## 8. Alur Request End to End

Contoh **menambah buku**:

1. Browser membuka `GET /create-book` → `BookController@create` → view `create-book`.
2. User mengisi form dan submit → `POST /create-book` (dengan token CSRF).
3. Middleware web memeriksa CSRF dan session.
4. `BookController@store` memvalidasi input.
   - Gagal: redirect `302` kembali ke form + `$errors`.
   - Sukses: `Book::create($validated)` → INSERT ke tabel `book` → redirect ke `book.create` dengan flash `success`.

Contoh **menghapus buku**:

1. Klik Delete → `POST /delete-book/3` dengan `_method=DELETE` → Laravel menjadikannya `DELETE`.
2. `BookController@destroy` → `findOrFail(3)` → `delete()` → redirect ke `/book`.

Aplikasi ini **tidak memakai autentikasi**: siapa pun yang mengakses URL dapat menambah, mengubah, dan menghapus data. Untuk aplikasi nyata, tambahkan middleware `auth` pada route ini (dan Policy bila ada kepemilikan data).

## 9. Menjalankan dan Mencoba

```bash
php artisan migrate
php artisan db:seed --class=BookSeeder
php artisan serve
```

Buka `http://127.0.0.1:8000` lalu uji dengan urutan berikut:

| Langkah | Aksi                                                          | Hasil yang diharapkan                                      |
| ------- | ------------------------------------------------------------- | ---------------------------------------------------------- |
| 1       | Buka `/book`                                                  | Tabel berisi 3 buku seeder                                 |
| 2       | Klik **Add Book**, isi judul/penulis/tahun, simpan            | Kembali ke form dengan pesan "Success create book"         |
| 3       | Kosongkan judul atau isi kurang dari 3 huruf (nonaktifkan `required` di DevTools) | Kembali ke form dengan pesan error validasi |
| 4       | Buka `/book`, klik **Edit**, ubah data, simpan                | Redirect ke `/book`, data berubah                          |
| 5       | Klik **Delete**                                               | Baris hilang dari daftar                                   |
| 6       | Buka `/edit-book/9999`                                        | Halaman 404 (karena `findOrFail`)                          |

## 10. Latihan dan Langkah Selanjutnya

1. **Aktifkan halaman detail.** Tambahkan `Route::get('/detail-book/{id}', [BookController::class, 'show'])->name('book.show');`, lengkapi `show-book.blade.php` untuk menampilkan judul, penulis, dan tahun, lalu ubah link `Detail` di `book.blade.php` agar memakai `route('book.show', $item->id)`. Saat ini link `/detail-book` belum punya route.
2. **Samakan validasi `year`** di `store()` dengan `update()` (`required|integer|min:1900|max:2100`).
3. **Konfirmasi hapus.** Tambahkan `onsubmit="return confirm('Yakin hapus buku ini?')"` pada form delete.
4. **Tampilkan flash message** di `book.blade.php`.
5. **Refaktor route** menjadi `Route::resource('book', BookController::class)` dan bandingkan dengan route manual di tutorial ini (URI-nya akan berbeda).
6. **Pisahkan layout** dengan `@extends` / `@section` agar head, Tailwind, dan alert tidak diulang di tiap view.
7. **Pagination.** Ganti `Book::all()` dengan `Book::paginate(10)` dan tampilkan `{{ $book->links() }}`.
8. **Form Request.** Pindahkan aturan validasi ke class `StoreBookRequest` / `UpdateBookRequest`.

## Referensi

- Routing: https://laravel.com/docs/routing
- Blade Templates: https://laravel.com/docs/blade
- Validation: https://laravel.com/docs/validation
- Eloquent ORM: https://laravel.com/docs/eloquent
- CSRF Protection & Method Spoofing: https://laravel.com/docs/csrf, https://laravel.com/docs/routing#form-method-spoofing
