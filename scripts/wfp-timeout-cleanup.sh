#!/bin/bash

# ===== Pending Timeout Cleanup Script =====
# Переводит старые pending заказы в failed (timeout)

set -euo pipefail

# ===== КОНФИГУРАЦИЯ =====
TIMEOUT_MINUTES="${1:-60}"  # По умолчанию 60 минут
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

# ===== ОСНОВНАЯ ЛОГИКА =====
main() {
    log_info "=== Pending Timeout Cleanup ==="
    log_info "Timeout: $TIMEOUT_MINUTES minutes"
    echo ""
    
    # Создаем временный заказ для доступа к БД
    local temp_order
    temp_order=$(curl -s -X POST "${API_BASE}/orders" \
        -F email="timeout-cleanup@example.com" \
        -F total_amount="0.01" \
        -F currency="EUR" \
        -F first_name="Timeout" \
        -F last_name="Cleanup" || echo "")
    
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
    
    # Здесь должен быть endpoint для очистки timeout заказов
    # Пока что возвращаем заглушку
    log_info "Поиск заказов старше $TIMEOUT_MINUTES минут..."
    log_warning "Endpoint /api/orders/timeout-cleanup не реализован"
    log_info "Рекомендуется добавить в backend/src/index.js:"
    echo ""
    echo "app.post('/orders/timeout-cleanup', async (req, res) => {"
    echo "  const timeoutMinutes = Number(req.body.timeout || 60);"
    echo "  const cutoffTime = new Date(Date.now() - timeoutMinutes * 60 * 1000);"
    echo "  "
    echo "  const [result] = await getPool().query("
    echo "    'UPDATE orders SET status = \"failed\" WHERE status = \"pending\" AND created_at < ?',"
    echo "    [cutoffTime]"
    echo "  );"
    echo "  "
    echo "  res.json({"
    echo "    success: true,"
    echo "    timeoutMinutes,"
    echo "    cutoffTime: cutoffTime.toISOString(),"
    echo "    updatedOrders: result.affectedRows"
    echo "  });"
    echo "});"
    echo ""
    
    log_success "Скрипт завершен (заглушка)"
}

# ===== ЗАПУСК =====
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    main "$@"
fi
