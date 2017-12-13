<?php 
/**
 * Component Name: List
 *
 */
global $data;

if (have_rows('list_builder')) :
  while ( have_rows('list_builder') ) : the_row();
    if (get_row_layout() == 'image_list') :
      get_template_part('partials/template/component-builder/views/lists/image-list');
    elseif (get_row_layout() == 'image_text_list') :
      get_template_part('partials/template/component-builder/views/lists/image-text-list');
    elseif (get_row_layout() == 'text_list') :
      get_template_part('partials/template/component-builder/views/lists/text-list');
    elseif (get_row_layout() == 'statistic_list') :
      get_template_part('partials/template/component-builder/views/lists/statistic-list');
    endif;     
  endwhile;
endif;


