#!/usr/bin/expect -f
set timeout 30
set username "root"
set hostname "91.107.204.141"
set password "ass"
set project_dir "/var/www/cv-project"

puts "=== VPS Deploy Script (Expect) ==="
puts "Перезапускаем все сервисы на VPS..."

# Останавливаем контейнеры
puts "1. Останавливаем контейнеры..."
spawn ssh $username@$hostname "cd $project_dir && docker compose down"
expect {
    "*assphrase for key*" { send "$password\r"; exp_continue }
    "*password:*" { send "$password\r"; exp_continue }
    "*(yes/no)*" { send "yes\r"; exp_continue }
    eof
}

# Запускаем контейнеры
puts "2. Запускаем контейнеры..."
spawn ssh $username@$hostname "cd $project_dir && docker compose up -d --build"
expect {
    "*assphrase for key*" { send "$password\r"; exp_continue }
    "*password:*" { send "$password\r"; exp_continue }
    "*(yes/no)*" { send "yes\r"; exp_continue }
    eof
}

# Проверяем статус
puts "3. Проверяем статус контейнеров..."
spawn ssh $username@$hostname "cd $project_dir && docker compose ps"
expect {
    "*assphrase for key*" { send "$password\r"; exp_continue }
    "*password:*" { send "$password\r"; exp_continue }
    "*(yes/no)*" { send "yes\r"; exp_continue }
    eof
}

puts "4. Ждем запуска сервисов..."
sleep 15

# Проверяем логи backend
puts "5. Проверяем логи backend..."
spawn ssh $username@$hostname "cd $project_dir && docker compose logs --tail=10 backend"
expect {
    "*assphrase for key*" { send "$password\r"; exp_continue }
    "*password:*" { send "$password\r"; exp_continue }
    "*(yes/no)*" { send "yes\r"; exp_continue }
    eof
}

puts "=== Деплой завершен! ==="
puts "Проверьте логи и статус сервисов"
