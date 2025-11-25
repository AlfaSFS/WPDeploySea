// backend/src/telegram.js
import fs from "node:fs";
import FormData from "form-data";
import https from "node:https";
import path from "node:path";
import fetch from "node-fetch";

const TELEGRAM_BOT_TOKEN = process.env.TELEGRAM_BOT_TOKEN;
const TELEGRAM_CHAT_ID = process.env.TELEGRAM_CHAT_ID;

// Создаем HTTPS агент для игнорирования SSL ошибок в контейнере
const httpsAgent = new https.Agent({
   rejectUnauthorized: false,
});

// Отключаем проверку SSL сертификатов для fetch
process.env.NODE_TLS_REJECT_UNAUTHORIZED = "0";

if (!TELEGRAM_BOT_TOKEN) {
   console.warn(
      "TELEGRAM_BOT_TOKEN не установлен. Уведомления в Telegram отключены."
   );
}

if (!TELEGRAM_CHAT_ID) {
   console.warn(
      "TELEGRAM_CHAT_ID не установлен. Уведомления в Telegram отключены."
   );
}

/**
 * Отправляет сообщение в Telegram
 * @param {string} message - Текст сообщения
 * @returns {Promise<boolean>} - Успешность отправки
 */
async function sendMessage(message) {
   if (!TELEGRAM_BOT_TOKEN || !TELEGRAM_CHAT_ID) {
      // console.log("Telegram уведомления отключены");
      return false;
   }

   try {
      const response = await fetch(
         `https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/sendMessage`,
         {
            method: "POST",
            headers: {
               "Content-Type": "application/json",
            },
            body: JSON.stringify({
               chat_id: TELEGRAM_CHAT_ID,
               text: message,
               parse_mode: "HTML",
            }),
         }
      );

      const result = await response.json();

      if (!result.ok) {
         console.error("Ошибка отправки в Telegram:", result);
         return false;
      }

      // console.log("Сообщение отправлено в Telegram");
      return true;
   } catch (error) {
      console.error("Ошибка при отправке в Telegram:", error);
      return false;
   }
}

/**
 * Отправляет файл в Telegram
 * @param {string} filePath - Путь к файлу
 * @param {string} caption - Подпись к файлу
 * @returns {Promise<boolean>} - Успешность отправки
 */
async function sendFile(filePath, caption = "") {
   if (!TELEGRAM_BOT_TOKEN || !TELEGRAM_CHAT_ID) {
      // console.log("Telegram уведомления отключены");
      return false;
   }

   if (!fs.existsSync(filePath)) {
      console.error("Файл не найден:", filePath);
      return false;
   }

   try {
      // console.log("Отправляем файл в Telegram:", filePath);
      // console.log("Размер файла:", fs.statSync(filePath).size, "байт");

      // Создаем поток для чтения файла
      const fileStream = fs.createReadStream(filePath);
      const fileName = path.basename(filePath);

      const form = new FormData();
      form.append("chat_id", TELEGRAM_CHAT_ID);
      form.append("document", fileStream, fileName);

      if (caption) {
         form.append("caption", caption);
         form.append("parse_mode", "HTML");
      }

      // console.log("FormData создан, отправляем запрос...");
      // console.log("Заголовки FormData:", form.getHeaders());

      const response = await fetch(
         `https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/sendDocument`,
         {
            method: "POST",
            body: form,
            headers: form.getHeaders(),
         }
      );

      // console.log("Получен ответ от Telegram API, статус:", response.status);

      if (!response.ok) {
         const errorText = await response.text();
         console.error("HTTP ошибка:", response.status, response.statusText);
         console.error("Текст ошибки:", errorText);
         return false;
      }

      const result = await response.json();
      // console.log("Telegram response:", result);

      if (!result.ok) {
         console.error("Ошибка отправки файла в Telegram:", result);
         return false;
      }

      // console.log("Файл отправлен в Telegram");
      return true;
   } catch (error) {
      console.error("Ошибка при отправке файла в Telegram:", error);
      return false;
   }
}

/**
 * Отправляет уведомление о новом заказе
 * @param {Object} order - Данные заказа
 * @param {string} filePath - Путь к файлу резюме (опционально)
 * @returns {Promise<boolean>} - Успешность отправки
 */
async function sendOrderNotification(order, filePath = null) {
   // Форматируем корзину для отображения
   let cartInfo = "❌ Не указана";
   if (order.cart) {
      try {
         const cartData = JSON.parse(order.cart);
         if (Array.isArray(cartData) && cartData.length > 0) {
            cartInfo = cartData
               .map(
                  (item) =>
                     `• ${item.name || "Товар"} - ${item.price || 0} ${
                        order.currency
                     }`
               )
               .join("\n");
         }
      } catch (e) {
         cartInfo = "⚠️ Ошибка парсинга корзины";
      }
   }

   const message = `
🆕 <b>Новый заказ!</b>

👤 <b>Клиент:</b>
   Имя: ${order.name || "Не указано"}
   Фамилия: ${order.surname || "Не указано"}
   Email: <code>${order.email}</code>
   Телефон: ${order.phone || "Не указан"}

💰 <b>Заказ:</b>
   Сумма: <b>${order.total_amount} ${order.currency}</b>
   ID: <code>${order.id}</code>
   Дата: ${new Date(order.created_at).toLocaleString("ru-RU")}

🛒 <b>Корзина:</b>
${cartInfo}

📱 <b>Мессенджеры:</b> ${order.messengers || "Не указаны"}

📄 <b>Резюме:</b> ${order.cv_filename ? "✅ Прикреплено" : "❌ Отсутствует"}

💭 <b>Комментарий:</b> ${order.comment || "Нет комментария"}

🚫 <b>Нежелательные услуги:</b> ${order.no_wish || "Не указано"}
   `.trim();

   // Отправляем сообщение
   const messageSent = await sendMessage(message);

   // Отправляем файл резюме, если он есть
   if (filePath && order.cv_filename) {
      // console.log(`Файл резюме: ${order.cv_filename} (${filePath})`);

      const caption = `📄 Резюме для заказа ${order.id}`;
      const fileSent = await sendFile(filePath, caption);

      if (fileSent) {
         // console.log("✅ Файл резюме успешно отправлен в Telegram");
      } else {
         // console.log("❌ Ошибка отправки файла резюме в Telegram");
      }
   }

   return messageSent;
}

export { sendMessage, sendFile, sendOrderNotification };
