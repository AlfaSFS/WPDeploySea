(function () {
   // Настраиваем отступ динамично (например, под высоту фикс-хедера)
   function getScrollOffset() {
      const header = document.querySelector(
         ".site-header.is-sticky, .site-header.sticky, header.sticky"
      );
      return header ? Math.ceil(header.getBoundingClientRect().height) : 60; // fallback = 60
   }

   function smoothScrollTo(el, offset) {
      const top = el.getBoundingClientRect().top + window.pageYOffset - offset;
      window.scrollTo({ top, behavior: "smooth" });
   }

   // Обновляем CSS-переменную, чтобы работал scroll-margin-top
   function applyScrollOffsetVar() {
      document.documentElement.style.setProperty(
         "--scroll-offset",
         getScrollOffset() + "px"
      );
   }

   // Клик по «умным» ссылкам: если якорь есть на странице — скроллим, иначе — обычная навигация
   document.addEventListener("click", function (e) {
      const a = e.target.closest('a.js-smart-scroll[href*="#"]');
      if (!a) return;

      const url = new URL(a.href, location.origin);
      const hash = url.hash; // например, "#pricing"
      if (!hash) return;

      // Проверяем, ссылается ли ссылка на главную страницу
      const isHomePageLink =
         url.pathname === "/" ||
         url.pathname === "" ||
         url.pathname === location.pathname;

      // Проверяем, является ли это относительной ссылкой с якорем (например, #about)
      const isRelativeAnchorLink =
         a.getAttribute("href").startsWith("#") &&
         !a.getAttribute("href").startsWith("/#");

      const target = document.querySelector(hash);
      if (target) {
         e.preventDefault(); // остаёмся на этой же странице
         applyScrollOffsetVar();
         smoothScrollTo(target, getScrollOffset());
         history.pushState(null, "", hash); // обновим адресную строку (без перезагрузки)
      } else if (isHomePageLink || isRelativeAnchorLink) {
         // Если это ссылка на главную страницу с якорем или относительная ссылка с якорем
         // Переходим на главную страницу
         const homeUrl = location.origin + "/" + hash;
         window.location.href = homeUrl;
      }
      // Если target отсутствует и это не ссылка на главную — ничего не делаем: браузер перейдёт сам
   });

   // Если мы уже на главной и пришли с #hash — прокрутим с отступом после загрузки
   window.addEventListener("load", function () {
      applyScrollOffsetVar();
      if (location.hash) {
         const target = document.querySelector(location.hash);
         if (target) {
            // Небольшая задержка — полезно, если шрифты/изображения меняют высоту хедера
            setTimeout(() => smoothScrollTo(target, getScrollOffset()), 100);
         }
      }
   });

   // При ресайзе пересчитаем отступ (если высота хедера меняется)
   window.addEventListener("resize", applyScrollOffsetVar);
})();
