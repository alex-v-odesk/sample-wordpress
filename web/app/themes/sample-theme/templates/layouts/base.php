<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('components/head'); ?>
  <body <?php body_class(); ?>>
    <?php do_action('after_body'); ?>
    <!--[if IE]>
      <div class="c-alert c-alert--warning">
        <?php _x('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'IE browser warning', 'sample-theme'); ?>
      </div>
    <![endif]-->
    <aside class="l-off-canvas-menu ui sidebar inverted vertical menu">
      <?php App\template_part('components/sidebar'); ?>
    </aside>
    <div class="l-viewport ui pusher" role="document">
      <?php
        do_action('get_header');
        get_template_part('components/header');
      ?>
      <main class="l-main js-main">
        <?php include App\template()->main(); ?>
      </main>
      <?php
        do_action('get_footer');
        get_template_part('components/footer');
        wp_footer();
      ?>
    </div>
  </body>
</html>
