lottie.loadAnimation({
   container: document.getElementById("hero-animation"), // куда вставить
   renderer: "svg", // или canvas
   loop: true, // повтор
   autoplay: true, // автозапуск
   path: cv_theme_vars.animation_path, // путь к JSON-файлу из WordPress
});
