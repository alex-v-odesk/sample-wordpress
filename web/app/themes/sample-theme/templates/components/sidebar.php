<aside>
<?php 
  if (has_nav_menu('mobile_menu')) :  
    wp_nav_menu(array(
      'menu' => 0,
      'theme_location' => 'mobile_menu',
      'container' => false,
      // 'menu_class' => 'c-nav__item',
      'items_wrap' => '<ul class="%2$s">%3$s</ul>',
      'walker'  => new \BEM_Walker('c-mobile-menu', 'c-mobile-menu__item', 'c-mobile-child-menu'),
    ));
  endif;
?>            
</aside>