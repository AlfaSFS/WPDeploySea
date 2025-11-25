#!/bin/bash

# ===== SSL Certificates Sync Script =====
# Синхронизирует SSL сертификаты между локальной и VPS конфигурацией

set -euo pipefail

# ===== КОНФИГУРАЦИЯ =====
VPS_HOST="91.107.204.141"
VPS_USER="root"
VPS_PORT="22"
PROJECT_DIR="/var/www/cv-project"

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

# ===== ПРОВЕРКА ЛОКАЛЬНЫХ ФАЙЛОВ =====
log_info "Проверяем локальные SSL сертификаты..."

if [ ! -f "ssl-configs/cloudflare_cert.pem" ]; then
    log_error "Файл ssl-configs/cloudflare_cert.pem не найден!"
    exit 1
fi

if [ ! -f "ssl-configs/cloudflare_private_key.pem" ]; then
    log_error "Файл ssl-configs/cloudflare_private_key.pem не найден!"
    exit 1
fi

log_success "Локальные SSL сертификаты найдены"

# ===== СОЗДАНИЕ ЛОКАЛЬНОЙ SSL ДИРЕКТОРИИ =====
log_info "Создаем локальную ssl директорию..."

mkdir -p ssl

# Копируем сертификаты в локальную ssl директорию
cp ssl-configs/cloudflare_cert.pem ssl/cloudflare_cert.pem
cp ssl-configs/cloudflare_private_key.pem ssl/cloudflare_private_key.pem

log_success "Локальная ssl директория создана"

# ===== СИНХРОНИЗАЦИЯ С VPS =====
log_info "Синхронизируем SSL сертификаты с VPS..."

# Создаем директорию ssl на VPS
ssh -p $VPS_PORT $VPS_USER@$VPS_HOST "mkdir -p $PROJECT_DIR/ssl"

# Копируем SSL сертификаты на VPS
scp -P $VPS_PORT ssl/cloudflare_cert.pem $VPS_USER@$VPS_HOST:$PROJECT_DIR/ssl/
scp -P $VPS_PORT ssl/cloudflare_private_key.pem $VPS_USER@$VPS_HOST:$PROJECT_DIR/ssl/

log_success "SSL сертификаты синхронизированы с VPS"

# ===== ПРОВЕРКА СИНХРОНИЗАЦИИ =====
log_info "Проверяем синхронизацию..."

# Проверяем, что файлы существуют на VPS
if ssh -p $VPS_PORT $VPS_USER@$VPS_HOST "test -f $PROJECT_DIR/ssl/cloudflare_cert.pem && test -f $PROJECT_DIR/ssl/cloudflare_private_key.pem"; then
    log_success "SSL сертификаты успешно синхронизированы"
else
    log_error "Ошибка синхронизации SSL сертификатов"
    exit 1
fi

# ===== ФИНАЛЬНАЯ ИНФОРМАЦИЯ =====
log_success "Синхронизация SSL сертификатов завершена!"
echo ""
echo "=== Информация ==="
echo "📁 Локальная директория: ./ssl/"
echo "🌐 VPS директория: $PROJECT_DIR/ssl/"
echo "🔐 Сертификаты: cloudflare_cert.pem, cloudflare_private_key.pem"
echo ""
echo "=== Следующие шаги ==="
echo "1. Перезапустите nginx на VPS:"
echo "   ssh $VPS_USER@$VPS_HOST"
echo "   cd $PROJECT_DIR"
echo "   docker-compose restart nginx"
echo ""
echo "2. Или используйте полный деплой:"
echo "   ./scripts/vps_deploy_rsync.sh"
