const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");

hamburger.addEventListener("click", () => {
   navLinks.classList.toggle("active");
   hamburger.classList.toggle("open"); // можно анимировать иконку
});
// Навешиваем обработчик на все ссылки внутри nav-links
const allLinks = navLinks.querySelectorAll("a.ancor");

Array.from(allLinks).forEach((link) => {
   link.addEventListener("click", () => {
      if (window.innerWidth < 1281) {
         // Закрываем меню и крестик
         navLinks.classList.remove("active");
         hamburger.classList.remove("open");
      }
   });
});
