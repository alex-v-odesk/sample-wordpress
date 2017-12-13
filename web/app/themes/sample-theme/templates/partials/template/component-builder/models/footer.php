<?php
/**
 * Component Name: Footer
 *
 */

global $options;

$options = array(
  'graphic_style' => get_sub_field('style'),
  'graphic_bg_colour' => get_sub_field('colour_selector'),
  'bg_image' => get_sub_field('background_image')['url'],
  'bg_position' => \Builder\get_bg_image_position(get_sub_field('position')),
  'has_form' => null,
);

if (have_rows('footer_builder')) :
  while (have_rows('footer_builder')) : the_row();
    if (get_row_layout() == 'form') :
      $options['has_form'] = 'has-form';
    endif;
  endwhile;
endif;

if (\Builder\get_footer_graphics($options['graphic_style'])) {
    get_template_part('partials/template/component-builder/views/footer/graphics');
}

get_template_part('partials/template/component-builder/views/footer/open');

if (have_rows('footer_builder')) :

  while (have_rows('footer_builder')) : the_row();
    if (get_row_layout() == 'text') :
      get_template_part('partials/template/component-builder/controllers/text');
    elseif (get_row_layout() == 'media') :
      get_template_part('partials/template/component-builder/controllers/media');
    elseif (get_row_layout() == 'button') :
      get_template_part('partials/template/component-builder/controllers/button');
    elseif (get_row_layout() == 'form') :
      get_template_part('partials/template/component-builder/controllers/form');
    endif;
  endwhile;

endif;

get_template_part('partials/template/component-builder/views/footer/close');
