<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Preload критических ресурсов -->
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/css/styles.css" as="style">
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/images/SF_Logo.svg" as="image">
    
    <!-- Preload критических изображений hero секции -->
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/images/anchor-icon.svg" as="image">
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/images/cv-icon.svg" as="image">
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/images/ship-right1.svg" as="image">
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/images/ship-left1.svg" as="image">
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/images/seagul-left.svg" as="image">
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/images/cloud-center1.svg" as="image">
    
    <!-- DNS prefetch для внешних ресурсов -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    
    <!-- Preconnect для быстрой загрузки шрифтов -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header class="site-header">
        <nav class="site-nav">
            <div class="nav-wrapper">
                <div class="Logo">
                    <a href="<?php echo esc_url(pll_home_url()); ?>" aria-label="<?php pll_e('SeafarerCV - Головна сторінка'); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/SF_Logo.svg" alt="<?php pll_e('SeafarerCV - Професійні послуги для моряків'); ?>" width="120" height="40" />
                    </a>
                </div>

                <!-- Кнопка гамбургера -->
                <button class="hamburger" aria-label="<?php pll_e('Відкрити меню'); ?>">
                    <span class="top-burger"></span>
                    <span class="middle-burger"></span>
                    <span class="bottom-burger"></span>
                </button>

                <div class="nav-links">
                    <ul>
                        <li>
                            <a class="js-smart-scroll ancor" href="/#steps"><?php pll_e('Як замовити'); ?></a>
                        </li>
                        <li>
                            <a class="js-smart-scroll ancor" href="/#about"><?php pll_e('Про нас'); ?></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#" aria-expanded="false" aria-controls="dropdown-sending">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_8171_2710)">
                            <path d="M9.53027 7.27832L10.6504 8.67585C11.39 9.26464 12.6034 9.26464 13.343 8.67585L14.4667 7.27832M12.4151 13.3936V22.8223M12.4151 22.8223C9.41347 22.9679 3.37523 21.4756 3.23535 14.3417H4.73226M12.4151 22.8223C15.4167 22.9679 21.455 21.4756 21.5948 14.3417H19.5973M14.5904 13.1381H9.41015C7.25607 13.1381 5.82001 12.0611 5.82001 9.54796V7.52177C5.82001 5.00868 7.25607 3.93164 9.41015 3.93164H14.5904C16.7445 3.93164 18.1805 5.00868 18.1805 7.52177V9.54796C18.1805 12.0611 16.7445 13.1381 14.5904 13.1381Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.0005 3.54053C12.6539 3.54053 13.1836 3.01083 13.1836 2.35742C13.1836 1.70401 12.6539 1.17432 12.0005 1.17432C11.3471 1.17432 10.8174 1.70401 10.8174 2.35742C10.8174 3.01083 11.3471 3.54053 12.0005 3.54053Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_8171_2710">
                            <rect width="23.9963" height="24" fill="currentColor" transform="translate(0.00195312 0.00292969)"/>
                            </clipPath>
                            </defs>
                            </svg>
                            <?php pll_e('Розсилка CV'); ?><span class="dropdown-icon"></span></a>
                            <div id="dropdown-sending" class="dropdown-menu sending" hidden>
                            <div class="wrapper" >
            <div class="layout">
               <div class="grid-left">
                  <p><?php pll_e('За типом флоту вакансії:'); ?></p>
                  <div class="grid-left-items">
                     <div class="item">
                      <a href="<?php echo pll_home_url(); ?>/sending/#sales-fleet" class="js-smart-scroll">
                          <img
                           src="<?php echo get_template_directory_uri(); ?>/assets/images/sales-fleet-IMG.jpg"
                           alt="<?php pll_e('торговий флот'); ?>"
                        />
                        <span><?php pll_e('Торговий флот'); ?></span>
                      </a>
                     </div>
                     <div class="item">
                       <a href="<?php echo pll_home_url(); ?>/sending/#tanker-fleet" class="js-smart-scroll">
                         <img
                           src="<?php echo get_template_directory_uri(); ?>/assets/images/tanker-fleet-IMG.jpg"
                           alt="<?php pll_e('танкерний флот'); ?>"
                        />
                        <span><?php pll_e('Танкерний флот'); ?></span>
                       </a>
                     </div>
                     <div class="item">
                      <a href="<?php echo pll_home_url(); ?>/sending/#offshore-fleet" class="js-smart-scroll">
                          <img
                           src="<?php echo get_template_directory_uri(); ?>/assets/images/offshore-fleet-IMG.jpg"
                           alt="<?php pll_e('офшорний флот'); ?>"
                        />
                        <span><?php pll_e('Офшорний флот'); ?></span>
                      </a>
                     </div>
                     <div class="item">
                      <a href="<?php echo pll_home_url(); ?>/sending/#passanger-fleet" class="js-smart-scroll">  <img
                           src="<?php echo get_template_directory_uri(); ?>/assets/images/passanger-fleet-IMG.jpg"
                           alt="<?php pll_e('пасажирський флот'); ?>"
                        />
                        <span><?php pll_e('Пасажирський флот'); ?></span></a>
                     </div>
                  </div>
               </div>
               <div class="grid-right">
                  <p><?php pll_e('За розташуванням представництва:'); ?></p>
                  <div class="grid-right-items">
                     <div class="item">
                     <div class="pill-best-seller"><?php pll_e('Хіт продажів'); ?></div>
                       <a href="<?php echo pll_home_url(); ?>/sending/#sending-region-wrapper" class="js-smart-scroll">
                         <span><?php pll_e('Європа 🇪🇺 + Велика Британія 🇬🇧'); ?></span>
                       </a>
                     </div>
                     <div class="item">
                       <a href="<?php echo pll_home_url(); ?>/sending/#sending-region-wrapper" class="js-smart-scroll">
                         <span><?php pll_e('Країни Балтії 🇱🇹🇪🇪🇱🇻'); ?></span>
                       </a>
                     </div>
                     <div class="item">
                       <a href="<?php echo pll_home_url(); ?>/sending/#sending-region-wrapper" class="js-smart-scroll">
                         <span><?php pll_e('Скандинавія 🇳🇴🇸🇪🇫🇮🇩🇰'); ?></span>
                       </a>
                     </div>
                     <div class="item">
                       <a href="<?php echo pll_home_url(); ?>/sending/#sending-region-wrapper" class="js-smart-scroll">
                         <span><?php pll_e('Україна 🇺🇦 + Грузія 🇬🇪'); ?></span>
                       </a>
                     </div>
                     <div class="item">
                       <a href="<?php echo pll_home_url(); ?>/sending/#sending-region-wrapper" class="js-smart-scroll">
                          <span><?php pll_e('Весь світ 🌎'); ?></span>
                       </a>
                     </div>
                     <div class="item">
                       <a href="<?php echo pll_home_url(); ?>/sending/#steps" class="js-smart-scroll">
                       <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                          <path d="M6.60449 22V15" stroke="#0D2237" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M6.60449 5V2" stroke="#0D2237" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M17.6025 22V19" stroke="#0D2237" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M17.6025 9V2" stroke="#0D2237" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M9.60356 7V13C9.60356 14.1 9.10364 15 7.60387 15H5.60418C4.10441 15 3.60449 14.1 3.60449 13V7C3.60449 5.9 4.10441 5 5.60418 5H7.60387C9.10364 5 9.60356 5.9 9.60356 7Z" stroke="#0D2237" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M20.6026 11V17C20.6026 18.1 20.1027 19 18.6029 19H16.6032C15.1034 19 14.6035 18.1 14.6035 17V11C14.6035 9.9 15.1034 9 16.6032 9H18.6029C20.1027 9 20.6026 9.9 20.6026 11Z" stroke="#0D2237" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                          <span><?php pll_e('Як працює розсилка'); ?></span>
                       </a>
                     </div>
                     
               </div>
            </div>
         </div>
                            </div>

                                
                        </li>
                        <li><a href="<?php echo function_exists('pll_get_post') && get_page_by_path('cv-writer') ? get_permalink(pll_get_post(get_page_by_path('cv-writer')->ID)) : pll_home_url('/cv-writer/'); ?>"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.8648 13.0516C17.3495 14.7807 18.7024 16.1335 20.4387 16.6255M17.6823 12.2341L11.9815 17.9349C11.7645 18.152 11.5475 18.5788 11.504 18.8899L11.193 21.0675C11.0772 21.856 11.6343 22.4059 12.4228 22.2974L14.6004 21.9863C14.9043 21.9429 15.3311 21.7258 15.5554 21.5088L21.2562 15.808C22.2401 14.8241 22.7031 13.681 21.2562 12.2341C19.8093 10.7872 18.6662 11.2502 17.6823 12.2341Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.5305 11.0475C20.5305 10.1256 20.3971 9.23485 20.1486 8.39352C19.9572 7.74566 19.6976 7.1271 19.378 6.54615C19.2648 6.34037 19.1441 6.13931 19.0162 5.94334M11.1778 20.4001C10.0293 20.4001 8.92916 20.1931 7.91264 19.8143M12.8617 7.70602C13.1471 7.85012 13.4116 8.02972 13.6492 8.239M12.8617 7.70602C12.7713 7.66034 12.6787 7.61823 12.5842 7.57987M12.8617 7.70602L14.6083 2.34398M13.6492 8.239L12.5842 7.57987M13.6492 8.239C13.7911 8.36393 13.9234 8.49944 14.0449 8.64429M14.3245 13.0718C14.7006 12.4883 14.9189 11.7934 14.9189 11.0476C14.9189 10.5161 14.8081 10.0106 14.6083 9.55274C14.4641 9.22233 14.2736 8.91677 14.0449 8.64429M14.3245 13.0718C14.1364 13.3636 13.9087 13.6276 13.6492 13.8561C13.4983 13.9891 13.3365 14.11 13.1655 14.2175C12.8993 14.3848 12.6105 14.5194 12.3047 14.6159C11.9491 14.7281 11.5705 14.7886 11.1778 14.7886C10.654 14.7886 10.1553 14.681 9.70266 14.4865C9.52424 14.4099 9.35298 14.3198 9.19016 14.2175M14.3245 13.0718L16.0072 13.8561M9.19016 14.2175C8.95496 14.0697 8.73737 13.8965 8.54125 13.7016C8.29544 13.4574 8.08337 13.1793 7.91264 12.8749M9.19016 14.2175L7.91264 19.8143M7.91264 19.8143C6.49263 19.2852 5.23582 18.421 4.23838 17.3178C3.639 16.6549 3.13329 15.9057 2.7421 15.091M7.91264 12.8749C7.6999 12.4956 7.55135 12.0754 7.48169 11.6291C7.45212 11.4396 7.43677 11.2454 7.43677 11.0476C7.43677 10.2634 7.67803 9.53562 8.09037 8.93434M7.91264 12.8749L2.7421 15.091M2.7421 15.091C2.23367 14.0323 1.9187 12.863 1.84299 11.6291C1.83118 11.4367 1.8252 11.2428 1.8252 11.0475C1.8252 9.27107 2.32044 7.61035 3.18039 6.19584M8.09037 8.93434C8.22359 8.74007 8.37467 8.55901 8.54125 8.39352C8.81931 8.11729 9.14053 7.88445 9.49392 7.70602M8.09037 8.93434L3.18039 6.19584M3.18039 6.19584C3.36535 5.89159 3.56719 5.59874 3.7846 5.31858C4.67459 4.17168 5.82557 3.23743 7.14842 2.60493M9.49392 7.70602C9.67956 7.61228 9.87409 7.53356 10.0759 7.47145C10.4242 7.36423 10.7943 7.30652 11.1778 7.30652C11.6753 7.30652 12.15 7.40361 12.5842 7.57987M9.49392 7.70602L7.14842 2.60493M7.14842 2.60493C7.59431 2.39174 8.05972 2.21282 8.54125 2.07161C9.37747 1.82638 10.2623 1.69482 11.1778 1.69482C12.3889 1.69482 13.5461 1.925 14.6083 2.34398M14.6083 2.34398C14.8115 2.42415 15.0113 2.51123 15.2072 2.60493C16.0188 2.99298 16.7657 3.4946 17.4273 4.08923C18.0339 4.63439 18.5688 5.25771 19.0162 5.94334M14.0449 8.64429L19.0162 5.94334" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <?php pll_e('Створення СV'); ?></a>
                        </li>
                        <li>
                            <a class="js-smart-scroll ancor" href="<?php echo function_exists('pll_get_post') && get_page_by_path('contacts') ? get_permalink(pll_get_post(get_page_by_path('contacts')->ID)) : pll_home_url('/contacts/'); ?>"><?php pll_e('Контакти'); ?></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#" aria-expanded="false" aria-controls="dropdown-more"><?php pll_e('Інше'); ?> <span class="dropdown-icon"></span></a>
                            <ul id="dropdown-more" class="dropdown-menu" hidden>
                                <li>
                                    <a class="js-smart-scroll ancor" href="/#features"> 
                                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.1023 9C19.1023 10.45 18.6724 11.78 17.9325 12.89C16.8527 14.49 15.1429 15.62 13.1532 15.91C12.8133 15.97 12.4633 16 12.1034 16C11.7435 16 11.3935 15.97 11.0536 15.91C9.06388 15.62 7.35414 14.49 6.27431 12.89C5.53443 11.78 5.10449 10.45 5.10449 9C5.10449 5.13 8.23401 2 12.1034 2C15.9728 2 19.1023 5.13 19.1023 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M21.3525 18.4699L19.7028 18.8599C19.3329 18.9499 19.0429 19.2299 18.9629 19.5999L18.613 21.0699C18.423 21.8699 17.4032 22.1099 16.8732 21.4799L12.104 15.9999L7.33473 21.4899C6.80481 22.1199 5.78497 21.8799 5.595 21.0799L5.24506 19.6099C5.15507 19.2399 4.86511 18.9499 4.50517 18.8699L2.85543 18.4799C2.09555 18.2999 1.82559 17.3499 2.3755 16.7999L6.2749 12.8999C7.35473 14.4999 9.06446 15.6299 11.0542 15.9199C11.3941 15.9799 11.744 16.0099 12.104 16.0099C12.4639 16.0099 12.8139 15.9799 13.1538 15.9199C15.1435 15.6299 16.8532 14.4999 17.9331 12.8999L21.8325 16.7999C22.3824 17.3399 22.1124 18.2899 21.3525 18.4699Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12.6839 5.98L13.2738 7.15999C13.3538 7.31999 13.5637 7.48 13.7537 7.51L14.8235 7.68999C15.5034 7.79999 15.6634 8.3 15.1735 8.79L14.3436 9.61998C14.2036 9.75998 14.1236 10.03 14.1736 10.23L14.4136 11.26C14.6036 12.07 14.1736 12.39 13.4537 11.96L12.4539 11.37C12.2739 11.26 11.974 11.26 11.794 11.37L10.7942 11.96C10.0743 12.38 9.64433 12.07 9.8343 11.26L10.0743 10.23C10.1143 10.04 10.0443 9.75998 9.90429 9.61998L9.07442 8.79C8.5845 8.3 8.74447 7.80999 9.42437 7.68999L10.4942 7.51C10.6742 7.48 10.8841 7.31999 10.9641 7.15999L11.554 5.98C11.844 5.34 12.3639 5.34 12.6839 5.98Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg> <?php pll_e('Переваги'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="js-smart-scroll ancor" href="/#reviews">
                                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.083 10.79V14.79C18.083 15.05 18.073 15.3 18.043 15.54C17.813 18.24 16.2233 19.58 13.2937 19.58H12.8938C12.6438 19.58 12.4039 19.7 12.2539 19.9L11.0541 21.5C10.5242 22.21 9.66429 22.21 9.13437 21.5L7.93455 19.9C7.80457 19.73 7.51463 19.58 7.29466 19.58H6.89473C3.70523 19.58 2.10547 18.79 2.10547 14.79V10.79C2.10547 7.86001 3.45527 6.27001 6.14485 6.04001C6.38481 6.01001 6.63477 6 6.89473 6H13.2937C16.4832 6 18.083 7.60001 18.083 10.79Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M22.0821 6.79001V10.79C22.0821 13.73 20.7323 15.31 18.0427 15.54C18.0727 15.3 18.0827 15.05 18.0827 14.79V10.79C18.0827 7.60001 16.4829 6 13.2934 6H6.89441C6.63446 6 6.38449 6.01001 6.14453 6.04001C6.3745 3.35001 7.96425 2 10.8938 2H17.2928C20.4823 2 22.0821 3.60001 22.0821 6.79001Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.599 13.25H13.608" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.099 13.25H10.108" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.59999 13.25H6.60899" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>    
                                    <?php pll_e('Відгуки'); ?></a>
                                </li>
                                <li>
                                    <a class="js-smart-scroll ancor" href="/#faq">
                                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.1031 18.43H13.1038L8.65444 21.39C7.99454 21.83 7.10469 21.36 7.10469 20.56V18.43C4.10516 18.43 2.10547 16.43 2.10547 13.43V7.42993C2.10547 4.42993 4.10516 2.42993 7.10469 2.42993H17.1031C20.1027 2.42993 22.1024 4.42993 22.1024 7.42993V13.43C22.1024 16.43 20.1027 18.43 17.1031 18.43Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.1041 11.3599V11.1499C12.1041 10.4699 12.524 10.1099 12.9439 9.81989C13.3539 9.53989 13.7638 9.1799 13.7638 8.5199C13.7638 7.5999 13.0239 6.85986 12.1041 6.85986C11.1842 6.85986 10.4443 7.5999 10.4443 8.5199" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.099 13.75H12.108" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>    
                                    <?php pll_e('Питання'); ?></a>
                                </li>
                                <li>
                                    <a class="js-smart-scroll ancor" href="/#previl-block"> 
                                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.58398 18.35L10.6835 20.75C11.0834 21.15 11.9833 21.35 12.5832 21.35H16.3826C17.5824 21.35 18.8822 20.45 19.1822 19.25L21.5818 11.95C22.0817 10.55 21.1819 9.34997 19.6821 9.34997H15.6827C15.0828 9.34997 14.5829 8.84997 14.6829 8.14997L15.1828 4.94997C15.3828 4.04997 14.7829 3.04997 13.883 2.74997C13.0831 2.44997 12.0833 2.84997 11.6833 3.44997L7.58398 9.54997" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"/>
                                        <path d="M2.48535 18.3499V8.5499C2.48535 7.1499 3.08526 6.6499 4.48504 6.6499H5.48488C6.88467 6.6499 7.48457 7.1499 7.48457 8.5499V18.3499C7.48457 19.7499 6.88467 20.2499 5.48488 20.2499H4.48504C3.08526 20.2499 2.48535 19.7499 2.48535 18.3499Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <?php pll_e('Чому ми?'); ?></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="Buscet-wrap">
<div class="language-switcher">
    <ul>
        <?php if (function_exists('pll_the_languages')) :
            $langs = pll_the_languages([
                'raw'           => 1,  // повернути як масив
                'hide_if_empty' => 0,
                'hide_current'  => 0,
            ]);

            if (!empty($langs)) :
                foreach ($langs as $lang) :
                    $class = $lang['current_lang'] ? 'current-lang' : '';
                    $slug  = $lang['slug']; // uk / ru / en
                    $url   = $lang['url'];  // ПРАВИЛЬНИЙ URL для цієї мови
        ?>
                    <li class="<?php echo esc_attr($class); ?>">
                        <a href="<?php echo esc_url($url); ?>">
                            <?php echo esc_html(strtoupper($slug)); ?>
                        </a>
                    </li>
        <?php
                endforeach;
            endif;
        endif; ?>
    </ul>
</div>

                   
                    <div class="buscet">
                        <a href="<?php echo function_exists('pll_get_post') && get_page_by_path('busket') ? get_permalink(pll_get_post(get_page_by_path('busket')->ID)) : pll_home_url('/busket/'); ?>">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                              <path d="M1.5 2.5H3.24001C4.32001 2.5 5.17 3.43 5.08 4.5L4.25 14.46C4.11 16.09 5.39999 17.49 7.03999 17.49H17.69C19.13 17.49 20.39 16.31 20.5 14.88L21.04 7.38C21.16 5.72 19.9 4.37 18.23 4.37H5.32001M8.5 8.5H20.5M17 21.25C17 21.9404 16.4404 22.5 15.75 22.5C15.0596 22.5 14.5 21.9404 14.5 21.25C14.5 20.5596 15.0596 20 15.75 20C16.4404 20 17 20.5596 17 21.25ZM9 21.25C9 21.9404 8.44036 22.5 7.75 22.5C7.05964 22.5 6.5 21.9404 6.5 21.25C6.5 20.5596 7.05964 20 7.75 20C8.44036 20 9 20.5596 9 21.25Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                            <span class="buscket-count"></span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="site-overlay" aria-hidden="true"></div>