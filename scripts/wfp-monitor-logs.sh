#!/bin/bash

# ===== WayForPay Logs Monitor =====
# Мониторинг логов в реальном времени для отслеживания коллбеков

set -euo pipefail

# ===== КОНФИГУРАЦИЯ =====
ORDER_ID="${1:-fb30493c-df21-4e47-927e-8bffa93b9d4f}"

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

# ===== МОНИТОРИНГ BACKEND =====
monitor_backend() {
    log_info "Мониторинг backend логов для заказа: $ORDER_ID"
    log_info "Ожидаем события: [WFP] CB IN, signature OK/FAIL, ACK"
    echo ""
    
    # Запускаем мониторинг в фоне
    (
        cd /Users/alexey.nikolayenko/Desktop/Experiments/mail-sender/CV-project
        ./vps_commands.sh "cd /var/www/cv-project && docker compose logs -f --tail=0 backend" | \
        grep --line-buffered -E "\[WFP\]|WayForPay|CB IN|signature|ACK|$ORDER_ID" | \
        while read line; do
            echo -e "${GREEN}[$(date '+%H:%M:%S')]${NC} $line"
        done
    ) &
    
    BACKEND_PID=$!
    echo "Backend monitor PID: $BACKEND_PID"
}

# ===== МОНИТОРИНГ NGINX =====
monitor_nginx() {
    log_info "Мониторинг nginx логов для коллбеков WayForPay"
    log_info "Ожидаем: POST /api/payments/wayforpay/callback"
    echo ""
    
    # Запускаем мониторинг в фоне
    (
        cd /Users/alexey.nikolayenko/Desktop/Experiments/mail-sender/CV-project
        ./vps_commands.sh "cd /var/www/cv-project && docker compose exec nginx sh -c 'tail -f /var/log/nginx/access.log'" | \
        grep --line-buffered "wayforpay/callback" | \
        while read line; do
            echo -e "${YELLOW}[$(date '+%H:%M:%S')]${NC} $line"
        done
    ) &
    
    NGINX_PID=$!
    echo "Nginx monitor PID: $NGINX_PID"
}

# ===== ПРОВЕРКА СТАТУСА =====
check_status() {
    log_info "Проверка статуса заказа: $ORDER_ID"
    
    local status_response
    status_response=$(curl -s "https://seafarer-cv.com/api/orders/$ORDER_ID/status" || echo "")
    
    if [[ -z "$status_response" ]]; then
        log_error "Не удалось получить статус заказа"
        return 1
    fi
    
    local status
    status=$(echo "$status_response" | jq -r '.status // "unknown"')
    local is_paid
    is_paid=$(echo "$status_response" | jq -r '.is_paid // false')
    
    echo -e "${BLUE}Статус:${NC} $status"
    echo -e "${BLUE}Оплачен:${NC} $is_paid"
    echo ""
    
    if [[ "$status" == "failed" ]]; then
        log_success "🎉 Declined тест прошел успешно!"
        return 0
    elif [[ "$status" == "paid" ]]; then
        log_warning "⚠️  Заказ оплачен (неожиданно)"
        return 1
    else
        log_info "⏳ Заказ в статусе: $status (ожидаем failed)"
        return 1
    fi
}

# ===== ОСНОВНАЯ ЛОГИКА =====
main() {
    log_info "=== WayForPay Logs Monitor ==="
    log_info "Order ID: $ORDER_ID"
    log_info "Нажмите Ctrl+C для остановки"
    echo ""
    
    # Запускаем мониторинг
    monitor_backend
    monitor_nginx
    
    echo ""
    log_info "Мониторинг запущен. Выполните платеж с тест-картой 4111 1111 1111 1111"
    echo ""
    
    # Периодическая проверка статуса
    while true; do
        sleep 10
        echo -e "${BLUE}[$(date '+%H:%M:%S')]${NC} Проверка статуса..."
        if check_status; then
            break
        fi
    done
    
    # Останавливаем мониторинг
    log_info "Останавливаем мониторинг..."
    kill $BACKEND_PID $NGINX_PID 2>/dev/null || true
    
    log_success "Мониторинг завершен!"
}

# ===== ОБРАБОТКА СИГНАЛОВ =====
cleanup() {
    log_info "Получен сигнал завершения..."
    kill $BACKEND_PID $NGINX_PID 2>/dev/null || true
    exit 0
}

trap cleanup SIGINT SIGTERM

# ===== ЗАПУСК =====
if [[ "${BASH_SOURCE[0]}" == "${0}" ]]; then
    main "$@"
fi
