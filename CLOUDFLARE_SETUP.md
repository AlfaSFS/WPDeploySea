# Cloudflare Setup для WayForPay Callback

## Проблема

Cloudflare возвращает ошибку 521 для callback URL, что блокирует получение
уведомлений от WayForPay.

## Решение

### 1. Firewall Rules

Перейти в Cloudflare Dashboard → Security → WAF → Custom rules

**Создать правило:**

```
(http.host eq "seafarer-cv.com" and starts_with(http.request.uri.path, "/api/payments/callback"))
```

**Настройки:**

-  **Action**: Skip
-  **Skip**: Managed WAF, Bot Fight, Security Level
-  **Priority**: 1

### 2. Cache Rules

Перейти в Cloudflare Dashboard → Caching → Configuration

**Создать правило:**

```
(http.host eq "seafarer-cv.com" and starts_with(http.request.uri.path, "/api/"))
```

**Настройки:**

-  **Cache Level**: Bypass
-  **Edge TTL**: Respect Existing Headers
-  **Browser TTL**: Respect Existing Headers

### 3. Page Rules (Альтернатива)

Если Custom Rules недоступны, использовать Page Rules:

**URL Pattern:**

```
seafarer-cv.com/api/payments/callback*
```

**Настройки:**

-  Cache Level: Bypass
-  Security Level: Essentially Off
-  Disable Apps: On

## Проверка

После настройки проверить:

```bash
# Тест callback через домен
curl -X POST https://seafarer-cv.com/api/payments/callback \
  -H "Content-Type: application/json" \
  -d '{"test": "data"}'

# Ожидаемый результат: не 521 ошибка
```

## Альтернативное решение

Если Cloudflare настройки не помогают, можно:

1. **Использовать поддомен** для API (api.seafarer-cv.com)
2. **Настроить DNS** без Cloudflare для callback
3. **Использовать IP** напрямую для callback URL

## Текущий статус

-  ❌ Cloudflare блокирует callback
-  ✅ Callback работает через IP: http://91.107.204.141/api/payments/callback
-  ⚠️ Нужна настройка Cloudflare или альтернативное решение
