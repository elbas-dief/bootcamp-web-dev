// console.log adalah untuk menampilkan hasil di console
console.log("Hello World");

console.log(typeof "Halo");
console.log(typeof 160);

let hargaTeks = "15000";
console.log(Number(hargaTeks) + 15000);

// operator aritmatika
let a = 10
let b = 2
let c = 3
console.log(a % b); // ini adalah modulus, hasilnya sisa dari pembagian
console.log(a % c);

console.log("Operator Penugasan")
// operator penugasan
let total = 100
total += 25;

console.log(total += 50); // total = 100 + 25 + 50 → 175
console.log(total);
console.log(total -= 20);  // total = 175 - 20 → 155
console.log(total++);      // total = 155 (Dicetak lalu ditambah)
console.log(+total);      // total = 155 + 1  → 156 (Ditambah lalu dicetak)

console.log(5 == "5");   // true  — membandingkan NILAI saja
console.log(5 === "5");  // false — membandingkan nilai DAN tipe (disarankan ✅)
console.log(5 !== 6);    // true
console.log(10 > 5);     // true
console.log(10 <= 10);   // true

let umur = 20;
let punyaKTP = false;

// Boleh daftar jika umur minimal 17 DAN punya KTP
console.log(umur >= 17 && punyaKTP);

let hari = "Selasa";

switch (hari) {                     // Jika hari...
  case "Sabtu":                     // adalah sabtu... (dan berlanjut kebawah)
  case "Minggu":                    // adalah minggu...
    console.log("Libur 😴");        // Maka libur
    break;                          // stop
  default:                          // Jika tidak dari kedua diatas...
    console.log("Hari kerja 💼");   // Maka hari kerja
}


// // For Loop
// for (let i = 1; i <= 5; i++) {
//   console.log("Hitungan ke-" + i);
// }

// for (let i = 10; i >= 0; i--) {
//   console.log("Hitungan ke-" + i);
// }

// for (let i = 1; i <= 10; i++) {         // (var, angka start, batas akhir, langkah/treatment plus/minus)
//   console.log(`7 x ${i} = ${7 * i}`);
// }

let hargaHarian = [30000, 45000, 20000, 55000, 15000];
let totalMinggu = 0;

for (let i = 0; i < hargaHarian.length; i++) {    
  totalMinggu += hargaHarian[i];
  }

console.log("Total pengeluaran: Rp " + totalMinggu);