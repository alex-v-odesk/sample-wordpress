<?php
/**
 * Component Name:  List
 * Sub Component:   Statistic List
 *
 */
?>

  <div class="o-list-statistic l-container">
    <div class="c-panel">
      <ul>
<?php if (have_rows('statistic_list')) : while (have_rows('statistic_list')) : the_row(); ?>
        <li class="l-1-of-5 l-push-1-of-5">
          <div class="c-card c-card--statistic">
            <h2 class="c-card__title">
              <?php the_sub_field('title'); ?>
            </h2>
            <p class="c-card__number">
              <?php the_sub_field('value'); ?><span class="c-card__symbol"><?php the_sub_field('symbol'); ?></span>
            </p>
            <p class="c-card__text">
              <?php the_sub_field('label'); ?>
            </p>
          </div>
        </li>
<?php endwhile; endif; ?>
      </ul>
     </div>
  </div>
