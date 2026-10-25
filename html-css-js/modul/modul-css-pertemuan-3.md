# Modul Pengajaran: HTML & CSS Dasar
**Haltev IT Learning Center — Web Development**
**Pertemuan 3 | Tools: VS Code + Chrome**

---

## Pertemuan 3 — Basic CSS 1

### Tujuan Pembelajaran
Siswa mampu memberikan styling pada halaman web menggunakan CSS, memahami box model, dan membuat animasi sederhana.

---

### Apa itu CSS?

**CSS** (Cascading Style Sheets) mengatur **tampilan** elemen HTML.

Analogi: Kalau HTML adalah kerangka rumah, CSS adalah **cat, furnitur, dan dekorasi**.

---

### Cara Menghubungkan CSS ke HTML

Ada 3 cara:

```html
<!-- 1. Inline — langsung di tag (TIDAK DISARANKAN untuk proyek besar) -->
<h1 style="color: red; font-size: 32px;">Judul</h1>

<!-- 2. Internal — di dalam tag <style> di <head> -->
<head>
  <style>
    h1 {
      color: red;
    }
  </style>
</head>

<!-- 3. External — file CSS terpisah (PALING DISARANKAN) -->
<head>
  <link rel="stylesheet" href="style.css" />
</head>
```

> **Rekomendasi:** Selalu gunakan **external CSS** (file `.css` terpisah).

---

### Sintaks CSS

```css
/* selector { properti: nilai; } */

h1 {
  color: blue;        /* warna teks */
  font-size: 32px;    /* ukuran font */
  font-family: Arial; /* jenis font */
}
```

---

### Selector CSS

```css
/* Element selector — pilih semua tag <p> */
p {
  color: black;
}

/* Class selector — pilih elemen dengan class="judul" */
.judul {
  font-size: 24px;
  font-weight: bold;
}

/* ID selector — pilih elemen dengan id="header" */
#header {
  background-color: navy;
  color: white;
}

/* Descendant selector — pilih <p> yang ada di dalam <div> */
div p {
  margin: 10px;
}

/* Pseudo-class — styling saat hover */
a:hover {
  color: red;
  text-decoration: underline;
}

/* Grouping — terapkan ke beberapa selector sekaligus */
h1, h2, h3 {
  font-family: Georgia, serif;
}
```

---

### Box Model

Setiap elemen HTML adalah sebuah **kotak** yang terdiri dari 4 lapisan:

```
+----------------------------------+
|           MARGIN                 |  ← Jarak luar (antar elemen)
|  +----------------------------+  |
|  |         BORDER             |  |  ← Garis tepi
|  |  +----------------------+  |  |
|  |  |       PADDING        |  |  |  ← Jarak dalam (konten ke border)
|  |  |  +----------------+  |  |  |
|  |  |  |    CONTENT     |  |  |  |  ← Teks / gambar
|  |  |  +----------------+  |  |  |
|  |  +----------------------+  |  |
|  +----------------------------+  |
+----------------------------------+
```

```css
.kotak {
  /* Content */
  width: 200px;
  height: 100px;

  /* Padding — jarak konten ke border */
  padding: 20px;              /* semua sisi */
  padding: 10px 20px;         /* atas-bawah | kiri-kanan */
  padding: 10px 20px 15px 5px; /* atas | kanan | bawah | kiri */

  /* Border — garis tepi */
  border: 2px solid black;    /* tebal | gaya | warna */
  border-radius: 10px;        /* sudut membulat */

  /* Margin — jarak luar elemen */
  margin: 20px;
  margin: 0 auto;             /* center horizontal */
}
```

> **Tips:** `box-sizing: border-box` membuat `width` sudah termasuk padding & border — sangat berguna!

```css
* {
  box-sizing: border-box; /* Terapkan ke semua elemen */
}
```

---

### Warna di CSS

```css
.contoh {
  /* Nama warna */
  color: red;
  color: navy;
  color: tomato;

  /* Hexadecimal */
  color: #ff0000;   /* merah */
  color: #333333;   /* abu-abu gelap */

  /* RGB */
  color: rgb(255, 0, 0);      /* merah */
  color: rgba(0, 0, 0, 0.5);  /* hitam 50% transparan */
}
```

---

### Typography (Teks)

```css
p {
  font-family: 'Arial', sans-serif;
  font-size: 16px;
  font-weight: bold;      /* atau: normal, 400, 700 */
  font-style: italic;
  text-align: center;     /* left | right | center | justify */
  text-decoration: none;  /* none | underline | line-through */
  line-height: 1.6;       /* jarak antar baris */
  letter-spacing: 1px;    /* jarak antar huruf */
  text-transform: uppercase; /* uppercase | lowercase | capitalize */
}
```

---

### Basic Animation

#### Transition (Perubahan Halus)

```css
/* Tambahkan transition ke elemen asalnya */
.tombol {
  background-color: blue;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;

  /* property | durasi | timing-function */
  transition: background-color 0.3s ease;
}

/* Definisikan perubahan saat hover */
.tombol:hover {
  background-color: darkblue;
}
```

#### @keyframes (Animasi Berulang)

```css
/* Definisikan animasi */
@keyframes berkedip {
  0%   { opacity: 1; }
  50%  { opacity: 0; }
  100% { opacity: 1; }
}

@keyframes bergeser {
  0%   { transform: translateX(0); }
  100% { transform: translateX(100px); }
}

/* Terapkan animasi ke elemen */
.teks-berkedip {
  animation: berkedip 1s infinite;  /* nama | durasi | pengulangan */
}

.kotak-bergeser {
  animation: bergeser 2s ease-in-out infinite alternate;
}
```

---

### Contoh Lengkap: style.css

```css
/* Reset bawaan browser */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Arial', sans-serif;
  background-color: #f5f5f5;
  color: #333;
  line-height: 1.6;
}

/* Header */
header {
  background-color: #2c3e50;
  color: white;
  padding: 20px 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

header h1 {
  font-size: 24px;
}

nav a {
  color: white;
  text-decoration: none;
  margin-left: 20px;
  transition: color 0.3s ease;
}

nav a:hover {
  color: #3498db;
}

/* Main content */
main {
  max-width: 900px;
  margin: 40px auto;
  padding: 0 20px;
}

/* Card / kotak konten */
.kartu {
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 24px;
  margin-bottom: 24px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
  transition: box-shadow 0.3s ease;
}

.kartu:hover {
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

/* Tombol */
.tombol {
  display: inline-block;
  background-color: #3498db;
  color: white;
  padding: 10px 24px;
  border-radius: 4px;
  text-decoration: none;
  font-weight: bold;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.tombol:hover {
  background-color: #2980b9;
  transform: translateY(-2px);
}

/* Animasi teks masuk */
@keyframes masukDariKiri {
  from {
    opacity: 0;
    transform: translateX(-40px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

h2 {
  animation: masukDariKiri 0.5s ease forwards;
}

/* Footer */
footer {
  background-color: #2c3e50;
  color: #aaa;
  text-align: center;
  padding: 20px;
  margin-top: 60px;
  font-size: 14px;
}
```

---

*Modul ini adalah bagian dari kurikulum AI-Enhanced Website Fullstack Reguler — Haltev IT Learning Center*
