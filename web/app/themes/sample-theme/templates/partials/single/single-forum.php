<?php
/**
 * Single post template for forum post type
 *
 */

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

// Prepare featured image
$image_id = get_post_thumbnail_id();
$image = wp_get_attachment_metadata($image_id);
$image_normal = wp_get_attachment_image_src($image_id, 'blog');
$image_retina = wp_get_attachment_image_src($image_id, 'blog@2x');

$loop = new \WP_Query(array(
  'post_type' => 'forum',
  'post_status'=>'publish',
  'posts_per_page' => 5
));

?>

<section class="o-panel l-container l-container--full-width t-bg--blue">
  <div class="o-text l-container">
    <div class="c-panel">
      <h1 class="c-panel__heading t-text--white t-font--large t-align--center">
        Forum
      </h1>
      <p class="c-panel__subheading t-text--white t-font--medium t-align--center">
        This content is now out of date.
      </p>
      <a class="c-button c-button--white c-button--outline t-align--centre" href="http://community.irg.st">
        Visit Our Community
      </a>
    </div>
  </div>
</section>

<div class="l-container">
  <article class="c-post">
    <aside class="c-post__social l-1-of-10">
      <ul class="c-list-social c-list-social--blog">
        <li>
          <a href="https://twitter.com/intent/tweet/?text=<?php the_title(); ?>+<?php the_permalink(); ?>" class=""><i class="icon-twitter">Twitter</i></a>
        </li>
        <li>
          <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" class=""><i class="icon-linkedin">LinkedIn</i></a>
        </li>
        <li>
          <a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>m&t=<?php the_title(); ?>" class=""><i class="icon-facebook">Facebook</i></a>
        </li>
        <li>
          <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class=""><i class="icon-google">Google</i></a>
        </li>
        <li>
          <a href="https://www.xing.com/spi/shares/new?url=<?php the_permalink(); ?>" class=""><i class="icon-xing">Xing</i></a>
        </li>
        <li>
          <a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>" class=""><i class="icon-email">Email</i></a>
        </li>
      </ul>
    </aside>

    <div class="l-7-of-10">
      <header class="c-post__header">
        <h1 class="c-post__title"><?php the_title(); ?></h1>
        <p class="c-post__label"><?php the_date('j F, Y'); ?></p>
        <?php get_template_part('partials/entry-meta'); ?>
      </header>

      <div class="c-post__content">
        <?php the_field('forum_question'); ?>
      </div>

      <div class="c-post__content">
        <?php the_field('forum_answer'); ?>
      </div>
    </div>

    <div class="c-post__related l-2-of-10 l-last">
      <p class="c-post__label">Also worth reading:</p>
      <ul class="c-post-list">
        <?php while ($loop->have_posts()) : $loop->the_post(); ?>
          <li>
            <a  class=""
                href="<?php echo parse_url(get_permalink($post->ID), PHP_URL_PATH); ?>">
              <?php the_title(); ?>
          </a>
        </li>
      <?php endwhile; ?>
      </ul>
    </div>

    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sample-theme'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
</div>
