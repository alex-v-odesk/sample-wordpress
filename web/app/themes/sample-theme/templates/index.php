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
  get_template_part ('partials/archive/archive','post');
} 
// Default category archive
else if (is_category()) {
  get_template_part ('');
}
// Offering & Custom custom post type archive (currently no requirement for Custom CPT archive)
else if (is_post_type_archive('cat') || is_post_type_archive('cat') ) {
  get_template_part ('' , 'cat' );
}
// Custom taxonomy for Offering & Custom custom post types
else if (is_tax('tax') || is_tax('tax')) {
  get_template_part ( 'templates/content-types/archive/archive' , 'collection');
}

