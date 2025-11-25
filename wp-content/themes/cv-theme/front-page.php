<?php get_header(); ?>
<main>
         <section class="hero" id="hero">
            <div class="hero-content">
               <div class="text-wrapper">
                  <h1><?php pll_e('Професійне CV, що відкриває двері до нового контракту'); ?></h1>
					<p class="body regular large">
						<?php pll_e('Якісне оформлення, таргетована розсилка, реальні відповіді.'); ?>
						<?php pll_e('Понад 50 000 моряків вже довірились нам.'); ?>
					</p>
               </div>
               <div class="buttons">
                  <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#sender-block" class="sender">
                     <div class="button anchor">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/anchor-icon.svg" alt="anchor-icon" />
                        <?php pll_e('Розсилка CV'); ?>
                        
                     </div>
                  </a>
                  <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#cv-writer" class="cv-but">
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
            <div class="hero-animation" id="hero-animation"></div>
            <div class="ship ship-right ship1">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ship-right1.svg" alt="" width="120" height="80" />
            </div>
            <div class="ship ship-right ship2">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ship-right2.svg" alt="" loading="lazy" />
            </div>
            <div class="ship ship-left ship1">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ship-left1.svg" alt="" loading="lazy" />
            </div>
            <div class="ship ship-left ship2">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ship-left2.svg" alt="" loading="lazy" />
            </div>
            <div class="seagul seagul-left">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/seagul-left.svg" alt="" loading="lazy" />
            </div>
            <div class="seagul seagul-right">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/seagul-right.svg" alt="" loading="lazy" />
            </div>
            <div class="cloud cloud-center cloud1">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cloud-center1.svg" alt="" width="200" height="100" />
            </div>
            <div class="cloud cloud-center cloud2">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cloud-center2.svg" alt="" loading="lazy" />
            </div>
            <div class="cloud cloud-left">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cloud-left.svg" alt="" loading="lazy" />
            </div>
            <div class="cloud cloud-right">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cloud-rught1.svg" alt="" loading="lazy" />
            </div>
            <div class="cloud mid">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cloud-mid.svg" alt="" loading="lazy" />
            </div>
            <div class="waves"></div>
            <div class="bottom-curv"></div>
            <div class="horizont"></div>
         </section>
         <section class="features" id="features">
            <div class="features-wrapper">
               <div class="feautures-item">
                  <div class="features-item--image">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/group-icon.svg" alt="" />
                  </div>
                  <div class="features-item--text">
                     <h6><?php pll_e('Велика база контактів'); ?></h6>
                     <p>
                        <?php pll_e('Доступ до 1 500+ перевірених крюїнг-компаній по всьому світу.'); ?>
                     </p>
                  </div>
               </div>
               <div class="feautures-item">
                  <div class="features-item--image">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path d="M2 8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5H7" stroke="#0841E2" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9" stroke="#0D2237" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M2 16.5H8" stroke="#0D2237" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M2 12.5H5" stroke="#0D2237" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  </div>
                  <div class="features-item--text">
                     <h6><?php pll_e('Доставка гарантована'); ?></h6>
                     <p>
                        <?php pll_e('Ваше CV доходить до потрібних компаній — минаючи спам-фільтри.'); ?>
                     </p>
                  </div>
               </div>
               <div class="feautures-item">
                  <div class="features-item--image">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/clock-icon.svg" alt="" />
                  </div>
                  <div class="features-item--text">
                     <h6><?php pll_e('Старт від 24 годин'); ?></h6>
                     <p>
                        <?php pll_e('Ми розпочинаємо роботу одразу після оплати. Без затримок.'); ?>
                     </p>
                  </div>
               </div>
               <div class="feautures-item">
                  <div class="features-item--image">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/letter-icon.svg" alt="" />
                  </div>
                  <div class="features-item--text">
                     <h6><?php pll_e('Цільова розсилка'); ?></h6>
                     <p>
                        <?php pll_e('Обираєш флот або регіон — ми надсилаємо лише потрібним крюїнгам.'); ?>
                     </p>
                  </div>
               </div>
            </div>
				<div class="slogan">
					<div class="slogan--text">
						<h2>
							Seafarer<span class="CV">CV</span> <?php pll_e('— це не просто сервіс.'); ?>
							<?php pll_e('Це команда, яка допомагає морякам отримати результат.'); ?>
						</h2>
					</div>
				</div>

         </section>
         <section class="steps" id="steps">
            <div class="wrapper">
               <div class="steps-text">
                  <h3><?php pll_e('Від заявки до контракту — всього кілька кроків'); ?></h3>
                  <p>
                     <?php pll_e('Ми подбали, щоб шлях до нового рейсу був швидким та зрозумілим: оберіть послугу, надішліть дані, підтвердьте оплату — і отримуйте запрошення на співбесіди.'); ?>
                  </p>
               </div>
               <div class="container">
                  <div class="left-side">
                     <div class="image-wrapper">
                        <img
                           id="step-image"
                           src="<?php echo get_template_directory_uri(); ?>/assets/images/Step1.jpg"
                           alt="<?php echo pll__('Крок'); ?>"
                        />
                     </div>
                  </div>
                  <div class="right-side">
                     <div class="step step1" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/Step1.jpg">
                        <div class="pill"><span><?php pll_e('Крок 1'); ?></span></div>
                        <h4><?php pll_e('Оберіть послугу'); ?></h4>
                        <p><?php pll_e('Виберіть одну або кілька послуг:'); ?></p>
                        <ul>
                           <li>
                              <p class="service"><?php pll_e('Розсилка CV за флотом'); ?></p>
                           </li>
                           <li>
                              <p class="service"><?php pll_e('Розсилка CV за регіонами'); ?></p>
                           </li>
                           <li>
                              <p class="service"><?php pll_e('Створення CV'); ?></p>
                           </li>
                        </ul>
                        <p class="semibold">
                           <?php pll_e('Кожну послугу можна оформити окремо та додати до кошика.'); ?>
                        </p>
                        <p>
                           <?php pll_e('Перегляньте деталі або натисніть «Додати до кошика» та перейдіть до оформлення.'); ?>
                        </p>
                        <div class="buttons">
                           <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#sender-block" class="sender">
                              <div class="button anchor">
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/anchor-icon.svg"
                                    alt="anchor-icon"
                                 />
                                 <?php pll_e('Розсилка CV'); ?>
                              </div>
                           </a>
                           <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#cv-writer" class="cv-but">
                              <div class="button cv">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                 <path d="M16.8624 13.5487C17.3471 15.2778 18.7 16.6306 20.4362 17.1226M17.6799 12.7312L11.9791 18.432C11.762 18.649 11.545 19.0759 11.5016 19.387L11.1905 21.5646C11.0748 22.3531 11.6318 22.9029 12.4204 22.7944L14.598 22.4833C14.9018 22.4399 15.3287 22.2229 15.5529 22.0059L21.2537 16.3051C22.2376 15.3212 22.7007 14.1781 21.2537 12.7312C19.8068 11.2843 18.6638 11.7473 17.6799 12.7312Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M20.528 11.5445C20.528 10.6226 20.3946 9.73192 20.1461 8.89059C19.9548 8.24273 19.6951 7.62417 19.3755 7.04322C19.2623 6.83744 19.1416 6.63638 19.0138 6.44041M11.1754 20.8972C10.0269 20.8972 8.92672 20.6901 7.9102 20.3114M12.8593 8.20309C13.1447 8.34719 13.4091 8.52679 13.6468 8.73607M12.8593 8.20309C12.7688 8.15741 12.6763 8.1153 12.5818 8.07694M12.8593 8.20309L14.6058 2.84105M13.6468 8.73607L12.5818 8.07694M13.6468 8.73607C13.7886 8.861 13.9209 8.99651 14.0425 9.14136M14.322 13.5689C14.6982 12.9854 14.9164 12.2905 14.9164 11.5446C14.9164 11.0132 14.8056 10.5076 14.6058 10.0498C14.4617 9.7194 14.2711 9.41384 14.0425 9.14136M14.322 13.5689C14.1339 13.8607 13.9063 14.1247 13.6468 14.3532C13.4958 14.4861 13.3341 14.6071 13.163 14.7146C12.8968 14.8818 12.608 15.0165 12.3023 15.113C11.9467 15.2252 11.5681 15.2857 11.1754 15.2857C10.6515 15.2857 10.1528 15.178 9.70022 14.9836C9.5218 14.907 9.35054 14.8169 9.18772 14.7146M14.322 13.5689L16.0048 14.3532M9.18772 14.7146C8.95252 14.5668 8.73493 14.3935 8.53881 14.1987C8.293 13.9545 8.08093 13.6764 7.9102 13.372M9.18772 14.7146L7.9102 20.3114M7.9102 20.3114C6.49019 19.7823 5.23338 18.9181 4.23593 17.8149C3.63656 17.1519 3.13085 16.4027 2.73966 15.5881M7.9102 13.372C7.69746 12.9926 7.54891 12.5725 7.47925 12.1262C7.44968 11.9367 7.43433 11.7424 7.43433 11.5446C7.43433 10.7605 7.67558 10.0327 8.08792 9.43141M7.9102 13.372L2.73966 15.5881M2.73966 15.5881C2.23123 14.5294 1.91626 13.3601 1.84055 12.1262C1.82874 11.9338 1.82275 11.7399 1.82275 11.5445C1.82275 9.76814 2.318 8.10742 3.17794 6.69291M8.08792 9.43141C8.22115 9.23714 8.37223 9.05608 8.53881 8.89059C8.81687 8.61436 9.13809 8.38152 9.49147 8.20309M8.08792 9.43141L3.17794 6.69291M3.17794 6.69291C3.36291 6.38866 3.56474 6.09581 3.78215 5.81565C4.67215 4.66875 5.82313 3.7345 7.14598 3.102M9.49147 8.20309C9.67712 8.10935 9.87165 8.03063 10.0735 7.96852C10.4218 7.8613 10.7919 7.80359 11.1754 7.80359C11.6728 7.80359 12.1476 7.90068 12.5818 8.07694M9.49147 8.20309L7.14598 3.102M7.14598 3.102C7.59186 2.88881 8.05728 2.7099 8.53881 2.56868C9.37503 2.32345 10.2598 2.19189 11.1754 2.19189C12.3864 2.19189 13.5437 2.42207 14.6058 2.84105M14.6058 2.84105C14.8091 2.92122 15.0088 3.0083 15.2048 3.102C16.0164 3.49005 16.7633 3.99167 17.4249 4.5863C18.0315 5.13146 18.5664 5.75478 19.0138 6.44041M14.0425 9.14136L19.0138 6.44041" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>  
                                 <?php pll_e('Створення СV'); ?>
                              </div>
                           </a>
                        </div>
                        <div class="step-image">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Step1.jpg" alt="<?php echo pll__('Крок'); ?>" />
                        </div>
                     </div>
                     <div class="step step2" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/Step2.jpg">
                        <div class="pill"><span><?php pll_e('Крок 2'); ?></span></div>
                        <h4><?php pll_e('Заповніть форму'); ?></h4>
                        <p>
                           <?php pll_e('У кошику натискаєте «Оформити замовлення» — відкриється форма для заповнення.'); ?>
                        </p>
                        <p>
                           <?php pll_e('Вкажіть свої дані, за потреби прикріпіть файл та залиште коментарі.'); ?>
                        </p>
                        <p>
                           <?php pll_e('Після цього натисніть «Надіслати замовлення» — і ми одразу отримаємо вашу заявку.'); ?>
                        </p>
                        <div class="step-image">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Step2.jpg" alt="<?php echo pll__('Крок'); ?>" />
                        </div>
                     </div>
                     <div class="step step3" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/Step3.jpg">
                        <div class="pill"><span><?php pll_e('Крок 3'); ?></span></div>
                        <h4><?php pll_e('Оплата замовлення'); ?></h4>
                        <ul>
                           <li>
                              <p class="pay">
                                 <?php pll_e('Після заповнення форми отримаєте реквізити для оплати на пошту'); ?>
                              </p>
                           </li>
                           <li>
                              <p class="pay">
                                 <?php pll_e('Оплачуйте зручно: Visa, MasterCard, PayPal.'); ?>
                              </p>
                           </li>
                           <li>
                              <p class="pay">
                                 <?php pll_e('Після підтвердження оплати ми сповістимо вас листом на пошту про запуск розсилки.'); ?>
                              </p>
                           </li>
                        </ul>
                        <div class="step-image">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Step3.jpg" alt="<?php echo pll__('Крок'); ?>" />
                        </div>
                     </div>
                     <div class="step step4" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/step4.jpg">
                        <h4><?php pll_e('Обробка замовлення'); ?></h4>
                        <p class="service-process"><?php pll_e('Надання послуги:'); ?></p>
                        <p>
                           <?php pll_e('Менеджер перевіряє анкету та призначає дату розсилки.'); ?>
                        </p>
                        <p><?php pll_e('Графік: Пн–Пт, з 10:00 до 15:00'); ?></p>
                        <p><?php pll_e('Повторна розсилка — через 7–14 днів.'); ?></p>

                        <p class="service-process mid">
                           <?php pll_e('Лише якісні інструменти та антиспам-перевірка. Ваше резюме потрапляє в INBOX, а не в SPAM.'); ?>
                        </p>
                        <p class="service-process"><?php pll_e('Завершення послуги:'); ?></p>
                        <p>
                           <?php pll_e('Звіт та посилання надсилаються вам на пошту після запуску розсилки.'); ?>
                        </p>
                        <p class="service-process"><?php pll_e('Повторна розсилка:'); ?></p>
                        <p>
                           <?php pll_e('Рекомендуємо робити через 7–14 днів для підвищення ефективності.'); ?>
                        </p>
                        <div class="step-image">   
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/step4.jpg" alt="<?php echo pll__('Крок'); ?>" />
                        </div>
                     </div>
                     <div class="step step5" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/step5.jpg">
                        <h4><?php pll_e('Відправляйтесь у рейс'); ?></h4>
                        <p>
                           <?php pll_e('Отримуйте відповіді, проходьте співбесіди, підписуйте контракт — і вирушайте на новий етап своєї морської карʼєри.'); ?>
                        </p>
                        <div class="step-image">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/step5.jpg" alt="<?php echo pll__('Крок'); ?>" />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

         <section class="sender-block" id="sender-block">
            <div class="wrapper">
               <div class="tab-buttons">
                  <div class="fleet">
                     <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#slider1"
                        ><?php pll_e('⚓ По флоту'); ?>
                        </a
                     >
                  </div>
                  <div class="region">
                     <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#region-wrapper"
                        ><?php pll_e('🌎 По регіонам'); ?></a
                     >
                  </div>
               </div>
               <div class="sender-block_text">
                  <h3><?php pll_e('Розсилка СV'); ?></h3>
                  <p>
                     <?php pll_e('Обери тип флоту, в якому хочеш працювати — і ми розішлемо твоє резюме в найкращі компанії.'); ?>
                  </p>
               </div>
               <div class="fleet-wrapper">
                  <h4><?php pll_e('По флоту'); ?></h4>

                  <div class="fleets-container slider" id="slider1">
                     <button class="slider-btn prev"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/shevron-left.svg" alt="arrow-left" /></button>
                     <div class="slider-track">
                        <div class="fleets-card slide active">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-boat.svg" alt="" />
                           <h4 class="title"><?php pll_e('Торговий флот'); ?></h4>
                           <p class="emails">
                              <span class="count">580</span><?php pll_e('емейлів'); ?>
                           </p>
                           <div class="price">€10</div>
                           <ul>
                              <li>Sontainer</li>
                              <li>General Cargo</li>
                              <li>Bulker</li>
                           </ul>
                           <div class="bottom">
                              <a
                                 href="<?php echo pll_get_post(get_page_by_path('sending')->ID); ?>/#sales-fleet"
                                 class="button-more"
                                 ><?php pll_e('Докладніше'); ?></a
                              >
                              <a
                                 href="#"
                                 class="bucket"
                                 data-id="#1"
                                 data-name="<?php echo pll__('Торговий флот'); ?>"
                                 tabindex="0"
                                 data-price="10"
                                 data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-boat.svg"
                                 data-group="<?php echo pll__('Розсилка CV'); ?>"
                              >
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                    alt="<?php echo pll__('Добавить в корзину'); ?>"
                                 />
                              </a>
                           </div>
                        </div>
                        <div class="fleets-card slide">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-gasoline.svg" alt="" />
                           <h4 class="title"><?php pll_e('Танкерний флот'); ?></h4>
                           <p class="emails">
                              <span class="count">420</span><?php pll_e('емейлів'); ?>
                           </p>
                           <div class="price">€14</div>
                           <ul>
                              <li>Chemical Tankers</li>
                              <li>Crude Oil Tanker</li>
                              <li>LNG, LPG, VLCC</li>
                           </ul>
                           <div class="bottom">
                              <a
                                 href="<?php echo pll_get_post(get_page_by_path('sending')->ID); ?>/#tanker-fleet"
                                 class="button-more"
                                 ><?php pll_e('Докладніше'); ?></a
                              >
                              <a
                                 href="#"
                                 class="bucket"
                                 data-id="#2"
                                 data-name="<?php echo pll__('Танкерний флот'); ?>"
                                 tabindex="0"
                                 data-price="14"
                                 data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-gasoline.svg"
                                 data-group="<?php echo pll__('Розсилка CV'); ?>"
                              >
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                    alt="<?php echo pll__('Добавить в корзину'); ?>"
                                 />
                              </a>
                           </div>
                        </div>
                        <div class="fleets-card slide">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-offshore.svg" alt="" />
                           <h4 class="title"><?php pll_e('Офшорний флот'); ?></h4>
                           <p class="emails">
                              <span class="count">750</span><?php pll_e('емейлів'); ?>
                           </p>
                           <div class="price">€17</div>
                           <ul>
                              <li>Jack-Up</li>
                              <li>DSV, MPSV</li>
                              <li>OSV, AHTS</li>
                           </ul>
                           <div class="bottom">
                              <a
                                 href="<?php echo pll_get_post(get_page_by_path('sending')->ID); ?>/#offshore-fleet"
                                 class="button-more"
                                 ><?php pll_e('Докладніше'); ?></a
                              >
                              <a
                                 href="#"
                                 class="bucket"
                                 data-id="#3"
                                 data-name="<?php echo pll__('Офшорний флот'); ?>"
                                 tabindex="0"
                                 data-price="17"
                                 data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-offshore.svg"
                                 data-group="<?php echo pll__('Розсилка CV'); ?>"
                              >
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                    alt="<?php echo pll__('Добавить в корзину'); ?>"
                                 />
                              </a>
                           </div>
                        </div>
                        <div class="fleets-card slide">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-yacht.svg" alt="" />
                           <h4 class="title"><?php pll_e('Пасажирський флот'); ?></h4>
                           <p class="emails">
                              <span class="count">320</span><?php pll_e('емейлів'); ?>
                           </p>
                           <div class="price">€12</div>
                           <ul>
                              <li>Cruise Liner</li>
                              <li>Ferry</li>
                              <li>Yacht</li>
                           </ul>
                           <div class="bottom">
                              <a
                                 href="<?php echo pll_get_post(get_page_by_path('sending')->ID); ?>/#passanger-fleet"
                                 class="button-more"
                                 ><?php pll_e('Докладніше'); ?></a
                              >
                              <a
                                 href="#"
                                 class="bucket"
                                 data-id="#4"
                                 data-name="<?php echo pll__('Пасажирський флот'); ?>"
                                 tabindex="0"
                                 data-price="12"
                                 data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-yacht.svg"
                                 data-group="<?php echo pll__('Розсилка CV'); ?>"
                              >
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                    alt="<?php echo pll__('Добавить в корзину'); ?>"
                                 />
                              </a>
                           </div>
                        </div>
                     </div>
                     <button class="slider-btn next"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/shevron-left.svg" alt="arrow-right" /></button>
                  </div>
               </div>
               <div class="region-wrapper" id="region-wrapper">
                  <p><?php pll_e('або'); ?></p>
                  <h4><?php pll_e('По регіонам'); ?></h4>
                  <p>
                     <?php pll_e('Хочеш щоб твоє резюме побачили крюїнг менеджери з різних країн? Обери регіон'); ?>
                  </p>
                  <div class="background-layer">
                     <div class="wave"></div>
                     <div class="content-layer">
                        <div class="region-container">
                           <div class="region-card" data-country="europe">
                              <div class="pill-best-seller"><?php pll_e('Хіт продажів'); ?></div>
                              <div class="wrapper">
                                 <div class="left-side">
                                    <div class="countries">
                                       <div class="region-title">
                                          <?php pll_e('Європa 🇪🇺 + Велика Британія 🇬🇧'); ?>
                                       </div>
                                    </div>
                                    <div class="emails">
                                       <span class="count">720</span> <?php pll_e('емейлів'); ?>
                                    </div>
                                    <div class="price">€17</div>
                                 </div>
                                 <div class="right-side">
                                    <a
                                       href="#"
                                       class="bucket"
                                       data-id="#5"
                                       data-name="<?php echo pll__('Європa 🇪🇺 + Велика Британія 🇬🇧'); ?>"      
                                       data-price="17"
                                       data-group="<?php echo pll__('Розсилка CV по регіону'); ?>"
                                    >
                                       <img
                                          src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                          alt="<?php echo pll__('Добавить в корзину'); ?>"
                                       />
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <div class="region-card" data-country="baltic">
                              <div class="wrapper">
                                 <div class="left-side">
                                    <div class="countries">
                                       <div class="region-title">
                                          <?php pll_e('Країни Балтії 🇱🇹🇪🇪🇱🇻'); ?>
                                       </div>
                                    </div>
                                    <div class="emails">
                                       <span class="count">125</span> <?php pll_e('емейлів'); ?>
                                    </div>
                                    <div class="price">€10</div>
                                 </div>
                                 <div class="right-side">
                                    <a
                                       href="#"
                                       data-id="#6"
                                       class="bucket"
                                       data-name="<?php echo pll__('Країни Балтії 🇱🇹🇪🇪🇱🇻'); ?>"
                                 
                                       data-price="10"
                                       data-group="<?php echo pll__('Розсилка CV по регіону'); ?>"
                                    >
                                       <img
                                          src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                          alt="<?php echo pll__('Добавить в корзину'); ?>"
                                       />
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <div
                              class="region-card"
                              data-country="ukrain and georgia"
                           >
                              <div class="wrapper">
                                 <div class="left-side">
                                    <div class="countries">
                                       <div class="region-title">
                                          <?php pll_e('Україна 🇺🇦 + Грузія 🇬🇪'); ?>
                                       </div>
                                    </div>
                                    <div class="emails">
                                       <span class="count">780</span> <?php pll_e('емейлів'); ?>
                                    </div>
                                    <div class="price">€15</div>
                                 </div>
                                 <div class="right-side">
                                    <a
                                       href="#"
                                       data-id="#7"
                                       class="bucket"
                                       data-name="<?php echo pll__('Україна 🇺🇦 + Грузія 🇬🇪'); ?>"
                                      
                                       data-price="15"
                                       data-group="<?php echo pll__('Розсилка CV по регіону'); ?>"
                                    >
                                       <img
                                          src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                          alt="<?php echo pll__('Добавить в корзину'); ?>"
                                       />
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <div class="region-card" data-country="global">
                              <div class="wrapper">
                                 <div class="left-side">
                                    <div class="countries">
                                       <div class="region-title">
                                          <?php pll_e('Весь світ 🌎'); ?>
                                       </div>
                                    </div>
                                    <div class="emails">
                                       <span class="count">1650</span> <?php pll_e('емейлів'); ?>
                                    </div>
                                    <div class="price">€25</div>
                                 </div>
                                 <div class="right-side">
                                    <a
                                       href="#"
                                       data-id="#8"
                                       class="bucket"
                                       data-name="<?php echo pll__('Весь світ 🌎'); ?>"
                                       data-price="25"
                                       data-group="<?php echo pll__('Розсилка CV по регіону'); ?>"
                                    >
                                       <img
                                          src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                          alt="<?php echo pll__('Добавить в корзину'); ?>"
                                       />
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <div class="region-card" data-country="skandinavic">
                              <div class="wrapper">
                                 <div class="left-side">
                                    <div class="countries">
                                       <div class="region-title">
                                          <?php pll_e('Скандинавія 🇳🇴🇸🇪🇫🇮🇩🇰'); ?>
                                       </div>
                                    </div>
                                    <div class="emails">
                                       <span class="count">210</span> <?php pll_e('емейлів'); ?>
                                    </div>
                                    <div class="price">€12</div>
                                 </div>
                                 <div class="right-side">
                                    <a
                                       href="#"
                                       data-id="#9"
                                       class="bucket"
                                       data-name="<?php echo pll__('Скандинавія 🇳🇴🇸🇪🇫🇮🇩🇰'); ?>"
                                       
                                       data-price="12"
                                       data-group="<?php echo pll__('Розсилка CV по регіону'); ?>"
                                    >
                                       <img
                                          src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                          alt="<?php echo pll__('Добавить в корзину'); ?>"
                                       />
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section class="about" id="about">
            <div class="about-wrapper">
               <div class="layout-wrap">
                  <div class="grid-left">
                     <div class="tile-title">
                        <h3><?php pll_e('Про Seafarer'); ?><span class="CV">CV</span></h3>

                        <p><?php pll_e('Нам довіряють понад 50 000 моряків з усього світу.'); ?></p>
                           <p><?php pll_e('Вже понад 3 роки ми допомагаємо кандидатам знайти роботу, надсилаючи їхні дані до перевірених крюїнгів — без ризику потрапити у спам, завдяки надійним інструментам доставки.'); ?></p>
                           <p><?php pll_e('Ми також створюємо візуально привабливі та грамотно структуровані CV, які вигідно вирізняються серед інших.'); ?></p>  
                           <p><?php pll_e('Знаємо, як подати інформацію так, щоб вас помітили.'); ?>
                        </p>
                        <div class="buttons">
                           <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#sender-block" class="sender">
                              <div class="button anchor">
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/anchor-icon.svg"
                                    alt="anchor-icon"
                                 />
                                 <?php pll_e('Розсилка CV'); ?>
                              </div>
                           </a>
                           <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#cv-writer" class="cv-but">
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
                  <div class="grid-right">
                     <div class="about-image">
                        <picture>
                           <source media="(min-width: 1024px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/about-us-img_2.jpg">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-us-img_1.jpg" alt="<?php echo pll__('Усмихаючийся моряк на роботі на судні'); ?>" />
                        </picture>
                     </div>
                     <div class="about-right-tile">
                        <div class="about-right-tile_text">
                           <h6><?php pll_e('Ми працюємо на результат'); ?></h6>
                           <p>
                              <?php pll_e('Наша мета — не просто розіслати ваше резюме,а допомогти вам отримати справжню можливість — ту, на яку ви заслуговуєте.'); ?>
                           </p>
                        </div>
                        <div class="about-right-tile_pills">
                           <div class="process">
                              <div class="process-pill">
                                 <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-checked.svg" alt="" />
                                 <div class="process-pill-text"><?php pll_e('Відповідь'); ?></div>
                              </div>
                              <span class="connector">
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow-right.svg"
                                    alt=""
                                 />
                              </span>
                              <div class="process-pill">
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-interview.svg"
                                    alt=""
                                 />
                                 <div class="process-pill-text"><?php pll_e('Співбесіда'); ?></div>
                              </div>
                              <span class="connector">
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-arrow-right.svg"
                                    alt=""
                                 />
                              </span>
                              <div class="process-pill">
                                 <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-contract.svg" alt="" />
                                 <div class="process-pill-text"><?php pll_e('Контракт'); ?></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="about-tiles">
                  <div class="tile-container">
                     <div class="tile-item">
                        <div class="text">
                           <h2>50 000+</h2>
                           <p><?php pll_e('Моряків довірили нам свої CV'); ?></p>
                        </div>
                     </div>
                     <div class="tile-item">
                        <div class="text">
                           <h2>87%</h2>
                           <p><?php pll_e('Клієнтів отримують відповідь до 14 днів'); ?></p>
                        </div>
                     </div>
                     <div class="tile-item">
                        <div class="text">
                           <h2>7 200+</h2>
                           <p><?php pll_e('Цільових розсилок щомісяця'); ?></p>
                        </div>
                     </div>
                     <div class="tile-item">
                        <div class="text">
                           <h2>1 300+</h2>
                           <p><?php pll_e('Унікальних резюме створено вручну'); ?></p>
                        </div>
                     </div>
                     <div class="tile-item tile-item-image">
                        <picture>
                           <source media="(min-width: 1024px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/about-us-ROI_2.jpg">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-us-ROI_1.jpg" alt="<?php echo pll__('Моряки у рубці дивляться в моніторинг керуя судном'); ?>" />
                        </picture>
                     </div>
                     <div class="tile-item">
                        <div class="text">
                           <h2>3+</h2>
                           <p><?php pll_e('Роки успішної роботи'); ?></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
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
                              <a
                                 href="<?php echo pll_get_post(get_page_by_path('cv-writer')->ID); ?>/#cv-writer-start"
                                 class="button-more"
                                 ><?php pll_e('Докладніше'); ?></a
                              >
                              <a
                                 href="#"
                                 class="bucket"
                                 data-id="#10"
                                 data-name="<?php echo pll__('Стартовий'); ?>"
                                 data-price="10"
                                 data-group="<?php echo pll__('Створення CV'); ?>"
                                 data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv1.svg"
                              >
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                    alt="<?php echo pll__('Добавить в корзину'); ?>"
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
                              <a
                                 href="<?php echo pll_get_post(get_page_by_path('cv-writer')->ID); ?>/#cv-writer-ranks"
                                 class="button-more"
                                 ><?php pll_e('Докладніше'); ?></a
                              >
                              <a
                                 href="#"
                                 class="bucket"
                                 data-id="#11"
                                 data-name="<?php echo pll__('Рядовий'); ?>"
                                 data-price="17"
                                 data-group="<?php echo pll__('Створення CV'); ?>"
                                 data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv2.svg"
                              >
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                    alt="<?php echo pll__('Добавить в корзину'); ?>"
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
                              <a
                                 href="<?php echo pll_get_post(get_page_by_path('cv-writer')->ID); ?>/#cv-writer-oficers"
                                 class="button-more"
                                 ><?php pll_e('Докладніше'); ?></a
                              >
                              <a
                                 href="#"
                                 class="bucket"
                                 data-id="#12"
                                 data-name="<?php echo pll__('Офіцери'); ?>"
                                 data-price="23"
                                 data-group="<?php echo pll__('Створення CV'); ?>"
                                 data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-cv3.svg"
                              >
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                    alt="<?php echo pll__('Добавить в корзину'); ?>"
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
         <section class="previl" id="previl-block">
            <div class="wrapper">
               <div class="previl-text">
                  <h3><?php pll_e('Що нас відрізняє від інших'); ?></h3>
                  <p>
                     <?php pll_e('Ми не просто надаємо послугу — ми допомагаємо морякам отримати результат. Досвід, якість, підтримка та сервіс, якому довіряють тисячі.'); ?>
                  </p>
               </div>
               <div class="tile-container">
                  <div class="tile-item">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sms-tracking.svg" alt="" />
                     <div class="text">
                        <h6><?php pll_e('Гарантована доставка'); ?></h6>
                        <p>
                           <?php pll_e('Ваше CV не потрапляє в спам — ми використовуємо антиспам-фільтри та перевірені методи розсилки.'); ?>
                        </p>
                     </div>
                  </div>
                  <div class="tile-item">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-CV.svg" alt="" />
                     <div class="text">
                        <h6><?php pll_e('CV, яке помічають'); ?></h6>
                        <p>
                           <?php pll_e('Ми створюємо резюме, що виділяється серед сотень — структуроване, візуально сильне, з акцентом на досвід.'); ?>
                        </p>
                     </div>
                  </div>
                  <div class="tile-item">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-folder.svg" alt="" />
                     <div class="text">
                        <h6><?php pll_e('Все в одному місці'); ?></h6>
                        <p>
                           <?php pll_e('Створення CV, розсилка за флотом і регіоном — усе на одному сервісі, без зайвих кроків.'); ?>
                        </p>
                     </div>
                  </div>
                  <div class="tile-item">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-blank.svg" alt="" />
                     <div class="text">
                        <h6><?php pll_e('Супровідний лист'); ?></h6>
                        <p>
                           <?php pll_e('Ми додаємо до вашого CV супровідний лист англійською, адаптований саме під вас.'); ?>
                        </p>
                     </div>
                  </div>
                  <div class="tile-item tile-item-image">
                  <picture>
                           <source media="(min-width: 1024px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/features-img1_2.jpg">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/images/features-img1_1.jpg" alt="<?php echo pll__('Моряк дивиться в бінокль у відкритому морі'); ?>" />
                        </picture>
                    
                  </div>
                  <div class="tile-item">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-headphones.svg" alt="" />
                     <div class="text">
                        <h6><?php pll_e('Супровід і підтримка'); ?></h6>
                        <p>
                           <?php pll_e('Ми на зв\'язку: консультуємо, враховуємо побажання, допомагаємо до результату — співбесіди чи контракту.'); ?>
                        </p>
                     </div>
                  </div>
               </div>
               <div class="button-container">
                  <div class="buttons">
                     <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#sender-block" class="sender">
                        <div class="button anchor">
                           <img
                              src="<?php echo get_template_directory_uri(); ?>/assets/images/anchor-icon.svg"
                              alt="anchor-icon"
                           />
                           <?php pll_e('Розсилка CV'); ?>
                        </div>
                     </a>

                     <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#cv-writer" class="cv-but">
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
         </section>

         <section class="carusel_logo">
            <div class="carusel-text">
               <h6><?php pll_e('Нам довіряють компанії в усьому світі'); ?></h6>
            </div>
            <div class="carusel-wrapper">
               <div class="logos-slides">
                  <img
                     class="v-group"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/v-group.svg"
                     alt="V.Group logo"
                  />
                  <img
                     class="Anglo"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/Anglo.svg"
                     alt="Anglo-Eastern Univan Group logo"
                  />
                  <img
                     class="BSM"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/BSM.svg"
                     alt="Bernhard Schulte Shipmanagement (BSM) logo"
                  />
                  <img
                     class="Wilhelmsen"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/Wilhelmsen.svg"
                     alt="Wilhelmsen Ship Management logo"
                  />
                  <img
                     class="CSM"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/CSM.svg"
                     alt="Columbia Shipmanagement logo"
                  />
                  <img
                     class="synergy"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/synergy.svg"
                     alt="Synergy Marine Group logo"
                  />
                  <img
                     class="Osm"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/Osm.svg"
                     alt="OSM Thome logo"
                  />
                  <img
                     class="Boskalis"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/Boskalis.svg"
                     alt="Boskalis logo"
                  />
                  <img
                     class="MSC"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/msc.svg"
                     alt="MSC logo"
                  />
                  <img
                     class="Marlow"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/Marlow.svg"
                     alt="Marlow Navigation logo"
                  />

                  <img
                     class="v-group"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/v-group.svg"
                     alt="V.Group logo"
                  />
                  <img
                     class="Anglo"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/Anglo.svg"
                     alt="Anglo-Eastern Univan Group logo"
                  />
                  <img
                     class="BSM"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/BSM.svg"
                     alt="Bernhard Schulte Shipmanagement (BSM) logo"
                  />
                  <img
                     class="Wilhelmsen"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/Wilhelmsen.svg"
                     alt="Wilhelmsen Ship Management logo"
                  />
                  <img
                     class="CSM"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/CSM.svg"
                     alt="Columbia Shipmanagement logo"
                  />
                  <img
                     class="synergy"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/synergy.svg"
                     alt="Synergy Marine Group logo"
                  />
                  <img
                     class="Osm"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/Osm.svg"
                     alt="OSM Thome logo"
                  />
                  <img
                     class="Boskalis"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/Boskalis.svg"
                     alt="Boskalis logo"
                  />
                  <img
                     class="MSC"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/msc.svg"
                     alt="MSC logo"
                  />
                  <img
                     class="Marlow"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/logos/Marlow.svg"
                     alt="Marlow Navigation logo"
                  />
               </div>
            </div>
         </section>
         <section class="reviews" id="reviews">
            <div class="bkg">
               <div class="reviews-wrapper">
                  <div class="reviews-layout">
                     <div class="grid-left">
                        <div class="grid-left-wrapper">
                           <div class="ratings">
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Rating.svg" alt="<?php echo pll__('Рейтинг'); ?>" />
                           </div>
                           <div class="review-title">
                              <h3><?php pll_e('Відгуки наших клієнтів'); ?></h3>
                           </div>
                           <div class="review-subtitle">
                              <p>
                                 <?php pll_e('Допомагаємо морякам отримувати не просто відповіді — а реальні запрошення на співбесіди та контракти.'); ?>
                              </p>
                              <p>
                                 <?php pll_e('Читайте, що пишуть моряки після користування нашими послугами.'); ?>
                              </p>
                           </div>
                           <div class="review-tile">
                              <div class="review-tile-count">
                                 <h2>1 200+</h2>
                              </div>
                              <div class="review-tile-subtext">
                                 <p>
                                    <?php pll_e('Позитивних відгуків у Telegram, WhatsApp та Viber'); ?>
                                 </p>
                              </div>
                           </div>
                           <div class="review-buttons">
                              <div class="button-container">
                                 <div class="buttons">
                                    <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#sender-block" class="sender">
                                       <div class="button anchor">
                                          <img
                                             src="<?php echo get_template_directory_uri(); ?>/assets/images/anchor-icon.svg"
                                             alt="anchor-icon"
                                          />
                                          <?php pll_e('Розсилка CV'); ?>
                                       </div>
                                    </a>

                                    <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#cv-writer" class="cv-but">
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
                     </div>
                     <div class="grid-right">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/reviews-goup.png" alt="<?php echo pll__('Вiдгуки клієнтів яки скористались нашими послугами'); ?>" />
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
                        <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#sender-block" class="sender">
                           <div class="button anchor">
                              <img
                                 src="<?php echo get_template_directory_uri(); ?>/assets/images/anchor-icon.svg"
                                 alt="anchor-icon"
                              />
                              <?php pll_e('Розсилка CV'); ?>
                           </div>
                        </a>

                        <a href="<?php echo pll_get_post(get_page_by_path('front-page')->ID); ?>#cv-writer" class="cv-but">
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