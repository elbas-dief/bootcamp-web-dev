# 22. Studi Kasus: CRUD Data Mahasiswa

> **Tujuan:** menggabungkan JSON Server, semua jenis form input, TypeScript, dan validasi Zod menjadi satu aplikasi nyata — CRUD data mahasiswa dengan search, filter, sort, dan foto profil (URL).

**Prasyarat:** [bab 8 — Forms & Controlled Components](08-forms-dan-controlled-components.md), [bab 19 — Simulasi API dengan JSON Server](19-simulasi-api-json-server.md), [bab 20 — AI untuk Generate TypeScript Types](20-ai-generate-typescript-types.md), [bab 21 — Validasi Form dengan Zod](21-validasi-form-zod.md).

---

## Yang Akan Dibangun

Aplikasi **Data Mahasiswa** dengan dua resource: `mahasiswa` dan `jurusan`. Fitur:

- CRUD lengkap (create, read, update, delete).
- Search berdasarkan nama/NIM.
- Filter berdasarkan jurusan.
- Sort ascending/descending berdasarkan nama atau angkatan.
- Foto profil — untuk sekarang cukup **input URL gambar** (teks biasa), belum file upload sungguhan.
- Form yang mencakup semua jenis input dasar: `text`, `email`, `number`, `select`, `radio`, `checkbox`, `textarea`, `date`.
- Validasi form dengan Zod, ditulis dalam TypeScript.

### Struktur Project

```
src/
    api/
        mahasiswa.ts
    components/
        FormMahasiswa.tsx
    pages/
        DaftarMahasiswa.tsx
    schemas/
        mahasiswa.ts
    App.tsx
    main.tsx
db.json
```

---

## Step 1 — Setup Project

```bash
npm create vite@latest crud-mahasiswa -- --template react-ts
cd crud-mahasiswa
npm install
npm install zod
```

---

## Step 2 — Siapkan Data & Jalankan JSON Server

Buat `db.json` di root project:

```json
{
    "jurusan": [
        { "id": 1, "nama": "Teknik Informatika" },
        { "id": 2, "nama": "Sistem Informasi" },
        { "id": 3, "nama": "Manajemen" },
        { "id": 4, "nama": "Akuntansi" }
    ],
    "mahasiswa": [
        {
            "id": 1,
            "nim": "2201001",
            "nama": "Budi Santoso",
            "email": "budi@mail.com",
            "jurusanId": 2,
            "angkatan": 2022,
            "jenisKelamin": "L",
            "alamat": "Jl. Merdeka No. 1, Bandung",
            "tanggalLahir": "2004-05-12",
            "statusAktif": true,
            "foto": null
        }
    ]
}
```

Tambahkan beberapa mahasiswa lagi secara manual (minimal 8–10 data, tersebar di jurusan yang berbeda) agar fitur search/filter/sort terasa gunanya saat dites.

Install dan jalankan JSON Server:

```bash
npm install --save-dev json-server
```

```json
// package.json
{
    "scripts": {
        "dev": "vite",
        "api": "json-server db.json --port 3001 --watch"
    }
}
```

```bash
npm run api
```

> Konsep dasar JSON Server, query parameter, dan relasi `_expand`/`_embed` sudah dibahas lengkap di [bab 19](19-simulasi-api-json-server.md) — bab ini langsung mempraktikkannya.

---

## Step 3 — Type & Schema Validasi

Satu file ini jadi **sumber kebenaran tunggal**: schema Zod untuk validasi runtime, dan type TypeScript di-infer langsung darinya (lihat [bab 21](21-validasi-form-zod.md) untuk konsep `z.infer`).

```typescript
// src/schemas/mahasiswa.ts
import { z } from 'zod';

function hitungUmur(tanggalLahir: string): number {
    const lahir = new Date(tanggalLahir);
    const sekarang = new Date();
    let umur = sekarang.getFullYear() - lahir.getFullYear();

    const belumUlangTahun =
        sekarang.getMonth() < lahir.getMonth() ||
        (sekarang.getMonth() === lahir.getMonth() && sekarang.getDate() < lahir.getDate());

    if (belumUlangTahun) umur--;
    return umur;
}

export const mahasiswaSchema = z.object({
    nim: z.string().regex(/^\d{7}$/, 'NIM harus 7 digit angka'),
    nama: z.string().min(3, 'Nama minimal 3 karakter'),
    email: z.string().email('Email tidak valid'),
    jurusanId: z.number().min(1, 'Jurusan wajib dipilih'),
    angkatan: z
        .number()
        .int()
        .min(2015, 'Angkatan tidak valid')
        .max(new Date().getFullYear(), 'Angkatan tidak valid'),
    jenisKelamin: z.enum(['L', 'P'], { errorMap: () => ({ message: 'Pilih jenis kelamin' }) }),
    alamat: z.string().min(1, 'Alamat wajib diisi'),
    tanggalLahir: z
        .string()
        .min(1, 'Tanggal lahir wajib diisi')
        .refine(val => hitungUmur(val) >= 16, 'Usia minimal 16 tahun'),
    statusAktif: z.boolean(),
    foto: z
        .string()
        .nullable()
        .optional()
        .refine(val => !val || /^https?:\/\//.test(val), 'URL foto harus dimulai dengan http:// atau https://'),
});

// Type form di-infer dari schema — tidak perlu menulis interface terpisah secara manual
export type MahasiswaForm = z.infer<typeof mahasiswaSchema>;

export interface Jurusan {
    id: number;
    nama: string;
}

// Data mahasiswa yang sudah tersimpan: punya id, dan jurusan (hasil _expand)
export interface Mahasiswa extends MahasiswaForm {
    id: number;
    jurusan?: Jurusan;
}
```

---

## Step 4 — API Client

```typescript
// src/api/mahasiswa.ts
import type { Mahasiswa, Jurusan, MahasiswaForm } from '../schemas/mahasiswa';

export type { Mahasiswa, Jurusan };

const BASE_URL = 'http://localhost:3001';

export interface MahasiswaFilter {
    q?: string;
    jurusanId?: number | '';
    _sort?: 'nama' | 'angkatan';
    _order?: 'asc' | 'desc';
}

export async function getMahasiswa(filter: MahasiswaFilter = {}): Promise<Mahasiswa[]> {
    const params = new URLSearchParams();
    params.set('_expand', 'jurusan');

    Object.entries(filter).forEach(([key, value]) => {
        if (value !== undefined && value !== '') {
            params.set(key, String(value));
        }
    });

    const res = await fetch(`${BASE_URL}/mahasiswa?${params.toString()}`);
    if (!res.ok) throw new Error('Gagal mengambil data mahasiswa');
    return res.json();
}

export async function getJurusan(): Promise<Jurusan[]> {
    const res = await fetch(`${BASE_URL}/jurusan`);
    if (!res.ok) throw new Error('Gagal mengambil data jurusan');
    return res.json();
}

export async function createMahasiswa(data: MahasiswaForm): Promise<Mahasiswa> {
    const res = await fetch(`${BASE_URL}/mahasiswa`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
    });
    if (!res.ok) throw new Error('Gagal menyimpan data mahasiswa');
    return res.json();
}

export async function updateMahasiswa(id: number, data: MahasiswaForm): Promise<Mahasiswa> {
    const res = await fetch(`${BASE_URL}/mahasiswa/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
    });
    if (!res.ok) throw new Error('Gagal mengupdate data mahasiswa');
    return res.json();
}

export async function deleteMahasiswa(id: number): Promise<void> {
    const res = await fetch(`${BASE_URL}/mahasiswa/${id}`, { method: 'DELETE' });
    if (!res.ok) throw new Error('Gagal menghapus data mahasiswa');
}
```

`getMahasiswa` menyusun query string dari object filter — `search`, `filter jurusan`, dan `sort` semuanya lewat parameter yang sama, jadi ketiga fitur otomatis bisa digabung dalam satu request (lihat [bab 19 — Query Parameter Bawaan](19-simulasi-api-json-server.md)).

---

## Step 5 — Form Mahasiswa (Semua Jenis Input)

Foto profil untuk sekarang cukup berupa **input teks biasa** yang diisi URL gambar (misalnya link dari internet atau layanan seperti [picsum.photos](https://picsum.photos)) — belum ada file upload sungguhan. String URL itu disimpan langsung sebagai field `foto`, dan dipakai langsung sebagai `src` pada `<img>`.

> Kalau nanti sudah ada backend asli, input ini bisa diganti jadi file upload sungguhan tanpa mengubah schema atau alur CRUD-nya — karena yang disimpan tetap string, cuma sumbernya saja yang berbeda.

```tsx
// src/components/FormMahasiswa.tsx
import { useEffect, useState, type FormEvent } from 'react';
import { mahasiswaSchema, type MahasiswaForm, type Jurusan } from '../schemas/mahasiswa';
import { getJurusan } from '../api/mahasiswa';

interface Props {
    initialData?: MahasiswaForm;
    onSubmit: (data: MahasiswaForm) => void;
    onCancel: () => void;
}

const defaultForm: MahasiswaForm = {
    nim: '',
    nama: '',
    email: '',
    jurusanId: 0,
    angkatan: new Date().getFullYear(),
    jenisKelamin: 'L',
    alamat: '',
    tanggalLahir: '',
    statusAktif: true,
    foto: null,
};

export default function FormMahasiswa({ initialData, onSubmit, onCancel }: Props) {
    const [form, setForm] = useState<MahasiswaForm>(initialData ?? defaultForm);
    const [errors, setErrors] = useState<Record<string, string>>({});
    const [jurusanList, setJurusanList] = useState<Jurusan[]>([]);

    useEffect(() => {
        getJurusan().then(setJurusanList);
    }, []);

    function updateField<K extends keyof MahasiswaForm>(field: K, value: MahasiswaForm[K]) {
        setForm(prev => ({ ...prev, [field]: value }));
    }

    function handleSubmit(e: FormEvent) {
        e.preventDefault();

        const result = mahasiswaSchema.safeParse(form);

        if (!result.success) {
            const fieldErrors: Record<string, string> = {};
            for (const issue of result.error.issues) {
                fieldErrors[String(issue.path[0])] = issue.message;
            }
            setErrors(fieldErrors);
            return;
        }

        setErrors({});
        onSubmit(result.data);
    }

    return (
        <form onSubmit={handleSubmit}>
            <div>
                <label>NIM</label>
                <input value={form.nim} onChange={e => updateField('nim', e.target.value)} />
                {errors.nim && <p className="error">{errors.nim}</p>}
            </div>

            <div>
                <label>Nama</label>
                <input value={form.nama} onChange={e => updateField('nama', e.target.value)} />
                {errors.nama && <p className="error">{errors.nama}</p>}
            </div>

            <div>
                <label>Email</label>
                <input type="email" value={form.email} onChange={e => updateField('email', e.target.value)} />
                {errors.email && <p className="error">{errors.email}</p>}
            </div>

            <div>
                <label>Angkatan</label>
                <input
                    type="number"
                    value={form.angkatan}
                    onChange={e => updateField('angkatan', Number(e.target.value))}
                />
                {errors.angkatan && <p className="error">{errors.angkatan}</p>}
            </div>

            <div>
                <label>Jurusan</label>
                <select value={form.jurusanId} onChange={e => updateField('jurusanId', Number(e.target.value))}>
                    <option value={0}>-- Pilih Jurusan --</option>
                    {jurusanList.map(j => (
                        <option key={j.id} value={j.id}>{j.nama}</option>
                    ))}
                </select>
                {errors.jurusanId && <p className="error">{errors.jurusanId}</p>}
            </div>

            <div>
                <label>Jenis Kelamin</label>
                <label>
                    <input
                        type="radio"
                        name="jenisKelamin"
                        checked={form.jenisKelamin === 'L'}
                        onChange={() => updateField('jenisKelamin', 'L')}
                    />
                    Laki-laki
                </label>
                <label>
                    <input
                        type="radio"
                        name="jenisKelamin"
                        checked={form.jenisKelamin === 'P'}
                        onChange={() => updateField('jenisKelamin', 'P')}
                    />
                    Perempuan
                </label>
            </div>

            <div>
                <label>
                    <input
                        type="checkbox"
                        checked={form.statusAktif}
                        onChange={e => updateField('statusAktif', e.target.checked)}
                    />
                    Mahasiswa Aktif
                </label>
            </div>

            <div>
                <label>Alamat</label>
                <textarea value={form.alamat} onChange={e => updateField('alamat', e.target.value)} />
                {errors.alamat && <p className="error">{errors.alamat}</p>}
            </div>

            <div>
                <label>Tanggal Lahir</label>
                <input
                    type="date"
                    value={form.tanggalLahir}
                    onChange={e => updateField('tanggalLahir', e.target.value)}
                />
                {errors.tanggalLahir && <p className="error">{errors.tanggalLahir}</p>}
            </div>

            <div>
                <label>URL Foto</label>
                <input
                    type="text"
                    placeholder="https://..."
                    value={form.foto ?? ''}
                    onChange={e => updateField('foto', e.target.value)}
                />
                {errors.foto && <p className="error">{errors.foto}</p>}
                {form.foto && <img src={form.foto} alt="Preview foto" width={80} />}
            </div>

            <button type="submit">Simpan</button>
            <button type="button" onClick={onCancel}>Batal</button>
        </form>
    );
}
```

Dua hal penting dari form di atas:

- **Setiap jenis input dipetakan ke tipe data yang tepat** — `angkatan` dan `jurusanId` dikonversi ke `Number(...)` saat `onChange`, karena nilai dari input HTML selalu string.
- **Validasi hanya dijalankan saat submit**, lewat `safeParse` — bukan per keystroke. Hasil error dari Zod (`result.error.issues`) dipetakan ke object `errors` berdasarkan nama field (`issue.path[0]`), lalu ditampilkan di bawah input terkait.

---

## Step 6 — Halaman Daftar Mahasiswa

```tsx
// src/pages/DaftarMahasiswa.tsx
import { useEffect, useState } from 'react';
import {
    getMahasiswa,
    getJurusan,
    createMahasiswa,
    updateMahasiswa,
    deleteMahasiswa,
    type Mahasiswa,
    type Jurusan,
    type MahasiswaFilter,
} from '../api/mahasiswa';
import type { MahasiswaForm } from '../schemas/mahasiswa';
import FormMahasiswa from '../components/FormMahasiswa';

type SortField = 'nama' | 'angkatan';

export default function DaftarMahasiswa() {
    const [data, setData] = useState<Mahasiswa[]>([]);
    const [jurusanList, setJurusanList] = useState<Jurusan[]>([]);
    const [search, setSearch] = useState('');
    const [jurusanId, setJurusanId] = useState<number | ''>('');
    const [sortField, setSortField] = useState<SortField>('nama');
    const [sortOrder, setSortOrder] = useState<'asc' | 'desc'>('asc');
    const [isLoading, setIsLoading] = useState(true);
    const [editing, setEditing] = useState<Mahasiswa | null>(null);
    const [showForm, setShowForm] = useState(false);

    useEffect(() => {
        getJurusan().then(setJurusanList);
    }, []);

    function currentFilter(): MahasiswaFilter {
        return {
            q: search || undefined,
            jurusanId: jurusanId || undefined,
            _sort: sortField,
            _order: sortOrder,
        };
    }

    function refetch() {
        setIsLoading(true);
        getMahasiswa(currentFilter())
            .then(setData)
            .finally(() => setIsLoading(false));
    }

    useEffect(() => {
        refetch();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [search, jurusanId, sortField, sortOrder]);

    function toggleSort(field: SortField) {
        if (sortField === field) {
            setSortOrder(prev => (prev === 'asc' ? 'desc' : 'asc'));
        } else {
            setSortField(field);
            setSortOrder('asc');
        }
    }

    async function handleSave(form: MahasiswaForm) {
        if (editing) {
            await updateMahasiswa(editing.id, form);
        } else {
            await createMahasiswa(form);
        }
        setShowForm(false);
        setEditing(null);
        refetch();
    }

    async function handleDelete(id: number) {
        if (!confirm('Hapus data mahasiswa ini?')) return;
        await deleteMahasiswa(id);
        refetch();
    }

    function sortIndicator(field: SortField) {
        if (sortField !== field) return '';
        return sortOrder === 'asc' ? ' ▲' : ' ▼';
    }

    return (
        <div>
            <h1>Data Mahasiswa</h1>

            <input
                placeholder="Cari nama/NIM..."
                value={search}
                onChange={e => setSearch(e.target.value)}
            />

            <select
                value={jurusanId}
                onChange={e => setJurusanId(e.target.value ? Number(e.target.value) : '')}
            >
                <option value="">Semua Jurusan</option>
                {jurusanList.map(j => (
                    <option key={j.id} value={j.id}>{j.nama}</option>
                ))}
            </select>

            <button onClick={() => { setEditing(null); setShowForm(true); }}>
                + Tambah Mahasiswa
            </button>

            {isLoading ? (
                <p>Memuat data...</p>
            ) : (
                <table>
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>NIM</th>
                            <th onClick={() => toggleSort('nama')} style={{ cursor: 'pointer' }}>
                                Nama{sortIndicator('nama')}
                            </th>
                            <th>Jurusan</th>
                            <th onClick={() => toggleSort('angkatan')} style={{ cursor: 'pointer' }}>
                                Angkatan{sortIndicator('angkatan')}
                            </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {data.map(m => (
                            <tr key={m.id}>
                                <td>{m.foto && <img src={m.foto} width={40} alt={m.nama} />}</td>
                                <td>{m.nim}</td>
                                <td>{m.nama}</td>
                                <td>{m.jurusan?.nama}</td>
                                <td>{m.angkatan}</td>
                                <td>
                                    <button onClick={() => { setEditing(m); setShowForm(true); }}>Edit</button>
                                    <button onClick={() => handleDelete(m.id)}>Hapus</button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}

            {showForm && (
                <FormMahasiswa
                    initialData={editing ?? undefined}
                    onSubmit={handleSave}
                    onCancel={() => { setShowForm(false); setEditing(null); }}
                />
            )}
        </div>
    );
}
```

```tsx
// src/App.tsx
import DaftarMahasiswa from './pages/DaftarMahasiswa';

function App() {
    return <DaftarMahasiswa />;
}

export default App;
```

Perhatikan `useEffect` dengan dependency `[search, jurusanId, sortField, sortOrder]` — setiap kali salah satu berubah, request baru otomatis dikirim ke JSON Server dengan kombinasi query parameter yang sesuai. Search, filter, dan sort jadi **satu mekanisme yang sama**, bukan tiga fitur terpisah.

---

## Step 7 — Validasi Response API (Pengaman Tambahan)

TypeScript hanya memeriksa tipe saat compile — tidak menjamin bentuk data yang benar-benar dikirim JSON Server saat runtime. Tambahkan validasi ringan di `getMahasiswa` agar data yang salah bentuk tidak diam-diam lolos ke komponen (lihat [bab 21](21-validasi-form-zod.md) untuk konsep ini):

Tambahkan import `z` dan schema response baru di bagian atas `src/api/mahasiswa.ts`:

```typescript
// src/api/mahasiswa.ts
import { z } from 'zod';
import { mahasiswaSchema, type Mahasiswa, type Jurusan, type MahasiswaForm } from '../schemas/mahasiswa';

export type { Mahasiswa, Jurusan };

const BASE_URL = 'http://localhost:3001';

const mahasiswaResponseSchema = mahasiswaSchema.extend({
    id: z.number(),
    jurusan: z.object({ id: z.number(), nama: z.string() }).optional(),
});
```

Lalu ganti isi `getMahasiswa` yang lama (dari Step 4) dengan versi ini — bedanya di dua baris terakhir, response di-validasi dulu dengan Zod sebelum dikembalikan:

```typescript
export interface MahasiswaFilter {
    q?: string;
    jurusanId?: number | '';
    _sort?: 'nama' | 'angkatan';
    _order?: 'asc' | 'desc';
}

export async function getMahasiswa(filter: MahasiswaFilter = {}): Promise<Mahasiswa[]> {
    const params = new URLSearchParams();
    params.set('_expand', 'jurusan');

    Object.entries(filter).forEach(([key, value]) => {
        if (value !== undefined && value !== '') {
            params.set(key, String(value));
        }
    });

    const res = await fetch(`${BASE_URL}/mahasiswa?${params.toString()}`);
    if (!res.ok) throw new Error('Gagal mengambil data mahasiswa');

    const json = await res.json();

    const result = z.array(mahasiswaResponseSchema).safeParse(json);
    if (!result.success) {
        console.error('Response /mahasiswa tidak sesuai schema:', result.error);
        throw new Error('Data mahasiswa dari server tidak valid');
    }

    return result.data;
}
```

Fungsi `getJurusan`, `createMahasiswa`, `updateMahasiswa`, dan `deleteMahasiswa` dari Step 4 tetap sama, tidak perlu diubah.

---

## Step 8 — Jalankan & Uji

Jalankan dua proses di terminal berbeda:

```bash
npm run api   # JSON Server di port 3001
npm run dev   # Vite dev server
```

Checklist pengujian manual:

- [ ] Tambah mahasiswa baru dengan URL foto — foto langsung muncul di tabel.
- [ ] Edit mahasiswa, ubah jurusan dan tanggal lahir — validasi usia minimal tetap jalan.
- [ ] Search nama/NIM menyaring tabel lewat `?q=`.
- [ ] Filter jurusan menyaring tabel lewat `?jurusanId=`.
- [ ] Klik header "Nama"/"Angkatan" dua kali — urutan berbalik (asc ↔ desc).
- [ ] Search + filter + sort aktif bersamaan tidak saling mengganggu.
- [ ] Hapus mahasiswa meminta konfirmasi sebelum benar-benar menghapus.
- [ ] Submit form dengan field kosong/salah format menampilkan pesan error Zod per field.

---

## Pengembangan Lanjutan (Opsional)

Setelah versi dasar ini berjalan, beberapa arah untuk dikembangkan lebih jauh:

- Tambahkan pagination (`_page` & `_limit`, lihat [bab 19](19-simulasi-api-json-server.md)) untuk data dalam jumlah besar.
- Debounce input search agar tidak mengirim request di setiap ketikan.
- Pindahkan daftar dan form ke halaman URL terpisah (`/mahasiswa`, `/mahasiswa/tambah`) menggunakan [React Router (bab 13)](13-react-router.md).
- Ganti input URL foto manual dengan upload file sungguhan ke server/object storage, begitu backend asli tersedia.
- Tambahkan loading skeleton dan toast notification untuk feedback create/update/delete yang lebih halus.
