# Latihan Praktik — HTML Lanjutan & Multi-Page (Untuk Siswa)
**Haltev IT Learning Center | Pertemuan 2**

> Kerjakan sendiri dulu. Tanya mentor hanya setelah mencoba minimal 10 menit.

---

## Latihan 1 — Semantic HTML (15 menit) | Individu

Buka file `index.html` yang kamu buat di Pertemuan 1.

**Tugasmu:** Ubah struktur halaman agar menggunakan tag semantic HTML yang benar.

**Syarat wajib:**
- [ ] Gunakan `<header>` untuk bagian atas (judul website)
- [ ] Gunakan `<nav>` untuk menu navigasi (boleh isi link kosong dulu `href="#"`)
- [ ] Gunakan `<main>` untuk konten utama
- [ ] Gunakan minimal 2 `<section>` di dalam `<main>` untuk memisahkan bagian konten
- [ ] Gunakan `<footer>` untuk bagian bawah dengan teks copyright

**Contoh struktur yang diharapkan:**
```
<body>
  <header> ... </header>
  <nav> ... </nav>
  <main>
    <section> ... </section>
    <section> ... </section>
  </main>
  <footer> ... </footer>
</body>
```

**Cek mandiri sebelum lanjut:**
- [ ] Buka di browser — tampilan masih sama seperti sebelumnya? (Itu normal! Semantic tidak mengubah tampilan, hanya struktur)
- [ ] Klik kanan di browser → **Inspect** → apakah kamu bisa menemukan tag `<header>`, `<nav>`, `<main>`, `<footer>`?

---

## Latihan 2 — Website 3 Halaman (45 menit) | Individu

Buat folder baru bernama `website-ku/` dan buat **tiga file HTML** di dalamnya.

### Struktur folder yang harus dibuat:
```
website-ku/
├── index.html
├── about.html
└── contact.html
```

---

### Syarat untuk SEMUA halaman (berlaku di index, about, dan contact):

- [ ] Struktur HTML lengkap (`DOCTYPE`, `html`, `head`, `body`)
- [ ] Tag `<title>` yang berbeda di setiap halaman
- [ ] `<header>` berisi nama websitemu
- [ ] `<nav>` dengan link ke **ketiga halaman** (`index.html`, `about.html`, `contact.html`)
- [ ] Tandai halaman yang sedang aktif (contoh: pakai tanda `[aktif]` atau bungkus dengan `<strong>`)
- [ ] `<main>` berisi konten utama halaman
- [ ] `<footer>` berisi teks copyright-mu

---

### index.html — Halaman Home

Konten yang harus ada di `<main>`:

- [ ] `<section>` berisi sambutan selamat datang (min. 1 paragraf)
- [ ] `<section>` berisi tabel dengan ketentuan:
  - [ ] Judul tabel menggunakan `colspan` (gabungkan seluruh kolom jadi 1 judul)
  - [ ] Minimal 3 kolom dan 3 baris data
  - [ ] Gunakan `<thead>` dan `<tbody>`
  - [ ] Bebas temanya: jadwal pelajaran, daftar film favorit, daftar game, dll.

---

### about.html — Halaman Tentang

Konten yang harus ada di `<main>`:

- [ ] `<section>` berisi foto (placeholder boleh) dan deskripsi singkat tentang dirimu (min. 2 kalimat)
- [ ] `<section>` berisi daftar keahlian atau hobi menggunakan `<ul>`
- [ ] `<aside>` berisi informasi tambahan singkat (kota asal, motto hidup, atau hal seru tentang dirimu)

---

### contact.html — Halaman Kontak

Konten yang harus ada di `<main>`:

- [ ] Paragraf singkat mengajak pengunjung menghubungimu
- [ ] Form kontak dengan field berikut:
  - [ ] Nama lengkap (`type="text"`, `required`)
  - [ ] Email (`type="email"`, `required`)
  - [ ] Nomor HP (`type="number"` atau `type="text"`)
  - [ ] Subjek (`type="text"`)
  - [ ] Pesan (`<textarea>`)
  - [ ] Tombol **Kirim**

---

## Latihan 3 — Tabel Data (20 menit) | Pair Programming

**Kelompok:** 2 orang  
**Buat file:** `data-siswa.html`

### Pembagian tugas:
- **Orang A:** Buat struktur HTML lengkap + struktur tabel dengan bagian `<thead>`
- **Orang B:** Isi data di bagian `<tbody>` (buat data fiksi yang kreatif!)

### Ketentuan tabel:

Tabel harus memiliki kolom: **No | Nama | Asal Kota | Nilai HTML | Nilai CSS | Status**

- [ ] Minimal **5 baris data** siswa (boleh nama fiksi)
- [ ] Gunakan `<thead>` dan `<tbody>`
- [ ] Kolom **Status**: tulis "Lulus" jika nilai rata-rata > 70, tulis "Remidial" jika di bawahnya
- [ ] Baris pertama di `<thead>` berisi judul tabel menggunakan `colspan` yang menggabungkan semua kolom
- [ ] Navigasi sederhana di atas halaman (link kembali ke `index.html`)

**Contoh struktur tabel:**
```html
<thead>
  <tr>
    <th colspan="6">Data Nilai Siswa Kelas Web Development</th>
  </tr>
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Asal Kota</th>
    <th>Nilai HTML</th>
    <th>Nilai CSS</th>
    <th>Status</th>
  </tr>
</thead>
```

---

## Latihan 4 — Form Registrasi (20 menit) | Individu

Buat file baru `daftar.html` — halaman pendaftaran kelas coding.

**Syarat form:**
- [ ] Nama lengkap (`type="text"`, `required`)
- [ ] Email (`type="email"`, `required`)
- [ ] Tanggal lahir (`type="date"`)
- [ ] Jenis kelamin menggunakan **radio button** (Laki-laki / Perempuan)
- [ ] Keahlian yang sudah dimiliki menggunakan **checkbox** (pilih boleh lebih dari satu):
  - HTML, CSS, JavaScript, Python, Lainnya
- [ ] Kota asal menggunakan **dropdown** `<select>` (min. 5 kota)
- [ ] Alasan mendaftar menggunakan `<textarea>`
- [ ] Checkbox persetujuan: "Saya setuju dengan syarat dan ketentuan" (`required`)
- [ ] Tombol **Daftar Sekarang**

**Bonus:** Tambahkan link di `<nav>` agar halaman ini bisa diakses dari `index.html`.

---

## 🏆 Tantangan Bonus

Jika kamu sudah menyelesaikan semua latihan di atas, coba tantangan ini:

1. **Tabel Kompleks:** Di halaman `index.html`, buat tabel jadwal mingguan yang menggunakan `rowspan` — misalnya istirahat berlangsung di semua pelajaran jam 10:00 (gabungkan seluruh baris kolom "Istirahat").

2. **Form Lengkap:** Tambahkan input `type="file"` di form `daftar.html` untuk upload foto profil.

3. **Konsistensi Navigasi:** Pastikan navigasi di **semua** halaman (index, about, contact, daftar) menampilkan link yang aktif dengan benar.

---

## Rubrik Penilaian

| Kriteria | Poin |
|----------|------|
| Struktur HTML benar di semua halaman | 15 |
| Semantic HTML digunakan dengan tepat | 15 |
| Navigasi antar halaman berfungsi | 20 |
| Tabel dengan `thead`, `tbody`, dan `colspan` | 20 |
| Form dengan minimal 5 jenis input berbeda | 20 |
| Tampilan rapi, tidak ada error di browser | 10 |
| **Total** | **100** |

**Nilai Bonus:** +10 poin untuk setiap tantangan bonus yang berhasil dikerjakan.

---

> *Ingat: Tidak ada yang langsung bisa coding tanpa error. Yang penting kamu terus mencoba! 💪*

*Haltev IT Learning Center — Pertemuan 2*
