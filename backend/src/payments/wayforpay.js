import crypto from "crypto";

class WayForPay {
   constructor(config) {
      this.merchantAccount = config.merchantAccount;
      this.secretKey = config.secretKey;
      this.domainName = config.domainName;
      this.apiUrl = config.apiUrl;
      this.callbackUrl = config.callbackUrl;
      this.returnUrl = config.returnUrl;
   }

   /**
    * Создание подписи для запроса
    */
   createPurchaseSignature(data) {
      const as2 = (x) => Number(x).toFixed(2);
      const productNames = Array.isArray(data.productName)
         ? data.productName
         : [data.productName];
      const productCounts = Array.isArray(data.productCount)
         ? data.productCount
         : [data.productCount];
      const productPrices = Array.isArray(data.productPrice)
         ? data.productPrice
         : [data.productPrice];
      const signatureString = [
         data.merchantAccount,
         data.merchantDomainName,
         data.orderReference,
         String(data.orderDate),
         as2(data.amount),
         data.currency,
         ...productNames.map(String),
         ...productCounts.map((n) => String(n)),
         ...productPrices.map(as2),
      ].join(";");
      return crypto
         .createHmac("md5", this.secretKey)
         .update(signatureString, "utf8")
         .digest("hex");
   }
   /**
    * Создание подписи для виджета (с поддержкой массивов продуктов)
    */
   createWidgetSignature(data) {
      // Для виджета подпись создается по схеме: merchantAccount;merchantDomainName;orderReference;orderDate;amount;currency;productName[0];...;productName[n];productCount[0];...;productCount[n];productPrice[0];...;productPrice[n]
      const signatureString = [
         data.merchantAccount,
         data.merchantDomainName,
         data.orderReference,
         data.orderDate,
         data.amount,
         data.currency,
         ...(Array.isArray(data.productName)
            ? data.productName
            : [data.productName]),
         ...(Array.isArray(data.productCount)
            ? data.productCount
            : [data.productCount]),
         ...(Array.isArray(data.productPrice)
            ? data.productPrice
            : [data.productPrice]),
      ].join(";");

      return crypto
         .createHmac("md5", this.secretKey)
         .update(signatureString, "utf8")
         .digest("hex");
   }

   /**
    * Создание платежной формы
    */
   createPaymentForm(orderData) {
      const {
         orderReference,
         orderDate,
         amount,
         currency = "UAH",
         productName,
         productCount = 1,
         productPrice,
         clientFirstName,
         clientLastName,
         clientEmail,
         clientPhone,
      } = orderData;

      const paymentData = {
         merchantAccount: this.merchantAccount,
         merchantDomainName: this.domainName.replace(/^https?:\/\//, ""),
         merchantTransactionType: "AUTO",
         merchantTransactionSecureType: "AUTO",
         orderReference,
         orderDate,
         amount,
         currency,
         clientFirstName,
         clientLastName,
         clientEmail,
         clientPhone,
         returnUrl: this.returnUrl,
         serviceUrl: this.callbackUrl,
      };

      // Поддержка массивов продуктов
      if (Array.isArray(productName)) {
         // Новый формат с массивом продуктов
         paymentData.productName = productName;
         paymentData.productCount = productCount;
         paymentData.productPrice = productPrice;
      } else {
         // Старый формат с одним продуктом
         paymentData.productName = productName;
         paymentData.productCount = productCount;
         paymentData.productPrice = productPrice;
      }

      // Добавляем обязательное поле merchantAuthType
      paymentData.merchantAuthType = "SimpleSignature";
      // Добавляем подпись
      paymentData.merchantSignature = this.createPurchaseSignature(paymentData);

      return paymentData;
   }

   /**
    * Создание данных для платёжного виджета
    */
   createWidgetData(orderData) {
      const {
         orderReference,
         orderDate,
         amount,
         currency = "UAH",
         productName,
         productCount = 1,
         productPrice,
         clientFirstName,
         clientLastName,
         clientEmail,
         clientPhone,
      } = orderData;

      const widgetData = {
         merchantAccount: this.merchantAccount,
         merchantDomainName: this.domainName.replace(/^https?:\/\//, ""),
         authorizationType: "SimpleSignature",
         orderReference,
         orderDate,
         amount,
         currency,
         clientFirstName,
         clientLastName,
         clientEmail,
         clientPhone,
         language: "UA",
         returnUrl: this.returnUrl,
         serviceUrl: this.callbackUrl,
      };

      // Поддержка массивов продуктов
      if (Array.isArray(productName)) {
         // Новый формат с массивом продуктов
         widgetData.productName = productName;
         widgetData.productCount = productCount;
         widgetData.productPrice = productPrice;
      } else {
         // Старый формат с одним продуктом
         widgetData.productName = productName;
         widgetData.productCount = productCount;
         widgetData.productPrice = productPrice;
      }

      // Добавляем подпись для виджета
      widgetData.merchantSignature = this.createWidgetSignature(widgetData);

      return widgetData;
   }

   /**
    * Проверка подписи callback'а
    */
   verifyCallback(callbackData) {
      const { signature, ...dataToVerify } = callbackData;

      // Для callback подпись создается по другой схеме
      const signatureString = [
         dataToVerify.merchantAccount,
         dataToVerify.orderReference,
         dataToVerify.amount,
         dataToVerify.currency,
         dataToVerify.authCode,
         dataToVerify.cardPan,
         dataToVerify.transactionStatus,
         dataToVerify.reasonCode,
      ].join(";");

      const calculatedSignature = crypto
         .createHmac("md5", this.secretKey)
         .update(signatureString, "utf8")
         .digest("hex");

      return signature === calculatedSignature;
   }

   /**
    * Обработка callback от WayForPay
    */
   processCallback(callbackData) {
      if (!this.verifyCallback(callbackData)) {
         throw new Error("Invalid signature in callback");
      }

      const {
         orderReference,
         transactionStatus,
         reasonCode,
         reason,
         amount,
         currency,
         authCode,
         rrn,
         approvalCode,
      } = callbackData;

      return {
         orderReference,
         status: transactionStatus,
         reasonCode,
         reason,
         amount,
         currency,
         authCode,
         rrn,
         approvalCode,
         isSuccess: transactionStatus === "Approved",
      };
   }

   /**
    * Получение статуса транзакции
    */
   async getTransactionStatus(orderReference) {
      const requestData = {
         transactionType: "CHECK_STATUS",
         merchantAccount: this.merchantAccount,
         orderReference,
         merchantSignature: "",
      };

      // Создаем подпись для запроса статуса
      const { merchantSignature, ...dataToSign } = requestData;
      requestData.merchantSignature = this.createSignature(dataToSign);

      try {
         const response = await fetch(this.apiUrl, {
            method: "POST",
            headers: {
               "Content-Type": "application/json",
            },
            body: JSON.stringify(requestData),
         });

         const result = await response.json();

         if (result.reasonCode !== 1100) {
            throw new Error(`WayForPay API error: ${result.reason}`);
         }

         return {
            orderReference: result.orderReference,
            status: result.transactionStatus,
            amount: result.amount,
            currency: result.currency,
            isSuccess: result.transactionStatus === "Approved",
         };
      } catch (error) {
         console.error("Error checking transaction status:", error);
         throw error;
      }
   }
}

export default WayForPay;
