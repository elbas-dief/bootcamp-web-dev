let nama: string = "Budi";
// nama = 20;

// KALKULATOR
function tambah(num1: number, num2: number): number {
    return num1 + num2;
}

console.log(nama);
console.log(tambah(2, 4));

interface Product {
    id: number;
    name: string;
    price: number;
}

const greetUser = (product: Product) => {
    console.log(product.name);
    console.log(product.price);
};