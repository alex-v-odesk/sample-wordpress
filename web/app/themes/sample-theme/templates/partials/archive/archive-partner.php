<?php
/**
 * The archive template view file for default post types.
 *
 * @package sample-theme
 * @subpackage IR
 * @since The Big Bang 1.0
 */
?>

<section class="o-panel l-container l-container--full-width t-bg--blue">
  <div class="o-text l-container">
    <div class="c-panel">
      <h1 class="c-panel__heading t-text--white t-font--large t-align--center h-padding--none">
        Partner Directory
      </h1>
      <p class="c-panel__subheading t-text--white t-font--medium t-align--center">
        Our partners are here for you.
      </p>
    </div>
  </div>
</section>

<aside class="l-container l-container--full-width t-bg--grey-light">
  <div class="c-filter js-filter">
    <ul>
      <li class="c-filter__item">
        <label for="type" class="c-filter__label">Region / Type</label>
        <select name="type" class="c-select ui dropdown">
          <option value="">Select</option>
          <?php
          $term = 'region';
          $args = array(
              'type'                     => 'partner',
              'child_of'                 => 0,
              'parent'                   => '',
              'orderby'                  => 'name',
              'order'                    => 'ASC',
              'hide_empty'               => 1,
              'hierarchical'             => 1,
              'exclude'                  => '',
              'include'                  => '',
              'number'                   => '',
              'taxonomy'                 => $term,
              'pad_counts'               => false
          );

          $taxonomies = get_categories($args);
          foreach ($taxonomies as $tax) :
            $selected = null;
            if (get_query_var($term)) :
              if (get_query_var($term) === $tax->slug) :
                $selected =  'selected';
              endif;
            endif;
          ?>
          <option value="<?= get_term_link($tax->slug, $term) ?>" <?php echo $selected; ?>><?= $tax->name; ?></option>
          <?php endforeach; ?>
        </select>
      </li>
      <?php // Start temporarily hide filters?>
      <?php if (false) : ?>
      <li class="c-filter__item">
        <label for="type" class="c-filter__label">Country</label>
        <select name="country" class="c-select ui dropdown">
          <option value="">Select</option>
          <?php
          $term = 'country';
          $args = array(
              'type'                     => 'partner',
              'child_of'                 => 0,
              'parent'                   => '',
              'orderby'                  => 'name',
              'order'                    => 'ASC',
              'hide_empty'               => 1,
              'hierarchical'             => 1,
              'exclude'                  => '',
              'include'                  => '',
              'number'                   => '',
              'taxonomy'                 => $term,
              'pad_counts'               => false
          );

          $taxonomies = get_categories($args);
          foreach ($taxonomies as $tax) :
            $selected = null;
            if (get_query_var($term)) :
              if (get_query_var($term) === $tax->slug) :
                $selected =  'selected';
              endif;
            endif;
          ?>
        <option value="<?= get_term_link($tax->slug, $term) ?>" <?php echo $selected; ?>><?= $tax->name; ?></option>
          <?php endforeach; ?>
        </select>
      </li>
    <?php endif; // End temp hide filters?>
    </ul>
  </div>
</aside>

<div class="c-archive l-container">
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sample-theme'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

  <ul class="c-grid">
    <?php
    if (is_tax()) {
        $term = get_queried_object();
        $tax_query = array(
          array(
           'taxonomy' => $term->taxonomy,
           'field' => 'slug',
           'terms'     => $term->slug,
           'operator' => 'IN'
          )
        );
    } else {
        $tax_query = null;
    }
    $loop = new \WP_Query(array(
      'posts_per_page' => -1,
      'post_type' => 'partner',
      'post_status'=>'publish',
      'tax_query'=> $tax_query,
      'orderby'=>'title',
      'order'=> 'ASC',
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
    <li class="c-grid__item c-grid__item--partner">
      <!-- <a href="<?php echo parse_url(get_permalink($post->ID), PHP_URL_PATH); ?>"> -->
        <article class="c-article c-article--partner">
          <img  src="<?php echo $image[0]; ?>"
                data-src="<?php echo $image[0]; ?>"
                data-src-retina="<?php echo $image_retina[0]; ?>"
                class="c-article__image js-unveil"
                alt="<?php the_title(); ?>"
                title="<?php the_title(); ?>"
                width="600"
                height="400"/>
          <div class="c-article__content c-article__content--partner" >
            <h1 class="c-article__title c-article__title--partner">
              <a  href="<?= get_field('url') ?>"
                  class=""
                  title="<?= $title ?>">
                <?= $title ?>
              </a>
            </h1>
          </div>
        </article>
      <!-- </a> -->
    </li>
  <?php endwhile; ?>
  </ul>
</div>
