<?php 
/**
 * The page template file.
 *
 * @package sample-theme
 * @subpackage IR
 * @since The Big Bang 1.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) die('Kind regards, sample-theme');

// Don't show private posts
if($post->post_status ==='private' && !is_user_logged_in()) exit;

while (have_posts()) : the_post();
  if (is_front_page()) {
    get_template_part ('partials/page/front-page');
  } else if ( file_exists( get_template_part ('partials/page/' . $post->post_name ) ) ) {
    get_template_part('components/page-header');
    get_template_part ('partials/page/' . $post->post_name );
  } else {
    get_template_part('components/page-header');
    get_template_part ('partials/page/default' );
  }
endwhile;
