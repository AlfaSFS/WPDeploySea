#!/usr/bin/env node

/**
 * Тестовый скрипт для отправки пинга в Telegram
 * Проверяет работу Telegram уведомлений
 */

const TELEGRAM_BOT_TOKEN = "8361222877:AAFmtxkFkoXu-htgNna1U_PVLhsPpFJE4qE";
const TELEGRAM_CHAT_ID = "417042050";

async function sendTestPing() {
   const message = `
🔔 <b>CV Project: Тест связи</b>

📅 Дата: ${new Date().toLocaleString("ru-RU", {
      timeZone: "Europe/Kiev",
   })}
🌐 Сервер: VPS (91.107.204.141)
📋 Статус: Проверка интеграции Telegram

✅ Telegram бот работает корректно!
🚀 Готов к получению уведомлений о заказах
    `.trim();

   try {
      console.log("🔄 Отправка тестового сообщения в Telegram...");
      console.log(`📱 Chat ID: ${TELEGRAM_CHAT_ID}`);
      console.log(`🤖 Bot Token: ${TELEGRAM_BOT_TOKEN.substring(0, 20)}...`);

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

      console.log(`📊 HTTP статус: ${response.status}`);

      const result = await response.json();

      if (!result.ok) {
         console.error("❌ Ошибка отправки в Telegram:");
         console.error(JSON.stringify(result, null, 2));
         return false;
      }

      console.log("✅ Сообщение успешно отправлено в Telegram!");
      console.log(`📬 Message ID: ${result.result.message_id}`);
      console.log(`💬 Chat ID: ${result.result.chat.id}`);

      return true;
   } catch (error) {
      console.error("❌ Ошибка при отправке в Telegram:");
      console.error(error.message);
      return false;
   }
}

// Запускаем тест
sendTestPing()
   .then((success) => {
      if (success) {
         console.log("\n🎉 Telegram пинг прошел успешно!");
         console.log("✅ Уведомления о заказах будут приходить корректно");
      } else {
         console.log("\n💥 Telegram пинг не удался");
         console.log("❌ Проверьте настройки бота и chat ID");
      }
      process.exit(success ? 0 : 1);
   })
   .catch((error) => {
      console.error("💥 Критическая ошибка:", error);
      process.exit(1);
   });
