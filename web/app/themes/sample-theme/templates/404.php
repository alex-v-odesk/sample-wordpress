<?php
/**
 * 404 Page
 *
 * To do: needs an error check that the template exists
 */

// Get custom error page (sort of hard coded to slug 'error')
$post = get_page_by_path('error', OBJECT, 'page');

// Setup global post data
setup_postdata($post);

// Exit unless we're published
if( $post->post_status =='private' ) exit;

// Retrieve Component Builder template
get_template_part('partials/template/component-builder');
