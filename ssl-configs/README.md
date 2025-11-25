# SSL Configuration Files

⚠️ **ВНИМАНИЕ: ЭТА ПАПКА НЕ ДОЛЖНА ПОПАДАТЬ В GIT!**

## Содержимое:

-  `cloudflare_cert.txt` - Cloudflare Origin CA сертификат
-  `cloudflare_private_key.txt` - Приватный ключ от Cloudflare
-  `nginx_https_grade_a.conf` - Nginx конфигурация для Grade A SSL

## Развертывание на сервере:

```bash
# 1. Создать SSL директорию на сервере
ssh root@IP "mkdir -p /var/www/cv-project/ssl"

# 2. Загрузить сертификат
scp cloudflare_cert.txt root@IP:/var/www/cv-project/ssl/origin-ca-cert.pem

# 3. Загрузить приватный ключ
scp cloudflare_private_key.txt root@IP:/var/www/cv-project/ssl/origin-ca-key.pem

# 4. Загрузить Nginx конфигурацию
scp nginx_https_grade_a.conf root@IP:/var/www/cv-project/nginx/conf.d/https.conf

# 5. Перезапустить Nginx
ssh root@IP "cd /var/www/cv-project && docker-compose restart nginx"
```

## Безопасность:

-  ✅ Файлы исключены из Git (.gitignore)
-  ✅ Приватные ключи не попадают в репозиторий
-  ✅ Конфигурации хранятся локально
-  ✅ Развертывание только через SSH

## Обновление сертификатов:

1. Получить новый сертификат в Cloudflare
2. Заменить файлы в этой папке
3. Загрузить на сервер по инструкции выше
4. Перезапустить Nginx
