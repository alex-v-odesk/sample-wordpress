<?php
/**
 * Single post template
 *
 */

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

// Determine which template is being used
if (get_field('template') == 'page-builder') :
  get_template_part('partials/template/component-builder');
else :

// Get post content, look for old posts that use default editor
if (get_the_content() !== '') :
  $post_content = get_the_content();
else :
  $post_content = get_field('content_editor');
endif;

// Prepare featured image
$image_id = get_post_thumbnail_id();
$image = wp_get_attachment_metadata($image_id);
$image_normal = wp_get_attachment_image_src($image_id, 'blog');
$image_retina = wp_get_attachment_image_src($image_id, 'blog@2x');

$loop = new \WP_Query(array(
  'post_type' => 'post',
  'post_status'=>'publish',
  'posts_per_page' => 5
));

// Custom titles
if (get_field('custom_title')) {
    $title = get_field('custom_title');
} else {
    $title = get_the_title();
}

?>
<div class="l-container l-container--full-width t-bg--blue h-mobile-hidden">
  <div class="l-container">
    <ul class="c-breadcrumbs" role="navigation" aria-label="breadcrumbs">
      <li class="c-breadcrumbs__item">
        <a class="c-breadcrumbs__link" href="<?php esc_url(home_url('/')); ?>/blog">Blog</a>
      </li>
      <li class="c-breadcrumbs__item">
        <a class="c-breadcrumbs__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </li>
    </ul>
  </div>
</div>
<div class="l-container">
  <article class="c-post c-post--border">
    <aside class="c-post__social l-1-of-10 h-mobile-hidden">
      <ul class="c-list-social c-list-social--blog">
        <li>
          <a href="https://twitter.com/intent/tweet/?text=<?php the_title(); ?>+<?php the_permalink(); ?>" class=""><i class="icon-twitter">Twitter</i></a>
        </li>
        <li>
          <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" class=""><i class="icon-linkedin">LinkedIn</i></a>
        </li>
        <li>
          <a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(the_permalink()); ?>&t=<?php echo urlencode(the_title()); ?>" class=""><i class="icon-facebook">Facebook</i></a>
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
        <?php if (has_post_thumbnail() && get_field('featured_image') == 'yes') : ?>
        <img  class="c-post__featured-image"
              src="<?= $image_retina[0]; ?>"
              width="<?= $image['width'] ?>"
              height="<?= $image['height'] ?>"
              title="<?php the_title(); ?>"
              alt="<?php the_title(); ?>"
        />
        <?php endif; ?>
        <h1 class="c-post__title"><?= $title ?></h1>
        <p class="c-post__label"><?php the_date('j F, Y'); ?></p>
        <p class="c-post__author">Posted by: <?php the_author(); ?></p>
        <?php get_template_part('partials/entry-meta'); ?>
      </header>
      <div class="c-post__content">
        <?php
        // Get post content, look for old posts that use default editor
        if (get_the_content() !== '') :
          the_content();
        else :
          $post_content = get_field('content_editor');
        endif;
        ?>
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

<?php endif; ?>
