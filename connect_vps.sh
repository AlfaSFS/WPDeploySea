#!/bin/bash

# Скрипт для подключения к VPS
echo "Подключаемся к VPS..."

expect << 'EOF'
spawn ssh -o PreferredAuthentications=password -o PubkeyAuthentication=no root@91.107.204.141
expect "password:"
send "ass\r"
interact
EOF
