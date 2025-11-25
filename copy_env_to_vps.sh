#!/usr/bin/expect -f
set timeout 10
set username "root"
set hostname "91.107.204.141"
set password "ass"
set local_file "/Users/alexey.nikolayenko/Desktop/Experiments/mail-sender/CV-project/.env"
set remote_file "/var/www/cv-project/.env"

puts "Копируем .env файл на VPS..."
spawn scp $local_file $username@$hostname:$remote_file
expect {
    "*assphrase for key*" { send "$password\r"; exp_continue }
    "*password:*" { send "$password\r"; exp_continue }
    "*(yes/no)*" { send "yes\r"; exp_continue }
    eof
}
catch wait reason
exit [lindex $reason 3]
