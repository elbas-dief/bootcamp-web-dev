# 📚 Materi Pertemuan 4 — Basic CSS 2

**Kelas:** AI-Enhanced Fullstack Website Reguler  
**Lembaga:** Haltev IT Learning Center  
**Materi:** Flexbox, Grid Layout, dan Bootstrap  
**Durasi:** 2 jam

---

## 🎯 Tujuan Pembelajaran

Setelah pertemuan ini, siswa diharapkan mampu:
- Memahami konsep Flexbox dan menggunakannya untuk menyusun layout
- Memahami konsep CSS Grid dan menggunakannya untuk membuat tata letak kompleks
- Menggunakan Bootstrap untuk membangun halaman yang responsif dengan cepat

---

## 📖 Bagian 1 — Flexbox

### Apa itu Flexbox?

Flexbox (Flexible Box Layout) adalah cara modern untuk mengatur tata letak elemen dalam satu baris atau satu kolom. Flexbox membuat kita lebih mudah mengatur posisi, ukuran, dan jarak antar elemen tanpa banyak trik.

Flexbox bekerja dengan dua konsep utama:
- **Flex Container** — elemen induk yang diberi `display: flex`
- **Flex Item** — elemen anak yang berada di dalam container

### Mengaktifkan Flexbox

```css
.container {
  display: flex;
}
```

### Properti pada Flex Container

#### `flex-direction` — Arah susunan item

```css
.container {
  flex-direction: row;         /* default — horizontal (kiri ke kanan) */
  flex-direction: row-reverse; /* horizontal terbalik */
  flex-direction: column;      /* vertikal (atas ke bawah) */
  flex-direction: column-reverse;
}
```

#### `justify-content` — Posisi item pada sumbu utama (horizontal jika row)

```css
.container {
  justify-content: flex-start;    /* rata kiri (default) */
  justify-content: flex-end;      /* rata kanan */
  justify-content: center;        /* di tengah */
  justify-content: space-between; /* jarak rata, tepi menempel */
  justify-content: space-around;  /* jarak rata, ada ruang di tepi */
  justify-content: space-evenly;  /* jarak benar-benar sama rata */
}
```

#### `align-items` — Posisi item pada sumbu silang (vertikal jika row)

```css
.container {
  align-items: stretch;     /* default — item memenuhi tinggi container */
  align-items: flex-start;  /* rata atas */
  align-items: flex-end;    /* rata bawah */
  align-items: center;      /* di tengah secara vertikal */
}
```

#### `flex-wrap` — Apakah item boleh turun ke baris baru

```css
.container {
  flex-wrap: nowrap;  /* default — semua dalam satu baris */
  flex-wrap: wrap;    /* item turun ke baris baru jika tidak muat */
}
```

#### `gap` — Jarak antar item

```css
.container {
  gap: 16px;       /* jarak sama di semua sisi */
  gap: 16px 8px;   /* jarak baris 16px, jarak kolom 8px */
}
```

### Properti pada Flex Item

```css
.item {
  flex-grow: 1;    /* item akan mengembang mengisi ruang sisa */
  flex-shrink: 0;  /* item tidak akan menyusut */
  flex-basis: 200px; /* ukuran awal item sebelum grow/shrink */
  align-self: center; /* override align-items khusus untuk item ini */
}
```

### Contoh: Navbar dengan Flexbox

```html
<nav class="navbar">
  <div class="logo">MyBrand</div>
  <ul class="nav-links">
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Contact</a></li>
  </ul>
</nav>
```

```css
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px 32px;
  background-color: #1a1a2e;
  color: white;
}

.nav-links {
  display: flex;
  list-style: none;
  gap: 24px;
  margin: 0;
  padding: 0;
}

.nav-links a {
  color: white;
  text-decoration: none;
}
```

### Contoh: Card Grid dengan Flexbox

```html
<div class="card-container">
  <div class="card">Card 1</div>
  <div class="card">Card 2</div>
  <div class="card">Card 3</div>
</div>
```

```css
.card-container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
  padding: 20px;
}

.card {
  flex-basis: 250px;
  flex-grow: 1;
  background: white;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
```

---

## 📖 Bagian 2 — CSS Grid

### Apa itu CSS Grid?

CSS Grid adalah sistem layout dua dimensi — artinya kita bisa mengatur elemen secara **baris dan kolom sekaligus**. Cocok untuk membuat layout halaman penuh seperti header, sidebar, konten, dan footer.

> **Kapan pakai Flexbox vs Grid?**  
> - Flexbox → untuk layout **satu arah** (baris atau kolom saja)  
> - Grid → untuk layout **dua arah** (baris dan kolom bersamaan)

### Mengaktifkan Grid

```css
.container {
  display: grid;
}
```

### `grid-template-columns` — Mendefinisikan kolom

```css
.container {
  display: grid;
  grid-template-columns: 200px 200px 200px; /* 3 kolom, masing-masing 200px */
  grid-template-columns: 1fr 1fr 1fr;       /* 3 kolom sama rata (fr = fraction) */
  grid-template-columns: repeat(3, 1fr);    /* sama seperti di atas, lebih ringkas */
  grid-template-columns: 250px 1fr;         /* sidebar 250px, konten mengisi sisa */
}
```

### `grid-template-rows` — Mendefinisikan baris

```css
.container {
  grid-template-rows: 80px auto 60px; /* header, konten fleksibel, footer */
}
```

### `gap` — Jarak antar sel grid

```css
.container {
  gap: 20px;        /* jarak sama di semua sisi */
  column-gap: 20px; /* hanya jarak antar kolom */
  row-gap: 10px;    /* hanya jarak antar baris */
}
```

### `grid-column` & `grid-row` — Item memanjang lebih dari satu sel

```css
.header {
  grid-column: 1 / 3;  /* dari kolom 1 sampai 3 (memanjang 2 kolom) */
  grid-column: span 2; /* lebih ringkas: panjangnya 2 kolom */
}

.sidebar {
  grid-row: span 2; /* tingginya 2 baris */
}
```

### Contoh: Layout Halaman Penuh

```html
<div class="page-layout">
  <header class="header">Header</header>
  <aside class="sidebar">Sidebar</aside>
  <main class="content">Konten Utama</main>
  <footer class="footer">Footer</footer>
</div>
```

```css
.page-layout {
  display: grid;
  grid-template-columns: 250px 1fr;
  grid-template-rows: 80px auto 60px;
  min-height: 100vh;
  gap: 0;
}

.header {
  grid-column: span 2; /* header penuh memanjang 2 kolom */
  background: #1a1a2e;
  color: white;
  display: flex;
  align-items: center;
  padding: 0 24px;
}

.sidebar {
  background: #f0f0f0;
  padding: 20px;
}

.content {
  padding: 20px;
}

.footer {
  grid-column: span 2;
  background: #333;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
}
```

### Contoh: Galeri Foto dengan Grid

```css
.gallery {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 12px;
}

.gallery img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
}
```

---

## 📖 Bagian 3 — Bootstrap

### Apa itu Bootstrap?

Bootstrap adalah framework CSS yang menyediakan komponen dan sistem grid siap pakai. Dengan Bootstrap, kita bisa membuat tampilan yang rapi dan responsif tanpa harus menulis semua CSS dari nol.

### Cara Memakai Bootstrap (via CDN)

Tambahkan tag berikut di dalam `<head>` HTML:

```html
<link 
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
  rel="stylesheet"
>
```

Tambahkan tag berikut sebelum `</body>` (diperlukan untuk komponen interaktif):

```html
<script 
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
```

### Sistem Grid Bootstrap

Bootstrap menggunakan sistem **12 kolom**. Setiap baris (`row`) dibagi menjadi 12 bagian, dan kita bisa menentukan setiap elemen mau mengambil berapa kolom.

```html
<div class="container">
  <div class="row">
    <div class="col-4">Kolom 1 (4/12)</div>
    <div class="col-4">Kolom 2 (4/12)</div>
    <div class="col-4">Kolom 3 (4/12)</div>
  </div>
</div>
```

#### Responsif dengan Breakpoint

```html
<div class="col-12 col-md-6 col-lg-4">
  <!-- Di HP: lebar penuh (12 kolom) -->
  <!-- Di tablet: setengah layar (6 kolom) -->
  <!-- Di laptop: sepertiga layar (4 kolom) -->
</div>
```

| Prefix | Ukuran Layar |
|--------|--------------|
| (tanpa prefix) | < 576px (HP kecil) |
| `col-sm-` | ≥ 576px (HP) |
| `col-md-` | ≥ 768px (Tablet) |
| `col-lg-` | ≥ 992px (Laptop) |
| `col-xl-` | ≥ 1200px (Desktop) |

### Utility Classes Bootstrap yang Sering Dipakai

#### Spacing (Margin & Padding)

```html
<!-- m = margin, p = padding -->
<!-- t=top, b=bottom, s=start/left, e=end/right, x=horizontal, y=vertical -->
<!-- Angka 0–5 untuk ukuran (0 = 0px, 5 = 3rem) -->

<div class="mt-3">margin-top: 1rem</div>
<div class="p-4">padding: 1.5rem semua sisi</div>
<div class="mx-auto">margin kiri-kanan otomatis (centering)</div>
<div class="py-5">padding atas-bawah: 3rem</div>
```

#### Text

```html
<p class="text-center">Teks tengah</p>
<p class="text-end">Teks kanan</p>
<p class="fw-bold">Teks tebal</p>
<p class="text-muted">Teks abu-abu</p>
<p class="fs-4">Font size 4</p>
```

#### Display & Flexbox

```html
<div class="d-flex justify-content-between align-items-center">
  ...
</div>
```

#### Warna (Background & Text)

```html
<div class="bg-primary text-white">Biru</div>
<div class="bg-success text-white">Hijau</div>
<div class="bg-danger text-white">Merah</div>
<div class="bg-light text-dark">Abu-abu terang</div>
```

### Komponen Bootstrap

#### Tombol

```html
<button class="btn btn-primary">Primary</button>
<button class="btn btn-outline-secondary">Secondary</button>
<button class="btn btn-danger btn-sm">Kecil Merah</button>
<button class="btn btn-success btn-lg">Besar Hijau</button>
```

#### Navbar

```html
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">MyBrand</a>
    <div class="navbar-nav ms-auto">
      <a class="nav-link active" href="#">Home</a>
      <a class="nav-link" href="#">About</a>
      <a class="nav-link" href="#">Contact</a>
    </div>
  </div>
</nav>
```

#### Card

```html
<div class="card" style="width: 18rem;">
  <img src="foto.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Judul Card</h5>
    <p class="card-text">Deskripsi singkat di sini.</p>
    <a href="#" class="btn btn-primary">Selengkapnya</a>
  </div>
</div>
```

#### Alert

```html
<div class="alert alert-success" role="alert">
  Data berhasil disimpan!
</div>
<div class="alert alert-danger" role="alert">
  Terjadi kesalahan. Coba lagi.
</div>
```

### Contoh: Landing Page Sederhana dengan Bootstrap

```html
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">MyApp</a>
      <div class="navbar-nav ms-auto">
        <a class="nav-link" href="#">Home</a>
        <a class="nav-link" href="#">Fitur</a>
        <a class="nav-link" href="#">Kontak</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="bg-primary text-white py-5 text-center">
    <div class="container">
      <h1 class="display-4 fw-bold">Selamat Datang!</h1>
      <p class="lead">Platform belajar web development terbaik untuk pemula.</p>
      <a href="#" class="btn btn-light btn-lg mt-3">Mulai Sekarang</a>
    </div>
  </section>

  <!-- Kartu Fitur -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">Fitur Unggulan</h2>
      <div class="row g-4">
        <div class="col-12 col-md-4">
          <div class="card h-100 text-center p-3">
            <div class="card-body">
              <h5 class="card-title">🚀 Cepat</h5>
              <p class="card-text">Belajar dengan metode yang efisien dan terstruktur.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="card h-100 text-center p-3">
            <div class="card-body">
              <h5 class="card-title">💡 Mudah</h5>
              <p class="card-text">Materi disusun dari dasar hingga mahir.</p>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="card h-100 text-center p-3">
            <div class="card-body">
              <h5 class="card-title">🎯 Praktis</h5>
              <p class="card-text">Langsung praktek membuat project nyata.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">© 2025 MyApp. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

---

## 🔄 Perbandingan: CSS Murni vs Bootstrap

| Hal | CSS Murni | Bootstrap |
|-----|-----------|-----------|
| Kecepatan | Lebih lambat | Lebih cepat |
| Kontrol | Penuh | Terbatas pada class yang ada |
| File size | Ringan | Lebih berat (CDN) |
| Belajar | Wajib dipahami dulu | Bisa langsung pakai |
| Kustomisasi | Bebas | Perlu override |

> 💡 **Saran:** Pahami CSS murni dulu (seperti yang sudah kamu pelajari di pertemuan 1–3), baru gunakan Bootstrap untuk produktivitas. Dengan begitu kamu tahu *apa yang terjadi di balik layar*.

---

## 🔑 Ringkasan

| Konsep | Kegunaan Utama |
|--------|----------------|
| **Flexbox** | Layout satu arah (baris/kolom), navbar, centering elemen |
| **CSS Grid** | Layout dua arah (baris + kolom), halaman penuh, galeri |
| **Bootstrap** | Komponen siap pakai, responsif cepat, sistem grid 12 kolom |

---

## 📚 Referensi

- [CSS Flexbox — MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_flexible_box_layout)
- [CSS Grid — MDN Web Docs](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_grid_layout)
- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.3/)
- [Flexbox Froggy (game belajar Flexbox)](https://flexboxfroggy.com/)
- [Grid Garden (game belajar CSS Grid)](https://cssgridgarden.com/)

---

*Selamat belajar! 🚀 Dengan Flexbox, Grid, dan Bootstrap, kamu sudah punya semua alat untuk membuat tampilan website yang modern dan profesional.*
