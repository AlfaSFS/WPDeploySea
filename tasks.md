# 📝 Cursor Task: WayForPay Sandbox Integration

## Цель:

Адаптировать существующую интеграцию WayForPay (sandbox) для полного цикла: от
создания заказа до успешного коллбека.

## 🔧 Что нужно сделать

### 1. Бэкенд (Node.js + Express) - Адаптация существующего кода

**Обновить существующий эндпоинт POST /orders:**

-  ✅ Уже принимает:
   `{ email, total_amount, currency, first_name, last_name, phone }`
-  ✅ Уже генерирует: `orderReference` (UUID) и `orderDate`
-  ✅ Уже строит подпись `merchantSignature` через HMAC-MD5
-  ✅ Уже возвращает: `{ id, status, payment_url, payment_data }`

**Добавить поддержку items в /orders:**

-  Расширить для принятия
   `{ amount, currency, items: [{name, price, count}], clientEmail }`
-  Генерировать `productName`, `productCount`, `productPrice` из items
-  Обновить подпись для поддержки массивов продуктов

**Обновить существующий эндпоинт POST /payments/callback:**

-  ✅ Уже принимает JSON от WayForPay
-  ✅ Уже проверяет подпись по правильной схеме
-  ✅ Уже отвечает "accept" при валидной подписи
-  ✅ Уже обновляет статус заказа в БД
-  ✅ Уже отправляет уведомления в Telegram

**Добавить логирование:** заголовки + тело запроса коллбека (улучшить
существующее).

### 2. Конфигурация .env

```
# ✅ Текущие переменные (уже настроены и работают):
WAYFORPAY_MERCHANT_ACCOUNT=test_merch_n1
WAYFORPAY_SECRET_KEY=flk3409refn54t54t*FNJRET
WAYFORPAY_DOMAIN_NAME=https://seafarer-cv.com
WAYFORPAY_API_URL=https://secure.wayforpay.com/pay
WAYFORPAY_CALLBACK_URL=https://seafarer-cv.com/api/payments/callback
WAYFORPAY_RETURN_URL=https://seafarer-cv.com/payment-success

# Дополнительные переменные (опционально для совместимости):
WFP_MERCHANT_ACCOUNT=test_merch_n1
WFP_MERCHANT_SECRET=flk3409refn54t54t*FNJRET
WFP_DOMAIN=seafarer-cv.com
WFP_RETURN_URL=https://seafarer-cv.com/success
WFP_CANCEL_URL=https://seafarer-cv.com/fail
WFP_SERVICE_URL=https://seafarer-cv.com/api/payments/callback
```

### 3. NGINX Proxy

```nginx
# ✅ Текущая конфигурация (уже работает):
location ^~ /api/ {
    proxy_pass http://backend:3000/;  # ВАЖНО: слеш в конце!
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
}
```

**Статус:** ✅ Уже настроено и работает

### 4. Cloudflare Firewall

**Обновить правило для существующего callback:**

```
(http.host eq "seafarer-cv.com" and starts_with(http.request.uri.path, "/api/payments/callback"))
```

-  **Action** → Skip: Managed WAF, Bot Fight, Security Level.
-  **Cache Rule**: Bypass cache для `/api/*`.

**Статус:** ⚠️ Требует настройки для `/api/payments/callback`

### 5. Фронтенд

**Обновить существующую форму для работы с /orders:**

```javascript
// Текущий API (уже работает):
async function createOrder() {
   const resp = await fetch("/api/orders", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
         email: "test@example.com",
         total_amount: 100,
         currency: "UAH",
         first_name: "Тест",
         last_name: "Пользователь",
         phone: "+380501234567",
      }),
   });
   const data = await resp.json();
   if (data.payment_url) {
      // Перенаправляем на WayForPay
      window.location.href = data.payment_url;
   } else {
      console.error(data);
   }
}

// Расширенный API (требует доработки):
async function createOrderWithItems() {
   const resp = await fetch("/api/orders", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
         email: "test@example.com",
         amount: 100,
         currency: "UAH",
         items: [
            { name: "CV Writing Service", price: 50, count: 1 },
            { name: "CV Translation", price: 30, count: 1 },
            { name: "Email Distribution", price: 20, count: 1 },
         ],
      }),
   });
   const data = await resp.json();
   if (data.payment_url) {
      window.location.href = data.payment_url;
   } else {
      console.error(data);
   }
}
```

### 6. Тестовый скрипт для эмуляции коллбека

Файл `wfp-callback-test.mjs`:

```javascript
import crypto from "crypto";
import fetch from "node-fetch";

const secret = process.env.WAYFORPAY_SECRET_KEY || "flk3409refn54t54t*FNJRET";
const url = "https://seafarer-cv.com/api/payments/callback"; // Существующий callback

const payload = {
   merchantAccount: "test_merch_n1",
   orderReference: "ORDER-CB-" + Date.now(),
   amount: "1",
   currency: "UAH",
   authCode: "123456",
   cardPan: "444455******7779",
   transactionStatus: "Approved",
   reasonCode: 1100,
};

const signatureString = [
   payload.merchantAccount,
   payload.orderReference,
   payload.amount,
   payload.currency,
   payload.authCode,
   payload.cardPan,
   payload.transactionStatus,
   payload.reasonCode,
].join(";");

payload.merchantSignature = crypto
   .createHmac("md5", secret)
   .update(signatureString, "utf8")
   .digest("base64");

const resp = await fetch(url, {
   method: "POST",
   headers: { "content-type": "application/json" },
   body: JSON.stringify(payload),
});

console.log("Status:", resp.status);
console.log("Text:", await resp.text());
```

**Ожидаемый ответ:**

```
Status: 200
Text: {"orderReference":"ORDER-CB-...","status":"accept","time":...,"signature":"..."}
```

## ✅ Результат

-  `/api/orders` выдаёт `payment_url` (уже работает)
-  по `payment_url` тестовая карта `4444555566667779` проходит успешно
-  `/api/payments/callback` получает реальный POST и отвечает `accept` (уже
   работает)
-  Cloudflare и NGINX не мешают (уже настроено)
-  Поддержка items в заказах (требует доработки)

---

## 📋 Текущий статус проекта

### ✅ Уже реализовано:

-  [x] Базовая интеграция WayForPay с тестовыми реквизитами
-  [x] Создание заказов через API (`/orders`)
-  [x] Callback обработка с проверкой подписи (`/payments/callback`)
-  [x] HTTPS настройка с Cloudflare SSL
-  [x] Nginx прокси для API (порт 3000)
-  [x] Docker контейнеризация
-  [x] Переменные окружения настроены (`WAYFORPAY_*`)

### 🔄 Требует доработки:

-  [ ] Добавить поддержку `items` в существующий `/api/orders`
-  [ ] Улучшить логирование для callback (заголовки + тело)
-  [ ] Создать тестовый скрипт для эмуляции callback
-  [ ] Настроить Cloudflare правила для `/api/payments/callback`
-  [ ] Обновить фронтенд для работы с items
-  [ ] Добавить переменные `WFP_*` для совместимости (опционально)

### 🎯 Приоритет:

1. **Высокий:** Добавить поддержку `items` в `/api/orders`
2. **Средний:** Улучшить логирование callback
3. **Низкий:** Настроить Cloudflare правила
4. **Тестирование:** Создать тестовый скрипт

### 🚀 Готово к использованию:

-  ✅ Создание заказов через `/api/orders`
-  ✅ WayForPay интеграция с тестовыми реквизитами
-  ✅ Callback обработка через `/api/payments/callback`
-  ✅ HTTPS и SSL настроены
-  ✅ Nginx прокси работает
-  ✅ Telegram уведомления
