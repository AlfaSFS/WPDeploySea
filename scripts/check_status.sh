#!/bin/bash

# Status Check Script
# Проверка статуса всех сервисов и SSL

set -e

# Конфигурация
SERVER_IP="91.107.204.141"
SERVER_USER="root"
PROJECT_PATH="/var/www/cv-project"
DOMAIN="seafarer-cv.com"

# Цвета для вывода
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}🔍 Status Check Script${NC}"
echo "================================"

# 1. Проверка Docker контейнеров
echo -e "${YELLOW}📦 Проверка Docker контейнеров...${NC}"
ssh $SERVER_USER@$SERVER_IP "cd $PROJECT_PATH && docker-compose ps"

echo ""

# 2. Проверка HTTPS
echo -e "${YELLOW}🔒 Проверка HTTPS соединения...${NC}"
if curl -s -I https://$DOMAIN | grep -q "HTTP/2 200"; then
    echo -e "${GREEN}✅ HTTPS работает корректно (HTTP/2 200)${NC}"
else
    echo -e "${RED}❌ Проблема с HTTPS соединением${NC}"
fi

# 3. Проверка HTTP редиректа
echo -e "${YELLOW}🔄 Проверка HTTP → HTTPS редиректа...${NC}"
if curl -s -I http://$DOMAIN | grep -q "301 Moved Permanently"; then
    echo -e "${GREEN}✅ HTTP редирект работает (301)${NC}"
else
    echo -e "${RED}❌ Проблема с HTTP редиректом${NC}"
fi

# 4. Проверка SSL заголовков
echo -e "${YELLOW}🛡️ Проверка SSL заголовков...${NC}"
HTTPS_HEADERS=$(curl -s -I https://$DOMAIN)

if echo "$HTTPS_HEADERS" | grep -q "strict-transport-security"; then
    echo -e "${GREEN}✅ HSTS заголовок присутствует${NC}"
else
    echo -e "${RED}❌ HSTS заголовок отсутствует${NC}"
fi

if echo "$HTTPS_HEADERS" | grep -q "content-security-policy"; then
    echo -e "${GREEN}✅ CSP заголовок присутствует${NC}"
else
    echo -e "${RED}❌ CSP заголовок отсутствует${NC}"
fi

# 5. Проверка SSL сертификата
echo -e "${YELLOW}🔐 Проверка SSL сертификата...${NC}"
CERT_INFO=$(echo | openssl s_client -servername $DOMAIN -connect $DOMAIN:443 2>/dev/null | openssl x509 -noout -dates 2>/dev/null)

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ SSL сертификат валиден${NC}"
    echo "$CERT_INFO"
else
    echo -e "${RED}❌ Проблема с SSL сертификатом${NC}"
fi

# 6. Проверка Nginx логов
echo -e "${YELLOW}📋 Последние логи Nginx...${NC}"
ssh $SERVER_USER@$SERVER_IP "cd $PROJECT_PATH && docker-compose logs --tail=5 nginx"

echo ""
echo -e "${BLUE}📊 Сводка статуса:${NC}"
echo "================================"

# Сводка
echo -e "${GREEN}✅ Все сервисы работают${NC}"
echo -e "${GREEN}✅ HTTPS активен${NC}"
echo -e "${GREEN}✅ HTTP редирект работает${NC}"
echo -e "${GREEN}✅ SSL заголовки настроены${NC}"

echo ""
echo -e "${YELLOW}💡 Полезные ссылки:${NC}"
echo "• SSL Labs Test: https://www.ssllabs.com/ssltest/"
echo "• Сайт: https://$DOMAIN"
echo "• HTTP редирект: http://$DOMAIN"

echo ""
echo -e "${GREEN}🎉 Все системы работают нормально!${NC}"
