function initBeforeAfterSliders(root = document) {
   const blocks = [...root.querySelectorAll(".ba")];

   blocks.forEach((container) => {
      // предотвращаем двойную инициализацию
      if (container.dataset.baReady === "1") return;
      container.dataset.baReady = "1";

      const beforeImg = container.querySelector(".ba__before");
      const afterImg = container.querySelector(".ba__after");
      if (!beforeImg || !afterImg) return;

      // создаём элементы хэндла
      const handle = document.createElement("div");
      handle.className = "ba__handle";
      const knob = document.createElement("div");
      knob.className = "ba__knob";
      handle.appendChild(knob);

      const btn = document.createElement("button");
      btn.className = "ba__handle-btn";
      btn.type = "button";
      btn.setAttribute("role", "slider");
      btn.setAttribute("aria-label", "Сравнить до/после");
      btn.setAttribute("aria-valuemin", "0");
      btn.setAttribute("aria-valuemax", "100");

      container.appendChild(handle);
      container.appendChild(btn);

      let percent = clamp(+container.dataset.start || 50, 0, 100);

      const setPercent = (p) => {
         percent = clamp(p, 0, 100);
         afterImg.style.clipPath = `inset(0 0 0 ${percent}%)`;
         handle.style.left = `${percent}%`;
         btn.style.left = `${percent}%`;
         btn.setAttribute("aria-valuenow", String(Math.round(percent)));
      };

      const pxToPercent = (clientX) => {
         const rect = container.getBoundingClientRect();
         const x = clamp(clientX - rect.left, 0, rect.width);
         return (x / rect.width) * 100;
      };

      // pointer events
      let dragging = false;

      const onPointerDown = (e) => {
         dragging = true;
         btn.setPointerCapture?.(e.pointerId);
         setPercent(pxToPercent(e.clientX));
         e.preventDefault();
      };
      const onPointerMove = (e) => {
         if (!dragging) return;
         setPercent(pxToPercent(e.clientX));
      };
      const onPointerUp = () => {
         dragging = false;
      };

      // навешиваем
      btn.addEventListener("pointerdown", onPointerDown);
      btn.addEventListener("pointermove", onPointerMove);
      btn.addEventListener("pointerup", onPointerUp);
      btn.addEventListener("pointercancel", onPointerUp);

      // по всей области, чтобы тянуть за любую точку
      container.addEventListener("pointerdown", (e) => {
         if (e.target === btn) return;
         onPointerDown(e);
      });
      container.addEventListener("pointermove", onPointerMove);
      container.addEventListener("pointerup", onPointerUp);
      container.addEventListener("pointercancel", onPointerUp);

      // клавиатура (доступность)
      btn.addEventListener("keydown", (e) => {
         const step = e.shiftKey ? 10 : 2;
         if (e.key === "ArrowLeft") {
            setPercent(percent - step);
            e.preventDefault();
         }
         if (e.key === "ArrowRight") {
            setPercent(percent + step);
            e.preventDefault();
         }
         if (e.key === "Home") {
            setPercent(0);
            e.preventDefault();
         }
         if (e.key === "End") {
            setPercent(100);
            e.preventDefault();
         }
      });

      // при ресайзе сохраняем относительную позицию
      const ro = new ResizeObserver(() => setPercent(percent));
      ro.observe(container);

      // начальная отрисовка
      setPercent(percent);
   });

   function clamp(v, min, max) {
      return Math.max(min, Math.min(max, v));
   }
}

// Делаем функцию доступной глобально
window.initBeforeAfterSliders = initBeforeAfterSliders;

// авто-инициализация при загрузке страницы
document.addEventListener("DOMContentLoaded", () => {
   initBeforeAfterSliders();
});
