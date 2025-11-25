#!/bin/bash

# ===== VPS Deploy Script =====
# Деплоит проект на подготовленный VPS

set -euo pipefail

# ===== КОНФИГУРАЦИЯ =====
VPS_HOST="91.107.204.141"        # IP вашего VPS
VPS_USER="root"                  # Пользователь для подключения
VPS_PORT="22"                    # SSH порт
PROJECT_DIR="/var/www/cv-project" # Директория проекта на VPS
GIT_REPO="https://github.com/AlfaSFS/WPDeploySea" # URL репозитория
BRANCH="main"           # Ветка для деплоя

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

# ===== ПРОВЕРКА ПАРАМЕТРОВ =====
if [ "$VPS_HOST" = "your-vps-ip" ]; then
    log_error "Пожалуйста, укажите IP адрес вашего VPS в переменной VPS_HOST"
    exit 1
fi

# ===== ПРОВЕРКА ЛОКАЛЬНОГО .ENV =====
if [ ! -f "env.production.example" ]; then
    log_error "Файл env.production.example не найден!"
    log_info "Убедитесь, что вы находитесь в корневой директории проекта"
    exit 1
fi

# ===== ДЕПЛОЙ НА VPS =====
log_info "Деплоим проект на VPS: $VPS_USER@$VPS_HOST:$VPS_PORT"

ssh -p $VPS_PORT $VPS_USER@$VPS_HOST << EOF
set -euo pipefail

# ===== ЦВЕТА =====
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

log_info() {
    echo -e "\${BLUE}ℹ️  \$1\${NC}"
}

log_success() {
    echo -e "\${GREEN}✅ \$1\${NC}"
}

log_warning() {
    echo -e "\${YELLOW}⚠️  \$1\${NC}"
}

log_error() {
    echo -e "\${RED}❌ \$1\${NC}"
}

# ===== ПЕРЕХОД В ДИРЕКТОРИЮ ПРОЕКТА =====
cd $PROJECT_DIR

# ===== КЛОНИРОВАНИЕ РЕПОЗИТОРИЯ =====
log_info "Клонируем репозиторий..."

if [ -d ".git" ]; then
    log_info "Репозиторий уже существует, обновляем..."
    git fetch origin
    git reset --hard origin/$BRANCH
    log_success "Репозиторий обновлен"
else
    log_info "Клонируем репозиторий впервые..."
    git clone -b $BRANCH $GIT_REPO .
    log_success "Репозиторий склонирован"
fi

# ===== НАСТРОЙКА .ENV =====
log_info "Настраиваем переменные окружения..."

if [ ! -f ".env" ]; then
    log_info "Создаем .env из env.production.example..."
    cp env.production.example .env
    log_warning "ВАЖНО: Отредактируйте файл .env и заполните реальные значения!"
    log_warning "Особенно важны:"
    echo "  - Пароли для баз данных"
    echo "  - TELEGRAM_BOT_TOKEN"
    echo "  - TELEGRAM_CHAT_ID"
    echo "  - WAYFORPAY_MERCHANT_ACCOUNT"
    echo "  - WAYFORPAY_SECRET_KEY"
    echo ""
    log_info "Файл .env создан, но требует редактирования"
else
    log_info "Файл .env уже существует"
fi

# ===== ПРОВЕРКА DOCKER =====
log_info "Проверяем Docker..."

if ! command -v docker &> /dev/null; then
    log_error "Docker не установлен!"
    exit 1
fi

if ! command -v docker-compose &> /dev/null; then
    log_error "Docker Compose не установлен!"
    exit 1
fi

log_success "Docker и Docker Compose готовы"

# ===== ЗАПУСК ПРОЕКТА =====
log_info "Запускаем проект..."

# Останавливаем старые контейнеры если есть
docker-compose down || true

# Собираем и запускаем
docker-compose up -d --build

log_success "Проект запущен!"

# ===== ПРОВЕРКА СТАТУСА =====
log_info "Проверяем статус контейнеров..."

sleep 10

echo "=== Статус контейнеров ==="
docker-compose ps

echo "=== Логи backend ==="
docker-compose logs --tail=20 backend

echo "=== Логи nginx ==="
docker-compose logs --tail=10 nginx

# ===== ПРОВЕРКА ЗДОРОВЬЯ =====
log_info "Проверяем здоровье сервисов..."

# Проверяем WordPress
if curl -s http://localhost/wp-json/ | grep -q "name"; then
    log_success "WordPress API работает"
else
    log_warning "WordPress API не отвечает"
fi

# Проверяем Backend API
if curl -s http://localhost/api/health | grep -q "ok"; then
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
echo "=== Полезные команды ==="
echo "Просмотр логов: docker-compose logs -f"
echo "Перезапуск: docker-compose restart"
echo "Остановка: docker-compose down"
echo "Обновление: git pull && docker-compose up -d --build"
echo ""

EOF

# ===== ПРОВЕРКА РЕЗУЛЬТАТА =====
if [ $? -eq 0 ]; then
    log_success "Деплой успешно завершен!"
    log_info "Сайт должен быть доступен по адресу: http://$VPS_HOST"
    log_warning "Не забудьте:"
    echo "  1. Отредактировать .env файл на VPS"
    echo "  2. Настроить домен в Cloudflare"
    echo "  3. Проверить работу всех функций"
else
    log_error "Ошибка при деплое"
    exit 1
fi
