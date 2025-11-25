# 🎯 WayForPay Real Declined E2E Test - РУЧНОЕ ВЫПОЛНЕНИЕ

## 📋 Заказ для тестирования

-  **Order ID:** `e25f2d7c-d504-45a6-925a-8289bd59b6e5`
-  **Email:** real-declined-test@example.com
-  **Amount:** 1.00 EUR (40.00 UAH)
-  **Status:** pending

## 🚀 ПОШАГОВЫЕ ИНСТРУКЦИИ

### Шаг 1: Запустите мониторинг логов

```bash
cd /Users/alexey.nikolayenko/Desktop/Experiments/mail-sender/CV-project
./scripts/wfp-monitor-logs.sh e25f2d7c-d504-45a6-925a-8289bd59b6e5
```

### Шаг 2: Откройте hosted checkout

Перейдите по ссылке: **https://secure.wayforpay.com/pay**

Или используйте данные из payment_data:

-  **merchantAccount:** test_merch_n1
-  **orderReference:** e25f2d7c-d504-45a6-925a-8289bd59b6e5
-  **amount:** 40.00
-  **currency:** UAH

### Шаг 3: Выполните платеж с тест-картой

**Карта:** `4111 1111 1111 1111`  
**Срок:** любой (например, 12/25)  
**CVV:** любой (например, 123)

### Шаг 4: Ожидаемые результаты

**В nginx логах:**

```
POST /api/payments/wayforpay/callback HTTP/2.0" 200
```

**В backend логах:**

```
[WFP] CB IN { ct: 'application/x-www-form-urlencoded', orderReference: 'e25f2d7c-d504-45a6-925a-8289bd59b6e5', transactionStatus: 'Declined', amount: '40.00', currency: 'UAH', reasonCode: '1005' }
[WFP] signature OK <e25f2d7c-d504-45a6-925a-8289bd59b6e5>
[WFP] ACK <e25f2d7c-d504-45a6-925a-8289bd59b6e5> declined
```

**Статус заказа:**

```json
{
   "id": "e25f2d7c-d504-45a6-925a-8289bd59b6e5",
   "status": "failed",
   "total_amount": 1,
   "currency": "EUR",
   "is_paid": false
}
```

**Страница /payment-success:**

-  ❌ Красный крестик
-  "Оплата не пройшла"
-  "❌ Платіж відхилено. Ви можете спробувати ще раз."
-  Кнопка "Спробувати ще раз"

## 📊 Проверка результатов

### Проверка статуса заказа

```bash
curl -s https://seafarer-cv.com/api/orders/e25f2d7c-d504-45a6-925a-8289bd59b6e5/status | jq
```

### Проверка страницы

Откройте:
https://seafarer-cv.com/payment-success?order=e25f2d7c-d504-45a6-925a-8289bd59b6e5

## 🎯 Критерии успеха

-  [ ] Коллбек WayForPay приходит и обрабатывается
-  [ ] Статус заказа меняется на `failed`
-  [ ] Страница /payment-success показывает ошибку
-  [ ] Кнопка "Спробувати ще раз" работает
-  [ ] Логи содержат [WFP] якоря
-  [ ] Nginx логируют POST /api/payments/wayforpay/callback 200

---

**Время начала:** $(date)  
**Order ID:** e25f2d7c-d504-45a6-925a-8289bd59b6e5  
**Статус:** Готов к выполнению
