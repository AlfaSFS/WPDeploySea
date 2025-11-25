#!/usr/bin/expect -f
set timeout 30
set username "root"
set hostname "91.107.204.141"
set password "ass"

puts "Копируем docker-compose.yml на VPS..."
spawn scp docker-compose.yml $username@$hostname:/var/www/cv-project/docker-compose.yml
expect {
    "*assphrase for key*" { send "$password\r"; exp_continue }
    "*password:*" { send "$password\r"; exp_continue }
    "*(yes/no)*" { send "yes\r"; exp_continue }
    eof
}
catch wait reason
exit [lindex $reason 3]
