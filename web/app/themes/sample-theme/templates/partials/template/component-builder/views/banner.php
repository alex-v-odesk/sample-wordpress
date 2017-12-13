<?php
/**
 * Component View Name: Banner
 *
 */

global $panel_classes_left, $panel_classes_right, $panel_classes_middle;

// Get width => wide or half
$width = get_sub_field('panel_width');
$wide_panel = get_sub_field('wide_panel');

// Make this a function in builder.php
// Addition of more options means this needs to be cleaned up
if ($width == 'half'
    && \Builder\has_banner_content('banner_left_panel')
    && !\Builder\has_banner_content('banner_right_panel')) :
      $panel_classes_left = 'l-2-of-5';
      $panel_classes_right = null;
elseif ($width == 'half'
    && !\Builder\has_banner_content('banner_left_panel')
    && \Builder\has_banner_content('banner_right_panel')) :
      $panel_classes_left = null;
      $panel_classes_right = 'l-2-of-5 l-push-3-of-5';
elseif ($width == 'half'
    && \Builder\has_banner_content('banner_left_panel')
    && \Builder\has_banner_content('banner_right_panel')) :
      $panel_classes_left = 'l-5-of-10';
      $panel_classes_right = 'l-5-of-10';
elseif ($width == 'full'
    && \Builder\has_banner_content('banner_full_panel')) :
      $panel_classes_left = 'l-10-of-10';
elseif ($width == 'wide'
    && $wide_panel == 'left'
    && \Builder\has_banner_content('banner_left_panel')
    && !\Builder\has_banner_content('banner_right_panel')) :
      $panel_classes_left = 'l-3-of-5';
      $panel_classes_right = null;
elseif ($width == 'wide'
    && $wide_panel == 'left'
    && \Builder\has_banner_content('banner_left_panel')
    && \Builder\has_banner_content('banner_right_panel')) :
      $panel_classes_left = 'l-6-of-10';
      $panel_classes_right = 'l-4-of-10';
elseif ($width == 'wide'
    && $wide_panel == 'right'
    && !\Builder\has_banner_content('banner_left_panel')
    && \Builder\has_banner_content('banner_right_panel')) :
      $panel_classes_left = null;
      $panel_classes_right = 'l-3-of-5 l-push-2-of-5';
elseif ($width == 'wide'
    && $wide_panel == 'right'
    && \Builder\has_banner_content('banner_left_panel')
    && \Builder\has_banner_content('banner_right_panel')) :
      $panel_classes_left = 'l-4-of-10';
      $panel_classes_right = 'l-6-of-10';
elseif ($width == 'three-columns'
    && \Builder\has_banner_content('banner_left_panel')
    && \Builder\has_banner_content('banner_middle_panel')
    && \Builder\has_banner_content('banner_right_panel')) :
      $panel_classes_left = 'l-3-of-10';
      $panel_classes_middle = 'l-4-of-10';
      $panel_classes_right = 'l-3-of-10';
endif;

// Array to hold values of inline styles
$styles = array();

// Get background image
$get_bg_image = get_sub_field('background_image')['url'];
($get_bg_image !== '' && $get_bg_image !== null) ? $styles[] = 'background-image: url(\'' . $get_bg_image . '\');' : $styles[] = null;

// Set background image position by class name
$bg_position = \Builder\get_bg_image_position(get_sub_field('position'));

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
  <div  class="o-banner c-billboard <?= $bg_position . $custom_position ?>"<?= \Builder\inline_styles($styles); ?>>
    <div class="l-container c-banner-wrapper c-banner--3-cols">
      <?php if (\Builder\has_banner_content('banner_middle_panel')) : ?>
        <div class="c-card-temp l-1-of-3 l-no-gutter t-bg--blue">
          <div class="c-banner <?= $custom_position ?>">
            <div class="c-banner__content">
              <?= \Builder\get_banner_content('banner_left_panel') ?>
            </div>
          </div>
        </div>
        <div class="c-card-temp c-card-temp--overlay l-1-of-3 l-no-gutter t-bg--blue-dark">
          <div class="c-banner <?= $custom_position ?>">
            <div class="c-banner__content">
              <?= \Builder\get_banner_content('banner_middle_panel') ?>
            </div>
          </div>
        </div>
        <div class="c-card-temp l-1-of-3 l-no-gutter t-bg--blue">
          <div class="c-banner <?= $custom_position ?>">
            <div class="c-banner__content">
              <?= \Builder\get_banner_content('banner_right_panel') ?>
            </div>
          </div>
        </div>
      <?php elseif (\Builder\has_banner_content('banner_full_panel')) : ?>
        <!-- <div class="l-container l-container--full-width"> -->
          <div class="c-banner <?= $custom_position ?>">
            <div class="c-banner__content">
              <?= \Builder\get_banner_content('banner_full_panel') ?>
            </div>
          </div>
        <!-- </div> -->
      <?php else : ?>
        <?php if (\Builder\has_banner_content('banner_left_panel')) : ?>
        <div class="<?= $panel_classes_left ?>">
          <div class="c-banner <?= $custom_position ?>">
            <div class="c-banner__content">
              <?= \Builder\get_banner_content('banner_left_panel') ?>
            </div>
          </div>
        </div>
        <?php endif ?>
        <?php if (\Builder\has_banner_content('banner_right_panel')) : ?>
        <div class="<?= $panel_classes_right ?>">
          <div class="c-banner <?= $custom_position ?>">
            <div class="c-banner__content">
              <?= \Builder\get_banner_content('banner_right_panel') ?>
            </div>
          </div>
        </div>
        <?php endif ?>
      <?php endif; ?>
    </div>
  </div>
