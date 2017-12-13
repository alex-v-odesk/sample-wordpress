<?php
/**
 * Model Name: Button Builder
 *
 */

// Select internal link vs external URL, and prioritise internal if both have values
get_sub_field('link') ? $link = get_sub_field('link') : $link = get_sub_field('url');

// Check for custom positioning
$get_margin = get_sub_field('element_margin');
$get_margin != '' ? $styles[] = 'margin:'. $get_margin . ';' : $styles[] = null;
$get_padding = get_sub_field('element_padding');
$get_padding != '' ? $styles[] =  'padding:'. $get_padding . ';' : $styles[] = null;

?>

<div class="<?= \Builder\get_align(get_sub_field('align')) ?>" <?= \Builder\inline_styles($styles) ?>>
 <a  class="c-button
     <?= \Builder\get_button_colour(get_sub_field('colour_selector')) ?>
     <?= \Builder\get_button_style(get_sub_field('style')) ?>
     <?= \Builder\get_button_action(get_sub_field('modal')) ?>"
     href="<?= $link ?>">
   <?=get_sub_field('text') ?>
 </a>
</div>
