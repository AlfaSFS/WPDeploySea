# 🧪 WayForPay Real Declined E2E Test - Инструкции

## 📋 Созданный заказ для тестирования

**Order ID:** `fb30493c-df21-4e47-927e-8bffa93b9d4f`  
**Email:** declined-test@example.com  
**Amount:** 1.00 EUR (40.00 UAH)  
**Status:** pending

## 🚀 Пошаговые инструкции

### 1. Откройте hosted checkout

Перейдите по ссылке: https://secure.wayforpay.com/pay

Или используйте данные из payment_data:

-  **merchantAccount:** test_merch_n1
-  **orderReference:** fb30493c-df21-4e47-927e-8bffa93b9d4f
-  **amount:** 40.00
-  **currency:** UAH

### 2. Используйте тест-карту для Declined

**Карта:** `4111 1111 1111 1111`  
**Срок:** любой (например, 12/25)  
**CVV:** любой (например, 123)

### 3. Мониторинг логов (в отдельных терминалах)

**Backend логи:**

```bash
cd /Users/alexey.nikolayenko/Desktop/Experiments/mail-sender/CV-project
./vps_commands.sh "cd /var/www/cv-project && docker compose logs -f --tail=0 backend"
```

**Nginx логи:**

```bash
cd /Users/alexey.nikolayenko/Desktop/Experiments/mail-sender/CV-project
./vps_commands.sh "cd /var/www/cv-project && docker compose exec nginx sh -c 'tail -f /var/log/nginx/access.log'"
```

### 4. Ожидаемые результаты

**В nginx логах:**

```
POST /api/payments/wayforpay/callback HTTP/2.0" 200
```

**В backend логах:**

```
[WFP] CB IN { ct: 'application/x-www-form-urlencoded', orderReference: 'fb30493c-df21-4e47-927e-8bffa93b9d4f', transactionStatus: 'Declined', amount: '40.00', currency: 'UAH', reasonCode: '1005' }
[WFP] signature OK <fb30493c-df21-4e47-927e-8bffa93b9d4f>
[WFP] ACK <fb30493c-df21-4e47-927e-8bffa93b9d4f> declined
```

### 5. Проверка статуса заказа

```bash
curl -s https://seafarer-cv.com/api/orders/fb30493c-df21-4e47-927e-8bffa93b9d4f/status | jq
```

**Ожидаемый результат:**

```json
{
   "id": "fb30493c-df21-4e47-927e-8bffa93b9d4f",
   "status": "failed",
   "total_amount": 1,
   "currency": "EUR",
   "is_paid": false
}
```

### 6. Проверка страницы /payment-success

Откройте:
https://seafarer-cv.com/payment-success?order=fb30493c-df21-4e47-927e-8bffa93b9d4f

**Ожидаемый результат:**

-  ❌ Красный крестик
-  Сообщение об ошибке платежа
-  Кнопка "Спробувати ще раз"

## 🔧 Настройка Telegram (опционально)

### 1. Получить chat_id

```bash
# Замените YOUR_BOT_TOKEN на реальный токен
curl -s "https://api.telegram.org/bot<YOUR_BOT_TOKEN>/getUpdates" | jq '.result[-1].message.chat.id'
```

### 2. Обновить .env на VPS

```bash
./vps_commands.sh "cd /var/www/cv-project && sed -i 's/TELEGRAM_CHAT_ID=your_telegram_chat_id/TELEGRAM_CHAT_ID=<REAL_CHAT_ID>/' .env"
```

### 3. Перезапустить backend

```bash
./vps_commands.sh "cd /var/www/cv-project && docker compose restart backend"
```

### 4. Тест отправки сообщения

```bash
curl -s -X POST "https://api.telegram.org/bot<YOUR_BOT_TOKEN>/sendMessage" \
  -d chat_id="<REAL_CHAT_ID>" -d text="CV Project: тест"
```

## 📊 Сбор результатов

После выполнения теста соберите:

1. **Логи backend** (10-20 строк вокруг [WFP] CB IN)
2. **Логи nginx** (строка с POST /api/payments/wayforpay/callback 200)
3. **Статус заказа** (JSON с failed статусом)
4. **Скриншот** страницы /payment-success

## 🚨 Если коллбек не приходит

Если по какой-то причине коллбек не дойдет, можно отправить его вручную:

```bash
curl -i -X POST https://seafarer-cv.com/api/payments/wayforpay/callback \
  -H "Content-Type: application/x-www-form-urlencoded" \
  --data-raw '{"merchantAccount":"test_merch_n1","orderReference":"fb30493c-df21-4e47-927e-8bffa93b9d4f","amount":"40.00","currency":"UAH","authCode":"123456","cardPan":"4111111111111111","transactionStatus":"Declined","reasonCode":"1005","merchantSignature":"fake_signature_for_test"}'
```

---

**Время начала теста:** $(date)  
**Order ID:** fb30493c-df21-4e47-927e-8bffa93b9d4f  
**Статус:** Готов к выполнению
