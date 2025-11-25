#!/usr/bin/expect -f
set timeout 30
set username "root"
set hostname "91.107.204.141"
set password "ass"
set project_dir "/var/www/cv-project"

puts "=== Синхронизация backend кода на VPS ==="

# Копируем backend код
puts "1. Копируем backend/src/index.js..."
spawn scp backend/src/index.js $username@$hostname:$project_dir/backend/src/index.js
expect {
    "*assphrase for key*" { send "$password\r"; exp_continue }
    "*password:*" { send "$password\r"; exp_continue }
    "*(yes/no)*" { send "yes\r"; exp_continue }
    eof
}

# Копируем .env
puts "2. Копируем .env..."
spawn scp .env $username@$hostname:$project_dir/.env
expect {
    "*assphrase for key*" { send "$password\r"; exp_continue }
    "*password:*" { send "$password\r"; exp_continue }
    "*(yes/no)*" { send "yes\r"; exp_continue }
    eof
}

# Перезапускаем backend
puts "3. Перезапускаем backend..."
spawn ssh $username@$hostname "cd $project_dir && docker compose restart backend"
expect {
    "*assphrase for key*" { send "$password\r"; exp_continue }
    "*password:*" { send "$password\r"; exp_continue }
    "*(yes/no)*" { send "yes\r"; exp_continue }
    eof
}

puts "=== Синхронизация завершена! ==="
