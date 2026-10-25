# Modul Pengajaran: HTML & CSS Dasar
**Haltev IT Learning Center — Web Development**
**Pertemuan 1 | Tools: VS Code + Chrome**

---

## Pertemuan 1 — Basic HTML 1

### Tujuan Pembelajaran
Siswa mampu membuat halaman web statis sederhana dengan struktur HTML yang benar.

---

### Konsep: Apa itu HTML?

**HTML** (HyperText Markup Language) adalah bahasa yang digunakan untuk membuat struktur halaman web. HTML terdiri dari **tag** yang membungkus konten.

Analogi: HTML adalah **kerangka rumah** — menentukan di mana ada pintu, jendela, dinding.

---

### Struktur Dasar HTML

Setiap file HTML harus memiliki struktur ini:

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <!-- Informasi tentang halaman (tidak tampil di layar) -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Judul Halaman</title>
  </head>
  <body>
    <!-- Konten yang tampil di browser -->
    <h1>Halo Dunia!</h1>
  </body>
</html>
```

| Bagian | Fungsi |
|--------|--------|
| `<!DOCTYPE html>` | Memberitahu browser ini adalah HTML5 |
| `<html>` | Root/akar dari seluruh halaman |
| `<head>` | Metadata: judul, charset, link CSS |
| `<body>` | Konten yang tampil di layar |

---

### Tag-Tag Dasar

#### Heading (Judul)
```html
<h1>Judul Terbesar</h1>
<h2>Sub Judul</h2>
<h3>Sub Sub Judul</h3>
<!-- h1 sampai h6, makin besar angka makin kecil teksnya -->
```
> **Aturan:** Gunakan hanya **satu `<h1>`** per halaman (untuk SEO).

#### Paragraph
```html
<p>Ini adalah sebuah paragraf teks biasa.</p>
<p>Paragraf baru otomatis ada jarak di antara mereka.</p>
```

#### List (Daftar)
```html
<!-- Unordered List — pakai bullet point -->
<ul>
  <li>Apel</li>
  <li>Mangga</li>
  <li>Jeruk</li>
</ul>

<!-- Ordered List — pakai nomor -->
<ol>
  <li>Langkah pertama</li>
  <li>Langkah kedua</li>
  <li>Langkah ketiga</li>
</ol>
```

#### Image (Gambar)
```html
<!-- src = lokasi gambar, alt = teks pengganti jika gambar gagal load -->
<img src="foto.jpg" alt="Deskripsi gambar" width="300" />

<!-- Gambar dari internet -->
<img src="https://via.placeholder.com/300x200" alt="Gambar placeholder" />
```
> **Penting:** Tag `<img>` adalah **self-closing** — tidak ada tag penutup.

#### Link (Tautan)
```html
<!-- Link ke halaman lain -->
<a href="https://google.com">Pergi ke Google</a>

<!-- Link ke halaman di folder yang sama -->
<a href="about.html">Tentang Kami</a>

<!-- Buka link di tab baru -->
<a href="https://google.com" target="_blank">Buka di Tab Baru</a>
```

---

### Contoh Lengkap Pertemuan 1

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <title>Profil Saya</title>
  </head>
  <body>
    <h1>Halo, Saya Budi!</h1>

    <h2>Tentang Saya</h2>
    <p>
      Nama saya Budi Santoso. Saya adalah siswa kelas web development
      di Haltev IT Learning Center.
    </p>

    <img src="https://via.placeholder.com/200x200" alt="Foto Budi" />

    <h2>Hobi Saya</h2>
    <ul>
      <li>Membaca buku</li>
      <li>Bermain game</li>
      <li>Belajar coding</li>
    </ul>

    <h2>Makanan Favorit (Peringkat)</h2>
    <ol>
      <li>Nasi Goreng</li>
      <li>Mie Ayam</li>
      <li>Soto Betawi</li>
    </ol>

    <h2>Link Favorit</h2>
    <a href="https://google.com" target="_blank">Google</a>
  </body>
</html>
```

---

### Tips VS Code
- Ketik `!` lalu tekan `Tab` → struktur HTML otomatis muncul (Emmet)
- `Ctrl + S` untuk simpan
- Klik kanan file di VS Code → **Open with Live Server** untuk preview langsung

---

*Modul ini adalah bagian dari kurikulum AI-Enhanced Website Fullstack Reguler — Haltev IT Learning Center*
