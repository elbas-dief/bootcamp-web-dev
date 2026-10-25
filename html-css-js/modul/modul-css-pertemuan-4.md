# Modul Pengajaran: HTML & CSS Dasar
**Haltev IT Learning Center — Web Development**
**Pertemuan 4 | Tools: VS Code + Chrome**

---

## Pertemuan 4 — Basic CSS 2

### Tujuan Pembelajaran
Siswa mampu membuat landing page modern dan responsive menggunakan Flexbox, Grid, dan Bootstrap.

---

### Flexbox

Flexbox = **satu dimensi** (baris ATAU kolom). Sempurna untuk navigasi, kartu berjejer, centering.

```css
.container-flex {
  display: flex;

  /* Arah utama */
  flex-direction: row;         /* row | row-reverse | column | column-reverse */

  /* Penyelarasan di sumbu utama (horizontal jika row) */
  justify-content: center;     /* flex-start | flex-end | center | space-between | space-around | space-evenly */

  /* Penyelarasan di sumbu silang (vertikal jika row) */
  align-items: center;         /* flex-start | flex-end | center | stretch | baseline */

  /* Wrap jika item tidak muat */
  flex-wrap: wrap;             /* nowrap | wrap */

  /* Jarak antar item */
  gap: 16px;
}

/* Child item */
.item-flex {
  flex: 1;        /* item mengisi ruang sisa secara merata */
  flex: 0 0 200px; /* tidak grow, tidak shrink, lebar 200px */
}
```

**Contoh: Navbar dengan Flexbox**

```css
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px 32px;
  background-color: #1a1a2e;
}
```

**Contoh: Centering elemen**

```css
.center-box {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh; /* tinggi penuh layar */
}
```

---

### CSS Grid

Grid = **dua dimensi** (baris DAN kolom). Sempurna untuk layout halaman utama.

```css
.container-grid {
  display: grid;

  /* Definisi kolom */
  grid-template-columns: 1fr 1fr 1fr;        /* 3 kolom sama lebar */
  grid-template-columns: 200px 1fr;           /* sidebar 200px + konten fleksibel */
  grid-template-columns: repeat(3, 1fr);      /* sama dengan 1fr 1fr 1fr */

  /* Definisi baris */
  grid-template-rows: auto;

  /* Jarak antar sel */
  gap: 24px;
  column-gap: 24px;
  row-gap: 16px;
}

/* Item yang membentang beberapa kolom/baris */
.item-lebar {
  grid-column: span 2;  /* bentang 2 kolom */
  grid-row: span 2;     /* bentang 2 baris */
}
```

**Contoh: Grid 3 Kolom untuk Kartu**

```css
.galeri-kartu {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}

/* Responsive: 1 kolom di layar kecil */
@media (max-width: 768px) {
  .galeri-kartu {
    grid-template-columns: 1fr;
  }
}
```

---

### Responsive Design dengan Media Query

```css
/* Berlaku untuk SEMUA ukuran */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Layar tablet ke bawah (≤ 768px) */
@media (max-width: 768px) {
  .galeri-kartu {
    grid-template-columns: 1fr 1fr;
  }
}

/* Layar HP (≤ 480px) */
@media (max-width: 480px) {
  .galeri-kartu {
    grid-template-columns: 1fr;
  }

  nav {
    flex-direction: column;
    gap: 12px;
  }
}
```

---

### Bootstrap

Bootstrap adalah **framework CSS** yang menyediakan komponen siap pakai.

#### Cara Memasang Bootstrap (via CDN)

Tambahkan ini di `<head>` sebelum `</head>`:

```html
<!-- Bootstrap CSS -->
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
  rel="stylesheet"
/>

<!-- Bootstrap JS (opsional, untuk komponen interaktif) -->
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  defer
></script>
```

#### Sistem Grid Bootstrap

Bootstrap pakai grid **12 kolom**:

```html
<div class="container">
  <div class="row">
    <!-- Kolom 4+4+4 = 12 -->
    <div class="col-md-4">Kolom 1</div>
    <div class="col-md-4">Kolom 2</div>
    <div class="col-md-4">Kolom 3</div>
  </div>
  <div class="row">
    <!-- Kolom 8+4 = 12 -->
    <div class="col-md-8">Konten Utama</div>
    <div class="col-md-4">Sidebar</div>
  </div>
</div>
```

**Kelas Kolom Responsive:**

| Kelas | Berlaku di |
|-------|-----------|
| `col-` | Semua ukuran |
| `col-sm-` | ≥ 576px (HP landscape) |
| `col-md-` | ≥ 768px (Tablet) |
| `col-lg-` | ≥ 992px (Desktop) |
| `col-xl-` | ≥ 1200px (Desktop besar) |

#### Komponen Bootstrap yang Sering Dipakai

**Navbar:**
```html
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>
```

**Button:**
```html
<button class="btn btn-primary">Primary</button>
<button class="btn btn-secondary">Secondary</button>
<button class="btn btn-success">Success</button>
<button class="btn btn-danger">Danger</button>
<button class="btn btn-outline-primary">Outline</button>
```

**Card:**
```html
<div class="card" style="width: 18rem;">
  <img src="gambar.jpg" class="card-img-top" alt="..." />
  <div class="card-body">
    <h5 class="card-title">Judul Kartu</h5>
    <p class="card-text">Deskripsi singkat tentang kartu ini.</p>
    <a href="#" class="btn btn-primary">Selengkapnya</a>
  </div>
</div>
```

**Utility Classes yang Berguna:**
```html
<!-- Text -->
<p class="text-center">Tengah</p>
<p class="text-muted">Abu-abu</p>
<p class="fw-bold">Tebal</p>

<!-- Spacing: m = margin, p = padding, t/b/s/e = top/bottom/start/end -->
<div class="mt-3 mb-4 px-3 py-2">...</div>

<!-- Display -->
<div class="d-flex justify-content-between align-items-center">...</div>

<!-- Background & Text color -->
<div class="bg-primary text-white p-3">...</div>
```

---

### Contoh Lengkap: Landing Page dengan Bootstrap

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Haltev Learning - Landing Page</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      /* Custom CSS di atas Bootstrap */
      .hero {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        color: white;
        min-height: 100vh;
        display: flex;
        align-items: center;
      }

      .hero h1 {
        font-size: 3rem;
        font-weight: 700;
      }

      .kartu-fitur {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }

      .kartu-fitur:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
      }

      .icon-besar {
        font-size: 2.5rem;
        margin-bottom: 16px;
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand fw-bold" href="#">Haltev</a>
        <button class="navbar-toggler" type="button"
          data-bs-toggle="collapse" data-bs-target="#navMenu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
            <li class="nav-item"><a class="nav-link" href="#daftar">Daftar</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h1>Belajar Coding<br /><span class="text-warning">Bersama AI</span></h1>
            <p class="lead mt-3 text-light">
              Kuasai web development fullstack dengan metode modern
              dan bantuan kecerdasan buatan.
            </p>
            <a href="#daftar" class="btn btn-warning btn-lg mt-3 me-2">Daftar Sekarang</a>
            <a href="#fitur" class="btn btn-outline-light btn-lg mt-3">Pelajari Lebih</a>
          </div>
          <div class="col-lg-6 text-center mt-5 mt-lg-0">
            <img
              src="https://via.placeholder.com/500x400"
              alt="Ilustrasi belajar coding"
              class="img-fluid rounded"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Fitur Section -->
    <section class="py-5" id="fitur">
      <div class="container">
        <h2 class="text-center mb-5">Kenapa Pilih Haltev?</h2>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card h-100 text-center p-4 kartu-fitur">
              <div class="icon-besar">🎯</div>
              <h5>Kurikulum Terstruktur</h5>
              <p class="text-muted">16 pertemuan dari dasar hingga mahir, disusun oleh para praktisi.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100 text-center p-4 kartu-fitur">
              <div class="icon-besar">🤖</div>
              <h5>AI-Assisted Learning</h5>
              <p class="text-muted">Belajar lebih cepat 2-3x dengan bantuan AI sebagai asisten coding.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100 text-center p-4 kartu-fitur">
              <div class="icon-besar">💼</div>
              <h5>Portofolio Nyata</h5>
              <p class="text-muted">Selesaikan 2 proyek nyata yang bisa langsung masuk portofolio.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Form Pendaftaran -->
    <section class="py-5 bg-light" id="daftar">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h2 class="text-center mb-4">Daftar Sekarang</h2>
            <form>
              <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" placeholder="Masukkan nama..." />
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="email@contoh.com" />
              </div>
              <div class="mb-3">
                <label class="form-label">No. WhatsApp</label>
                <input type="tel" class="form-control" placeholder="08xxxxxxxxxx" />
              </div>
              <button type="submit" class="btn btn-primary w-100 btn-lg">Kirim Pendaftaran</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
      <p class="mb-0">&copy; 2025 Haltev IT Learning Center. Hak cipta dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
```

---

*Modul ini adalah bagian dari kurikulum AI-Enhanced Website Fullstack Reguler — Haltev IT Learning Center*
