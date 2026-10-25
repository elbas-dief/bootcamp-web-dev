const produk = [
  { nama: "Laptop", harga: "Rp 9.990.000" },
  { nama: "Mouse",  harga: "Rp 150.000" },
];

function render() {
  const container = document.getElementById("daftarProduk");
  container.innerHTML = ""; // kosongkan dulu

  produk.forEach((p) => {
    const card = document.createElement("div");
    card.className = "card p-3 mb-2";
    card.innerHTML = `
      <h5>${p.nama}</h5>
      <p>${p.harga}</p>
    `;
    container.appendChild(card);
  });
}

render()