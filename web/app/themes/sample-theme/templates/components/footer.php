<div class="o-modal js-modal-tryit ui modal">
  <div class="c-modal l-container">
    <a class="c-modal__close js-modal-close js-null" href="/close" rel="nofollow"><i class="icon-close"></i></a>
    <div class="c-modal__header l-4-of-5 l-push-1-of-10">
      <p class="c-modal__title">
        <?= _x('Thanks for trying sample-theme', 'Form Messages - Modal', 'sample-theme'); ?>
      </p>
      <p class="c-modal__text">
        <?= _x('Please complete the form below to request your copy of sample-theme today.', 'Form Messages - Modal', 'sample-theme') ?>
      </p>
    </div>
    <?php get_template_part('partials/template/component-builder/views/forms/form-evaluation-modal')?>
  </div>
</div>

<footer class="c-footer">
  <div class="l-container">
    <div class="c-card c-card--footer c-card--logo l-2-of-7">
      <a  class="c-logo c-logo--footer"
          href="<?= esc_url(home_url('/')) ?>"
          role="presentation">
        <h1 class="h-hide-text  ">
          <?= bloginfo('name') ?>
        </h1>
      </a>
      <p class=""><?= _x('Follow us:', 'Footer', 'sample-theme') ?></p>
      <ul class="c-list-social c-list-social--footer">
        <li>
          <a href="https://twitter.com/sample-themebi" target="_blank"><i class="icon-twitter">Twitter</i></a>
        </li>
        <li>
          <a href="https://www.linkedin.com/groups/774157" target="_blank"><i class="icon-linkedin">LinkedIn</i></a>
        </li>
        <li>
          <a href="https://www.youtube.com/user/sample-themeTeam"  target="_blank"><i class="icon-youtube">YouTube</i></a>
        </li>
      </ul>
      <p class=""><?= _x('Contact us:', 'Footer', 'sample-theme') ?></p>
      <?php
        if (has_nav_menu('footer_contact_menu')) :
          wp_nav_menu(array(
            'menu' => 0,
            'theme_location' => 'footer_contact_menu',
            'container' => false,
            'menu_id' => '',
            'menu_class' => '',
            'items_wrap' => '',
            'walker'  => new \BEM_Walker('c-list c-list--footer', 'c-list__item')
          ));
        endif;
      ?>     </div>
    <div class="c-card c-card--footer l-1-of-7">
      <h2 class="c-card__title"><?= _x('Platform', 'Footer', 'sample-theme') ?></h2>
      <?php
        if (has_nav_menu('footer_platform_menu')) :
          wp_nav_menu(array(
            'menu' => 0,
            'theme_location' => 'footer_platform_menu',
            'container' => false,
            'menu_id' => '',
            'menu_class' => '',
            'items_wrap' => '',
            'walker'  => new \BEM_Walker('c-list c-list--column', 'c-list__item')
          ));
        endif;
      ?>
    </div>
    <div class="c-card c-card--footer l-1-of-7">
      <h2 class="c-card__title"><?= _x('Solution', 'Footer', 'sample-theme') ?></h2>
      <?php
        if (has_nav_menu('footer_solutions_menu')) :
          wp_nav_menu(array(
            'menu' => 0,
            'theme_location' => 'footer_solutions_menu',
            'container' => false,
            'menu_id' => '',
            'menu_class' => '',
            'items_wrap' => '',
            'walker'  => new \BEM_Walker('c-list c-list--column', 'c-list__item')
          ));
        endif;
      ?>
    </div>
    <div class="c-card c-card--footer l-1-of-7">
      <h2 class="c-card__title"><?= _x('Company', 'Footer', 'sample-theme') ?></h2>
      <?php
        if (has_nav_menu('footer_company_menu')) :
          wp_nav_menu(array(
            'menu' => 0,
            'theme_location' => 'footer_company_menu',
            'container' => false,
            'menu_id' => '',
            'menu_class' => '',
            'items_wrap' => '',
            'walker'  => new \BEM_Walker('c-list c-list--column', 'c-list__item')
          ));
        endif;
      ?>
    </div>
    <div class="c-card c-card--footer l-2-of-7">
      <h2 class="c-card__title"><?= _x('Blog', 'Footer', 'sample-theme') ?></h2>
      <?php
        if (has_nav_menu('footer_blog_menu')) :
          wp_nav_menu(array(
            'menu' => 0,
            'theme_location' => 'footer_blog_menu',
            'container' => false,
            'menu_id' => '',
            'menu_class' => '',
            'items_wrap' => '',
            'walker'  => new \BEM_Walker('c-list c-list--column', 'c-list__item')
          ));
        endif;
      ?>
    </div>
  </div>
  <div class="l-container">
    <div class="c-credits">
      <?php the_field('credits', 'option') ?>
    </div>
  </div>
</footer>
