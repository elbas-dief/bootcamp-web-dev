# Panduan Langkah-demi-Langkah Belajar React 18 Tanpa Build Tools (Via CDN)

Panduan ini dirancang untuk membantu Anda memahami evolusi pembuatan aplikasi web menggunakan React 18 secara langsung di browser tanpa perlu menginstal Node.js, Webpack, atau Vite terlebih dahulu.

---

## Langkah 1: HTML Dasar & Error `ReactDOM.render` (React 17 vs React 18)

Pada tahap paling awal, kita menggunakan HTML standar dengan menyertakan pustaka React versi 18 melalui **CDN (unpkg)**.

### Kode HTML Awal:
```html
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>React 18 CDN</title>
    </head>
    <body>
        <div id="root"></div>

        <!-- 1. Import React & ReactDOM -->
        <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
        <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>

        <script>
            const container = document.querySelector("#root");

            // Membuat elemen dengan JavaScript murni via React.createElement
            const element = React.createElement("h1", {
                className: "heading-1",
                children: "Hello From React!"
            });

            // CARA LAMA (React 17 kebawah):
            // ReactDOM.render(element, container); 
            // ⚠️ Error: ReactDOM.render is no longer supported in React 18. Use createRoot instead.

            // CARA BARU (React 18):
            const root = ReactDOM.createRoot(container);
            root.render(element);
        </script>
    </body>
</html>
```

### Penjelasan:
- **CDN Link**: Mengambil *library* React langsung dari internet.
- **`ReactDOM.createRoot`**: Pada React 18, rendering elemen harus diawali dengan membuat *root* terlebih dahulu dari container DOM target.

---

## Langkah 2: Menambahkan Babel Standalone untuk Mendukung Sintaks JSX

Menggunakan `React.createElement` kurang nyaman saat membuat UI yang kompleks. Kita memerlukan **Babel** agar bisa menulis JSX (sintaks HTML di dalam JavaScript).

### Perubahan Kode:
1. Tambahkan script Babel di tag `<head>`.
2. Ubah tipe script JavaScript menjadi `type="text/babel"`.

```html
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>React 18 dengan JSX</title>

        <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
        <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
        
        <!-- Tambahkan Babel Standalone -->
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    </head>
    <body>
        <div id="root"></div>

        <!-- Perhatikan type="text/babel" -->
        <script type="text/babel">
            const container = document.querySelector("#root");
            const root = ReactDOM.createRoot(container);

            // Sekarang kita bisa menggunakan JSX!
            const element = <h1 className="heading-1">Hello From React with JSX!</h1>;

            root.render(element);
        </script>
    </body>
</html>
```

---

## Langkah 3: Membuat Functional Component & Mengirim Props

Komponen memungkinkan kita memecah UI menjadi bagian-bagian yang dapat digunakan kembali (*reusable*). **Props** digunakan untuk mengirimkan data ke komponen tersebut.

```html
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Functional Components & Props</title>

        <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
        <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    </head>
    <body>
        <div id="root"></div>

        <script type="text/babel">
            // Component 1: Menerima props (Destructuring)
            function Greeting({ name, role }) {
                return (
                    <div style={{ border: "1px solid #ccc", padding: "10px", marginBottom: "10px" }}>
                        <h2>Halo, {name}!</h2>
                        <p>Pekerjaan: {role}</p>
                    </div>
                );
            }

            // Component Utama
            function App() {
                return (
                    <div>
                        <Greeting name="Andrea" role="Fullstack Engineer" />
                        <Greeting name="Budi" role="Frontend Developer" />
                    </div>
                );
            }

            const container = document.querySelector("#root");
            const root = ReactDOM.createRoot(container);
            root.render(<App />);
        </script>
    </body>
</html>
```

---

## Langkah 4: Membuat Komponen Interaktif dengan `useState`

`useState` memungkinkan komponen memiliki memori internal (state) dan merender ulang UI secara otomatis ketika nilainya berubah.

```html
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>React useState</title>

        <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
        <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    </head>
    <body>
        <div id="root"></div>

        <script type="text/babel">
            // Destructuring useState dari objek global React
            const { useState } = React;

            function Counter() {
                const [count, setCount] = useState(0);

                return (
                    <div style={{ fontFamily: "sans-serif", padding: "20px" }}>
                        <h3>Nilai saat ini: {count}</h3>
                        <button onClick={() => setCount(count + 1)}>Tambah (+)</button>
                        <button onClick={() => setCount(count - 1)} style={{ marginLeft: "5px" }}>Kurang (-)</button>
                    </div>
                );
            }

            const container = document.querySelector("#root");
            const root = ReactDOM.createRoot(container);
            root.render(<Counter />);
        </script>
    </body>
</html>
```

---

## Langkah 5: Mengambil Data dari API Eksternal dengan `useEffect`

`useEffect` digunakan untuk menangani *side-effects*, seperti mengambil data dari API saat halaman pertama kali dimuat.

```html
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>React useEffect & Fetch API</title>

        <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
        <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    </head>
    <body>
        <div id="root"></div>

        <script type="text/babel">
            const { useState, useEffect } = React;

            function UserList() {
                const [users, setUsers] = useState([]);
                const [loading, setLoading] = useState(true);

                useEffect(() => {
                    fetch("https://jsonplaceholder.typicode.com/users")
                        .then((res) => res.json())
                        .then((data) => {
                            setUsers(data);
                            setLoading(false);
                        });
                }, []); // [] membuat effect hanya berjalan 1x saat komponen dimuat

                if (loading) return <p>Memuat data...</p>;

                return (
                    <div>
                        <h2>Daftar Pengguna</h2>
                        <ul>
                            {users.map((user) => (
                                <li key={user.id}>{user.name} - ({user.email})</li>
                            ))}
                        </ul>
                    </div>
                );
            }

            const container = document.querySelector("#root");
            const root = ReactDOM.createRoot(container);
            root.render(<UserList />);
        </script>
    </body>
</html>
```

---

## Langkah 6: Menangani Form Input (Controlled Components)

**Controlled Component** adalah teknik mengikat nilai elemen form (`<input>`) secara langsung ke dalam State React.

```html
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>React Controlled Form Input</title>

        <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
        <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    </head>
    <body>
        <div id="root"></div>

        <script type="text/babel">
            const { useState } = React;

            function RegistrationForm() {
                const [formData, setFormData] = useState({
                    nama: "",
                    email: ""
                });

                // Handler dinamis untuk banyak input
                const handleChange = (e) => {
                    const { name, value } = e.target;
                    setFormData((prev) => ({
                        ...prev,
                        [name]: value
                    }));
                };

                const handleSubmit = (e) => {
                    e.preventDefault();
                    alert(`Data Berhasil Diterima!\nNama: ${formData.nama}\nEmail: ${formData.email}`);
                };

                return (
                    <div style={{ padding: "20px", fontFamily: "sans-serif" }}>
                        <h2>Form Registrasi</h2>
                        <form onSubmit={handleSubmit}>
                            <div style={{ marginBottom: "10px" }}>
                                <label>Nama: </label>
                                <br />
                                <input 
                                    type="text" 
                                    name="nama" 
                                    value={formData.nama} 
                                    onChange={handleChange} 
                                />
                            </div>

                            <div style={{ marginBottom: "10px" }}>
                                <label>Email: </label>
                                <br />
                                <input 
                                    type="email" 
                                    name="email" 
                                    value={formData.email} 
                                    onChange={handleChange} 
                                />
                            </div>

                            <button type="submit">Kirim Data</button>
                        </form>

                        <div style={{ marginTop: "20px", background: "#f0f0f0", padding: "10px" }}>
                            <h4>Live State Preview:</h4>
                            <p>Nama: {formData.nama}</p>
                            <p>Email: {formData.email}</p>
                        </div>
                    </div>
                );
            }

            const container = document.querySelector("#root");
            const root = ReactDOM.createRoot(container);
            root.render(<RegistrationForm />);
        </script>
    </body>
</html>
```

---

## Ringkasan Konsep Kunci
1. **`ReactDOM.createRoot`**: Standar API rendering pada React 18.
2. **Babel Standalone**: Memungkinkan transpilasi sintaks JSX langsung di browser (`type="text/babel"`).
3. **Props**: Data read-only yang dikirimkan dari komponen induk ke komponen anak.
4. **`useState`**: Hook untuk mengelola nilai variabel yang dapat berubah dan memicu render ulang UI.
5. **`useEffect`**: Hook untuk mengelola *side effect* (fetching data, pemanggilan API, dll).
6. **Controlled Components**: Pola mengontrol nilai field form sepenuhnya melalui state React.