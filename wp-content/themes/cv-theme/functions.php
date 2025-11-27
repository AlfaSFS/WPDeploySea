<?php
if (!defined('ABSPATH')) {
    exit;
}

// Подключение стилей и скриптов
function cv_theme_scripts() {
    wp_enqueue_style('cv-theme-style', get_stylesheet_uri());
    
    // Подключаем ваши CSS и JS файлы из папки assets
    wp_enqueue_style('cv-reset-style', get_template_directory_uri() . '/assets/css/reset.css');
    wp_enqueue_style('cv-main-style', get_template_directory_uri() . '/assets/css/styles.css', array(), '2.4');
    
    // Подключаем Google Fonts с оптимизацией
    wp_enqueue_style('cv-google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap', array(), null);
    
    // Hamburger загружаем на всех страницах (навигация)
    wp_enqueue_script('cv-hamburger', get_template_directory_uri() . '/assets/js/hamburger.js', array(), '1.7', true);
    
    // Dropdown для "Розсилка CV" загружаем на всех страницах (навигация)
    wp_enqueue_script('cv-dropdown-sending', get_template_directory_uri() . '/assets/js/dropdownSending.js', array(), '1.1', true);
    
    // Smart scroll загружаем на всех страницах (навигация)
    wp_enqueue_script('cv-smart-scroll', get_template_directory_uri() . '/assets/js/smartScroll.js', array(), '1.1', true);
    
    // Анимация волн в футере загружаем на всех страницах
    wp_enqueue_script('cv-wave-animation', get_template_directory_uri() . '/assets/js/waveAnimation.js', array(), '1.0', true);
    
    // Главная страница
    if (is_front_page() || is_home()) {
        // Lottie загружаем лениво для улучшения FCP
        wp_enqueue_script('cv-lottie', get_template_directory_uri() . '/assets/js/lottie.min.js', array(), '1.1', true);
        wp_enqueue_script('cv-animation', get_template_directory_uri() . '/assets/js/animation.js', array('cv-lottie'), '1.1', true);
        wp_enqueue_script('cv-animation-scroll-step', get_template_directory_uri() . '/assets/js/animationScrollStep.js', array(), '1.2', true);
        wp_enqueue_script('cv-accardion', get_template_directory_uri() . '/assets/js/accardion.js', array(), '1.1', true);
        wp_enqueue_script('cv-cards-slider', get_template_directory_uri() . '/assets/js/cardsSlider.js', array(), '1.4', true);
        
        // Передаем переменные для анимации
        wp_localize_script('cv-animation', 'cv_theme_vars', array(
            'animation_path' => get_template_directory_uri() . '/assets/animation/Ship_animation.json',
            'theme_url' => get_template_directory_uri(),
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('cv_theme_nonce')
        ));
    }
    
    // Страница sending
    if (is_page_template('page-sending.php') || is_page('sending')) {
        wp_enqueue_script('cv-animation-scroll-step', get_template_directory_uri() . '/assets/js/animationScrollStep.js', array(), '1.2', true);
        wp_enqueue_script('cv-accardion', get_template_directory_uri() . '/assets/js/accardion.js', array(), '1.1', true);
        wp_enqueue_script('cv-cards-slider', get_template_directory_uri() . '/assets/js/cardsSlider.js', array(), '1.4', true);
        wp_enqueue_script('cv-sending-mobile-nav', get_template_directory_uri() . '/assets/js/sending-mobile-nav.js', array(), '1.0', true);
    }
    
    // Страница cv-writer
    if (is_page_template('page-cv-writer.php') || is_page('cv-writer')) {
        wp_enqueue_script('cv-animation-scroll-step', get_template_directory_uri() . '/assets/js/animationScrollStep.js', array(), '1.2', true);
        wp_enqueue_script('cv-cards-slider', get_template_directory_uri() . '/assets/js/cardsSlider.js', array(), '1.4', true);
        wp_enqueue_script('cv-accardion', get_template_directory_uri() . '/assets/js/accardion.js', array(), '1.1', true);
        wp_enqueue_script('cv-ba-slider', get_template_directory_uri() . '/assets/js/ba-slider.js', array(), '1.1', true);
        wp_enqueue_script('cv-busket-update', get_template_directory_uri() . '/assets/js/busketUpdate.js', array(), '1.5', true);
    }
    
    // Страница busket
    if (is_page_template('page-busket.php') || is_page('busket')) {
        wp_enqueue_script('cv-handle-busket', get_template_directory_uri() . '/assets/js/handleBusket.js', array(), '1.8', true);
    }
    
    // Страница order
    if (is_page_template('page-order.php') || is_page('order')) {
                    wp_enqueue_script('cv-order', get_template_directory_uri() . '/assets/js/order.js', array(), '2.4', true);
    }
    
    // Глобальные скрипты для корзины (на всех страницах) - используем busketUpdate.js вместо старого busket.js
    wp_enqueue_script('cv-busket-update', get_template_directory_uri() . '/assets/js/busketUpdate.js', array(), '1.4', true);
    
    // Передаем общие переменные
    wp_localize_script('cv-busket-update', 'cv_theme_vars', array(
        'theme_url' => get_template_directory_uri(),
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('cv_theme_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'cv_theme_scripts');

// Поддержка меню
function cv_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    
    register_nav_menus(array(
        'primary' => 'Главное меню',
    ));
}
add_action('after_setup_theme', 'cv_theme_setup');

// Поддержка виджетов
function cv_theme_widgets_init() {
    register_sidebar(array(
        'name'          => 'Боковая панель',
        'id'            => 'sidebar-1',
        'description'   => 'Добавьте виджеты сюда',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'cv_theme_widgets_init');

// Изменяем body класс для страницы 404
function cv_theme_404_body_class($classes) {
    if (is_404()) {
        // Убираем стандартный класс 'error' и добавляем 'page-404'
        $classes = array_diff($classes, array('error'));
        $classes[] = 'page-404';
    }
    return $classes;
}
add_filter('body_class', 'cv_theme_404_body_class');

// Подключение фавикона
function cv_theme_favicon() {
    $favicon_svg = get_template_directory_uri() . '/assets/favicons/favicon.svg';
    $favicon_png = get_template_directory_uri() . '/assets/favicons/favicon.png';
    
    echo '<link rel="icon" type="image/svg+xml" href="' . esc_url($favicon_svg) . '">' . "\n";
    echo '<link rel="icon" type="image/png" href="' . esc_url($favicon_png) . '">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url($favicon_png) . '">' . "\n";
}
add_action('wp_head', 'cv_theme_favicon', 1);

// SEO оптимизация
function cv_theme_seo_meta() {
    // Специальные мета теги для Privacy Policy
    if (is_page('privacy-policy') || is_page_template('page-privacy-policy.php')) {
        echo '<meta name="description" content="Політика конфіденційності SeafarerCV. Захист персональних даних клієнтів. Безпека та конфіденційність інформації.">' . "\n";
        echo '<meta name="keywords" content="політика конфіденційності, захист даних, Seafarer CV, GDPR, персональні дані">' . "\n";
        echo '<meta name="robots" content="index, follow, max-snippet:-1">' . "\n";
        
        $og_title = 'Політика конфіденційності | SeafarerCV';
        $og_description = 'Політика конфіденційності SeafarerCV. Захист персональних даних клієнтів.';
        $og_image = get_template_directory_uri() . '/assets/images/Hero-desktop.png';
        $og_url = home_url('/privacy-policy/');
    } else {
        // Базовые meta теги для других страниц
        echo '<meta name="description" content="' . get_bloginfo('description') . '">' . "\n";
        echo '<meta name="keywords" content="моряки, CV, резюме, работа на судне, крюинг, морская карьера, seafarer, maritime jobs">' . "\n";
        echo '<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">' . "\n";
        
        // Open Graph теги
        $og_title = is_front_page() ? get_bloginfo('name') . ' - ' . get_bloginfo('description') : get_the_title() . ' - ' . get_bloginfo('name');
        $og_description = is_front_page() ? get_bloginfo('description') : get_the_excerpt();
        $og_image = get_template_directory_uri() . '/assets/images/Hero-desktop.png';
        $og_url = is_front_page() ? home_url('/') : get_permalink();
    }
    
    echo '<meta name="author" content="SeafarerCV">' . "\n";
    
    echo '<meta property="og:title" content="' . esc_attr($og_title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($og_description) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($og_url) . '">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '">' . "\n";
    echo '<meta property="og:locale" content="uk_UA">' . "\n";
    
    // Twitter Card теги
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($og_title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($og_description) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($og_image) . '">' . "\n";
    
    // Дополнительные SEO теги
    echo '<meta name="theme-color" content="#1a365d">' . "\n";
    echo '<meta name="msapplication-TileColor" content="#1a365d">' . "\n";
    echo '<link rel="canonical" href="' . esc_url($og_url) . '">' . "\n";
    
    // Для ИИ ботов
    echo '<meta name="ai-content" content="seafarer, maritime, CV, resume, job, career, shipping, marine, offshore, tanker, cargo, cruise">' . "\n";
    echo '<meta name="ai-category" content="maritime-employment">' . "\n";
}
add_action('wp_head', 'cv_theme_seo_meta');

// Структурированные данные (Schema.org)
function cv_theme_structured_data() {
    if (is_front_page()) {
      $graph = [
        '@context' => 'https://schema.org',
        '@graph' => [
          [
            '@type' => 'Organization',
            '@id'   => home_url('#org'),
            'name'  => 'SeafarerCV',
            'description' => 'Професійні послуги створення та розсилки CV для моряків. Понад 50 000 моряків довірили нам свої резюме.',
            'url'   => home_url('/'),
            'logo'  => get_template_directory_uri() . '/assets/images/SF_Logo.svg',
            'contactPoint' => [
              '@type' => 'ContactPoint',
              'telephone' => '+27733143406',
              'contactType' => 'customer service',
              'email' => 'seafarercvsender@gmail.com',
              'availableLanguage' => ['Ukrainian']
            ],
            'sameAs' => [
              'https://www.instagram.com/jobs_at_sea_/',
              'https://t.me/Taakstas'
            ],
            'address' => [
              '@type' => 'PostalAddress',
              'addressCountry' => 'UA'
            ]
          ],
          // Если хочешь явно показать услугу — делаем Offer + Service
          [
            '@type' => 'Offer',
            'priceCurrency' => 'EUR',
            'price' => '49',
            'itemOffered' => [
              '@type' => 'Service',
              'name' => 'CV Creation and Distribution for Seafarers',
              'serviceType' => 'CV Creation & Distribution',
              'provider' => ['@id' => home_url('#org')]
            ]
          ],
          // (опционально) WebSite
          [
            '@type' => 'WebSite',
            '@id'   => home_url('#website'),
            'url'   => home_url('/'),
            'name'  => get_bloginfo('name'),
            'publisher' => ['@id' => home_url('#org')],
            'inLanguage' => get_bloginfo('language') ?: 'uk-UA'
          ]
        ]
      ];
  
      echo '<script type="application/ld+json">'
         . wp_json_encode($graph, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)
         . '</script>' . "\n";
    }
    elseif (is_page('privacy-policy') || is_page_template('page-privacy-policy.php')) {
      $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => 'Політика конфіденційності | SeafarerCV',
        'description' => 'Політика конфіденційності SeafarerCV. Захист персональних даних клієнтів.',
        'url' => home_url('/privacy-policy/'),
        'dateModified' => '2025-08-14',
        'isPartOf' => [
          '@type' => 'WebSite',
          'name' => 'SeafarerCV',
          'url'  => home_url('/')
        ],
        'about' => ['@id' => home_url('#org')]
      ];
      echo '<script type="application/ld+json">'
         . wp_json_encode($schema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)
         . '</script>' . "\n";
    }
  }
  remove_action('wp_head', 'cv_theme_structured_data'); // на всякий
  add_action('wp_head', 'cv_theme_structured_data', 3);

// Оптимизация загрузки Google Fonts
function cv_theme_optimize_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    echo '<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap"></noscript>' . "\n";
}
add_action('wp_head', 'cv_theme_optimize_fonts', 1);

// Удаляем стандартную загрузку Google Fonts из functions.php
function cv_theme_remove_google_fonts() {
    wp_dequeue_style('cv-google-fonts');
}
add_action('wp_enqueue_scripts', 'cv_theme_remove_google_fonts', 20);

// XML Sitemap генерация
function cv_theme_generate_sitemap() {
    if (isset($_GET['sitemap']) && $_GET['sitemap'] === 'xml') {
        header('Content-Type: application/xml; charset=utf-8');
        
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Главная страница
        $sitemap .= '<url>' . "\n";
        $sitemap .= '<loc>' . home_url('/') . '</loc>' . "\n";
        $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
        $sitemap .= '<changefreq>weekly</changefreq>' . "\n";
        $sitemap .= '<priority>1.0</priority>' . "\n";
        $sitemap .= '</url>' . "\n";
        
        // Основные страницы
        $pages = array(
            '/sending/' => array('priority' => '0.9', 'changefreq' => 'weekly'),
            '/cv-writer/' => array('priority' => '0.9', 'changefreq' => 'weekly'),
            '/busket/' => array('priority' => '0.7', 'changefreq' => 'monthly'),
            '/order/' => array('priority' => '0.7', 'changefreq' => 'monthly'),
            '/privacy-policy/' => array('priority' => '0.6', 'changefreq' => 'monthly')
        );
        
        foreach ($pages as $page => $settings) {
            $sitemap .= '<url>' . "\n";
            $sitemap .= '<loc>' . home_url($page) . '</loc>' . "\n";
            $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
            $sitemap .= '<changefreq>' . $settings['changefreq'] . '</changefreq>' . "\n";
            $sitemap .= '<priority>' . $settings['priority'] . '</priority>' . "\n";
            $sitemap .= '</url>' . "\n";
        }
        
        $sitemap .= '</urlset>';
        
        echo $sitemap;
        exit;
    }
}
add_action('init', 'cv_theme_generate_sitemap');

// Добавляем ссылку на sitemap в robots meta
function cv_theme_add_sitemap_to_robots() {
    echo '<link rel="sitemap" type="application/xml" title="Sitemap" href="' . home_url('/?sitemap=xml') . '">' . "\n";
}
add_action('wp_head', 'cv_theme_add_sitemap_to_robots');

// Оптимизация изображений для SEO
function cv_theme_add_image_attributes($attr, $attachment, $size) {
    if (is_array($attr)) {
        $attr['loading'] = 'lazy';
        $attr['decoding'] = 'async';
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'cv_theme_add_image_attributes', 10, 3);

// Добавляем микроразметку для хлебных крошек
function cv_theme_breadcrumbs_schema() {
    if (!is_front_page()) {
        $breadcrumbs = array(
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => array(
                array(
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Главная',
                    'item' => home_url('/')
                )
            )
        );
        
        $position = 2;
        if (is_page()) {
            $breadcrumbs['itemListElement'][] = array(
                '@type' => 'ListItem',
                'position' => $position,
                'name' => get_the_title(),
                'item' => get_permalink()
            );
        }
        
        echo '<script type="application/ld+json">' . json_encode($breadcrumbs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
    }
}
add_action('wp_head', 'cv_theme_breadcrumbs_schema');

// Оптимизация для Core Web Vitals
function cv_theme_core_web_vitals_optimization() {
    // Добавляем preload для критических ресурсов
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/js/hamburger.js" as="script">' . "\n";
    
    // Resource hints для внешних ресурсов
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action('wp_head', 'cv_theme_core_web_vitals_optimization', 1);

// Улучшенная поддержка title-tag
function cv_theme_document_title_parts($title) {
    if (is_front_page()) {
        $title['title'] = 'SeafarerCV - Профессиональные услуги для моряков';
        $title['tagline'] = 'Создание и рассылка CV для морской карьеры';
    }
    return $title;
}
add_filter('document_title_parts', 'cv_theme_document_title_parts');

// Добавляем поддержку HTML5
function cv_theme_html5_support() {
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
}
add_action('after_setup_theme', 'cv_theme_html5_support');

// Оптимизация для мобильных устройств
function cv_theme_mobile_optimization() {
    echo '<meta name="format-detection" content="telephone=no">' . "\n";
    echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
    echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
    echo '<meta name="apple-mobile-web-app-status-bar-style" content="default">' . "\n";
}
add_action('wp_head', 'cv_theme_mobile_optimization');

// Отключаем проверки обновлений для локальной среды
function cv_theme_disable_update_checks() {
    // Отключаем проверки обновлений WordPress
    remove_action('load-update-core.php', 'wp_update_plugins');
    remove_action('load-plugins.php', 'wp_update_plugins');
    remove_action('load-update.php', 'wp_update_plugins');
    remove_action('wp_update_plugins', 'wp_update_plugins');
    
    // Отключаем проверки обновлений тем
    remove_action('load-update-core.php', 'wp_update_themes');
    remove_action('load-themes.php', 'wp_update_themes');
    remove_action('load-update.php', 'wp_update_themes');
    remove_action('wp_update_themes', 'wp_update_themes');
    
    // Отключаем проверки обновлений ядра
    remove_action('wp_maybe_auto_update', 'wp_maybe_auto_update');
    remove_action('wp_version_check', 'wp_version_check');
    remove_action('wp_update_plugins', 'wp_update_plugins');
    remove_action('wp_update_themes', 'wp_update_themes');
}
add_action('init', 'cv_theme_disable_update_checks');

// Отключаем автоматические обновления
add_filter('automatic_updater_disabled', '__return_true');
add_filter('auto_update_core', '__return_false');
add_filter('auto_update_plugin', '__return_false');
add_filter('auto_update_theme', '__return_false');

// Отключаем проверки обновлений через cron
add_filter('pre_http_request', function($pre, $parsed_args, $url) {
    if (strpos($url, 'api.wordpress.org') !== false) {
        return new WP_Error('disabled', 'Updates disabled for local development');
    }
    return $pre;
}, 10, 3);

// Отключаем предупреждения о заголовках в админке
if (is_admin()) {
    add_action('init', function() {
        ob_start();
    });
}

// Добавляем попап для уведомлений о корзине
function cv_theme_add_cart_popup() {
    if (!is_admin()) {
        echo '
        <div id="cart-popup" class="cart-popup hidden">
            <div class="cart-popup-content">
                <div class="cart-popup-icon">
                    <svg id="cart-popup-icon-success" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <svg id="cart-popup-icon-warning" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <path d="M12 9V13M12 17H12.01M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="cart-popup-text">
                    <h4 id="cart-popup-title" class="cart-popup-title">Товар додано до кошика!</h4>
                    <p id="cart-popup-message" class="cart-popup-message">Товар успішно додано до вашого кошика.</p>
                </div>
                <button id="cart-popup-close" class="cart-popup-close">&times;</button>
            </div>
        </div>';
    }
}
add_action('wp_footer', 'cv_theme_add_cart_popup');

// Добавляем Facebook Pixel код
function cv_theme_add_facebook_pixel() {
    if (!is_admin()) {
        echo '
        <!-- Meta Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version="2.0";
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,"script",
        "https://connect.facebook.net/en_US/fbevents.js");
        fbq("init", "1460573148498665");
        fbq("track", "PageView");
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1460573148498665&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Meta Pixel Code -->';
    }
}
add_action('wp_head', 'cv_theme_add_facebook_pixel');

// Добавляем JavaScript для отслеживания событий Facebook Pixel
function cv_theme_add_facebook_pixel_events() {
    if (!is_admin()) {
        echo '
        <script>
        // Отслеживание добавления товара в корзину
        document.addEventListener("DOMContentLoaded", function() {
            // Слушаем событие добавления товара в корзину
            window.addEventListener("cartUpdated", function(event) {
                if (event.detail.cartLength > 0) {
                    // Отправляем событие AddToCart в Facebook Pixel
                    if (typeof fbq !== "undefined") {
                        fbq("track", "AddToCart", {
                            content_type: "product",
                            value: 0, // Можно добавить реальную стоимость
                            currency: "EUR"
                        });
                    }
                }
            });
            
            // Отслеживание кликов по кнопкам корзины
            document.querySelectorAll(".bucket").forEach(function(button) {
                button.addEventListener("click", function() {
                    if (typeof fbq !== "undefined") {
                        fbq("track", "InitiateCheckout", {
                            content_type: "product",
                            value: 0,
                            currency: "EUR"
                        });
                    }
                });
            });
        });
        </script>';
    }
}
add_action('wp_footer', 'cv_theme_add_facebook_pixel_events');

// Добавляем мета-описание и ключевые слова
function cv_theme_add_meta_description() {
    if (!is_admin()) {
        $description = 'Професійні послуги створення та розсилки CV для моряків. Якісне оформлення, таргетована розсилка, реальні відповіді. Понад 50 000 моряків довірили нам свої резюме.';
        $keywords = 'моряки, CV, резюме, работа на судне, крюинг, морская карьера, seafarer, maritime jobs, розсилка CV, створення CV, морські послуги, crewing, моряк, судно, контракт';
        
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta name="keywords" content="' . esc_attr($keywords) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
    }
}
add_action('wp_head', 'cv_theme_add_meta_description', 1);


/**
 * Реєстрація рядків для Polylang
 */
add_action('after_setup_theme', 'register_polylang_strings');
function register_polylang_strings() {
    if (function_exists('pll_register_string')) {
        // Header strings
        pll_register_string('Як замовити', 'Як замовити', 'Header');
        pll_register_string('Про нас', 'Про нас', 'Header');
        pll_register_string('Розсилка CV', 'Розсилка CV', 'Header');
        pll_register_string('Створення СV', 'Створення СV', 'Header');
        pll_register_string('Контакти', 'Контакти', 'Header');
        pll_register_string('Інше', 'Інше', 'Header');
        pll_register_string('Переваги', 'Переваги', 'Header');
        pll_register_string('Відгуки', 'Відгуки', 'Header');
        pll_register_string('Питання', 'Питання', 'Header');
        pll_register_string('Чому ми?', 'Чому ми?', 'Header');
        
        // 404 Page strings
        pll_register_string('Шторм у мережі!', 'Шторм у мережі!', '404');
        pll_register_string('Хвилі інтернету занесли вас у невідомі води. Давайте разом повернемось на правильний курс.', 'Хвилі інтернету занесли вас у невідомі води. Давайте разом повернемось на правильний курс.', '404');
        pll_register_string('Так, повернутися', 'Так, повернутися', '404');
		
		// ІНСТРУКЦІЯ: Додати ці рядки в functions.php в функцію register_polylang_strings()
		// після існуючих pll_register_string для Header

        // Contacts Page strings
        pll_register_string('SEAFARER КОНТАКТНА ІНФОРМАЦІЯ', 'SEAFARER КОНТАКТНА ІНФОРМАЦІЯ', 'Contacts');
        pll_register_string('ФОП Патлачук Станіслав Русланович', 'ФОП Патлачук Станіслав Русланович', 'Contacts');
        pll_register_string('ІПН:', 'ІПН:', 'Contacts');
        pll_register_string('ЮРИДИЧНА ТА ФАКТИЧНА АДРЕСА:', 'ЮРИДИЧНА ТА ФАКТИЧНА АДРЕСА:', 'Contacts');
        pll_register_string('Вінницька область', 'Вінницька область', 'Contacts');
        pll_register_string('Тульчинський район', 'Тульчинський район', 'Contacts');
        pll_register_string('с. Болган', 'с. Болган', 'Contacts');
        pll_register_string('вул. Миру, 5', 'вул. Миру, 5', 'Contacts');
        pll_register_string('ТЕЛЕФОН:', 'ТЕЛЕФОН:', 'Contacts');
        pll_register_string('ЕЛЕКТРОННА АДРЕСА:', 'ЕЛЕКТРОННА АДРЕСА:', 'Contacts');
        
        // CTA Block (використовується на багатьох сторінках)
        pll_register_string('Зробіть перший крок до роботи мрії', 'Зробіть перший крок до роботи мрії', 'CTA');
        pll_register_string('Ми створимо і надішлемо резюме туди, де на вас чекають.', 'Ми створимо і надішлемо резюме туди, де на вас чекають.', 'CTA');
        
        // CV Writer Page strings
        pll_register_string('Кожне резюме — унікальне. Ми оформлюємо його вручну, з урахуванням вашого досвіду, типу флоту та побажань.', 'Кожне резюме — унікальне. Ми оформлюємо його вручну, з урахуванням вашого досвіду, типу флоту та побажань.', 'CV Writer');
        pll_register_string('Обери свій пакет і зроби перший крок до контракту.', 'Обери свій пакет і зроби перший крок до контракту.', 'CV Writer');
        
        // Пакети
        pll_register_string('Стартовий', 'Стартовий', 'CV Writer');
        pll_register_string('Для новачків, які роблять перші кроки в морі', 'Для новачків, які роблять перші кроки в морі', 'CV Writer');
        pll_register_string('Унікальних резюме створено вручну', 'Унікальних резюме створено вручну', 'CV Writer');
        pll_register_string('Розсилка по Україні + Грузії 🎁', 'Розсилка по Україні + Грузії 🎁', 'CV Writer');
        pll_register_string('Докладніше', 'Докладніше', 'CV Writer');
        
        pll_register_string('Рядовий', 'Рядовий', 'CV Writer');
        pll_register_string('Для досвідчених рядових моряків у пошуках нових можливостей.', 'Для досвідчених рядових моряків у пошуках нових можливостей.', 'CV Writer');
        pll_register_string('Структурований підхід', 'Структурований підхід', 'CV Writer');
        pll_register_string('Супровідний лист', 'Супровідний лист', 'CV Writer');
        pll_register_string('Індивідуальний дизайн', 'Індивідуальний дизайн', 'CV Writer');
        pll_register_string('Консультація з дизайнером та узгодження всіх деталей', 'Консультація з дизайнером та узгодження всіх деталей', 'CV Writer');
        
        pll_register_string('Офіцери', 'Офіцери', 'CV Writer');
        pll_register_string('Для старших спеціалістів і командного складу', 'Для старших спеціалістів і командного складу', 'CV Writer');
        
        // Детальні описи пакетів
        pll_register_string('Цей пакет створено для тих, хто робить перші кроки в морській кар\'єрі. Ми допоможемо оформити ваш досвід професійно, навіть якщо він ще мінімальний, і подамо його так, щоб крюїнгові компанії звернули на вас увагу.', 'Цей пакет створено для тих, хто робить перші кроки в морській кар\'єрі. Ми допоможемо оформити ваш досвід професійно, навіть якщо він ще мінімальний, і подамо його так, щоб крюїнгові компанії звернули на вас увагу.', 'CV Writer');
        pll_register_string('Що входить у пакет:', 'Що входить у пакет:', 'CV Writer');
        pll_register_string('Професійне оформлення резюме з урахуванням ваших даних і побажань.', 'Професійне оформлення резюме з урахуванням ваших даних і побажань.', 'CV Writer');
        pll_register_string('Структурування ваших навичок і досвіду (або їх відсутності) таким чином, щоб резюме виглядало привабливо.', 'Структурування ваших навичок і досвіду (або їх відсутності) таким чином, щоб резюме виглядало привабливо.', 'CV Writer');
        pll_register_string('Підготовка файлу у форматах .pdf, .docx, .xlsx для зручності подачі до компаній.', 'Підготовка файлу у форматах .pdf, .docx, .xlsx для зручності подачі до компаній.', 'CV Writer');
        pll_register_string('Бонус:', 'Бонус:', 'CV Writer');
        pll_register_string('безкоштовна розсилка вашого резюме по крюїнгових компаніях України та Грузії (близько 50 контактів).', 'безкоштовна розсилка вашого резюме по крюїнгових компаніях України та Грузії (близько 50 контактів).', 'CV Writer');
        
        pll_register_string('Для кого цей пакет?', 'Для кого цей пакет?', 'CV Writer');
        pll_register_string('Для тих, хто нещодавно закінчив навчання або має невеликий досвід роботи, але прагне почати свій шлях у морській індустрії.', 'Для тих, хто нещодавно закінчив навчання або має невеликий досвід роботи, але прагне почати свій шлях у морській індустрії.', 'CV Writer');
        pll_register_string('Чому це вигідно?', 'Чому це вигідно?', 'CV Writer');
        pll_register_string('Ми не лише створимо резюме, а й зробимо першу розсилку за вас — це заощадить ваш час і підвищить шанси на швидку відповідь від роботодавців.', 'Ми не лише створимо резюме, а й зробимо першу розсилку за вас — це заощадить ваш час і підвищить шанси на швидку відповідь від роботодавців.', 'CV Writer');
        pll_register_string('Чому обирають нас?', 'Чому обирають нас?', 'CV Writer');
        pll_register_string('Наші спеціалісти знають, що шукають крюїнгові агенції у кандидатів, і підкреслять ваші сильні сторони, навіть якщо вони ще не очевидні.', 'Наші спеціалісти знають, що шукають крюїнгові агенції у кандидатів, і підкреслять ваші сильні сторони, навіть якщо вони ще не очевидні.', 'CV Writer');
        
        // Рядовий пакет
        pll_register_string('Цей пакет створено для рядових моряків, які мають практичний досвід роботи на суднах і прагнуть підвищити свої шанси на отримання привабливих пропозицій від крюїнгових компаній. Професійне резюме — ваш ключ до кращих контрактів.', 'Цей пакет створено для рядових моряків, які мають практичний досвід роботи на суднах і прагнуть підвищити свої шанси на отримання привабливих пропозицій від крюїнгових компаній. Професійне резюме — ваш ключ до кращих контрактів.', 'CV Writer');
        pll_register_string('Структурований підхід: Ваш досвід, навички та сертифікати будуть представлені чітко і професійно, щоб виділитися серед інших кандидатів.', 'Структурований підхід: Ваш досвід, навички та сертифікати будуть представлені чітко і професійно, щоб виділитися серед інших кандидатів.', 'CV Writer');
        pll_register_string('Супровідний лист: Ми підготуємо індивідуальний cover letter, який підкреслить ваші сильні сторони та пояснить, чому саме ви підходите для роботи на обраному типі судна.', 'Супровідний лист: Ми підготуємо індивідуальний cover letter, який підкреслить ваші сильні сторони та пояснить, чому саме ви підходите для роботи на обраному типі судна.', 'CV Writer');
        pll_register_string('Індивідуальний дизайн: Резюме буде оформлено у сучасному стилі, зручному для читання і сприйняття.', 'Індивідуальний дизайн: Резюме буде оформлено у сучасному стилі, зручному для читання і сприйняття.', 'CV Writer');
        pll_register_string('Консультація з дизайнером та узгодження всіх деталей: Обговоримо ваші побажання, щоб резюме відображало ваш професійний профіль максимально точно.', 'Консультація з дизайнером та узгодження всіх деталей: Обговоримо ваші побажання, щоб резюме відображало ваш професійний профіль максимально точно.', 'CV Writer');
        pll_register_string('Готові файли у форматах .pdf, .docx, .xlsx для зручності подачі до компаній і власного користування.', 'Готові файли у форматах .pdf, .docx, .xlsx для зручності подачі до компаній і власного користування.', 'CV Writer');
        pll_register_string('Для рядових моряків (матроси, мотористи, кухарі, стюарди тощо), які мають досвід роботи і хочуть вивести свою кар\'єру на новий рівень.', 'Для рядових моряків (матроси, мотористи, кухарі, стюарди тощо), які мають досвід роботи і хочуть вивести свою кар\'єру на новий рівень.', 'CV Writer');
        pll_register_string('Якісне резюме з cover letter значно підвищує ваші шанси на швидше працевлаштування, адже воно відразу привертає увагу рекрутерів і HR-менеджерів.', 'Якісне резюме з cover letter значно підвищує ваші шанси на швидше працевлаштування, адже воно відразу привертає увагу рекрутерів і HR-менеджерів.', 'CV Writer');
        pll_register_string('Ми знаємо, як подати ваш досвід так, щоб він виділявся. Наші спеціалісти працюють з морською індустрією і розуміють, які аспекти важливі для роботодавців.', 'Ми знаємо, як подати ваш досвід так, щоб він виділявся. Наші спеціалісти працюють з морською індустрією і розуміють, які аспекти важливі для роботодавців.', 'CV Writer');
        
        // Офіцери пакет
        pll_register_string('Цей пакет розроблено для офіцерів, які прагнуть підкреслити свій професійний досвід і кваліфікацію на найвищому рівні. Якісне резюме для офіцера — це не просто перелік досвіду, а ваша візитна картка у світі морської індустрії.', 'Цей пакет розроблено для офіцерів, які прагнуть підкреслити свій професійний досвід і кваліфікацію на найвищому рівні. Якісне резюме для офіцера — це не просто перелік досвіду, а ваша візитна картка у світі морської індустрії.', 'CV Writer');
        pll_register_string('Для офіцерів (капітани, старпоми, механіки, електромеханіки, другі помічники тощо), які мають досвід роботи на різних типах суден і шукають нові кар\'єрні можливості.', 'Для офіцерів (капітани, старпоми, механіки, електромеханіки, другі помічники тощо), які мають досвід роботи на різних типах суден і шукають нові кар\'єрні можливості.', 'CV Writer');
        pll_register_string('Професійне резюме і cover letter дозволяють виділитися серед конкурентів, підвищують довіру роботодавців і відкривають доступ до найкращих контрактів.', 'Професійне резюме і cover letter дозволяють виділитися серед конкурентів, підвищують довіру роботодавців і відкривають доступ до найкращих контрактів.', 'CV Writer');
        pll_register_string('Ми розуміємо специфіку роботи офіцерів і знаємо, як підкреслити ваші досягнення та лідерські якості. Наші спеціалісти працюють виключно над резюме для морської індустрії, що дає нам унікальний досвід.', 'Ми розуміємо специфіку роботи офіцерів і знаємо, як підкреслити ваші досягнення та лідерські якості. Наші спеціалісти працюють виключно над резюме для морської індустрії, що дає нам унікальний досвід.', 'CV Writer');
        
        // Слайдер До/Після
        pll_register_string('ДО', 'ДО', 'CV Writer');
        pll_register_string('ПІСЛЯ', 'ПІСЛЯ', 'CV Writer');
        
        // Кроки замовлення
        pll_register_string('Як замовити?', 'Як замовити?', 'CV Writer');
        pll_register_string('Замовити послугу просто — достатньо трьох кроків, щоб отримати якісне резюме та почати отримувати відповіді від роботодавців.', 'Замовити послугу просто — достатньо трьох кроків, щоб отримати якісне резюме та почати отримувати відповіді від роботодавців.', 'CV Writer');
        pll_register_string('Крок 1', 'Крок 1', 'CV Writer');
        pll_register_string('Оберіть свій пакет', 'Оберіть свій пакет', 'CV Writer');
        pll_register_string('Додайте обраний пакет до кошика, заповніть коротку форму і перейдіть до оплати. Ми приймаємо оплату через безпечні платіжні системи Monobank або Fondy.', 'Додайте обраний пакет до кошика, заповніть коротку форму і перейдіть до оплати. Ми приймаємо оплату через безпечні платіжні системи Monobank або Fondy.', 'CV Writer');
        pll_register_string('Крок 2', 'Крок 2', 'CV Writer');
        pll_register_string('Заповніть форму', 'Заповніть форму', 'CV Writer');
        pll_register_string('Заповніть свої дані, прикріпіть актуальне або попереднє резюме (за наявності) та дайте відповіді на кілька запитань.', 'Заповніть свої дані, прикріпіть актуальне або попереднє резюме (за наявності) та дайте відповіді на кілька запитань.', 'CV Writer');
        pll_register_string('Вкажіть контактні дані та зручний месенджер для зв\'язку (WhatsApp, Viber або Telegram).', 'Вкажіть контактні дані та зручний месенджер для зв\'язку (WhatsApp, Viber або Telegram).', 'CV Writer');
        pll_register_string('Крок 3', 'Крок 3', 'CV Writer');
        pll_register_string('Консультація', 'Консультація', 'CV Writer');
        pll_register_string('Наш консультант зв\'яжеться з вами у вибраному месенджері найближчим часом, щоб обговорити всі нюанси та уточнити деталі вашого досвіду.', 'Наш консультант зв\'яжеться з вами у вибраному месенджері найближчим часом, щоб обговорити всі нюанси та уточнити деталі вашого досвіду.', 'CV Writer');
        pll_register_string('Крок 4', 'Крок 4', 'CV Writer');
        pll_register_string('Підготовка та передача готового CV', 'Підготовка та передача готового CV', 'CV Writer');
        pll_register_string('Ми підготуємо професійне індивідуальне резюме англійською мовою, адаптоване під ваш досвід та вакансії. Готові файли ви отримаєте у форматах .pdf, .docx та .xlsx.', 'Ми підготуємо професійне індивідуальне резюме англійською мовою, адаптоване під ваш досвід та вакансії. Готові файли ви отримаєте у форматах .pdf, .docx та .xlsx.', 'CV Writer');
        
        // FAQ
        pll_register_string('Маєте питання?', 'Маєте питання?', 'CV Writer');
        pll_register_string('Ми зібрали відповіді на найпоширеніші запити, щоб вам було зручніше.', 'Ми зібрали відповіді на найпоширеніші запити, щоб вам було зручніше.', 'CV Writer');
        pll_register_string('Що входить у вартість створення CV?', 'Що входить у вартість створення CV?', 'CV Writer');
        pll_register_string('У вартість входить: професійне оформлення резюме, розробка індивідуального дизайну, складання супровідного листа, консультація з кар\'єрним консультантом і адаптація під ваш досвід та обрану посаду.', 'У вартість входить: професійне оформлення резюме, розробка індивідуального дизайну, складання супровідного листа, консультація з кар\'єрним консультантом і адаптація під ваш досвід та обрану посаду.', 'CV Writer');
        pll_register_string('Для  кандидатів без досвіду роботи ми даруємо в подарунок безкоштовну розсилку по крюїнгах України  та Грузії.', 'Для  кандидатів без досвіду роботи ми даруємо в подарунок безкоштовну розсилку по крюїнгах України  та Грузії.', 'CV Writer');
        pll_register_string('Чи можна замовити лише розсилку без створення CV?', 'Чи можна замовити лише розсилку без створення CV?', 'CV Writer');
        pll_register_string('Так, така можливість є. Ви можете надати власне готове резюме, а ми допоможемо з його розсилкою по відповідних компаніях чи типах флоту . За потреби, наш консультант згенерує супровідний лист під Ваше резюме та з урахуванням вашого досвіду- це покращить впізнаванність Вашого резюме та допоможе не загубитись в почтовій скринці крюїнг менеджера.', 'Так, така можливість є. Ви можете надати власне готове резюме, а ми допоможемо з його розсилкою по відповідних компаніях чи типах флоту . За потреби, наш консультант згенерує супровідний лист під Ваше резюме та з урахуванням вашого досвіду- це покращить впізнаванність Вашого резюме та допоможе не загубитись в почтовій скринці крюїнг менеджера.', 'CV Writer');
        pll_register_string('Як зі мною зв\'яжеться консультант?', 'Як зі мною зв\'яжеться консультант?', 'CV Writer');
        pll_register_string('Після оформлення замовлення з вами зв\'яжеться наш консультант у зручний для вас спосіб — телефоном, електронною поштою або в месенджері. Ви зможете обговорити всі деталі, побажання та поставити додаткові запитання.', 'Після оформлення замовлення з вами зв\'яжеться наш консультант у зручний для вас спосіб — телефоном, електронною поштою або в месенджері. Ви зможете обговорити всі деталі, побажання та поставити додаткові запитання.', 'CV Writer');
    
	
		// Front Page strings - додати в register_polylang_strings()

		// Hero секція
		pll_register_string('Професійне CV, що відкриває двері до нового контракту', 'Професійне CV, що відкриває двері до нового контракту', 'Front Page');
		pll_register_string('Якісне оформлення, таргетована розсилка, реальні відповіді.', 'Якісне оформлення, таргетована розсилка, реальні відповіді.', 'Front Page');
		pll_register_string('Понад 50 000 моряків вже довірились нам.', 'Понад 50 000 моряків вже довірились нам.', 'Front Page');

		// Переваги
		pll_register_string('Велика база контактів', 'Велика база контактів', 'Front Page');
		pll_register_string('Доступ до 1 500+ перевірених крюїнг-компаній по всьому світу.', 'Доступ до 1 500+ перевірених крюїнг-компаній по всьому світу.', 'Front Page');
		pll_register_string('Доставка гарантована', 'Доставка гарантована', 'Front Page');
		pll_register_string('Ваше CV доходить до потрібних компаній — минаючи спам-фільтри.', 'Ваше CV доходить до потрібних компаній — минаючи спам-фільтри.', 'Front Page');
		pll_register_string('Старт від 24 годин', 'Старт від 24 годин', 'Front Page');
		pll_register_string('Ми розпочинаємо роботу одразу після оплати. Без затримок.', 'Ми розпочинаємо роботу одразу після оплати. Без затримок.', 'Front Page');
		pll_register_string('Цільова розсилка', 'Цільова розсилка', 'Front Page');
		pll_register_string('Обираєш флот або регіон — ми надсилаємо лише потрібним крюїнгам.', 'Обираєш флот або регіон — ми надсилаємо лише потрібним крюїнгам.', 'Front Page');

		// Про сервіс
		pll_register_string('Seafarer', 'Seafarer', 'Front Page');
		pll_register_string('CV', 'CV', 'Front Page');
		pll_register_string('— це не просто сервіс.', '— це не просто сервіс.', 'Front Page');
		pll_register_string('Це команда, яка допомагає морякам отримати результат.', 'Це команда, яка допомагає морякам отримати результат.', 'Front Page');

		// Кроки замовлення
		pll_register_string('Від заявки до контракту — всього кілька кроків', 'Від заявки до контракту — всього кілька кроків', 'Front Page');
		pll_register_string('Ми подбали, щоб шлях до нового рейсу був швидким та зрозумілим: оберіть послугу, надішліть дані, підтвердьте оплату — і отримуйте запрошення на співбесіди.', 'Ми подбали, щоб шлях до нового рейсу був швидким та зрозумілим: оберіть послугу, надішліть дані, підтвердьте оплату — і отримуйте запрошення на співбесіди.', 'Front Page');

		pll_register_string('Оберіть послугу', 'Оберіть послугу', 'Front Page');
		pll_register_string('Виберіть одну або кілька послуг:', 'Виберіть одну або кілька послуг:', 'Front Page');
		pll_register_string('Розсилка CV за флотом', 'Розсилка CV за флотом', 'Front Page');
		pll_register_string('Розсилка CV за регіонами', 'Розсилка CV за регіонами', 'Front Page');
		pll_register_string('Кожну послугу можна оформити окремо та додати до кошика.', 'Кожну послугу можна оформити окремо та додати до кошика.', 'Front Page');
		pll_register_string('Перегляньте деталі або натисніть', 'Перегляньте деталі або натисніть', 'Front Page');
		pll_register_string('«Додати до кошика»', '«Додати до кошика»', 'Front Page');
		pll_register_string('та перейдіть до оформлення.', 'та перейдіть до оформлення.', 'Front Page');

		pll_register_string('У кошику натискаєте «Оформити замовлення» — відкриється форма для заповнення.', 'У кошику натискаєте «Оформити замовлення» — відкриється форма для заповнення.', 'Front Page');
		pll_register_string('Вкажіть свої дані, за потреби прикріпіть файл та залиште коментарі.', 'Вкажіть свої дані, за потреби прикріпіть файл та залиште коментарі.', 'Front Page');
		pll_register_string('Після цього натисніть «Надіслати замовлення» — і ми одразу отримаємо вашу заявку.', 'Після цього натисніть «Надіслати замовлення» — і ми одразу отримаємо вашу заявку.', 'Front Page');

		pll_register_string('Оплата замовлення', 'Оплата замовлення', 'Front Page');
		pll_register_string('Після заповнення форми отримаєте реквізити для оплати на пошту', 'Після заповнення форми отримаєте реквізити для оплати на пошту', 'Front Page');
		pll_register_string('Оплачуйте зручно: Visa, MasterCard, PayPal.', 'Оплачуйте зручно: Visa, MasterCard, PayPal.', 'Front Page');
		pll_register_string('Після підтвердження оплати ми сповістимо вас листом на пошту про запуск розсилки.', 'Після підтвердження оплати ми сповістимо вас листом на пошту про запуск розсилки.', 'Front Page');

		pll_register_string('Обробка замовлення', 'Обробка замовлення', 'Front Page');
		pll_register_string('Надання послуги:', 'Надання послуги:', 'Front Page');
		pll_register_string('Менеджер перевіряє анкету та призначає дату розсилки.', 'Менеджер перевіряє анкету та призначає дату розсилки.', 'Front Page');
		pll_register_string('Графік: Пн–Пт, з 10:00 до 15:00', 'Графік: Пн–Пт, з 10:00 до 15:00', 'Front Page');
		pll_register_string('Повторна розсилка — через 7–14 днів.', 'Повторна розсилка — через 7–14 днів.', 'Front Page');
		pll_register_string('Лише якісні інструменти та антиспам-перевірка. Ваше резюме потрапляє в INBOX, а не в SPAM.', 'Лише якісні інструменти та антиспам-перевірка. Ваше резюме потрапляє в INBOX, а не в SPAM.', 'Front Page');
		pll_register_string('Завершення послуги:', 'Завершення послуги:', 'Front Page');
		pll_register_string('Звіт та посилання надсилаються вам на пошту після запуску розсилки.', 'Звіт та посилання надсилаються вам на пошту після запуску розсилки.', 'Front Page');
		pll_register_string('Повторна розсилка:', 'Повторна розсилка:', 'Front Page');
		pll_register_string('Рекомендуємо робити через 7–14 днів для підвищення ефективності.', 'Рекомендуємо робити через 7–14 днів для підвищення ефективності.', 'Front Page');

		pll_register_string('Відправляйтесь у рейс', 'Відправляйтесь у рейс', 'Front Page');
		pll_register_string('Отримуйте відповіді, проходьте співбесіди, підписуйте контракт — і вирушайте на новий етап своєї морської кар\'єри.', 'Отримуйте відповіді, проходьте співбесіди, підписуйте контракт — і вирушайте на новий етап своєї морської кар\'єри.', 'Front Page');

		// Розсилка CV
		pll_register_string('⚓ По флоту', '⚓ По флоту', 'Front Page');
		pll_register_string('🌎 По регіонам', '🌎 По регіонам', 'Front Page');
		pll_register_string('Розсилка СV', 'Розсилка СV', 'Front Page');
		pll_register_string('Обери тип флоту, в якому хочеш працювати — і ми розішлемо твоє резюме в найкращі компанії.', 'Обери тип флоту, в якому хочеш працювати — і ми розішлемо твоє резюме в найкращі компанії.', 'Front Page');
		pll_register_string('По флоту', 'По флоту', 'Front Page');

		// Типи флоту
		pll_register_string('Торговий флот', 'Торговий флот', 'Front Page');
		pll_register_string('емейлів', 'емейлів', 'Front Page');
		pll_register_string('Танкерний флот', 'Танкерний флот', 'Front Page');
		pll_register_string('Офшорний флот', 'Офшорний флот', 'Front Page');
		pll_register_string('Пасажирський флот', 'Пасажирський флот', 'Front Page');

		// Регіони
		pll_register_string('По регіонам', 'По регіонам', 'Front Page');
		pll_register_string('Європа 🇪🇺 + Велика Британія 🇬🇧', 'Європа 🇪🇺 + Велика Британія 🇬🇧', 'Front Page');
		pll_register_string('Хіт продажів', 'Хіт продажів', 'Front Page');
		pll_register_string('Країни Балтії 🇱🇹🇪🇪🇱🇻', 'Країни Балтії 🇱🇹🇪🇪🇱🇻', 'Front Page');
		pll_register_string('Скандинавія 🇳🇴🇸🇪🇫🇮🇩🇰', 'Скандинавія 🇳🇴🇸🇪🇫🇮🇩🇰', 'Front Page');
		pll_register_string('Україна 🇺🇦 + Грузія 🇬🇪', 'Україна 🇺🇦 + Грузія 🇬🇪', 'Front Page');
		pll_register_string('Весь світ 🌎', 'Весь світ 🌎', 'Front Page');

		// Додаткові тексти
		pll_register_string('Детальніше про послугу', 'Детальніше про послугу', 'Front Page');
		pll_register_string('Додати до кошика', 'Додати до кошика', 'Front Page');
		

		pll_register_string('Зв\'яжіться з нами у зручному месенджері:', 'Зв\'яжіться з нами у зручному месенджері:', 'Footer');
		pll_register_string('Telegram', 'Telegram', 'Footer');
		pll_register_string('Viber', 'Viber', 'Footer');
		pll_register_string('WhatsApp', 'WhatsApp', 'Footer');
		pll_register_string('Наші контакти', 'Наші контакти', 'Footer');
		pll_register_string('Email', 'Email', 'Footer');
		pll_register_string('Зв\'язатися', 'Зв\'язатися', 'Footer');
		pll_register_string('Корисні посилання', 'Корисні посилання', 'Footer');
		pll_register_string('Політика конфіденційності', 'Політика конфіденційності', 'Footer');
		pll_register_string('Умови використання', 'Умови використання', 'Footer');
		pll_register_string('© 2024 Seafarer CV. Всі права захищені.', '© 2024 Seafarer CV. Всі права захищені.', 'Footer');
		
		
		// Page Sending strings - додати в register_polylang_strings() після інших рядків

		// Tabs
		pll_register_string('⚓ По флоту', '⚓ По флоту', 'Sending');
		pll_register_string('🌎 По регіонам', '🌎 По регіонам', 'Sending');

		// Main section
		pll_register_string('Розсилка СV', 'Розсилка СV', 'Sending');
		pll_register_string('Обери тип флоту, в якому хочеш працювати — і ми розішлемо твоє резюме в найкращі компанії.', 'Обери тип флоту, в якому хочеш працювати — і ми розішлемо твоє резюме в найкращі компанії.', 'Sending');

		// Section headers
		pll_register_string('По флоту', 'По флоту', 'Sending');
		pll_register_string('По регіонам', 'По регіонам', 'Sending');
		pll_register_string('або', 'або', 'Sending');

		// Fleet types
		pll_register_string('Торговий флот', 'Торговий флот', 'Sending');
		pll_register_string('Танкерний флот', 'Танкерний флот', 'Sending');
		pll_register_string('Офшорний флот', 'Офшорний флот', 'Sending');
		pll_register_string('Пасажирський флот', 'Пасажирський флот', 'Sending');

		// Common
		pll_register_string('емейлів', 'емейлів', 'Sending');
		pll_register_string('Докладніше', 'Докладніше', 'Sending');
		pll_register_string('Хіт продажів', 'Хіт продажів', 'Sending');

		// Regions
		pll_register_string('Європa 🇪🇺 + Велика Британія 🇬🇧', 'Європa 🇪🇺 + Велика Британія 🇬🇧', 'Sending');
		pll_register_string('Країни Балтії 🇱🇹🇪🇪🇱🇻', 'Країни Балтії 🇱🇹🇪🇪🇱🇻', 'Sending');
		pll_register_string('Україна 🇺🇦 + Грузія 🇬🇪', 'Україна 🇺🇦 + Грузія 🇬🇪', 'Sending');
		pll_register_string('Весь світ 🌎', 'Весь світ 🌎', 'Sending');
		pll_register_string('Скандинавія 🇳🇴🇸🇪🇫🇮🇩🇰', 'Скандинавія 🇳🇴🇸🇪🇫🇮🇩🇰', 'Sending');

		// Region description
		pll_register_string('Хочеш щоб твоє резюме побачили крюїнг менеджери з різних країн? Обери регіон', 'Хочеш щоб твоє резюме побачили крюїнг менеджери з різних країн? Обери регіон', 'Sending');

		// Detailed fleet descriptions
		pll_register_string('Спеціалізована розсилка для торгового флоту', 'Спеціалізована розсилка для торгового флоту', 'Sending');
		pll_register_string('Спеціалізована розсилка для танкерного флоту', 'Спеціалізована розсилка для танкерного флоту', 'Sending');
		pll_register_string('Спеціалізована розсилка для офшорного флоту', 'Спеціалізована розсилка для офшорного флоту', 'Sending');
		pll_register_string('Спеціалізована розсилка для пасажирського флоту', 'Спеціалізована розсилка для пасажирського флоту', 'Sending');

		// Ship types
		pll_register_string('Суховантажі та контейнеровози', 'Суховантажі та контейнеровози', 'Sending');
		pll_register_string('Спеціалізовані судна', 'Спеціалізовані судна', 'Sending');
		pll_register_string('Ro-Ro судна', 'Ro-Ro судна', 'Sending');

		// Tanker types
		pll_register_string('Нафтові танкери', 'Нафтові танкери', 'Sending');
		pll_register_string('Хімічні танкери', 'Хімічні танкери', 'Sending');
		pll_register_string('Газові танкери', 'Газові танкери', 'Sending');

		// Offshore types
		pll_register_string('Supply vessels', 'Supply vessels', 'Sending');
		pll_register_string('Platform Supply', 'Platform Supply', 'Sending');
		pll_register_string('Anchor Handling', 'Anchor Handling', 'Sending');
		pll_register_string('Cable Laying', 'Cable Laying', 'Sending');
		pll_register_string('Construction vessels', 'Construction vessels', 'Sending');

		// Passenger types
		pll_register_string('Круїзні лайнери', 'Круїзні лайнери', 'Sending');
		pll_register_string('Пороми', 'Пороми', 'Sending');
		pll_register_string('Яхти', 'Яхти', 'Sending');

		// FAQ Section (if exists in sending page)
		pll_register_string('Маєте питання?', 'Маєте питання?', 'Sending');
		pll_register_string('Ми зібрали відповіді на найпоширеніші запити, щоб вам було зручніше.', 'Ми зібрали відповіді на найпоширеніші запити, щоб вам було зручніше.', 'Sending');

		// Additional descriptions if needed
		pll_register_string('Цільова розсилка резюме по компаніям, що спеціалізуються на торговому флоті', 'Цільова розсилка резюме по компаніям, що спеціалізуються на торговому флоті', 'Sending');
		pll_register_string('Цільова розсилка резюме по компаніям, що спеціалізуються на танкерному флоті', 'Цільова розсилка резюме по компаніям, що спеціалізуються на танкерному флоті', 'Sending');
		pll_register_string('Цільова розсилка резюме по компаніям, що спеціалізуються на офшорному флоті', 'Цільова розсилка резюме по компаніям, що спеціалізуються на офшорному флоті', 'Sending');
		pll_register_string('Цільова розсилка резюме по компаніям, що спеціалізуються на пасажирському флоті', 'Цільова розсилка резюме по компаніям, що спеціалізуються на пасажирському флоті', 'Sending');
		
		// Page Order strings - додати в register_polylang_strings()

		// Main title
		pll_register_string('Оформити замовлення', 'Оформити замовлення', 'Order');

		// Form fields
		pll_register_string('Ім\'я', 'Ім\'я', 'Order');
		pll_register_string('Прізвище', 'Прізвище', 'Order');
		pll_register_string('Електронна пошта', 'Електронна пошта', 'Order');
		pll_register_string('Номер телефону', 'Номер телефону', 'Order');
		pll_register_string('Сюди надійде підтвердження та звіт', 'Сюди надійде підтвердження та звіт', 'Order');

		// Messenger section
		pll_register_string('Оберіть зручний месенджер для зв\'язку', 'Оберіть зручний месенджер для зв\'язку', 'Order');
		pll_register_string('Viber', 'Viber', 'Order');
		pll_register_string('WhatsApp', 'WhatsApp', 'Order');
		pll_register_string('Telegram', 'Telegram', 'Order');

		// File upload
		pll_register_string('Завантаження файлу', 'Завантаження файлу', 'Order');
		pll_register_string('Завантажте актуальне резюме/CV', 'Завантажте актуальне резюме/CV', 'Order');
		pll_register_string('Підтримувані формати: PDF, DOCX, XLSX (до 5 МБ)', 'Підтримувані формати: PDF, DOCX, XLSX (до 5 МБ)', 'Order');
		pll_register_string('Файл не обрано', 'Файл не обрано', 'Order');

		// Comments
		pll_register_string('Компанії, з якими не хочу працювати', 'Компанії, з якими не хочу працювати', 'Order');
		pll_register_string('Вкажіть назви компаній, пропозиції від яких не хочете розглядати.', 'Вкажіть назви компаній, пропозиції від яких не хочете розглядати.', 'Order');
		pll_register_string('Комментар', 'Комментар', 'Order');
		pll_register_string('Напишіть будь-які деталі чи побажання для нашої команди.', 'Напишіть будь-які деталі чи побажання для нашої команди.', 'Order');

		// Info and agreement
		pll_register_string('Після підтвердження оплати ми надішлемо лист на вашу пошту з повідомленням про запуск розсилки.', 'Після підтвердження оплати ми надішлемо лист на вашу пошту з повідомленням про запуск розсилки.', 'Order');
		pll_register_string('Я погоджуюся з умовами використання', 'Я погоджуюся з умовами використання', 'Order');

		// Buttons and actions
		pll_register_string('Надіслати замовлення', 'Надіслати замовлення', 'Order');
		pll_register_string('До кошика', 'До кошика', 'Order');

		// Security
		pll_register_string('Ваші дані захищені та використовуються лише для виконання замовлення.', 'Ваші дані захищені та використовуються лише для виконання замовлення.', 'Order');

		// Order summary
		pll_register_string('Ваше замовлення', 'Ваше замовлення', 'Order');
		pll_register_string('Всього:', 'Всього:', 'Order');

		// Success popup
		pll_register_string('Дякуємо! Ваша заявка успішно відправлена.', 'Дякуємо! Ваша заявка успішно відправлена.', 'Order');
		pll_register_string('Наш менеджер перевірить вашу заявку та надішле реквізити для оплати на вказану електронну пошту протягом робочого дня.', 'Наш менеджер перевірить вашу заявку та надішле реквізити для оплати на вказану електронну пошту протягом робочого дня.', 'Order');

		// ============================================
		// Page Payment Success strings
		// ============================================

		pll_register_string('Дякуємо за ваше замовлення!', 'Дякуємо за ваше замовлення!', 'Payment');
		pll_register_string('Ваш платіж успішно оброблено.', 'Ваш платіж успішно оброблено.', 'Payment');

		// Order info
		pll_register_string('Номер замовлення:', 'Номер замовлення:', 'Payment');
		pll_register_string('Час операції:', 'Час операції:', 'Payment');
		pll_register_string('Ми зв\'яжемося з вами протягом 24 годин', 'Ми зв\'яжемося з вами протягом 24 годин', 'Payment');
		pll_register_string('Робота над резюме розпочнеться після уточнення деталей', 'Робота над резюме розпочнеться після уточнення деталей', 'Payment');

		// Button
		pll_register_string('Повернутися на головну', 'Повернутися на головну', 'Payment');

		// JS string
		pll_register_string('Не вказано', 'Не вказано', 'Payment');
		
		// Page Busket strings - додати в register_polylang_strings()

		// Main title
		pll_register_string('Послуга в кошику', 'Послуга в кошику', 'Busket');

		// Navigation
		pll_register_string('Назад', 'Назад', 'Busket');

		// Payment section
		pll_register_string('Разом до сплати', 'Разом до сплати', 'Busket');
		pll_register_string('Всього:', 'Всього:', 'Busket');

		// Button
		pll_register_string('Оформити замовлення', 'Оформити замовлення', 'Busket');
		
		// Home Page strings - додати в register_polylang_strings()

		pll_register_string('Нет записей для отображения.', 'Нет записей для отображения.', 'Home');

		// ============================================
		// Page Company Info strings
		// ============================================

		pll_register_string('Інформація про компанію', 'Інформація про компанію', 'Company Info');
		pll_register_string('Даний договір адресований фізичним особам, які зацікавлені в отриманні інформаційно-консультаційних послуг, перелік яких міститься на сайті https://seafarercv.com і є офіційною пропозицією Фізичної особи – підприємця Станіслав – укласти даний договір про нижче наведене:', 'Даний договір адресований фізичним особам, які зацікавлені в отриманні інформаційно-консультаційних послуг, перелік яких міститься на сайті https://seafarercv.com і є офіційною пропозицією Фізичної особи – підприємця Станіслав – укласти даний договір про нижче наведене:', 'Company Info');

		// Company details
		pll_register_string('ЄДРПОУ:', 'ЄДРПОУ:', 'Company Info');
		pll_register_string('Юридична адреса:', 'Юридична адреса:', 'Company Info');
		pll_register_string('Фактичний адреса:', 'Фактичний адреса:', 'Company Info');

		// CTA Block (shared)
		pll_register_string('Зробіть перший крок до роботи мрії', 'Зробіть перший крок до роботи мрії', 'CTA');
		pll_register_string('Ми створимо і надішлемо резюме туди, де на вас чекають.', 'Ми створимо і надішлемо резюме туди, де на вас чекають.', 'CTA');

		// ============================================
		// Page Garanty (Refund Policy) strings
		// ============================================

		pll_register_string('SEAFARER ПОЛІТИКА ПОВЕРНЕННЯ КОШТІВ', 'SEAFARER ПОЛІТИКА ПОВЕРНЕННЯ КОШТІВ', 'Garanty');
		pll_register_string('Дата набрання чинності: 30 вересня 2025', 'Дата набрання чинності: 30 вересня 2025', 'Garanty');

		// General rule
		pll_register_string('Загальне правило:', 'Загальне правило:', 'Garanty');
		pll_register_string('усі платежі за Послуги є остаточними та не підлягають поверненню, за винятком випадків, прямо передбачених цією Політикою. Придбаваючи Послуги, Користувач підтверджує свою згоду з цією Політикою повернення коштів.', 'усі платежі за Послуги є остаточними та не підлягають поверненню, за винятком випадків, прямо передбачених цією Політикою. Придбаваючи Послуги, Користувач підтверджує свою згоду з цією Політикою повернення коштів.', 'Garanty');

		// Section titles
		pll_register_string('1. ПРАВО НА ПОВЕРНЕННЯ', '1. ПРАВО НА ПОВЕРНЕННЯ', 'Garanty');
		pll_register_string('2. ВИНЯТКИ', '2. ВИНЯТКИ', 'Garanty');
		pll_register_string('3. ПОРЯДОК ПОВЕРНЕННЯ', '3. ПОРЯДОК ПОВЕРНЕННЯ', 'Garanty');
		pll_register_string('4. МЕТОД ПОВЕРНЕННЯ', '4. МЕТОД ПОВЕРНЕННЯ', 'Garanty');
		pll_register_string('5. ЗАСТОСОВНЕ ПРАВО', '5. ЗАСТОСОВНЕ ПРАВО', 'Garanty');
		pll_register_string('6. МОВА', '6. МОВА', 'Garanty');
		pll_register_string('7. КОНТАКТИ', '7. КОНТАКТИ', 'Garanty');

		// Section 1 content
		pll_register_string('Повернення коштів можливе лише у випадку, якщо Компанія не надала Послугу у строк, визначений в Публічному договорі.', 'Повернення коштів можливе лише у випадку, якщо Компанія не надала Послугу у строк, визначений в Публічному договорі.', 'Garanty');

		// Section 2 content
		pll_register_string('Повернення коштів не здійснюється у таких випадках:', 'Повернення коштів не здійснюється у таких випадках:', 'Garanty');
		pll_register_string('якщо Послуга була надана, незалежно від задоволеності Користувача її змістом чи якістю;', 'якщо Послуга була надана, незалежно від задоволеності Користувача її змістом чи якістю;', 'Garanty');
		pll_register_string('якщо затримка або ненадання Послуги сталися з причин, що знаходяться поза межами розумного контролю Компанії (форс-мажор);', 'якщо затримка або ненадання Послуги сталися з причин, що знаходяться поза межами розумного контролю Компанії (форс-мажор);', 'Garanty');
		pll_register_string('якщо Користувач не надав необхідну інформацію, доступ чи сприяння, які потрібні для надання Послуги;', 'якщо Користувач не надав необхідну інформацію, доступ чи сприяння, які потрібні для надання Послуги;', 'Garanty');
		pll_register_string('якщо Користувач порушив Публічний договір або інші застосовні політики.', 'якщо Користувач порушив Публічний договір або інші застосовні політики.', 'Garanty');

		// Section 3 content
		pll_register_string('Для запиту на повернення коштів Користувач зобов\'язаний звернутися до служби підтримки Компанії у письмовій формі протягом 7 календарних днів з дати, коли Послуга мала бути надана. Запит має містити підтвердження оплати та чітке пояснення причини повернення. У разі схвалення повернення коштів воно буде здійснене протягом 14 календарних днів.', 'Для запиту на повернення коштів Користувач зобов\'язаний звернутися до служби підтримки Компанії у письмовій формі протягом 7 календарних днів з дати, коли Послуга мала бути надана. Запит має містити підтвердження оплати та чітке пояснення причини повернення. У разі схвалення повернення коштів воно буде здійснене протягом 14 календарних днів.', 'Garanty');

		// Section 4 content
		pll_register_string('У разі схвалення повернення коштів вони перераховуються тим самим способом оплати, який використовувався під час придбання, якщо інше не погоджено з Користувачем. Компанія не несе відповідальності за затримки, спричинені банками, платіжними системами чи сторонніми провайдерами.', 'У разі схвалення повернення коштів вони перераховуються тим самим способом оплати, який використовувався під час придбання, якщо інше не погоджено з Користувачем. Компанія не несе відповідальності за затримки, спричинені банками, платіжними системами чи сторонніми провайдерами.', 'Garanty');

		// Section 5 content
		pll_register_string('Ця Політика повернення коштів регулюється та тлумачиться відповідно до законодавства, визначеного в Публічному договорі Компанії.', 'Ця Політика повернення коштів регулюється та тлумачиться відповідно до законодавства, визначеного в Публічному договорі Компанії.', 'Garanty');

		// Section 6 content
		pll_register_string('У разі розбіжностей між різними версіями цієї Політики переважну силу має версія українською мовою.', 'У разі розбіжностей між різними версіями цієї Політики переважну силу має версія українською мовою.', 'Garanty');

		// Section 7 content
		pll_register_string('З будь-яких питань, претензій або повідомлень, пов\'язаних із цією Політикою або Послугами, Користувач може звертатися до Компанії за адресою:', 'З будь-яких питань, претензій або повідомлень, пов\'язаних із цією Політикою або Послугами, Користувач може звертатися до Компанії за адресою:', 'Garanty');
		
		// Footer strings - додати в register_polylang_strings()

		// Main contact section
		pll_register_string('Зв\'яжіться з нами у зручному месенджері:', 'Зв\'яжіться з нами у зручному месенджері:', 'Footer');

		// Aria labels for messengers
		pll_register_string('Написати в Telegram', 'Написати в Telegram', 'Footer');
		pll_register_string('Написати в Viber', 'Написати в Viber', 'Footer');
		pll_register_string('Написати в WhatsApp', 'Написати в WhatsApp', 'Footer');

		// Section titles
		pll_register_string('Навігація', 'Навігація', 'Footer');
		pll_register_string('Юридичні питання', 'Юридичні питання', 'Footer');

		// Navigation links
		pll_register_string('Головна', 'Головна', 'Footer');
		pll_register_string('Контакти', 'Контакти', 'Footer');

		// Legal links
		pll_register_string('Публічний договір', 'Публічний договір', 'Footer');
		pll_register_string('Політика повернення', 'Політика повернення', 'Footer');
		pll_register_string('Політика конфіденційності', 'Політика конфіденційності', 'Footer');
		pll_register_string('Інформація про компанію', 'Інформація про компанію', 'Footer');
		
		
		// CV Writer Page - додаткові рядки (додати після існуючих CV Writer strings)

		// Alt-атрибути
		pll_register_string('Добавить в корзину', 'Добавить в корзину', 'CV Writer');

		// Features секція
		pll_register_string('Професійний вигляд', 'Професійний вигляд', 'CV Writer');
		pll_register_string('Індивідуальний сучасний дизайн, що одразу привертає увагу роботодавця.', 'Індивідуальний сучасний дизайн, що одразу привертає увагу роботодавця.', 'CV Writer');
		pll_register_string('Чітка структура', 'Чітка структура', 'CV Writer');
		pll_register_string('Логічно впорядкований зміст для швидкого ознайомлення з вами.', 'Логічно впорядкований зміст для швидкого ознайомлення з вами.', 'CV Writer');
		pll_register_string('Акцент на досягненнях', 'Акцент на досягненнях', 'CV Writer');
		pll_register_string('Підкреслюємо ваші успіхи та сильні сторони для швидкого зацікавлення роботодавця.', 'Підкреслюємо ваші успіхи та сильні сторони для швидкого зацікавлення роботодавця.', 'CV Writer');
		pll_register_string('Міжнародний формат', 'Міжнародний формат', 'CV Writer');
		pll_register_string('Оптимізоване CV, що відповідає світовим стандартам.', 'Оптимізоване CV, що відповідає світовим стандартам.', 'CV Writer');

		// CV Example секція
		pll_register_string('Як виглядати ваше CV', 'Як виглядати ваше CV', 'CV Writer');
		pll_register_string('Ми створюємо резюме, яке легко читається та одразу привертає увагу крюїнг-менеджера.', 'Ми створюємо резюме, яке легко читається та одразу привертає увагу крюїнг-менеджера.', 'CV Writer');
		pll_register_string('За нашим досвідом, на перегляд CV витрачають лише 2–3 хвилини, тому воно має бути максимально зрозумілим і структурованим.', 'За нашим досвідом, на перегляд CV витрачають лише 2–3 хвилини, тому воно має бути максимально зрозумілим і структурованим.', 'CV Writer');
		pll_register_string('У вашому документі буде:', 'У вашому документі буде:', 'CV Writer');
		pll_register_string('5–7 останніх контрактів', '5–7 останніх контрактів', 'CV Writer');
		pll_register_string('головна інформація про досвід.', 'головна інформація про досвід.', 'CV Writer');
		pll_register_string('Попередній досвід роботи в морі', 'Попередній досвід роботи в морі', 'CV Writer');
		pll_register_string('усі інші контракти у скороченому вигляді, щоб не перевантажувати документ.', 'усі інші контракти у скороченому вигляді, щоб не перевантажувати документ.', 'CV Writer');
		pll_register_string('Сертифікати та документи', 'Сертифікати та документи', 'CV Writer');
		pll_register_string('одразу після розділу досвіду роботи.', 'одразу після розділу досвіду роботи.', 'CV Writer');
		pll_register_string('Така структура допомагає швидко показати найважливіше та водночас зберегти повну картину вашої кар\'єри.', 'Така структура допомагає швидко показати найважливіше та водночас зберегти повну картину вашої кар\'єри.', 'CV Writer');
		pll_register_string('Образци резюме', 'Образци резюме', 'CV Writer');

		// CV Blaids секція
		pll_register_string('Приклади готових CV', 'Приклади готових CV', 'CV Writer');
		pll_register_string('Ми підготували приклади CV для різних рівнів досвіду: Стартовий, Рядовий та Офіцери.Це допоможе швидко обрати оптимальний варіант.', 'Ми підготували приклади CV для різних рівнів досвіду: Стартовий, Рядовий та Офіцери.Це допоможе швидко обрати оптимальний варіант.', 'CV Writer');
		pll_register_string('Для новачків або кадетів, які тільки починають кар\'єру в морі. Містить основну інформацію, освіту, сертифікати та 1–2 останніх місця роботи.', 'Для новачків або кадетів, які тільки починають кар\'єру в морі. Містить основну інформацію, освіту, сертифікати та 1–2 останніх місця роботи.', 'CV Writer');
		pll_register_string('До', 'До', 'CV Writer');
		pll_register_string('После', 'После', 'CV Writer');
		pll_register_string('Для моряків із досвідом роботи в командному складі. Містить 5–7 останніх контрактів, попередній досвід у скороченому вигляді та сертифікати.', 'Для моряків із досвідом роботи в командному складі. Містить 5–7 останніх контрактів, попередній досвід у скороченому вигляді та сертифікати.', 'CV Writer');
		pll_register_string('Для старшого командного складу. Включає 5–7 останніх контрактів, повний перелік попереднього досвіду, детальний блок сертифікатів і досягнень.', 'Для старшого командного складу. Включає 5–7 останніх контрактів, повний перелік попереднього досвіду, детальний блок сертифікатів і досягнень.', 'CV Writer');

		// Steps секція
		pll_register_string('Як працює створення CV', 'Як працює створення CV', 'CV Writer');
		pll_register_string('Ми зробимо для вас професійне та структуроване резюме, яке швидко приверне увагу роботодавця.', 'Ми зробимо для вас професійне та структуроване резюме, яке швидко приверне увагу роботодавця.', 'CV Writer');
		pll_register_string('Крок', 'Крок', 'CV Writer');
		pll_register_string('Перейдіть на сторінку створення CV, ознайомтеся з пакетами та описом майбутнього резюме, і додайте послугу до кошика.', 'Перейдіть на сторінку створення CV, ознайомтеся з пакетами та описом майбутнього резюме, і додайте послугу до кошика.', 'CV Writer');
		
		// CV Writer Page - додаткові рядки (додати після існуючих CV Writer strings)

		// Alt-атрибути
		pll_register_string('Добавить в корзину', 'Добавить в корзину', 'CV Writer');

		// Features секція
		pll_register_string('Професійний вигляд', 'Професійний вигляд', 'CV Writer');
		pll_register_string('Індивідуальний сучасний дизайн, що одразу привертає увагу роботодавця.', 'Індивідуальний сучасний дизайн, що одразу привертає увагу роботодавця.', 'CV Writer');
		pll_register_string('Чітка структура', 'Чітка структура', 'CV Writer');
		pll_register_string('Логічно впорядкований зміст для швидкого ознайомлення з вами.', 'Логічно впорядкований зміст для швидкого ознайомлення з вами.', 'CV Writer');
		pll_register_string('Акцент на досягненнях', 'Акцент на досягненнях', 'CV Writer');
		pll_register_string('Підкреслюємо ваші успіхи та сильні сторони для швидкого зацікавлення роботодавця.', 'Підкреслюємо ваші успіхи та сильні сторони для швидкого зацікавлення роботодавця.', 'CV Writer');
		pll_register_string('Міжнародний формат', 'Міжнародний формат', 'CV Writer');
		pll_register_string('Оптимізоване CV, що відповідає світовим стандартам.', 'Оптимізоване CV, що відповідає світовим стандартам.', 'CV Writer');

		// CV Example секція
		pll_register_string('Як виглядати ваше CV', 'Як виглядати ваше CV', 'CV Writer');
		pll_register_string('Ми створюємо резюме, яке легко читається та одразу привертає увагу крюїнг-менеджера.', 'Ми створюємо резюме, яке легко читається та одразу привертає увагу крюїнг-менеджера.', 'CV Writer');
		pll_register_string('За нашим досвідом, на перегляд CV витрачають лише 2–3 хвилини, тому воно має бути максимально зрозумілим і структурованим.', 'За нашим досвідом, на перегляд CV витрачають лише 2–3 хвилини, тому воно має бути максимально зрозумілим і структурованим.', 'CV Writer');
		pll_register_string('У вашому документі буде:', 'У вашому документі буде:', 'CV Writer');
		pll_register_string('5–7 останніх контрактів', '5–7 останніх контрактів', 'CV Writer');
		pll_register_string('головна інформація про досвід.', 'головна інформація про досвід.', 'CV Writer');
		pll_register_string('Попередній досвід роботи в морі', 'Попередній досвід роботи в морі', 'CV Writer');
		pll_register_string('усі інші контракти у скороченому вигляді, щоб не перевантажувати документ.', 'усі інші контракти у скороченому вигляді, щоб не перевантажувати документ.', 'CV Writer');
		pll_register_string('Сертифікати та документи', 'Сертифікати та документи', 'CV Writer');
		pll_register_string('одразу після розділу досвіду роботи.', 'одразу після розділу досвіду роботи.', 'CV Writer');
		pll_register_string('Така структура допомагає швидко показати найважливіше та водночас зберегти повну картину вашої кар\'єри.', 'Така структура допомагає швидко показати найважливіше та водночас зберегти повну картину вашої кар\'єри.', 'CV Writer');
		pll_register_string('Образци резюме', 'Образци резюме', 'CV Writer');

		// CV Blaids секція
		pll_register_string('Приклади готових CV', 'Приклади готових CV', 'CV Writer');
		pll_register_string('Ми підготували приклади CV для різних рівнів досвіду: Стартовий, Рядовий та Офіцери.Це допоможе швидко обрати оптимальний варіант.', 'Ми підготували приклади CV для різних рівнів досвіду: Стартовий, Рядовий та Офіцери.Це допоможе швидко обрати оптимальний варіант.', 'CV Writer');
		pll_register_string('Для новачків або кадетів, які тільки починають кар\'єру в морі. Містить основну інформацію, освіту, сертифікати та 1–2 останніх місця роботи.', 'Для новачків або кадетів, які тільки починають кар\'єру в морі. Містить основну інформацію, освіту, сертифікати та 1–2 останніх місця роботи.', 'CV Writer');
		pll_register_string('До', 'До', 'CV Writer');
		pll_register_string('После', 'После', 'CV Writer');
		pll_register_string('Для моряків із досвідом роботи в командному складі. Містить 5–7 останніх контрактів, попередній досвід у скороченому вигляді та сертифікати.', 'Для моряків із досвідом роботи в командному складі. Містить 5–7 останніх контрактів, попередній досвід у скороченому вигляді та сертифікати.', 'CV Writer');
		pll_register_string('Для старшого командного складу. Включає 5–7 останніх контрактів, повний перелік попереднього досвіду, детальний блок сертифікатів і досягнень.', 'Для старшого командного складу. Включає 5–7 останніх контрактів, повний перелік попереднього досвіду, детальний блок сертифікатів і досягнень.', 'CV Writer');

		// Steps секція
		pll_register_string('Як працює створення CV', 'Як працює створення CV', 'CV Writer');
		pll_register_string('Ми зробимо для вас професійне та структуроване резюме, яке швидко приверне увагу роботодавця.', 'Ми зробимо для вас професійне та структуроване резюме, яке швидко приверне увагу роботодавця.', 'CV Writer');
		pll_register_string('Крок', 'Крок', 'CV Writer');
		pll_register_string('Перейдіть на сторінку створення CV, ознайомтеся з пакетами та описом майбутнього резюме, і додайте послугу до кошика.', 'Перейдіть на сторінку створення CV, ознайомтеся з пакетами та описом майбутнього резюме, і додайте послугу до кошика.', 'CV Writer');
		
		
		        // === Front Page: додаткові рядки ===

        pll_register_string(
            'Перегляньте деталі або натисніть «Додати до кошика» та перейдіть до оформлення.',
            'Перегляньте деталі або натисніть «Додати до кошика» та перейдіть до оформлення.',
            'Front Page'
        );

        pll_register_string(
            'Отримуйте відповіді, проходьте співбесіди, підписуйте контракт — і вирушайте на новий етап своєї морської карʼєри.',
            'Отримуйте відповіді, проходьте співбесіди, підписуйте контракт — і вирушайте на новий етап своєї морської карʼєри.',
            'Front Page'
        );

        pll_register_string(
            'Нам довіряють понад 50 000 моряків з усього світу.',
            'Нам довіряють понад 50 000 моряків з усього світу.',
            'Front Page'
        );

        pll_register_string(
            'Вже понад 3 роки ми допомагаємо кандидатам знайти роботу, надсилаючи їхні дані до перевірених крюїнгів — без ризику потрапити у спам, завдяки надійним інструментам доставки.',
            'Вже понад 3 роки ми допомагаємо кандидатам знайти роботу, надсилаючи їхні дані до перевірених крюїнгів — без ризику потрапити у спам, завдяки надійним інструментам доставки.',
            'Front Page'
        );

        pll_register_string(
            'Ми також створюємо візуально привабливі та грамотно структуровані CV, які вигідно вирізняються серед інших.',
            'Ми також створюємо візуально привабливі та грамотно структуровані CV, які вигідно вирізняються серед інших.',
            'Front Page'
        );

        pll_register_string(
            'Знаємо, як подати інформацію так, щоб вас помітили.',
            'Знаємо, як подати інформацію так, щоб вас помітили.',
            'Front Page'
        );

        pll_register_string(
            'Ми працюємо на результат',
            'Ми працюємо на результат',
            'Front Page'
        );

        pll_register_string(
            'Наша мета — не просто розіслати ваше резюме,а допомогти вам отримати справжню можливість — ту, на яку ви заслуговуєте.',
            'Наша мета — не просто розіслати ваше резюме,а допомогти вам отримати справжню можливість — ту, на яку ви заслуговуєте.',
            'Front Page'
        );

        pll_register_string(
            'Відповідь',
            'Відповідь',
            'Front Page'
        );

        pll_register_string(
            'Співбесіда',
            'Співбесіда',
            'Front Page'
        );

        pll_register_string(
            'Контракт',
            'Контракт',
            'Front Page'
        );

        pll_register_string(
            'Моряків довірили нам свої CV',
            'Моряків довірили нам свої CV',
            'Front Page'
        );

        pll_register_string(
            'Клієнтів отримують відповідь до 14 днів',
            'Клієнтів отримують відповідь до 14 днів',
            'Front Page'
        );

        pll_register_string(
            'Цільових розсилок щомісяця',
            'Цільових розсилок щомісяця',
            'Front Page'
        );

        pll_register_string(
            'Роки успішної роботи',
            'Роки успішної роботи',
            'Front Page'
        );

        pll_register_string(
            'Моряки у рубці дивляться в моніторинг керуя судном',
            'Моряки у рубці дивляться в моніторинг керуя судном',
            'Front Page'
        );

        pll_register_string(
            'Що нас відрізняє від інших',
            'Що нас відрізняє від інших',
            'Front Page'
        );

        pll_register_string(
            'Ми не просто надаємо послугу — ми допомагаємо морякам отримати результат. Досвід, якість, підтримка та сервіс, якому довіряють тисячі.',
            'Ми не просто надаємо послугу — ми допомагаємо морякам отримати результат. Досвід, якість, підтримка та сервіс, якому довіряють тисячі.',
            'Front Page'
        );

        pll_register_string(
            'Гарантована доставка',
            'Гарантована доставка',
            'Front Page'
        );

        pll_register_string(
            'Ваше CV не потрапляє в спам — ми використовуємо антиспам-фільтри та перевірені методи розсилки.',
            'Ваше CV не потрапляє в спам — ми використовуємо антиспам-фільтри та перевірені методи розсилки.',
            'Front Page'
        );

        pll_register_string(
            'CV, яке помічають',
            'CV, яке помічають',
            'Front Page'
        );

        pll_register_string(
            'Ми створюємо резюме, що виділяється серед сотень — структуроване, візуально сильне, з акцентом на досвід.',
            'Ми створюємо резюме, що виділяється серед сотень — структуроване, візуально сильне, з акцентом на досвід.',
            'Front Page'
        );

        pll_register_string(
            'Все в одному місці',
            'Все в одному місці',
            'Front Page'
        );

        pll_register_string(
            'Створення CV, розсилка за флотом і регіоном — усе на одному сервісі, без зайвих кроків.',
            'Створення CV, розсилка за флотом і регіоном — усе на одному сервісі, без зайвих кроків.',
            'Front Page'
        );

        pll_register_string(
            'Ми додаємо до вашого CV супровідний лист англійською, адаптований саме під вас.',
            'Ми додаємо до вашого CV супровідний лист англійською, адаптований саме під вас.',
            'Front Page'
        );

        pll_register_string(
            'Моряк дивиться в бінокль у відкритому морі',
            'Моряк дивиться в бінокль у відкритому морі',
            'Front Page'
        );

        pll_register_string(
            'Супровід і підтримка',
            'Супровід і підтримка',
            'Front Page'
        );

        pll_register_string(
            'Ми на зв\'язку: консультуємо, враховуємо побажання, допомагаємо до результату — співбесіди чи контракту.',
            'Ми на зв\'язку: консультуємо, враховуємо побажання, допомагаємо до результату — співбесіди чи контракту.',
            'Front Page'
        );

        pll_register_string(
            'Нам довіряють компанії в усьому світі',
            'Нам довіряють компанії в усьому світі',
            'Front Page'
        );

        pll_register_string(
            'Відгуки наших клієнтів',
            'Відгуки наших клієнтів',
            'Front Page'
        );

        pll_register_string(
            'Допомагаємо морякам отримувати не просто відповіді — а реальні запрошення на співбесіди та контракти.',
            'Допомагаємо морякам отримувати не просто відповіді — а реальні запрошення на співбесіди та контракти.',
            'Front Page'
        );

        pll_register_string(
            'Читайте, що пишуть моряки після користування нашими послугами.',
            'Читайте, що пишуть моряки після користування нашими послугами.',
            'Front Page'
        );
		
        // Footer strings
        pll_register_string(
            'Зв’яжіться з нами у зручному месенджері:',
            'Зв’яжіться з нами у зручному месенджері:',
            'Footer'
        );

        pll_register_string(
            'Написати в Telegram',
            'Написати в Telegram',
            'Footer'
        );

        pll_register_string(
            'Telegram',
            'Telegram',
            'Footer'
        );

        pll_register_string(
            'Написати в Viber',
            'Написати в Viber',
            'Footer'
        );

        pll_register_string(
            'Viber',
            'Viber',
            'Footer'
        );

        pll_register_string(
            'Написати в WhatsApp',
            'Написати в WhatsApp',
            'Footer'
        );

        pll_register_string(
            'WhatsApp',
            'WhatsApp',
            'Footer'
        );

        pll_register_string(
            'Подзвоніть:',
            'Подзвоніть:',
            'Footer'
        );

        pll_register_string(
            'Напишіть:',
            'Напишіть:',
            'Footer'
        );

        pll_register_string(
            'Ми на зв’язку з понеділка по п’ятницю:',
            'Ми на зв’язку з понеділка по п’ятницю:',
            'Footer'
        );

        pll_register_string(
            'Підтримка — з 10:00 до 18:00',
            'Підтримка — з 10:00 до 18:00',
            'Footer'
        );

        pll_register_string(
            'Розсилка — з 9:00 до 15:00',
            'Розсилка — з 9:00 до 15:00',
            'Footer'
        );

        pll_register_string(
            'Бот приймає замовлення цілодобово',
            'Бот приймає замовлення цілодобово',
            'Footer'
        );

        pll_register_string(
            'Перейти в Instagram',
            'Перейти в Instagram',
            'Footer'
        );

        pll_register_string(
            'Перейти в Facebook',
            'Перейти в Facebook',
            'Footer'
        );

        pll_register_string(
            'SeafarerCV © 2020 - 2025. Усі права захищені',
            'SeafarerCV © 2020 - 2025. Усі права захищені',
            'Footer'
        );

        pll_register_string(
            'Умови використання',
            'Умови використання',
            'Footer'
        );

        pll_register_string(
            'Повідомлення про обробку персональних даних',
            'Повідомлення про обробку персональних даних',
            'Footer'
        );

        pll_register_string(
            'Політика повернення коштів',
            'Політика повернення коштів',
            'Footer'
        );

		// Header dropdown - Sending
        pll_register_string(
            'За типом флоту вакансії:',
            'За типом флоту вакансії:',
            'Sending'
        );

        pll_register_string(
            'За розташуванням представництва:',
            'За розташуванням представництва:',
            'Sending'
        );

        pll_register_string(
            'Як працює розсилка',
            'Як працює розсилка',
            'Sending'
        );
		
		
		pll_register_string(
		'Позитивних відгуків у Telegram, WhatsApp та Viber',
		'Позитивних відгуків у Telegram, WhatsApp та Viber',
		'Front Page'
		);
		
		pll_register_string(
			'Для кандидатів без досвіду роботи ми даруємо в подарунок безкоштовну розсилку по крюїнгах України та Грузії.',
			'Для кандидатів без досвіду роботи ми даруємо в подарунок безкоштовну розсилку по крюїнгах України та Грузії.',
			'CV Writer'
		);
		
		pll_register_string(
			'Про Seafarer',
			'Про Seafarer',
			'Header'
		);
		
		// Sending Page - нові рядки
		pll_register_string('Спеціалізована розсилка для танкерів усіх типів', 'Спеціалізована розсилка для танкерів усіх типів', 'Sending Page');
		pll_register_string('Нафтотанкери', 'Нафтотанкери', 'Sending Page');
		pll_register_string('Хімовози', 'Хімовози', 'Sending Page');
		pll_register_string('Газовози', 'Газовози', 'Sending Page');
		pll_register_string('Платформи та бурові судна', 'Платформи та бурові судна', 'Sending Page');
		pll_register_string('Допоміжні судна', 'Допоміжні судна', 'Sending Page');
		pll_register_string('Пароми та катамарани', 'Пароми та катамарани', 'Sending Page');
		pll_register_string('Яхти та човни', 'Яхти та човни', 'Sending Page');
		pll_register_string('Максимальне охоплення', 'Максимальне охоплення, професійна перевірка і доставка вашого резюме прямо в INBOX, а не в SPAM.', 'Sending Page');
		pll_register_string('Виберіть розсилку', 'Виберіть розсилку за типом флоту, регіонами або замовте обидві разом для максимального охоплення.', 'Sending Page');
		pll_register_string('Заповніть форму та додайте резюме', 'Заповніть форму та додайте резюме', 'Sending Page');
		pll_register_string('Вкажіть свої дані', 'Вкажіть свої дані та резюме, або замовте професійне CV у нас — і збільшіть свої шанси отримати контракт у найкращих компаніях.', 'Sending Page');
		pll_register_string('Запуск розсилки', 'Запуск розсилки', 'Sending Page');
		pll_register_string('Наш менеджер перевірить', 'Наш менеджер перевірить анкету, підготує супровідний лист і відправить ваше CV перевіреним роботодавцям.', 'Sending Page');
		pll_register_string('Отримуйте пропозиції', 'Отримуйте пропозиції', 'Sending Page');
		pll_register_string('Вам почнуть надходити', 'Вам почнуть надходити запрошення на співбесіди та пропозиції контрактів від компаній-роботодавців.', 'Sending Page');
		pll_register_string('Так можна замовити розсилку', 'Так, така можливість є. Ви можете надати власне готове резюме, а ми допоможемо з його розсилкою по відповідних компаніях чи типах флоту. За потреби, наш консультант згенерує супровідний лист під Ваше резюме та з урахуванням вашого досвіду — це покращить впізнаванність Вашого резюме та допоможе не загубитись в поштовій скринці крюїнг менеджера.', 'Sending Page');
		
		pll_register_string('Сюди надійде підтвердження та звіт', 'Сюди надійде підтвердження та звіт', 'Order Page');

	}
}





/**
 * ВАЖЛИВО: не даємо Polylang створювати окремі записи/таксономії під мови.
 * Тобто сторінки й записи залишаються одні, змінюються лише рядки через pll_e()/pll__().
 */


// !!! Будь-який старий код типу force_language_from_query ПОВНІСТЮ ВИДАЛИТИ
// НІЯКИХ add_action('setup_theme', 'force_language_from_query', ...) / add_action('init', ...)
// і самої функції force_language_from_query більше не має бути у файлі.