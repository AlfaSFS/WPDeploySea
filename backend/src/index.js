// backend/src/index.js
import express from "express";
import cors from "cors";
import dotenv from "dotenv";
import { v4 as uuid } from "uuid";
import { getPool } from "./db.js";
import multer from "multer";
import fs from "node:fs";
import path from "node:path";
import crypto from "crypto";
import { sendOrderNotification } from "./telegram.js";
import WayForPay from "./payments/wayforpay.js";

dotenv.config();
const app = express();

// ===== WayForPay Signature Functions =====
function signJoined(values, secret) {
   const data = values.join(";");
   return crypto.createHmac("md5", secret).update(data).digest("hex");
}

function verifyCallbackSignature(body, secret) {
   const sig = body.merchantSignature || body.signature || "";
   if (!sig) return false;

   const base = [
      String(body.merchantAccount ?? ""),
      String(body.orderReference ?? ""),
      /* amount */ "",
      String(body.currency ?? ""),
      String(body.authCode ?? ""),
      String(body.cardPan ?? ""),
      String(body.transactionStatus ?? ""),
      String(body.reasonCode ?? ""),
   ];

   const candidates = [
      String(body.amount ?? ""), // как пришло (может быть 400)
      Number(body.amount ?? 0).toFixed(2), // принудительно "400.00"
   ].filter(Boolean);

   for (const amt of candidates) {
      base[2] = amt;
      const expected = crypto
         .createHmac("md5", secret)
         .update(base.join(";"), "utf8")
         .digest("hex");
      if (expected === sig) return true;
   }
   return false;
}

// ===== WayForPay Configuration =====
const WFP_MODE = process.env.WFP_MODE || "TEST";
const IS_TEST = WFP_MODE !== "PROD";

// console.log(`WayForPay Mode: ${WFP_MODE} (IS_TEST: ${IS_TEST})`);

const wayForPay = new WayForPay({
   merchantAccount: process.env.WAYFORPAY_ACCOUNT,
   secretKey: process.env.WAYFORPAY_SECRET_KEY,
   domainName: process.env.WAYFORPAY_DOMAIN,
   apiUrl: process.env.WAYFORPAY_API_URL || "https://secure.wayforpay.com/pay",
   callbackUrl: process.env.WAYFORPAY_SERVICE_URL,
   returnUrl: process.env.WAYFORPAY_RETURN_URL,
});

// ===== Money formatting helper =====
function asMoney(n) {
   return Number(n).toFixed(2);
}

// ===== Amount preparation based on mode =====
function prepareAmounts({ amountEUR, items }) {
   if (IS_TEST) {
      // песочница: гоняем UAH
      const rate = Number(process.env.EUR2UAH || 40);
      const amountUAH = asMoney(Number(amountEUR) * rate);
      const productPriceUAH = (
         items?.length ? items : [{ price: amountEUR }]
      ).map((i) => asMoney(Number(i.price) * rate));
      return {
         currency: "UAH",
         amount: amountUAH,
         productPrice: productPriceUAH,
      };
   } else {
      // прод: чистый EUR
      const productPriceEUR = (
         items?.length ? items : [{ price: amountEUR }]
      ).map((i) => asMoney(Number(i.price)));
      return {
         currency: "EUR",
         amount: asMoney(amountEUR),
         productPrice: productPriceEUR,
      };
   }
}

// ===== WayForPay Callback Body Parser =====
function extractWfpBody(req) {
   const ct = (req.headers["content-type"] || "").split(";")[0].trim();
   let body = req.body || {};

   // JSON — уже ок
   if (ct === "application/json" && body && typeof body === "object")
      return body;

   // x-www-form-urlencoded — "странный" кейс WFP: весь JSON в одном ключе
   if (
      ct === "application/x-www-form-urlencoded" &&
      body &&
      typeof body === "object"
   ) {
      const keys = Object.keys(body);
      if (keys.length === 1) {
         const k = keys[0];
         if (
            typeof k === "string" &&
            k.trim().startsWith("{") &&
            k.trim().endsWith("}")
         ) {
            try {
               return JSON.parse(k);
            } catch {}
         }
         const v = body[k];
         if (
            typeof v === "string" &&
            v.trim().startsWith("{") &&
            v.trim().endsWith("}")
         ) {
            try {
               return JSON.parse(v);
            } catch {}
         }
      }
      // иногда кладут JSON в значение одного из полей
      for (const v of Object.values(body)) {
         if (
            typeof v === "string" &&
            v.trim().startsWith("{") &&
            v.trim().endsWith("}")
         ) {
            try {
               return JSON.parse(v);
            } catch {}
         }
      }
   }
   return body;
}

// ===== uploads (multer) =====
const uploadDir = process.env.UPLOAD_DIR || "./uploads";
// console.log("Upload directory:", uploadDir);

// Создаем папку если её нет
try {
   fs.mkdirSync(uploadDir, { recursive: true });
   // console.log("Upload directory created/verified:", uploadDir);
} catch (error) {
   console.error("Error creating upload directory:", error);
}

const storage = multer.diskStorage({
   destination: (req, file, cb) => {
      cb(null, uploadDir);
   },
   filename: (req, file, cb) => {
      const ext = path.extname(file.originalname || "");
      const base = path
         .basename(file.originalname || "cv", ext)
         .replace(/[^\w.-]+/g, "_")
         .slice(0, 80);
      const filename = `${Date.now()}_${base}${ext}`;
      cb(null, filename);
   },
});

const upload = multer({
   storage,
   limits: { fileSize: 5 * 1024 * 1024 }, // 5MB
   fileFilter: (req, file, cb) => {
      // Разрешим самые частые резюме-форматы; при желании расширь
      const ok = /pdf|doc|docx|txt|rtf$/i.test(
         path.extname(file.originalname || "")
      );
      if (ok) {
         cb(null, true);
      } else {
         cb(new Error("Unsupported file type"));
      }
   },
}).any(); // Принимаем любые поля с файлами

// CORS — ставим самым первым, до всех endpoints
const allowed = (process.env.ALLOWED_ORIGINS || "")
   .split(",")
   .map((s) => s.trim())
   .filter(Boolean);

// console.log("CORS allowed origins:", allowed);

app.use(
   cors({
      origin: (origin, cb) => {
         // console.log("CORS check for origin:", origin);

         // Разрешаем запросы без Origin (например, от WayForPay callback или мобильных приложений)
         if (!origin) {
            // console.log("CORS: allowing request without origin");
            cb(null, true);
            return;
         }

         // Проверяем точное совпадение
         if (allowed.includes(origin)) {
            // console.log("CORS: exact match found for origin:", origin);
            cb(null, true);
            return;
         }

         // Проверяем поддомены и варианты домена
         const originHost = new URL(origin).hostname;
         const isAllowedDomain = allowed.some((allowedOrigin) => {
            try {
               const allowedHost = new URL(allowedOrigin).hostname;
               return (
                  originHost === allowedHost ||
                  originHost.endsWith("." + allowedHost) ||
                  allowedHost.endsWith("." + originHost)
               );
            } catch (e) {
               return false;
            }
         });

         if (isAllowedDomain) {
            // console.log("CORS: domain match found for origin:", origin);
            cb(null, true);
         } else {
            // console.log("CORS blocked origin:", origin);
            cb(new Error("CORS"));
         }
      },
      credentials: true,
      methods: ["GET", "POST", "PUT", "DELETE", "OPTIONS"],
      allowedHeaders: [
         "Content-Type",
         "Authorization",
         "X-Requested-With",
         "Accept",
         "Origin",
      ],
   })
);

// Статические файлы
app.use(
   "/uploads",
   express.static(uploadDir, { dotfiles: "deny", etag: true, maxAge: "7d" })
);

app.use(express.json({ limit: "1mb" }));
app.use(express.urlencoded({ extended: true }));

// Health endpoints
app.get("/health", (_req, res) =>
   res.json({ ok: true, service: "orders-api" })
);

app.get("/orders/health", (_req, res) =>
   res.json({ ok: true, service: "orders-api" })
);

// Обработка ошибок multer
app.use((err, _req, res, next) => {
   if (err?.code === "LIMIT_FILE_SIZE")
      return res.status(413).json({ error: "File too large (max 5MB)" });
   if (err?.message === "Unsupported file type")
      return res.status(400).json({
         error: "Unsupported file type. Allowed: pdf, doc, docx, txt, rtf",
      });
   return next(err);
});

// Создание заказа
app.post("/orders", upload, async (req, res, next) => {
   try {
      const {
         name,
         surname,
         email,
         phone,
         total_amount,
         currency = "EUR",
         cart,
         messengers,
         "no-wish": noWish,
         comment,
         // Новые поля для поддержки items
         amount,
         items,
         clientEmail,
         first_name,
         last_name,
      } = req.body || {};

      // Отладочная информация
      // console.log("DEBUG req.body:", req.body);
      // console.log("DEBUG messengers:", messengers);
      // console.log("DEBUG messengers type:", typeof messengers);
      // console.log("DEBUG noWish:", noWish);
      // console.log("DEBUG comment:", comment);
      // console.log("DEBUG items:", items);

      // Парсить items, если пришли строкой (FormData присылает строки)
      let itemsParsed = items;
      if (typeof itemsParsed === "string") {
         try {
            itemsParsed = JSON.parse(itemsParsed);
         } catch {}
      }
      const isNewFormat = Array.isArray(itemsParsed) && itemsParsed.length > 0;
      // console.log("DEBUG isNewFormat:", isNewFormat);
      // console.log("DEBUG items:", items);
      // console.log("DEBUG itemsParsed:", itemsParsed);
      // console.log("DEBUG items type:", typeof items);

      const finalEmail = clientEmail || email;
      const finalAmount = amount || total_amount;
      const finalCurrency = currency;
      const finalName = first_name || name;
      const finalSurname = last_name || surname;

      // Преобразуем messengers в строку, если это массив
      const messengersString = Array.isArray(messengers)
         ? messengers.join(", ")
         : messengers;

      if (!finalEmail || !finalAmount)
         return res
            .status(400)
            .json({ error: "email and total_amount required" });

      const id = uuid();
      const cvFilename =
         req.files && req.files.length > 0 ? req.files[0].filename : null;

      // Преобразуем cart в строку, если это объект/массив
      const cartString = cart
         ? typeof cart === "string"
            ? cart
            : JSON.stringify(cart)
         : null;

      await getPool().query(
         `INSERT INTO orders (id, email, total_amount, currency, status, cv_filename, created_at, name, surname, phone, cart, messengers, no_wish, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`,
         [
            id,
            finalEmail,
            Number(finalAmount),
            finalCurrency,
            "pending",
            cvFilename,
            new Date(),
            finalName || null,
            finalSurname || null,
            phone || null,
            cartString,
            messengersString || null,
            noWish || null,
            comment || null,
         ]
      );

      // Получаем созданный заказ
      const [rows] = await getPool().query(
         "SELECT * FROM orders WHERE id = ?",
         [id]
      );
      const createdOrder = rows[0];

      // Подготовка сумм в зависимости от режима
      let productNames,
         productCounts,
         productPrice,
         amountString,
         paymentCurrency;

      if (isNewFormat) {
         productNames = itemsParsed.map((i) => i.name);
         productCounts = itemsParsed.map((i) => Number(i.count || 1));
         const items = itemsParsed.map((i) => ({ price: i.price || 0 }));
         const amounts = prepareAmounts({ amountEUR: finalAmount, items });
         paymentCurrency = amounts.currency;
         amountString = amounts.amount;
         productPrice = amounts.productPrice;
      } else {
         productNames = [`CV Order #${id}`];
         productCounts = [1];
         const amounts = prepareAmounts({ amountEUR: finalAmount, items: [] });
         paymentCurrency = amounts.currency;
         amountString = amounts.amount;
         productPrice = amounts.productPrice;
      }

      // console.log("Creating payment data for order:", id);
      // console.log("WFP Mode:", WFP_MODE, "IS_TEST:", IS_TEST);
      // console.log("Total amount:", finalAmount, "Currency:", finalCurrency);
      // console.log("Items:", itemsParsed);
      // console.log(
      //    "Payment currency:",
      //    paymentCurrency,
      //    "Amount:",
      //    amountString
      // );
      // console.log("Product prices:", productPrice);

      // Создаем данные для WayForPay
      const orderDate = Math.floor(Date.now() / 1000);

      const returnUrl = `${process.env.WAYFORPAY_RETURN_URL}?order=${id}`;
      const paymentData = wayForPay.createPaymentForm({
         orderReference: id,
         orderDate,
         amount: amountString,
         currency: paymentCurrency,
         productName: productNames,
         productCount: productCounts,
         productPrice,
         clientFirstName: finalName || "",
         clientLastName: finalSurname || "",
         clientEmail: finalEmail,
         clientPhone: phone || "",
         returnUrl: returnUrl,
         serviceUrl: process.env.WAYFORPAY_SERVICE_URL,
      });

      // Страховка для правильного serviceUrl и структуры полей
      paymentData.merchantAuthType = "SimpleSignature";
      paymentData.returnUrl = returnUrl;
      paymentData.serviceUrl = process.env.WAYFORPAY_SERVICE_URL;

      // console.log("Payment data created:", paymentData);

      // Уведомление в Telegram будет отправлено только после успешной оплаты через WayForPay callback

      // ВАЖНО: hosted-чекаут идёт на secure.wayforpay.com/pay
      res.status(201).json({
         id,
         status: "pending",
         cv_filename: cvFilename,
         message: "Order created successfully",
         payment_url:
            process.env.WAYFORPAY_API_URL || "https://secure.wayforpay.com/pay",
         payment_data: paymentData,
      });
   } catch (e) {
      console.error("Error in /orders:", e);
      next(e);
   }
});

// // Создание заказа
// app.post("/orders", upload.any(), async (req, res, next) => {
//    // console.log(
//       "DEBUG files:",
//       Array.isArray(req.files)
//          ? req.files.map((f) => ({
//               field: f.fieldname,
//               name: f.originalname,
//               stored: f.filename,
//            }))
//          : req.files,
//       "bodyKeys:",
//       Object.keys(req.body || {})
//    );
//    try {
//       const { email, total_amount, currency = "EUR" } = req.body || {};
//       if (!email || !total_amount)
//          return res
//             .status(400)
//             .json({ error: "email and total_amount required" });
//       const id = uuid();
//       const cvFilename = req.file ? req.file.filename : null;

//       await getPool().query(
//          "INSERT INTO orders (id, email, total_amount, currency, status, cv_filename) VALUES (?, ?, ?, ?, 'pending',?)",
//          [id, email, Number(total_amount), currency, cvFilename]
//       );
//       res.status(201).json({ id, status: "pending", cv_filename: cvFilename });
//    } catch (e) {
//       next(e);
//    }
// });

// Получить 1 заказ
app.get("/orders/:id", async (req, res, next) => {
   try {
      const [rows] = await getPool().query(
         "SELECT * FROM orders WHERE id = ?",
         [req.params.id]
      );
      if (!rows.length)
         return res.status(404).json({ error: "Order not found" });
      res.json(rows[0]);
   } catch (e) {
      next(e);
   }
});

// Список
app.get("/orders", async (req, res, next) => {
   try {
      const limit = Math.min(Number(req.query.limit) || 20, 100);
      const offset = Number(req.query.offset) || 0;
      const [rows] = await getPool().query(
         "SELECT * FROM orders ORDER BY created_at DESC LIMIT ? OFFSET ?",
         [limit, offset]
      );
      res.json(rows);
   } catch (e) {
      next(e);
   }
});

// ===== WayForPay Callback Handler =====
async function wayforpayCallbackHandler(req, res) {
   try {
      const secret = process.env.WAYFORPAY_SECRET_KEY;
      if (!secret) {
         console.error("WAYFORPAY_SECRET_KEY is missing");
         return res.status(500).json({ error: "Server misconfigured" });
      }

      // body уже распарсен в роутах
      const body = req.body || {};

      // Если body содержит распарсенные данные от extractWfpBody, используем их
      if (body.orderReference && body.transactionStatus) {
         // Данные уже распарсены, используем как есть
      } else {
         // Fallback: пытаемся распарсить самостоятельно
         const parsedBody = extractWfpBody(req);
         if (parsedBody.orderReference) {
            Object.assign(body, parsedBody);
         }
      }

      // Усиленные безопасные логи с якорями
      const ct = req.headers["content-type"] || "unknown";
      // console.log(
      //    `[WFP] CB IN { ct: '${ct}', orderReference: '${
      //       body.orderReference || "unknown"
      //    }', transactionStatus: '${
      //       body.transactionStatus || "unknown"
      //    }', amount: '${body.amount || "unknown"}', currency: '${
      //       body.currency || "unknown"
      //    }', reasonCode: '${body.reasonCode || "unknown"}' }`
      // );

      // Логируем только безопасные данные (без сырых тел)
      const safeBody = {
         orderReference: body.orderReference,
         transactionStatus: body.transactionStatus,
         amount: body.amount,
         currency: body.currency,
         reasonCode: body.reasonCode,
         authCode: body.authCode ? "***" + body.authCode.slice(-4) : null,
         cardPan: body.cardPan ? "****" + body.cardPan.slice(-4) : null,
      };
      // console.log("Safe callback data:", JSON.stringify(safeBody, null, 2));

      // Записываем в таблицу аудит-логов
      try {
         const last4 =
            typeof body.cardPan === "string" ? body.cardPan.slice(-4) : null;
         await getPool().query(
            `INSERT INTO payments_wfp
             (order_id, transaction_status, reason_code, amount, currency, merchant_account, card_pan_last4, raw)
             VALUES (?, ?, ?, ?, ?, ?, ?, CAST(? AS JSON))`,
            [
               body.orderReference || "unknown",
               body.transactionStatus || null,
               Number(body.reasonCode) || null,
               Number(Number(body.amount).toFixed(2)) || null,
               body.currency || null,
               body.merchantAccount || null,
               last4 ? `****${last4}` : null,
               JSON.stringify({
                  orderReference: body.orderReference,
                  transactionStatus: body.transactionStatus,
                  reasonCode: body.reasonCode,
                  amount: body.amount,
                  currency: body.currency,
                  createdDate: body.createdDate,
                  processingDate: body.processingDate,
               }),
            ]
         );
      } catch (e) {
         console.warn("[WFP] audit insert failed:", e.message);
      }

      // 1) Проверяем подпись коллбека
      // Проверка валюты в зависимости от режима
      const expectedCurrency = IS_TEST ? "UAH" : "EUR";
      if (body.currency !== expectedCurrency) {
         console.warn(
            `Currency mismatch: expected ${expectedCurrency}, got ${body.currency}`
         );
         return res.status(400).json({ error: "Currency mismatch" });
      }

      const isValid = verifyCallbackSignature(body, secret);
      // console.log(
      //    `[WFP] signature ${isValid ? "OK" : "FAIL"} <${
      //       body.orderReference || "unknown"
      //    }>`
      // );
      if (!isValid) {
         console.warn("WayForPay signature INVALID");
         // console.log("Callback body:", JSON.stringify(body, null, 2));
         return res.status(400).json({ error: "Invalid signature" });
      }

      // 2) Проверяем существование заказа и его текущий статус
      const [existingOrders] = await getPool().query(
         "SELECT * FROM orders WHERE id = ?",
         [body.orderReference]
      );

      if (existingOrders.length === 0) {
         console.warn("Order not found:", body.orderReference);
         return res.status(404).json({ error: "Order not found" });
      }

      const order = existingOrders[0];

      // 3) Проверяем идемпотентность - заказ уже оплачен?
      if (order.status === "paid") {
         // console.log(
         //    "Order already paid, skipping duplicate callback:",
         //    body.orderReference
         // );
         // Возвращаем успешный ответ, но не обрабатываем повторно
         const time = Math.floor(Date.now() / 1000);
         const acceptPayload = {
            orderReference: body.orderReference,
            status: "accept",
            time,
            signature: signJoined(
               [body.orderReference, "accept", time],
               secret
            ),
         };
         return res.status(200).json(acceptPayload);
      }

      // 4) Валидация суммы платежа в зависимости от режима
      let expectedAmount;
      if (IS_TEST) {
         // тест: конвертируем EUR в UAH
         const rate = Number(process.env.EUR2UAH || 40);
         expectedAmount =
            order.currency === "EUR"
               ? Number((Number(order.total_amount) * rate).toFixed(2))
               : Number(Number(order.total_amount).toFixed(2));
      } else {
         // прод: чистый EUR
         expectedAmount = Number(Number(order.total_amount).toFixed(2));
      }

      const receivedAmount = Number(Number(body.amount).toFixed(2));
      if (receivedAmount !== expectedAmount) {
         console.error("Amount mismatch:", {
            expected: expectedAmount,
            received: receivedAmount,
            orderId: body.orderReference,
         });
         return res.status(400).json({ error: "Amount mismatch" });
      }

      // 5) Фиксируем платёж в БД (только Approved)
      const approved =
         String(body.transactionStatus).toLowerCase() === "approved";

      if (approved) {
         // Обновляем статус заказа на "paid" с проверкой, что он еще не оплачен
         const [updateResult] = await getPool().query(
            "UPDATE orders SET status = 'paid' WHERE id = ? AND status != 'paid'",
            [body.orderReference]
         );

         // Проверяем, был ли заказ обновлен (защита от гонок данных)
         if (updateResult.affectedRows === 0) {
            // console.log(
            //    "Order already processed by another callback:",
            //    body.orderReference
            // );
            const time = Math.floor(Date.now() / 1000);
            const acceptPayload = {
               orderReference: body.orderReference,
               status: "accept",
               time,
               signature: signJoined(
                  [body.orderReference, "accept", time],
                  secret
               ),
            };
            return res.status(200).json(acceptPayload);
         }

         // Отправляем уведомление в Telegram после успешной оплаты
         const filePath = order.cv_filename
            ? path.join(uploadDir, order.cv_filename)
            : null;

         sendOrderNotification(order, filePath).catch((error) => {
            console.error("Ошибка отправки в Telegram после оплаты:", error);
         });
      } else {
         // Обновляем статус заказа на "failed"
         await getPool().query(
            "UPDATE orders SET status = 'failed' WHERE id = ?",
            [body.orderReference]
         );
      }

      // 6) Формируем accept-ответ
      // console.log(
      //    `[WFP] ACK <${body.orderReference || "unknown"}> ${
      //       approved ? "approved" : "declined"
      //    }`
      // );

      const time = Math.floor(Date.now() / 1000);
      const acceptPayload = {
         orderReference: body.orderReference,
         status: "accept",
         time,
         signature: signJoined([body.orderReference, "accept", time], secret),
      };

      // 7) Возвращаем строго JSON (application/json) и 200
      return res.status(200).json(acceptPayload);
   } catch (err) {
      console.error("WayForPay callback error:", err);
      return res.status(500).json({ error: "Internal error" });
   }
}

// WayForPay Callback - обработка результата оплаты
app.post(
   "/payments/wayforpay/callback",
   express.urlencoded({ extended: false }),
   async (req, res) => {
      const secret = process.env.WAYFORPAY_SECRET_KEY;
      if (!secret)
         return res.status(500).json({ error: "Server misconfigured" });

      const body = extractWfpBody(req); // ← вот он, "правильный" JSON

      // console.log("[WFP] CB IN:", {
      //    path: req.originalUrl,
      //    ct: req.headers["content-type"],
      //    orderReference: body.orderReference,
      //    transactionStatus: body.transactionStatus,
      //    amount: body.amount,
      //    currency: body.currency,
      //    reasonCode: body.reasonCode,
      // });

      // console.log("=== WayForPay Callback (parsed) ===", {
      //    orderReference: body.orderReference,
      //    transactionStatus: body.transactionStatus,
      //    amount: body.amount,
      //    currency: body.currency,
      //    reasonCode: body.reasonCode,
      // });

      // Вызываем основную логику обработки
      return wayforpayCallbackHandler(req, res);
   }
);
// Безопасный алиас (если когда-то перестанешь «срезать» /api/)
app.post(
   "/api/payments/wayforpay/callback",
   express.urlencoded({ extended: false }),
   async (req, res) => {
      const secret = process.env.WAYFORPAY_SECRET_KEY;
      if (!secret)
         return res.status(500).json({ error: "Server misconfigured" });

      const body = extractWfpBody(req); // ← вот он, "правильный" JSON

      // console.log("[WFP] CB IN:", {
      //    path: req.originalUrl,
      //    ct: req.headers["content-type"],
      //    orderReference: body.orderReference,
      //    transactionStatus: body.transactionStatus,
      //    amount: body.amount,
      //    currency: body.currency,
      //    reasonCode: body.reasonCode,
      // });

      // console.log("=== WayForPay Callback (parsed) ===", {
      //    orderReference: body.orderReference,
      //    transactionStatus: body.transactionStatus,
      //    amount: body.amount,
      //    currency: body.currency,
      //    reasonCode: body.reasonCode,
      // });

      // Вызываем основную логику обработки
      return wayforpayCallbackHandler(req, res);
   }
);

// Тестовый endpoint для симуляции успешного платежа (только для разработки)
app.post("/test/payment/success/:orderId", async (req, res, next) => {
   try {
      const orderId = req.params.orderId;
      // console.log("=== Тестовая симуляция успешного платежа ===");
      // console.log("Order ID:", orderId);

      // Проверяем существование заказа
      const [existingOrders] = await getPool().query(
         "SELECT * FROM orders WHERE id = ?",
         [orderId]
      );

      if (existingOrders.length === 0) {
         return res.status(404).json({ error: "Order not found" });
      }

      const order = existingOrders[0];

      // Проверяем, что заказ еще не оплачен
      if (order.status === "paid") {
         return res.status(400).json({ error: "Order already paid" });
      }

      // Обновляем статус заказа на "paid"
      await getPool().query(
         "UPDATE orders SET status = 'paid' WHERE id = ? AND status != 'paid'",
         [orderId]
      );

      // Отправляем уведомление в Telegram
      const filePath = order.cv_filename
         ? path.join(uploadDir, order.cv_filename)
         : null;

      sendOrderNotification(order, filePath).catch((error) => {
         console.error("Ошибка отправки в Telegram:", error);
      });

      // console.log("✅ Заказ успешно оплачен (тест)");
      res.json({
         success: true,
         message: "Payment simulated successfully",
         orderId: orderId,
         status: "paid",
      });
   } catch (err) {
      console.error("Test payment simulation error:", err);
      res.status(500).json({ error: "Internal error" });
   }
});

// Проверка статуса заказа
app.get("/orders/:id/status", async (req, res, next) => {
   try {
      const [rows] = await getPool().query(
         "SELECT id, status, total_amount, currency FROM orders WHERE id = ?",
         [req.params.id]
      );

      if (!rows.length) {
         return res.status(404).json({ error: "Order not found" });
      }

      const order = rows[0];
      res.json({
         id: order.id,
         status: order.status,
         total_amount: order.total_amount,
         currency: order.currency,
         is_paid: order.status === "paid",
      });
   } catch (e) {
      next(e);
   }
});

// Получение данных для платёжного виджета
app.get("/orders/:id/widget", async (req, res, next) => {
   try {
      const [rows] = await getPool().query(
         "SELECT * FROM orders WHERE id = ?",
         [req.params.id]
      );

      if (!rows.length) {
         return res.status(404).json({ error: "Order not found" });
      }

      const order = rows[0];

      // Проверяем, что заказ еще не оплачен
      if (order.status === "paid") {
         return res.status(400).json({ error: "Order already paid" });
      }

      // Создаем данные для виджета
      const orderDate = Math.floor(new Date(order.created_at).getTime() / 1000);
      const amountInUAH =
         order.currency === "EUR"
            ? Math.round(Number(order.total_amount) * 40)
            : Number(order.total_amount);

      // Парсим корзину для получения продуктов
      let productName, productCount, productPrice;

      if (order.cart) {
         try {
            const cart = JSON.parse(order.cart);
            if (Array.isArray(cart) && cart.length > 0) {
               productName = cart.map(
                  (item) => item.name || item.title || "Товар"
               );
               productCount = cart.map(
                  (item) => item.count || item.quantity || 1
               );
               productPrice = cart.map((item) => item.price || item.cost || 0);
            } else {
               productName = [`CV Order #${order.id}`];
               productCount = [1];
               productPrice = [amountInUAH];
            }
         } catch (e) {
            productName = [`CV Order #${order.id}`];
            productCount = [1];
            productPrice = [amountInUAH];
         }
      } else {
         productName = [`CV Order #${order.id}`];
         productCount = [1];
         productPrice = [amountInUAH];
      }

      const widgetData = wayForPay.createWidgetData({
         orderReference: order.id,
         orderDate,
         amount: amountInUAH,
         currency: "UAH",
         productName,
         productCount,
         productPrice,
         clientFirstName: order.name || "",
         clientLastName: order.surname || "",
         clientEmail: order.email,
         clientPhone: order.phone || "",
      });

      res.json({
         order_id: order.id,
         widget_data: widgetData,
         amount: amountInUAH,
         currency: "UAH",
      });
   } catch (e) {
      next(e);
   }
});
// после всех роутов:
app.use((err, _req, res, next) => {
   if (err?.code === "LIMIT_FILE_SIZE") {
      return res.status(413).json({ error: "File too large (max 5MB)" });
   }
   if (err?.message === "Unsupported file type") {
      return res.status(400).json({
         error: "Unsupported file type. Allowed: pdf, doc, docx, txt, rtf",
      });
   }
   return next(err);
});

// 404
app.use((_req, res) => res.status(404).json({ error: "Not found" }));

// ОБРАБОТЧИК ОШИБОК — чтобы не было reset by peer
// eslint-disable-next-line no-unused-vars
app.use((err, _req, res, _next) => {
   console.error(err);
   res.status(500).json({ error: err.message || "Server error" });
});

// Без сюрпризов со слушателем
const port = Number(process.env.PORT) || 3000;
app.listen(port, "0.0.0.0", () => console.log(`API on http://0.0.0.0:${port}`)); // Оставляем этот лог для запуска сервера

// Страховка, чтобы процесс не падал молча
process.on("unhandledRejection", (r) =>
   console.error("unhandledRejection:", r)
);
process.on("uncaughtException", (e) => console.error("uncaughtException:", e));
