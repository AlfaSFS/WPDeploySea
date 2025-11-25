#!/bin/bash

# ===== VPS Clean Deploy Script =====
# Подключается к VPS, останавливает все сервисы, чистит и подготавливает к деплою

set -euo pipefail

# ===== КОНФИГУРАЦИЯ =====
VPS_HOST="91.107.204.141"           # Замените на IP вашего VPS
VPS_USER="root"                  # Пользователь для подключения
VPS_PORT="22"                    # SSH порт
PROJECT_DIR="/var/www/cv-project" # Директория проекта на VPS

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

# ===== ПОДКЛЮЧЕНИЕ К VPS =====
log_info "Подключаемся к VPS: $VPS_USER@$VPS_HOST:$VPS_PORT"

# ===== ВЫПОЛНЕНИЕ КОМАНД НА VPS =====
ssh -p $VPS_PORT $VPS_USER@$VPS_HOST << 'EOF'
set -euo pipefail

# ===== ЦВЕТА =====
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

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

# ===== ОСТАНОВКА ВСЕХ DOCKER КОНТЕЙНЕРОВ =====
log_info "Останавливаем все Docker контейнеры..."

# Останавливаем все запущенные контейнеры
if docker ps -q | grep -q .; then
    log_info "Найдены запущенные контейнеры, останавливаем..."
    docker stop $(docker ps -q) || true
    log_success "Все контейнеры остановлены"
else
    log_info "Запущенных контейнеров не найдено"
fi

# ===== УДАЛЕНИЕ ВСЕХ DOCKER КОНТЕЙНЕРОВ =====
log_info "Удаляем все Docker контейнеры..."

if docker ps -aq | grep -q .; then
    log_info "Найдены контейнеры для удаления..."
    docker rm $(docker ps -aq) || true
    log_success "Все контейнеры удалены"
else
    log_info "Контейнеров для удаления не найдено"
fi

# ===== УДАЛЕНИЕ ВСЕХ DOCKER ОБРАЗОВ =====
log_info "Удаляем все Docker образы..."

if docker images -q | grep -q .; then
    log_info "Найдены образы для удаления..."
    docker rmi $(docker images -q) || true
    log_success "Все образы удалены"
else
    log_info "Образов для удаления не найдено"
fi

# ===== ОЧИСТКА DOCKER СИСТЕМЫ =====
log_info "Очищаем Docker систему..."

docker system prune -af || true
docker volume prune -f || true
docker network prune -f || true

log_success "Docker система очищена"

# ===== УДАЛЕНИЕ СТАРОЙ ПРОЕКТНОЙ ДИРЕКТОРИИ =====
PROJECT_DIR="/var/www/cv-project"

if [ -d "$PROJECT_DIR" ]; then
    log_warning "Найдена старая директория проекта: $PROJECT_DIR"
    log_info "Удаляем старую директорию..."
    rm -rf "$PROJECT_DIR"
    log_success "Старая директория удалена"
else
    log_info "Старая директория проекта не найдена"
fi

# ===== СОЗДАНИЕ НОВОЙ ДИРЕКТОРИИ =====
log_info "Создаем новую директорию проекта..."
mkdir -p "$PROJECT_DIR"
cd "$PROJECT_DIR"

log_success "Директория $PROJECT_DIR создана"

# ===== ПРОВЕРКА DOCKER И DOCKER COMPOSE =====
log_info "Проверяем установку Docker..."

if ! command -v docker &> /dev/null; then
    log_error "Docker не установлен!"
    log_info "Устанавливаем Docker..."
    
    # Обновляем пакеты
    apt update
    
    # Устанавливаем Docker
    curl -fsSL https://get.docker.com -o get-docker.sh
    sh get-docker.sh
    rm get-docker.sh
    
    # Добавляем пользователя в группу docker
    usermod -aG docker $USER
    
    log_success "Docker установлен"
else
    log_success "Docker уже установлен"
fi

if ! command -v docker-compose &> /dev/null; then
    log_error "Docker Compose не установлен!"
    log_info "Устанавливаем Docker Compose..."
    
    # Устанавливаем Docker Compose
    curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    chmod +x /usr/local/bin/docker-compose
    
    log_success "Docker Compose установлен"
else
    log_success "Docker Compose уже установлен"
fi

# ===== ПРОВЕРКА GIT =====
if ! command -v git &> /dev/null; then
    log_info "Устанавливаем Git..."
    apt update
    apt install -y git
    log_success "Git установлен"
else
    log_success "Git уже установлен"
fi

# ===== ПРОВЕРКА ПОРТОВ =====
log_info "Проверяем доступность портов..."

# Проверяем порт 80
if netstat -tuln | grep -q ":80 "; then
    log_warning "Порт 80 занят, освобождаем..."
    # Останавливаем Apache/Nginx если запущены
    systemctl stop apache2 || true
    systemctl stop nginx || true
    systemctl disable apache2 || true
    systemctl disable nginx || true
    log_success "Порт 80 освобожден"
else
    log_success "Порт 80 свободен"
fi

# Проверяем порт 443
if netstat -tuln | grep -q ":443 "; then
    log_warning "Порт 443 занят, освобождаем..."
    systemctl stop apache2 || true
    systemctl stop nginx || true
    log_success "Порт 443 освобожден"
else
    log_success "Порт 443 свободен"
fi

# ===== ФИНАЛЬНАЯ ПРОВЕРКА =====
log_info "Финальная проверка системы..."

echo "=== Docker версия ==="
docker --version

echo "=== Docker Compose версия ==="
docker-compose --version

echo "=== Свободное место ==="
df -h /

echo "=== Оперативная память ==="
free -h

echo "=== Сетевые интерфейсы ==="
ip addr show

log_success "VPS подготовлен к чистому деплою!"
log_info "Директория проекта: $PROJECT_DIR"
log_info "Готов к клонированию репозитория и деплою"

EOF

# ===== ПРОВЕРКА РЕЗУЛЬТАТА =====
if [ $? -eq 0 ]; then
    log_success "VPS успешно подготовлен к деплою!"
    log_info "Следующие шаги:"
    echo "  1. Склонировать репозиторий: git clone <repo-url> $PROJECT_DIR"
    echo "  2. Скопировать env.production.example в .env"
    echo "  3. Заполнить переменные в .env"
    echo "  4. Запустить: docker-compose up -d"
else
    log_error "Ошибка при подготовке VPS"
    exit 1
fi
