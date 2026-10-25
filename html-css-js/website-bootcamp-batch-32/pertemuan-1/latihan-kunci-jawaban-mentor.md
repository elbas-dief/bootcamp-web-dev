# Kunci Jawaban & Panduan Mentor — HTML & CSS
**Haltev IT Learning Center | Pertemuan 1–4**

> Dokumen ini hanya untuk MENTOR. Jangan dibagikan ke siswa sebelum latihan selesai.

---

## Pertemuan 1 — Kunci Latihan 1A: Halaman Profil Diri

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Budi Santoso</title>
  </head>
  <body>

    <h1>Budi Santoso</h1>

    <h2>Tentang Saya</h2>
    <img src="https://via.placeholder.com/200x200" alt="Foto Profil Budi" />
    <p>
      Halo! Nama saya Budi Santoso, saya berumur 20 tahun dan tinggal di Jakarta.
      Saya sedang belajar web development di Haltev IT Learning Center.
    </p>

    <h2>Hobi</h2>
    <ul>
      <li>Bermain gitar</li>
      <li>Membaca buku fiksi ilmiah</li>
      <li>Belajar coding setiap hari</li>
      <li>Fotografi jalanan</li>
    </ul>

    <h2>Film Favorit (Peringkat)</h2>
    <ol>
      <li>Interstellar</li>
      <li>The Dark Knight</li>
      <li>Parasite</li>
    </ol>

    <h2>Link Favorit</h2>
    <a href="https://developer.mozilla.org" target="_blank">MDN Web Docs — referensi HTML & CSS terbaik</a>

  </body>
</html>
```

**Catatan Mentor:**
- Siswa sering lupa `DOCTYPE` atau `charset` — cek ini pertama
- `alt` di gambar wajib ada — jelaskan fungsinya untuk aksesibilitas
- Pastikan link pakai `target="_blank"` sesuai syarat

---

## Pertemuan 1 — Kunci Latihan 1B: Menu Restoran (Pair)

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <title>Warung Makan Bahagia</title>
  </head>
  <body>

    <h1>Warung Makan Bahagia</h1>
    <img src="https://via.placeholder.com/600x200" alt="Suasana Warung Makan Bahagia" />

    <h2>Makanan Utama</h2>
    <ul>
      <li><strong>Nasi Goreng Spesial</strong> — Best Seller</li>
      <li><em>Ayam Bakar Madu</em> — Rekomendasi Chef</li>
      <li>Soto Betawi</li>
    </ul>

    <h2>Minuman</h2>
    <ul>
      <li>Es Teh Manis</li>
      <li><em>Jus Alpukat</em> — Rekomendasi</li>
      <li>Air Mineral</li>
    </ul>

    <h2>Dessert</h2>
    <ul>
      <li><strong>Es Krim Goreng</strong> — Best Seller</li>
      <li>Puding Coklat</li>
      <li>Pisang Bakar</li>
    </ul>

    <a href="#">Pesan Sekarang</a>

  </body>
</html>
```

**Catatan Mentor untuk Pair Programming:**
- Pantau apakah kedua siswa aktif berkontribusi
- Diskusikan pembagian peran sebelum mulai
- Tanya: "Kenapa `<em>` untuk rekomendasi, bukan `<i>`?" → Jawab: `<em>` punya makna semantik (emphasis), `<i>` hanya visual

---

## Pertemuan 2 — Kunci Latihan 2A: Website 3 Halaman

### index.html
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
    </header>

    <nav>
      <a href="index.html">[Home]</a>
      <a href="about.html">About</a>
      <a href="contact.html">Contact</a>
    </nav>

    <main>
      <section>
        <h2>Selamat Datang!</h2>
        <p>Ini adalah website personal saya. Silakan jelajahi setiap halaman.</p>
      </section>

      <section>
        <h2>Jadwal Belajar</h2>
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
      <p>&copy; 2025 Website Saya</p>
    </footer>

  </body>
</html>
```

### about.html
```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <title>Website Saya - About</title>
  </head>
  <body>

    <header>
      <h1>Website Saya</h1>
    </header>

    <nav>
      <a href="index.html">Home</a>
      <a href="about.html">[About]</a>
      <a href="contact.html">Contact</a>
    </nav>

    <main>
      <section>
        <h2>Tentang Saya</h2>
        <img src="https://via.placeholder.com/200x200" alt="Foto Profil" />
        <p>
          Nama saya Budi. Saya adalah seorang web developer pemula
          yang sedang belajar di Haltev IT Learning Center.
        </p>
      </section>

      <section>
        <h2>Keahlian</h2>
        <ul>
          <li>HTML — Dasar</li>
          <li>CSS — Dasar</li>
          <li>JavaScript — Pemula</li>
        </ul>
      </section>
    </main>

    <footer>
      <p>&copy; 2025 Website Saya</p>
    </footer>

  </body>
</html>
```

### contact.html
```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <title>Website Saya - Contact</title>
  </head>
  <body>

    <header>
      <h1>Website Saya</h1>
    </header>

    <nav>
      <a href="index.html">Home</a>
      <a href="about.html">About</a>
      <a href="contact.html">[Contact]</a>
    </nav>

    <main>
      <section>
        <h2>Hubungi Saya</h2>
        <form action="#" method="POST">

          <label for="nama">Nama:</label><br />
          <input type="text" id="nama" name="nama" placeholder="Nama lengkap" required /><br /><br />

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
      <p>&copy; 2025 Website Saya</p>
    </footer>

  </body>
</html>
```

**Catatan Mentor:**
- Kesalahan umum: lupa `for` dan `id` harus sama di `<label>` dan `<input>`
- `required` pada `type="email"` otomatis validasi format — demo ini ke siswa
- Siswa mungkin bingung kenapa `action="#"` — jelaskan ini akan diisi URL PHP nanti di P9

---

## Pertemuan 3 — Kunci Latihan 3A: Styling Website

```css
/* style.css */

/* Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Arial, sans-serif;
  background-color: #f8f9fa;
  color: #333333;
  line-height: 1.7;
}

header {
  background-color: #2c3e50;
  color: white;
  padding: 20px 32px;
}

header h1 {
  font-size: 22px;
  font-weight: 600;
}

nav {
  background-color: #34495e;
  padding: 12px 32px;
}

nav a {
  color: #ecf0f1;
  text-decoration: none;
  margin-right: 20px;
  font-size: 15px;
  transition: color 0.3s ease;
}

nav a:hover {
  color: #3498db;
}

main {
  max-width: 900px;
  margin: 40px auto;
  padding: 0 24px;
}

section {
  background-color: white;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  padding: 28px;
  margin-bottom: 28px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
  transition: box-shadow 0.3s ease;
}

section:hover {
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
}

h2 {
  font-size: 20px;
  margin-bottom: 16px;
  color: #2c3e50;
  border-bottom: 2px solid #3498db;
  padding-bottom: 8px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 10px 14px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #2c3e50;
  color: white;
}

tr:hover td {
  background-color: #f0f4f8;
}

footer {
  background-color: #2c3e50;
  color: #95a5a6;
  text-align: center;
  padding: 20px;
  font-size: 14px;
  margin-top: 60px;
}
```

---

## Pertemuan 3 — Kunci Latihan 3B: Animasi CSS

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <title>Demo Animasi CSS</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        padding: 40px;
        background: #f0f0f0;
      }

      /* Elemen 1: kotak bergerak */
      @keyframes gerakKiriKanan {
        0%   { transform: translateX(0); }
        50%  { transform: translateX(200px); }
        100% { transform: translateX(0); }
      }

      .kotak-bergerak {
        width: 80px;
        height: 80px;
        background-color: #e74c3c;
        border-radius: 8px;
        animation: gerakKiriKanan 2s ease-in-out infinite;
        margin-bottom: 40px;
      }

      /* Elemen 2: teks ganti warna */
      @keyframes gantiWarna {
        0%   { color: #e74c3c; }
        33%  { color: #3498db; }
        66%  { color: #2ecc71; }
        100% { color: #e74c3c; }
      }

      .teks-warna {
        font-size: 28px;
        font-weight: bold;
        animation: gantiWarna 3s linear infinite;
        margin-bottom: 40px;
      }

      /* Elemen 3: tombol scale */
      .tombol-scale {
        display: inline-block;
        background-color: #3498db;
        color: white;
        padding: 12px 28px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: transform 0.2s ease, background-color 0.2s ease;
        margin-bottom: 40px;
      }

      .tombol-scale:hover {
        transform: scale(1.1);
        background-color: #2980b9;
      }

      /* Bonus: spinner */
      @keyframes putar {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
      }

      .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #ddd;
        border-top-color: #3498db;
        border-radius: 50%;
        animation: putar 0.8s linear infinite;
      }
    </style>
  </head>
  <body>

    <h1>Demo Animasi CSS</h1>

    <h2>1. Kotak Bergerak</h2>
    <div class="kotak-bergerak"></div>

    <h2>2. Teks Ganti Warna</h2>
    <p class="teks-warna">Haltev IT Learning Center</p>

    <h2>3. Tombol Scale Hover</h2>
    <button class="tombol-scale">Hover Saya!</button>

    <h2>Bonus: Loading Spinner</h2>
    <div class="spinner"></div>

  </body>
</html>
```

---

## Pertemuan 4 — Kunci Latihan 4A: Flexbox

```html
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <title>Flexbox Latihan</title>
    <style>
      * { margin: 0; padding: 0; box-sizing: border-box; }

      /* Bagian 1: Navbar */
      nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #1a1a2e;
        padding: 16px 32px;
        color: white;
      }

      .logo {
        font-size: 20px;
        font-weight: bold;
        color: #e94560;
      }

      .menu {
        display: flex;
        gap: 24px;
        list-style: none;
      }

      .menu a {
        color: white;
        text-decoration: none;
        transition: color 0.3s;
      }

      .menu a:hover { color: #e94560; }

      /* Bagian 2: Kartu Berjejer */
      .wrapper-kartu {
        display: flex;
        gap: 24px;
        padding: 40px;
        align-items: stretch;
      }

      .kartu {
        flex: 1;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      }

      /* Bagian 3: Center penuh */
      .center-full {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
        background-color: #f0f4ff;
        margin: 0 40px;
        border-radius: 8px;
      }

      .center-full p {
        font-size: 24px;
        font-weight: bold;
        color: #3498db;
      }
    </style>
  </head>
  <body>

    <!-- Bagian 1 -->
    <nav>
      <div class="logo">MyBrand</div>
      <ul class="menu">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>

    <!-- Bagian 2 -->
    <div class="wrapper-kartu">
      <div class="kartu">
        <h3>Kartu 1</h3>
        <p>Konten kartu pertama. Flexbox membuat semua kartu sama tinggi.</p>
      </div>
      <div class="kartu">
        <h3>Kartu 2</h3>
        <p>Konten lebih panjang di sini untuk mendemonstrasikan align-items: stretch bekerja dengan baik.</p>
      </div>
      <div class="kartu">
        <h3>Kartu 3</h3>
        <p>Kartu ketiga.</p>
      </div>
    </div>

    <!-- Bagian 3 -->
    <div class="center-full">
      <p>Saya tepat di tengah!</p>
    </div>

  </body>
</html>
```

---

## Panduan Troubleshooting Umum

| Masalah Siswa | Kemungkinan Penyebab | Solusi |
|--------------|---------------------|--------|
| CSS tidak berpengaruh | `<link>` salah atau path file CSS salah | Cek path file, cek di DevTools (F12) → Console |
| Gambar tidak muncul | Path `src` salah atau file tidak ada | Cek nama file (case-sensitive di server Linux) |
| Form terkirim tapi salah halaman | `action` di form masih `#` | Untuk P2 ini wajar — nanti diisi di PHP |
| Navbar tidak flex | Lupa `display: flex` di container | Tambahkan ke parent element, bukan child |
| Bootstrap tidak berfungsi | CDN link salah atau tidak ada internet | Cek link, coba download Bootstrap lokal |
| Animasi tidak jalan | Nama `@keyframes` tidak cocok dengan `animation` | Pastikan nama identik, perhatikan typo |
| Box model ukuran meleset | Tidak pakai `box-sizing: border-box` | Tambahkan `* { box-sizing: border-box }` |

---

## Catatan Waktu & Pacing

| Aktivitas | Durasi Ideal |
|-----------|-------------|
| Penjelasan konsep | 25-30 menit |
| Demo live coding mentor | 15 menit |
| Latihan mandiri siswa | 30-40 menit |
| Review & pair programming | 20 menit |
| Sisa buffer / tanya jawab | 10 menit |

> **Tips:** Jangan beri jawaban langsung saat siswa stuck. Tanya balik: "Kamu mau elemen apa yang berubah?" dan "CSS kamu sudah dihubungkan ke HTML belum?"

---

*Dokumen Mentor — Haltev IT Learning Center*
