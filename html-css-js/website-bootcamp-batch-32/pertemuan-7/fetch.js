async function getProductsData() {
  const response = await fetch("https://dummyjson.com/products");
  const data = await response.json();
  const products = data.products;
  // console.log(await response.json())

  return products;
}

const container = document.getElementById("productContainer");

// Buat function untuk buat card produk
async function productCard() {
  const data = await getProductsData();
  console.log(data)

  const card = document.createElement("div");
  card.classList.add("card");

  card.innerHTML = `
        <img src="${data[0].images[0]}" alt="${data[0].title}">
        <h2>${data[0].title}</h2>
        <h2>${data[0].price}</h2>
    `;

  container.appendChild(card);
}

productCard()
