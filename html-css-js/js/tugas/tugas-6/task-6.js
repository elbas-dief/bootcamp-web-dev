// // Latihan 1
let sudahLogin = false

function updateTampilan() {
  const areaLogin = document.getElementById("areaSudahLogin");
  const areaBelum = document.getElementById("areaBelumLogin");

  // if (sudahLogin == true) {
  //   areaLogin.style.display = "block";
  //   areaBelum.style.display = "none";
  // } else {
  //   areaLogin.style.display = "none";
  //   areaBelum.style.display = "block";
  // }

  areaLogin.classList.toggle("d-none", !sudahLogin);
  areaBelum.classList.toggle("d-none", sudahLogin);

}

document.getElementById("btnToggleLogin").addEventListener("click", () => {
  sudahLogin = !sudahLogin;
  // alert("Tombol diklik!");
  updateTampilan();
});

updateTampilan()

// Latihan 2
const produk = [
  { nama: "Laptop", harga: 9990000, stok: 4 },
  { nama: "Mouse", harga: 150000, stok: 0 },
  { nama: "Keyboard", harga: 350000, stok: 12 },
  { nama: "Monitor", harga: 2100000, stok: 3 },
];

function render() {
  const container = document.getElementById("daftarProduk");
  // container.innerHTML = "";

  produk.forEach((p) => {
    const card = document.createElement("div");
    card.className = "card p-3 mb-2";

    const formatHarga = p.harga.toLocaleString('id-ID');
    
    let badgeStok ="";
  
    if (p.stok == 0) {
      badgeStok = '<span class="badge bg-danger">Habis</span>';
    } else {
      badgeStok = '<span class="badge bg-primary">Tersedia</span>'
    }

    card.innerHTML = `
    <h5>${p.nama}</h5>
    <p>Rp ${formatHarga}</p>
    ${badgeStok}
    `;

    container.appendChild(card);
  });
    
}

render()

// Latihan 3
let mengikuti = false;

const btn = document.getElementById("btnFollow");

btn.addEventListener ("click", () => {
  mengikuti = !mengikuti
  // btn.classList.add("btn-secondary");
  // btn.classList.remove("btn-primary");
  
  if (mengikuti === false) {
    btn.innerText = "Follow";
    btn.classList.remove("btn-secondary");
    btn.classList.add("btn-primary");
  } else {
    btn.innerText = "Unfollow";
    btn.classList.remove("btn-primary");
    btn.classList.add("btn-secondary");
  }
})


