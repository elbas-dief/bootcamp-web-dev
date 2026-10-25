const burger = document.getElementById(`burger-menu`);
const menu = document.getElementById(`nav-menu`);
const tes = document.getElementById(`test`);

burger.addEventListener(`click`, () => {    
    menu.classList.toggle(`active`);
})

// const form = document.getElementsByClassName("form-contact");

// form.addEventListener("Submit", () => {

// })

// const submit = document.getElementById("tes");

// submit.addEventListener(`click`, () => {
//     alert(`Test Submit`);
// });