-- ===== WayForPay Audit Table Migration =====
-- Создает таблицу для вечного следа коллбеков WayForPay
-- Дата: 29 сентября 2025

CREATE TABLE IF NOT EXISTS payments_wfp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id VARCHAR(255) NOT NULL COMMENT 'ID заказа',
    transaction_status VARCHAR(50) COMMENT 'Статус транзакции (Approved/Declined)',
    reason_code INT COMMENT 'Код причины (1100=успех, 1005=отклонено)',
    amount DECIMAL(10,2) COMMENT 'Сумма платежа',
    currency VARCHAR(3) COMMENT 'Валюта (UAH/EUR)',
    merchant_account VARCHAR(255) COMMENT 'Аккаунт мерчанта',
    card_pan_last4 VARCHAR(4) COMMENT 'Последние 4 цифры карты (маскированные)',
    auth_code VARCHAR(255) COMMENT 'Код авторизации (маскированный)',
    raw JSON COMMENT 'Сырые данные коллбека (без чувствительной информации)',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Время создания записи',
    
    INDEX idx_order_id (order_id),
    INDEX idx_transaction_status (transaction_status),
    INDEX idx_created_at (created_at),
    INDEX idx_reason_code (reason_code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci 
COMMENT='Аудит коллбеков WayForPay для вечного следа';

-- Добавляем комментарии к полям
ALTER TABLE payments_wfp 
MODIFY COLUMN order_id VARCHAR(255) NOT NULL COMMENT 'ID заказа из системы',
MODIFY COLUMN transaction_status VARCHAR(50) COMMENT 'Статус транзакции: Approved, Declined, etc.',
MODIFY COLUMN reason_code INT COMMENT 'Код причины: 1100=успех, 1005=отклонено, 1006=недостаточно средств',
MODIFY COLUMN amount DECIMAL(10,2) COMMENT 'Сумма платежа в указанной валюте',
MODIFY COLUMN currency VARCHAR(3) COMMENT 'Валюта платежа: UAH, EUR, USD',
MODIFY COLUMN merchant_account VARCHAR(255) COMMENT 'Аккаунт мерчанта WayForPay',
MODIFY COLUMN card_pan_last4 VARCHAR(4) COMMENT 'Последние 4 цифры карты в формате ****1234',
MODIFY COLUMN auth_code VARCHAR(255) COMMENT 'Код авторизации в формате ***1234',
MODIFY COLUMN raw JSON COMMENT 'JSON с безопасными данными коллбека (без PAN, CVV, etc.)';
