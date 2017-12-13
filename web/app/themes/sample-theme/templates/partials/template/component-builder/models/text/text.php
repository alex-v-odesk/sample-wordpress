<?php
/**
 * Model Name: Text Builder
 *
 */

global $content;

$num_of_rows = count(get_sub_field('text_builder'));
$spacing = null;

if (have_rows('text_builder')):

  while (have_rows('text_builder')) : the_row();

    if (get_row_index() == 1 && $num_of_rows == 1) :
      $spacing = 'h-padding--none';
    endif;

    if (get_row_layout() == 'text_editor') :
    ?>
    <div class="c-text-editor">
      <?php the_sub_field('editor'); ?>
    </div>
    <?php
    elseif (get_row_layout() == 'heading') :
    ?>
    <h1 class="c-panel__heading <?= $spacing ?>
              <?= \Builder\get_text_colour(get_sub_field('colour_selector')); ?>
              <?= \Builder\get_text_size(get_sub_field('font_size')); ?>
              <?= \Builder\get_align(get_sub_field('align')); ?>">
      <?php the_sub_field('text'); ?>
    </h1>
    <?php
    elseif (get_row_layout() == 'script') :
    ?>
    <div class="c-panel__script">
      <?php the_sub_field('script'); ?>
    </div>
    <?php
    elseif (get_row_layout() == 'subheading') :
    ?>
    <p class="c-panel__subheading
              <?=\Builder\get_text_colour(get_sub_field('colour_selector')); ?>
              <?=\Builder\get_text_size(get_sub_field('font_size')); ?>
              <?=\Builder\get_align(get_sub_field('align')); ?>">
      <?php the_sub_field('text'); ?>
    </p>
    <?php
    elseif (get_row_layout() == 'paragraph') :
    ?>
      <p class="c-panel__paragraph
                <?=\Builder\get_text_colour(get_sub_field('colour_selector')); ?>
                <?=\Builder\get_text_size(get_sub_field('font_size')); ?>
                <?=\Builder\get_align(get_sub_field('align')); ?>">
        <?php the_sub_field('text'); ?>
      </p>
    <?php
    elseif (get_row_layout() == 'link') :
    ?>
      <p class="c-panel__link
                <?=\Builder\get_text_colour(get_sub_field('colour_selector')); ?>
                <?=\Builder\get_text_size(get_sub_field('font_size')); ?>
                <?=\Builder\get_align(get_sub_field('align')); ?>">
        <a href="<?php the_sub_field('url'); ?>">
          <?php the_sub_field('text'); ?>
        </a>
      </p>
    <?php
    else :
      return;
    endif;

  endwhile;

endif;
