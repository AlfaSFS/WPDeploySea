#!/bin/bash

# SSL Deployment Script
# Безопасное развертывание SSL сертификатов на сервер

set -e

# Конфигурация
SERVER_IP="91.107.204.141"
SERVER_USER="root"
PROJECT_PATH="/var/www/cv-project"
SSL_CONFIGS_DIR="ssl-configs"

# Цвета для вывода
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${GREEN}🔒 SSL Deployment Script${NC}"
echo "================================"

# Проверяем наличие файлов
if [ ! -d "$SSL_CONFIGS_DIR" ]; then
    echo -e "${RED}❌ Папка $SSL_CONFIGS_DIR не найдена!${NC}"
    exit 1
fi

if [ ! -f "$SSL_CONFIGS_DIR/cloudflare_cert.txt" ]; then
    echo -e "${RED}❌ Сертификат не найден!${NC}"
    exit 1
fi

if [ ! -f "$SSL_CONFIGS_DIR/cloudflare_private_key.txt" ]; then
    echo -e "${RED}❌ Приватный ключ не найден!${NC}"
    exit 1
fi

if [ ! -f "$SSL_CONFIGS_DIR/nginx_https_grade_a.conf" ]; then
    echo -e "${RED}❌ Nginx конфигурация не найдена!${NC}"
    exit 1
fi

echo -e "${GREEN}✅ Все SSL файлы найдены${NC}"

# Создаем SSL директорию на сервере
echo -e "${YELLOW}📁 Создаем SSL директорию на сервере...${NC}"
ssh $SERVER_USER@$SERVER_IP "mkdir -p $PROJECT_PATH/ssl"

# Загружаем сертификат
echo -e "${YELLOW}📜 Загружаем сертификат...${NC}"
scp $SSL_CONFIGS_DIR/cloudflare_cert.txt $SERVER_USER@$SERVER_IP:$PROJECT_PATH/ssl/origin-ca-cert.pem

# Загружаем приватный ключ
echo -e "${YELLOW}🔑 Загружаем приватный ключ...${NC}"
scp $SSL_CONFIGS_DIR/cloudflare_private_key.txt $SERVER_USER@$SERVER_IP:$PROJECT_PATH/ssl/origin-ca-key.pem

# Загружаем Nginx конфигурацию
echo -e "${YELLOW}⚙️ Загружаем Nginx конфигурацию...${NC}"
if [ -f "$SSL_CONFIGS_DIR/nginx_https_grade_a_optimized.conf" ]; then
    scp $SSL_CONFIGS_DIR/nginx_https_grade_a_optimized.conf $SERVER_USER@$SERVER_IP:$PROJECT_PATH/nginx/conf.d/https.conf
    echo -e "${GREEN}✅ Используем оптимизированную конфигурацию для Grade A+${NC}"
else
    scp $SSL_CONFIGS_DIR/nginx_https_grade_a.conf $SERVER_USER@$SERVER_IP:$PROJECT_PATH/nginx/conf.d/https.conf
    echo -e "${YELLOW}⚠️ Используем стандартную конфигурацию${NC}"
fi

# Проверяем конфигурацию Nginx
echo -e "${YELLOW}🔍 Проверяем конфигурацию Nginx...${NC}"
ssh $SERVER_USER@$SERVER_IP "cd $PROJECT_PATH && docker-compose exec -T nginx nginx -t"

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Конфигурация Nginx корректна${NC}"
else
    echo -e "${RED}❌ Ошибка в конфигурации Nginx!${NC}"
    exit 1
fi

# Перезапускаем Nginx
echo -e "${YELLOW}🔄 Перезапускаем Nginx...${NC}"
ssh $SERVER_USER@$SERVER_IP "cd $PROJECT_PATH && docker-compose restart nginx"

# Проверяем статус
echo -e "${YELLOW}📊 Проверяем статус сервисов...${NC}"
ssh $SERVER_USER@$SERVER_IP "cd $PROJECT_PATH && docker-compose ps"

# Тестируем HTTPS
echo -e "${YELLOW}🌐 Тестируем HTTPS соединение...${NC}"
if curl -s -I https://seafarer-cv.com | grep -q "HTTP/2 200"; then
    echo -e "${GREEN}✅ HTTPS работает корректно!${NC}"
else
    echo -e "${RED}❌ Проблема с HTTPS соединением!${NC}"
    exit 1
fi

echo -e "${GREEN}🎉 SSL развертывание завершено успешно!${NC}"
echo -e "${YELLOW}💡 Проверь SSL Labs: https://www.ssllabs.com/ssltest/${NC}"
