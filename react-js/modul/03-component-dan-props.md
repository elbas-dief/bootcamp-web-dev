# 3. Component & Props

> **Tujuan:** memahami cara membuat komponen yang reusable dan meneruskan data ke dalamnya melalui props.

---

## Apa itu Komponen?

Komponen adalah **function JavaScript yang mengembalikan JSX**. Komponen mewakili bagian UI yang mandiri dan bisa digunakan kembali.

```jsx
// Komponen paling sederhana
function Salam() {
    return <h1>Halo, Dunia!</h1>;
}
```

Aturan penamaan komponen: **selalu diawali huruf kapital**. React membedakan komponen (`<Salam />`) dari elemen HTML biasa (`<div />`) berdasarkan huruf pertama.

### Menggunakan Komponen

```jsx
function App() {
    return (
        <div>
            <Salam />
            <Salam />
            <Salam />
        </div>
    );
}
```

Komponen bisa digunakan berkali-kali — setiap penggunaan adalah **instance** yang independen.

---

## Props

Props (properties) adalah cara meneruskan data **dari komponen induk ke komponen anak**. Props bersifat **read-only** — komponen anak tidak boleh mengubah props yang diterima.

```jsx
// Komponen menerima props sebagai parameter pertama
function KartuProduk(props) {
    return (
        <div className="kartu">
            <h2>{props.nama}</h2>
            <p>Rp {props.harga.toLocaleString('id-ID')}</p>
            <span>{props.tersedia ? 'Tersedia' : 'Habis'}</span>
        </div>
    );
}

// Meneruskan props saat menggunakan komponen
function App() {
    return (
        <div>
            <KartuProduk nama="Kaos Putih" harga={75000} tersedia={true} />
            <KartuProduk nama="Celana Jeans" harga={150000} tersedia={false} />
        </div>
    );
}
```

String bisa ditulis langsung (`nama="Kaos Putih"`). Nilai lain (number, boolean, object, array, function) harus dibungkus `{}`.

---

## Destructuring Props

Lebih umum menggunakan destructuring langsung di parameter:

```jsx
// Cara biasa
function KartuProduk(props) {
    return <h2>{props.nama}</h2>;
}

// Dengan destructuring — lebih ringkas
function KartuProduk({ nama, harga, tersedia }) {
    return (
        <div>
            <h2>{nama}</h2>
            <p>Rp {harga.toLocaleString('id-ID')}</p>
            <span>{tersedia ? 'Tersedia' : 'Habis'}</span>
        </div>
    );
}
```

### Default Props

Nilai default jika props tidak diteruskan:

```jsx
function Tombol({ label = 'Klik', warna = 'blue', ukuran = 'medium' }) {
    return (
        <button style={{ backgroundColor: warna }} className={`btn-${ukuran}`}>
            {label}
        </button>
    );
}

// Menggunakan semua default
<Tombol />

// Override sebagian
<Tombol label="Simpan" warna="green" />
```

---

## Props Bisa Berupa Apapun

### Object dan Array

```jsx
function ProfilPengguna({ user }) {
    return (
        <div>
            <h2>{user.nama}</h2>
            <p>{user.email}</p>
        </div>
    );
}

const userData = { nama: 'Andi', email: 'andi@email.com' };

<ProfilPengguna user={userData} />
```

### Function (Event Handler)

```jsx
function Tombol({ label, onClick }) {
    return <button onClick={onClick}>{label}</button>;
}

function App() {
    function handleKlik() {
        alert('Tombol diklik!');
    }

    return <Tombol label="Klik Saya" onClick={handleKlik} />;
}
```

---

## Props Children

Konten yang ditulis di antara tag pembuka dan penutup komponen diteruskan sebagai `children`:

```jsx
function Kartu({ children, judul }) {
    return (
        <div className="kartu">
            <h2>{judul}</h2>
            <div className="konten">{children}</div>
        </div>
    );
}

// Penggunaan — konten di dalam tag menjadi children
function App() {
    return (
        <Kartu judul="Info Produk">
            <p>Deskripsi produk ada di sini.</p>
            <button>Beli Sekarang</button>
        </Kartu>
    );
}
```

`children` sangat berguna untuk membuat komponen pembungkus (wrapper) yang fleksibel seperti modal, card, atau layout.

---

## Spread Props

Jika objek memiliki banyak properti yang cocok dengan props komponen, gunakan spread:

```jsx
const produkData = {
    nama: 'Kaos Putih',
    harga: 75000,
    tersedia: true,
};

// Tanpa spread — verbose
<KartuProduk nama={produkData.nama} harga={produkData.harga} tersedia={produkData.tersedia} />

// Dengan spread — ringkas
<KartuProduk {...produkData} />
```

---

## Alur Data Satu Arah

React menggunakan **one-way data flow** — data mengalir dari induk ke anak, tidak sebaliknya. Ini membuat alur data mudah diprediksi.

```
App (punya data)
 └── ProductList (menerima data via props)
      └── ProductCard (menerima satu item via props)
```

Jika anak perlu mengubah data di induk, caranya adalah meneruskan **function** dari induk ke anak (dibahas di bab Event Handling).

---

## Latihan

Buat halaman daftar produk dengan struktur komponen berikut:

```
App
└── DaftarProduk
    ├── KartuProduk (Kaos Putih, 75000, tersedia)
    ├── KartuProduk (Celana Jeans, 150000, tidak tersedia)
    └── KartuProduk (Sepatu Sneaker, 350000, tersedia)
```

Ketentuan:
- `KartuProduk` menerima props: `nama`, `harga`, `kategori`, `tersedia`, `gambar` (URL string).
- Tampilkan harga dalam format Rupiah.
- Badge "Tersedia" berwarna hijau, "Habis" berwarna merah.
- Buat komponen `Tombol` yang reusable dengan props `label` dan `onClick`, gunakan di dalam `KartuProduk`.

### Showcase

```
┌─────────────────┐  ┌─────────────────┐  ┌─────────────────┐
│ [gambar]        │  │ [gambar]        │  │ [gambar]        │
│ Kaos Putih      │  │ Celana Jeans    │  │ Sepatu Sneaker  │
│ Rp 75.000       │  │ Rp 150.000      │  │ Rp 350.000      │
│ 🟢 Tersedia     │  │ 🔴 Habis        │  │ 🟢 Tersedia     │
│ [Beli Sekarang] │  │ [Sold Out]      │  │ [Beli Sekarang] │
└─────────────────┘  └─────────────────┘  └─────────────────┘
```
