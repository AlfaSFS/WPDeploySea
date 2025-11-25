import fetch from "node-fetch";
import FormData from "form-data";
import fs from "fs";

const TELEGRAM_BOT_TOKEN = "7920422896:AAEKY5avbRp4__uA7lz0xO_Ytldb-XlsE-U";
const TELEGRAM_CHAT_ID = "-1002345678901";

async function testTelegramFile() {
   try {
      console.log("Тестируем отправку файла в Telegram...");

      const filePath = "/app/uploads/1756819100636_test.pdf";

      if (!fs.existsSync(filePath)) {
         console.error("Файл не найден:", filePath);
         return;
      }

      console.log("Файл найден:", filePath);

      const form = new FormData();
      form.append("chat_id", TELEGRAM_CHAT_ID);
      form.append("document", fs.createReadStream(filePath));
      form.append("caption", "Тест отправки файла через Node.js");

      console.log("Отправляем запрос...");

      const response = await fetch(
         `https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/sendDocument`,
         {
            method: "POST",
            body: form,
            headers: form.getHeaders(),
         }
      );

      console.log("Статус ответа:", response.status);

      if (!response.ok) {
         const errorText = await response.text();
         console.error("Ошибка ответа:", errorText);
         return;
      }

      const result = await response.json();
      console.log("Успешно! Результат:", result);
   } catch (error) {
      console.error("Ошибка:", error.message);
   }
}

testTelegramFile();
