<?php
/**
 * Component Name:  List
 * Sub Component:   Image List
 *
 */

$spacing = \Builder\get_image_spacing(get_sub_field('spacing'));
$size = \Builder\get_image_size(get_sub_field('image_size'));
$border = \Builder\get_border(get_sub_field('show_border'));
$slideshow = get_sub_field('slideshow');

if ($slideshow === 'on') {
    $wrapper_classes[] = 'js-slideshow has-autoplay';
    $component_classes[] = 'c-slideshow';
    $list_classes[] = 'c-slideshow__slides is-not-loaded';
    $item_classes[] = 'is-slide';
} else {
    $wrapper_classes[] = null;
    $component_classes[] = null;
    $list_classes[] = null;
    $item_classes[] = null;
}

?>

  <div class="o-image-list l-container <?= \Builder\class_styles($wrapper_classes) ?>">
    <div class="c-panel <?= \Builder\class_styles($component_classes) ?>">
      <ul class="c-image-list <?= \Builder\class_styles($list_classes) ?>">
        <?php if (have_rows('image_list')) : while (have_rows('image_list')) : the_row(); ?>
        <?php get_sub_field('link') ? $link = get_sub_field('link') : $link = get_sub_field('url'); ?>
        <?php if ($link !== '') : ?>
        <a href="<?= $link ?>">
        <?php endif; ?>
        <li class=" c-image-list__item
                    <?= \Builder\class_styles($item_classes) ?>
                    <?= $spacing ?>
                    <?= \Builder\get_image_labels(get_sub_field('label_visibility')) ?>
                    <?= $border ?>">
          <img  class=""
                src="<?= get_sub_field('image')['url'] ?>"
                srcset=""
                width="<?= $size ?>"
                height="<?= $size ?>"
                title="<?= get_sub_field('image')['name'] ?>"
                alt="<?= get_sub_field('image')['name'] ?>" />
          <h2 class="c-image-list__label <?= \Builder\get_text_colour(get_sub_field('colour_selector')) ?>"><?= get_sub_field('label') ?></h2>
        </li>
        <?php if ($link !== '') : ?>
        </a>
        <?php endif; ?>
        <?php endwhile; endif; ?>
      </ul>
    </div>
  </div>
