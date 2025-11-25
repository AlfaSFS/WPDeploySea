# 🧪 WayForPay E2E Smoke Test Guide

Полное руководство по тестированию интеграции WayForPay в проекте seafarer-cv.

## 📋 Обзор

Этот документ описывает процесс тестирования E2E-флоу: **Создание заказа →
Редирект на WayForPay → Коллбек → Статус заказа → Страница успеха**

## 🚀 Быстрый старт

### Автоматический тест

```bash
# Запуск полного smoke test
./scripts/wfp-smoke.sh
```

### Ручное тестирование

```bash
# 1. Создание заказа
curl -s -X POST https://seafarer-cv.com/api/orders \
  -F email="test@example.com" \
  -F total_amount="1.00" \
  -F currency="EUR" \
  -F first_name="Test" \
  -F last_name="User" \
  -F phone="+380123456789" | jq

# 2. Проверка статуса (замените ORDER_ID)
curl -s https://seafarer-cv.com/api/orders/<ORDER_ID>/status | jq

# 3. Симуляция успешного платежа
curl -s -X POST https://seafarer-cv.com/api/test/payment/success/<ORDER_ID> | jq
```

## 📊 Мониторинг логов

### Backend логи

```bash
# Следить за логами backend в реальном времени
docker compose logs -f --tail=0 backend

# Фильтр по WayForPay событиям
docker compose logs -f backend | grep -E "\[WFP\]|WayForPay|CB IN"
```

### Nginx логи

```bash
# Доступ к логам nginx
docker compose exec nginx sh -c 'tail -f /var/log/nginx/access.log /var/log/nginx/error.log'

# Фильтр по коллбекам
docker compose exec nginx sh -c 'tail -f /var/log/nginx/access.log' | grep "wayforpay/callback"
```

## 🎯 Тестовые сценарии

### 1. Негативный сценарий (Declined)

**Цель:** Проверить обработку отклоненных платежей

**Шаги:**

1. Создайте заказ через API
2. Используйте тест-карту для отклонения: `4111 1111 1111 1111`
3. Проверьте статус заказа
4. Проверьте страницу `/payment-success`

**Ожидаемый результат:**

-  Статус заказа: `failed`
-  `is_paid: false`
-  Страница успеха показывает ❌ и кнопку "Спробувати ще раз"

**Тест-карты для негативных сценариев:**

-  `4111 1111 1111 1111` - Declined
-  `4000 0000 0000 0002` - Declined
-  `4000 0000 0000 0069` - Declined

### 2. Позитивный сценарий (Симуляция)

**Цель:** Проверить обработку успешных платежей

**Шаги:**

1. Создайте заказ через API
2. Используйте endpoint `/api/test/payment/success/:id`
3. Проверьте статус заказа
4. Проверьте отправку в Telegram

**Ожидаемый результат:**

-  Статус заказа: `paid`
-  `is_paid: true`
-  Telegram уведомление отправлено (если настроен `TELEGRAM_CHAT_ID`)

### 3. Коллбек тестирование

**Цель:** Проверить обработку коллбеков от WayForPay

**Шаги:**

1. Найдите в логах backend строку с `[WFP] CB IN`
2. Скопируйте JSON из логов
3. Отправьте коллбек вручную:

```bash
curl -i -X POST https://seafarer-cv.com/api/payments/wayforpay/callback \
  -H "Content-Type: application/x-www-form-urlencoded" \
  --data-raw '<JSON_ИЗ_ЛОГОВ_WFP>'
```

**Ожидаемый результат:**

-  HTTP 200 OK
-  JSON ответ с `status: "accept"`
-  В логах: `[WFP] signature OK/FAIL` и `[WFP] ACK`

## 🔍 Что искать в логах

### Успешные логи

```
[WFP] CB IN { ct: 'application/x-www-form-urlencoded', orderReference: 'xxx', transactionStatus: 'Approved', amount: '40.00', currency: 'UAH', reasonCode: '1100' }
[WFP] signature OK xxx
[WFP] ACK xxx approved
```

### Неуспешные логи

```
[WFP] CB IN { ct: 'application/x-www-form-urlencoded', orderReference: 'xxx', transactionStatus: 'Declined', amount: '40.00', currency: 'UAH', reasonCode: '1005' }
[WFP] signature OK xxx
[WFP] ACK xxx declined
```

### Ошибки подписи

```
[WFP] CB IN { ct: 'application/x-www-form-urlencoded', orderReference: 'xxx', transactionStatus: 'Approved', amount: '40.00', currency: 'UAH', reasonCode: '1100' }
[WFP] signature FAIL xxx
```

## 📄 Страница успеха

### Проверка `/payment-success`

**URL:** `https://seafarer-cv.com/payment-success?order=<ORDER_ID>`

**Успешный платеж:**

-  ✅ Зеленая галочка
-  Сообщение об успешной оплате
-  Кнопка "Повернутися на головну"

**Неуспешный платеж:**

-  ❌ Красный крестик
-  Сообщение об ошибке
-  Кнопка "Спробувати ще раз"

## 📊 Отчет о тестировании

После выполнения тестов соберите следующую информацию:

### 1. Вывод скрипта

```bash
./scripts/wfp-smoke.sh > wfp-test-results.txt 2>&1
```

### 2. Логи коллбека

```bash
# 10-20 строк из логов backend вокруг [WFP] CB IN
docker compose logs backend | grep -A10 -B10 "CB IN" | tail -20
```

### 3. Nginx логи

```bash
# 1 строка из access.log с POST /api/payments/wayforpay/callback 200
docker compose exec nginx sh -c 'grep "wayforpay/callback" /var/log/nginx/access.log | tail -1'
```

### 4. Статусы заказов

```bash
# JSON для негативного сценария
curl -s https://seafarer-cv.com/api/orders/<FAILED_ORDER_ID>/status | jq

# JSON для симулированного успеха
curl -s https://seafarer-cv.com/api/orders/<SUCCESS_ORDER_ID>/status | jq
```

### 5. Аудит (если включен)

```bash
# Последние 5 записей payments_wfp
./scripts/wfp-last10.sh | head -5
```

## 🔧 Переход на PROD/EUR

### Изменения в .env

```bash
# Боевые данные WayForPay
WAYFORPAY_ACCOUNT=your_production_account
WAYFORPAY_SECRET_KEY=your_production_secret_key
WAYFORPAY_CURRENCY=EUR

# Убрать тестовые поля
# EUR2UAH=40  # Удалить эту строку
```

### Изменения в коде

#### 1. Убрать конвертацию EUR → UAH

```javascript
// БЫЛО (тест):
const rate = Number(process.env.EUR2UAH || 40);
const amountInUAH =
   finalCurrency === "EUR" ? Number(finalAmount) * rate : Number(finalAmount);

// СТАЛО (прод):
const amountInEUR = Number(finalAmount).toFixed(2);
```

#### 2. Передавать EUR напрямую

```javascript
// БЫЛО:
currency: "UAH",
amount: amountString, // строка "40.00"

// СТАЛО:
currency: "EUR",
amount: amountInEUR, // строка "1.00"
```

#### 3. Проверять currency === 'EUR'

```javascript
// В коллбеке:
if (body.currency !== "EUR") {
   console.warn("Currency mismatch:", body.currency);
   return res.status(400).json({ error: "Currency mismatch" });
}
```

#### 4. Сверять суммы в 2 знака

```javascript
// БЫЛО:
const expectedAmount =
   order.currency === "EUR"
      ? Number((Number(order.total_amount) * rate).toFixed(2))
      : Number(Number(order.total_amount).toFixed(2));

// СТАЛО:
const expectedAmount = Number(Number(order.total_amount).toFixed(2));
```

### Минимальный дифф для PROD/EUR

```diff
--- a/backend/src/index.js
+++ b/backend/src/index.js
@@ -349,7 +349,7 @@ app.post("/orders", upload, async (req, res, next) => {
       // Конвертировать цены в UAH и привести суммы к toFixed(2)
-      const rate = Number(process.env.EUR2UAH || 40);
+      // const rate = Number(process.env.EUR2UAH || 40); // Удалено для PROD

       let productNames, productCounts, productPricesUAH, amountInUAH;
@@ -357,15 +357,15 @@ app.post("/orders", upload, async (req, res, next) => {
       if (isNewFormat) {
          productNames = itemsParsed.map((i) => i.name);
          productCounts = itemsParsed.map((i) => Number(i.count || 1));
-         const pricesBase = itemsParsed.map((i) => Number(i.price || 0));
-         productPricesUAH = pricesBase.map((p) =>
-            finalCurrency === "EUR" ? p * rate : p
-         );
-         amountInUAH = productPricesUAH.reduce(
+         const pricesBase = itemsParsed.map((i) => Number(i.price || 0));
+         productPricesEUR = pricesBase.map((p) => Number(p).toFixed(2));
+         amountInEUR = productPricesEUR.reduce(
             (s, p, i) => s + p * (productCounts[i] || 1),
             0
          );
       } else {
          productNames = [`CV Order #${id}`];
          productCounts = [1];
-         productPricesUAH = [
-            finalCurrency === "EUR"
-               ? Number(finalAmount) * rate
-               : Number(finalAmount),
-         ];
-         amountInUAH = productPricesUAH[0];
+         productPricesEUR = [Number(finalAmount).toFixed(2)];
+         amountInEUR = productPricesEUR[0];
       }
@@ -375,7 +375,7 @@ app.post("/orders", upload, async (req, res, next) => {
-      const productPrice = productPricesUAH.map((p) => Number(p).toFixed(2));
-      const amountString = Number(amountInUAH).toFixed(2);
+      const productPrice = productPricesEUR;
+      const amountString = Number(amountInEUR).toFixed(2);
@@ -393,7 +393,7 @@ app.post("/orders", upload, async (req, res, next) => {
          orderDate,
-         amount: amountString, // строка "40.00"
-         currency: "UAH",
+         amount: amountString, // строка "1.00"
+         currency: "EUR",
          productName: productNames,
          productCount: productCounts,
          productPrice, // массив строк "x.xx"
@@ -624,7 +624,7 @@ async function wayforpayCallbackHandler(req, res) {
       // 1) Проверяем подпись коллбека
       // Проверка валюты
-      if (body.currency !== "UAH") {
+      if (body.currency !== "EUR") {
          console.warn("Currency mismatch:", body.currency);
          return res.status(400).json({ error: "Currency mismatch" });
       }
@@ -633,7 +633,7 @@ async function wayforpayCallbackHandler(req, res) => {
       // 4) Валидация суммы платежа
-      const rate = Number(process.env.EUR2UAH || 40);
+      // const rate = Number(process.env.EUR2UAH || 40); // Удалено для PROD
       const expectedAmount =
-         order.currency === "EUR"
-            ? Number((Number(order.total_amount) * rate).toFixed(2))
-            : Number(Number(order.total_amount).toFixed(2));
+         Number(Number(order.total_amount).toFixed(2));
```

### Чек-лист боевого теста

-  [ ] Все тесты проходят с EUR
-  [ ] Коллбеки обрабатываются корректно
-  [ ] Подписи валидируются правильно
-  [ ] Страница успеха работает
-  [ ] Telegram уведомления отправляются
-  [ ] **ВАЖНО:** Сделать refund из кабинета WayForPay после тестов
-  [ ] Проверить работу с реальными картами
-  [ ] Убедиться в правильности валютных курсов
-  [ ] Протестировать edge cases (0.01 EUR, большие суммы)

## 🛠️ Устранение неполадок

### Проблема: Коллбек не приходит

**Решение:**

1. Проверьте `WAYFORPAY_SERVICE_URL` в .env
2. Убедитесь, что URL доступен извне
3. Проверьте SSL сертификаты

### Проблема: Неверная подпись

**Решение:**

1. Проверьте `WAYFORPAY_SECRET_KEY`
2. Убедитесь в правильности алгоритма подписи
3. Проверьте формат данных в коллбеке

### Проблема: Статус не обновляется

**Решение:**

1. Проверьте логи на ошибки БД
2. Убедитесь в правильности `orderReference`
3. Проверьте идемпотентность обработки

## 📞 Поддержка

При возникновении проблем:

1. Соберите логи по инструкции выше
2. Проверьте конфигурацию WayForPay
3. Обратитесь к документации WayForPay API
4. Проверьте статус сервисов WayForPay

---

**Последнее обновление:** 29 сентября 2025  
**Версия:** 1.0.0
