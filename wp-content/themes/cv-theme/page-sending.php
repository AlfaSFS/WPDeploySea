<?php
/*
Template Name: Sending Page
*/

get_header(); ?>

<main>
   <section class="sender-block" id="sender-block">
      <div class="wrapper">
         <div class="tab-buttons">
            <div class="fleet">
               <a href="#slider1"
                  ><?php pll_e("⚓ По флоту"); ?></a
               >
            </div>
            <div class="region">
               <a href="#sending-region-wrapper"
                  ><?php pll_e("🌎 По регіонам"); ?></a
               >
            </div>
         </div>
         <div class="sender-block_text">
            <h3><?php pll_e("Розсилка СV"); ?></h3>
            <p>
               <?php pll_e("Обери тип флоту, в якому хочеш працювати — і ми розішлемо
               твоє резюме в найкращі компанії."); ?>
            </p>
         </div>
         <div class="fleet-wrapper">
            <h4><?php pll_e("По флоту"); ?></h4>

            <div class="fleets-container slider" id="slider1">
               <button class="slider-btn prev"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/shevron-left.svg" alt="arrow-left" /></button>
               <div class="slider-track">
                  <div class="fleets-card slide active">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-boat.svg" alt="" />
                     <h4 class="title"><?php pll_e("Торговий флот"); ?></h4>
                     <p class="emails">
                        <span class="count">580</span>емейлів
                     </p>
                     <div class="price">€10</div>
                     <ul>
                        <li>Сontainer</li>
                        <li>General Cargo</li>
                        <li>Bulker</li>
                     </ul>
                     <div class="bottom">
                        <a href="#sales-fleet" class="button-more"
                           ><?php pll_e("Докладніше"); ?></a
                        >
                        <a
                           href="#"
                           class="bucket"
                           data-id="#1"
                           data-name="Торговий флот"
                           data-price="10"
                           data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-boat.svg"
                           data-group="Розсилка CV"
                        >
                           <img
                              src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                              alt="Добавить в корзину"
                           />
                        </a>
                     </div>
                  </div>
                  <div class="fleets-card slide">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-gasoline.svg" alt="" />
                     <h4 class="title"><?php pll_e("Танкерний флот"); ?></h4>
                     <p class="emails">
                        <span class="count">420</span>емейлів
                     </p>
                     <div class="price">€14</div>
                     <ul>
                        <li>Chemical Tankers</li>
                        <li>Crude Oil Tanker</li>
                        <li>LNG, LPG, VLCC</li>
                     </ul>
                     <div class="bottom">
                        <a href="#tanker-fleet" class="button-more"
                           ><?php pll_e("Докладніше"); ?></a
                        >
                        <a
                           href="#"
                           class="bucket"
                           data-id="#2"
                           data-name="Танкерний флот"
                           data-price="14"
                           data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-gasoline.svg"
                           data-group="Розсилка CV"
                        >
                           <img
                              src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                              alt="Добавить в корзину"
                           />
                        </a>
                     </div>
                  </div>
                  <div class="fleets-card slide">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-offshore.svg" alt="" />
                     <h4 class="title"><?php pll_e("Офшорний флот"); ?></h4>
                     <p class="emails">
                        <span class="count">750</span>емейлів
                     </p>
                     <div class="price">€17</div>
                     <ul>
                        <li>Jack-Up</li>
                        <li>DSV, MPSV</li>
                        <li>OSV, AHTS</li>
                     </ul>
                     <div class="bottom">
                        <a href="#offshore-fleet" class="button-more"
                           ><?php pll_e("Докладніше"); ?></a
                        >
                        <a
                           href="#"
                           class="bucket"
                           data-id="#3"
                           data-name="Офшорний флот"
                           data-price="17"
                           data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-boat.svg"
                           data-group="Розсилка CV"
                        >
                           <img
                              src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                              alt="Добавить в корзину"
                           />
                        </a>
                     </div>
                  </div>
                  <div class="fleets-card slide">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-yacht.svg" alt="" />
                     <h4 class="title"><?php pll_e("Пасажирський флот"); ?></h4>
                     <p class="emails">
                        <span class="count">320</span>емейлів
                     </p>
                     <div class="price">€12</div>
                     <ul>
                        <li>Cruise Liner</li>
                        <li>Ferry</li>
                        <li>Yacht</li>
                     </ul>
                     <div class="bottom">
                        <a href="#passanger-fleet" class="button-more"
                           ><?php pll_e("Докладніше"); ?></a
                        >
                        <a
                           href="#"
                           class="bucket"
                           data-id="#4"
                           data-name="Пасажирський флот"
                           data-price="12"
                           data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-boat.svg"
                           data-group="Розсилка CV"
                        >
                           <img
                              src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                              alt="Добавить в корзину"
                           />
                        </a>
                     </div>
                  </div>
               </div>
               <button class="slider-btn next"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/shevron-left.svg" alt="arrow-right" /></button>
            </div>
         </div>
         <div class="region-wrapper" id="sending-region-wrapper">
            <p><?php pll_e("або"); ?></p>
            <h4><?php pll_e("По регіонам"); ?></h4>
            <p>
               <?php pll_e("Хочеш щоб твоє резюме побачили крюїнг менеджери з різних
               країн? Обери регіон"); ?>
            </p>
            <div class="background-layer">
               <div class="wave"></div>
               <div class="content-layer">
                  <div class="region-container">
                     <div class="region-card" data-country="europe">
                        <div class="pill-best-seller"><?php pll_e("Хіт продажів"); ?></div>
                        <div class="wrapper">
                           <div class="left-side">
                              <div class="countries">
                                 <div class="region-title">
                                    <?php pll_e("Європa 🇪🇺 + Велика Британія 🇬🇧"); ?>
                                 </div>
                              </div>
                              <div class="emails">
                                 <span class="count">720</span> емейлів
                              </div>
                              <div class="price">€17</div>
                           </div>
                           <div class="right-side">
                              <a
                                 href="#"
                                 class="bucket"
                                 data-id="#5"
                                 data-name="<?php pll_e("Європa 🇪🇺 + Велика Британія 🇬🇧"); ?>"
                                 
                                 data-price="17"
                                 data-group="Розсилка CV по регіону"
                              >
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                    alt="Добавить в корзину"
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
                                    <?php pll_e("Країни Балтії 🇱🇹🇪🇪🇱🇻"); ?>
                                 </div>
                              </div>
                              <div class="emails">
                                 <span class="count">125</span> емейлів
                              </div>
                              <div class="price">€10</div>
                           </div>
                           <div class="right-side">
                              <a
                                 href="#"
                                 class="bucket"
                                 data-id="#6"
                                 data-name="<?php pll_e("Країни Балтії 🇱🇹🇪🇪🇱🇻"); ?>"
                                 
                                 data-price="10"
                                 data-group="Розсилка CV по регіону"
                              >
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                    alt="Добавить в корзину"
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
                                    <?php pll_e("Україна 🇺🇦 + Грузія 🇬🇪"); ?>
                                 </div>
                              </div>
                              <div class="emails">
                                 <span class="count">780</span> емейлів
                              </div>
                              <div class="price">€15</div>
                           </div>
                           <div class="right-side">
                              <a
                                 href="#"
                                 class="bucket"
                                 data-id="#7"
                                 data-name=" <?php pll_e("Україна 🇺🇦 + Грузія 🇬🇪"); ?>"
                                 
                                 data-price="15"
                                 data-group="Розсилка CV по регіону"
                              >
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                    alt="Добавить в корзину"
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
                                    <?php pll_e("Весь світ 🌎"); ?>
                                 </div>
                              </div>
                              <div class="emails">
                                 <span class="count">1650</span> емейлів
                              </div>
                              <div class="price">€25</div>
                           </div>
                           <div class="right-side">
                              <a
                                 href="#"
                                 data-id="#8"
                                 class="bucket"
                                 data-name="<?php pll_e("Весь світ 🌎"); ?>"
                           
                                 data-price="25"
                                 data-group="Розсилка CV по регіону"
                              >
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                    alt="Добавить в корзину"
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
                                    <?php pll_e("Скандинавія 🇳🇴🇸🇪🇫🇮🇩🇰"); ?>
                                 </div>
                              </div>
                              <div class="emails">
                                 <span class="count">210</span> емейлів
                              </div>
                              <div class="price">€12</div>
                           </div>
                           <div class="right-side">
                              <a
                                 href="#"
                                 class="bucket"
                                 data-id="#9"
                                 data-name="<?php pll_e("Скандинавія 🇳🇴🇸🇪🇫🇮🇩🇰"); ?>"
                                 data-price="12"
                                 data-group="Розсилка CV по регіону"
                                 
                              >
                                 <img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                                    alt="Добавить в корзину"
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
   <section class="fleets-blaids" id="fleets-blaids">
      <div class="wrapper">
         <div class="blade fleet sales" id="sales-fleet">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-boat.svg" alt="icon boat" />
            <div class="fleet-title">
               <h3><?php pll_e("Торговий флот"); ?></h3>
            </div>
            <div class="fleet-subtitle">
               <p><?php pll_e("Спеціалізована розсилка для торгового флоту"); ?></p>
            </div>
            <div class="layout">
               <div class="grid-left">
                  <div class="fleet-list">
                     <ul>
                        <li>
                           <div class="fleet-list--title">
                              <?php pll_e("Суховантажі та контейнеровози"); ?>
                           </div>
                           <div class="fleet-list--items">
                              Bulk Carrier, Container Ship, Car Carrier,
                              Cement carrier, Coaster, Deck Cargo, Dry
                              Cargo
                           </div>
                        </li>
                        <li>
                           <div class="fleet-list--title">
                              <?php pll_e("Спеціалізовані судна"); ?>
                           </div>
                           <div class="fleet-list--items">
                              General Cargo, Heavy Lift Vessel, Barge
                              Carrier, Livestock, Log-Tipping Ship,
                              Multi-Purpose Vessel, Reefer
                           </div>
                        </li>
                        <li>
                           <div class="fleet-list--title">
                              <?php pll_e("Ro-Ro судна"); ?>
                           </div>
                           <div class="fleet-list--items">
                              Feeder Container, Lo-Ro, Ro-Flo, Ro-Ro
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div class="fleet-item--buttons">
                     <a
                        href="#"
                        tabindex="0"
                        class="busket-btn bucket"
                        data-id="#1"
                        data-name="Торговий флот"
                        data-price="10"
                        data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-boat.svg"
                        data-group="Розсилка CV"
                     >
                        <img
                           src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                           alt=""
                        />€10
                     </a>
                     <div class="flet-item--emails">
                        <div class="emails-count">580</div>
                        <div class="emails-text"><?php pll_e("емейлів"); ?></div>
                     </div>
                  </div>
               </div>
               <div class="grid-right">
                  <img
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/sales-fleet-IMG.jpg"
                     alt="Конетеноровоз на воді"
                  />
               </div>
            </div>
         </div>
         <div class="blade fleet tanker" id="tanker-fleet">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-gasoline.svg" alt="icon gasoline" />
            <div class="fleet-title">
               <h3><?php pll_e("Танкерний флот"); ?></h3>
            </div>
            <div class="fleet-subtitle">
               <p>Спеціалізована розсилка для танкерів усіх типів</p>
            </div>
            <div class="layout">
               <div class="grid-left">
                  <img
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/tanker-fleet-IMG.jpg"
                     alt="Газовоз"
                  />
               </div>
               <div class="grid-right">
                  <div class="fleet-list">
                     <ul>
                        <li>
                           <div class="fleet-list--title">
                              Нафтотанкери
                           </div>
                           <div class="fleet-list--items">
                              VLCC/ULCC, Crude Oil Tanker, Product Tanker,
                              Oil Tanker, Oil Product Tanker, Tanker
                              Product, Tanker Crude, Bunkering Vessel,
                              Shuttle Tanker, FSO, Tanker Storage
                           </div>
                        </li>
                        <li>
                           <div class="fleet-list--title">Хімовози</div>
                           <div class="fleet-list--items">
                              Chemical Tanker, Chem/Oil Tanker, Bitumen
                              Tanker, Tank-Cleaning Vessel
                           </div>
                        </li>
                        <li>
                           <div class="fleet-list--title">Газовози</div>
                           <div class="fleet-list--items">
                              LPG Tanker, LNG Tanker, Gas Tanker
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div class="fleet-item--buttons">
                     <a
                        href="#"
                        tabindex="0"
                        class="busket-btn bucket"
                        data-id="#2"
                        data-name="Танкерний флот"
                        data-price="14"
                        data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-gasoline.svg"
                        data-group="Розсилка CV"
                     >
                        <img
                           src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                           alt=""
                        />€14
                     </a>
                     <div class="flet-item--emails">
                        <div class="emails-count">420</div>
                        <div class="emails-text"><?php pll_e("емейлів"); ?></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="blade fleet offshore" id="offshore-fleet">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-offshore.svg" alt="offshore icon" />
            <div class="fleet-title">
               <h3><?php pll_e("Офшорний флот"); ?></h3>
            </div>
            <div class="fleet-subtitle">
               <p><?php pll_e("Спеціалізована розсилка для офшорного флоту"); ?></p>
            </div>
            <div class="layout">
               <div class="grid-left">
                  <div class="fleet-list">
                     <ul>
                        <li>
                           <div class="fleet-list--title">
                              Платформи та бурові судна
                           </div>
                           <div class="fleet-list--items">
                              Jack-Up Rig, Semi-Submersible Rig, Drillship,
                              Platform Supply Vessel, Anchor Handling Tug
                              Supply, Multi-Purpose Support Vessel
                           </div>
                        </li>
                        <li>
                           <div class="fleet-list--title">
                              <?php pll_e("Спеціалізовані судна"); ?>
                           </div>
                           <div class="fleet-list--items">
                              Construction Vessel, Diving Support Vessel,
                              Cable Layer, Pipe Layer, Heavy Lift Vessel
                           </div>
                        </li>
                        <li>
                           <div class="fleet-list--title">
                              Допоміжні судна
                           </div>
                           <div class="fleet-list--items">
                              Standby Vessel, Emergency Response Vessel,
                              Survey Vessel, Research Vessel
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div class="fleet-item--buttons">
                     <a
                        href="#"
                        tabindex="0"
                        class="busket-btn bucket"
                        data-id="#3"
                        data-name="Офшорний флот"
                        data-price="17"
                        data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-offshore.svg"
                        data-group="Розсилка CV"
                     >
                        <img
                           src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                           alt=""
                        />€17
                     </a>
                     <div class="flet-item--emails">
                        <div class="emails-count">750</div>
                        <div class="emails-text"><?php pll_e("емейлів"); ?></div>
                     </div>
                  </div>
               </div>
               <div class="grid-right">
                  <img
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/offshore-fleet-IMG.jpg"
                     alt="Офшорний флот"
                  />
               </div>
            </div>
         </div>
         <div class="blade fleet passanger" id="passanger-fleet">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-yacht.svg" alt="yacht icon" />
            <div class="fleet-title">
               <h3><?php pll_e("Пасажирський флот"); ?></h3>
            </div>
            <div class="fleet-subtitle">
               <p><?php pll_e("Спеціалізована розсилка для пасажирського флоту"); ?></p>
            </div>
            <div class="layout">
               <div class="grid-left">
                  <img
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/passanger-fleet-IMG.jpg"
                     alt="Круїз лайнер"
                  />
               </div>
               <div class="grid-right">
                  <div class="fleet-list">
                     <ul>
                        <li>
                           <div class="fleet-list--title">
                              Круїзні лайнери
                           </div>
                           <div class="fleet-list--items">
                              Cruise Ship, Mega Yacht, Luxury Liner,
                              Passenger Ship, Ocean Liner
                           </div>
                        </li>
                        <li>
                           <div class="fleet-list--title">
                              Пароми та катамарани
                           </div>
                           <div class="fleet-list--items">
                              Ferry, Catamaran, High-Speed Ferry,
                              Passenger Ferry, Car Ferry
                           </div>
                        </li>
                        <li>
                           <div class="fleet-list--title">
                              Яхти та човни
                           </div>
                           <div class="fleet-list--items">
                              Yacht, Motor Yacht, Sailing Yacht,
                              Charter Yacht, Private Yacht
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div class="fleet-item--buttons">
                     <a    
                        href="#"
                        tabindex="0"
                        class="busket-btn bucket"
                        data-id="#4"
                        data-name="Пасажирський флот"
                        data-price="12"
                        data-icon="<?php echo get_template_directory_uri(); ?>/assets/images/icon-yacht.svg"
                        data-group="Розсилка CV"
                     >
                        <img
                           src="<?php echo get_template_directory_uri(); ?>/assets/images/basket-icon-white.svg"
                           alt=""
                        />€12
                     </a>
                     <div class="flet-item--emails">
                        <div class="emails-count">320</div>
                        <div class="emails-text"><?php pll_e("емейлів"); ?></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
               </div>
      </section>
      
      <section class="steps" id="steps">
         <div class="wrapper">
            <div class="steps-text">
               <h3>Як працює розсилка</h3>
               <p>
                  Максимальне охоплення, професійна перевірка і доставка
                  вашого резюме прямо в INBOX, а не в SPAM.
               </p>
            </div>
            <div class="container">
               <div class="left-side">
                  <div class="image-wrapper">
                     <img
                        id="step-image"
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/Step1.jpg"
                        alt="Крок"
                     />
                  </div>
               </div>
               <div class="right-side">
                  <div class="step step1" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/Step1.jpg">
                     <div class="pill"><span>Крок 1</span></div>
                     <h4>Оберіть послугу</h4>
                     <p>
                        Виберіть розсилку за типом флоту, регіонами або
                        замовте обидві разом для максимального охоплення.
                     </p>

                     <div class="buttons">
                        <a href="#sender-block" class="sender">
                           <div class="button anchor">
                              <img
                                 src="<?php echo get_template_directory_uri(); ?>/assets/images/anchor-icon.svg"
                                 alt="anchor-icon"
                              />
                              Розсилка CV
                           </div>
                        </a>
                     </div>
                     <div class="step-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Step1.jpg" alt="Крок" />
                     </div>
                  </div>
                  <div class="step step2" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/Step2.jpg">
                     <div class="pill"><span>Крок 2</span></div>
                     <h4>Заповніть форму та додайте резюме</h4>
                     <p>
                        Вкажіть свої дані та резюме, або замовте професійне
                        CV у нас — і збільшіть свої шанси отримати контракт у
                        найкращих компаніях.
                     </p>
                     <div class="step-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Step2.jpg" alt="Крок" />
                        </div>
                  </div>
                  <div
                     class="step step3"
                     data-image="<?php echo get_template_directory_uri(); ?>/assets/images/sender-Step3.jpg"
                  >
                     <div class="pill"><span>Крок 3</span></div>
                     <h4>Запуск розсилки</h4>
                     <p>
                        Наш менеджер перевірить анкету, підготує супровідний
                        лист і відправить ваше CV перевіреним роботодавцям.
                     </p>
                     <div class="step-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sender-Step3.jpg" alt="Крок" />
                        </div>
                  </div>
                  <div
                     class="step step4"
                     data-image="<?php echo get_template_directory_uri(); ?>/assets/images/sender-Step4.jpg"
                  >
                     <div class="pill"><span>Крок 4</span></div>
                     <h4>Отримуйте пропозиції</h4>

                     <p>
                        Вам почнуть надходити запрошення на співбесіди та
                        пропозиції контрактів від компаній-роботодавців.
                     </p>
                     <div class="step-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sender-Step4.jpg" alt="Крок" />
                        </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      
      <section class="faq" id="faq">
            <h3 class="faq-title">Маєте питання?</h3>
            <h6 class="faq-subtitle">
               Ми зібрали відповіді на найпоширеніші запити, щоб вам було
               зручніше.
            </h6>

            <div class="faq-item">
               <button class="faq-question" type="button" tabindex="0">
                  Що входить у вартість створення CV?
                  <span class="arrow"></span>
               </button>
               <div class="faq-answer">
                  <p>У вартість входить: професійне оформлення резюме, розробка індивідуального дизайну, складання супровідного листа, консультація з кар’єрним консультантом і адаптація під ваш досвід та обрану посаду.</p>
                  <p>Для  кандидатів без досвіду роботи ми даруємо в подарунок безкоштовну розсилку по крюїнгах України  та Грузії.</p>
               </div>
            </div>

            <div class="faq-item">
               <button class="faq-question" type="button" tabindex="0">
               Чи можна замовити лише розсилку без створення CV?
                  <span class="arrow"></span>
               </button>
               <div class="faq-answer">
                  <p>
                  Так, така можливість є. Ви можете надати власне готове резюме, а ми допоможемо з його розсилкою по відповідних компаніях чи типах флоту . За потреби, наш консультант згенерує супровідний лист під Ваше резюме та з урахуванням вашого досвіду- це покращить впізнаванність Вашого резюме та допоможе не загубитись в почтовій скринці крюїнг менеджера.
                  </p>
               </div>
            </div>
            <div class="faq-item">
               <button class="faq-question" type="button" tabindex="0">
                  Як зі мною зв’яжеться консультант?
                  <span class="arrow"></span>
               </button>
               <div class="faq-answer">
                  <p>
                  Після оформлення замовлення з вами зв’яжеться наш консультант у зручний для вас спосіб — телефоном, електронною поштою або в месенджері. Ви зможете обговорити всі деталі, побажання та поставити додаткові запитання.
                  </p>
               </div>
            </div>
         </section>
      
      <section class="cta-block" id="cta-block">
         <div class="bg-image-wave"></div>
         <div class="bg-image-vector"></div>
         <div class="cta-block-wrapper">
            <div class="cta-block-text">
               <h3>Зробіть перший крок до роботи мрії</h3>
               <p>Ми створимо і надішлемо резюме туди, де на вас чекають.</p>
            </div>
            <div class="cta-block-buttons">
               <div class="button-container">
                  <div class="buttons">
                     <a href="#sender-block" class="sender">
                        <div class="button anchor">
                           <img
                              src="<?php echo get_template_directory_uri(); ?>/assets/images/anchor-icon.svg"
                              alt="anchor-icon"
                           />
                           Розсилка CV
                        </div>
                     </a>

                     <a href="<?php echo home_url('/cv-writer/'); ?>" class="cv-but">
                        <div class="button cv">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <path d="M16.8624 13.5487C17.3471 15.2778 18.7 16.6306 20.4362 17.1226M17.6799 12.7312L11.9791 18.432C11.762 18.649 11.545 19.0759 11.5016 19.387L11.1905 21.5646C11.0748 22.3531 11.6318 22.9029 12.4204 22.7944L14.598 22.4833C14.9018 22.4399 15.3287 22.2229 15.5529 22.0059L21.2537 16.3051C22.2376 15.3212 22.7007 14.1781 21.2537 12.7312C19.8068 11.2843 18.6638 11.7473 17.6799 12.7312Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20.528 11.5445C20.528 10.6226 20.3946 9.73192 20.1461 8.89059C19.9548 8.24273 19.6951 7.62417 19.3755 7.04322C19.2623 6.83744 19.1416 6.63638 19.0138 6.44041M11.1754 20.8972C10.0269 20.8972 8.92672 20.6901 7.9102 20.3114M12.8593 8.20309C13.1447 8.34719 13.4091 8.52679 13.6468 8.73607M12.8593 8.20309C12.7688 8.15741 12.6763 8.1153 12.5818 8.07694M12.8593 8.20309L14.6058 2.84105M13.6468 8.73607L12.5818 8.07694M13.6468 8.73607C13.7886 8.861 13.9209 8.99651 14.0425 9.14136M14.322 13.5689C14.6982 12.9854 14.9164 12.2905 14.9164 11.5446C14.9164 11.0132 14.8056 10.5076 14.6058 10.0498C14.4617 9.7194 14.2711 9.41384 14.0425 9.14136M14.322 13.5689C14.1339 13.8607 13.9063 14.1247 13.6468 14.3532C13.4958 14.4861 13.3341 14.6071 13.163 14.7146C12.8968 14.8818 12.608 15.0165 12.3023 15.113C11.9467 15.2252 11.5681 15.2857 11.1754 15.2857C10.6515 15.2857 10.1528 15.178 9.70022 14.9836C9.5218 14.907 9.35054 14.8169 9.18772 14.7146M14.322 13.5689L16.0048 14.3532M9.18772 14.7146C8.95252 14.5668 8.73493 14.3935 8.53881 14.1987C8.293 13.9545 8.08093 13.6764 7.9102 13.372M9.18772 14.7146L7.9102 20.3114M7.9102 20.3114C6.49019 19.7823 5.23338 18.9181 4.23593 17.8149C3.63656 17.1519 3.13085 16.4027 2.73966 15.5881M7.9102 13.372C7.69746 12.9926 7.54891 12.5725 7.47925 12.1262C7.44968 11.9367 7.43433 11.7424 7.43433 11.5446C7.43433 10.7605 7.67558 10.0327 8.08792 9.43141M7.9102 13.372L2.73966 15.5881M2.73966 15.5881C2.23123 14.5294 1.91626 13.3601 1.84055 12.1262C1.82874 11.9338 1.82275 11.7399 1.82275 11.5445C1.82275 9.76814 2.318 8.10742 3.17794 6.69291M8.08792 9.43141C8.22115 9.23714 8.37223 9.05608 8.53881 8.89059C8.81687 8.61436 9.13809 8.38152 9.49147 8.20309M8.08792 9.43141L3.17794 6.69291M3.17794 6.69291C3.36291 6.38866 3.56474 6.09581 3.78215 5.81565C4.67215 4.66875 5.82313 3.7345 7.14598 3.102M9.49147 8.20309C9.67712 8.10935 9.87165 8.03063 10.0735 7.96852C10.4218 7.8613 10.7919 7.80359 11.1754 7.80359C11.6728 7.80359 12.1476 7.90068 12.5818 8.07694M9.49147 8.20309L7.14598 3.102M7.14598 3.102C7.59186 2.88881 8.05728 2.7099 8.53881 2.56868C9.37503 2.32345 10.2598 2.19189 11.1754 2.19189C12.3864 2.19189 13.5437 2.42207 14.6058 2.84105M14.6058 2.84105C14.8091 2.92122 15.0088 3.0083 15.2048 3.102C16.0164 3.49005 16.7633 3.99167 17.4249 4.5863C18.0315 5.13146 18.5664 5.75478 19.0138 6.44041M14.0425 9.14136L19.0138 6.44041" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>  
                           Створення СV
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>
   
   <?php get_footer(); ?>