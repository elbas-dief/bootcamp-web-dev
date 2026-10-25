const list_gaji = [4, 10, 20, 8, 6, 6, 7.4, 6.4]
let total = 0;

for (let i = 0; i < list_gaji.length; i++) {
    // console.log(list_gaji[i]*1000000);
    total += list_gaji[i]*1000000;
}

console.log(total);
console.log(total / list_gaji.length);

for (let i = 0; i < list_gaji.length; i++) {
    console.log(`Karyawan ${i+1} : ${list_gaji[i]*1000000}`);    
}