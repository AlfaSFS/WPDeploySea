#!/bin/bash

# ===== WayForPay E2E Smoke Test Script =====
# Проверяет полный флоу: создание заказа → WayForPay → коллбек → статус → успех

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

# ===== ПРОВЕРКА ЗАВИСИМОСТЕЙ =====
check_dependencies() {
    log_info "Проверяем зависимости..."
    
    if ! command -v curl &> /dev/null; then
        log_error "curl не найден"
        exit 1
    fi
    
    if ! command -v jq &> /dev/null; then
        log_error "jq не найден. Установите: brew install jq"
        exit 1
    fi
    
    log_success "Все зависимости найдены"
}

# ===== ПРОВЕРКА HEALTH =====
check_health() {
    log_info "Проверяем health endpoint..."
    
    local health_response
    health_response=$(curl -s "${API_BASE}/health" || echo "")
    
    if [[ -z "$health_response" ]]; then
        log_error "Health endpoint недоступен"
        exit 1
    fi
    
    local health_status
    health_status=$(echo "$health_response" | jq -r '.ok // "false"')
    
    if [[ "$health_status" == "true" ]]; then
        log_success "Health endpoint работает"
    else
        log_error "Health endpoint вернул ошибку: $health_response"
        exit 1
    fi
}

# ===== СОЗДАНИЕ ЗАКАЗА =====
create_order() {
    log_info "Создаем тестовый заказ..."
    
    local order_response
    order_response=$(curl -s -X POST "${API_BASE}/orders" \
        -F email="test@example.com" \
        -F total_amount="1.00" \
        -F currency="EUR" \
        -F first_name="Test" \
        -F last_name="User" \
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
    
    # Выводим ключевые поля payment_data
    log_info "Payment data:"
    echo "$order_response" | jq -r '.payment_data | {
        merchantAccount: .merchantAccount,
        orderReference: .orderReference,
        amount: .amount,
        currency: .currency,
        returnUrl: .returnUrl,
        serviceUrl: .serviceUrl
    }'
    
    echo "$order_id"
}

# ===== ПРОВЕРКА СТАТУСА ЗАКАЗА =====
check_order_status() {
    local order_id="$1"
    
    log_info "Проверяем статус заказа: $order_id"
    
    local status_response
    status_response=$(curl -s "${API_BASE}/orders/${order_id}/status" || echo "")
    
    if [[ -z "$status_response" ]]; then
        log_error "Не удалось получить статус заказа"
        return 1
    fi
    
    log_success "Статус заказа:"
    echo "$status_response" | jq '.'
    
    local status
    status=$(echo "$status_response" | jq -r '.status // "unknown"')
    
    echo "$status"
}

# ===== СИМУЛЯЦИЯ УСПЕШНОГО ПЛАТЕЖА =====
simulate_success() {
    local order_id="$1"
    
    log_info "Симулируем успешный платеж для заказа: $order_id"
    
    local success_response
    success_response=$(curl -s -X POST "${API_BASE}/test/payment/success/${order_id}" || echo "")
    
    if [[ -z "$success_response" ]]; then
        log_error "Не удалось симулировать успешный платеж"
        return 1
    fi
    
    log_success "Симуляция успешного платежа:"
    echo "$success_response" | jq '.'
}

# ===== РУЧНАЯ ОТПРАВКА КОЛЛБЕКА =====
manual_callback_replay() {
    local order_id="$1"
    
    log_warning "=== РУЧНАЯ ОТПРАВКА КОЛЛБЕКА ==="
    log_info "Для тестирования коллбека выполните команду:"
    echo ""
    echo "curl -i -X POST ${API_BASE}/payments/wayforpay/callback \\"
    echo "  -H \"Content-Type: application/x-www-form-urlencoded\" \\"
    echo "  --data-raw '<ВСТАВИТЬ_JSON_ИЗ_ЛОГОВ_WFP>'"
    echo ""
    log_info "Найдите в логах backend строку с [WFP] CB IN и скопируйте JSON из неё"
    log_info "Пример команды для просмотра логов:"
    echo "docker compose logs -f backend | grep -A5 -B5 'CB IN'"
    echo ""
}

# ===== ОСНОВНАЯ ЛОГИКА =====
main() {
    log_info "=== WayForPay E2E Smoke Test ==="
    log_info "Base URL: $BASE_URL"
    echo ""
    
    # Проверяем зависимости
    check_dependencies
    echo ""
    
    # Проверяем health
    check_health
    echo ""
    
    # Создаем заказ
    local order_id
    order_id=$(create_order)
    echo ""
    
    # Проверяем начальный статус
    local initial_status
    initial_status=$(check_order_status "$order_id")
    echo ""
    
    if [[ "$initial_status" != "pending" ]]; then
        log_warning "Ожидался статус 'pending', получен: $initial_status"
    fi
    
    # Симулируем успешный платеж
    simulate_success "$order_id"
    echo ""
    
    # Проверяем финальный статус
    local final_status
    final_status=$(check_order_status "$order_id")
    echo ""
    
    if [[ "$final_status" == "paid" ]]; then
        log_success "✅ Тест прошел успешно! Заказ оплачен"
    else
        log_warning "⚠️  Статус заказа: $final_status (ожидался 'paid')"
    fi
    
    # Показываем инструкции для ручного тестирования коллбека
    manual_callback_replay "$order_id"
    
    log_info "=== РЕЗУЛЬТАТЫ ТЕСТА ==="
    echo "Order ID: $order_id"
    echo "Initial Status: $initial_status"
    echo "Final Status: $final_status"
    echo ""
    
    if [[ "$final_status" == "paid" ]]; then
        log_success "🎉 Все тесты прошли успешно!"
        exit 0
    else
        log_error "❌ Тесты завершились с ошибками"
        exit 1
    fi
}

# ===== ЗАПУСК =====
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    main "$@"
fi
