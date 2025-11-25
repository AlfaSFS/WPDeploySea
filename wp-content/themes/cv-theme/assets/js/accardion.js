document.querySelectorAll(".faq-question").forEach((button) => {
   button.addEventListener("click", () => {
      const item = button.parentElement;

      // закрываем другие
      document.querySelectorAll(".faq-item").forEach((i) => {
         if (i !== item) i.classList.remove("active");
      });

      // переключаем текущий
      item.classList.toggle("active");
   });
});
