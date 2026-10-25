// // Latihan 1
// const namaBarang = "Beras 5kg";
// const hargaSatuan = 62000;
// const jumlah = 3;

// // TODO: hitung total = hargaSatuan * jumlah
// // TODO: tampilkan: "Beras 5kg x 3 = Rp 186000"
// // Output menampilkan nama barang, jumlah, dan total yang benar

// const total = hargaSatuan * jumlah;
// console.log(`${namaBarang} x ${jumlah} = Rp ${total}`);

// // Latihan 2
// const totalBelanja = 500000;
// const statusMember = "Silver";

// // Member Gold → diskon 20%
// // Member Silver → diskon 10%
// // Non-member → tidak ada diskon

// let diskon = 0
// let nilaiPotongan = 0

// if (statusMember === "Gold") {
//     diskon = "20%";
//     nilaiPotongan = totalBelanja * 0.2;
// } else if (statusMember === "Silver") {
//     diskon = "10%";
//     nilaiPotongan = totalBelanja * 0.1;
// } else {
//     diskon = "0%";
//     nilaiPotongan = totalBelanja * 0;
// }

// console.log(`Total Belanja : ${totalBelanja}`);
// console.log(`Status Member : ${statusMember}`);
// console.log(`Diskon Belanja : ${diskon}`);
// console.log(`Nilai Potongan : ${nilaiPotongan}`);
// console.log(`Total Dibayar : ${totalBelanja - nilaiPotongan} \n`);

// // Latihan 3
// const gajiPokok = 5000000;
// const jamLembur = 12;
// const upahLemburPerJam = 40000;
// const potonganBPJS = 0.03;

// // TODO: hitung totalLembur = jamLembur * upahLemburPerJam
// // TODO: hitung potongan = gajiPokok * potonganBPJS
// // TODO: hitung gajiBersih = gajiPokok + totalLembur - potongan
// // TODO: tampilkan rincian: gaji pokok, lembur, potongan, gaji bersih
// // Semua komponen ditampilkan dan gaji bersih dihitung tepat.

// let upahLembur = jamLembur * upahLemburPerJam
// let totalPotongan = gajiPokok * potonganBPJS
// let gajiBersih = gajiPokok + upahLembur - totalPotongan

// console.log(`Gaji Pokok : ${gajiPokok}`);
// console.log(`Upah Lembur : ${upahLembur}`);
// console.log(`Total Potongan : ${totalPotongan}`);
// console.log(`Take Home Pay : ${gajiBersih} \n`);

// Latihan 4

// Sampai Rp 60.000.000 → 5%
// Di atas Rp 60.000.000 s.d. Rp 250.000.000 → 15%
// Di atas Rp 250.000.000 → 25%

// const penghasilanTahunan = 120000000;

// // TODO: tentukan tarif pakai if/else if/else
// // TODO: hitung pajak = penghasilanTahunan * tarif
// // TODO: tampilkan tarif (%) dan jumlah pajak

// let potonganPajak;
// let jumlahPajak;

// if (penghasilanTahunan <= 60000000) {
//     potonganPajak = "5%";
//     jumlahPajak = penghasilanTahunan * 0.05;
// } else if (penghasilanTahunan > 60000000 && penghasilanTahunan <= 250000000) {
//     potonganPajak = "15%";
//     jumlahPajak = (penghasilanTahunan * 0.15);
// } else {
//     potonganPajak = "25%";
//     jumlahPajak = (penghasilanTahunan * 0.25);
// }

// let penghasilanBersih = penghasilanTahunan - jumlahPajak

// console.log(`Bruto : ${penghasilanTahunan}`);
// console.log(`Potongan Pajak : ${potonganPajak}`);
// console.log(`Nilai Potongan : ${jumlahPajak}`);
// console.log(`Netto : ${penghasilanBersih}`);

// Array Version

const penghasilanTahunan = [120000000, 90000000, 40000000, 270000000, 300000000]
const namaPegawai = ["Adi", "Budi", "Chandra", "Denis", "Eka"];
let potonganPajak;
let jumlahPajak;

for (let i = 0; i < penghasilanTahunan.length; i++) {
    penghasilanTahunan[i];
    namaPegawai[i];

    if (penghasilanTahunan[i] <= 60000000) {
        potonganPajak = "5%";
        jumlahPajak = penghasilanTahunan[i] * 0.05;
    } else if (penghasilanTahunan[i] > 60000000 && penghasilanTahunan[i] <= 250000000) {
        potonganPajak = "15%";
        jumlahPajak = (penghasilanTahunan[i] * 0.15);
    } else {
        potonganPajak = "25%";
        jumlahPajak = (penghasilanTahunan[i] * 0.25);
    }

    let penghasilanBersih = penghasilanTahunan[i] - jumlahPajak

    console.log(`Nama : ${namaPegawai[i]}`);
    console.log(`Bruto : ${penghasilanTahunan[i]}`);
    console.log(`Potongan Pajak : ${potonganPajak}`);
    console.log(`Nilai Potongan : ${jumlahPajak}`);
    console.log(`Netto : ${penghasilanBersih}\n`);
}
