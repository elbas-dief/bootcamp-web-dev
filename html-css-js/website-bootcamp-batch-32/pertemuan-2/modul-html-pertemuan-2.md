# Modul Pengajaran: HTML Lanjutan & Multi-Page
**Haltev IT Learning Center — Web Development**
**Pertemuan 2 | Tools: VS Code + Chrome**

---

## Tujuan Pembelajaran

Siswa mampu membuat website multi-halaman (Home, About, Contact) dengan navigasi yang berfungsi, tabel data, form interaktif, dan struktur HTML yang semantik.

---

## Daftar Isi

- [Recap Pertemuan 1](#recap-pertemuan-1)
- [Semantic HTML](#semantic-html)
- [Struktur Folder Multi-Page](#struktur-folder-multi-page)
- [Navigasi Antar Halaman](#navigasi-antar-halaman)
- [Tabel HTML](#tabel-html)
- [Form HTML](#form-html)
- [Contoh Lengkap](#contoh-lengkap)
- [Tips VS Code](#tips-vs-code)

---

## Recap Pertemuan 1

Sebelum mulai, pastikan kamu sudah paham ini:

| Konsep | Tag |
|--------|-----|
| Struktur dasar | `<!DOCTYPE>`, `<html>`, `<head>`, `<body>` |
| Judul | `<h1>` sampai `<h6>` |
| Paragraf | `<p>` |
| Daftar | `<ul>`, `<ol>`, `<li>` |
| Gambar | `<img src="" alt="">` |
| Link | `<a href="">` |

---

## Semantic HTML

### Apa itu Semantic HTML?

**Semantic** artinya "bermakna". Semantic HTML adalah penggunaan tag yang **menjelaskan fungsinya**, bukan hanya tampilannya.

Analogi: Bayangkan sebuah koran — ada bagian **judul besar** di atas, **navigasi** menu kanan/kiri, **isi berita** di tengah, dan **footer** kecil di bawah. HTML semantik membantu browser (dan Google) mengerti bagian mana yang mana.

```html
<!-- ❌ Bukan Semantic — pakai div saja, tidak bermakna -->
<div id="header">...</div>
<div id="nav">...</div>
<div id="konten">...</div>
<div id="footer">...</div>

<!-- ✅ Semantic — tag menjelaskan fungsinya -->
<header>...</header>
<nav>...</nav>
<main>...</main>
<footer>...</footer>
```

### Tag Semantic yang Wajib Diketahui

| Tag | Fungsi | Digunakan untuk |
|-----|--------|-----------------|
| `<header>` | Bagian atas halaman | Logo, judul website, navbar |
| `<nav>` | Menu navigasi | Kumpulan link antar halaman |
| `<main>` | Konten utama | Isi halaman yang paling penting |
| `<section>` | Kelompok konten bertema | Membagi konten jadi bagian-bagian |
| `<article>` | Konten mandiri | Berita, blog post, komentar |
| `<aside>` | Konten sampingan | Sidebar, iklan, info tambahan |
| `<footer>` | Bagian bawah halaman | Copyright, link sosial media |

```html
<body>

  <header>
    <h1>Nama Website</h1>
  </header>

  <nav>
    <a href="index.html">Home</a>
    <a href="about.html">About</a>
    <a href="contact.html">Contact</a>
  </nav>

  <main>
    <section>
      <h2>Selamat Datang</h2>
      <p>Ini adalah konten utama halaman.</p>
    </section>

    <aside>
      <p>Info tambahan atau sidebar di sini.</p>
    </aside>
  </main>

  <footer>
    <p>&copy; 2025 Nama Website. Hak cipta dilindungi.</p>
  </footer>

</body>
```

> **Kenapa Semantic Penting?**
> 1. **SEO** — Google lebih mudah memahami isi halaman kamu
> 2. **Aksesibilitas** — Screen reader untuk tunanetra bisa membaca halaman dengan benar
> 3. **Keterbacaan kode** — Programmer lain (atau kamu sendiri bulan depan) lebih mudah memahami kode

---

## Struktur Folder Multi-Page

Website yang baik memisahkan setiap halaman ke dalam file `.html` yang berbeda.

```
website-ku/
├── index.html       ← Halaman utama (WAJIB bernama index)
├── about.html       ← Halaman tentang
├── contact.html     ← Halaman kontak
└── images/
    └── foto.jpg     ← Folder khusus gambar
```

> **Aturan penting:** `index.html` adalah nama standar untuk halaman utama. Browser secara otomatis mencari file bernama `index.html` saat membuka sebuah folder.

---

## Navigasi Antar Halaman

Gunakan tag `<a>` dengan `href` yang mengarah ke file HTML lain di folder yang sama.

```html
<nav>
  <!-- Link ke file di folder yang sama -->
  <a href="index.html">Home</a>
  <a href="about.html">About</a>
  <a href="contact.html">Contact</a>
</nav>
```

### Tips Navigasi

```html
<!-- Tandai halaman yang sedang aktif agar pengguna tahu posisinya -->

<!-- Di index.html -->
<nav>
  <a href="index.html"><strong>Home</strong></a>  <!-- Bold = aktif -->
  <a href="about.html">About</a>
  <a href="contact.html">Contact</a>
</nav>

<!-- Di about.html -->
<nav>
  <a href="index.html">Home</a>
  <a href="about.html"><strong>About</strong></a>  <!-- Bold = aktif -->
  <a href="contact.html">Contact</a>
</nav>
```

---

## Tabel HTML

Tabel digunakan untuk menampilkan **data yang terstruktur** dalam baris dan kolom.

### Anatomi Tabel

```html
<table border="1">

  <!-- THEAD: Baris judul kolom -->
  <thead>
    <tr>
      <th>Nama</th>
      <th>Umur</th>
      <th>Kota</th>
    </tr>
  </thead>

  <!-- TBODY: Baris data -->
  <tbody>
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

### Penjelasan Tag Tabel

| Tag | Singkatan | Fungsi |
|-----|-----------|--------|
| `<table>` | — | Wadah/container tabel |
| `<thead>` | Table Head | Bagian kepala tabel (judul kolom) |
| `<tbody>` | Table Body | Bagian isi/data tabel |
| `<tr>` | Table Row | Satu baris tabel |
| `<th>` | Table Header | Sel judul (otomatis **bold** dan centered) |
| `<td>` | Table Data | Sel data biasa |

### Penggabungan Sel

```html
<!-- colspan: sel melebar ke samping (gabung kolom) -->
<tr>
  <td colspan="2">Sel ini menempati 2 kolom</td>
  <td>Kolom 3</td>
</tr>

<!-- rowspan: sel memanjang ke bawah (gabung baris) -->
<tr>
  <td rowspan="2">Sel ini menempati 2 baris</td>
  <td>Data B</td>
</tr>
<tr>
  <td>Data C</td>
</tr>
```

### Contoh Tabel Jadwal

```html
<table border="1">
  <thead>
    <tr>
      <th colspan="3">Jadwal Kelas Web Development</th>
    </tr>
    <tr>
      <th>Pertemuan</th>
      <th>Materi</th>
      <th>Durasi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Basic HTML 1</td>
      <td>2 jam</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Basic HTML 2 & Multi-Page</td>
      <td>2 jam</td>
    </tr>
    <tr>
      <td>3</td>
      <td>Basic CSS 1</td>
      <td>2 jam</td>
    </tr>
  </tbody>
</table>
```

---

## Form HTML

Form digunakan untuk **mengumpulkan input dari pengguna** — seperti formulir pendaftaran, login, atau kontak.

### Struktur Dasar Form

```html
<form action="proses.php" method="POST">
  <!-- Elemen form di sini -->
  <button type="submit">Kirim</button>
</form>
```

| Atribut | Fungsi |
|---------|--------|
| `action` | URL tujuan data dikirim (untuk sekarang pakai `#`) |
| `method` | Cara pengiriman: `GET` (data tampil di URL) atau `POST` (data tersembunyi) |

### Jenis-Jenis Input

#### 1. Input Teks Biasa

```html
<label for="nama">Nama Lengkap:</label>
<input type="text" id="nama" name="nama" placeholder="Masukkan nama..." required />
```

> **Penting:** Nilai `for` di `<label>` harus sama dengan `id` di `<input>`. Ini menghubungkan label ke input-nya.

#### 2. Input Email

```html
<label for="email">Email:</label>
<input type="email" id="email" name="email" placeholder="email@contoh.com" />
```

> Browser otomatis memvalidasi format email yang benar!

#### 3. Input Password

```html
<label for="password">Password:</label>
<input type="password" id="password" name="password" />
```

#### 4. Input Nomor

```html
<label for="umur">Umur:</label>
<input type="number" id="umur" name="umur" min="1" max="100" />
```

#### 5. Radio Button (Pilih Satu)

```html
<p>Jenis Kelamin:</p>
<input type="radio" id="laki" name="gender" value="L" />
<label for="laki">Laki-laki</label>

<input type="radio" id="perempuan" name="gender" value="P" />
<label for="perempuan">Perempuan</label>
```

> **Penting:** Semua radio button dalam satu kelompok harus punya `name` yang **sama** agar hanya satu yang bisa dipilih.

#### 6. Checkbox (Pilih Banyak)

```html
<input type="checkbox" id="html" name="keahlian" value="html" />
<label for="html">HTML</label>

<input type="checkbox" id="css" name="keahlian" value="css" />
<label for="css">CSS</label>

<input type="checkbox" id="js" name="keahlian" value="js" />
<label for="js">JavaScript</label>
```

#### 7. Dropdown (Select)

```html
<label for="kota">Kota Asal:</label>
<select id="kota" name="kota">
  <option value="">-- Pilih Kota --</option>
  <option value="jakarta">Jakarta</option>
  <option value="bandung">Bandung</option>
  <option value="surabaya">Surabaya</option>
  <option value="yogyakarta">Yogyakarta</option>
</select>
```

#### 8. Textarea (Teks Panjang)

```html
<label for="pesan">Pesan:</label>
<textarea id="pesan" name="pesan" rows="5" cols="40" placeholder="Tulis pesanmu di sini..."></textarea>
```

#### 9. Tombol Submit

```html
<button type="submit">Kirim Pesan</button>

<!-- Atau pakai input -->
<input type="submit" value="Kirim Pesan" />
```

### Form Lengkap: Contoh Form Kontak

```html
<form action="#" method="POST">

  <label for="nama">Nama Lengkap:</label><br />
  <input type="text" id="nama" name="nama" placeholder="Nama lengkap kamu" required /><br /><br />

  <label for="email">Email:</label><br />
  <input type="email" id="email" name="email" placeholder="email@contoh.com" required /><br /><br />

  <label for="subjek">Subjek:</label><br />
  <input type="text" id="subjek" name="subjek" placeholder="Topik pesan" /><br /><br />

  <p>Kategori Pesan:</p>
  <input type="radio" id="pertanyaan" name="kategori" value="pertanyaan" />
  <label for="pertanyaan">Pertanyaan</label>
  <input type="radio" id="saran" name="kategori" value="saran" />
  <label for="saran">Saran</label>
  <input type="radio" id="lainnya" name="kategori" value="lainnya" />
  <label for="lainnya">Lainnya</label><br /><br />

  <label for="pesan">Pesan:</label><br />
  <textarea id="pesan" name="pesan" rows="5" placeholder="Tulis pesanmu..."></textarea><br /><br />

  <input type="checkbox" id="setuju" name="setuju" required />
  <label for="setuju">Saya setuju dengan syarat dan ketentuan</label><br /><br />

  <button type="submit">Kirim Pesan</button>

</form>
```

---

## Contoh Lengkap

### index.html (Halaman Home)

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website Saya - Home</title>
  </head>
  <body>

    <header>
      <h1>Website Saya</h1>
      <p>Selamat datang di website personal saya.</p>
    </header>

    <nav>
      <a href="index.html"><strong>Home</strong></a> |
      <a href="about.html">About</a> |
      <a href="contact.html">Contact</a>
    </nav>

    <main>
      <section>
        <h2>Selamat Datang!</h2>
        <p>Ini adalah halaman utama website saya yang dibuat menggunakan HTML murni.</p>
      </section>

      <section>
        <h2>Jadwal Belajar Saya</h2>
        <table border="1">
          <thead>
            <tr>
              <th>Hari</th>
              <th>Topik</th>
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
            <tr>
              <td>Jumat</td>
              <td>JavaScript</td>
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

### about.html (Halaman About)

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website Saya - About</title>
  </head>
  <body>

    <header>
      <h1>Website Saya</h1>
    </header>

    <nav>
      <a href="index.html">Home</a> |
      <a href="about.html"><strong>About</strong></a> |
      <a href="contact.html">Contact</a>
    </nav>

    <main>
      <section>
        <h2>Tentang Saya</h2>
        <img src="images/foto.jpg" alt="Foto Profil" width="200" />
        <p>
          Halo! Nama saya Budi. Saya adalah seorang web developer pemula
          yang sedang belajar di Haltev IT Learning Center.
        </p>
      </section>

      <section>
        <h2>Keahlian Saya</h2>
        <ul>
          <li>HTML — Dasar</li>
          <li>CSS — Sedang Belajar</li>
          <li>JavaScript — Akan Dipelajari</li>
        </ul>
      </section>

      <aside>
        <h3>Info Tambahan</h3>
        <p>Saya berasal dari Jakarta dan suka belajar hal-hal baru.</p>
      </aside>
    </main>

    <footer>
      <p>&copy; 2025 Website Saya. Hak cipta dilindungi.</p>
    </footer>

  </body>
</html>
```

### contact.html (Halaman Contact)

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website Saya - Contact</title>
  </head>
  <body>

    <header>
      <h1>Website Saya</h1>
    </header>

    <nav>
      <a href="index.html">Home</a> |
      <a href="about.html">About</a> |
      <a href="contact.html"><strong>Contact</strong></a>
    </nav>

    <main>
      <section>
        <h2>Hubungi Saya</h2>
        <p>Punya pertanyaan? Isi form di bawah ini dan saya akan balas secepatnya.</p>

        <form action="#" method="POST">

          <label for="nama">Nama Lengkap:</label><br />
          <input type="text" id="nama" name="nama" placeholder="Nama lengkap kamu" required /><br /><br />

          <label for="email">Email:</label><br />
          <input type="email" id="email" name="email" placeholder="email@contoh.com" required /><br /><br />

          <label for="subjek">Subjek:</label><br />
          <input type="text" id="subjek" name="subjek" placeholder="Topik pesan" /><br /><br />

          <label for="pesan">Pesan:</label><br />
          <textarea id="pesan" name="pesan" rows="5" placeholder="Tulis pesanmu..."></textarea><br /><br />

          <button type="submit">Kirim Pesan</button>

        </form>
      </section>
    </main>

    <footer>
      <p>&copy; 2025 Website Saya. Hak cipta dilindungi.</p>
    </footer>

  </body>
</html>
```

---

## Tips VS Code

- Ketik `!` lalu tekan `Tab` → struktur HTML lengkap otomatis muncul (Emmet)
- Ketik `table>thead>tr>th*3` lalu `Tab` → struktur tabel otomatis
- Ketik `form>label+input` lalu `Tab` → label dan input otomatis berpasangan
- `Ctrl + D` → pilih kata yang sama sekaligus (berguna untuk edit banyak `id` dan `name`)
- Klik kanan file → **Open with Live Server** untuk preview langsung di browser
- `Alt + Shift + F` → auto format/rapikan kode

---

## Kesalahan Umum yang Sering Terjadi

| Kesalahan | Contoh Salah | Contoh Benar |
|-----------|-------------|--------------|
| `for` dan `id` tidak cocok | `<label for="nama">` + `<input id="nm">` | `<label for="nama">` + `<input id="nama">` |
| Lupa tutup tag tabel | `<tr><td>Data` | `<tr><td>Data</td></tr>` |
| Radio button tidak satu grup | `name="gender1"` dan `name="gender2"` | Keduanya `name="gender"` |
| Link antar halaman salah path | `href="pages/about.html"` (padahal di folder sama) | `href="about.html"` |
| Lupa `required` di field penting | `<input type="text">` | `<input type="text" required>` |

---

*Modul ini adalah bagian dari kurikulum AI-Enhanced Website Fullstack Reguler — Haltev IT Learning Center*
