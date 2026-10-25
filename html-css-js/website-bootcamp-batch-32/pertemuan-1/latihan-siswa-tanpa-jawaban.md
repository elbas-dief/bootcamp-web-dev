# Latihan Praktik — HTML & CSS (Untuk Siswa)
**Haltev IT Learning Center | Pertemuan 1–4**

> Kerjakan sendiri dulu. Tanya mentor hanya setelah mencoba minimal 10 menit.

---

## Pertemuan 1 — Latihan HTML Dasar

### Latihan 1A: Halaman Profil Diri
**Waktu:** 30 menit | **Tingkat:** Pemula

Buat file `profil.html` yang menampilkan informasi tentang dirimu sendiri.

**Syarat wajib:**
- [ ] Struktur HTML lengkap (`DOCTYPE`, `html`, `head`, `body`)
- [ ] Tag `<title>` berisi namamu
- [ ] Satu `<h1>` dengan nama lengkapmu
- [ ] `<h2>` untuk setiap bagian
- [ ] `<p>` berisi deskripsi singkat tentang dirimu (min. 2 kalimat)
- [ ] `<img>` dengan gambar (boleh pakai placeholder: `https://via.placeholder.com/200x200`)
- [ ] `<ul>` berisi min. 3 hobbymu
- [ ] `<ol>` berisi 3 makanan/film/lagu favoritmu (diurutkan)
- [ ] `<a>` dengan link ke website favoritmu (buka di tab baru)

**Bagian yang harus ada:**
```
[ ] Tentang Saya
[ ] Hobi
[ ] Favorit (dengan urutan)
[ ] Link Favorit
```

---

### Latihan 1B: Pair Programming — Halaman Menu Restoran
**Waktu:** 20 menit | **Kelompok:** 2 orang

**Pembagian tugas:**
- **Orang A:** Buat struktur dan heading
- **Orang B:** Isi daftar menu dan link

Buat `menu-restoran.html` dengan:
- [ ] Nama restoran di `<h1>`
- [ ] Minimal 3 kategori menu (`<h2>`) — contoh: Makanan Utama, Minuman, Dessert
- [ ] Tiap kategori punya `<ul>` berisi min. 3 menu
- [ ] 1 gambar restoran (placeholder boleh)
- [ ] Link ke halaman pemesanan (boleh link kosong: `href="#"`)

**Tantangan bonus:** Tambahkan tag `<em>` (italic) untuk menu rekomendasi dan `<strong>` (bold) untuk menu best seller.

---

## Pertemuan 2 — Latihan HTML Multi-Page & Form

### Latihan 2A: Website 3 Halaman
**Waktu:** 45 menit | **Tingkat:** Menengah

Buat folder `website-ku/` dengan struktur:
```
website-ku/
├── index.html
├── about.html
└── contact.html
```

**Syarat setiap halaman:**
- [ ] Navigasi yang sama di atas (`<nav>` dengan link ke ketiga halaman)
- [ ] `<header>` berisi nama website
- [ ] `<main>` berisi konten utama
- [ ] `<footer>` berisi copyright
- [ ] Halaman aktif terasa berbeda (boleh pakai tanda `*` atau `[aktif]` di nav-link-nya)

**Syarat per halaman:**

**index.html (Home):**
- [ ] Sambutan selamat datang
- [ ] Tabel jadwal / informasi (min. 3 baris, 3 kolom)
- [ ] Gunakan `<thead>` dan `<tbody>`

**about.html (About):**
- [ ] Profil singkat / tentang website ini
- [ ] List keunggulan/fitur (gunakan `<ul>`)
- [ ] 1 gambar (placeholder boleh)

**contact.html (Contact):**
- [ ] Form kontak dengan field:
  - [ ] Nama (type text, required)
  - [ ] Email (type email, required)
  - [ ] Subjek (type text)
  - [ ] Pesan (textarea)
  - [ ] Tombol Kirim

---

### Latihan 2B: Pair Programming — Tabel Data Siswa
**Waktu:** 20 menit | **Kelompok:** 2 orang

Buat `data-siswa.html`:

**Orang A:** Buat struktur tabel dengan header
**Orang B:** Isi data siswa (buat data fiksi)

Tabel harus punya kolom: No | Nama | Kelas | Nilai HTML | Nilai CSS | Status

- [ ] Min. 5 baris data
- [ ] Gunakan `<thead>` dan `<tbody>`
- [ ] Status: "Lulus" jika nilai > 70, "Remidial" jika di bawahnya
- [ ] **Tantangan bonus:** Buat baris dengan `colspan` untuk judul tabel di atas kolom

---

## Pertemuan 3 — Latihan CSS

### Latihan 3A: Styling Website dari P2
**Waktu:** 40 menit | **Tingkat:** Menengah

Ambil folder `website-ku/` dari Pertemuan 2. Buat file `style.css` dan hubungkan ke ketiga halaman.

**Syarat wajib:**
- [ ] Reset margin dan padding (`* { margin: 0; padding: 0; }`)
- [ ] `body` punya font-family, background-color, dan color
- [ ] `header` punya background-color berbeda, padding, dan color teks putih
- [ ] `nav a` punya styling (hapus underline, beri warna, dan beri efek hover)
- [ ] `main` punya max-width dan `margin: 0 auto` (agar centered)
- [ ] `footer` punya background gelap dan teks terang
- [ ] Minimal 1 elemen pakai `border-radius`
- [ ] Minimal 1 animasi `transition` (contoh: hover pada tombol atau link)

**Syarat wajib — Box Model:**
- [ ] Buktikan pemahaman box model dengan memberi `padding`, `border`, dan `margin` pada minimal 2 elemen berbeda

---

### Latihan 3B: Animasi CSS
**Waktu:** 20 menit | **Tingkat:** Menengah**

Buat file `animasi.html` + `animasi.css` yang menampilkan:

- [ ] **Elemen 1:** Kotak yang bergerak kiri-kanan menggunakan `@keyframes` + `translateX`
- [ ] **Elemen 2:** Teks yang berubah warna menggunakan `@keyframes` + `color`
- [ ] **Elemen 3:** Tombol yang membesar sedikit saat di-hover menggunakan `transition` + `transform: scale()`
- [ ] **Tantangan bonus:** Buat loading spinner berputar menggunakan `@keyframes` + `rotate`

```
Hint spinner:
@keyframes putar {
  from { transform: rotate(0deg); }
  to   { transform: rotate(360deg); }
}
```

---

### Latihan 3C: Pair Programming — Kartu Profil
**Waktu:** 25 menit | **Kelompok:** 2 orang

Buat `kartu-profil.html` + `kartu-profil.css`:

**Orang A:** HTML struktur kartu
**Orang B:** CSS styling kartu

Kartu harus punya:
- [ ] Gambar (placeholder boleh)
- [ ] Nama
- [ ] Jabatan / deskripsi singkat
- [ ] 3 tombol sosial media (boleh link kosong)

Styling harus punya:
- [ ] `border-radius` untuk gambar (jadi bulat: `border-radius: 50%`)
- [ ] `box-shadow` untuk efek melayang
- [ ] Efek hover pada kartu (contoh: naik sedikit dengan `transform: translateY`)
- [ ] `transition` yang halus pada semua efek hover

---

## Pertemuan 4 — Latihan Flexbox, Grid & Bootstrap

### Latihan 4A: Flexbox Layout
**Waktu:** 25 menit | **Tingkat:** Menengah

Buat `flexbox-latihan.html` + CSS-nya.

**Bagian 1 — Navbar:**
- [ ] Buat navbar dengan logo di kiri dan menu di kanan menggunakan flexbox
- [ ] Gunakan `justify-content: space-between`

**Bagian 2 — Kartu Berjejer:**
- [ ] Buat 3 kartu berjejer menggunakan flexbox
- [ ] Gunakan `gap` untuk jarak antar kartu
- [ ] Kartu harus sama tinggi (`align-items: stretch`)

**Bagian 3 — Centering:**
- [ ] Buat `div` berisi teks yang terpusat sempurna (horizontal + vertikal) di tengah layar
- [ ] Gunakan `display: flex`, `justify-content: center`, `align-items: center`, `height: 100vh`

---

### Latihan 4B: CSS Grid Layout
**Waktu:** 25 menit | **Tingkat:** Menengah

Buat `grid-latihan.html` + CSS-nya.

**Bagian 1 — Grid 3 Kolom:**
- [ ] Buat galeri 6 item dalam grid 3 kolom menggunakan `repeat(3, 1fr)`
- [ ] Beri `gap` antar item

**Bagian 2 — Layout Halaman:**
- [ ] Buat layout dengan: Header (full width) | Sidebar kiri (200px) + Konten (sisa) | Footer (full width)
- [ ] Gunakan `grid-template-columns: 200px 1fr`

**Tantangan Bonus:**
- [ ] Tambahkan media query: di layar ≤ 768px, galeri jadi 2 kolom; di ≤ 480px jadi 1 kolom

---

### Latihan 4C: Landing Page Bootstrap (Proyek Utama P4)
**Waktu:** 50 menit | **Tingkat:** Menengah-Lanjut

Buat `landing-page.html` menggunakan Bootstrap 5.

**Wajib ada:**

**Navbar:**
- [ ] Logo / nama brand
- [ ] Menu: Home, Fitur, Harga, Kontak
- [ ] Navbar collapse (hamburger) untuk mobile
- [ ] `navbar-dark bg-dark` atau warna lain

**Hero Section:**
- [ ] `<section>` dengan background gelap dan teks terang
- [ ] Heading besar dan sub-heading
- [ ] 2 tombol CTA (Call to Action)
- [ ] Layout 2 kolom: teks kiri, gambar kanan (gunakan Bootstrap grid)

**Fitur Section:**
- [ ] Heading section
- [ ] 3 kartu fitur menggunakan Bootstrap `card` dan `col-md-4`

**Form Section:**
- [ ] Form pendaftaran / kontak dengan Bootstrap `form-control`
- [ ] Tombol submit dengan `btn btn-primary w-100`

**Footer:**
- [ ] Copyright text
- [ ] Background gelap

**Nilai Bonus:**
- [ ] Gunakan minimal 3 Bootstrap utility class (contoh: `mt-3`, `text-center`, `fw-bold`)
- [ ] Tambahkan custom CSS di `<style>` untuk override Bootstrap

---

### Latihan 4D: Pair Programming — Clone Landing Page
**Waktu:** 40 menit | **Kelompok:** 2 orang

Mentor akan menampilkan screenshot sebuah landing page sederhana.
Kalian harus mereplikasi layout-nya menggunakan Bootstrap.

**Pembagian:**
- **Orang A:** Navbar + Hero section
- **Orang B:** Fitur section + Footer

**Aturan:**
- Tidak boleh melihat kode aslinya — hanya boleh lihat screenshot
- Setelah selesai, bandingkan hasil kalian dengan aslinya
- Diskusikan: Apa yang berbeda? Mengapa?

---

## Rubrik Penilaian

| Kriteria | Poin |
|----------|------|
| Struktur HTML benar | 20 |
| Semua syarat wajib terpenuhi | 40 |
| Tampilan rapi dan tidak ada error | 20 |
| Tantangan bonus | 10 |
| Kreativitas / tampilan menarik | 10 |
| **Total** | **100** |

---

*Selamat berjuang! Ingat: Error itu wajar — programmer belajar dari error.*
