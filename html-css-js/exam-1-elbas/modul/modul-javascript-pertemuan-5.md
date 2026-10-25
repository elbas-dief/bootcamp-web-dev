# Modul Pengajaran: Intro Web Programming & JavaScript Basic
**Haltev IT Learning Center — Web Development**
**Pertemuan 5 | Tools: VS Code + Chrome DevTools**

---

## Tujuan Pembelajaran

Siswa mampu memahami konsep dasar pemrograman menggunakan JavaScript — cara menyimpan data, mengolahnya dengan operator, membuat keputusan dengan conditional, dan mengulang proses dengan loop. Di akhir pertemuan, siswa bisa menulis logika program sederhana untuk kasus nyata seperti menghitung harga, diskon, gaji, dan pajak.

> 📌 **Fokus pertemuan ini adalah LOGIKA, bukan tampilan.** Kita bekerja di Console dulu. Cara membuat halaman web jadi interaktif (DOM, tombol, event) akan dibahas di Pertemuan 6.

---

## Daftar Isi

- [Recap Pertemuan 4](#recap-pertemuan-4)
- [Apa itu JavaScript?](#apa-itu-javascript)
- [Cara Menjalankan JavaScript](#cara-menjalankan-javascript)
- [Variable](#variable)
- [Tipe Data](#tipe-data)
- [Operator](#operator)
- [Conditional (If/Else)](#conditional-ifelse)
- [Loop](#loop)
- [Latihan](#latihan)
- [Ringkasan](#ringkasan)

---

## Recap Pertemuan 4

Sebelum mulai, pastikan kamu sudah paham ini dari pertemuan sebelumnya:

| Konsep | Contoh |
|--------|--------|
| Flexbox | `display: flex`, `justify-content`, `align-items` |
| CSS Grid | `display: grid`, `grid-template-columns` |
| Bootstrap Grid | `container`, `row`, `col-md-4` |
| Komponen Bootstrap | `navbar`, `card`, `btn` |

Sampai di sini kamu sudah bisa membuat halaman web yang **rapi dan responsif** — tapi masih **statis**. Halaman belum bisa "berpikir" atau merespons apapun. Di sinilah JavaScript masuk.

---

## Apa itu JavaScript?

**JavaScript (JS)** adalah bahasa pemrograman yang membuat halaman web menjadi **interaktif dan dinamis**.

Kalau diibaratkan sebuah rumah:

| Bagian | Peran |
|--------|-------|
| **HTML** | Kerangka & ruangan (struktur) |
| **CSS** | Cat, furnitur, dekorasi (tampilan) |
| **JavaScript** | Listrik & otak (logika & interaksi) |

Contoh hal yang bisa dilakukan JavaScript:
- Menghitung total belanja secara otomatis
- Memvalidasi isian form sebelum dikirim
- Menampilkan pesan saat tombol diklik
- Mengambil data dari server tanpa reload halaman

> 💡 JavaScript berjalan langsung di browser — tidak perlu install apapun untuk menjalankannya!

---

## Cara Menjalankan JavaScript

Di pertemuan ini kita akan sering pakai **Console** karena fokus kita adalah logika, bukan tampilan.

### 1. Lewat Console Browser (paling cepat untuk belajar)

Buka Chrome → klik kanan → **Inspect** → tab **Console**. Ketik kode langsung di sana dan tekan Enter.

```js
console.log("Halo dari Console!");
```

### 2. Lewat File Eksternal (untuk project)

```html
<!-- Di dalam index.html, sebelum </body> -->
<script src="script.js"></script>
```

```js
// Di dalam script.js
console.log("Halo dari file eksternal!");
```

> 💡 `console.log()` adalah alat paling penting saat belajar. Gunakan terus untuk mengintip nilai variabel dan memastikan program berjalan seperti yang kamu harapkan.

```js
console.log("Teks");   // menampilkan teks
console.log(42);        // menampilkan angka
console.log(10 + 5);    // menampilkan hasil hitungan → 15
```

---

## Variable

Variable adalah **tempat menyimpan data**. Bayangkan variable seperti kotak bernama yang bisa kamu isi dengan nilai, lalu kamu panggil lagi nanti.

### `let` — Nilai bisa berubah

```js
let nama = "Budi";
nama = "Siti"; // ✅ boleh diubah

let saldo = 50000;
saldo = 75000; // ✅ boleh diubah
```

### `const` — Nilai tidak boleh berubah

```js
const namaSekolah = "Haltev";
const PPN = 0.11; // tarif pajak tetap
// PPN = 0.12; // ❌ Error! const tidak bisa diubah
```

### `var` — Cara lama (hindari)

```js
var x = 10; // ⚠️ Masih jalan, tapi gunakan let/const saja
```

> 🔑 **Aturan praktis:** Gunakan `const` sebagai default. Ganti ke `let` hanya kalau nilainya memang akan berubah. Hindari `var`.

### Aturan Penamaan Variable

```js
// ✅ Boleh
let namaLengkap = "Budi Santoso";  // camelCase — konvensi JavaScript
let hargaBarang = 25000;
let _diskon = 0.2;

// ❌ Tidak boleh
let 1angka = 10;     // tidak boleh diawali angka
let nama lengkap;    // tidak boleh ada spasi
let let = "test";    // tidak boleh pakai kata reserved (let, const, if, dll)
```

---

## Tipe Data

JavaScript mengenal beberapa jenis data. Lima yang paling sering kamu temui di awal:

### String — Teks

Selalu diapit tanda kutip.

```js
let nama = "Budi Santoso";
let kota = 'Bekasi';           // kutip tunggal juga boleh
let sapaan = `Halo, ${nama}!`; // template literal — bisa sisipkan variable
```

> 💡 **Template literal** (pakai backtick `` ` ``) sangat berguna untuk menggabung teks dengan variable, tanpa ribet menyambung pakai `+`.

### Number — Angka

Tidak pakai tanda kutip. Bilangan bulat maupun desimal sama-sama Number.

```js
let umur = 25;
let harga = 15000.50;
let suhu = -3;
```

### Boolean — Benar atau Salah

Hanya punya dua nilai: `true` atau `false`. Ini pondasi untuk conditional nanti.

```js
let sudahLogin = true;
let stokHabis = false;
```

### Null & Undefined — "Kosong"

```js
let data = null;      // sengaja dikosongkan
let belumDiisi;       // undefined — variable ada tapi belum diberi nilai
console.log(belumDiisi); // undefined
```

### Cek Tipe Data dengan `typeof`

```js
console.log(typeof "Halo");   // "string"
console.log(typeof 42);       // "number"
console.log(typeof true);     // "boolean"
console.log(typeof undefined);// "undefined"
```

### Konversi Teks ke Angka

Data dari form atau input selalu berupa **string**, jadi sering perlu diubah dulu ke Number sebelum dihitung.

```js
let hargaTeks = "15000";
let hargaAngka = Number(hargaTeks); // 15000 (number)
let jumlah = parseInt("3 barang");  // 3 (ambil angka di depan)
let berat = parseFloat("2.5 kg");   // 2.5

console.log("15000" + 5);  // "150005" ❌ (dianggap gabung teks!)
console.log(Number("15000") + 5); // 15005 ✅
```

> ⚠️ Salah satu bug paling umum pemula: menjumlahkan angka yang ternyata masih berbentuk string. Selalu ubah ke Number dulu sebelum berhitung.

---

## Operator

### Operator Aritmatika

```js
let a = 10;
let b = 3;

console.log(a + b);  // 13 — penjumlahan
console.log(a - b);  // 7  — pengurangan
console.log(a * b);  // 30 — perkalian
console.log(a / b);  // 3.33... — pembagian
console.log(a % b);  // 1  — sisa bagi (modulus)
```

> 💡 **Modulus (`%`)** memberi sisa pembagian. Sangat berguna, misalnya untuk cek angka genap/ganjil: `angka % 2 === 0` berarti genap.

### Operator Penugasan

```js
let total = 100;
total += 50;  // total = total + 50 → 150
total -= 20;  // total = total - 20 → 130
total *= 2;   // total = total * 2  → 260
total++;      // total = total + 1  → 261
total--;      // total = total - 1  → 260
```

### Operator Perbandingan — Hasilnya Boolean

```js
console.log(5 == "5");   // true  — membandingkan NILAI saja
console.log(5 === "5");  // false — membandingkan nilai DAN tipe (disarankan ✅)
console.log(5 !== 3);    // true
console.log(10 > 5);     // true
console.log(10 <= 10);   // true
```

> ⚠️ Selalu gunakan `===` (tiga sama dengan) dan `!==`. Lebih aman karena mengecek tipe juga, menghindari bug halus.

### Operator Logika

```js
// && (AND) — benar jika KEDUANYA benar
console.log(true && true);    // true
console.log(true && false);   // false

// || (OR) — benar jika SALAH SATU benar
console.log(false || true);   // true
console.log(false || false);  // false

// ! (NOT) — membalik nilai
console.log(!true);   // false
```

Contoh nyata:

```js
let umur = 20;
let punyaKTP = true;

// Boleh daftar jika umur minimal 17 DAN punya KTP
console.log(umur >= 17 && punyaKTP); // true
```

---

## Conditional (If/Else)

Conditional digunakan untuk **membuat keputusan** — "jika kondisi ini benar, lakukan ini; jika tidak, lakukan itu."

### If/Else Dasar

```js
let umur = 17;

if (umur >= 18) {
  console.log("Boleh masuk");
} else {
  console.log("Tidak boleh masuk");
}
```

### If/Else If/Else — Banyak Kondisi

```js
let nilai = 85;

if (nilai >= 90) {
  console.log("Grade A");
} else if (nilai >= 80) {
  console.log("Grade B");
} else if (nilai >= 70) {
  console.log("Grade C");
} else if (nilai >= 60) {
  console.log("Grade D");
} else {
  console.log("Grade E");
}
```

### Contoh Nyata: Hitung Diskon Berdasarkan Belanja

```js
let totalBelanja = 250000;
let diskon = 0;

if (totalBelanja >= 500000) {
  diskon = 0.20; // 20%
} else if (totalBelanja >= 200000) {
  diskon = 0.10; // 10%
} else {
  diskon = 0;    // tidak ada diskon
}

let potongan = totalBelanja * diskon;
let bayar = totalBelanja - potongan;

console.log("Diskon: " + (diskon * 100) + "%");   // Diskon: 10%
console.log("Potongan: Rp " + potongan);          // Potongan: Rp 25000
console.log("Total bayar: Rp " + bayar);          // Total bayar: Rp 225000
```

> 💡 Perhatikan urutannya: cek kondisi **paling besar dulu**. Kalau `>= 200000` dicek lebih dulu, belanja 500rb akan salah masuk ke diskon 10%.

### Switch — Alternatif untuk Banyak Pilihan Pasti

Cocok saat membandingkan satu variable dengan beberapa nilai tetap.

```js
let hari = "Senin";

switch (hari) {
  case "Sabtu":
  case "Minggu":
    console.log("Libur 😴");
    break;
  default:
    console.log("Hari kerja 💼");
}
```

---

## Loop

Loop digunakan untuk **mengulangi sesuatu** berkali-kali tanpa menulis kode yang sama berulang.

### For Loop — Ulangi Sejumlah Kali

```js
for (let i = 1; i <= 5; i++) {
  console.log("Hitungan ke-" + i);
}
// Output: Hitungan ke-1, ke-2, ke-3, ke-4, ke-5
```

Struktur: `for (nilai awal; kondisi berhenti; langkah)`

```js
// Contoh: Tabel perkalian 7
for (let i = 1; i <= 10; i++) {
  console.log(`7 x ${i} = ${7 * i}`);
}
```

### While Loop — Ulangi Selama Kondisi Benar

```js
let stok = 5;

while (stok > 0) {
  console.log("Stok tersisa: " + stok);
  stok--; // WAJIB ada — kalau tidak, loop tidak pernah berhenti!
}
```

> ⚠️ Pastikan kondisi `while` suatu saat menjadi `false`, kalau tidak program akan hang (infinite loop).

### Contoh Nyata: Total dari Beberapa Item

```js
let hargaHarian = [30000, 45000, 20000, 55000, 15000];
let totalMinggu = 0;

for (let i = 0; i < hargaHarian.length; i++) {
  totalMinggu += hargaHarian[i];
}

console.log("Total pengeluaran: Rp " + totalMinggu); // Rp 165000
```

> 💡 Di sini kita "mengintip" array sebentar hanya sebagai kumpulan angka. Array secara lengkap (beserta method-nya) akan dibahas tuntas di Pertemuan 6.

---

## Latihan

Kerjakan di Console atau di file `.js`. Fokus ke **logika dan `console.log`** — belum perlu menyentuh HTML. Mulai dari Latihan 1, naik bertahap.

### Latihan 1 — Kalkulator Harga Total (Mudah)

Sebuah toko menjual barang. Buat program yang menghitung total harga.

```js
const namaBarang = "Beras 5kg";
const hargaSatuan = 62000;
const jumlah = 3;

// TODO: hitung total = hargaSatuan * jumlah
// TODO: tampilkan: "Beras 5kg x 3 = Rp 186000"
```

**Kriteria berhasil:** Output menampilkan nama barang, jumlah, dan total yang benar.

---

### Latihan 2 — Diskon Member (Sedang)

Toko memberi diskon berdasarkan status member:
- Member **Gold** → diskon 20%
- Member **Silver** → diskon 10%
- **Non-member** → tidak ada diskon

```js
const totalBelanja = 300000;
const statusMember = "Silver"; // coba ganti-ganti: "Gold", "Silver", "Biasa"

// TODO: pakai if/else if/else untuk menentukan diskon
// TODO: hitung potongan dan total yang harus dibayar
// TODO: tampilkan hasilnya dengan console.log
```

**Kriteria berhasil:** Ganti nilai `statusMember`, hasil diskon dan total bayar ikut berubah dengan benar.

---

### Latihan 3 — Hitung Gaji Bersih + Lembur (Sedang)

Seorang karyawan punya gaji pokok. Hitung gaji bersihnya.

```js
const gajiPokok = 4000000;
const jamLembur = 12;        // total jam lembur bulan ini
const upahLemburPerJam = 35000;
const potonganBPJS = 0.03;   // 3% dari gaji pokok

// TODO: hitung totalLembur = jamLembur * upahLemburPerJam
// TODO: hitung potongan = gajiPokok * potonganBPJS
// TODO: hitung gajiBersih = gajiPokok + totalLembur - potongan
// TODO: tampilkan rincian: gaji pokok, lembur, potongan, gaji bersih
```

**Kriteria berhasil:** Semua komponen ditampilkan dan gaji bersih dihitung tepat.

---

### Latihan 4 — Pajak Progresif Sederhana (Menantang)

Hitung pajak penghasilan tahunan dengan aturan sederhana berikut (berdasarkan penghasilan setahun):
- Sampai Rp 60.000.000 → **5%**
- Di atas Rp 60.000.000 s.d. Rp 250.000.000 → **15%**
- Di atas Rp 250.000.000 → **25%**

```js
const penghasilanTahunan = 120000000;

// TODO: tentukan tarif pakai if/else if/else
// TODO: hitung pajak = penghasilanTahunan * tarif
// TODO: tampilkan tarif (%) dan jumlah pajak
```

**Kriteria berhasil:** Coba tiga nilai penghasilan berbeda (misal 50jt, 120jt, 300jt), tarif dan pajaknya benar untuk ketiganya.

> 🎯 **Bonus (opsional):** Tambahkan loop `for` untuk mencetak simulasi pajak dari 5 orang karyawan dengan penghasilan berbeda dalam sebuah array.

---

## Ringkasan

| Konsep | Kegunaan |
|--------|----------|
| **Variable** (`let`, `const`) | Menyimpan data |
| **Tipe Data** | String, Number, Boolean, Null, Undefined |
| **Konversi** (`Number`, `parseInt`) | Mengubah teks jadi angka sebelum dihitung |
| **Operator** | Aritmatika (`+ - * / %`), Perbandingan (`===`), Logika (`&&`, `\|\|`, `!`) |
| **Conditional** (`if/else`, `switch`) | Membuat keputusan berdasarkan kondisi |
| **Loop** (`for`, `while`) | Mengulang kode berkali-kali |

> ➡️ **Pertemuan berikutnya (P6):** kita akan pakai semua logika ini untuk membuat halaman web yang benar-benar **hidup dan interaktif** — menampilkan data ke layar, merespons klik, dan mengubah tampilan secara dinamis dengan **function, array, object, DOM, dan event handling**.

---

## 📚 Referensi

- [JavaScript — MDN Web Docs (Bahasa Indonesia)](https://developer.mozilla.org/id/docs/Web/JavaScript)
- [JavaScript.info — Tutorial Lengkap](https://javascript.info/)
- [Chrome DevTools Console](https://developer.chrome.com/docs/devtools/console/)

---

*Selamat belajar JavaScript! 🚀 Ini langkah pertama menjadi developer — mulai sekarang kamu tidak hanya menata tampilan, tapi juga mengajari komputer cara berpikir.*
