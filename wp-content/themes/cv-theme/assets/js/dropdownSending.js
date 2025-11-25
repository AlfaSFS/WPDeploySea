document.addEventListener("DOMContentLoaded", () => {
   const overlay = document.querySelector(".site-overlay");
   const header = document.querySelector(".site-header");
   const nav = document.querySelector(".site-nav");
   const main = document.querySelector("main");

   if (!overlay || !header || !nav) return;

   const openItem = (li) => {
      // закрыть другие
      nav.querySelectorAll(".nav-item.dropdown.is-open").forEach(
         (el) => el !== li && closeItem(el)
      );

      li.classList.add("is-open");
      document.body.classList.add("dropdown-open");

      const toggle = li.querySelector(".dropdown-toggle");
      const panel = li.querySelector(".dropdown-menu");
      toggle?.setAttribute("aria-expanded", "true");
      panel?.removeAttribute("hidden");

      // изолируем фокус от основного контента
      main?.setAttribute("inert", "");
      main?.setAttribute("aria-hidden", "true");
   };

   const closeItem = (li) => {
      li.classList.remove("is-open");
      li.querySelector(".dropdown-toggle")?.setAttribute(
         "aria-expanded",
         "false"
      );
      li.querySelector(".dropdown-menu")?.setAttribute("hidden", "");
   };

   const closeAll = () => {
      nav.querySelectorAll(".nav-item.dropdown.is-open").forEach(closeItem);
      document.body.classList.remove("dropdown-open");
      main?.removeAttribute("inert");
      main?.removeAttribute("aria-hidden");
   };

   // Делегирование клика по любому .dropdown-toggle
   nav.addEventListener("click", (e) => {
      const toggle = e.target.closest(".nav-item.dropdown > .dropdown-toggle");
      if (!toggle) return;
      e.preventDefault(); // не прыгать по ссылке "#"
      const li = toggle.closest(".nav-item.dropdown");
      li.classList.contains("is-open") ? closeAll() : openItem(li);
   });

   // Делегирование клика по ссылкам внутри dropdown меню
   nav.addEventListener("click", (e) => {
      const link = e.target.closest(".dropdown-menu a");
      if (!link) return;

      // Проверяем, что это не ссылка с href="#"
      if (link.getAttribute("href") !== "#") {
         // Закрываем все открытые dropdown меню
         closeAll();
      }
   });

   // Клик по оверлею/вне хедера — закрыть
   overlay.addEventListener("click", closeAll);
   document.addEventListener("click", (e) => {
      if (!header.contains(e.target)) closeAll();
   });

   // Esc — закрыть
   document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") closeAll();
   });

   // Простая ловушка таба внутри хедера при открытом меню
   document.addEventListener("keydown", (e) => {
      if (e.key !== "Tab" || !document.body.classList.contains("dropdown-open"))
         return;
      const focusables = header.querySelectorAll(
         'a,button,[tabindex]:not([tabindex="-1"]),input,select,textarea'
      );
      if (!focusables.length) return;
      const first = focusables[0],
         last = focusables[focusables.length - 1];
      if (e.shiftKey && document.activeElement === first) {
         e.preventDefault();
         last.focus();
      } else if (!e.shiftKey && document.activeElement === last) {
         e.preventDefault();
         first.focus();
      }
   });
});
