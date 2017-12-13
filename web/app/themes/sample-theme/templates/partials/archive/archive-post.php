<?php
/**
 * The archive template view file for default post types.
 *
 * @package sample-theme
 * @subpackage IR
 * @since The Big Bang 1.0
 */

$pagination = array(
  'base'               => '%_%',
  'format'             => '?paged=%#%',
  'total'              => 1,
  'cat'                => $category,
  'current'            => 0,
  'show_all'           => false,
  'end_size'           => 1,
  'mid_size'           => 2,
  'prev_next'          => true,
  'prev_text'          => __('< Older Posts'),
  'next_text'          => __('Newer Posts >'),
  'type'               => 'plain',
  'add_args'           => false,
  'add_fragment'       => '',
  'before_page_number' => '',
  'after_page_number'  => ''
);
?>


<section class="o-panel l-container l-container--full-width t-bg--blue">
  <div class="o-text l-container">
    <div class="c-panel">
      <h1 class="c-panel__heading t-text--white t-font--large t-align--center h-padding--none">
        <?php
          // HACK
          if (get_query_var('cat')) {
              echo _x('Newsroom', 'Blog', 'sample-theme');
          } else {
              echo _x('Think Tank', 'Blog', 'sample-theme');
          }
        ?>
      </h1>
      <p class="c-panel__subheading t-text--white t-font--medium t-align--center">
        <?php
          // HACK
          if (get_query_var('cat')) {
              echo _x('The latest sample-theme news and media coverage from around the world.', 'Blog', 'sample-theme');
          } else {
              echo _x('sample-theme Blog', 'Blog', 'sample-theme');
          }
        ?>
      </p>
    </div>
</section>

<div class="c-archive l-container">
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sample-theme'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

  <ul class="c-grid">
    <?php
    // Check if this is an archive of all categories or a single category archive
    // If it's the main blog page then remove posts in category 'news'
    // TODO: get term ID by slug or set option in admin for categories to exclude
    if (!get_query_var('cat')) {
        $category = -19;
    } else {
        $category = 19;
    }

    $loop = new \WP_Query(array(
      'post_type' => 'post',
      'post_status'=>'publish',
      'cat' => $category,
      'paged' => $paged,
      'tax_query'=> array(
        array(
         'taxonomy' => 'internal_analytic',
         'field' => 'slug',
         'terms'     => 'migrated-content',
         'operator' => 'NOT IN'
        )
      ),
    ));
    ?>
    <?php
    while ($loop->have_posts()) : $loop->the_post();
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
      $image_retina = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');

      // Default / fallback
      if (!$image) {
          $image[0] = App\asset_path('images/placeholder-news-japan.png');
          $image_retina[0] = $image[0];
      }

      // Custom titles
      if (get_field('custom_title')) {
          $title = get_field('custom_title');
      } else {
          $title = get_the_title();
      }
    ?>
    <li class="c-grid__item c-grid__item--blog">
      <a href="<?php echo parse_url(get_permalink($post->ID), PHP_URL_PATH); ?>">
        <article class="c-article">
          <img  src="<?php echo $image[0]; ?>"
                data-src="<?php echo $image[0]; ?>"
                data-src-retina="<?php echo $image_retina[0]; ?>"
                class="js-unveil"
                alt="<?php the_title(); ?>"
                title="<?php the_title(); ?>"
                width="600"
                height="400"/>
          <div class="c-article__content" >
            <time class="c-article__date" datetime=""><?php the_date('d F, Y'); ?></time>
            <p class="c-article__author">By <?php the_author(); ?></p>
            <h1 class="c-article__title"><?= $title ?></h1>
          </div>
        </article>
      </a>
    </li>
  <?php endwhile; ?>
  </ul>
</div>

<div class="l-container">
  <?php the_posts_navigation($pagination); ?>
</div>
