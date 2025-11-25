#!/usr/bin/expect -f
set timeout 30
set username "root"
set hostname "91.107.204.141"
set password "ass"
set project_dir "/var/www/cv-project"

puts "=== Синхронизация кода на VPS ==="

# Создаем архив с кодом
puts "1. Создаем архив с кодом..."
spawn tar -czf cv-project-code.tar.gz backend/ scripts/ tests/ docker-compose.yml env.*.example
expect eof

# Копируем архив на VPS
puts "2. Копируем архив на VPS..."
spawn scp cv-project-code.tar.gz $username@$hostname:$project_dir/
expect {
    "*assphrase for key*" { send "$password\r"; exp_continue }
    "*password:*" { send "$password\r"; exp_continue }
    "*(yes/no)*" { send "yes\r"; exp_continue }
    eof
}

# Распаковываем архив на VPS
puts "3. Распаковываем архив на VPS..."
spawn ssh $username@$hostname "cd $project_dir && tar -xzf cv-project-code.tar.gz && rm cv-project-code.tar.gz"
expect {
    "*assphrase for key*" { send "$password\r"; exp_continue }
    "*password:*" { send "$password\r"; exp_continue }
    "*(yes/no)*" { send "yes\r"; exp_continue }
    eof
}

# Перезапускаем backend
puts "4. Перезапускаем backend..."
spawn ssh $username@$hostname "cd $project_dir && docker compose restart backend"
expect {
    "*assphrase for key*" { send "$password\r"; exp_continue }
    "*password:*" { send "$password\r"; exp_continue }
    "*(yes/no)*" { send "yes\r"; exp_continue }
    eof
}

# Удаляем локальный архив
puts "5. Удаляем локальный архив..."
spawn rm cv-project-code.tar.gz
expect eof

puts "=== Синхронизация завершена! ==="
puts "Код на VPS обновлен и backend перезапущен"
