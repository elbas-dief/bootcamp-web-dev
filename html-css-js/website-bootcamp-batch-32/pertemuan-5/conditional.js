let umur = 16;

if (umur >= 17) {
  console.log("Boleh masuk!");
} else {
  console.log("Tidak boleh!");
}

let totalBelanja = 250000;
let diskon = 0;

if (totalBelanja >= 500000) {
  diskon = 0.2; // 20%
} else if (totalBelanja >= 200000) {
  diskon = 0.1; // 10%
} else {
  diskon = 0; // tidak ada diskon
}

let potongan = totalBelanja * diskon;
let bayar = totalBelanja - potongan;

console.log("Diskon: " + diskon * 100 + "%"); // Diskon: 10%
console.log("Potongan: Rp " + potongan); // Potongan: Rp 25000
console.log("Total bayar: Rp " + bayar); // Total bayar: Rp 225000

let hari = "Minggu";

switch (hari) {
  case "Senin":
    console.log("Kerja!");
    break;
  case "Sabtu":
    console.log("Liburan!");
    break;
  case "Minggu":
    console.log("Libur 😴");
    break;
  default:
    console.log("Hari kerja 💼");
}

// Variable scope
let nilai = 92;
let nama = "Dani";
let job;

if (nilai >= 90) {
  console.log(nama);
  job = "developer";
  console.log("Grade A");
} else if (nilai >= 80) {
  console.log("Grade B");
} else if (nilai >= 70) {
  console.log("Grade C");
} else if (nilai >= 60) {
  console.log("Grade D");
} else {
  console.log("Grade E");
  console.log(job)
}

console.log(job)
