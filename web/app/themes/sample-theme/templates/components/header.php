<div class="c-header-container js-menu">
  <header class="l-container c-header" role="banner">
    <a  class="c-logo"
        href="<?php esc_url(home_url('/')); ?>/"
        role="presentation">
      <h1 class="h-hide-text  ">
        <?php bloginfo('name'); ?>
      </h1>
    </a>
    <div class="c-nav">
      <div class="c-nav__row">
        <aside class="c-nav__secondary">
          <?php
          if (has_nav_menu('secondary_menu')) :
            wp_nav_menu([
                'menu' => 0,
                'theme_location' => 'secondary_menu',
                'container' => false,
                'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                'walker'  => new \BEM_Walker('c-secondary-menu', 'c-secondary-menu__item'),
            ]);
          endif;
          ?>
        </aside>
      </div>
      <div class="c-nav__row">
        <nav class="c-nav__primary">
          <?php
            if (has_nav_menu('primary_menu')) :
              wp_nav_menu(array(
                'menu' => 0,
                'theme_location' => 'primary_menu',
                'container' => false,
                // 'menu_class' => 'c-nav__item',
                'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                'walker'  => new \BEM_Walker('c-nav-menu', 'c-nav-menu__item'),
              ));
            endif;
          ?>
        </nav>
        <div class="c-nav__mobile">
          <a href="/" class="c-nav__toggle js-nav-toggle">Menu</a>
        </div>
        <aside class="c-nav__button">
          <a  class="c-button c-button--yellow c-button--small js-modal-trigger--tryit"
                href="/">
              <?php the_field('modal_form_button', 'option') ?>
          </a>
        </aside>
      </div>

    </div>
  </header>
</div>
