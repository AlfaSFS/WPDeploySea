#!/bin/bash

# CV Project Local Setup Script
# This script sets up the local development environment

set -euo pipefail

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Get script directory
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"
LOCAL_ENV_FILE="$PROJECT_ROOT/.env"

echo -e "${BLUE}🚀 Запуск локальной среды CV Project...${NC}"

# Check if .env file exists
if [ ! -f "$LOCAL_ENV_FILE" ]; then
    echo -e "${RED}❌ Файл .env не найден!${NC}"
    echo -e "${YELLOW}📝 Скопируйте env.example в .env и настройте переменные:${NC}"
    echo "cp env.example .env"
    exit 1
fi

# Load environment variables
set -a
source "$LOCAL_ENV_FILE"
set +a

echo -e "${BLUE}📦 Запускаю Docker Compose...${NC}"
cd "$PROJECT_ROOT"
docker compose -f "$PROJECT_ROOT/docker-compose.yml" up -d --build

echo -e "${BLUE}⏳ Жду готовности баз данных...${NC}"
sleep 10

# Wait for databases to be ready
echo -e "${BLUE}🔍 Проверяю готовность баз данных...${NC}"
timeout=60
while [ $timeout -gt 0 ]; do
    if docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wp_db mysqladmin ping -h"localhost" --silent; then
        echo -e "${GREEN}✅ WordPress база данных готова${NC}"
        break
    fi
    sleep 2
    timeout=$((timeout - 2))
done

timeout=60
while [ $timeout -gt 0 ]; do
    if docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T orders_db mysqladmin ping -h"localhost" --silent; then
        echo -e "${GREEN}✅ Orders база данных готова${NC}"
        break
    fi
    sleep 2
    timeout=$((timeout - 2))
done

# Setup WordPress
echo -e "${BLUE}📝 Настраиваю WordPress...${NC}"
if docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress test -f /var/www/html/wp-config.php; then
    echo -e "${GREEN}✅ WordPress уже установлен.${NC}"
else
    echo -e "${YELLOW}📝 WordPress не установлен. Устанавливаю...${NC}"
    # Manual wp-config.php creation and configuration
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress cp /var/www/html/wp-config-sample.php /var/www/html/wp-config.php
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress sed -i "s/database_name_here/$WP_DB_NAME/g" /var/www/html/wp-config.php
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress sed -i "s/username_here/$WP_DB_USER/g" /var/www/html/wp-config.php
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress sed -i "s/password_here/$WP_DB_PASS/g" /var/www/html/wp-config.php
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress sed -i "s/localhost/$WP_DB_HOST/g" /var/www/html/wp-config.php
    
    # Add debug and URL settings
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress bash -c "echo \"define('WP_DEBUG', true);\" >> /var/www/html/wp-config.php"
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress bash -c "echo \"define('WP_DEBUG_LOG', true);\" >> /var/www/html/wp-config.php"
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress bash -c "echo \"define('WP_DEBUG_DISPLAY', false);\" >> /var/www/html/wp-config.php"
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress bash -c "echo \"define('WP_HOME', '$WP_URL');\" >> /var/www/html/wp-config.php"
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress bash -c "echo \"define('WP_SITEURL', '$WP_URL');\" >> /var/www/html/wp-config.php"
    
    # Fix SSL issues
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress bash -c "echo \"define('WP_HTTP_BLOCK_EXTERNAL', true);\" >> /var/www/html/wp-config.php"
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress bash -c "echo \"define('WP_ACCESSIBLE_HOSTS', 'api.wordpress.org,downloads.wordpress.org');\" >> /var/www/html/wp-config.php"
    docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress bash -c "echo \"define('FS_METHOD', 'direct');\" >> /var/www/html/wp-config.php"
    
    echo -e "${GREEN}✅ WordPress установлен успешно${NC}"
fi

# WordPress initialization info
echo -e "${YELLOW}📝 WordPress готов к инициализации!${NC}"
echo -e "${BLUE}🌐 Откройте браузер и перейдите по адресу: $WP_URL${NC}"
echo -e "${BLUE}📋 Данные для настройки:${NC}"
echo -e "  📝 Название сайта: $WP_TITLE"
echo -e "  👤 Имя пользователя: $WP_ADMIN_USER"
echo -e "  🔑 Пароль: $WP_ADMIN_PASS"
echo -e "  📧 Email: $WP_ADMIN_EMAIL"
echo -e ""
echo -e "${YELLOW}💡 После инициализации WordPress активируйте тему cv-theme в админке${NC}"

# PHP lint check
echo -e "${BLUE}🔍 Проверяю PHP синтаксис темы...${NC}"
if docker compose -f "$PROJECT_ROOT/docker-compose.yml" exec -T wordpress find /var/www/html/wp-content/themes/cv-theme -name "*.php" -exec php -l {} \; | grep -q "No syntax errors"; then
    echo -e "${GREEN}✅ PHP синтаксис корректен${NC}"
else
    echo -e "${YELLOW}⚠️ Найдены ошибки PHP синтаксиса${NC}"
fi

# Health checks
echo -e "${BLUE}🏥 Выполняю проверки здоровья...${NC}"

# Check WordPress REST API
if curl -s http://localhost:8080/wp-json/ | grep -q "name"; then
    echo -e "${GREEN}✅ WordPress REST API работает${NC}"
else
    echo -e "${YELLOW}⚠️ WordPress REST API недоступен${NC}"
fi

# Check Node.js API
if curl -s http://localhost:8080/api/orders/health | grep -q "ok"; then
    echo -e "${GREEN}✅ Node.js API работает${NC}"
else
    echo -e "${YELLOW}⚠️ Node.js API недоступен${NC}"
fi

echo -e "${GREEN}🎉 Локальная среда готова!${NC}"
echo -e "${BLUE}📱 Доступные URL:${NC}"
echo -e "  🌐 WordPress: http://localhost:8080"
echo -e "  🔑 Админка: http://localhost:8080/wp-admin/ ($WP_ADMIN_USER/$WP_ADMIN_PASS)"
echo -e "  📡 REST API: http://localhost:8080/wp-json/"
echo -e "  🔌 Node API: http://localhost:8080/api/"
echo ""
echo -e "${BLUE}📋 Полезные команды:${NC}"
echo -e "  Остановить: bash scripts/local_down.sh"
echo -e "  Логи: docker compose logs -f"
echo -e "  Перезапуск: docker compose restart"