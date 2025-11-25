#!/bin/bash
# Скрипт для копирования файла на VPS

set -euo pipefail

echo "=== Копирование page-payment-success.php на VPS ==="

# Создаем временный файл с содержимым
TEMP_FILE="/tmp/page-payment-success.php"

# Копируем содержимое локального файла
cp wp-content/themes/cv-theme/page-payment-success.php "$TEMP_FILE"

echo "Файл скопирован во временное место: $TEMP_FILE"
echo "Размер файла: $(wc -l < "$TEMP_FILE") строк"

# Копируем на VPS через expect
expect << EOF
spawn ssh root@91.107.204.141 "cat > /var/www/cv-project/wp-content/themes/cv-theme/page-payment-success.php"
expect "Enter passphrase for key"
send "ass\r"
expect eof
EOF < "$TEMP_FILE"

echo "✅ Файл скопирован на VPS"

# Проверяем размер файла на VPS
echo "Проверяем размер файла на VPS..."
expect << 'EOF'
spawn ssh root@91.107.204.141 "wc -l /var/www/cv-project/wp-content/themes/cv-theme/page-payment-success.php"
expect "Enter passphrase for key"
send "ass\r"
expect eof
EOF

# Удаляем временный файл
rm -f "$TEMP_FILE"

echo "=== Копирование завершено ==="
