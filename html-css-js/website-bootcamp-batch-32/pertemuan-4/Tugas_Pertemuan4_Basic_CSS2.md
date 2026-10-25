# 📝 Tugas Pertemuan 4 — Basic CSS 2

**Kelas:** AI-Enhanced Fullstack Website Reguler  
**Lembaga:** Haltev IT Learning Center  
**Materi:** Flexbox, Grid Layout, dan Bootstrap  
**Deadline:** Sebelum pertemuan berikutnya

---

## 🎯 Tujuan Tugas

Setelah mengerjakan tugas ini, kamu diharapkan mampu:
- Menggunakan Flexbox untuk menyusun elemen secara fleksibel
- Menggunakan CSS Grid untuk membuat layout dua dimensi
- Menggunakan Bootstrap untuk membangun halaman yang responsif dengan cepat

---

## 📋 Instruksi

Buat sebuah **Landing Page Produk** — halaman promosi untuk produk atau layanan apa pun yang kamu pilih (misalnya: kafe, aplikasi, toko online, kursus, brand fashion, dll).

Kamu akan mengerjakan tugas ini dalam **dua versi**:

1. **Versi A** — Menggunakan CSS murni (Flexbox + Grid)
2. **Versi B** — Menggunakan Bootstrap

---

## ✅ Ketentuan Wajib

### 🅰️ Versi A — CSS Murni (Flexbox + Grid)

Buat file `index-css.html` dan `style.css`.

Halaman harus memiliki bagian-bagian berikut:

#### 1. Navbar — wajib menggunakan Flexbox
- Logo / nama brand di kiri
- Menu navigasi di kanan (minimal 3 link)
- Gunakan `display: flex`, `justify-content: space-between`, dan `align-items: center`

#### 2. Hero Section — wajib menggunakan Flexbox
- Teks headline dan sub-headline
- Sebuah tombol Call-to-Action (contoh: "Pesan Sekarang", "Pelajari Lebih Lanjut")
- Susun konten secara vertikal dan di tengah halaman menggunakan Flexbox

#### 3. Bagian Fitur / Produk — wajib menggunakan CSS Grid
- Tampilkan minimal **3 card** fitur atau produk secara grid
- Gunakan `display: grid` dengan `repeat(3, 1fr)` atau `repeat(auto-fit, minmax(...))`
- Setiap card berisi: judul, deskripsi singkat, dan (opsional) ikon atau gambar

#### 4. Footer
- Teks hak cipta di tengah
- Boleh menggunakan Flexbox untuk perataan

---

### 🅱️ Versi B — Bootstrap

Buat file `index-bootstrap.html` (satu file, tanpa CSS eksternal).

Halaman harus memiliki bagian-bagian berikut:

#### 1. Navbar Bootstrap
- Gunakan komponen `navbar` dari Bootstrap
- Tambahkan nama brand dan minimal 3 link navigasi

#### 2. Hero Section
- Gunakan utility class Bootstrap seperti `py-5`, `text-center`, `display-4`, `lead`
- Berikan warna background menggunakan `bg-primary` atau warna lain
- Sertakan tombol dengan class `btn`

#### 3. Bagian Kartu — wajib menggunakan sistem grid Bootstrap
- Tampilkan minimal **3 card** menggunakan `col-12 col-md-4`
- Setiap card menggunakan komponen `card` Bootstrap
- Card harus berisi: judul (`card-title`), deskripsi (`card-text`), dan tombol (`btn`)

#### 4. Footer
- Background gelap (`bg-dark text-white`)
- Teks copyright di tengah

---

## 💡 Contoh Tampilan

```
┌──────────────────────────────────────────────────┐
│  Logo              Home  About  Produk  Kontak   │  ← Navbar (Flexbox / Bootstrap)
├──────────────────────────────────────────────────┤
│                                                  │
│           Headline Produk Kamu di Sini           │  ← Hero Section
│       Sub-headline yang menarik dan singkat      │
│              [ Mulai Sekarang ]                  │
│                                                  │
├──────────────────────────────────────────────────┤
│  ┌──────────┐  ┌──────────┐  ┌──────────┐       │
│  │ Card 1   │  │ Card 2   │  │ Card 3   │       │  ← Grid / Bootstrap Row
│  │ Judul    │  │ Judul    │  │ Judul    │       │
│  │ Deskripsi│  │ Deskripsi│  │ Deskripsi│       │
│  │ [Tombol] │  │ [Tombol] │  │ [Tombol] │       │
│  └──────────┘  └──────────┘  └──────────┘       │
├──────────────────────────────────────────────────┤
│         © 2025 NamaBrand. All rights reserved.  │  ← Footer
└──────────────────────────────────────────────────┘
```

---

## 🎨 Bonus (Tidak Wajib)

Kerjakan ini jika kamu ingin nilai lebih:

- **Bonus 1:** Tambahkan bagian "Testimonial" menggunakan Flexbox (Versi A) atau row Bootstrap (Versi B)
- **Bonus 2:** Buat halaman benar-benar responsif — di HP card menjadi satu kolom, di tablet dua kolom, di laptop tiga kolom
- **Bonus 3 (Versi A):** Gunakan `grid-template-areas` untuk membuat layout halaman penuh
- **Bonus 4 (Versi B):** Tambahkan komponen Bootstrap lain seperti `alert`, `badge`, atau `modal`
- **Bonus 5:** Tambahkan custom CSS di atas Bootstrap untuk mengubah warna atau font sesuai selera kamu

---

## 📁 Format Pengumpulan

Kumpulkan dalam bentuk **folder ZIP** yang berisi:

```
tugas-css2-[nama-kamu]/
├── index-css.html        ← Versi A
├── style.css             ← CSS untuk Versi A
└── index-bootstrap.html  ← Versi B
```

Contoh nama folder: `tugas-css2-budi-santoso.zip`

---

## 🔍 Kriteria Penilaian

| Kriteria | Poin |
|---|---|
| **Versi A** — Navbar menggunakan Flexbox dengan benar | 20 |
| **Versi A** — Bagian fitur/produk menggunakan CSS Grid dengan benar | 20 |
| **Versi B** — Menggunakan komponen Bootstrap (navbar, card, btn) | 20 |
| **Versi B** — Sistem grid Bootstrap digunakan dengan benar | 20 |
| Kerapian kode, penamaan class, dan komentar | 10 |
| Tampilan keseluruhan menarik dan rapi | 10 |
| **Total** | **100** |

---

## 🙋 Tips

- Sebelum mulai Bootstrap, **pastikan kamu sudah paham Flexbox dan Grid** — Bootstrap hanya alat, fondasinya tetap CSS
- Gunakan **Chrome DevTools** (F12) untuk melihat class Bootstrap apa yang berpengaruh
- Untuk Versi B, kamu tidak perlu membuat file CSS terpisah — cukup gunakan utility class Bootstrap
- Kalau bingung nama class Bootstrap, cek langsung di [getbootstrap.com/docs/5.3](https://getbootstrap.com/docs/5.3/)
- Main-main dulu di [Flexbox Froggy](https://flexboxfroggy.com/) dan [Grid Garden](https://cssgridgarden.com/) kalau mau latihan tambahan yang seru!

---

*Semangat! 💪 Dua versi mungkin terasa banyak, tapi ini cara terbaik buat kamu ngerti bedanya CSS murni vs framework. Kalau bisa keduanya, kamu sudah jago banget!*
