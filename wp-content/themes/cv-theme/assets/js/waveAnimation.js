// Анимация волн в футере
document.addEventListener("DOMContentLoaded", function () {
   const container = document.getElementById("waveContainer");

   if (!container) {
      return;
   }

   // Создаем горизонтальные линии разной толщины
   for (let i = 0; i < 20; i++) {
      const segment = document.createElement("div");
      segment.classList.add("wave-segment");
      segment.style.height = `${2 + Math.random() * 6}px`; // толщина 2–8px
      segment.style.top = `${i * 12}px`; // отступ сверху
      container.appendChild(segment);
   }

   // Анимация волны
   function animateWave() {
      const segments = document.querySelectorAll(".wave-segment");
      const time = Date.now() / 400;

      segments.forEach((seg, i) => {
         const offset = Math.sin(time + i * 0.5) * 20; // амплитуда
         seg.style.transform = `translateY(${offset}px)`;
      });

      requestAnimationFrame(animateWave);
   }

   animateWave();
});
