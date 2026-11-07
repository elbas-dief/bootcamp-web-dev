# Panduan Setup Project Node.js dengan TypeScript

Panduan langkah demi langkah untuk melakukan *setup* project Node.js menggunakan TypeScript dari awal hingga siap untuk mode *development* dan *production*.

---

## 🛠️ Prasyarat

Pastikan Anda sudah menginstal:
* [Node.js](https://nodejs.org/) (Versi LTS disarankan, minimum v18+)
* Package Manager: `npm` (bawaan Node.js), `yarn`, atau `pnpm`.

---

## 🚀 Langkah 1: Inisialisasi Project

1. Buka terminal/command prompt.
2. Buat direktori baru untuk project Anda dan masuk ke dalamnya:
   ```bash
   mkdir my-ts-project
   cd my-ts-project
   ```
3. Inisialisasi project Node.js baru:
   ```bash
   npm init -y
   ```
   Perintah ini akan membuat file `package.json` default.

---

## 📦 Langkah 2: Install Dependensi

Install TypeScript, tipe data untuk Node.js, serta **`tsx`** (eksekutor TypeScript yang cepat dan mendukung *live reload*):

```bash
npm install -D typescript @types/node tsx
```

> **Keterangan Dependensi:**
> * `typescript`: Compiler resmi TypeScript.
> * `@types/node`: Type definitions untuk API bawaan Node.js (misal: `fs`, `path`, `process`).
> * `tsx`: Tool modern untuk menjalankan file `.ts` secara langsung tanpa kompilasi manual terlebih dahulu saat *development*.

---

## ⚙️ Langkah 3: Konfigurasi TypeScript (`tsconfig.json`)

Generate file konfigurasi bawaan TypeScript:

```bash
npx tsc --init
```

Buka file `tsconfig.json` yang dihasilkan, lalu sesuaikan atau ganti konfigurasinya dengan opsi rekomendasi berikut:

```json
{
  "compilerOptions": {
    "target": "ES2022",
    "module": "NodeNext",
    "moduleResolution": "NodeNext",
    "rootDir": "./src",
    "outDir": "./dist",
    "esModuleInterop": true,
    "forceConsistentCasingInFileNames": true,
    "strict": true,
    "skipLibCheck": true
  },
  "include": ["src/**/*"],
  "exclude": ["node_modules", "dist"]
}
```

---

## 📜 Langkah 4: Konfigurasi Script `package.json`

Buka file `package.json` dan perbarui bagian `"scripts"` untuk mempermudah menjalankan project:

```json
{
  "name": "my-ts-project",
  "version": "1.0.0",
  "type": "module",
  "scripts": {
    "dev": "tsx watch src/index.ts",
    "build": "tsc",
    "start": "node dist/index.js"
  },
  "devDependencies": {
    "@types/node": "^20.0.0",
    "tsx": "^4.0.0",
    "typescript": "^5.0.0"
  }
}
```

> **Catatan:** `"type": "module"` mengaktifkan fitur Native ES Modules pada Node.js.

---

## 📂 Langkah 5: Buat File Kode Sumber

1. Buat folder `src`:
   ```bash
   mkdir src
   ```
2. Buat file `src/index.ts` dan isi dengan kode TypeScript sederhana berikut:

```typescript
interface User {
  id: number;
  name: string;
  role: string;
}

const greetUser = (user: User): string => {
  return `Halo, ${user.name}! Peran Anda adalah ${user.role}.`;
};

const newUser: User = {
  id: 1,
  name: "Developer",
  role: "Software Engineer",
};

console.log(greetUser(newUser));
```

---

## 🏃‍♂️ Langkah 6: Menjalankan Project

### 1. Mode Development (*Auto-reload*)
Jalankan perintah ini untuk memulai mode pengembangan. File akan otomatis dimuat ulang (*watch mode*) setiap kali Anda menyimpan perubahan:
```bash
npm run dev
```

### 2. Build untuk Production
Jalankan compiler TypeScript untuk mengubah file TypeScript menjadi file JavaScript siap pakai di dalam folder `dist/`:
```bash
npm run build
```

### 3. Menjalankan Kode Hasil Build
Setelah proses `build` selesai, jalankan file hasil kompilasi:
```bash
npm start
```

---

## 📌 Rangkuman Perintah

| Perintah | Kegunaan |
| :--- | :--- |
| `npm run dev` | Menjalankan aplikasi dalam mode dev (watch mode via `tsx`) |
| `npm run build` | Mengompilasi kode dari folder `src/` ke `dist/` via `tsc` |
| `npm start` | Menjalankan hasil kompilasi JavaScript dari folder `dist/` |