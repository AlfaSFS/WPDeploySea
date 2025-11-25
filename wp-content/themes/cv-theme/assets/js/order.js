const form = document.getElementById("sendOrder");
const messageBox = document.getElementById("formMessage");

// Обработчик клавиши Enter для чекбоксов в блоке messenger-wrap
document.addEventListener("DOMContentLoaded", function () {
   const messengerCheckboxes = document.querySelectorAll(
      '.messenger-wrap input[type="checkbox"]'
   );

   messengerCheckboxes.forEach((checkbox) => {
      checkbox.addEventListener("keydown", function (event) {
         if (event.key === "Enter" || event.key === " ") {
            event.preventDefault();
            this.checked = !this.checked;

            // Создаем событие change для корректной работы валидации
            const changeEvent = new Event("change", { bubbles: true });
            this.dispatchEvent(changeEvent);
         }
      });
   });

   // Обработчик для чекбокса соглашения
   const agreementCheckbox = document.getElementById("agree");
   if (agreementCheckbox) {
      agreementCheckbox.addEventListener("keydown", function (event) {
         if (event.key === "Enter" || event.key === " ") {
            event.preventDefault();
            this.checked = !this.checked;

            // Создаем событие change для корректной работы валидации
            const changeEvent = new Event("change", { bubbles: true });
            this.dispatchEvent(changeEvent);
         }
      });
   }
});

const input = document.getElementById("resume");
const fileName = document.querySelector(".file-name");
const totalBlock = document.querySelector(".order-total-amount");
const span = totalBlock.querySelector(".order-total-amount--value");

const orderBody = document.querySelector(".order-body");

// Обработчик изменения файла
input.addEventListener("change", () => {
   fileName.textContent = input.files.length
      ? input.files[0].name
      : "Файл не обрано";
});

// Функция отображения заказа из корзины
function renderOrder() {
   const order = JSON.parse(localStorage.getItem("cart")) || [];

   // Очищаем предыдущие товары
   orderBody.innerHTML = "";

   order.forEach((item) => {
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
               </div>
            `;

      orderBody.insertAdjacentHTML("beforeend", productHTML);
   });

   const total = order.reduce((sum, item) => sum + Number(item.price), 0);

   span.textContent = `€ ${total}`;
}

form.addEventListener("submit", async (e) => {
   e.preventDefault();

   let valid = true;
   messageBox.textContent = "";

   // Получаем значения полей
   const name = form.name.value.trim();
   const surname = form.surname.value.trim();
   const email = form.email.value.trim();
   const phone = form.phone.value.trim();
   const resume = form.resume.files[0];

   function showSuccessPopup() {
      // Очищаем localStorage перед показом попапа
      localStorage.removeItem("cart");

      const popup = document.getElementById("successPopup");
      popup.style.display = "flex";

      // Через 5 секунд редирект на главну
      setTimeout(() => {
         window.location.href = "/";
      }, 5000);
   }

   const checkboxes = document.querySelectorAll("input[name='messengers']");
   const isChecked = Array.from(checkboxes).some(
      (checkbox) => checkbox.checked
   );

   // Проверяем согласие с условиями
   const checkboxAgree = form.agreement;

   // ===== ВАЛИДАЦИЯ ФОРМЫ =====

   // Очищаем предыдущие ошибки
   clearErrors();

   if (!name || name.length < 2) {
      document.querySelector('[data-for="name"]').textContent =
         "Вкажіть ваше ім’я";
      form.name.classList.add("error");
      valid = false;
   } else {
      document.querySelector('[data-for="name"]').textContent = "";
      form.name.classList.add("success");
   }
   if (!surname || surname.length < 2) {
      document.querySelector('[data-for="surname"]').textContent =
         "Вкажіть ваше прізвище";
      form.surname.classList.add("error");
      valid = false;
   } else {
      document.querySelector('[data-for="surname"]').textContent = "";
      form.surname.classList.add("success");
   }
   if (!email || !/^\S+@\S+\.\S+$/.test(email)) {
      document.querySelector('[data-for="email"]').textContent =
         "Невірний формат електронної адреси";
      form.email.classList.add("error");
      valid = false;
   } else {
      document.querySelector('[data-for="email"]').textContent = "";
      form.email.classList.add("success");
   }

   // Телефон - необязательное поле
   if (phone && !/^\+?\d{7,15}$/.test(phone)) {
      document.querySelector('[data-for="phone"]').textContent =
         "Невірний формат номера телефону";
      form.phone.classList.add("error");
      valid = false;
   } else if (phone) {
      document.querySelector('[data-for="phone"]').textContent = "";
      form.phone.classList.add("success");
   } else {
      document.querySelector('[data-for="phone"]').textContent = "";
      form.phone.classList.remove("error", "success");
   }

   if (!resume) {
      document.querySelector('[data-for="resume"]').textContent =
         "Обов'язково додайте файл CV";
      document.querySelector(".custom-file-label").classList.add("error");
      // form.resume.classList.add("error");
      valid = false;
   } else if (resume.size > 5 * 1024 * 1024) {
      document.querySelector('[data-for="resume"]').textContent =
         "Файл занадто великий (максимум 5 МБ)";
      document.querySelector(".custom-file-label").classList.add("error");
      valid = false;
   } else {
      document.querySelector(".custom-file-label").classList.add("success");
      document.querySelector('[data-for="resume"]').textContent = "";
   }
   if (!isChecked) {
      document.querySelector('[data-for="messengers"]').textContent =
         "Оберіть хоча б один зручний месенджер";
      valid = false;
   } else {
      document.querySelector('[data-for="messengers"]').textContent = "";
   }

   if (!checkboxAgree.checked) {
      document.querySelector('[data-for="agreement"]').textContent =
         "Потрібно погодитися з умовами використання";
      valid = false;
   } else {
      document.querySelector('[data-for="agreement"]').textContent = "";
   }

   if (!valid) {
      return; // останавливаем отправку
   }

   const fileInput = document.getElementById("resume");
   const file = fileInput?.files?.[0];
   if (!file) {
      console.error("Щось не так з файлом, не обрано");
   }

   // Берём корзину из localStorage
   const cart = JSON.parse(localStorage.getItem("cart")) || [];
   const total = cart.reduce((sum, item) => sum + Number(item.price || 0), 0);
   // Формируем FormData
   const formData = new FormData();

   // Добавляем файл резюме
   if (file) {
      formData.append("resume", file);
   }

   // Добавляем остальные данные
   formData.append("cart", JSON.stringify(cart));
   formData.append("total_amount", String(total));
   formData.append("currency", "EUR");
   formData.append("name", form.name.value.trim());
   formData.append("surname", form.surname.value.trim());
   formData.append("email", form.email.value.trim());
   formData.append("phone", form.phone.value.trim());
   formData.append("no-wish", (form["no-wish"]?.value || "").trim());
   formData.append("comment", (form.comment?.value || "").trim());

   // Добавляем выбранные мессенджеры
   const selectedMessengers = [
      ...document.querySelectorAll("input[name='messengers']:checked"),
   ].map((el) => el.value);
   selectedMessengers.forEach((v) => formData.append("messengers", v));

   // ===== ПРОВЕРКА СУММЫ =====
   if (total <= 0) {
      messageBox.textContent =
         "Додайте товари до кошика перед відправкою замовлення";
      return;
   }

   // ===== ОТПРАВКА НА BACKEND API =====

   const btn = form.querySelector('button[type="submit"]');
   btn.disabled = true;
   const oldTxt = btn.textContent;
   btn.textContent = "Відправляємо…";

   for (const [k, v] of formData.entries()) {
   }

   try {
      const res = await fetch("/api/orders", {
         method: "POST",
         body: formData,
      });

      const data = await res.json().catch(() => ({}));

      if (!res.ok) {
         throw new Error(data?.error || `Помилка сервера (${res.status})`);
      }

      if (!data?.id) {
         throw new Error("Сервер не повернув ID замовлення");
      }

      // ===== УСПЕШНАЯ ОТПРАВКА =====

      // Очищаем localStorage после успешной отправки заказа
      localStorage.removeItem("cart");

      // Если есть данные для виджета, используем платёжный виджет
      if (data.widget_data) {
         initPaymentWidget(data.id, data.widget_data);
      } else if (data.payment_data && data.payment_url) {
         // Создаем форму для отправки на WayForPay
         const paymentForm = document.createElement("form");
         paymentForm.method = "POST";
         paymentForm.action = data.payment_url;
         paymentForm.style.display = "none";

         // Добавляем все поля из payment_data
         Object.entries(data.payment_data).forEach(([key, val]) => {
            const pushField = (name, value) => {
               const input = document.createElement("input");
               input.type = "hidden";
               input.name = name;
               input.value = String(value);
               paymentForm.appendChild(input);
            };

            const isPriceKey = (k) =>
               k === "amount" || k === "productPrice" || k === "productPrice[]";

            const isCountKey = (k) =>
               k === "productCount" || k === "productCount[]";

            if (Array.isArray(val)) {
               const name = key.endsWith("[]") ? key : `${key}[]`;
               val.forEach((v) => {
                  if (isPriceKey(key)) {
                     pushField(name, Number(v).toFixed(2)); // цены/суммы → x.xx
                  } else if (isCountKey(key)) {
                     pushField(name, parseInt(v, 10)); // количества → целое
                  } else {
                     pushField(name, v);
                  }
               });
            } else {
               if (isPriceKey(key)) {
                  pushField(key, Number(val).toFixed(2));
               } else if (isCountKey(key)) {
                  pushField(key, parseInt(val, 10));
               } else {
                  pushField(key, val);
               }
            }
         });

         document.body.appendChild(paymentForm);

         // Диагностический дамп формы
         const dump = new FormData(paymentForm);
         for (const [k, v] of dump.entries()) console.log("WFP FORM", k, v);

         paymentForm.submit();
      } else {
         // Ошибка - нет данных для оплаты
         console.error("No payment data received from server");
         messageBox.textContent =
            "Помилка: сервер не повернув дані для оплати. Спробуйте ще раз.";
         throw new Error("No payment data received");
      }
   } catch (err) {
      console.error("Помилка при відправці замовлення:", err);
      messageBox.textContent =
         err.message || "Помилка відправки. Спробуйте ще раз.";
   } finally {
      // Восстанавливаем кнопку
      btn.disabled = false;
      btn.textContent = oldTxt;
   }
});

// ===== ВСПОМОГАТЕЛЬНЫЕ ФУНКЦИИ =====

// Функция показа ошибки
function showError(message, duration = 5000) {
   messageBox.textContent = message;
   messageBox.style.display = "block";
   messageBox.classList.add("error");

   setTimeout(() => {
      messageBox.style.display = "none";
      messageBox.classList.remove("error");
   }, duration);
}

// Функция показа успеха
function showSuccess(message, duration = 3000) {
   messageBox.textContent = message;
   messageBox.style.display = "block";
   messageBox.classList.add("success");

   setTimeout(() => {
      messageBox.style.display = "none";
      messageBox.classList.remove("success");
   }, duration);
}

// Функция очистки ошибок
function clearErrors() {
   const errorMessages = document.querySelectorAll(".error-message");
   errorMessages.forEach((el) => (el.textContent = ""));

   const errorInputs = document.querySelectorAll(".error");
   errorInputs.forEach((el) => el.classList.remove("error"));

   const successInputs = document.querySelectorAll(".success");
   successInputs.forEach((el) => el.classList.remove("success"));
}

// ===== ПЛАТЁЖНЫЙ ВИДЖЕТ WAYFORPAY =====

let wayforpayWidget = null;

// Инициализация платёжного виджета
function initPaymentWidget(orderId, widgetData) {
   // Показываем кнопку оплаты
   showPaymentButton(orderId, widgetData);
}

// Показ кнопки оплаты
function showPaymentButton(orderId, widgetData) {
   // Скрываем форму заказа
   const form = document.getElementById("sendOrder");
   form.style.display = "none";

   // Создаем контейнер для кнопки оплаты
   const paymentContainer = document.createElement("div");
   paymentContainer.id = "payment-container";
   paymentContainer.innerHTML = `
      <div class="payment-info">
         <h2>✅ Замовлення успішно зроблено!</h2>
         <p>Номер замовлення: <strong>${orderId}</strong></p>
         <p>Сума до оплати: <strong>${widgetData.amount} ${widgetData.currency}</strong></p>
         <p>Натисніть кнопку нижче для оплати карткою:</p>
         <button id="pay-button" class="pay-button">💳 Сплатити замовлення</button>
         <div id="payment-status" class="payment-status"></div>
      </div>
   `;

   // Добавляем стили
   const style = document.createElement("style");
   style.textContent = `
      .payment-info {
         text-align: center;
         padding: 40px;
         background: #f8f9fa;
         border-radius: 10px;
         margin: 20px 0;
      }
      .pay-button {
         background: #007bff;
         color: white;
         border: none;
         padding: 15px 30px;
         font-size: 18px;
         border-radius: 5px;
         cursor: pointer;
         margin: 20px 0;
         transition: background 0.3s;
      }
      .pay-button:hover {
         background: #0056b3;
      }
      .pay-button:disabled {
         background: #6c757d;
         cursor: not-allowed;
      }
      .payment-status {
         margin-top: 20px;
         padding: 10px;
         border-radius: 5px;
         display: none;
      }
      .payment-status.success {
         background: #d4edda;
         color: #155724;
         border: 1px solid #c3e6cb;
      }
      .payment-status.error {
         background: #f8d7da;
         color: #721c24;
         border: 1px solid #f5c6cb;
      }
      .payment-status.loading {
         background: #d1ecf1;
         color: #0c5460;
         border: 1px solid #bee5eb;
      }
   `;
   document.head.appendChild(style);

   // Вставляем контейнер после формы
   form.parentNode.insertBefore(paymentContainer, form.nextSibling);

   // Добавляем обработчик кнопки
   document.getElementById("pay-button").addEventListener("click", () => {
      startPayment(orderId, widgetData);
   });
}

// Запуск оплаты через виджет
function startPayment(orderId, widgetData) {
   const payButton = document.getElementById("pay-button");
   const statusDiv = document.getElementById("payment-status");

   // Блокируем кнопку
   payButton.disabled = true;
   payButton.textContent = "Обробка...";

   // Показываем статус
   showPaymentStatus("Ініціалізація платежу...", "loading");

   // Загружаем скрипт WayForPay если еще не загружен
   if (!window.Wayforpay) {
      loadWayForPayScript(() => {
         executePayment(orderId, widgetData);
      });
   } else {
      executePayment(orderId, widgetData);
   }
}

// Загрузка скрипта WayForPay
function loadWayForPayScript(callback) {
   const script = document.createElement("script");
   script.id = "widget-wfp-script";
   script.src = "https://secure.wayforpay.com/server/pay-widget.js";
   script.onload = callback;
   script.onerror = () => {
      showPaymentStatus("Помилка завантаження платіжного віджета", "error");
   };
   document.head.appendChild(script);
}

// Выполнение платежа
function executePayment(orderId, widgetData) {
   try {
      // Создаем экземпляр виджета
      wayforpayWidget = new Wayforpay();

      // Запускаем виджет
      wayforpayWidget.run(
         widgetData,
         // onApproved - успешная оплата
         (response) => {
            showPaymentStatus(
               "✅ Платіж успішно завершено! Дякуємо за покупку!",
               "success"
            );

            // Очищаем localStorage после успешной оплаты (дублирующей очистки не будет)
            localStorage.removeItem("cart");

            // Обновляем статус заказа
            checkOrderStatus(orderId);

            // Перенаправляем на страницу успеха через 3 секунды
            setTimeout(() => {
               window.location.href = "/payment-success/?order=" + orderId;
            }, 3000);
         },
         // onDeclined - отклоненная оплата
         (response) => {
            showPaymentStatus(
               "❌ Платіж був відхилений. Спробуйте ще раз або використайте іншу картку.",
               "error"
            );

            // Разблокируем кнопку
            const payButton = document.getElementById("pay-button");
            payButton.disabled = false;
            payButton.textContent = "💳 Сплатити замовлення";
         },
         // onPending - обработка платежа
         (response) => {
            showPaymentStatus("⏳ Платіж обробляється...", "loading");
         }
      );
   } catch (error) {
      console.error("Помилка при запуску віджета:", error);
      showPaymentStatus(
         "Помилка при запуску платіжного віджета: " + error.message,
         "error"
      );

      // Разблокируем кнопку
      const payButton = document.getElementById("pay-button");
      payButton.disabled = false;
      payButton.textContent = "💳 Оплатить заказ";
   }
}

// Показ статуса платежа
function showPaymentStatus(message, type) {
   const statusDiv = document.getElementById("payment-status");
   if (statusDiv) {
      statusDiv.textContent = message;
      statusDiv.className = `payment-status ${type}`;
      statusDiv.style.display = "block";
   }
}

// Проверка статуса заказа
async function checkOrderStatus(orderId) {
   try {
      const response = await fetch(`/api/orders/${orderId}/status`);
      const data = await response.json();

      if (data.is_paid) {
      }
   } catch (error) {
      console.error("Помилка перевірки статусу замовлення:", error);
   }
}

// Обработка событий от виджета через postMessage
window.addEventListener("message", function (event) {
   switch (event.data) {
      case "WfpWidgetEventApproved":
         break;
      case "WfpWidgetEventDeclined":
         break;
      case "WfpWidgetEventPending":
         break;
      case "WfpWidgetEventClose":
         // Разблокируем кнопку если виджет закрыт без завершения
         const payButton = document.getElementById("pay-button");
         if (payButton) {
            payButton.disabled = false;
            payButton.textContent = "💳 Сплатити замовлення";
         }
         break;
   }
});

// ===== ИНИЦИАЛИЗАЦИЯ СТРАНИЦЫ =====
renderOrder();
