const tambah = (angka1, angka2) => {
  return angka1 + angka2;
}

function productCard(nama, harga) {
    return `
        <div class="">
            <h2>${nama}</h2>
            <p>Rp. ${harga}</p>
        </div>
    `;
}

let product = {
    "name": "Susu UHT 200ml",
    "price": 8000,
    "categories": ['dairy', 'drinks'],
    "user": {
        "name": "Haltev",
        "role": "Manager"
    },
    // "test": angka1+angka2
}

// productCard = 10;
console.log(productCard(10, 10))

function greeting(nama = "Test") {
    console.log(`Halo nama saya ${nama}`)
}

console.log(undefined)
console.log(10)

console.log(tambah(2, 3));
console.log(tambah(6, 4));

const funcs = [
  (angka1, angka2) => {
    return angka1 + angka2;
  },
  (angka1, angka2) => {
    return angka1 - angka2;
  },
];


console.log(funcs[0](5,4))

console.log(document)