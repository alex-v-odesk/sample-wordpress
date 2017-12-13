<?php
/**
 * Component Name: Hero
 *
 */

global $text;
$text = array(
  'headline' => get_sub_field('headline'),
  'tagline' => get_sub_field('tagline'),
  'button' => get_sub_field('button'),
);

if (have_rows('hero_builder')) :
  while (have_rows('hero_builder')) : the_row();
    if (get_row_layout() == 'hero_image') :
      get_template_part('partials/template/component-builder/views/heroes/hero-image');
    elseif (get_row_layout() == 'hero_video') :
      get_template_part('partials/template/component-builder/views/heroes/hero-video');
    endif;
  endwhile;
endif;
