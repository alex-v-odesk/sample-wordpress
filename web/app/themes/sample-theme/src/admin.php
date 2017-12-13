<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

/**
 * Remove custom fields from page post type
 */
add_action('admin_menu', function () {
    remove_meta_box('postcustom', 'page', 'normal');
});

/**
 * New Relic APM JS
 */
add_action('admin_init', function () {
    wp_enqueue_script('sage/new-relic.js', asset_path('vendor/new-relic.js'), null, null, false);
});

// Hacky way yuck
// function new_relic_js(){
// 	echo "<script type='text/javascript' src='" . asset_path('vendor/new-relic.js') . "'></script>";
// }
// add_action( 'admin_print_scripts', __NAMESPACE__ . '\\new_relic_js' );
