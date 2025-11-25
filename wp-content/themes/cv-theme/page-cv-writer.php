<?php
/*
Template Name: CV Writer Page
*/

get_header(); ?>

<main>
   <section class="cv-writer" id="cv-writer">
      <div class="bg bg-waves"></div>
      <div class="bg bg-paska"></div>
      <div class="wrapper">
         <div class="cv-writer_text">
            <h3><?php pll_e('Створення СV'); ?></h3>
            <p class="cv-writer_text-subtext">
               <?php pll_e('Кожне резюме — унікальне. Ми оформлюємо його вручну, з урахуванням вашого досвіду, типу флоту та побажань.'); ?>
            </p>
            <p class="cv-choose-your">
               <?php pll_e('Обери свій пакет і зроби перший крок до контракту.'); ?>
            </p>
         </div>
         <div class="cv-write-wrapper">
            <div class="cv-write-container slider" id="slider2">
               <button class="slider-btn prev"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/shevron-left.svg" alt="arrow-left" /></button>
               <div class="slider-track">
                  <div class="cv-write-card slide">
                     <div class="cv-writer-card--top">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv1.svg" alt="" />
                        <div class="cv-writer-card--top-text">
                           <h4 class="title"><?php pll_e('Стартовий'); ?></h4>
                           <p class="subtitle">
                              <?php pll_e('Для новачків, які роблять перші кроки в морі'); ?>
                           </p>
                        </div>
                        <h4 class="price">€10</h4>
                        <ul>
                           <li><?php pll_e('Унікальних резюме створено вручну'); ?></li>
                           <li><?php pll_e('Розсилка по Україні + Грузії 🎁'); ?></li>
                        </ul>
                     </div>

                     <div class="cv-writer-card--bottom">
                        <a href="#cv-writer-start" class="button-more"
                           ><?php pll_e('Докладніше'); ?></a
                        >
                        <a
                           href="#"
                           class="bucket"
                           data-id="#10"
                           data-name="<?php pll_e('Стартовий'); ?>"
                           data-price="10"
                           data-group="<?php pll_e('Створення CV'); ?>"
                           data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv1.svg"
                        >
                           <img
                              src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                              alt="<?php pll_e('Добавить в корзину'); ?>"
                           />
                        </a>
                     </div>
                  </div>
                  <div class="cv-write-card slide">
                     <div class="cv-writer-card--top">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv2.svg" alt="" />
                        <div class="cv-writer-card--top-text">
                           <h4 class="title"><?php pll_e('Рядовий'); ?></h4>
                           <p class="subtitle">
                              <?php pll_e('Для досвідчених рядових моряків у пошуках нових можливостей.'); ?>
                           </p>
                        </div>

                        <h4 class="price">€17</h4>
                        <ul>
                           <li><?php pll_e('Структурований підхід'); ?></li>
                           <li><?php pll_e('Супровідний лист'); ?></li>
                           <li><?php pll_e('Індивідуальний дизайн'); ?></li>
                           <li>
                              <?php pll_e('Консультація з дизайнером та узгодження всіх деталей'); ?>
                           </li>
                        </ul>
                     </div>

                     <div class="cv-writer-card--bottom">
                        <a href="#cv-writer-ranks" class="button-more"
                           ><?php pll_e('Докладніше'); ?></a
                        >
                        <a
                           href="#"
                           class="bucket"
                           data-id="#11"
                           data-name="<?php pll_e('Рядовий'); ?>"
                           data-price="17"
                           data-group="<?php pll_e('Створення CV'); ?>"
                           data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv2.svg"
                        >
                           <img
                              src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                              alt="<?php pll_e('Добавить в корзину'); ?>"
                           />
                        </a>
                     </div>
                  </div>
                  <div class="cv-write-card slide">
                     <div class="cv-writer-card--top">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv3.svg" alt="" />
                        <div class="cv-writer-card--top-text">
                           <h4 class="title"><?php pll_e('Офіцери'); ?></h4>
                           <p class="subtitle">
                              <?php pll_e('Для старших спеціалістів і командного складу'); ?>
                           </p>
                        </div>

                        <h4 class="price">€23</h4>
                        <ul>
                           <li><?php pll_e('Структурований підхід'); ?></li>
                           <li><?php pll_e('Супровідний лист'); ?></li>
                           <li><?php pll_e('Індивідуальний дизайн'); ?></li>
                           <li>
                              <?php pll_e('Консультація з дизайнером та узгодження всіх деталей'); ?>
                           </li>
                        </ul>
                     </div>

                     <div class="cv-writer-card--bottom">
                        <a href="#cv-writer-oficers" class="button-more"
                           ><?php pll_e('Докладніше'); ?></a
                        >
                        <a
                           href="#"
                           class="bucket"
                           data-id="#12"
                           data-name="<?php pll_e('Офіцери'); ?>"
                           data-price="23"
                           data-group="<?php pll_e('Створення CV'); ?>"
                           data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv3.svg"
                        >
                           <img
                              src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                              alt="<?php pll_e('Добавить в корзину'); ?>"
                           />
                        </a>
                     </div>
                  </div>
               </div>
               <button class="slider-btn next"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/shevron-left.svg" alt="arrow-right" /></button>
            </div>
         </div>
      </div>
   </section>
   <section class="features" id="features">
      <div class="features-wrapper">
         <div class="feautures-item">
            <div class="features-item--image">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/group-icon.svg" alt="" />
            </div>
            <div class="features-item--text">
               <h6><?php pll_e('Професійний вигляд'); ?></h6>
               <p>
                  <?php pll_e('Індивідуальний сучасний дизайн, що одразу привертає увагу роботодавця.'); ?>
               </p>
            </div>
         </div>
         <div class="feautures-item">
            <div class="features-item--image">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/letter-icon.svg" alt="" />
            </div>
            <div class="features-item--text">
               <h6><?php pll_e('Чітка структура'); ?></h6>
               <p>
                  <?php pll_e('Логічно впорядкований зміст для швидкого ознайомлення з вами.'); ?>
               </p>
            </div>
         </div>
         <div class="feautures-item">
            <div class="features-item--image">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/clock-icon.svg" alt="" />
            </div>
            <div class="features-item--text">
               <h6><?php pll_e('Акцент на досягненнях'); ?></h6>
               <p>
                  <?php pll_e('Підкреслюємо ваші успіхи та сильні сторони для швидкого зацікавлення роботодавця.'); ?>
               </p>
            </div>
         </div>
         <div class="feautures-item">
            <div class="features-item--image">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/letter-icon.svg" alt="" />
            </div>
            <div class="features-item--text">
               <h6><?php pll_e('Міжнародний формат'); ?></h6>
               <p><?php pll_e('Оптимізоване CV, що відповідає світовим стандартам.'); ?></p>
            </div>
         </div>
      </div>
   </section>
   <section class="cv-example" id="cv-example">
      <div class="wrapper">
         <div class="layout">
            <div class="grid-left">
               <div class="cv-example-title">
                  <h3><?php pll_e('Як виглядати ваше CV'); ?></h3>
               </div>
               <div class="cv-example-subtitle">
                  <p>
                     <?php pll_e('Ми створюємо резюме, яке легко читається та одразу привертає увагу крюїнг-менеджера.'); ?>
                  </p>
                  <p>
                     <?php pll_e('За нашим досвідом, на перегляд CV витрачають лише 2–3 хвилини, тому воно має бути максимально зрозумілим і структурованим.'); ?>
                  </p>
                  <p><?php pll_e('У вашому документі буде:'); ?></p>
                  <ul>
                     <li>
                        <p>
                           <strong><?php pll_e('5–7 останніх контрактів'); ?></strong> —
                           <?php pll_e('головна інформація про досвід.'); ?>
                        </p>
                     </li>
                     <li>
                        <p>
                           <strong
                              ><?php pll_e('Попередній досвід роботи в морі'); ?></strong
                           >
                           — <?php pll_e('усі інші контракти у скороченому вигляді, щоб не перевантажувати документ.'); ?>
                        </p>
                     </li>
                     <li>
                        <p>
                           <strong><?php pll_e('Сертифікати та документи'); ?></strong> —
                           <?php pll_e('одразу після розділу досвіду роботи.'); ?>
                        </p>
                     </li>
                  </ul>
                  <p>
                     <?php pll_e('Така структура допомагає швидко показати найважливіше та водночас зберегти повну картину вашої кар\'єри.'); ?>
                  </p>
               </div>
               <div class="cv-example-button buttons">
                  <a href="#cv-writer" class="cv-but">
                     <div class="button cv">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <path d="M16.8624 13.5487C17.3471 15.2778 18.7 16.6306 20.4362 17.1226M17.6799 12.7312L11.9791 18.432C11.762 18.649 11.545 19.0759 11.5016 19.387L11.1905 21.5646C11.0748 22.3531 11.6318 22.9029 12.4204 22.7944L14.598 22.4833C14.9018 22.4399 15.3287 22.2229 15.5529 22.0059L21.2537 16.3051C22.2376 15.3212 22.7007 14.1781 21.2537 12.7312C19.8068 11.2843 18.6638 11.7473 17.6799 12.7312Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20.528 11.5445C20.528 10.6226 20.3946 9.73192 20.1461 8.89059C19.9548 8.24273 19.6951 7.62417 19.3755 7.04322C19.2623 6.83744 19.1416 6.63638 19.0138 6.44041M11.1754 20.8972C10.0269 20.8972 8.92672 20.6901 7.9102 20.3114M12.8593 8.20309C13.1447 8.34719 13.4091 8.52679 13.6468 8.73607M12.8593 8.20309C12.7688 8.15741 12.6763 8.1153 12.5818 8.07694M12.8593 8.20309L14.6058 2.84105M13.6468 8.73607L12.5818 8.07694M13.6468 8.73607C13.7886 8.861 13.9209 8.99651 14.0425 9.14136M14.322 13.5689C14.6982 12.9854 14.9164 12.2905 14.9164 11.5446C14.9164 11.0132 14.8056 10.5076 14.6058 10.0498C14.4617 9.7194 14.2711 9.41384 14.0425 9.14136M14.322 13.5689C14.1339 13.8607 13.9063 14.1247 13.6468 14.3532C13.4958 14.4861 13.3341 14.6071 13.163 14.7146C12.8968 14.8818 12.608 15.0165 12.3023 15.113C11.9467 15.2252 11.5681 15.2857 11.1754 15.2857C10.6515 15.2857 10.1528 15.178 9.70022 14.9836C9.5218 14.907 9.35054 14.8169 9.18772 14.7146M14.322 13.5689L16.0048 14.3532M9.18772 14.7146C8.95252 14.5668 8.73493 14.3935 8.53881 14.1987C8.293 13.9545 8.08093 13.6764 7.9102 13.372M9.18772 14.7146L7.9102 20.3114M7.9102 20.3114C6.49019 19.7823 5.23338 18.9181 4.23593 17.8149C3.63656 17.1519 3.13085 16.4027 2.73966 15.5881M7.9102 13.372C7.69746 12.9926 7.54891 12.5725 7.47925 12.1262C7.44968 11.9367 7.43433 11.7424 7.43433 11.5446C7.43433 10.7605 7.67558 10.0327 8.08792 9.43141M7.9102 13.372L2.73966 15.5881M2.73966 15.5881C2.23123 14.5294 1.91626 13.3601 1.84055 12.1262C1.82874 11.9338 1.82275 11.7399 1.82275 11.5445C1.82275 9.76814 2.318 8.10742 3.17794 6.69291M8.08792 9.43141C8.22115 9.23714 8.37223 9.05608 8.53881 8.89059C8.81687 8.61436 9.13809 8.38152 9.49147 8.20309M8.08792 9.43141L3.17794 6.69291M3.17794 6.69291C3.36291 6.38866 3.56474 6.09581 3.78215 5.81565C4.67215 4.66875 5.82313 3.7345 7.14598 3.102M9.49147 8.20309C9.67712 8.10935 9.87165 8.03063 10.0735 7.96852C10.4218 7.8613 10.7919 7.80359 11.1754 7.80359C11.6728 7.80359 12.1476 7.90068 12.5818 8.07694M9.49147 8.20309L7.14598 3.102M7.14598 3.102C7.59186 2.88881 8.05728 2.7099 8.53881 2.56868C9.37503 2.32345 10.2598 2.19189 11.1754 2.19189C12.3864 2.19189 13.5437 2.42207 14.6058 2.84105M14.6058 2.84105C14.8091 2.92122 15.0088 3.0083 15.2048 3.102C16.0164 3.49005 16.7633 3.99167 17.4249 4.5863C18.0315 5.13146 18.5664 5.75478 19.0138 6.44041M14.0425 9.14136L19.0138 6.44041" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>  
                        <?php pll_e('Створення СV'); ?>
                     </div>
                  </a>
               </div>
            </div>
            <div class="grid-right">
               <div class="photo-wrap">
                  <img
                     class="fade-y"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/cv-writer-examples.png"
                     alt="<?php pll_e('Образци резюме'); ?>"
                  />
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="cv-blaids" id="cv-blaids">
      <div class="wrapper">
         <div class="cv-blaids-text">
            <h3 class="cv-blaids-title"><?php pll_e('Приклади готових CV'); ?></h3>
            <p class="cv-blaids-subtitle">
               <?php pll_e('Ми підготували приклади CV для різних рівнів досвіду: Стартовий, Рядовий та Офіцери.Це допоможе швидко обрати оптимальний варіант.'); ?>
            </p>
         </div>
         <div class="blade cv-writer start" id="cv-writer-start">
            <div class="layout">
               <div class="grid-left">
                  <img
                     class="icons"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv1.svg"
                     alt="icon boat"
                  />
                  <div class="cv-write-title">
                     <h3><?php pll_e('Стартовий'); ?></h3>
                  </div>
                  <div class="cv-write-subtitle">
                     <p>
                        <?php pll_e('Для новачків або кадетів, які тільки починають кар\'єру в морі. Містить основну інформацію, освіту, сертифікати та 1–2 останніх місця роботи.'); ?>
                     </p>
                  </div>
                  <div class="cv-write-list">
                     <ul>
                        <li><?php pll_e('Унікальних резюме створено вручну'); ?></li>
                        <li><?php pll_e('Розсилка по Україні + Грузії 🎁'); ?></li>
                     </ul>
                  </div>
                  <div class="cv-writer-item--buttons">
                     <a
                        href="#"
                        tabindex="0"
                        class="busket-btn cv-writer bucket"
                        data-id="#10"
                        data-name="<?php pll_e('Стартовий'); ?>"
                        data-price="10"
                        data-group="<?php pll_e('Створення CV'); ?>"
                        data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv1.svg"
                     >
                        <img
                           src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                           alt=""
                        />€10
                     </a>
                  </div>
               </div>
               <div class="grid-right">
               <div class="ba" data-start="30">
                  <img class="ba__img ba__before" src="<?php echo get_template_directory_uri(); ?>/assets/images/bfr1.jpg" alt="<?php pll_e('До'); ?>" loading="lazy">
                  <img class="ba__img ba__after"  src="<?php echo get_template_directory_uri(); ?>/assets/images/aftr1.jpg"  alt="<?php pll_e('После'); ?>" loading="lazy">
               </div>
               </div>
            </div>
         </div>
         <div class="blade cv-writer ranks" id="cv-writer-ranks">
            <div class="layout">
               <div class="grid-left">
                  <div class="ba" data-start="30">
                     <img class="ba__img ba__before" src="<?php echo get_template_directory_uri(); ?>/assets/images/bfr2.jpg" alt="<?php pll_e('До'); ?>" loading="lazy">
                     <img class="ba__img ba__after"  src="<?php echo get_template_directory_uri(); ?>/assets/images/aftr2.jpg"  alt="<?php pll_e('После'); ?>" loading="lazy">
                  </div>
               </div>
               <div class="grid-right">
                  <img
                     class="icons"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv2.svg"
                     alt="cv2"
                  />
                  <div class="cv-writer-title">
                     <h3><?php pll_e('Рядовий'); ?></h3>
                  </div>
                  <div class="cv-writer-subtitle">
                     <p>
                        <?php pll_e('Для моряків із досвідом роботи в командному складі. Містить 5–7 останніх контрактів, попередній досвід у скороченому вигляді та сертифікати.'); ?>
                     </p>
                  </div>
                  <div class="cv-writer-list">
                     <ul>
                        <li><?php pll_e('Структурований підхід'); ?></li>
                        <li><?php pll_e('Супровідний лист'); ?></li>
                        <li><?php pll_e('Індивідуальний дизайн'); ?></li>
                        <li>
                           <?php pll_e('Консультація з дизайнером та узгодження всіх деталей'); ?>
                        </li>
                     </ul>
                  </div>
                  <div class="cv-writer-item--buttons">
                     <a
                        href="#"
                        tabindex="0"
                        class="busket-btn cv-writer bucket"
                        data-id="#11"
                        data-name="<?php pll_e('Рядовий'); ?>"
                        data-price="17"
                        data-group="<?php pll_e('Створення CV'); ?>"
                        data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv2.svg"
                     >
                        <img
                           src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                           alt=""
                        />€17
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="blade cv-writer oficers" id="cv-writer-oficers">
            <div class="layout">
               <div class="grid-left">
                  <img
                     class="icons"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv3.svg"
                     alt="offshore icon"
                  />
                  <div class="cv-writer-title">
                     <h3><?php pll_e('Офіцери'); ?></h3>
                  </div>
                  <div class="cv-writer-subtitle">
                     <p>
                        <?php pll_e('Для старшого командного складу. Включає 5–7 останніх контрактів, повний перелік попереднього досвіду, детальний блок сертифікатів і досягнень.'); ?>
                     </p>
                  </div>
                  <div class="cv-writer-list">
                     <ul>
                        <li><?php pll_e('Структурований підхід'); ?></li>
                        <li><?php pll_e('Супровідний лист'); ?></li>
                        <li><?php pll_e('Індивідуальний дизайн'); ?></li>
                        <li>
                           <?php pll_e('Консультація з дизайнером та узгодження всіх деталей'); ?>
                        </li>
                     </ul>
                  </div>
                  <div class="cv-writer-item--buttons">
                     <a
                        href="#"
                        tabindex="0"
                        class="busket-btn cv-writer bucket"
                        data-id="#12"
                        data-name="<?php pll_e('Офіцери'); ?>"
                        data-price="23"
                        data-group="<?php pll_e('Створення CV'); ?>"
                        data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv3.svg"
                     >
                        <img
                           src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                           alt=""
                        />€23
                     </a>
                  </div>
               </div>
               <div class="grid-right">
               <div class="ba" data-start="40">
                     <img class="ba__img ba__before" src="<?php echo get_template_directory_uri(); ?>/assets/images/bfr3.jpg" alt="<?php pll_e('До'); ?>" loading="lazy">
                     <img class="ba__img ba__after"  src="<?php echo get_template_directory_uri(); ?>/assets/images/aftr3.jpg"  alt="<?php pll_e('После'); ?>" loading="lazy">
                  </div>
               </div>
            </div>
         </div>
               </div>
      </section>
      
      <section class="steps" id="steps">
         <div class="wrapper">
            <div class="steps-text">
               <h3><?php pll_e('Як працює створення CV'); ?></h3>
               <p>
                  <?php pll_e('Ми зробимо для вас професійне та структуроване резюме, яке швидко приверне увагу роботодавця.'); ?>
               </p>
            </div>
            <div class="container">
               <div class="left-side">
                  <div class="image-wrapper">
                     <img
                        id="step-image"
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/Step1.jpg"
                        alt="<?php pll_e('Крок'); ?>"
                     />
                  </div>
               </div>
               <div class="right-side">
                  <div class="step step1" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/Step1.jpg">
                     <div class="pill"><span><?php pll_e('Крок 1'); ?></span></div>
                     <h4><?php pll_e('Оберіть послугу'); ?></h4>
                     <p>
                        <?php pll_e('Перейдіть на сторінку створення CV, ознайомтеся з пакетами та описом майбутнього резюме, і додайте послугу до кошика.'); ?>
                     </p>

                     <div class="buttons">
                        <a href="#cv-writer" class="cv-but">
                           <div class="button cv">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <path d="M16.8624 13.5487C17.3471 15.2778 18.7 16.6306 20.4362 17.1226M17.6799 12.7312L11.9791 18.432C11.762 18.649 11.545 19.0759 11.5016 19.387L11.1905 21.5646C11.0748 22.3531 11.6318 22.9029 12.4204 22.7944L14.598 22.4833C14.9018 22.4399 15.3287 22.2229 15.5529 22.0059L21.2537 16.3051C22.2376 15.3212 22.7007 14.1781 21.2537 12.7312C19.8068 11.2843 18.6638 11.7473 17.6799 12.7312Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20.528 11.5445C20.528 10.6226 20.3946 9.73192 20.1461 8.89059C19.9548 8.24273 19.6951 7.62417 19.3755 7.04322C19.2623 6.83744 19.1416 6.63638 19.0138 6.44041M11.1754 20.8972C10.0269 20.8972 8.92672 20.6901 7.9102 20.3114M12.8593 8.20309C13.1447 8.34719 13.4091 8.52679 13.6468 8.73607M12.8593 8.20309C12.7688 8.15741 12.6763 8.1153 12.5818 8.07694M12.8593 8.20309L14.6058 2.84105M13.6468 8.73607L12.5818 8.07694M13.6468 8.73607C13.7886 8.861 13.9209 8.99651 14.0425 9.14136M14.322 13.5689C14.6982 12.9854 14.9164 12.2905 14.9164 11.5446C14.9164 11.0132 14.8056 10.5076 14.6058 10.0498C14.4617 9.7194 14.2711 9.41384 14.0425 9.14136M14.322 13.5689C14.1339 13.8607 13.9063 14.1247 13.6468 14.3532C13.4958 14.4861 13.3341 14.6071 13.163 14.7146C12.8968 14.8818 12.608 15.0165 12.3023 15.113C11.9467 15.2252 11.5681 15.2857 11.1754 15.2857C10.6515 15.2857 10.1528 15.178 9.70022 14.9836C9.5218 14.907 9.35054 14.8169 9.18772 14.7146M14.322 13.5689L16.0048 14.3532M9.18772 14.7146C8.95252 14.5668 8.73493 14.3935 8.53881 14.1987C8.293 13.9545 8.08093 13.6764 7.9102 13.372M9.18772 14.7146L7.9102 20.3114M7.9102 20.3114C6.49019 19.7823 5.23338 18.9181 4.23593 17.8149C3.63656 17.1519 3.13085 16.4027 2.73966 15.5881M7.9102 13.372C7.69746 12.9926 7.54891 12.5725 7.47925 12.1262C7.44968 11.9367 7.43433 11.7424 7.43433 11.5446C7.43433 10.7605 7.67558 10.0327 8.08792 9.43141M7.9102 13.372L2.73966 15.5881M2.73966 15.5881C2.23123 14.5294 1.91626 13.3601 1.84055 12.1262C1.82874 11.9338 1.82275 11.7399 1.82275 11.5445C1.82275 9.76814 2.318 8.10742 3.17794 6.69291M8.08792 9.43141C8.22115 9.23714 8.37223 9.05608 8.53881 8.89059C8.81687 8.61436 9.13809 8.38152 9.49147 8.20309M8.08792 9.43141L3.17794 6.69291M3.17794 6.69291C3.36291 6.38866 3.56474 6.09581 3.78215 5.81565C4.67215 4.66875 5.82313 3.7345 7.14598 3.102M9.49147 8.20309C9.67712 8.10935 9.87165 8.03063 10.0735 7.96852C10.4218 7.8613 10.7919 7.80359 11.1754 7.80359C11.6728 7.80359 12.1476 7.90068 12.5818 8.07694M9.49147 8.20309L7.14598 3.102M7.14598 3.102C7.59186 2.88881 8.05728 2.7099 8.53881 2.56868C9.37503 2.32345 10.2598 2.19189 11.1754 2.19189C12.3864 2.19189 13.5437 2.42207 14.6058 2.84105M14.6058 2.84105C14.8091 2.92122 15.0088 3.0083 15.2048 3.102C16.0164 3.49005 16.7633 3.99167 17.4249 4.5863C18.0315 5.13146 18.5664 5.75478 19.0138 6.44041M14.0425 9.14136L19.0138 6.44041" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>  
                              <?php pll_e('Створення СV'); ?>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="step step2" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/Step2.jpg">
                     <div class="pill"><span><?php pll_e('Крок 2'); ?></span></div>
                     <h4><?php pll_e('Заповніть форму'); ?></h4>
                     <p>
                        <?php pll_e('Заповніть свої дані, прикріпіть актуальне або попереднє резюме (за наявності) та дайте відповіді на кілька запитань.'); ?>
                     </p>
                     <p>
                        <?php pll_e('Вкажіть контактні дані та зручний месенджер для зв\'язку (WhatsApp, Viber або Telegram).'); ?>
                     </p>
                     <div class="step-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Step2.jpg" alt="<?php pll_e('Крок'); ?>" />
                     </div>
                  </div>
                  <div
                     class="step step3"
                     data-image="<?php echo get_template_directory_uri(); ?>/assets/images/cv-writer-Step3.jpg"
                  >
                     <div class="pill"><span><?php pll_e('Крок 3'); ?></span></div>
                     <h4><?php pll_e('Консультація'); ?></h4>
                     <p>
                        <?php pll_e('Наш консультант зв\'яжеться з вами у вибраному месенджері найближчим часом, щоб обговорити всі нюанси та уточнити деталі вашого досвіду.'); ?>
                     </p>
                     <div class="step-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cv-writer-Step3.jpg" alt="<?php pll_e('Крок'); ?>" />
                     </div>
                  </div>
                  <div
                     class="step step4"
                     data-image="<?php echo get_template_directory_uri(); ?>/assets/images/cv-writer-Step4.jpg"
                  >
                     <div class="pill"><span><?php pll_e('Крок 4'); ?></span></div>
                     <h4><?php pll_e('Підготовка та передача готового CV'); ?></h4>

                     <p>
                        <?php pll_e('Ми підготуємо професійне індивідуальне резюме англійською мовою, адаптоване під ваш досвід та вакансії. Готові файли ви отримаєте у форматах .pdf, .docx та .xlsx.'); ?>
                     </p>
                     <div class="step-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cv-writer-Step4.jpg" alt="<?php pll_e('Крок'); ?>" />
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      
      <section class="faq" id="faq">
            <h3 class="faq-title"><?php pll_e('Маєте питання?'); ?></h3>
            <h6 class="faq-subtitle">
               <?php pll_e('Ми зібрали відповіді на найпоширеніші запити, щоб вам було зручніше.'); ?>
            </h6>

            <div class="faq-item">
               <button class="faq-question" type="button" tabindex="0">
                  <?php pll_e('Що входить у вартість створення CV?'); ?>
                  <span class="arrow"></span>
               </button>
               <div class="faq-answer">
                  <p><?php pll_e('У вартість входить: професійне оформлення резюме, розробка індивідуального дизайну, складання супровідного листа, консультація з кар\'єрним консультантом і адаптація під ваш досвід та обрану посаду.'); ?></p>
                  <p><?php pll_e('Для  кандидатів без досвіду роботи ми даруємо в подарунок безкоштовну розсилку по крюїнгах України  та Грузії.'); ?></p>
               </div>
            </div>

            <div class="faq-item">
               <button class="faq-question" type="button" tabindex="0">
               <?php pll_e('Чи можна замовити лише розсилку без створення CV?'); ?>
                  <span class="arrow"></span>
               </button>
               <div class="faq-answer">
                  <p>
                  <?php pll_e('Так, така можливість є. Ви можете надати власне готове резюме, а ми допоможемо з його розсилкою по відповідних компаніях чи типах флоту . За потреби, наш консультант згенерує супровідний лист під Ваше резюме та з урахуванням вашого досвіду- це покращить впізнаванність Вашого резюме та допоможе не загубитись в почтовій скринці крюїнг менеджера.'); ?>
                  </p>
               </div>
            </div>
            <div class="faq-item">
               <button class="faq-question" type="button" tabindex="0">
                  <?php pll_e('Як зі мною зв\'яжеться консультант?'); ?>
                  <span class="arrow"></span>
               </button>
               <div class="faq-answer">
                  <p>
                  <?php pll_e('Після оформлення замовлення з вами зв\'яжеться наш консультант у зручний для вас спосіб — телефоном, електронною поштою або в месенджері. Ви зможете обговорити всі деталі, побажання та поставити додаткові запитання.'); ?>
                  </p>
               </div>
            </div>
         </section>
      
      <section class="cta-block" id="cta-block">
         <div class="bg-image-wave"></div>
         <div class="bg-image-vector"></div>
         <div class="cta-block-wrapper">
            <div class="cta-block-text">
               <h3><?php pll_e('Зробіть перший крок до роботи мрії'); ?></h3>
               <p><?php pll_e('Ми створимо і надішлемо резюме туди, де на вас чекають.'); ?></p>
            </div>
            <div class="cta-block-buttons">
               <div class="button-container">
                  <div class="buttons">
                     <a href="<?php echo function_exists('pll_get_post') && get_page_by_path('sending') ? get_permalink(pll_get_post(get_page_by_path('sending')->ID)) : home_url('/sending/'); ?>" class="sender">
                        <div class="button anchor">
                           <img
                              src="<?php echo get_template_directory_uri(); ?>/assets/images/anchor-icon.svg"
                              alt="anchor-icon"
                           />
                           <?php pll_e('Розсилка CV'); ?>
                        </div>
                     </a>

                     <a href="#cv-writer" class="cv-but">
                        <div class="button cv">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                           <path d="M16.8624 13.5487C17.3471 15.2778 18.7 16.6306 20.4362 17.1226M17.6799 12.7312L11.9791 18.432C11.762 18.649 11.545 19.0759 11.5016 19.387L11.1905 21.5646C11.0748 22.3531 11.6318 22.9029 12.4204 22.7944L14.598 22.4833C14.9018 22.4399 15.3287 22.2229 15.5529 22.0059L21.2537 16.3051C22.2376 15.3212 22.7007 14.1781 21.2537 12.7312C19.8068 11.2843 18.6638 11.7473 17.6799 12.7312Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M20.528 11.5445C20.528 10.6226 20.3946 9.73192 20.1461 8.89059C19.9548 8.24273 19.6951 7.62417 19.3755 7.04322C19.2623 6.83744 19.1416 6.63638 19.0138 6.44041M11.1754 20.8972C10.0269 20.8972 8.92672 20.6901 7.9102 20.3114M12.8593 8.20309C13.1447 8.34719 13.4091 8.52679 13.6468 8.73607M12.8593 8.20309C12.7688 8.15741 12.6763 8.1153 12.5818 8.07694M12.8593 8.20309L14.6058 2.84105M13.6468 8.73607L12.5818 8.07694M13.6468 8.73607C13.7886 8.861 13.9209 8.99651 14.0425 9.14136M14.322 13.5689C14.6982 12.9854 14.9164 12.2905 14.9164 11.5446C14.9164 11.0132 14.8056 10.5076 14.6058 10.0498C14.4617 9.7194 14.2711 9.41384 14.0425 9.14136M14.322 13.5689C14.1339 13.8607 13.9063 14.1247 13.6468 14.3532C13.4958 14.4861 13.3341 14.6071 13.163 14.7146C12.8968 14.8818 12.608 15.0165 12.3023 15.113C11.9467 15.2252 11.5681 15.2857 11.1754 15.2857C10.6515 15.2857 10.1528 15.178 9.70022 14.9836C9.5218 14.907 9.35054 14.8169 9.18772 14.7146M14.322 13.5689L16.0048 14.3532M9.18772 14.7146C8.95252 14.5668 8.73493 14.3935 8.53881 14.1987C8.293 13.9545 8.08093 13.6764 7.9102 13.372M9.18772 14.7146L7.9102 20.3114M7.9102 20.3114C6.49019 19.7823 5.23338 18.9181 4.23593 17.8149C3.63656 17.1519 3.13085 16.4027 2.73966 15.5881M7.9102 13.372C7.69746 12.9926 7.54891 12.5725 7.47925 12.1262C7.44968 11.9367 7.43433 11.7424 7.43433 11.5446C7.43433 10.7605 7.67558 10.0327 8.08792 9.43141M7.9102 13.372L2.73966 15.5881M2.73966 15.5881C2.23123 14.5294 1.91626 13.3601 1.84055 12.1262C1.82874 11.9338 1.82275 11.7399 1.82275 11.5445C1.82275 9.76814 2.318 8.10742 3.17794 6.69291M8.08792 9.43141C8.22115 9.23714 8.37223 9.05608 8.53881 8.89059C8.81687 8.61436 9.13809 8.38152 9.49147 8.20309M8.08792 9.43141L3.17794 6.69291M3.17794 6.69291C3.36291 6.38866 3.56474 6.09581 3.78215 5.81565C4.67215 4.66875 5.82313 3.7345 7.14598 3.102M9.49147 8.20309C9.67712 8.10935 9.87165 8.03063 10.0735 7.96852C10.4218 7.8613 10.7919 7.80359 11.1754 7.80359C11.6728 7.80359 12.1476 7.90068 12.5818 8.07694M9.49147 8.20309L7.14598 3.102M7.14598 3.102C7.59186 2.88881 8.05728 2.7099 8.53881 2.56868C9.37503 2.32345 10.2598 2.19189 11.1754 2.19189C12.3864 2.19189 13.5437 2.42207 14.6058 2.84105M14.6058 2.84105C14.8091 2.92122 15.0088 3.0083 15.2048 3.102C16.0164 3.49005 16.7633 3.99167 17.4249 4.5863C18.0315 5.13146 18.5664 5.75478 19.0138 6.44041M14.0425 9.14136L19.0138 6.44041" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>  
                           <?php pll_e('Створення СV'); ?>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>
   
   <?php get_footer(); ?>