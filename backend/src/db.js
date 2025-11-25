import mysql from "mysql2/promise";

const {
   ORDERS_DB_HOST = "db",
   ORDERS_DB_PORT = "3306",
   ORDERS_DB_NAME = "orders_db",
   ORDERS_DB_USER = "orders_user",
   ORDERS_DB_PASS = "orders_pass",
} = process.env;

let pool;
export function getPool() {
   if (!pool) {
      pool = mysql.createPool({
         host: ORDERS_DB_HOST,
         port: Number(ORDERS_DB_PORT),
         user: ORDERS_DB_USER,
         password: ORDERS_DB_PASS,
         database: ORDERS_DB_NAME,
         connectionLimit: 5,
         supportBigNumbers: true,
         decimalNumbers: true,
      });
   }
   return pool;
}
