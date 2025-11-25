// backend/src/migrate.js
import { getPool } from "./db.js";

(async () => {
   const pool = getPool();

   // 1) Новая таблица с расширенными полями
   await pool.query(`
    CREATE TABLE IF NOT EXISTS orders (
      id CHAR(36) PRIMARY KEY,
      email VARCHAR(255) NOT NULL,
      total_amount DECIMAL(10,2) NOT NULL,
      currency VARCHAR(16) DEFAULT 'EUR',
      status VARCHAR(32) DEFAULT 'pending',
      cv_filename VARCHAR(255) NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      name VARCHAR(255) NULL,
      surname VARCHAR(255) NULL,
      phone VARCHAR(50) NULL,
      cart JSON NULL,
      messengers TEXT NULL,
      no_wish TEXT NULL,
      comment TEXT NULL
    )
  `);

   // 2) Для старых таблиц (где колонки ещё нет) — безопасный ALTER
   const newColumns = [
      { name: "cv_filename", type: "VARCHAR(255) NULL" },
      { name: "name", type: "VARCHAR(255) NULL" },
      { name: "surname", type: "VARCHAR(255) NULL" },
      { name: "phone", type: "VARCHAR(50) NULL" },
      { name: "cart", type: "JSON NULL" },
      { name: "messengers", type: "TEXT NULL" },
      { name: "no_wish", type: "TEXT NULL" },
      { name: "comment", type: "TEXT NULL" },
   ];

   for (const column of newColumns) {
      try {
         await pool.query(
            `ALTER TABLE orders ADD COLUMN ${column.name} ${column.type}`
         );
      } catch (err) {
         // Колонка уже существует — ок: ER_DUP_FIELDNAME (1060)
         if (
            !(err && (err.code === "ER_DUP_FIELDNAME" || err.errno === 1060))
         ) {
            throw err;
         }
      }
   }

   // (опционально) индекс по дате для быстрого списка:
   try {
      await pool.query(
         `CREATE INDEX idx_orders_created_at ON orders(created_at)`
      );
   } catch (err) {
      // ER_DUP_KEYNAME (1061) — индекс уже есть
      if (!(err && (err.code === "ER_DUP_KEYNAME" || err.errno === 1061))) {
         throw err;
      }
   }

   await pool.end();
   console.log("Migration OK (MariaDB)");
})();
