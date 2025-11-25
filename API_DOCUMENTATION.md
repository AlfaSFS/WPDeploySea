# API Документация - WayForPay Integration

## Обзор

API для создания заказов с интеграцией WayForPay. Поддерживает два формата:
новый с `items` и старый для обратной совместимости.

## Базовый URL

-  **Production**: `https://seafarer-cv.com/api`
-  **Development**: `http://91.107.204.141/api`

## Эндпоинты

### 1. Создание заказа

**POST** `/orders`

#### Новый формат (рекомендуемый)

```json
{
   "email": "test@example.com",
   "amount": 150,
   "currency": "UAH",
   "items": [
      {
         "name": "CV Writing Service",
         "price": 80,
         "count": 1
      },
      {
         "name": "CV Translation",
         "price": 40,
         "count": 1
      },
      {
         "name": "Email Distribution",
         "price": 30,
         "count": 1
      }
   ],
   "first_name": "Имя",
   "last_name": "Фамилия",
   "phone": "+380501234567"
}
```

#### Старый формат (совместимость)

```json
{
   "email": "test@example.com",
   "total_amount": 100,
   "currency": "UAH",
   "name": "Имя",
   "surname": "Фамилия",
   "phone": "+380501234567"
}
```

#### Ответ

```json
{
   "id": "uuid-order-id",
   "status": "pending",
   "cv_filename": null,
   "message": "Order created successfully",
   "payment_url": "https://secure.wayforpay.com/pay",
   "payment_data": {
      "merchantAccount": "test_merch_n1",
      "merchantDomainName": "seafarer-cv.com",
      "merchantTransactionType": "AUTO",
      "merchantTransactionSecureType": "AUTO",
      "orderReference": "uuid-order-id",
      "orderDate": 1757183444,
      "amount": 150,
      "currency": "UAH",
      "productName": [
         "CV Writing Service",
         "CV Translation",
         "Email Distribution"
      ],
      "productCount": [1, 1, 1],
      "productPrice": [80, 40, 30],
      "clientFirstName": "Имя",
      "clientLastName": "Фамилия",
      "clientEmail": "test@example.com",
      "clientPhone": "+380501234567",
      "returnUrl": "https://seafarer-cv.com/payment-success",
      "serviceUrl": "https://seafarer-cv.com/api/payments/callback",
      "merchantSignature": "generated-signature"
   }
}
```

### 2. Проверка статуса заказа

**GET** `/orders/{id}/status`

#### Ответ

```json
{
   "id": "uuid-order-id",
   "status": "pending|paid|failed",
   "total_amount": 150,
   "currency": "UAH"
}
```

### 3. WayForPay Callback

**POST** `/payments/callback`

> ⚠️ Этот эндпоинт используется WayForPay для уведомлений о статусе платежа.

## Тестовые данные

### WayForPay Test Cards

| Номер карты        | Описание              |
| ------------------ | --------------------- |
| `4444555566667779` | Успешная оплата       |
| `4444555566668888` | Недостаточно средств  |
| `4444555566669999` | Заблокированная карта |

### Тестовые реквизиты

-  **Merchant Account**: `test_merch_n1`
-  **Secret Key**: `flk3409refn54t54t*FNJRET`
-  **Domain**: `seafarer-cv.com`

## Примеры использования

### JavaScript (Frontend)

```javascript
// Новый формат с items
async function createOrderWithItems() {
   const response = await fetch("/api/orders", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
         email: "customer@example.com",
         amount: 150,
         currency: "UAH",
         items: [
            { name: "CV Writing", price: 80, count: 1 },
            { name: "Translation", price: 40, count: 1 },
            { name: "Distribution", price: 30, count: 1 },
         ],
         first_name: "Имя",
         last_name: "Фамилия",
         phone: "+380501234567",
      }),
   });

   const order = await response.json();

   if (order.payment_url) {
      // Перенаправляем на WayForPay
      window.location.href = order.payment_url;
   }
}

// Старый формат (совместимость)
async function createOrderOldFormat() {
   const response = await fetch("/api/orders", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
         email: "customer@example.com",
         total_amount: 100,
         currency: "UAH",
         name: "Имя",
         surname: "Фамилия",
         phone: "+380501234567",
      }),
   });

   const order = await response.json();

   if (order.payment_url) {
      window.location.href = order.payment_url;
   }
}
```

### cURL

```bash
# Новый формат
curl -X POST https://seafarer-cv.com/api/orders \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@example.com",
    "amount": 150,
    "currency": "UAH",
    "items": [
      {"name": "CV Writing", "price": 80, "count": 1},
      {"name": "Translation", "price": 40, "count": 1},
      {"name": "Distribution", "price": 30, "count": 1}
    ],
    "first_name": "Имя",
    "last_name": "Фамилия",
    "phone": "+380501234567"
  }'

# Старый формат
curl -X POST https://seafarer-cv.com/api/orders \
  -H "Content-Type: application/json" \
  -d '{
    "email": "test@example.com",
    "total_amount": 100,
    "currency": "UAH",
    "name": "Имя",
    "surname": "Фамилия",
    "phone": "+380501234567"
  }'
```

## Коды ошибок

| Код | Описание                   |
| --- | -------------------------- |
| 400 | Неверные параметры запроса |
| 404 | Заказ не найден            |
| 500 | Внутренняя ошибка сервера  |

## Статусы заказов

| Статус    | Описание       |
| --------- | -------------- |
| `pending` | Ожидает оплаты |
| `paid`    | Оплачен        |
| `failed`  | Ошибка оплаты  |

## Безопасность

-  Все запросы должны содержать `Content-Type: application/json`
-  Callback от WayForPay проверяется по подписи HMAC-MD5
-  CORS настроен для домена `seafarer-cv.com`

## Мониторинг

Логи callback доступны в контейнере backend:

```bash
docker-compose logs -f backend
```

## Поддержка

При возникновении проблем:

1. Проверьте логи backend
2. Убедитесь в правильности тестовых реквизитов
3. Проверьте настройки Cloudflare (см. CLOUDFLARE_SETUP.md)
