<?php 
/**
 * Template Name: Component Builder
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
  get_template_part('partials/template/component-builder');
endwhile; 

?>