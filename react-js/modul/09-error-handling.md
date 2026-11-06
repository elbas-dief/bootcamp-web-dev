# 9. Error Handling

> **Tujuan bab ini:** Menangani error menggunakan `try/catch/finally`, `throw`, dan custom Error

---

## Kenapa Error Handling?

Tanpa error handling, satu error bisa membuat **seluruh program berhenti**.

```javascript
const data = JSON.parse("ini bukan JSON"); // SyntaxError!
console.log("Baris ini tidak pernah jalan");
```

Dengan error handling, program tetap berjalan meskipun ada error:

```javascript
try {
  const data = JSON.parse("ini bukan JSON");
} catch (err) {
  console.log("Gagal parse:", err.message);
}
console.log("Program tetap jalan");

// Output:
// Gagal parse: Unexpected token 'i', "ini bukan JSON" is not valid JSON
// Program tetap jalan
```

---

## `try` / `catch`

```javascript
try {
  // kode yang mungkin error
  const result = riskyOperation();
  console.log(result);
} catch (error) {
  // dijalankan jika ada error di blok try
  console.log("Terjadi error:", error.message);
}
```

### Error Object

Object `error` yang ditangkap punya beberapa property:

```javascript
try {
  const obj = undefined;
  obj.name; // TypeError!
} catch (err) {
  console.log(err.name);    // "TypeError"
  console.log(err.message); // "Cannot read properties of undefined (reading 'name')"
  console.log(err.stack);   // stack trace lengkap (berguna untuk debugging)
}
```

---

## `finally`

Blok `finally` **selalu dijalankan** — baik ada error maupun tidak. Cocok untuk cleanup.

```javascript
function readFile(fileName) {
  console.log(`Membuka file ${fileName}...`);

  try {
    if (fileName === "corrupt.txt") {
      throw new Error("File corrupt");
    }
    console.log("Membaca isi file...");
    return "isi file";
  } catch (err) {
    console.log("Error:", err.message);
    return null;
  } finally {
    console.log(`Menutup file ${fileName}`); // selalu jalan
  }
}

readFile("data.txt");
// Membuka file data.txt...
// Membaca isi file...
// Menutup file data.txt

readFile("corrupt.txt");
// Membuka file corrupt.txt...
// Error: File corrupt
// Menutup file corrupt.txt
```

> **Catatan:** `finally` jalan bahkan jika ada `return` di dalam `try` atau `catch`. Berguna untuk menutup koneksi, menyembunyikan loading spinner, atau membersihkan resource.

---

## `throw` — Melempar Error Sendiri

Kamu bisa membuat dan melempar error sendiri menggunakan `throw`.

```javascript
function divide(a, b) {
  if (b === 0) {
    throw new Error("Tidak bisa membagi dengan nol");
  }
  return a / b;
}

try {
  console.log(divide(10, 2));  // 5
  console.log(divide(10, 0));  // throw Error!
} catch (err) {
  console.log("Error:", err.message); // "Tidak bisa membagi dengan nol"
}
```

### Validasi Input dengan `throw`

```javascript
function registerUser(name, email, age) {
  if (!name || name.trim() === "") {
    throw new Error("Nama wajib diisi");
  }
  if (!email.includes("@")) {
    throw new Error("Format email tidak valid");
  }
  if (age < 17) {
    throw new Error("Umur minimal 17 tahun");
  }

  return { name, email, age, registered: true };
}

try {
  const user = registerUser("Budi", "budi@mail.com", 20);
  console.log("Berhasil:", user);
} catch (err) {
  console.log("Gagal daftar:", err.message);
}

try {
  const user = registerUser("", "budi@mail.com", 20);
} catch (err) {
  console.log("Gagal daftar:", err.message); // "Nama wajib diisi"
}
```

---

## Tipe-tipe Error Bawaan

JavaScript punya beberapa tipe error built-in:

```javascript
// ReferenceError — variable tidak ada
try {
  console.log(undefinedVariable);
} catch (err) {
  console.log(err.name); // "ReferenceError"
}

// TypeError — operasi pada tipe yang salah
try {
  null.toString();
} catch (err) {
  console.log(err.name); // "TypeError"
}

// SyntaxError — kode tidak valid (biasanya saat JSON.parse)
try {
  JSON.parse("{invalid}");
} catch (err) {
  console.log(err.name); // "SyntaxError"
}

// RangeError — nilai di luar range
try {
  const arr = new Array(-1);
} catch (err) {
  console.log(err.name); // "RangeError"
}
```

### Mengecek Tipe Error

```javascript
try {
  JSON.parse("bukan json");
} catch (err) {
  if (err instanceof SyntaxError) {
    console.log("Format JSON salah");
  } else if (err instanceof TypeError) {
    console.log("Tipe data salah");
  } else {
    console.log("Error tidak dikenal:", err.message);
  }
}
```

---

## Custom Error

Buat class error sendiri untuk kasus spesifik di aplikasimu.

```javascript
class ValidationError extends Error {
  constructor(field, message) {
    super(message);
    this.name = "ValidationError";
    this.field = field;
  }
}

class NotFoundError extends Error {
  constructor(resource, id) {
    super(`${resource} dengan ID ${id} tidak ditemukan`);
    this.name = "NotFoundError";
    this.resource = resource;
    this.id = id;
  }
}

function findProduct(id) {
  const products = [
    { id: 1, name: "Laptop" },
    { id: 2, name: "Mouse" }
  ];

  const result = products.find(p => p.id === id);

  if (!result) {
    throw new NotFoundError("Product", id);
  }

  return result;
}

try {
  const p = findProduct(99);
} catch (err) {
  if (err instanceof NotFoundError) {
    console.log(`${err.resource} ID ${err.id} tidak ada`);
    // "Product ID 99 tidak ada"
  } else {
    console.log("Error:", err.message);
  }
}
```

---

## Pattern: Error Handling di Function Chain

Throw di dalam, catch di luar — biarkan error naik ke pemanggil.

```javascript
function parseConfig(jsonString) {
  try {
    return JSON.parse(jsonString);
  } catch {
    throw new Error("Format config tidak valid");
  }
}

function validateConfig(config) {
  if (!config.database) {
    throw new ValidationError("database", "Field database wajib ada");
  }
  if (!config.port) {
    throw new ValidationError("port", "Field port wajib ada");
  }
  return config;
}

function loadConfig(jsonString) {
  const config = parseConfig(jsonString);
  return validateConfig(config);
}

// Pemanggil yang handle error
try {
  const config = loadConfig('{"port": 3000}');
  console.log(config);
} catch (err) {
  if (err instanceof ValidationError) {
    console.log(`Validasi gagal [${err.field}]: ${err.message}`);
  } else {
    console.log("Error:", err.message);
  }
}
// Output: Validasi gagal [database]: Field database wajib ada
```

> **Catatan:** Tidak perlu `try/catch` di setiap function. Lempar error di tempat masalah terdeteksi, tangkap di tempat yang bisa menangani (biasanya di level paling luar).

---

## Latihan

#### Latihan 1: Safe JSON Parser

Buat function `safeParseJSON(str)` yang:
- Mencoba parse string JSON
- Jika berhasil, return `{ success: true, data: ... }`
- Jika gagal, return `{ success: false, error: "pesan error" }`
- Jangan sampai throw error ke pemanggil

**Contoh output yang diharapkan:**
```
{ success: true, data: { name: "Budi", age: 22 } }
{ success: false, error: "Format JSON tidak valid" }
{ success: true, data: [1, 2, 3] }
```

<details>
<summary>Lihat Solusi</summary>

```javascript
function safeParseJSON(str) {
  try {
    const data = JSON.parse(str);
    return { success: true, data };
  } catch (err) {
    return { success: false, error: "Format JSON tidak valid" };
  }
}

console.log(safeParseJSON('{"name":"Budi","age":22}'));
console.log(safeParseJSON("ini bukan json"));
console.log(safeParseJSON("[1,2,3]"));
```

**Penjelasan:** `try/catch` menangkap `SyntaxError` dari `JSON.parse`. Alih-alih throw error, function return object dengan status — pemanggil cukup cek `result.success` tanpa perlu `try/catch` sendiri. Pattern ini disebut **Result pattern**.

</details>

---

#### Latihan 2: Validasi Form dengan Custom Error

Buat `ValidationError` class dan function `validateRegistration(data)` yang:
- Cek name (wajib, minimal 3 karakter)
- Cek email (wajib, harus mengandung @ dan .)
- Cek password (wajib, minimal 8 karakter, harus ada angka)
- Throw `ValidationError` dengan info field mana yang bermasalah
- Kumpulkan **semua** error, bukan berhenti di error pertama

```javascript
const data = {
  name: "Bu",
  email: "budi-mail",
  password: "singkat"
};
```

**Contoh output yang diharapkan:**
```
Pendaftaran gagal! 3 error ditemukan:
- name: Nama minimal 3 karakter
- email: Format email tidak valid
- password: Password minimal 8 karakter dan harus mengandung angka
```

<details>
<summary>Lihat Solusi</summary>

```javascript
class ValidationError extends Error {
  constructor(errors) {
    super(`${errors.length} error ditemukan`);
    this.name = "ValidationError";
    this.errors = errors;
  }
}

function validateRegistration(data) {
  const errors = [];

  if (!data.name || data.name.trim().length < 3) {
    errors.push({ field: "name", message: "Nama minimal 3 karakter" });
  }

  if (!data.email || !data.email.includes("@") || !data.email.includes(".")) {
    errors.push({ field: "email", message: "Format email tidak valid" });
  }

  if (!data.password || data.password.length < 8 || !/\d/.test(data.password)) {
    errors.push({
      field: "password",
      message: "Password minimal 8 karakter dan harus mengandung angka"
    });
  }

  if (errors.length > 0) {
    throw new ValidationError(errors);
  }

  return { ...data, registered: true };
}

try {
  const result = validateRegistration({
    name: "Bu",
    email: "budi-mail",
    password: "singkat"
  });
  console.log("Berhasil:", result);
} catch (err) {
  if (err instanceof ValidationError) {
    console.log(`Pendaftaran gagal! ${err.message}:`);
    err.errors.forEach(e => {
      console.log(`- ${e.field}: ${e.message}`);
    });
  }
}
```

**Penjelasan:** Semua validasi dijalankan dan error dikumpulkan di array. `ValidationError` menyimpan array errors di property `this.errors`. Pemanggil bisa iterate semua error sekaligus — UX lebih baik daripada menampilkan satu error per submit. `/\d/` adalah regex yang mengecek ada tidaknya angka.

</details>

---

#### Latihan 3: Retry dengan Error Handling

Buat function `executeWithRetry(fn, maxRetry)` yang:
- Memanggil function `fn`
- Jika throw error, retry sampai `maxRetry` kali
- Jika berhasil, return hasilnya
- Jika gagal setelah semua retry, throw error terakhir

```javascript
let attempt = 0;

function unstableOperation() {
  attempt++;
  if (attempt < 4) {
    throw new Error(`Gagal pada percobaan ke-${attempt}`);
  }
  return "Berhasil!";
}
```

**Contoh output yang diharapkan:**
```
Attempt 1: Gagal — Gagal pada percobaan ke-1
Attempt 2: Gagal — Gagal pada percobaan ke-2
Attempt 3: Gagal — Gagal pada percobaan ke-3
Attempt 4: Berhasil!
Result: Berhasil!
```

<details>
<summary>Lihat Solusi</summary>

```javascript
function executeWithRetry(fn, maxRetry = 3) {
  let lastError;

  for (let i = 1; i <= maxRetry; i++) {
    try {
      const result = fn();
      console.log(`Attempt ${i}: Berhasil!`);
      return result;
    } catch (err) {
      console.log(`Attempt ${i}: Gagal — ${err.message}`);
      lastError = err;
    }
  }

  throw lastError;
}

let attempt = 0;

function unstableOperation() {
  attempt++;
  if (attempt < 4) {
    throw new Error(`Gagal pada percobaan ke-${attempt}`);
  }
  return "Berhasil!";
}

try {
  const result = executeWithRetry(unstableOperation, 5);
  console.log("Result:", result);
} catch (err) {
  console.log("Gagal total:", err.message);
}
```

**Penjelasan:** Loop `for` mencoba memanggil `fn()`. `try/catch` di dalam loop menangkap error per percobaan tanpa menghentikan loop. `lastError` menyimpan error terakhir — jika loop selesai tanpa `return` (semua gagal), throw error terakhir ke pemanggil. Pattern ini reusable untuk function apapun yang bisa gagal.

</details>
