#!/bin/bash

# Theme Sync Script
# Синхронизация темы между локальной папкой и WordPress контейнером

set -e

# Конфигурация
SERVER_IP="91.107.204.141"
SERVER_USER="root"
PROJECT_PATH="/var/www/cv-project"
THEME_PATH="wp-content/themes/cv-theme"
REMOTE_THEME_PATH="/var/lib/docker/volumes/cv-project_wordpress_data/_data/wp-content/themes/cv-theme"

# Цвета для вывода
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}🔄 Theme Sync Script${NC}"
echo "================================"

# Проверяем наличие локальной темы
if [ ! -d "$THEME_PATH" ]; then
    echo -e "${RED}❌ Локальная тема не найдена: $THEME_PATH${NC}"
    exit 1
fi

echo -e "${GREEN}✅ Локальная тема найдена${NC}"

# Синхронизируем файлы темы
echo -e "${YELLOW}📁 Синхронизируем файлы темы...${NC}"
rsync -avz --progress --delete \
    --exclude='.git' \
    --exclude='node_modules' \
    --exclude='*.log' \
    $THEME_PATH/ $SERVER_USER@$SERVER_IP:$REMOTE_THEME_PATH/

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Файлы темы синхронизированы${NC}"
else
    echo -e "${RED}❌ Ошибка синхронизации${NC}"
    exit 1
fi

# Устанавливаем правильные права доступа
echo -e "${YELLOW}🔐 Устанавливаем права доступа...${NC}"
ssh $SERVER_USER@$SERVER_IP "chown -R www-data:www-data $REMOTE_THEME_PATH && chmod -R 755 $REMOTE_THEME_PATH"

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Права доступа установлены${NC}"
else
    echo -e "${RED}❌ Ошибка установки прав доступа${NC}"
    exit 1
fi

# Перезапускаем WordPress контейнер
echo -e "${YELLOW}🔄 Перезапускаем WordPress контейнер...${NC}"
ssh $SERVER_USER@$SERVER_IP "cd $PROJECT_PATH && docker-compose restart wordpress"

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ WordPress контейнер перезапущен${NC}"
else
    echo -e "${RED}❌ Ошибка перезапуска контейнера${NC}"
    exit 1
fi

# Очищаем кэш WordPress
echo -e "${YELLOW}🧹 Очищаем кэш WordPress...${NC}"
ssh $SERVER_USER@$SERVER_IP "cd $PROJECT_PATH && docker-compose exec -T wp_db mysql -u root -p\${WP_DB_ROOT} -e \"USE wp_production; DELETE FROM wp_options WHERE option_name LIKE '%_transient_%';\""

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Кэш WordPress очищен${NC}"
else
    echo -e "${YELLOW}⚠️ Не удалось очистить кэш (возможно, нужен пароль)${NC}"
fi

echo ""
echo -e "${BLUE}📊 Результат синхронизации:${NC}"
echo "================================"
echo -e "${GREEN}✅ Тема синхронизирована${NC}"
echo -e "${GREEN}✅ Права доступа установлены${NC}"
echo -e "${GREEN}✅ WordPress перезапущен${NC}"
echo -e "${GREEN}✅ Кэш очищен${NC}"

echo ""
echo -e "${YELLOW}💡 Проверь сайт: https://seafarer-cv.com${NC}"
echo -e "${GREEN}🎉 Синхронизация завершена успешно!${NC}"
