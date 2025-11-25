#!/bin/bash

# ===== WayForPay Retry Button Test =====
# Проверяет функциональность кнопки "Спробувати ще раз" на странице /payment-success

set -euo pipefail

# ===== КОНФИГУРАЦИЯ =====
BASE_URL="https://seafarer-cv.com"
API_BASE="${BASE_URL}/api"

# ===== ЦВЕТА ДЛЯ ВЫВОДА =====
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# ===== ФУНКЦИИ =====
log_info() {
    echo -e "${BLUE}ℹ️  $1${NC}"
}

log_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

log_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

log_error() {
    echo -e "${RED}❌ $1${NC}"
}

# ===== СОЗДАНИЕ НЕУСПЕШНОГО ЗАКАЗА =====
create_failed_order() {
    log_info "Создаем заказ для тестирования неуспешного платежа..."
    
    local order_response
    order_response=$(curl -s -X POST "${API_BASE}/orders" \
        -F email="retry-test@example.com" \
        -F total_amount="1.00" \
        -F currency="EUR" \
        -F first_name="Retry" \
        -F last_name="Test" \
        -F phone="+380123456789" || echo "")
    
    if [[ -z "$order_response" ]]; then
        log_error "Не удалось создать заказ"
        exit 1
    fi
    
    local order_id
    order_id=$(echo "$order_response" | jq -r '.id // empty')
    
    if [[ -z "$order_id" ]]; then
        log_error "Не удалось получить order_id из ответа: $order_response"
        exit 1
    fi
    
    log_success "Заказ создан: $order_id"
    echo "$order_id"
}

# ===== СИМУЛЯЦИЯ НЕУСПЕШНОГО ПЛАТЕЖА =====
simulate_failed_payment() {
    local order_id="$1"
    
    log_info "Симулируем неуспешный платеж для заказа: $order_id"
    
    # Создаем фиктивный коллбек с declined статусом
    local callback_data='{
        "merchantAccount": "test_merch_n1",
        "orderReference": "'$order_id'",
        "amount": "40.00",
        "currency": "UAH",
        "authCode": "123456",
        "cardPan": "4111111111111111",
        "transactionStatus": "Declined",
        "reasonCode": "1005",
        "merchantSignature": "fake_signature_for_test"
    }'
    
    # Отправляем коллбек (он должен провалиться из-за неверной подписи, но заказ останется pending)
    local callback_response
    callback_response=$(curl -s -X POST "${API_BASE}/payments/wayforpay/callback" \
        -H "Content-Type: application/x-www-form-urlencoded" \
        --data-raw "$callback_data" || echo "")
    
    log_info "Коллбек отправлен (ожидается ошибка подписи)"
    
    # Вручную обновляем статус на failed для тестирования
    # Это симуляция того, что произойдет при реальном declined платеже
    log_warning "ВНИМАНИЕ: В реальном сценарии статус обновится автоматически через коллбек"
    log_info "Для тестирования кнопки повтора нужно вручную обновить статус в БД"
    
    echo "$order_id"
}

# ===== ПРОВЕРКА СТРАНИЦЫ УСПЕХА =====
check_payment_success_page() {
    local order_id="$1"
    
    log_info "Проверяем страницу /payment-success для заказа: $order_id"
    
    local page_url="${BASE_URL}/payment-success?order=${order_id}"
    log_info "URL страницы: $page_url"
    
    # Проверяем доступность страницы
    local page_response
    page_response=$(curl -s -I "$page_url" || echo "")
    
    if [[ -z "$page_response" ]]; then
        log_error "Страница /payment-success недоступна"
        return 1
    fi
    
    local http_status
    http_status=$(echo "$page_response" | head -1 | grep -o '[0-9]\{3\}' || echo "unknown")
    
    if [[ "$http_status" == "200" ]]; then
        log_success "Страница /payment-success доступна (HTTP $http_status)"
    else
        log_warning "Страница /payment-success вернула статус: $http_status"
    fi
    
    # Получаем содержимое страницы
    local page_content
    page_content=$(curl -s "$page_url" || echo "")
    
    if [[ -z "$page_content" ]]; then
        log_error "Не удалось получить содержимое страницы"
        return 1
    fi
    
    # Проверяем наличие элементов страницы
    if echo "$page_content" | grep -q "Спробувати ще раз"; then
        log_success "✅ Кнопка 'Спробувати ще раз' найдена на странице"
    else
        log_warning "⚠️  Кнопка 'Спробувати ще раз' не найдена на странице"
    fi
    
    if echo "$page_content" | grep -q "❌\|error\|помилка\|неуспішн"; then
        log_success "✅ Индикатор ошибки найден на странице"
    else
        log_warning "⚠️  Индикатор ошибки не найден на странице"
    fi
    
    # Проверяем наличие JavaScript для обработки кнопки
    if echo "$page_content" | grep -q "retry\|повторити\|спробувати"; then
        log_success "✅ JavaScript для обработки повтора найден"
    else
        log_warning "⚠️  JavaScript для обработки повтора не найден"
    fi
}

# ===== ОСНОВНАЯ ЛОГИКА =====
main() {
    log_info "=== WayForPay Retry Button Test ==="
    log_info "Проверяем функциональность кнопки 'Спробувати ще раз'"
    echo ""
    
    # Создаем заказ
    local order_id
    order_id=$(create_failed_order)
    echo ""
    
    # Симулируем неуспешный платеж
    simulate_failed_payment "$order_id"
    echo ""
    
    # Проверяем страницу успеха
    check_payment_success_page "$order_id"
    echo ""
    
    log_info "=== РЕЗУЛЬТАТЫ ТЕСТА ==="
    echo "Order ID: $order_id"
    echo "Payment Success URL: ${BASE_URL}/payment-success?order=${order_id}"
    echo ""
    
    log_info "=== РУЧНАЯ ПРОВЕРКА ==="
    echo "1. Откройте в браузере: ${BASE_URL}/payment-success?order=${order_id}"
    echo "2. Убедитесь, что отображается ❌ и кнопка 'Спробувати ще раз'"
    echo "3. Нажмите кнопку и проверьте, что создается новый заказ"
    echo "4. Проверьте, что происходит редирект на WayForPay"
    echo ""
    
    log_success "🎉 Тест завершен! Проверьте страницу вручную."
}

# ===== ЗАПУСК =====
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    main "$@"
fi
