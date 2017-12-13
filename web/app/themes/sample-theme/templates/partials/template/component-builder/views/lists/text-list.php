<?php 
/**
 * Component Name:  List
 * Sub Component:   Text List
 *
 */
global $data;

$spacing = get_sub_field('spacing');

?>

  <div class="o-list-text l-container">
    <div class="c-panel">
      <ul class="c-card-list">
        <?php if (have_rows('text_list')) : while ( have_rows('text_list') ) : the_row(); ?>
        <?php \Builder\get_text('link','link') ? $link = \Builder\get_text('link','link') : $link = \Builder\get_text('link','url'); ?>
        <li class="l-1-of-3">
          <div class="c-card <?=\Builder\get_text('subheading', 'align') ?>">
            <h2 class="c-card__title
              <?=\Builder\get_text('subheading', 'align') ?>
              <?=\Builder\get_text('subheading', 'colour') ?>
              <?=\Builder\get_text('subheading', 'size') ?>">
              <?=\Builder\get_text('subheading', 'text') ?>
            </h2>
            <p class="c-card__text <?=\Builder\get_text('paragraph', 'align') ?>">
              <?=\Builder\get_text('paragraph', 'text') ?>
            </p>
            <a  class="c-card__link <?=\Builder\get_text('link','colour') ?>"
                href="<?= $link ?>">
              <?=\Builder\get_text('link', 'text') ?>
            </a>
          </div>
        </li>
        <?php endwhile; endif; ?>
      </ul>
    </div>
  </div>