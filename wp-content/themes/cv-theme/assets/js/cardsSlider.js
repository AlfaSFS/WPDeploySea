document.addEventListener("DOMContentLoaded", function () {
   if (window.innerWidth <= 767) {
     const sliders = document.querySelectorAll(".slider");
 
     sliders.forEach((slider) => {
       const track = slider.querySelector(".slider-track");
       const slides = slider.querySelectorAll(".slide");
       const prevBtn = slider.querySelector(".slider-btn.prev");
       const nextBtn = slider.querySelector(".slider-btn.next");
 
       if (!track || slides.length === 0) return;
 
       let index = 0;
       let step = 100 / slides.length;
 
       // Drag vars
       let startX = 0;
       let startY = 0;
       let currentX = 0;
       let isDragging = false;
       let startTransform = 0;
 
       // Directional lock
       let directionLocked = false;
       let isHorizontalIntent = false;
       const DIRECTION_THRESHOLD = 6; // px, чтобы определить направление
       const SWIPE_THRESHOLD = 50; // px для смены слайда
 
       function updateSlider() {
         const stepLocal = 100 / slides.length;
         track.style.transform = `translateX(-${index * stepLocal}%)`;
         updateButtons();
       }
 
       function updateButtons() {
         if (prevBtn) {
           if (index === 0) {
             prevBtn.disabled = true;
             prevBtn.style.opacity = "0.5";
             prevBtn.style.cursor = "not-allowed";
           } else {
             prevBtn.disabled = false;
             prevBtn.style.opacity = "1";
             prevBtn.style.cursor = "pointer";
           }
         }
 
         if (nextBtn) {
           if (index === slides.length - 1) {
             nextBtn.disabled = true;
             nextBtn.style.opacity = "0.5";
             nextBtn.style.cursor = "not-allowed";
           } else {
             nextBtn.disabled = false;
             nextBtn.style.opacity = "1";
             nextBtn.style.cursor = "pointer";
           }
         }
       }
 
       function goToSlide(newIndex) {
         if (newIndex < 0) newIndex = 0;
         if (newIndex >= slides.length) newIndex = slides.length - 1;
         index = newIndex;
         updateSlider();
       }
 
       if (prevBtn) {
         prevBtn.addEventListener("click", () => {
           if (index > 0) goToSlide(index - 1);
         });
       }
       if (nextBtn) {
         nextBtn.addEventListener("click", () => {
           if (index < slides.length - 1) goToSlide(index + 1);
         });
       }
 
       // ---------- Pointer events (preferred) ----------
       if (window.PointerEvent) {
         track.addEventListener(
           "pointerdown",
           (e) => {
             // только для touch/pen/mouse по назначению (finger/pen)
             if (e.pointerType === "mouse") return; // оставить mouse для desktop (мы обрабатываем ниже)
             track.setPointerCapture?.(e.pointerId);
             startX = e.clientX;
             startY = e.clientY;
             startTransform = -index * step;
             isDragging = true;
             directionLocked = false;
             isHorizontalIntent = false;
             currentX = startX;
             track.style.transition = "none";
           },
           { passive: true }
         );
 
         track.addEventListener(
           "pointermove",
           (e) => {
             if (!isDragging) return;
             if (e.pointerType === "mouse") return;
 
             currentX = e.clientX;
             const currentY = e.clientY;
             const dx = currentX - startX;
             const dy = currentY - startY;
 
             if (!directionLocked) {
               if (Math.abs(dx) < DIRECTION_THRESHOLD && Math.abs(dy) < DIRECTION_THRESHOLD) {
                 return;
               }
               directionLocked = true;
               isHorizontalIntent = Math.abs(dx) > Math.abs(dy);
             }
 
             if (!isHorizontalIntent) {
               // vertical intent — не мешаем нативному скроллу
               return;
             }
 
             // edge release: если на первом и тянем вправо (dx>0), или на последнем и тянем влево (dx<0), даём странице обработать
             const atFirst = index === 0 && dx > 0;
             const atLast = index === slides.length - 1 && dx < 0;
             if (atFirst || atLast) {
               return;
             }
 
             // Блокируем вертикальный скролл (pointer events, preventDefault() работает)
             e.preventDefault?.();
 
             const currentTransform = startTransform + (dx / track.offsetWidth) * 100;
             const minTransform = -(slides.length - 1) * step;
             const maxTransform = 0;
             const clampedTransform = Math.max(minTransform, Math.min(maxTransform, currentTransform));
             track.style.transform = `translateX(${clampedTransform}%)`;
           },
           { passive: false }
         );
 
         track.addEventListener(
           "pointerup",
           (e) => {
             if (!isDragging) return;
             if (e.pointerType === "mouse") return;
             try {
               track.releasePointerCapture?.(e.pointerId);
             } catch (err) {}
             finishDrag();
           },
           { passive: true }
         );
 
         track.addEventListener(
           "pointercancel",
           (e) => {
             if (!isDragging) return;
             finishDrag();
           },
           { passive: true }
         );
       } else {
         // ---------- Touch fallback ----------
         track.addEventListener(
           "touchstart",
           (e) => {
             const t = e.touches[0];
             startX = t.clientX;
             startY = t.clientY;
             startTransform = -index * step;
             isDragging = true;
             directionLocked = false;
             isHorizontalIntent = false;
             currentX = startX;
             track.style.transition = "none";
           },
           { passive: true }
         );
 
         track.addEventListener(
           "touchmove",
           (e) => {
             if (!isDragging) return;
             const t = e.touches[0];
             currentX = t.clientX;
             const currentY = t.clientY;
             const dx = currentX - startX;
             const dy = currentY - startY;
 
             if (!directionLocked) {
               if (Math.abs(dx) < DIRECTION_THRESHOLD && Math.abs(dy) < DIRECTION_THRESHOLD) {
                 return;
               }
               directionLocked = true;
               isHorizontalIntent = Math.abs(dx) > Math.abs(dy);
             }
 
             if (!isHorizontalIntent) {
               // vertical intent — не мешаем нативному скроллу
               return;
             }
 
             const atFirst = index === 0 && dx > 0;
             const atLast = index === slides.length - 1 && dx < 0;
             if (atFirst || atLast) {
               return;
             }
 
             // Блокируем вертикальный скролл только при горизонтальном намерении
             e.preventDefault(); // потребуется passive:false у слушателя — ниже указан
             const currentTransform = startTransform + (dx / track.offsetWidth) * 100;
             const minTransform = -(slides.length - 1) * step;
             const maxTransform = 0;
             const clampedTransform = Math.max(minTransform, Math.min(maxTransform, currentTransform));
             track.style.transform = `translateX(${clampedTransform}%)`;
           },
           { passive: false } // важно: чтобы preventDefault работал
         );
 
         track.addEventListener(
           "touchend",
           (e) => {
             if (!isDragging) return;
             finishDrag();
           },
           { passive: true }
         );
 
         track.addEventListener(
           "touchcancel",
           (e) => {
             if (!isDragging) return;
             finishDrag();
           },
           { passive: true }
         );
       }
 
       // ---------- Mouse fallback (desktop drag) ----------
       track.addEventListener("mousedown", (e) => {
         // Если мобильная ширина — может быть подключена мышь (например в эмуляторе) — поддерживаем
         startX = e.clientX;
         startY = e.clientY;
         startTransform = -index * step;
         isDragging = true;
         directionLocked = false;
         isHorizontalIntent = false;
         currentX = startX;
         track.style.transition = "none";
         e.preventDefault();
       });
 
       document.addEventListener("mousemove", (e) => {
         if (!isDragging) return;
         // mouse поддержка
         currentX = e.clientX;
         const dx = currentX - startX;
         const dy = e.clientY - startY;
 
         if (!directionLocked) {
           if (Math.abs(dx) < DIRECTION_THRESHOLD && Math.abs(dy) < DIRECTION_THRESHOLD) {
             return;
           }
           directionLocked = true;
           isHorizontalIntent = Math.abs(dx) > Math.abs(dy);
         }
 
         if (!isHorizontalIntent) return;
 
         const atFirst = index === 0 && dx > 0;
         const atLast = index === slides.length - 1 && dx < 0;
         if (atFirst || atLast) return;
 
         const currentTransform = startTransform + (dx / track.offsetWidth) * 100;
         const minTransform = -(slides.length - 1) * step;
         const maxTransform = 0;
         const clampedTransform = Math.max(minTransform, Math.min(maxTransform, currentTransform));
         track.style.transform = `translateX(${clampedTransform}%)`;
       });
 
       document.addEventListener("mouseup", (e) => {
         if (!isDragging) return;
         finishDrag();
       });
 
       // Общая логика завершения перетаскивания
       function finishDrag() {
         isDragging = false;
         directionLocked = false;
         track.style.transition = "transform 0.3s ease";
 
         const diffX = currentX - startX;
         if (Math.abs(diffX) > SWIPE_THRESHOLD) {
           if (diffX > 0 && index > 0) {
             goToSlide(index - 1);
           } else if (diffX < 0 && index < slides.length - 1) {
             goToSlide(index + 1);
           } else {
             updateSlider();
           }
         } else {
           updateSlider();
         }
       }
 
       // Предотвращаем выделение текста при перетаскивании
       track.addEventListener("selectstart", (e) => {
         if (isDragging) e.preventDefault();
       });
 
       // Инициализация
       updateSlider();
     });
   }
 });