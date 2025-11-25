// Скрипт для закрытия мобильного меню на странице sending при клике на dropdown ссылки
document.addEventListener("DOMContentLoaded", function () {
   // Проверяем, что мы на странице sending (можно проверить через URL или класс body)
   const isSendingPage =
      document.body.classList.contains("page-template-page-sending") ||
      window.location.pathname.includes("/sending/") ||
      document.querySelector(".sender-block");

   if (!isSendingPage) return;

   const navLinks = document.querySelector(".nav-links");
   const hamburger = document.querySelector(".hamburger");
   const dropdownMenu = document.querySelector(".dropdown-menu.sending");

   // Проверяем наличие всех элементов
   if (!navLinks || !hamburger || !dropdownMenu) return;

   // Функция для проверки размера экрана
   function isMobileScreen() {
      return window.innerWidth < 1281;
   }

   // Функция для закрытия мобильного меню
   function closeMobileMenu() {
      navLinks.classList.remove("active");
      hamburger.classList.remove("open");
   }

   // Обработчик для ссылок в dropdown меню
   const dropdownLinks = dropdownMenu.querySelectorAll("a");

   dropdownLinks.forEach(function (link) {
      link.addEventListener("click", function (e) {
         // Опционально: добавляем небольшую задержку для плавности
         setTimeout(function () {
            if (isMobileScreen()) {
               closeMobileMenu();
            }
         }, 100);
      });
   });

   // Дополнительно: закрываем меню при изменении размера окна если оно было открыто
   window.addEventListener("resize", function () {
      if (!isMobileScreen() && navLinks.classList.contains("active")) {
         closeMobileMenu();
      }
   });
});
