function addToBuscket() {
   document.querySelectorAll(".bucket").forEach((button) => {
      button.addEventListener("click", (event) => {
         event.preventDefault(); // отменяем переход по ссылке

         const product = {
            id: button.dataset.id,
            name: button.dataset.name,
            price: parseFloat(button.dataset.price),
         };

         // Получаем текущую корзину из localStorage
         let cart = JSON.parse(localStorage.getItem("cart")) || [];

         // Проверяем, есть ли этот товар уже в корзине
         const existingProduct = cart.find((item) => item.id === product.id);

         if (existingProduct) {
            return;
         } else {
            cart.push(product);
         }

         // Сохраняем обновлённую корзину в localStorage
         localStorage.setItem("cart", JSON.stringify(cart));
      });
   });
}

function showGoods() {
   const bucket = document.querySelector(".buscet");
   const bucketCount = bucket.querySelector(".buscket-count");
}
// document.addEventListener("DOMContentLoaded", () => {
//    showGoods();
// });
showGoods();
