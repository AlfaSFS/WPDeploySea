#!/bin/bash

# ===== VPS Deploy Script (Rsync) =====
# Деплоит проект на VPS через rsync

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
log_info "Проверяем локальные файлы..."

if [ ! -f "docker-compose.yml" ]; then
    log_error "Файл docker-compose.yml не найден!"
    log_info "Убедитесь, что вы находитесь в корневой директории проекта"
    exit 1
fi

if [ ! -f "env.production.example" ]; then
    log_error "Файл env.production.example не найден!"
    exit 1
fi

log_success "Локальные файлы найдены"

# ===== СИНХРОНИЗАЦИЯ ФАЙЛОВ =====
log_info "Синхронизируем файлы на VPS..."

# Создаем директорию на VPS если не существует
ssh -p $VPS_PORT $VPS_USER@$VPS_HOST "mkdir -p $PROJECT_DIR"

# Синхронизируем файлы (исключаем ненужные)
rsync -avz --delete \
    --exclude='.git/' \
    --exclude='node_modules/' \
    --exclude='backend/node_modules/' \
    --exclude='backend/uploads/' \
    --exclude='.env' \
    --exclude='*.log' \
    --exclude='.DS_Store' \
    --exclude='verstka/' \
    -e "ssh -p $VPS_PORT" \
    ./ $VPS_USER@$VPS_HOST:$PROJECT_DIR/

log_success "Файлы синхронизированы"

# ===== НАСТРОЙКА .ENV =====
log_info "Настраиваем переменные окружения..."

ssh -p $VPS_PORT $VPS_USER@$VPS_HOST "cd $PROJECT_DIR && cp env.production.example .env"

log_success "Файл .env создан из env.production.example"

# ===== НАСТРОЙКА SSL СЕРТИФИКАТОВ =====
log_info "Настраиваем SSL сертификаты..."

# Создаем локальную ssl директорию если не существует
mkdir -p ssl

# Копируем сертификаты в локальную ssl директорию (всегда обновляем)
if [ -f "ssl-configs/cloudflare_cert.pem" ] && [ -f "ssl-configs/cloudflare_private_key.pem" ]; then
    cp ssl-configs/cloudflare_cert.pem ssl/cloudflare_cert.pem
    cp ssl-configs/cloudflare_private_key.pem ssl/cloudflare_private_key.pem
    log_success "Локальные SSL сертификаты обновлены из ssl-configs/"
else
    log_warning "SSL сертификаты не найдены в ssl-configs/, используем существующие локальные"
fi

# Создаем директорию ssl на VPS
ssh -p $VPS_PORT $VPS_USER@$VPS_HOST "mkdir -p $PROJECT_DIR/ssl"

# Копируем SSL сертификаты на VPS (всегда обновляем)
if [ -f "ssl/cloudflare_cert.pem" ] && [ -f "ssl/cloudflare_private_key.pem" ]; then
    log_info "Копируем SSL сертификаты на VPS..."
    scp -P $VPS_PORT ssl/cloudflare_cert.pem $VPS_USER@$VPS_HOST:$PROJECT_DIR/ssl/
    scp -P $VPS_PORT ssl/cloudflare_private_key.pem $VPS_USER@$VPS_HOST:$PROJECT_DIR/ssl/
    log_success "SSL сертификаты успешно скопированы на VPS"
else
    log_warning "Локальные SSL сертификаты не найдены, пропускаем копирование на VPS"
fi

# ===== ОСТАНОВКА СТАРЫХ КОНТЕЙНЕРОВ =====
log_info "Останавливаем старые контейнеры..."

ssh -p $VPS_PORT $VPS_USER@$VPS_HOST "cd $PROJECT_DIR && docker-compose down || true"

log_success "Старые контейнеры остановлены"

# ===== ЗАПУСК ПРОЕКТА =====
log_info "Запускаем проект..."

ssh -p $VPS_PORT $VPS_USER@$VPS_HOST "cd $PROJECT_DIR && docker-compose up -d --build"

log_success "Проект запущен!"

# ===== ПРОВЕРКА СТАТУСА =====
log_info "Проверяем статус контейнеров..."

sleep 15

echo "=== Статус контейнеров ==="
ssh -p $VPS_PORT $VPS_USER@$VPS_HOST "cd $PROJECT_DIR && docker-compose ps"

echo ""
echo "=== Логи backend ==="
ssh -p $VPS_PORT $VPS_USER@$VPS_HOST "cd $PROJECT_DIR && docker-compose logs --tail=10 backend"

echo ""
echo "=== Логи nginx ==="
ssh -p $VPS_PORT $VPS_USER@$VPS_HOST "cd $PROJECT_DIR && docker-compose logs --tail=5 nginx"

# ===== ПРОВЕРКА ЗДОРОВЬЯ =====
log_info "Проверяем здоровье сервисов..."

# Проверяем WordPress
if ssh -p $VPS_PORT $VPS_USER@$VPS_HOST "curl -s http://localhost/wp-json/ | grep -q 'name'"; then
    log_success "WordPress API работает"
else
    log_warning "WordPress API не отвечает"
fi

# Проверяем Backend API
if ssh -p $VPS_PORT $VPS_USER@$VPS_HOST "curl -s http://localhost/api/health | grep -q 'ok'"; then
    log_success "Backend API работает"
else
    log_warning "Backend API не отвечает"
fi

# ===== ФИНАЛЬНАЯ ИНФОРМАЦИЯ =====
log_success "Деплой завершен!"
echo ""
echo "=== Информация о деплое ==="
echo "🌐 Сайт: http://$VPS_HOST"
echo "🔑 WordPress админка: http://$VPS_HOST/wp-admin/"
echo "📡 REST API: http://$VPS_HOST/wp-json/"
echo "🔌 Backend API: http://$VPS_HOST/api/"
echo ""
echo "=== Следующие шаги ==="
echo "1. Отредактируйте .env файл на VPS:"
echo "   ssh $VPS_USER@$VPS_HOST"
echo "   cd $PROJECT_DIR"
echo "   nano .env"
echo ""
echo "2. Заполните реальные значения:"
echo "   - Пароли для баз данных"
echo "   - TELEGRAM_BOT_TOKEN"
echo "   - TELEGRAM_CHAT_ID"
echo "   - WAYFORPAY_MERCHANT_ACCOUNT"
echo "   - WAYFORPAY_SECRET_KEY"
echo ""
echo "3. Перезапустите проект:"
echo "   docker-compose down && docker-compose up -d"
echo ""
echo "=== Полезные команды ==="
echo "Просмотр логов: docker-compose logs -f"
echo "Перезапуск: docker-compose restart"
echo "Остановка: docker-compose down"
echo "Обновление: ./scripts/vps_deploy_rsync.sh"
echo ""
