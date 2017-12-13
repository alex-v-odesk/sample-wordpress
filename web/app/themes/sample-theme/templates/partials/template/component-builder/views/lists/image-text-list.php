<?php
/**
 * Component Name:  List
 * Sub Component:   Image + Text List
 *
 */
global $data;

$spacing = get_sub_field('spacing');
$border = \Builder\get_border(get_sub_field('show_border'));

?>

  <div class="o-list-text-image l-container">
    <div class="c-panel">
      <ul class="c-image-text-list">
        <?php if (have_rows('image_text_list')) : while (have_rows('image_text_list')) : the_row(); ?>
          <?php \Builder\get_text('link', 'link') ? $link = \Builder\get_text('link', 'link') : $link = \Builder\get_text('link', 'url'); ?>
        <li class="c-image-text-list__item
                  <?= \Builder\get_image_labels(get_sub_field('label_visibility')) ?>
                  <?= $border ?>">
          <div class="c-image-list__image">
            <img  class=""
                  src="<?=get_sub_field('image')['url'] ?>"
                  width="150"
                  height="150"
                  alt="" />
          </div>
          <div class="c-image-list__text">
            <h2 class="c-image-list__label
              <?= \Builder\get_text('subheading', 'align') ?>
              <?= \Builder\get_text('subheading', 'colour') ?>
              <?= \Builder\get_text('subheading', 'size') ?>">
              <?= \Builder\get_text('subheading', 'text') ?>
            </h2>
            <p class="c-image-list__text
              <?= \Builder\get_text('paragraph', 'align') ?>
              <?= \Builder\get_text('paragraph', 'colour') ?>">
              <?= \Builder\get_text('paragraph', 'text') ?>
            </p>
            <a  class="c-card__link <?=\Builder\get_text('link', 'colour') ?>"
                href="<?= $link ?>">
              <?=\Builder\get_text('link', 'text') ?>
            </a>
          </div>
        </li>
        <?php endwhile; endif; ?>
      </ul>
    </div>
  </div>
