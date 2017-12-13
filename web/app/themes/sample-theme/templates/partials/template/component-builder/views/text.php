<?php
/**
 * Component Name: Text
 *
 */

 // Set Banner outer container postitioning (padding)
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

<div class="o-text l-container <?= $custom_position ?>">
  <div class="c-panel" <?= \Builder\inline_styles($styles); ?>>
    <?php get_template_part('partials/template/component-builder/models/text/text'); ?>
  </div>
</div>
