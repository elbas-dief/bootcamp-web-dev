// Latihan 1
const namaBarang = "Beras 5kg"
const hargaSatuan = 62000
const jumlah = 3

let total = hargaSatuan * jumlah
console.log(`${namaBarang} x ${jumlah} = Rp ${total} \n`);
// console.log(namaBarang, "x", jumlah, "= Rp", total);

// Latihan 2
const totalBelanja = 300000
const statusMember = "Silver"
let diskon;

if (statusMember == "Gold") {
    diskon = 0.2;
} else if (statusMember == "Silver") {
    diskon = 0.1;
} else {
    diskon = 0;
}

let potongan = totalBelanja * diskon

let totalBayar = totalBelanja - potongan

console.log(`Total = ${totalBelanja}`);
console.log(`Potongan = ${potongan}`);
console.log(`Total Bayar = ${totalBayar} \n`);

// Latihan 3
const gajiPokok = 4000000
const jamLembur = 12
const upahLemburPerJam = 35000
const potonganBPJS = 0.03

let totalLembur = jamLembur * upahLemburPerJam
let totalPotongan = gajiPokok * potonganBPJS
// let totalPotongan = gajiPokok * potonganBPJS
let gajiBersih = gajiPokok + totalLembur - totalPotongan
console.log(`Gaji Pokok = ${gajiPokok}`);
console.log(`Lembur = ${totalLembur}`);
console.log(`Potongan = ${totalPotongan}`);
console.log(`Gaji Bersih = ${gajiBersih} \n`);

// Latihan 4
const penghasilanTahunan = 120000000
let pajak;

if (penghasilanTahunan <= 60000000) {
    pajak = 0.05
} else if (penghasilanTahunan <= 250000000) {
    pajak = 0.15
} else {
    pajak = 0.25
}

let jumlahPajak = penghasilanTahunan * pajak
let penghasilanBersih = penghasilanTahunan - jumlahPajak

console.log(`Penghasilan Kotor = ${penghasilanTahunan}`);
console.log(`Tarif Pajak = ${pajak*100}%`);
console.log(`Jumlah Potongan Pajak = ${jumlahPajak}`);
console.log(`Penghasilan Bersih = ${penghasilanBersih}`);








