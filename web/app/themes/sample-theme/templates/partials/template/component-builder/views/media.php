<?php
/**
 * Component Name: Media - Image or Video
 *
 */

 // Check for custom positioning
 $has_custom_position = get_sub_field('element_position');
 if ($has_custom_position == 'custom') :
   $custom_position = ' t-custom-positioning';
   $get_padding = get_sub_field('element_padding');
   ($get_padding !== '' && $get_padding !== null) ? $styles[] = 'padding:'. $get_padding . ';' : $styles[] = null;
   $get_margin = get_sub_field('element_margin');
   ($get_margin !== '' && $get_margin !== null) ? $styles[] = 'margin:'. $get_margin . ';' : $styles[] = null;
 else :
   $custom_position = null;
   $styles[] = null;
 endif;
?>

<div class="o-media l-container">
  <div class="c-panel c-panel--media <?= $custom_position ?>" <?= \Builder\inline_styles($styles) ?>>
    <?php get_template_part('partials/template/component-builder/models/media/media'); ?>
  </div>
</div>
