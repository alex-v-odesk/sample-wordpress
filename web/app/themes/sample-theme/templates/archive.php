<?php
/**
 * The archive template file.
 *
 * @package sample-theme
 * @subpackage IR
 * @since The Big Bang 1.0
 */

// Default archive for Blog page
if (is_home()) {
    get_template_part('partials/archive/archive', 'post');
}
// Default category archive
elseif (is_category()) {
    get_template_part('partials/archive/archive', 'post');
}
// Offering & Custom custom post type archive (currently no requirement for Custom CPT archive)
elseif (is_post_type_archive('cat') || is_post_type_archive('cat')) {
    get_template_part('partials/archive/archive', 'post');
}
// Partner CPT archive
elseif (is_post_type_archive('partner') || is_tax('region') || is_tax('country')) {
    get_template_part('partials/archive/archive', 'partner');
}
// Custom taxonomy for Offering & Custom custom post types
elseif (is_tax('tax') || is_tax('tax')) {
    get_template_part('templates/content-types/archive/archive', 'collection');
}



//get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format());
  // Put this in the loop
  // <?php //get_template_part('partials/content', get_post_type() != 'post' ? get_post_type() : get_post_format());
