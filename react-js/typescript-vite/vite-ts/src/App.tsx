import { useEffect, useState } from "react";

function App() {
    // KIRI = init VALUE (value yang di generate/saat ini)
    // KANAN = set VALUE (untuk memberikan manipulasinya)
    // var number = 0
    // kalau mau update pakai setNya = setNumber(number + 1)
    const [number, setNumber] = useState<number>(0);

    const tambah = () => {
        setNumber(number + 1);
    };
    const kurang = () => {
        setNumber(number - 1);
    };

    useEffect(() => {
        // UseEffect = Akan menjalankan sesuatu sesuai dengan kondisi Dependency NYA
        // [] => Dia akan jalan ketika halaman pertama kali di LOAD
        // Jika [number] => Dia akan jalan ketika state Number mengalami perubahan

        console.log("HALO SAYA DARI USEEFFECT");
        console.log("DEPEDENCY DARI nilai number");
    }, []);

    return (
        <>
            <h1>Hello from React!</h1>
            <p>{number}</p>
            <button onClick={tambah}>TAMBAH</button>
            <button onClick={kurang}>KURANG</button>
        </>
    );
}

export default App