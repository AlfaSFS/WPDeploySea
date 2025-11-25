// Проверяем, что DOM загружен
document.addEventListener("DOMContentLoaded", function () {
   const stepImage = document.getElementById("step-image");
   const steps = document.querySelectorAll(".step");
   const myBlock = document.querySelector("#steps");

   // Проверяем существование всех необходимых элементов
   if (!stepImage || !steps.length || !myBlock) {
      return;
   }

   let currentImage = stepImage.src;

   // Функция для обновления изображения
   function updateStepImage() {
      let activeStep = steps[0];

      steps.forEach((step) => {
         const rect = step.getBoundingClientRect();
         if (rect.top < window.innerHeight / 2) {
            activeStep = step;
         }
      });

      const newImage = activeStep.dataset.image;
      if (newImage && newImage !== currentImage) {
         stepImage.style.opacity = 0;
         setTimeout(() => {
            stepImage.src = newImage;
            stepImage.style.opacity = 1;
            currentImage = newImage;
         }, 150);
      }
   }

   // Добавляем обработчик скролла с throttling для оптимизации
   let scrollTimeout;
   window.addEventListener("scroll", () => {
      if (scrollTimeout) {
         clearTimeout(scrollTimeout);
      }
      scrollTimeout = setTimeout(updateStepImage, 10);
   });

   // Инициализация при загрузке
   updateStepImage();
});
