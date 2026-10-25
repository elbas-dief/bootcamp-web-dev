# Exam: Laravel REST API Mini E-Commerce

Bangun REST API e-commerce dari proyek Laravel 13 yang kosong. Kamu akan membuat endpoint autentikasi, proteksi dengan middleware token, CRUD produk dengan relasi, dan fitur cart.

## Endpoint yang Harus Dibuat

| Method      | Endpoint               | Akses  | Kegunaan                                        |
| ----------- | ---------------------- | ------ | ----------------------------------------------- |
| `POST`      | `/api/register`        | Publik | Membuat akun dan memberikan token.              |
| `POST`      | `/api/login`           | Publik | Memeriksa kredensial dan memberikan token.      |
| `POST`      | `/api/logout`          | Token  | Menghapus token yang sedang digunakan.          |
| `GET`       | `/api/categories`      | Token  | Melihat daftar kategori.                        |
| `GET`       | `/api/products`        | Token  | Melihat daftar produk beserta kategorinya.      |
| `GET`       | `/api/products/{id}`   | Token  | Melihat satu produk beserta kategorinya.        |
| `POST`      | `/api/products`        | Admin  | Membuat produk.                                 |
| `PUT/PATCH` | `/api/products/{id}`   | Admin  | Memperbarui produk.                             |
| `DELETE`    | `/api/products/{id}`   | Admin  | Menghapus produk.                               |
| `GET`       | `/api/cart/items`      | Token  | Melihat semua item cart pengguna yang login.    |
| `POST`      | `/api/cart/items`      | Token  | Menambahkan produk ke cart pengguna yang login. |
| `DELETE`    | `/api/cart/items/{id}` | Token  | Menghapus item dari cart pengguna yang login.   |

---

## Step 1 — Buat Proyek Laravel 13

**Requirement:** Buat proyek Laravel 13 baru bernama `ecommerce-api` tanpa starter kit.

**Artisan commands:**

```bash
composer create-project laravel/laravel:^13.0 ecommerce-api
cd ecommerce-api
```

**Hints:**

- Gunakan `composer create-project` dengan constraint versi `^13.0`.
- Pastikan PHP 8.3+ dan Composer tersedia.

---

## Step 2 — Siapkan Database MySQL

**Requirement:** Buat database `ecommerce_api` dan sambungkan proyek ke database tersebut melalui `.env`.

**Artisan commands:**

```bash
# Buat database
via terminal / PHPMyAdmin

# Setelah mengisi .env, bersihkan config cache
php artisan config:clear
```

**Hints:**

- Buat database via MySQL Workbench, phpMyAdmin, atau command line dengan `CREATE DATABASE`.
- Di `.env`, set `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.
- Jalankan `php artisan config:clear` setelah mengubah `.env`.

---

## Step 3 — Aktifkan API Routing dan Sanctum

**Requirement:** Pasang Laravel Sanctum dan aktifkan file routing `routes/api.php`.

**Artisan commands:**

```bash
php artisan install:api
php artisan migrate
```

**Hints:**

- Satu perintah artisan saja yang mengerjakan semua ini sekaligus.
- Jalankan migration setelah perintah tersebut berhasil — ini menyiapkan tabel `users` dan tabel token Sanctum.
- API ini menggunakan mekanisme **token Bearer**, bukan cookie/session.

---

## Step 4 — Aktifkan HasApiToken pada Model `User`

**Requirement:** Model `User` harus bisa membuat token API.

**Artisan commands:**

```bash
# Tidak ada command artisan — edit app/Models/User.php langsung
```

```bash
# Model User harus memiliki ini
use HasFactory, Notifiable, HasApiTokens;
```

**Hints:**

- Sanctum menyediakan sebuah trait yang perlu ditambahkan ke model `User`.
- Trait ini ada di namespace `Laravel\Sanctum`.
- Jangan hapus trait lain yang sudah ada (`HasFactory`, `Notifiable`).
- Trait ini menyediakan method `createToken()`.

---

## Step 5 — Buat Tabel Kategori, Produk, dan Cart

**Requirement:** Buat tiga model beserta file migration untuk `categories`, `products`, dan `cart_items`.

**Skema tabel yang harus dibuat:**

**`categories`**

- `id` (primary key)
- `name` (string, unik)
- `description` (text, nullable)
- `timestamps`

**`products`**

- `id` (primary key)
- `category_id` (foreign key ke `categories`, cascade delete)
- `name` (string)
- `description` (text, nullable)
- `price` (decimal 12,2)
- `stock` (unsigned integer, default 0)
- `image_url` (string, nullable)
- `timestamps`

**`cart_items`**

- `id` (primary key)
- `user_id` (foreign key ke `users`, cascade delete)
- `product_id` (foreign key ke `products`, cascade delete)
- `quantity` (unsigned integer, default 1)
- `timestamps`
- Kombinasi `user_id` + `product_id` harus unik (satu produk tidak boleh muncul dua kali di cart yang sama).

**Artisan commands:**

```bash
php artisan make:model Category -m
php artisan make:model Product -m
php artisan make:model CartItem -m

# Setelah mengisi semua file migration:
php artisan migrate
```

**Hints:**

- Gunakan `php artisan make:model NamaModel -m` untuk membuat model sekaligus migration.
- `foreignId('kolom_id')->constrained()->cascadeOnDelete()` untuk foreign key.
- `$table->unique(['user_id', 'product_id'])` untuk unique constraint gabungan.
- Jalankan `php artisan migrate` setelah semua migration diisi.

**Source code migration:**

Migration `categories`:
```php
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique();
    $table->text('description')->nullable();
    $table->timestamps();
});
```

Migration `products`:
```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->constrained()->cascadeOnDelete();
    $table->string('name');
    $table->text('description')->nullable();
    $table->decimal('price', 12, 2);
    $table->unsignedInteger('stock')->default(0);
    $table->string('image_url')->nullable();
    $table->timestamps();
});
```

Migration `cart_items`:
```php
Schema::create('cart_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->unsignedInteger('quantity')->default(1);
    $table->timestamps();
    $table->unique(['user_id', 'product_id']);
});
```

---

## Step 6 — Definisikan Relasi Eloquent

**Requirement:** Definisikan relasi antar model sesuai diagram berikut:

- Satu `Category` memiliki banyak `Product`.
- Satu `Product` milik satu `Category`.
- Satu `User` memiliki banyak `CartItem`.
- Satu `CartItem` milik satu `User` dan satu `Product`.
- Satu `Product` memiliki banyak `CartItem`.

**Requirement tambahan:**

- Setiap model harus mendefinisikan `$fillable` untuk mass assignment protection.
- `user_id` **tidak boleh** masuk ke `$fillable` pada `CartItem` — pemilik item selalu ditentukan dari pengguna yang terautentikasi, bukan dari input client.

**Artisan commands:**

```bash
# Tidak ada command artisan — edit file-file berikut langsung:
# app/Models/Category.php
# app/Models/Product.php
# app/Models/CartItem.php
# app/Models/User.php
```

**Hints:**

- Method relasi: `hasMany()`, `belongsTo()`.
- Return type: `HasMany`, `BelongsTo` dari namespace `Illuminate\Database\Eloquent\Relations`.
- `$fillable` adalah property array berisi nama kolom yang boleh diisi via mass assignment.

---

## Step 7 — Seed 5 Kategori dan 25 Produk

**Requirement:** Buat seeder untuk mengisi database dengan data contoh:

- 5 kategori: `Elektronik`, `Pakaian`, `Buku`, `Olahraga`, `Rumah Tangga`.
- 5 produk untuk setiap kategori (total 25 produk).

**Requirement tambahan:** Buat factory untuk `Category` dan `Product` (untuk dipakai di test).

**Artisan commands:**

```bash
php artisan make:seeder CategorySeeder
php artisan make:seeder ProductSeeder

php artisan make:factory CategoryFactory --model=Category
php artisan make:factory ProductFactory --model=Product

# Setelah mengisi semua file seeder:
php artisan db:seed
```

**Hints:**

- Gunakan `php artisan make:seeder NamaSeeder`.
- Daftarkan kedua seeder di `DatabaseSeeder` — `CategorySeeder` harus dipanggil sebelum `ProductSeeder` karena produk butuh `category_id`.
- Jalankan dengan `php artisan db:seed`.
- Untuk factory: `php artisan make:factory NamaFactory --model=NamaModel`.
- `fake()->unique()->word()` untuk nama unik, `fake()->randomFloat()` untuk harga.
- `UserFactory` sudah ada bawaan Laravel di `database/factories/UserFactory.php` — cukup tambahkan field `role` ke method `definition()`, tidak perlu dibuat ulang.

**Source code factory:**

`database/factories/CategoryFactory.php`:
```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => fake()->unique()->word(),
            'description' => fake()->sentence(),
        ];
    }
}
```

`database/factories/ProductFactory.php`:
```php
<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name'        => fake()->words(3, true),
            'description' => fake()->sentence(),
            'price'       => fake()->randomFloat(2, 10000, 10000000),
            'stock'       => fake()->numberBetween(0, 100),
            'image_url'   => null,
        ];
    }
}
```

`database/factories/UserFactory.php` — tambahkan field `role` ke method `definition()` yang sudah ada:
```php
public function definition(): array
{
    return [
        // ... field lain yang sudah ada (name, email, password, dll) ...
        'role' => 'user',
    ];
}
```

**Source code seeder (gunakan persis seperti ini):**

`database/seeders/CategorySeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik',   'description' => 'Perangkat elektronik dan gadget'],
            ['name' => 'Pakaian',      'description' => 'Pakaian pria dan wanita'],
            ['name' => 'Buku',         'description' => 'Buku fisik dan digital'],
            ['name' => 'Olahraga',     'description' => 'Peralatan dan perlengkapan olahraga'],
            ['name' => 'Rumah Tangga', 'description' => 'Peralatan dan dekorasi rumah'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
```

`database/seeders/ProductSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $productsByCategory = [
            'Elektronik' => [
                ['Smartphone Android 5G', 'Smartphone layar AMOLED 6.7 inci dengan kamera 108MP', 4500000],
                ['Laptop Core i5',        'Laptop tipis 14 inci RAM 16GB SSD 512GB',              8900000],
                ['TWS Earbuds',           'Earbuds nirkabel dengan noise cancellation',             450000],
                ['Smartwatch',            'Jam tangan pintar monitor kesehatan GPS',                950000],
                ['Power Bank 20000mAh',  'Power bank fast charge kapasitas besar',                 350000],
            ],
            'Pakaian' => [
                ['Kaos Polos Cotton',    'Kaos unisex bahan cotton combed 30s',    85000],
                ['Kemeja Flannel',       'Kemeja flannel motif kotak-kotak',       175000],
                ['Celana Jeans Slim',    'Celana jeans slim fit pria',             250000],
                ['Jaket Hoodie',         'Hoodie fleece tebal unisex',             220000],
                ['Dress Casual Wanita',  'Dress casual bahan rayon motif bunga',   195000],
            ],
            'Buku' => [
                ['Clean Code',               'Panduan menulis kode bersih oleh Robert C. Martin', 150000],
                ['The Pragmatic Programmer', 'Buku wajib untuk programmer profesional',           165000],
                ['Atomic Habits',            'Cara membangun kebiasaan baik dan menghilangkan kebiasaan buruk', 120000],
                ['Deep Work',               'Strategi kerja fokus di era penuh distraksi',         115000],
                ['Sapiens',                 'Sejarah singkat umat manusia oleh Yuval Noah Harari', 130000],
            ],
            'Olahraga' => [
                ['Sepatu Lari',         'Sepatu lari ringan dengan sol EVA',             450000],
                ['Dumbbell Set 10kg',   'Set dumbbell besi dengan rubber coating',        320000],
                ['Yoga Mat',            'Matras yoga anti-slip tebal 6mm',                135000],
                ['Raket Badminton',     'Raket badminton carbon fiber lightweight',        280000],
                ['Tas Gym',             'Tas olahraga besar dengan kompartemen sepatu',   175000],
            ],
            'Rumah Tangga' => [
                ['Rice Cooker Digital', 'Rice cooker kapasitas 1.8L dengan timer',    350000],
                ['Blender Portable',   'Blender portable USB rechargeable',            180000],
                ['Lampu LED Smart',    'Lampu LED 12W dengan kontrol via smartphone',   125000],
                ['Rak Buku Minimalis', 'Rak buku 5 susun kayu jati minimalis',          420000],
                ['Bantal Memory Foam', 'Bantal ergonomis memory foam anti-nyeri leher', 210000],
            ],
        ];

        foreach ($productsByCategory as $categoryName => $products) {
            $category = Category::where('name', $categoryName)->firstOrFail();

            foreach ($products as [$name, $description, $price]) {
                Product::firstOrCreate(
                    ['name' => $name],
                    [
                        'category_id' => $category->id,
                        'description' => $description,
                        'price'       => $price,
                        'stock'       => 20,
                    ]
                );
            }
        }
    }
}
```

`database/seeders/DatabaseSeeder.php` — pastikan urutan ini:

```php
public function run(): void
{
    $this->call([
        CategorySeeder::class,
        ProductSeeder::class,
    ]);
}
```

---

## Step 8 — Buat Controller Autentikasi API

**Requirement:** Buat `Api/AuthController` dengan tiga method:

| Method     | Validasi yang Diperlukan                                           | Response Sukses                         |
| ---------- | ------------------------------------------------------------------ | --------------------------------------- |
| `register` | `name` required, `email` required+unik, `password` min:8+confirmed | `201` dengan `message`, `user`, `token` |
| `login`    | `email` required, `password` required                              | `200` dengan `message`, `user`, `token` |
| `logout`   | (tidak ada — hanya butuh token valid)                              | `200` dengan `message`                  |

**Artisan commands:**

```bash
php artisan make:controller Api/AuthController
```

**Hints:**

- Gunakan `Hash::make()` untuk menyimpan password, `Hash::check()` untuk memverifikasi.
- `$user->createToken('api-token')->plainTextToken` untuk menghasilkan token.
- Login yang gagal kembalikan `401`.
- Logout hapus token saat ini dengan `$request->user()->currentAccessToken()->delete()`.
- Token hanya ditampilkan sekali saat dibuat — client harus menyimpannya.

**Contoh request & response:**

`POST /api/register`

```json
// Request body
{
    "name": "Budi",
    "email": "budi@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}

// Response 201
{
    "message": "Akun berhasil dibuat.",
    "user": {
        "id": 1,
        "name": "Budi",
        "email": "budi@example.com",
        "created_at": "2026-10-23T10:00:00.000000Z"
    },
    "token": "1|abc123plainTextToken"
}
```

`POST /api/login`

```json
// Request body
{
    "email": "budi@example.com",
    "password": "password123"
}

// Response 200
{
    "message": "Login berhasil.",
    "user": {
        "id": 1,
        "name": "Budi",
        "email": "budi@example.com",
        "created_at": "2026-10-23T10:00:00.000000Z"
    },
    "token": "2|xyz456plainTextToken"
}

// Response 401 (kredensial salah)
{
    "message": "Email atau password salah."
}
```

`POST /api/logout`

```json
// Request: tidak ada body, cukup kirim Authorization header
// Response 200
{
    "message": "Logout berhasil."
}
```

---

## Step 9 — Buat Controller Produk, Kategori, dan Cart

**Requirement:** Buat tiga controller:

**`Api/CategoryController`** — method `index`:

- Kembalikan semua kategori diurutkan berdasarkan nama.

**`Api/ProductController`** — method `index`, `store`, `show`, `update`, `destroy`:

- `index`: tampilkan semua produk beserta relasi `category`, diurutkan terbaru.
- `show`: tampilkan satu produk beserta `category`, return `404` jika tidak ada.
- `store`: validasi input, buat produk, load relasi, return `201`.
- `update`: validasi input partial (semua field opsional dengan `sometimes`), update produk.
- `destroy`: hapus produk, return pesan konfirmasi.

**`Api/CartController`** — method `index`, `store`, `destroy`:

- `index`: tampilkan cart milik pengguna yang login beserta relasi `product.category`.
- `store`: tambah produk ke cart; jika produk sudah ada, **tambahkan** jumlahnya (jangan buat baris baru).
- `destroy`: hapus item dari cart milik pengguna yang login saja — client tidak boleh bisa menghapus item orang lain.

**Artisan commands:**

```bash
php artisan make:controller Api/CategoryController
php artisan make:controller Api/ProductController
php artisan make:controller Api/CartController
```

**Hints:**

- `Product::with('category')->latest()->get()` untuk eager loading dan urutan.
- `findOrFail($id)` otomatis return `404` jika tidak ditemukan.
- Di CartController, selalu query melalui `$request->user()->cartItems()` bukan langsung `CartItem::`.
- Untuk cart `store`: gunakan `firstOrNew(['product_id' => ...])` lalu cek `$item->exists` untuk menentukan quantity awal.
- `$item->load('product.category')` untuk load nested relation setelah save.

**Contoh request & response:**

`GET /api/categories`

```json
// Response 200
{
    "data": [
        { "id": 3, "name": "Buku", "description": "Buku fisik dan digital" },
        { "id": 1, "name": "Elektronik", "description": "Perangkat elektronik dan gadget" },
        { "id": 4, "name": "Olahraga", "description": "Peralatan dan perlengkapan olahraga" }
    ]
}
```

`GET /api/products`

```json
// Response 200
{
    "data": [
        {
            "id": 1,
            "name": "Smartphone Android 5G",
            "description": "Smartphone layar AMOLED 6.7 inci dengan kamera 108MP",
            "price": 4500000.0,
            "stock": 20,
            "image_url": null,
            "category": {
                "id": 1,
                "name": "Elektronik",
                "description": "Perangkat elektronik dan gadget"
            },
            "created_at": "2026-10-23T10:00:00.000000Z"
        }
    ]
}
```

`GET /api/products/{id}`

```json
// Response 200
{
    "data": {
        "id": 1,
        "name": "Smartphone Android 5G",
        "description": "Smartphone layar AMOLED 6.7 inci dengan kamera 108MP",
        "price": 4500000.0,
        "stock": 20,
        "image_url": null,
        "category": {
            "id": 1,
            "name": "Elektronik",
            "description": "Perangkat elektronik dan gadget"
        },
        "created_at": "2026-10-23T10:00:00.000000Z"
    }
}
```

`POST /api/products`

```json
// Request body
{
    "category_id": 1,
    "name": "Gaming Mouse",
    "description": "Mouse gaming RGB 16000 DPI",
    "price": 350000,
    "stock": 15,
    "image_url": "https://example.com/images/gaming-mouse.jpg"
}

// Response 201
{
    "message": "Produk berhasil dibuat.",
    "data": {
        "id": 26,
        "name": "Gaming Mouse",
        "description": "Mouse gaming RGB 16000 DPI",
        "price": 350000.0,
        "stock": 15,
        "image_url": "https://example.com/images/gaming-mouse.jpg",
        "category": {
            "id": 1,
            "name": "Elektronik",
            "description": "Perangkat elektronik dan gadget"
        },
        "created_at": "2026-10-23T10:00:00.000000Z"
    }
}
```

`PUT /api/products/{id}` — kirim semua field | `PATCH /api/products/{id}` — kirim field yang berubah saja

```json
// Request body (PATCH, hanya field yang berubah)
{
    "price": 420000,
    "stock": 10
}

// Response 200
{
    "message": "Produk berhasil diperbarui.",
    "data": {
        "id": 26,
        "name": "Gaming Mouse",
        "description": "Mouse gaming RGB 16000 DPI",
        "price": 420000.0,
        "stock": 10,
        "image_url": "https://example.com/images/gaming-mouse.jpg",
        "category": {
            "id": 1,
            "name": "Elektronik",
            "description": "Perangkat elektronik dan gadget"
        },
        "created_at": "2026-10-23T10:00:00.000000Z"
    }
}
```

`DELETE /api/products/{id}`

```json
// Response 200
{
    "message": "Produk berhasil dihapus."
}
```

`GET /api/cart/items`

```json
// Response 200
{
    "data": [
        {
            "id": 1,
            "quantity": 2,
            "product": {
                "id": 1,
                "name": "Smartphone Android 5G",
                "description": "Smartphone layar AMOLED 6.7 inci dengan kamera 108MP",
                "price": 4500000.0,
                "stock": 20,
                "image_url": null,
                "category": {
                    "id": 1,
                    "name": "Elektronik",
                    "description": "Perangkat elektronik dan gadget"
                },
                "created_at": "2026-10-23T10:00:00.000000Z"
            }
        }
    ]
}
```

`POST /api/cart/items`

```json
// Request body
{
    "product_id": 1,
    "quantity": 2
}

// Response 201
{
    "message": "Produk berhasil ditambahkan ke cart.",
    "data": {
        "id": 1,
        "quantity": 2,
        "product": {
            "id": 1,
            "name": "Smartphone Android 5G",
            "description": "Smartphone layar AMOLED 6.7 inci dengan kamera 108MP",
            "price": 4500000.0,
            "stock": 20,
            "image_url": null,
            "category": {
                "id": 1,
                "name": "Elektronik",
                "description": "Perangkat elektronik dan gadget"
            },
            "created_at": "2026-10-23T10:00:00.000000Z"
        }
    }
}
```

`DELETE /api/cart/items/{id}`

```json
// Response 200  (id adalah ID baris cart_items, bukan ID produk)
{
    "message": "Item berhasil dihapus dari cart."
}
```

---

## Step 10 — Pisahkan Validasi dengan Form Request

**Requirement:** Pindahkan aturan validasi dari controller ke class Form Request tersendiri. Buat tiga Form Request:

| Form Request           | Digunakan di                  |
| ---------------------- | ----------------------------- |
| `StoreProductRequest`  | `ProductController::store()`  |
| `UpdateProductRequest` | `ProductController::update()` |
| `StoreCartItemRequest` | `CartController::store()`     |

**Artisan commands:**

```bash
php artisan make:request StoreProductRequest
php artisan make:request UpdateProductRequest
php artisan make:request StoreCartItemRequest
```

**Hints:**

- `php artisan make:request NamaRequest`.
- Method `authorize()` kembalikan `true` — otorisasi sudah ditangani middleware.
- Method `rules()` berisi array aturan validasi.
- `UpdateProductRequest` menggunakan prefix `sometimes` pada setiap rule agar partial update bisa dilakukan.
- Ganti type hint `Request $request` di controller dengan class Form Request yang sesuai.
- Gunakan `$request->validated()` di controller (bukan `$request->all()`).

---

## Step 11 — Pisahkan Format Response dengan API Resource

**Requirement:** Buat API Resource untuk memformat response JSON secara konsisten. Buat tiga resource:

| Resource           | Field yang Dikembalikan                                                                      |
| ------------------ | -------------------------------------------------------------------------------------------- |
| `CategoryResource` | `id`, `name`, `description`                                                                  |
| `ProductResource`  | `id`, `name`, `description`, `price` (float), `stock`, `image_url`, `category`, `created_at` |
| `CartItemResource` | `id`, `quantity`, `product`                                                                  |

**Artisan commands:**

```bash
php artisan make:resource CategoryResource
php artisan make:resource ProductResource
php artisan make:resource CartItemResource
```

**Hints:**

- `php artisan make:resource NamaResource`.
- Extend `JsonResource`, implementasikan method `toArray()`.
- Nested resource: `new CategoryResource($this->whenLoaded('category'))`.
- `whenLoaded('relation')` hanya menyertakan relasi jika sudah di-load — mencegah query N+1.
- `(float) $this->price` memastikan harga bertipe angka, bukan string.
- Perbarui semua controller untuk memakai resource.

---

## Step 12 — Batasi CRUD Produk untuk Admin

**Requirement:** Hanya pengguna dengan `role = 'admin'` yang boleh membuat, mengubah, dan menghapus produk.

**Langkah-langkah:**

1. Tambahkan kolom `role` ke tabel `users` (default `'user'`).
2. Buat middleware `EnsureUserIsAdmin`.
3. Daftarkan alias middleware `role.admin` di `bootstrap/app.php`.

**Artisan commands:**

```bash
php artisan make:migration add_role_to_users_table --table=users
php artisan make:middleware EnsureUserIsAdmin
php artisan migrate

# Angkat akun menjadi admin via Tinker
php artisan tinker
# Lalu jalankan di dalam Tinker:
# \App\Models\User::where('email', 'budi@example.com')->update(['role' => 'admin']);
# exit
```

Isi method `up()` dan `down()` pada file migration yang dihasilkan:

```php
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('role')->default('user')->after('email');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
    });
}
```

**Hints:**

- Buat migration baru: `php artisan make:migration add_role_to_users_table --table=users`.
- Middleware: cek `$request->user()?->role !== 'admin'`, return `403` jika bukan admin.
- Middleware berjalan **setelah** `auth:sanctum`, sehingga `$request->user()` sudah terisi.
- Alias didaftarkan di `bootstrap/app.php` dalam `->withMiddleware(fn ($m) => $m->alias([...]))`.
- `role` **tidak masuk `$fillable`** di model `User` — nilai role ditentukan aplikasi, bukan dari input client.
- Untuk mengangkat akun menjadi admin: gunakan `php artisan tinker` dan update kolom `role` langsung.

---

## Step 13 — Definisikan API Routes

**Requirement:** Isi `routes/api.php` dengan semua route sesuai tabel endpoint di atas. Kelompokkan route dengan middleware yang tepat:

- Route publik: `register`, `login` (tanpa middleware).
- Route bertoken: semua route lain dibungkus `auth:sanctum`.
- Route admin: `store`, `update`, `destroy` produk dibungkus tambahan `role.admin`.

**Artisan commands:**

```bash
# Verifikasi semua route terdaftar dengan benar
php artisan route:list --path=api
```

**Hints:**

- `Route::middleware('auth:sanctum')->group(fn() => ...)` untuk membungkus route.
- Nested `->middleware('role.admin')->group(...)` di dalam group `auth:sanctum`.
- `PUT` dan `PATCH` keduanya harus dipetakan ke method `update` yang sama.
- Laravel otomatis memberi prefix `/api` pada semua route di `routes/api.php`.

---

## Step 14 — Tangani Error API secara Konsisten

**Requirement:** Pastikan semua error pada endpoint `api/*` selalu dikembalikan sebagai JSON, bukan HTML. Tiga perilaku yang harus dikonfigurasi di `bootstrap/app.php`:

1. Request tanpa token → `401` JSON dengan pesan yang informatif.
2. Data tidak ditemukan → `404` JSON dengan pesan `"Data tidak ditemukan."`.
3. Endpoint tidak ada → `404` JSON dengan pesan `"Endpoint tidak ditemukan."`.
4. Middleware autentikasi tidak boleh redirect ke route `login` untuk `api/*`.

**Artisan commands:**

```bash
# Bersihkan cache setelah mengubah bootstrap/app.php
php artisan config:clear
php artisan route:clear
```

**Hints:**

- `->withExceptions(fn($e) => ...)` di `bootstrap/app.php` untuk mendaftarkan exception handler.
- `$exceptions->shouldRenderJsonWhen(fn($req) => $req->is('api/*'))` agar semua error jadi JSON.
- `$exceptions->render(function (AuthenticationException $e, Request $request) {...})` untuk handle `401`.
- `$exceptions->render(function (NotFoundHttpException $e, Request $request) {...})` untuk handle `404`.
- Bedakan `ModelNotFoundException` dari `NotFoundHttpException` biasa untuk pesan yang berbeda.
- `->withMiddleware(fn($m) => $m->redirectGuestsTo(...))` dengan return `null` untuk path `api/*`.

**Source code `bootstrap/app.php`:**

```php
<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(fn (Request $request) => $request->is('api/*') ? null : route('login'));
        $middleware->alias([
            'role.admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Token tidak ditemukan atau tidak valid. Silakan login terlebih dahulu.',
                ], 401);
            }
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                $message = $e->getPrevious() instanceof ModelNotFoundException
                    ? 'Data tidak ditemukan.'
                    : 'Endpoint tidak ditemukan.';

                return response()->json(['message' => $message], 404);
            }
        });
    })->create();
```

**Contoh response error yang harus dihasilkan:**

```json
// 401 — request tanpa token atau token tidak valid
{
    "message": "Token tidak ditemukan atau tidak valid. Silakan login terlebih dahulu."
}

// 403 — user bukan admin mencoba write produk
{
    "message": "Akses ditolak."
}

// 404 — data tidak ditemukan (misal GET /api/products/999)
{
    "message": "Data tidak ditemukan."
}

// 404 — endpoint tidak ada (misal GET /api/tidak-ada)
{
    "message": "Endpoint tidak ditemukan."
}

// 422 — validasi gagal
{
    "message": "The email field must be a valid email address.",
    "errors": {
        "email": ["The email field must be a valid email address."],
        "password": ["The password field confirmation does not match."]
    }
}
```

---

## Step 15 — Jalankan dan Periksa Route

**Requirement:** Pastikan server berjalan dan semua route terdaftar dengan benar.

**Artisan commands:**

```bash
php artisan route:clear
php artisan config:clear
php artisan serve

# Di terminal lain, verifikasi semua route:
php artisan route:list --path=api
```

**Hints:**

- `php artisan route:clear && php artisan config:clear` sebelum menjalankan server.
- `php artisan serve` untuk menjalankan server di `http://127.0.0.1:8000`.
- `php artisan route:list --path=api` untuk melihat semua route API.
- Kirim header `Accept: application/json` dan `Content-Type: application/json` di setiap request.
- Header autentikasi: `Authorization: Bearer <token>`.

---

## Step 16 — Izinkan Client dari Origin Berbeda (CORS)

**Requirement:** Konfigurasi CORS agar frontend di origin berbeda (misal `http://localhost:5173`) bisa mengakses API.

**Artisan commands:**

```bash
php artisan config:publish cors
# Edit config/cors.php sesuai kebutuhan, lalu:
php artisan config:clear
```

**Hints:**

- `php artisan config:publish cors` untuk menerbitkan file konfigurasi.
- Edit `config/cors.php`: set `paths` ke `['api/*']`, `allowed_origins` ke origin frontend.
- Jalankan `php artisan config:clear` setelah mengubah konfigurasi.

**Source code `config/cors.php`:**

```php
'paths' => ['api/*'],
'allowed_methods' => ['*'],
'allowed_origins' => ['http://localhost:5173'],
'allowed_origins_patterns' => [],
'allowed_headers' => ['Accept', 'Authorization', 'Content-Type', 'X-Requested-With'],
'exposed_headers' => [],
'max_age' => 0,
'supports_credentials' => false,
```

---

## Step 17 — Tulis Feature Test

**Requirement:** Tulis feature test untuk memverifikasi bahwa endpoint bekerja sesuai spesifikasi.

**Test yang harus dibuat:**

**`RegisterApiTest`:**

- Register berhasil dengan data valid → `201` dengan struktur `message`, `token`, `user`.
- Register gagal jika email sudah dipakai → `422` dengan error pada field `email`.
- Register gagal jika password tidak cocok → `422` dengan error pada field `password`.
- Register gagal jika field wajib tidak dikirim → `422`.

**`ProductApiTest`:**

- GET produk tanpa token → `401`.
- GET produk dengan token → `200` dengan key `data`.
- GET produk mengembalikan daftar beserta relasi `category` → struktur `data[*][id, name, price, stock, category]`.
- User biasa POST produk → `403`.
- Admin POST produk → `201` dengan struktur response yang benar.

**Artisan commands:**

```bash
php artisan make:test RegisterApiTest
php artisan make:test ProductApiTest
```

**Hints:**

- Gunakan SQLite in-memory untuk test: set `DB_CONNECTION=sqlite` dan `DB_DATABASE=:memory:` di `phpunit.xml`.
- Tambahkan `use RefreshDatabase;` di setiap test class.
- `$this->postJson('/api/route', [...])` untuk mengirim request JSON.
- `$this->actingAs($user, 'sanctum')` untuk mengautentikasi user di test.
- `->assertStatus(201)`, `->assertJsonStructure([...])`, `->assertJson([...])` untuk assertion.
- `User::factory()->create(['role' => 'admin'])` untuk membuat user admin di test.
- Jalankan test dengan `php artisan test`.

**Prompt AI (gunakan prompt ini ke Claude / ChatGPT jika butuh bantuan):**

```
Saya punya Laravel 13 REST API dengan Sanctum. Tolong buatkan feature test untuk dua file berikut:

1. tests/Feature/RegisterApiTest.php
   Test case yang dibutuhkan:
   - Register berhasil dengan data valid → status 201, response memiliki key message, token, user (id, name, email)
   - Register gagal jika email sudah dipakai → status 422, ada validation error di field email
   - Register gagal jika password dan password_confirmation tidak cocok → status 422, ada validation error di field password
   - Register gagal jika semua field kosong → status 422

2. tests/Feature/ProductApiTest.php
   Test case yang dibutuhkan:
   - GET /api/products tanpa token → status 401, message "Token tidak ditemukan atau tidak valid. Silakan login terlebih dahulu."
   - GET /api/products dengan token valid → status 200, response memiliki key data
   - GET /api/products dengan token valid dan ada 3 produk → status 200, data berisi 3 item, setiap item memiliki id, name, price, stock, category
   - POST /api/products oleh user biasa (role=user) → status 403, message "Akses ditolak."
   - POST /api/products oleh admin (role=admin) dengan data valid → status 201, response memiliki key message dan data (id, name, price, stock, category)

Ketentuan:
- Gunakan RefreshDatabase
- Gunakan actingAs($user, 'sanctum') untuk autentikasi
- Gunakan User::factory(), Category::factory(), Product::factory() untuk membuat data
- Database test menggunakan SQLite in-memory (sudah dikonfigurasi di phpunit.xml)
- Model User memiliki kolom role (string, default 'user')
- Response 401 sudah dikustomisasi di bootstrap/app.php

Berikan hanya isi file PHP-nya saja, tanpa penjelasan tambahan.
```

### Menjalankan End to end Testing

```
# Jalankan semua test
php artisan test

# Jalankan satu file test saja
php artisan test tests/Feature/RegisterApiTest.php
php artisan test tests/Feature/ProductApiTest.php
```

---

## Kriteria Penilaian

| Kriteria                                                    | Poin    |
| ----------------------------------------------------------- | ------- |
| Semua migration berjalan tanpa error                        | 10      |
| Endpoint register dan login mengembalikan token             | 15      |
| Endpoint yang dilindungi menolak request tanpa token        | 10      |
| CRUD produk berfungsi (index, show, store, update, destroy) | 20      |
| Middleware admin memblokir non-admin (403)                  | 10      |
| Endpoint cart (index, store, destroy) berfungsi             | 15      |
| Form Request dipakai di controller                          | 5       |
| API Resource dipakai di controller                          | 5       |
| Error handler mengembalikan JSON konsisten                  | 5       |
| Feature test lulus semua                                    | 5       |
| **Total**                                                   | **100** |

## Kerjakan Soal Berikut

1. Ketika browser atau Postman mengirim `POST /api/products`, request itu melewati beberapa lapisan sebelum menyentuh `ProductController::store()`. Urutkan lapisan-lapisan berikut dari yang pertama hingga terakhir dieksekusi: _controller_, _middleware_, _route matching_, _kernel HTTP_, _service provider_, _Form Request validation_. Jelaskan singkat peran tiap lapisan.

2. Laravel memisahkan konfigurasi ke file `.env` dan `config/`. Jelaskan perbedaan keduanya: kapan Laravel membaca `.env`, kapan membaca `config/`, dan mengapa nilai `.env` tidak boleh diakses langsung dengan `$_ENV['DB_HOST']` di dalam kode aplikasi?

3. Eloquent menggunakan pola Active Record: setiap model merepresentasikan satu tabel dan satu baris. Jelaskan apa yang terjadi di balik layar saat kode `Product::with('category')->latest()->get()` dijalankan — query SQL apa yang dieksekusi, berapa kali, dan mengapa cara ini lebih baik dari memanggil `$product->category` di dalam loop?

4. Migration bukan sekadar script SQL — ia adalah version control untuk skema database. Jelaskan tiga hal: (a) apa fungsi method `up()` dan `down()`, (b) mengapa urutan migration penting khususnya saat ada foreign key, (c) apa yang terjadi jika kita menjalankan `php artisan migrate` dua kali pada migration yang sama?

5. Artisan adalah command-line interface bawaan Laravel. Jelaskan bagaimana `php artisan make:controller Api/ProductController` bekerja: (a) file apa yang dihasilkan dan di mana letaknya, (b) apa hubungan antara namespace `App\Http\Controllers\Api` dengan struktur folder, (c) mengapa kita bisa langsung memakai class tersebut di `routes/api.php` tanpa `require` atau `include` manual seperti di PHP biasa?
