<?php
/**
 * Plugin Name: Disable Updates for Local Development
 * Description: Отключает проверки обновлений и предупреждения для локальной среды разработки
 * Version: 1.0
 * Author: CV Project
 */

// Отключаем все проверки обновлений
add_filter('pre_http_request', function($pre, $parsed_args, $url) {
    // Блокируем запросы к WordPress.org
    if (strpos($url, 'api.wordpress.org') !== false) {
        return new WP_Error('disabled', 'Updates disabled for local development');
    }
    return $pre;
}, 10, 3);

// Отключаем автоматические обновления
add_filter('automatic_updater_disabled', '__return_true');
add_filter('auto_update_core', '__return_false');
add_filter('auto_update_plugin', '__return_false');
add_filter('auto_update_theme', '__return_false');

// Отключаем cron задачи для обновлений
add_action('init', function() {
    remove_action('wp_version_check', 'wp_version_check');
    remove_action('wp_update_plugins', 'wp_update_plugins');
    remove_action('wp_update_themes', 'wp_update_themes');
    remove_action('wp_maybe_auto_update', 'wp_maybe_auto_update');
});

// Отключаем предупреждения в админке
if (is_admin()) {
    // Отключаем уведомления об обновлениях
    add_action('admin_menu', function() {
        remove_submenu_page('index.php', 'update-core.php');
    });
    
    // Скрываем уведомления об обновлениях
    add_action('admin_init', function() {
        remove_action('admin_notices', 'update_nag', 3);
    });
}

// Отключаем предупреждения о заголовках
if (is_admin()) {
    add_action('init', function() {
        if (ob_get_level()) {
            ob_clean();
        }
        ob_start();
    });
}
