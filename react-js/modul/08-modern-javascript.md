# 8. Modern JavaScript (ES6+)

> **Tujuan bab ini:** Menggunakan fitur modern JavaScript: `let`/`const`, arrow function, destructuring, spread/rest, template literal

---

## Kenapa ES6+?

ES6 (ECMAScript 2015) adalah update besar JavaScript yang menambahkan banyak fitur baru. Hampir semua kode JavaScript modern menggunakan fitur-fitur ini. Beberapa sudah kita pakai di bab sebelumnya — di bab ini kita bahas lebih dalam.

---

## Template Literal

Sudah kita pakai sebelumnya — sekarang kita lihat fitur lengkapnya.

```javascript
const name = "Budi";
const age = 22;

// String biasa — sulit dibaca
const message1 = "Halo, nama saya " + name + " dan umur saya " + age + " tahun.";

// Template literal — jauh lebih bersih
const message2 = `Halo, nama saya ${name} dan umur saya ${age} tahun.`;

console.log(message2);
// "Halo, nama saya Budi dan umur saya 22 tahun."
```

### Multi-line String

```javascript
// Cara lama
const html1 = "<div>\n  <h1>Judul</h1>\n  <p>Paragraf</p>\n</div>";

// Template literal — langsung multi-line
const html2 = `
<div>
  <h1>Judul</h1>
  <p>Paragraf</p>
</div>
`;

console.log(html2);
```

### Ekspresi di Dalam Template Literal

```javascript
const price = 50000;
const qty = 3;

console.log(`Total: Rp${price * qty}`);         // Total: Rp150000
console.log(`Status: ${qty > 0 ? "Ada" : "Habis"}`); // Status: Ada
```

---

## Destructuring

Cara singkat untuk "membongkar" nilai dari array atau object ke variable terpisah.

### Object Destructuring

```javascript
const student = {
  name: "Budi",
  age: 20,
  major: "Teknik Informatika",
  gpa: 3.75
};

// Cara lama
const name = student.name;
const age = student.age;

// Destructuring
const { name, age, major, gpa } = student;

console.log(name);   // "Budi"
console.log(major);  // "Teknik Informatika"
```

### Rename saat Destructuring

```javascript
const user = { name: "Ani", age: 25 };

const { name: userName, age: userAge } = user;

console.log(userName); // "Ani"
console.log(userAge);  // 25
```

### Default Value

```javascript
const config = { theme: "dark" };

const { theme, language = "id" } = config;

console.log(theme);    // "dark"
console.log(language); // "id" — default karena tidak ada di config
```

### Array Destructuring

```javascript
const colors = ["Merah", "Hijau", "Biru"];

const [first, second, third] = colors;

console.log(first);  // "Merah"
console.log(second); // "Hijau"

// Skip elemen tertentu
const [, , lastColor] = colors;
console.log(lastColor); // "Biru"
```

### Destructuring di Parameter Function

Sangat berguna untuk function yang menerima object.

```javascript
// Tanpa destructuring
function displayProfile(user) {
  console.log(`${user.name} (${user.age})`);
}

// Dengan destructuring — lebih bersih
function displayProfile({ name, age }) {
  console.log(`${name} (${age})`);
}

displayProfile({ name: "Sari", age: 22 });
// "Sari (22)"
```

---

## Spread Operator (`...`)

Menyebarkan elemen array atau property object.

### Spread pada Array

```javascript
const numbers1 = [1, 2, 3];
const numbers2 = [4, 5, 6];

// Gabungkan array
const combined = [...numbers1, ...numbers2];
console.log(combined);  // [1, 2, 3, 4, 5, 6]

// Copy array (bukan referensi)
const copy = [...numbers1];
copy.push(99);
console.log(numbers1); // [1, 2, 3] — tidak berubah
console.log(copy);     // [1, 2, 3, 99]
```

### Spread pada Object

```javascript
const defaultConfig = {
  theme: "light",
  language: "id",
  fontSize: 14
};

const userConfig = {
  theme: "dark",
  fontSize: 16
};

// Merge — property userConfig menimpa defaultConfig
const finalConfig = { ...defaultConfig, ...userConfig };
console.log(finalConfig);
// { theme: "dark", language: "id", fontSize: 16 }
```

---

## Rest Operator (`...`)

Simbol sama dengan spread, tapi fungsinya kebalikan — mengumpulkan sisa elemen.

### Rest pada Array Destructuring

```javascript
const numbers = [1, 2, 3, 4, 5];

const [first, second, ...rest] = numbers;

console.log(first);  // 1
console.log(second); // 2
console.log(rest);   // [3, 4, 5]
```

### Rest pada Function Parameter

```javascript
function totalPrice(tax, ...itemPrices) {
  const subtotal = itemPrices.reduce((sum, p) => sum + p, 0);
  return subtotal * (1 + tax / 100);
}

console.log(totalPrice(10, 50000, 75000, 30000));
// 170500 — (50000+75000+30000) * 1.1
```

---

## Optional Chaining (`?.`)

Akses nested property dengan aman — return `undefined` jika chain terputus, bukan error.

```javascript
const user = {
  name: "Budi",
  address: {
    city: "Jakarta"
  }
};

// Aman
console.log(user.address?.city);     // "Jakarta"
console.log(user.phone?.home);       // undefined (bukan error)
console.log(user.address?.zipCode);  // undefined

// Tanpa optional chaining — ERROR
// console.log(user.phone.home);  // TypeError: Cannot read properties of undefined
```

---

## Nullish Coalescing (`??`)

Berikan nilai default hanya jika value `null` atau `undefined` (bukan falsy lainnya).

```javascript
const input1 = null;
const input2 = 0;
const input3 = "";

// ?? — hanya null/undefined yang diganti
console.log(input1 ?? "default");  // "default"
console.log(input2 ?? "default");  // 0  — nol bukan null
console.log(input3 ?? "default");  // "" — string kosong bukan null

// || — semua falsy diganti (sering tidak diinginkan)
console.log(input2 || "default");  // "default" — 0 dianggap falsy!
console.log(input3 || "default");  // "default" — "" dianggap falsy!
```

> **Catatan:** Gunakan `??` jika kamu hanya ingin handle `null`/`undefined`. Gunakan `||` jika memang ingin handle semua falsy value.

---

## Latihan

#### Latihan 1: Destructuring Data API

Diberikan response API berikut:

```javascript
const response = {
  status: 200,
  data: {
    user: {
      id: 1,
      name: "Budi Santoso",
      email: "budi@mail.com",
      roles: ["admin", "editor"]
    },
    token: "abc123xyz"
  }
};
```

Gunakan destructuring untuk mengekstrak: `name`, `email`, `roles` (role pertama saja), dan `token` menjadi variable terpisah. Tampilkan hasilnya.

**Contoh output yang diharapkan:**
```
Name: Budi Santoso
Email: budi@mail.com
Primary role: admin
Token: abc123xyz
```

<details>
<summary>Lihat Solusi</summary>

```javascript
const response = {
  status: 200,
  data: {
    user: {
      id: 1,
      name: "Budi Santoso",
      email: "budi@mail.com",
      roles: ["admin", "editor"]
    },
    token: "abc123xyz"
  }
};

const {
  data: {
    user: { name, email, roles: [primaryRole] },
    token
  }
} = response;

console.log(`Name: ${name}`);
console.log(`Email: ${email}`);
console.log(`Primary role: ${primaryRole}`);
console.log(`Token: ${token}`);
```

**Penjelasan:** Nested destructuring mengikuti struktur object asli. `roles: [primaryRole]` mengambil elemen pertama array `roles` dan menyimpannya sebagai `primaryRole`.

</details>

---

#### Latihan 2: Merge Config dengan Spread

Buat function `createConfig(userConfig)` yang menerima partial config dari user dan merge dengan default config. Gunakan spread operator.

Default config:
```javascript
{
  theme: "light",
  language: "id",
  fontSize: 14,
  sidebar: true,
  notifications: true
}
```

**Contoh output yang diharapkan:**
```
Config 1: { theme: "dark", language: "id", fontSize: 18, sidebar: true, notifications: true }
Config 2: { theme: "light", language: "en", fontSize: 14, sidebar: false, notifications: true }
Config 3: { theme: "light", language: "id", fontSize: 14, sidebar: true, notifications: true }
```

<details>
<summary>Lihat Solusi</summary>

```javascript
function createConfig(userConfig = {}) {
  const defaultConfig = {
    theme: "light",
    language: "id",
    fontSize: 14,
    sidebar: true,
    notifications: true
  };

  return { ...defaultConfig, ...userConfig };
}

const config1 = createConfig({ theme: "dark", fontSize: 18 });
const config2 = createConfig({ language: "en", sidebar: false });
const config3 = createConfig();

console.log("Config 1:", config1);
console.log("Config 2:", config2);
console.log("Config 3:", config3);
```

**Penjelasan:** `{ ...defaultConfig, ...userConfig }` — property di `userConfig` menimpa yang sama di `defaultConfig`, sisanya tetap. Parameter `userConfig = {}` memastikan function tetap bekerja tanpa argument.

</details>

---

#### Latihan 3: Data Processing Pipeline

Diberikan data transaksi. Gunakan semua fitur modern yang sudah dipelajari (destructuring, spread, arrow function, optional chaining, method chaining) untuk:
1. Filter transaksi yang sukses
2. Hitung total per kategori
3. Tampilkan ringkasan

```javascript
const transactions = [
  { id: 1, item: "Laptop", category: "Elektronik", price: 12000000, status: "success" },
  { id: 2, item: "Buku JS", category: "Pendidikan", price: 150000, status: "success" },
  { id: 3, item: "Headset", category: "Elektronik", price: 500000, status: "failed" },
  { id: 4, item: "Kursus React", category: "Pendidikan", price: 300000, status: "success" },
  { id: 5, item: "Mouse", category: "Elektronik", price: 250000, status: "success" },
  { id: 6, item: "Keyboard", category: "Elektronik", price: 750000, status: "pending" }
];
```

**Contoh output yang diharapkan:**
```
=== Ringkasan Transaksi Sukses ===
Elektronik: 2 transaksi — Rp12250000
Pendidikan: 2 transaksi — Rp450000
---
Grand total: Rp12700000
```

<details>
<summary>Lihat Solusi</summary>

```javascript
const transactions = [
  { id: 1, item: "Laptop", category: "Elektronik", price: 12000000, status: "success" },
  { id: 2, item: "Buku JS", category: "Pendidikan", price: 150000, status: "success" },
  { id: 3, item: "Headset", category: "Elektronik", price: 500000, status: "failed" },
  { id: 4, item: "Kursus React", category: "Pendidikan", price: 300000, status: "success" },
  { id: 5, item: "Mouse", category: "Elektronik", price: 250000, status: "success" },
  { id: 6, item: "Keyboard", category: "Elektronik", price: 750000, status: "pending" }
];

// Filter sukses
const successful = transactions.filter(({ status }) => status === "success");

// Group by category dan hitung total
const byCategory = successful.reduce((groups, { category, price }) => {
  const existing = groups[category] ?? { count: 0, total: 0 };
  return {
    ...groups,
    [category]: {
      count: existing.count + 1,
      total: existing.total + price
    }
  };
}, {});

// Tampilkan ringkasan
console.log("=== Ringkasan Transaksi Sukses ===");

let grandTotal = 0;
for (const [category, { count, total }] of Object.entries(byCategory)) {
  console.log(`${category}: ${count} transaksi — Rp${total}`);
  grandTotal += total;
}

console.log("---");
console.log(`Grand total: Rp${grandTotal}`);
```

**Penjelasan:** Latihan ini menggabungkan banyak fitur ES6+: destructuring di `filter` callback (`{ status }`), destructuring di `reduce` (`{ category, price }`), spread operator untuk immutable update (`...groups`), nullish coalescing (`??`), computed property names (`[category]`), dan destructuring di `for...of` loop.

</details>
