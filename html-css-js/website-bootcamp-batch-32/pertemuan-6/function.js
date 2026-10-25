function greeting() {
    console.log("Halo semuanya")
    console.log("Saya sedang belajar javascript!")
}

greeting("test")

function kenalan(nama, umur) {
    console.log(`Perkenalkan nama saya adalah ${nama}`)
    console.log(`Umur saya adalah ${umur}`);
}

kenalan("haltev", 20);


// Function dengan return statement
function hitungTotal(harga, qty) {
    return harga * qty
    console.log("Testing123")
}

function productCard(nama, harga) {
    return `
        <div>
            <h1>${nama}</h1>
            <h2>Rp ${harga}</h2>
        </div>
    `
}

// console.log(hitungTotal(9000, 10))
console.log(hitungTotal(9000, 10))