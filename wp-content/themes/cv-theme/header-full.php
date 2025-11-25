<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header>
        <nav class="site-nav">
            <div class="nav-wrapper">
                <div class="Logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/SF_Logo.svg" alt="Logo" />
                    </a>
                </div>

                <!-- Кнопка гамбургера -->
                <button class="hamburger" aria-label="Toggle menu">
                    <span class="top-burger"></span>
                    <span class="middle-burger"></span>
                    <span class="bottom-burger"></span>
                </button>

                <div class="nav-links">
                    <ul>
                        <li>
                            <a class="js-smart-scroll" href="#steps">Як замовити</a>
                        </li>
                        <li>
                            <a class="js-smart-scroll" href="#about">Про нас</a>
                        </li>
                        <li><a href="<?php echo get_template_directory_uri(); ?>/sending">Розсилка СV</a></li>
                        <li><a href="<?php echo get_template_directory_uri(); ?>/cv-writer">Створення СV</a></li>
                        <li>
                            <a class="js-smart-scroll" href="#footer">Контакти</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="">Інше</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="js-smart-scroll" href="#features">Переваги</a>
                                </li>
                                <li>
                                    <a class="js-smart-scroll" href="#reviews">Відгуки</a>
                                </li>
                                <li>
                                    <a class="js-smart-scroll" href="#faq">Питання</a>
                                </li>
                                <li>
                                    <a class="js-smart-scroll" href="/#previl-block">Чому ми?</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="Buscet-wrap">
                    <div class="country">UA</div>
                    <div class="buscet">
                        <a href="<?php echo get_template_directory_uri(); ?>/busket">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/buscet-icon.svg" alt="" />
                            <span class="buscket-count"></span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
