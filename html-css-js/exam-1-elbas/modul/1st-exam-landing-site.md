# 🎓 Exam 1 — Personal Landing Page
**Haltev IT Learning Center — Web Development**
**Pertemuan 8 | HTML · CSS · JavaScript**

---

## Selamat Datang di Exam 1!

Ini adalah ujian pertamamu di kelas Web Development Haltev. Kamu sudah belajar banyak hal — HTML, CSS, Flexbox, Grid, Bootstrap, JavaScript, dan cara menggunakan AI sebagai asisten. Sekarang saatnya menggabungkan semuanya menjadi sebuah karya nyata.

**Tugas kamu:** Buat sebuah **Personal Landing Page** — halaman web yang memperkenalkan dirimu kepada dunia.

> 💡 Landing page ini bisa kamu gunakan sungguhan sebagai portofolio online pertamamu. Buat sebaik dan se-personal mungkin!

---

## Ketentuan Umum

| | |
|---|---|
| **Waktu pengerjaan** | Dikerjakan di rumah, dikumpulkan sebelum Pertemuan 9 |
| **Boleh pakai AI?** | ✅ Boleh — tapi kamu harus bisa jelaskan setiap bagian kodenya |
| **Boleh pakai Bootstrap?** | ✅ Boleh, tapi CSS murni juga harus ada minimal di satu bagian |
| **Boleh pakai template dari internet?** | ❌ Tidak boleh — harus kode sendiri dari nol |
| **Bahasa** | Bebas (Indonesia atau Inggris) |

---

## Struktur Halaman yang Harus Ada

Landing page kamu wajib memiliki **5 section** berikut:

### 1. 🔝 Navbar
Navigasi di atas halaman yang berisi:
- Nama atau inisialmu sebagai brand
- Minimal 4 link navigasi ke section di halaman yang sama (gunakan anchor `#`)
- Sticky/fixed di atas saat di-scroll (opsional tapi nilai plus)

### 2. 🦸 Hero Section
Bagian pertama yang dilihat pengunjung, berisi:
- Foto dirimu atau ilustrasi (boleh pakai avatar dari [pravatar.cc](https://i.pravatar.cc) atau [ui-avatars.com](https://ui-avatars.com))
- Nama lengkap
- Tagline / headline singkat yang menggambarkan dirimu (contoh: "Calon Web Developer dari Bekasi 🚀")
- Tombol Call-to-Action (contoh: "Lihat Proyekku" atau "Hubungi Saya")

### 3. 👤 About Me
Bagian yang menceritakan tentang dirimu, berisi:
- Paragraf singkat tentang dirimu (2–4 kalimat)
- Minimal 3 skill atau hal yang sedang kamu pelajari (bisa dalam bentuk card, badge, atau list)
- Boleh tambah hobi, asal kota, atau fakta menarik tentang dirimu

### 4. 🗂️ Projects / Portofolio
Tampilkan minimal **3 kartu project** (boleh fiktif/latihan dari kelas), setiap kartu berisi:
- Nama project
- Deskripsi singkat (1–2 kalimat)
- Teknologi yang dipakai (HTML, CSS, JS, dll)
- Tombol "Lihat Project" (link boleh `#` jika belum punya URL)

### 5. 📬 Contact / Footer
Bagian paling bawah, berisi:
- Cara menghubungi kamu — minimal email atau media sosial
- Teks copyright
- Boleh tambah link ke GitHub, LinkedIn, Instagram, dll

---

## Ketentuan Teknis

### HTML
- [ ] Menggunakan struktur HTML5 yang benar (`<!DOCTYPE html>`, `<head>`, `<body>`)
- [ ] Menggunakan **semantic HTML** untuk setiap section (`<nav>`, `<header>`, `<section>`, `<footer>`)
- [ ] File HTML dan CSS dipisah (`index.html` + `style.css`)
- [ ] Minimal ada satu `<form>` di halaman (bisa di section contact)

### CSS
- [ ] **Wajib ada minimal satu bagian yang menggunakan Flexbox** (contoh: navbar, hero, atau skill section)
- [ ] **Wajib ada minimal satu bagian yang menggunakan Grid** (contoh: project cards atau galeri)
- [ ] Warna, font, dan spacing konsisten di seluruh halaman
- [ ] Boleh pakai Bootstrap, tapi tetap harus ada custom CSS di `style.css`

### JavaScript
- [ ] Ada minimal **satu fitur interaktif** yang menggunakan JavaScript. Pilih salah satu atau lebih:
  - Form kontak dengan validasi (cek apakah field kosong sebelum submit)
  - Tombol dark mode / light mode toggle
  - Tombol "Back to Top" yang muncul saat di-scroll
  - Greeting dinamis berdasarkan waktu ("Selamat Pagi!", "Selamat Sore!", dll)
  - Filter project berdasarkan kategori/teknologi
  - Animasi teks (misal: teks yang berganti-ganti secara otomatis)

### Responsivitas
- [ ] Halaman terlihat rapi di **layar laptop** (min. 1024px)
- [ ] Halaman terlihat rapi di **layar HP** (maks. 480px)
- [ ] Tidak ada teks atau elemen yang terpotong saat di-resize

---

## Contoh Tampilan (Referensi)

```
┌─────────────────────────────────────────────────────┐
│  [Nama]          Home  About  Projects  Contact      │ ← Navbar
├─────────────────────────────────────────────────────┤
│                                                     │
│    [  Foto  ]    Halo, Saya Budi Santoso!           │
│                  Calon Web Developer dari Bekasi 🚀  │ ← Hero
│                  [ Lihat Proyekku ]                  │
│                                                     │
├─────────────────────────────────────────────────────┤
│  Tentang Saya                                       │
│  Saya adalah siswa web development yang...          │ ← About
│                                                     │
│  [ HTML ]  [ CSS ]  [ JavaScript ]  [ Bootstrap ]   │
├─────────────────────────────────────────────────────┤
│  Proyek Saya                                        │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐          │
│  │ Project 1│  │ Project 2│  │ Project 3│          │ ← Projects
│  │ Deskripsi│  │ Deskripsi│  │ Deskripsi│          │
│  │[Lihat ▶] │  │[Lihat ▶] │  │[Lihat ▶] │          │
│  └──────────┘  └──────────┘  └──────────┘          │
├─────────────────────────────────────────────────────┤
│  Hubungi Saya                                       │
│  📧 budi@email.com  |  GitHub  |  LinkedIn          │ ← Contact/Footer
│  © 2025 Budi Santoso                                │
└─────────────────────────────────────────────────────┘
```

---

## Kriteria Penilaian

### A. Kelengkapan Struktur (30 poin)

| Kriteria | Poin |
|----------|------|
| Semua 5 section ada dan berisi konten yang sesuai | 20 |
| HTML semantik digunakan dengan benar (`nav`, `section`, `footer`, dll) | 10 |

### B. CSS & Tampilan (30 poin)

| Kriteria | Poin |
|----------|------|
| Flexbox digunakan minimal di satu bagian dengan benar | 10 |
| Grid digunakan minimal di satu bagian dengan benar | 10 |
| Tampilan konsisten, rapi, dan enak dilihat | 10 |

### C. JavaScript (20 poin)

| Kriteria | Poin |
|----------|------|
| Ada minimal satu fitur interaktif yang berfungsi | 15 |
| Kode JS bersih, ada komentar, tidak ada error di console | 5 |

### D. Responsivitas (10 poin)

| Kriteria | Poin |
|----------|------|
| Tampilan rapi di desktop (≥1024px) | 5 |
| Tampilan rapi di mobile (≤480px) | 5 |

### E. Kreativitas & Usaha (10 poin)

| Kriteria | Poin |
|----------|------|
| Desain terasa personal dan menunjukkan usaha lebih | 5 |
| Ada fitur/detail tambahan di luar ketentuan minimum | 5 |

### Total: 100 Poin

---

## Bonus (Nilai Ekstra)

Kerjakan salah satu atau lebih untuk mendapatkan nilai bonus:

- **+5** — Menggunakan **CSS custom animation** (`@keyframes`) di hero section atau elemen lain
- **+5** — Fitur **dark mode** yang berfungsi dengan toggle JavaScript
- **+5** — Menggunakan **Google Fonts** untuk memperindah tipografi
- **+5** — Halaman memiliki **loading animation** atau **scroll animation** (elemen muncul saat di-scroll)
- **+10** — Landing page di-deploy online dan bisa diakses via link (gunakan [GitHub Pages](https://pages.github.com/) atau [Netlify](https://www.netlify.com/) — gratis!)

---

## Format Pengumpulan

Kumpulkan dalam bentuk **folder ZIP**:

```
exam1-[nama-kamu]/
├── index.html
├── style.css
├── script.js
└── assets/          ← (opsional) folder untuk gambar
    └── foto.jpg
```

Contoh nama file: `exam1-budi-santoso.zip`

---

## Tips Pengerjaan

**Mulai dari struktur, bukan dari desain.** Tulis semua HTML-nya dulu sampai semua section ada, baru kemudian styling dengan CSS.

**Gunakan AI dengan bijak.** Boleh pakai ChatGPT/Gemini untuk membantu, tapi pastikan kamu mengerti setiap kode yang kamu tulis. Mentor akan bertanya saat presentasi.

**Cek di HP sebelum dikumpulkan.** Buka `index.html` di HP kamu atau gunakan DevTools (F12 → ikon HP di pojok kiri atas) untuk simulasi layar mobile.

**Commit sering jika pakai Git.** Kalau ada yang rusak, mudah balik ke versi sebelumnya.

**Jangan tunggu sempurna.** Kumpulkan yang sudah ada, daripada tidak kumpul sama sekali. Progress lebih penting dari kesempurnaan.

---

## Pertanyaan yang Sering Ditanya

**Q: Boleh pakai template Bootstrap seperti Bootswatch?**
A: Boleh untuk styling tema dasar, tapi struktur HTML dan logika JavaScript tetap harus kamu tulis sendiri.

**Q: Foto profilnya harus foto asli?**
A: Tidak harus. Boleh pakai avatar, ilustrasi, atau gambar placeholder.

**Q: Proyeknya harus project nyata?**
A: Tidak. Boleh tulis project latihan dari kelas (contoh: "Profile Card", "To-Do List", "Landing Page"). Yang penting deskripsinya jujur.

**Q: Kalau ada bagian yang belum bisa, apakah tetap dikumpulkan?**
A: Ya, tetap dikumpulkan. Nilai akan diberikan sesuai yang sudah dikerjakan. Lebih baik 80% selesai dan dikumpulkan daripada 100% tidak pernah dikumpulkan.

---

*Semangat mengerjakan! 🚀 Ini adalah portofolio pertamamu — sesuatu yang bisa kamu tunjukkan ke keluarga, teman, bahkan calon employer suatu hari nanti. Buat dengan bangga!*
