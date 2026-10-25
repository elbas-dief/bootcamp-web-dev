# Modul Pengajaran: HTML & CSS Dasar
**Haltev IT Learning Center — Web Development**
**Pertemuan 2 | Tools: VS Code + Chrome**

---

## Pertemuan 2 — Basic HTML 2 & Multi-Page

### Tujuan Pembelajaran
Siswa mampu membuat website multi-halaman (Home, About, Contact) dengan form, table, dan semantic HTML.

---

### Struktur Folder Project

```
website-ku/
├── index.html       ← Halaman Home
├── about.html       ← Halaman About
├── contact.html     ← Halaman Contact
└── images/
    └── foto.jpg
```

> **Penting:** `index.html` adalah nama standar untuk halaman utama.

---

### Semantic HTML

Semantic HTML = tag yang **menjelaskan maknanya**, bukan hanya tampilannya.

```html
<!-- BUKAN semantic (tidak bermakna) -->
<div id="header">...</div>
<div id="nav">...</div>

<!-- Semantic (bermakna) -->
<header>...</header>
<nav>...</nav>
<main>...</main>
<section>...</section>
<article>...</article>
<aside>...</aside>
<footer>...</footer>
```

| Tag | Fungsi |
|-----|--------|
| `<header>` | Bagian atas halaman / section |
| `<nav>` | Menu navigasi |
| `<main>` | Konten utama halaman |
| `<section>` | Kelompok konten bertema |
| `<article>` | Konten mandiri (berita, blog post) |
| `<aside>` | Konten sampingan (sidebar) |
| `<footer>` | Bagian bawah halaman |

---

### Navigasi Antar Halaman

```html
<nav>
  <a href="index.html">Home</a>
  <a href="about.html">About</a>
  <a href="contact.html">Contact</a>
</nav>
```

---

### Table (Tabel)

```html
<table border="1">
  <thead>
    <!-- Baris judul kolom -->
    <tr>
      <th>Nama</th>
      <th>Umur</th>
      <th>Kota</th>
    </tr>
  </thead>
  <tbody>
    <!-- Baris data -->
    <tr>
      <td>Budi</td>
      <td>20</td>
      <td>Jakarta</td>
    </tr>
    <tr>
      <td>Ani</td>
      <td>22</td>
      <td>Bandung</td>
    </tr>
  </tbody>
</table>
```

| Tag | Fungsi |
|-----|--------|
| `<table>` | Wadah tabel |
| `<thead>` | Bagian kepala tabel |
| `<tbody>` | Bagian isi tabel |
| `<tr>` | Table Row (baris) |
| `<th>` | Table Header (sel judul) |
| `<td>` | Table Data (sel data) |

---

### Form (Formulir)

```html
<form action="proses.php" method="POST">

  <!-- Input teks -->
  <label for="nama">Nama Lengkap:</label>
  <input type="text" id="nama" name="nama" placeholder="Masukkan nama..." required />

  <!-- Input email -->
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" placeholder="email@contoh.com" />

  <!-- Input password -->
  <label for="password">Password:</label>
  <input type="password" id="password" name="password" />

  <!-- Radio button -->
  <p>Jenis Kelamin:</p>
  <input type="radio" id="laki" name="gender" value="L" />
  <label for="laki">Laki-laki</label>
  <input type="radio" id="perempuan" name="gender" value="P" />
  <label for="perempuan">Perempuan</label>

  <!-- Checkbox -->
  <input type="checkbox" id="setuju" name="setuju" />
  <label for="setuju">Saya setuju dengan syarat dan ketentuan</label>

  <!-- Dropdown -->
  <label for="kota">Kota:</label>
  <select id="kota" name="kota">
    <option value="">-- Pilih Kota --</option>
    <option value="jakarta">Jakarta</option>
    <option value="bandung">Bandung</option>
    <option value="surabaya">Surabaya</option>
  </select>

  <!-- Textarea -->
  <label for="pesan">Pesan:</label>
  <textarea id="pesan" name="pesan" rows="5" placeholder="Tulis pesan..."></textarea>

  <!-- Tombol submit -->
  <button type="submit">Kirim</button>

</form>
```

---

### Contoh Lengkap: index.html (Halaman Home)

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <title>Website Saya - Home</title>
  </head>
  <body>

    <header>
      <h1>Website Saya</h1>
      <nav>
        <a href="index.html">Home</a> |
        <a href="about.html">About</a> |
        <a href="contact.html">Contact</a>
      </nav>
    </header>

    <main>
      <section>
        <h2>Selamat Datang!</h2>
        <p>Ini adalah halaman utama website saya.</p>
      </section>

      <section>
        <h2>Jadwal Kelas</h2>
        <table border="1">
          <thead>
            <tr>
              <th>Hari</th>
              <th>Mata Pelajaran</th>
              <th>Jam</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Senin</td>
              <td>HTML Dasar</td>
              <td>09:00 - 11:00</td>
            </tr>
            <tr>
              <td>Rabu</td>
              <td>CSS Dasar</td>
              <td>09:00 - 11:00</td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>

    <footer>
      <p>&copy; 2025 Website Saya. Hak cipta dilindungi.</p>
    </footer>

  </body>
</html>
```

---

*Modul ini adalah bagian dari kurikulum AI-Enhanced Website Fullstack Reguler — Haltev IT Learning Center*
