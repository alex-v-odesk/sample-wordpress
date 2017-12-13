<?php

namespace App;

use Roots\Sage\Template;
use Roots\Sage\Template\Wrapper;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    // Reset
    $classes = null;

    // Add lang / locale
    $classes[] = 'h-lang--' . strtolower(env('IR_LANG'));

    // Add post type
    $classes[] = 'h-' . get_post_type();

    // Add page slug if it doesn't exist
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = 'h-' . basename(get_permalink());
        }
    }

    // Add home class
    if (is_front_page()) {
        $classes[] = 'h-home';
    }

    // Add class if sidebar is active
    if (display_sidebar()) {
        $classes[] = 'h-sidebar-primary';
    }

    // Needed for Semantic UI?
    // $classes[] = 'h-modal-page';

    return $classes;
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sample-theme') . '</a>';
});

/**
 * Use theme wrapper
 */
add_filter('template_include', function ($main) {
    if (!is_string($main) && !(is_object($main) && method_exists($main, '__toString'))) {
        return $main;
    }
    return ((new Template(new Wrapper($main)))->layout());
}, 109);

/**
 * Remove SEO plugin credits
 */
add_filter('the_seo_framework_indicator', '__return_false');
// add_filter( 'the_seo_framework_use_object_cache', '__return_false' );
