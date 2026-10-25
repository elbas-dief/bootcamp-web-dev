let umur = 18

if (umur >= 17) {
    console.log("Boleh masuk!");
} else {
    console.log("Tidak boleh!");
    
}

// let nilai = 87

// if (nilai >= 95) {
//     console.log("A");
// } else if (nilai >=70) {
//     console.log("B");
// } else if (nilai >=60) {
//     console.log("C");
// } else if (nilai >=50) {
//     console.log("D");
// } else {
//     console.log("E");
// }

// variable scope
let nilai = 80
let nama ="Elbas"
let job = "";

if (nilai >= 90) {
    console.log(nama);
    job = "developer";
} else if (nilai >=70) {
    console.log("B");
} else if (nilai >=60) {
    console.log("C");
} else if (nilai >=50) {
    console.log("D");
} else {
    console.log("E");
}

console.log(job);
