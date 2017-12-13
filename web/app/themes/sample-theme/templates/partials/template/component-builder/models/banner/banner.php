<?php 
/**
 * Model Name: Banner
 *
 */

global $content, $panel_classes_left, $panel_classes_right;

if (have_rows($content)) : 
  while ( have_rows($content) ) : the_row();
    if (get_row_layout() == 'text') :
      get_template_part('partials/template/component-builder/models/text/text');
    elseif (get_row_layout() == 'media') :
      get_template_part('partials/template/component-builder/models/media/media');
    elseif (get_row_layout() == 'button') :
      get_template_part('partials/template/component-builder/models/buttons/button');
    endif;
  endwhile;
endif;
