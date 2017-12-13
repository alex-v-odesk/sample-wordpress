<?php
/**
 * View Name: Button Builder
 *
 */

 // Select internal link vs external URL, and prioritise internal if both have values
 get_sub_field('link') ? $link = get_sub_field('link') : $link = get_sub_field('url');

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

    <div class="o-button l-container <?= $custom_position ?>">
      <div class="c-panel">
        <div class="<?= \Builder\get_align(get_sub_field('align')) ?> " <?= \Builder\inline_styles($styles) ?>>
          <a  class="c-button
              <?= \Builder\get_button_colour(get_sub_field('colour_selector')) ?>
              <?= \Builder\get_button_style(get_sub_field('style')) ?>
              <?= \Builder\get_button_action(get_sub_field('modal')) ?>"
              href="<?= $link ?>">
            <?=get_sub_field('text') ?>
          </a>
        </div>
      </div>
    </div>
