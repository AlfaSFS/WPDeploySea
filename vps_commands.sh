#!/bin/bash

# Скрипт для выполнения команд на VPS
VPS_HOST="91.107.204.141"
VPS_USER="root"
PASSPHRASE="ass"

echo "Выполняем команду на VPS: $1"

expect << EOF
spawn ssh $VPS_USER@$VPS_HOST "$1"
expect "passphrase:"
send "$PASSPHRASE\r"
expect eof
EOF
