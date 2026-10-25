let daftar_produk = [
  { id: 1, nama: "Lampu", harga: 50_000 },
  { id: 2, nama: "mobil", harga: 50_000 },
  { id: 3, nama: "Lampu", harga: 50_000 },
  { id: 4, nama: "Lampu", harga: 50_000 },
  { id: 5, nama: "Lampu", harga: 50_000 },
  { id: 6, nama: "Lampu", harga: 50_000 },
];

for (let i = 0; i < 6; i *= 2) {
// for (let i = 0; i < 6; i++) {
  console.log(`Produk ke-${i}`);
  console.log(daftar_produk[i][`nama`])
}

let stok = 10
while(stok < 10) {
    console.log("Stok saat ini: ", stok)
    stok++
}