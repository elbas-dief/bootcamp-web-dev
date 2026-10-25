# Modul Pengajaran: JavaScript Basic 2 — Interaktivitas Web
**Haltev IT Learning Center — Web Development**
**Pertemuan 6 | Tools: VS Code + Chrome DevTools**

---

## Tujuan Pembelajaran

Siswa mampu menggunakan function, array, dan object untuk mengelola data, lalu menampilkan dan mengubahnya di halaman web menggunakan DOM manipulation dan event handling. Di akhir pertemuan, siswa bisa membuat tampilan web yang **merespons aksi pengguna** — menampilkan daftar item dari data, menyembunyikan/menampilkan bagian halaman berdasarkan kondisi, dan mengubah status tombol secara dinamis.

> 📌 **Fokus pertemuan ini adalah TAMPILAN WEB.** Kalau P5 melatih logika di Console, sekarang logika itu kita hubungkan ke elemen HTML nyata di layar.

---

## Daftar Isi

- [Recap Pertemuan 5](#recap-pertemuan-5)
- [Function](#function)
- [Array](#array)
- [Object](#object)
- [DOM Manipulation](#dom-manipulation)
- [Event Handling](#event-handling)
- [Latihan](#latihan)
- [Ringkasan](#ringkasan)

---

## Recap Pertemuan 5

Pastikan kamu sudah nyaman dengan ini:

| Konsep | Contoh Singkat |
|--------|----------------|
| Variable | `let nama = "Budi"` / `const PPN = 0.11` |
| Tipe Data | String, Number, Boolean |
| Konversi | `Number("15000")`, `parseInt(...)` |
| Conditional | `if (umur >= 18) { ... } else { ... }` |
| Loop | `for (let i = 0; i < 5; i++) { ... }` |

Semua itu adalah **logika**. Hari ini kita bungkus logika tersebut ke dalam **function**, kita simpan datanya di **array & object**, lalu kita tampilkan ke **halaman web**.

---

## Function

Function adalah **kumpulan kode yang diberi nama**, supaya bisa dipanggil berulang kali tanpa menulis ulang.

### Membuat dan Memanggil Function

```js
function sapa() {
  console.log("Halo, selamat datang!");
}

sapa(); // Halo, selamat datang!
sapa(); // bisa dipanggil berkali-kali
```

### Function dengan Parameter & Return

```js
function hitungTotal(harga, jumlah) {
  return harga * jumlah;
}

let total = hitungTotal(15000, 3);
console.log(total); // 45000
```

- **Parameter** (`harga`, `jumlah`) = data yang masuk ke function.
- **`return`** = nilai yang dikeluarkan function untuk dipakai di tempat lain.

### Arrow Function — Penulisan Modern

Cara singkat menulis function. Hasilnya sama, hanya sintaksnya beda. Kamu akan sering melihat ini di kode modern (dan wajib paham untuk React nanti).

```js
// Function biasa
function tambah(a, b) {
  return a + b;
}

// Arrow function — versi sama persis
const tambahArrow = (a, b) => {
  return a + b;
};

// Jika isinya cuma 1 baris return, bisa dipersingkat
const tambahSingkat = (a, b) => a + b;

console.log(tambahSingkat(3, 4)); // 7
```

> 💡 Ketiga cara di atas menghasilkan hal yang sama. Untuk sekarang, cukup bisa **membaca** dan **menulis** bentuk arrow function-nya.

---

## Array

Array adalah **kumpulan data dalam satu variable**, berurutan, diakses lewat indeks (dimulai dari 0).

### Membuat & Mengakses

```js
const buah = ["Apel", "Mangga", "Jeruk"];

console.log(buah[0]);      // "Apel"  — indeks mulai dari 0!
console.log(buah[2]);      // "Jeruk"
console.log(buah.length);  // 3 — jumlah item
```

### Menambah & Menghapus

```js
const daftar = ["A", "B", "C"];
daftar.push("D");  // tambah ke akhir → ["A","B","C","D"]
daftar.pop();      // hapus dari akhir → ["A","B","C"]
```

### `forEach` — Proses Setiap Item

Ini yang paling sering dipakai saat menampilkan data ke layar.

```js
const kota = ["Jakarta", "Bekasi", "Bogor"];

kota.forEach(function (item) {
  console.log("Kota: " + item);
});
```

### `map` & `filter` — Sering Dipakai (Sekilas)

```js
const harga = [10000, 25000, 50000];

// map: ubah tiap item, hasilkan array baru
const setelahDiskon = harga.map((h) => h * 0.9);
console.log(setelahDiskon); // [9000, 22500, 45000]

// filter: pilih item yang lolos kondisi
const mahal = harga.filter((h) => h >= 25000);
console.log(mahal); // [25000, 50000]
```

> 💡 `map` menghasilkan array **berukuran sama** (tiap item diubah). `filter` menghasilkan array **lebih pendek** (hanya yang lolos kondisi). Keduanya tidak mengubah array asli.

---

## Object

Object adalah **kumpulan data berpasangan key–value**. Cocok untuk mewakili satu "entitas" dengan banyak properti.

### Membuat & Mengakses

```js
const produk = {
  nama: "Susu 1 Liter",
  harga: 15000,
  tersedia: true
};

console.log(produk.nama);   // "Susu 1 Liter"
console.log(produk.harga);  // 15000

produk.harga = 17000;       // ubah nilai
console.log(produk.harga);  // 17000
```

### Array of Objects — Kombinasi Paling Umum

Ini adalah bentuk data yang paling sering kamu temui di aplikasi web nyata (daftar produk, daftar user, dll).

```js
const produkList = [
  { nama: "Laptop",     harga: 9990000, tersedia: true  },
  { nama: "Mouse",      harga: 150000,  tersedia: false },
  { nama: "Keyboard",   harga: 350000,  tersedia: true  },
];

produkList.forEach((p) => {
  console.log(`${p.nama} — Rp ${p.harga}`);
});
```

---

## DOM Manipulation

**DOM (Document Object Model)** adalah representasi halaman HTML sebagai struktur yang bisa dibaca dan diubah lewat JavaScript. Dengan DOM, kita bisa **mengambil, mengubah, menambah, dan menghapus** elemen HTML.

### Mengambil Elemen

```js
// Berdasarkan ID
const judul = document.getElementById("judul");

// Berdasarkan selector CSS (class, tag, dll)
const tombol = document.querySelector(".btn-kirim");
const semuaCard = document.querySelectorAll(".card"); // semua yang cocok
```

### Mengubah Konten, Style, dan Class

```js
const judul = document.getElementById("judul");

judul.textContent = "Teks Baru";     // ubah teks (aman)
judul.innerHTML = "<b>Teks Baru</b>";// ubah isi HTML (boleh ada tag)
judul.style.color = "red";           // ubah style CSS

// classList — cara rapi mengelola class CSS
judul.classList.add("aktif");        // tambah class
judul.classList.remove("nonaktif");  // hapus class
judul.classList.toggle("tersembunyi album");// tambah kalau belum ada, hapus kalau sudah
```

> 💡 `classList.toggle()` adalah kunci untuk fitur seperti tombol Follow/Unfollow dan show/hide — kita akan pakai di latihan.

### Menampilkan Data Array ke Halaman (Pola Paling Penting)

Ini pola inti aplikasi web modern: **simpan data di array → render ke layar dari array itu.**

```js
const produk = [
  { nama: "Laptop", harga: "Rp 9.990.000" },
  { nama: "Mouse",  harga: "Rp 150.000" },
];

function render() {
  const container = document.getElementById("daftarProduk");
  container.innerHTML = ""; // kosongkan dulu

  produk.forEach((p) => {
    const card = document.createElement("div");
    card.className = "card p-3 mb-2";
    card.innerHTML = `
      <h5>${p.nama}</h5>
      <p>${p.harga}</p>
    `;
    container.appendChild(card);
  });
}

render(); // panggil saat halaman dibuka
```

> 💡 **Pola ini penting sekali.** Setiap kali data berubah, kita ubah array-nya lalu panggil ulang `render()`. Inilah dasar cara kerja framework modern seperti React.

---

## Event Handling

Event adalah aksi yang terjadi di browser — klik, ketik, submit, dll. **Event handling** adalah cara JavaScript merespons aksi tersebut.

### addEventListener — Cara Standar

```js
const tombol = document.getElementById("btnKirim");

tombol.addEventListener("click", () => {
  alert("Tombol diklik!");
});
```

Event yang sering dipakai:

| Event | Kapan terjadi |
|-------|---------------|
| `click` | Elemen diklik |
| `input` | Nilai input berubah (real-time) |
| `change` | Nilai berubah & fokus meninggalkan elemen |
| `submit` | Form disubmit |

### Event Object — Info Tentang Event

Setiap listener menerima **event object** (biasanya diberi nama `e`), berisi detail tentang apa yang terjadi.

```js
document.getElementById("namaInput").addEventListener("input", (e) => {
  console.log(e.target.value); // nilai input saat ini
});
```

### Mencegah Reload saat Submit Form

```js
document.getElementById("formLogin").addEventListener("submit", (e) => {
  e.preventDefault(); // WAJIB — cegah halaman reload
  console.log("Form disubmit tanpa reload!");
});
```

> 💡 `e.preventDefault()` di event `submit` adalah hal yang hampir selalu kamu butuhkan saat mengolah form dengan JavaScript.

---

## Latihan

Sekarang gabungkan semuanya. Tiga latihan ini melatih tiga pola interaktivitas web yang paling sering dipakai. Kerjakan berurutan.

> ℹ️ Dua latihan tambahan (**mengambil data form** dan **membaca parameter URL**) sengaja dibawa ke **Pertemuan 7** agar tidak kelebihan beban di satu sesi. Kalau di kelas ini masih ada waktu, boleh dicicil duluan.

### Latihan 1 — Conditional View (Tampilkan/Sembunyikan Berdasarkan Kondisi)

Buat halaman yang menampilkan pesan berbeda tergantung status login.

```html
<div class="container p-4">
  <button id="btnToggleLogin" class="btn btn-primary">Ganti Status</button>

  <div id="areaSudahLogin" class="alert alert-success mt-3">
    ✅ Selamat datang kembali, Budi!
  </div>
  <div id="areaBelumLogin" class="alert alert-warning mt-3">
    ⚠️ Kamu belum login. Silakan login dulu.
  </div>
</div>
```

```js
let sudahLogin = false;

function updateTampilan() {
  const areaLogin = document.getElementById("areaSudahLogin");
  const areaBelum = document.getElementById("areaBelumLogin");

  // TODO: kalau sudahLogin true → tampilkan areaLogin, sembunyikan areaBelum
  // kalau false → sebaliknya
  // Petunjuk: pakai element.style.display = "none" / "block"
  // atau classList untuk menyembunyikan.
}

document.getElementById("btnToggleLogin").addEventListener("click", () => {
  sudahLogin = !sudahLogin; // balik status
  updateTampilan();
});

updateTampilan(); // set tampilan awal
```

**Kriteria berhasil:** Klik tombol → hanya satu area yang tampil sesuai status, dan bergantian setiap klik.

---

### Latihan 2 — Looping UI (Render Card / Table dari Array)

Diberikan sebuah array produk. Tampilkan sebagai kartu Bootstrap **tanpa menulis HTML kartu satu per satu** — biarkan JavaScript yang membuatnya dari data.

```html
<div class="container p-4">
  <h3>Daftar Produk</h3>
  <div id="daftarProduk" class="d-flex flex-wrap gap-3"></div>
</div>
```

```js
const produk = [
  { nama: "Laptop",     harga: 9990000, stok: 4 },
  { nama: "Mouse",      harga: 150000,  stok: 0 },
  { nama: "Keyboard",   harga: 350000,  stok: 12 },
  { nama: "Monitor",    harga: 2100000, stok: 3 },
];

function renderProduk() {
  const container = document.getElementById("daftarProduk");
  container.innerHTML = "";

  produk.forEach((p) => {
    // TODO: buat elemen card
    // TODO: isi nama & harga (format Rp)
    // TODO: kalau p.stok === 0, tampilkan badge "Habis", selain itu "Tersedia"
    //       (petunjuk: gunakan conditional di dalam template string)
    // TODO: appendChild ke container
  });
}

renderProduk();
```

**Kriteria berhasil:** Semua produk tampil sebagai card. Produk dengan `stok: 0` menunjukkan status "Habis". Menambah item baru ke array `produk` lalu memanggil `renderProduk()` menampilkan kartu baru.

> 🎯 **Variasi (opsional):** buat versi **tabel** (`<table>`) alih-alih card, dengan kolom Nama, Harga, Stok, Status.

---

### Latihan 3 — Toggle UI Status (Tombol Follow / Unfollow)

Buat tombol yang berganti antara "Follow" dan "Unfollow" setiap kali diklik, lengkap dengan perubahan warna.

```html
<div class="container p-4">
  <button id="btnFollow" class="btn btn-primary">Follow</button>
</div>
```

```js
let mengikuti = false;

const btn = document.getElementById("btnFollow");

btn.addEventListener("click", () => {
  // TODO: balik nilai mengikuti (true <-> false)
  // TODO: kalau mengikuti true:
  //        - teks tombol jadi "Unfollow"
  //        - ganti class jadi btn-secondary (petunjuk: classList.remove/add)
  //       kalau false:
  //        - teks tombol jadi "Follow"
  //        - class kembali ke btn-primary
});
```

**Kriteria berhasil:** Klik pertama → "Unfollow" (abu-abu), klik lagi → "Follow" (biru), dan seterusnya bergantian.

> 🎯 **Variasi (opsional):** tambahkan penghitung jumlah follower yang naik/turun 1 setiap kali status berubah.

---

## Ringkasan

| Konsep | Poin Penting |
|--------|--------------|
| **Function** | Parameter, `return`, arrow function |
| **Array** | `forEach`, `map`, `filter`, array of objects |
| **Object** | key–value, akses & ubah properti |
| **DOM** | `getElementById`, `querySelector`, `textContent`, `classList`, render dari array |
| **Event Handling** | `addEventListener`, `e.target`, `e.preventDefault()` |
| **Pola inti** | Data di array → render ke layar → update data → render ulang |

> ➡️ **Pertemuan berikutnya (P7):** kita lanjutkan sedikit JavaScript (mengambil data dari **form** dan membaca **parameter URL**), lalu belajar memakai **AI sebagai asisten coding** agar proses belajar & ngoding jauh lebih cepat.

---

## 📚 Referensi

- [Array Methods — MDN](https://developer.mozilla.org/id/docs/Web/JavaScript/Reference/Global_Objects/Array)
- [addEventListener — MDN](https://developer.mozilla.org/id/docs/Web/API/EventTarget/addEventListener)
- [Element.classList — MDN](https://developer.mozilla.org/en-US/docs/Web/API/Element/classList)
- [JavaScript.info — Array Methods](https://javascript.info/array-methods)

---

*Kalau kamu bisa membuat ketiga latihan di atas berjalan, artinya kamu sudah menguasai fondasi interaktivitas web. Dari sini, framework seperti React akan terasa jauh lebih masuk akal! 🎉*
