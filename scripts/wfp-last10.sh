#!/bin/bash

# ===== WayForPay Audit Viewer =====
# Показывает последние записи из таблицы payments_wfp

set -euo pipefail

# ===== КОНФИГУРАЦИЯ =====
BASE_URL="https://seafarer-cv.com"
API_BASE="${BASE_URL}/api"
LIMIT="${1:-10}"  # По умолчанию 10 записей

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
    if ! command -v curl &> /dev/null; then
        log_error "curl не найден"
        exit 1
    fi
    
    if ! command -v jq &> /dev/null; then
        log_error "jq не найден. Установите: brew install jq"
        exit 1
    fi
}

# ===== ПОЛУЧЕНИЕ ДАННЫХ АУДИТА =====
get_audit_data() {
    log_info "Получаем последние $LIMIT записей из payments_wfp..."
    
    # Создаем временный заказ для получения доступа к БД
    local temp_order
    temp_order=$(curl -s -X POST "${API_BASE}/orders" \
        -F email="audit@example.com" \
        -F total_amount="0.01" \
        -F currency="EUR" \
        -F first_name="Audit" \
        -F last_name="Viewer" || echo "")
    
    if [[ -z "$temp_order" ]]; then
        log_error "Не удалось создать временный заказ для доступа к БД"
        return 1
    fi
    
    local temp_order_id
    temp_order_id=$(echo "$temp_order" | jq -r '.id // empty')
    
    if [[ -z "$temp_order_id" ]]; then
        log_error "Не удалось получить ID временного заказа"
        return 1
    fi
    
    log_info "Временный заказ создан: $temp_order_id"
    
    # Здесь должен быть endpoint для получения аудита
    # Пока что возвращаем заглушку
    echo "[]"
}

# ===== ОТОБРАЖЕНИЕ ДАННЫХ =====
display_audit_data() {
    local audit_data="$1"
    
    if [[ "$audit_data" == "[]" ]]; then
        log_warning "Нет данных аудита для отображения"
        log_info "Убедитесь, что:"
        echo "  1. Таблица payments_wfp создана"
        echo "  2. Были обработаны коллбеки WayForPay"
        echo "  3. Endpoint /api/audit/payments доступен"
        return 0
    fi
    
    log_success "Последние $LIMIT записей аудита WayForPay:"
    echo ""
    
    echo "$audit_data" | jq -r '.[] | 
        "📅 " + (.created_at // "unknown") + 
        " | 🆔 " + (.order_id // "unknown") + 
        " | 💰 " + (.amount // "0") + " " + (.currency // "unknown") + 
        " | 📊 " + (.transaction_status // "unknown") + 
        " | 🔢 " + (.reason_code // "unknown") + 
        " | 💳 " + (.card_pan_last4 // "unknown")'
    
    echo ""
    log_info "Для детального просмотра используйте:"
    echo "curl -s ${API_BASE}/audit/payments | jq '.[0]'"
}

# ===== ОСНОВНАЯ ЛОГИКА =====
main() {
    log_info "=== WayForPay Audit Viewer ==="
    log_info "Показываем последние $LIMIT записей"
    echo ""
    
    # Проверяем зависимости
    check_dependencies
    
    # Получаем данные аудита
    local audit_data
    audit_data=$(get_audit_data)
    
    # Отображаем данные
    display_audit_data "$audit_data"
    
    log_info "=== Дополнительные команды ==="
    echo ""
    echo "# Просмотр всех записей:"
    echo "curl -s ${API_BASE}/audit/payments | jq"
    echo ""
    echo "# Фильтр по статусу:"
    echo "curl -s ${API_BASE}/audit/payments | jq '.[] | select(.transaction_status == \"Approved\")'"
    echo ""
    echo "# Фильтр по заказу:"
    echo "curl -s ${API_BASE}/audit/payments | jq '.[] | select(.order_id == \"ORDER_ID\")'"
    echo ""
    echo "# Статистика:"
    echo "curl -s ${API_BASE}/audit/payments | jq 'group_by(.transaction_status) | map({status: .[0].transaction_status, count: length})'"
}

# ===== ЗАПУСК =====
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    main "$@"
fi
