(function handleBusket() {
   document.addEventListener("DOMContentLoaded", () => {
      const cartContainer = document.querySelector("#busket-items");
      const itemsForPayWrap = document.querySelector(".items-payment");
      const totalAmount = document.querySelector(".total-payment");

      let cart = JSON.parse(localStorage.getItem("cart")) || [];

      // Функция обновления счетчика корзины
      const updateBucketCount = () => {
         const bucket = document.querySelector(".buscet");
         const bucketCount = bucket?.querySelector(".buscket-count");

         if (!bucketCount) return;

         if (cart.length > 0) {
            bucketCount.textContent = cart.length;
            bucketCount.classList.add("active");
         } else {
            bucketCount.textContent = "";
            bucketCount.classList.remove("active");
         }
      };

      // Функция рендера корзины
      const renderCart = () => {
         cartContainer.innerHTML = "";
         itemsForPayWrap.innerHTML = "";

         if (cart.length === 0) {
            cartContainer.innerHTML = "<p>Ваш кошик пустий</p>";
            totalAmount.textContent = `€ 0`;
            updateBucketCount(); // Обновляем счетчик для пустой корзины
            return;
         }

         cart.forEach((item) => {
            const productHTML = `
               <div class="busket-items-item" data-id="${item.id}">
                  <div class="busket-items-item-title">
                     <h5>${item.group}</h5>
                  </div>
                  <div class="busket-items-item-wrapper">
                     <div class="grid-image" ${
                        item.group && item.group !== "Розсилка CV по регіону"
                           ? "data-reg=false"
                           : ""
                     }>
                        <img src="${item.icon}" alt="" />
                        ${
                           item.icon2
                              ? `<img src="${item.icon2}" alt="" />`
                              : ""
                        }
                     </div>
                     <div class='grid-content'>
                        <div class="grid-subtitle">${item.name}</div>
                        <div class="grid-price">
                           <span class="curncy">€</span>
                           <span class="mount">${item.price}</span>
                        </div>
                     </div>
                  </div>
                  <button class="delete">delete</button>
               </div>
            `;

            const itemsForPayHTML = `
               <div class="item-summary">
                  <span>${item.group}:</span> <strong>€${item.price}</strong>
               </div>
            `;

            cartContainer.insertAdjacentHTML("beforeend", productHTML);
            itemsForPayWrap.insertAdjacentHTML("beforeend", itemsForPayHTML);
         });
         const total = cart.reduce((sum, item) => sum + Number(item.price), 0);
         totalAmount.textContent = `€ ${total}`;

         // Обновляем счетчик корзины
         updateBucketCount();

         // Отправляем событие для синхронизации с другими скриптами
         window.dispatchEvent(
            new CustomEvent("cartUpdated", {
               detail: { cartLength: cart.length },
            })
         );
      };

      // Первичная отрисовка
      renderCart();

      // Удаление элемента
      cartContainer.addEventListener("click", (e) => {
         if (e.target.classList.contains("delete")) {
            const card = e.target.closest(".busket-items-item");
            const id = card.dataset.id;

            // Приводим ID к тому же типу, что и в cart
            cart = cart.filter((item) => String(item.id) !== String(id));

            // Обновляем localStorage
            localStorage.setItem("cart", JSON.stringify(cart));

            // Перерисовываем корзину и список для оплаты
            renderCart();
         }
      });
      const btn = document.getElementById("goOrder");

      btn.addEventListener("click", () => {
         if (cart.length === 0) {
            btn.classList.add("disabled");
            btn.disabled = true;
            btn.textContent = "Додайте товари до кошика";
            return;
         }
         window.location.href = "/order/";
      });
   });
})();
