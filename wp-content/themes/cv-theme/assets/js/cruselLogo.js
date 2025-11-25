const track = document.querySelector(".logos-slides");
let index = 0;

function moveCarousel() {
   const itemWidth = track.querySelector("img").offsetWidth + 20; // ширина + отступ
   index++;
   track.style.transform = `translateX(${-itemWidth * index}px)`;

   if (index >= track.children.length) {
      // сброс (бесконечный цикл)
      index = 0;
      setTimeout(() => {
         track.style.transition = "none";
         track.style.transform = "translateX(0)";
         void track.offsetWidth; // reflow hack
         track.style.transition = "transform 0.5s ease";
      }, 500);
   }
}

setInterval(moveCarousel, 2000);
