const WayForPay = require('./wayforpay');

/**
 * Инициализация WayForPay
 */
function initWayForPay() {
   const config = {
      merchantAccount: process.env.WAYFORPAY_MERCHANT_ACCOUNT,
      secretKey: process.env.WAYFORPAY_SECRET_KEY,
      domainName: process.env.WAYFORPAY_DOMAIN_NAME,
      apiUrl:
         process.env.WAYFORPAY_API_URL || "https://secure.wayforpay.com/pay",
      callbackUrl: process.env.WAYFORPAY_CALLBACK_URL,
      returnUrl: process.env.WAYFORPAY_RETURN_URL,
   };

   // Проверяем наличие обязательных переменных
   const requiredVars = ["merchantAccount", "secretKey", "domainName"];
   const missingVars = requiredVars.filter((varName) => !config[varName]);

   if (missingVars.length > 0) {
      console.warn(
         `Warning: Missing WayForPay configuration: ${missingVars.join(", ")}`
      );
      return null;
   }

   return new WayForPay(config);
}

/**
 * Создание платежной формы
 */
function createPaymentForm(orderData) {
   const wayForPay = initWayForPay();
   if (!wayForPay) {
      throw new Error("WayForPay not configured");
   }

   return wayForPay.createPaymentForm(orderData);
}

/**
 * Обработка callback от WayForPay
 */
function processPaymentCallback(callbackData) {
   const wayForPay = initWayForPay();
   if (!wayForPay) {
      throw new Error("WayForPay not configured");
   }

   return wayForPay.processCallback(callbackData);
}

/**
 * Проверка статуса транзакции
 */
async function checkTransactionStatus(orderReference) {
   const wayForPay = initWayForPay();
   if (!wayForPay) {
      throw new Error("WayForPay not configured");
   }

   return await wayForPay.getTransactionStatus(orderReference);
}

module.exports = {
   WayForPay,
   initWayForPay,
   createPaymentForm,
   processPaymentCallback,
   checkTransactionStatus,
};
