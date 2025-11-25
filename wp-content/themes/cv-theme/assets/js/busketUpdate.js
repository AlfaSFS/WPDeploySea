document.addEventListener("DOMContentLoaded", () => {
   // Получаем ссылку на контейнер корзины
   const bucket = document.querySelector(".buscet");
   const bucketCount = bucket?.querySelector(".buscket-count");

   // Функция для получения корзины
   function getCart() {
      return JSON.parse(localStorage.getItem("cart")) || [];
   }

   // Обновление счётчика
   function updateBucketCount() {
      if (!bucketCount) return; // если элемента нет — выходим
      const cart = getCart();
      if (cart.length > 0) {
         bucketCount.textContent = cart.length;
         bucketCount.classList.add("active");
      } else {
         bucketCount.textContent = "";
         bucketCount.classList.remove("active");
      }
   }

   // Показ попапа с разными сообщениями
   function showCartPopup(type = "success") {
      const popup = document.getElementById("cart-popup");
      if (!popup) return;

      const title = document.getElementById("cart-popup-title");
      const message = document.getElementById("cart-popup-message");
      const iconSuccess = document.getElementById("cart-popup-icon-success");
      const iconWarning = document.getElementById("cart-popup-icon-warning");

      if (type === "warning") {
         // Товар уже в корзине
         popup.classList.add("warning");
         title.textContent = "Товар вже в кошику!";
         message.textContent = "Цей товар вже додано до вашого кошика.";
         iconSuccess.style.display = "none";
         iconWarning.style.display = "block";
      } else {
         // Товар успешно добавлен
         popup.classList.remove("warning");
         title.textContent = "Товар додано до кошика!";
         message.textContent = "Товар успішно додано до вашого кошика.";
         iconSuccess.style.display = "block";
         iconWarning.style.display = "none";
      }

      popup.classList.remove("hidden");

      setTimeout(() => popup.classList.add("hidden"), 3000);
   }

   // Закрытие попапа
   const popupClose = document.getElementById("cart-popup-close");
   if (popupClose) {
      popupClose.addEventListener("click", () => {
         document.getElementById("cart-popup").classList.add("hidden");
      });
   }

   // Обновляем счётчик при загрузке
   updateBucketCount();

   // Слушаем события обновления корзины от других скриптов
   window.addEventListener("cartUpdated", (event) => {
      updateBucketCount();
   });

   // Обновляем счетчик при возврате на страницу (например, через history.back())
   window.addEventListener("pageshow", (event) => {
      updateBucketCount();
   });

   // Обновляем счетчик при фокусе на окне (когда пользователь возвращается на вкладку)
   window.addEventListener("focus", () => {
      updateBucketCount();
   });

   // Добавление товаров
   document.querySelectorAll(".bucket").forEach((button) => {
      button.addEventListener("click", (e) => {
         e.preventDefault();
         const product = {
            id: button.dataset.id,
            name: button.dataset.name,
            price: parseFloat(button.dataset.price),
            group: button.dataset.group,
            icon: button.dataset?.icon,
            icon2: button.dataset?.icon2,
         };

         let cart = getCart();
         const existingProduct = cart.find((item) => item.id === product.id);

         if (existingProduct) {
            // Товар уже в корзине - показываем предупреждение
            showCartPopup("warning");
         } else {
            // Товар новый - добавляем в корзину
            cart.push(product);
            localStorage.setItem("cart", JSON.stringify(cart));
            showCartPopup("success");
            updateBucketCount();

            // Отправляем событие для синхронизации с другими скриптами
            window.dispatchEvent(
               new CustomEvent("cartUpdated", {
                  detail: { cartLength: cart.length },
               })
            );
         }
      });
   });
});
