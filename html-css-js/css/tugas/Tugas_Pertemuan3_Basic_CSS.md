# 📝 Tugas Pertemuan 3 — Basic CSS 1

**Kelas:** AI-Enhanced Fullstack Website Reguler  
**Lembaga:** Haltev IT Learning Center  
**Materi:** CSS Syntax, Selector, Box Model, Animasi Sederhana  
**Deadline:** Sebelum pertemuan berikutnya

---

## 🎯 Tujuan Tugas

Setelah mengerjakan tugas ini, kamu diharapkan mampu:
- Menulis sintaks CSS yang benar
- Menggunakan selector CSS (tag, class, id)
- Menerapkan box model (margin, padding, border)
- Membuat animasi sederhana dengan CSS

---

## 📋 Instruksi

Buat sebuah halaman **Kartu Profil** (Profile Card) menggunakan HTML dan CSS.

Kamu **tidak boleh** menggunakan framework seperti Bootstrap — cukup CSS murni (vanilla CSS).

---

## ✅ Ketentuan Wajib

Halaman kamu harus memiliki elemen-elemen berikut:

### 1. Struktur HTML
- File bernama `index.html` dan `style.css` (terpisah, dihubungkan dengan `<link>`)
- Terdapat sebuah kotak kartu (card) yang berisi:
  - Foto profil (boleh pakai gambar dari internet atau placeholder)
  - Nama lengkap
  - Pekerjaan / jabatan (contoh: "Web Developer")
  - Deskripsi singkat (1–2 kalimat)
  - Minimal 2 tombol (contoh: "Follow" dan "Message")

### 2. CSS — Selector
Gunakan **minimal ketiga jenis selector** berikut:
- **Tag selector** — contoh: `body`, `h1`, `p`
- **Class selector** — contoh: `.card`, `.btn`
- **ID selector** — contoh: `#profile-name`

### 3. CSS — Box Model
Terapkan properti box model pada elemen kartu:
- `margin` — untuk memberi jarak dari luar
- `padding` — untuk memberi jarak dari dalam
- `border` — untuk memberi garis tepi
- `border-radius` — untuk membuat sudut melengkung

### 4. CSS — Animasi Sederhana
Tambahkan **salah satu** animasi berikut (pilih yang kamu suka):
- Efek hover pada tombol (warna berubah saat di-hover menggunakan `:hover`)
- Kartu sedikit naik saat di-hover menggunakan `transform: translateY()`
- Fade-in saat halaman dibuka menggunakan `@keyframes`

---

## 💡 Contoh Tampilan

```
┌─────────────────────────┐
│        [ Foto ]         │
│                         │
│     Budi Santoso        │
│     Web Developer       │
│                         │
│  "Saya suka belajar     │
│   hal-hal baru!"        │
│                         │
│  [Follow]  [Message]    │
└─────────────────────────┘
```

---

## 🎨 Bonus (Tidak Wajib)

Kerjakan ini jika kamu ingin nilai lebih:
- Tambahkan **Google Fonts** untuk memperindah tampilan teks
- Buat halaman **mobile-friendly** menggunakan `max-width` dan `margin: auto`
- Beri **background gradient** pada halaman menggunakan `linear-gradient()`

---

## 📁 Format Pengumpulan

Kumpulkan dalam bentuk **folder ZIP** yang berisi:
```
tugas-css-[nama-kamu]/
├── index.html
└── style.css
```

Contoh nama folder: `tugas-css-budi-santoso.zip`

---

## 🔍 Kriteria Penilaian

| Kriteria | Poin |
|---|---|
| Struktur HTML dan CSS terpisah dan benar | 20 |
| Menggunakan 3 jenis selector (tag, class, id) | 25 |
| Box model diterapkan dengan benar | 25 |
| Animasi sederhana berjalan | 20 |
| Kerapian kode dan komentar | 10 |
| **Total** | **100** |

---

## 🙋 Tips

- Gunakan **VS Code** dan buka hasilnya di browser Chrome
- Klik kanan di browser → **Inspect** untuk melihat dan debugging CSS
- Kalau bingung, boleh tanya ke AI (ChatGPT/Gemini) — tapi pastikan kamu **mengerti** kode yang kamu tulis, ya!
- Referensi belajar: [MDN Web Docs CSS](https://developer.mozilla.org/en-US/docs/Web/CSS)

---

*Semangat mengerjakan! 💪 Ingat, tidak ada yang salah dalam belajar — yang penting dicoba dulu.*
