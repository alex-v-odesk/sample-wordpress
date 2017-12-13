<?php 
// Custom walker class
// Creates ul li structure with no unnecessary class names
// https://github.com/benjamincrozat/bem-walker-nav-menu
class BEM_Walker extends Walker_Nav_Menu {
	public $navListClass;
	public $navItemClass;
	public $subNavClass;

	protected $navLinkClass    = 'c-nav-menu__link';
	protected $subNavItemClass = 'c-mega-menu__item';
	protected $subNavLinkClass = 'c-mega-menu__link';

	public function __construct($ul_class, $li_class, $child_li_class = 'c-mega-menu') {
		$this->navListClass = $ul_class;
		$this->navItemClass = $li_class;
		$this->subNavClass = $child_li_class;
		add_filter('wp_nav_menu_args', function ($args) {
			$args['items_wrap'] = '<ul class="' . $this->navListClass . '">%3$s</ul>';
			return $args;
		});
	}

	public function start_lvl(&$output, $depth = 0, $args = []) {
    if ($depth >= 1) :
      $submenu = 'c-nested-menu';
    else :
      $submenu = $this->subNavClass;
    endif;
		$output .= sprintf('<ul class="%s">', $submenu);
	}

	public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
		$class_names = null;
		$classes = empty($item->classes) ? [] : (array) $item->classes;
		array_walk($classes, function (&$value) use ($depth) {
      if ($depth > 1) :
        $replacement = 'c-nested-menu__item';
      elseif ($depth == 1) :
        $replacement = $this->subNavItemClass;
      else :
        $replacement = $this->navItemClass;
      endif;
			// $replacement = $depth ? $this->subNavItemClass : $this->navItemClass;
			$value = str_replace('menu-item-', sprintf('%s--', $replacement), $value);
			$value = str_replace('menu-item', $replacement, $value);
		});
		$classes[] = sprintf('%s--%s', $this->navItemClass, $item->ID);
		$args = apply_filters('nav_menu_item_args', $args, $item, $depth);
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
		$class_names = $class_names ? sprintf(' class="%s"', esc_attr($class_names)) : '';
		// $id = apply_filters('nav_menu_item_id', sprintf('%s--%s', $this->navItemClass, $item->ID), $item, $args, $depth);
		$id = $id ? sprintf(' id="%s"', esc_attr($id)) : '';
		// $output .= sprintf('<li%s%s>', $id, $class_names);
		$output .= sprintf('<li%s%s>', null, $class_names);
		$atts = [];
		$atts['title']  = !empty($item->attr_title) ? $item->attr_title      : '';
		$atts['target'] = !empty($item->target)     ? $item->target          : '';
		$atts['rel']    = !empty($item->xfn)        ? $item->xfn             : '';
		$atts['href']   = !empty($item->url)        ? $item->url             : '';
		$atts['class']  = $depth                    ? $this->subNavLinkClass : $this->navLinkClass;
		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (empty($value)) {
				continue;
			}
			$value       = ' href' === $attr ? esc_url($value) : esc_attr($value);
			$attributes .= sprintf('%s="%s"', $attr, $value);
		}
		$title = apply_filters('the_title', $item->title, $item->ID);
		$title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
		$item_output  = $args->before;
		$item_output .= sprintf('<a %s>', $attributes);
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}

// Custom walker class
// Creates ul li structure with no unnecessary class names
// class Clean_Walker extends Walker_Nav_Menu {
// 	// Indent ul sub-menus
// 	function start_lvl(&$output, $depth = 0, $args = []) {
// 	  // Depth dependent classes
// 	  $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
// 	  $display_depth = ( $depth + 1); // because it counts the first submenu as 0

// 	  // Start to build html
// 	  $output .= "\n" . $indent . '<ul>' . "\n";
// 	}
		  
// 	    // Build HTML
// 	function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
// 	  global $wp_query;
// 	  $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

// 	  // Build html
// 	  $output .= $indent . '<li>';

// 	  // Link attributes
// 	  $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
// 	  $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
// 	  $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
// 	  $attributes .= ! empty( $item->url )        ? ' href="'   . parse_url( esc_attr( $item->url ), PHP_URL_PATH ) .'"' : '';

// 	  $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
// 	      $args->before,
// 	      $attributes,
// 	      $args->link_before,
// 	      apply_filters( 'the_title', $item->title, $item->ID ),
// 	      $args->link_after,
// 	      $args->after
// 	  );

// 	  // Complete building html
// 	  $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
// 	}
// }

// Category Walker
// class Walker_Category_Find_Parents extends Walker_Category {
//     function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
//         extract($args);

//         $cat_name = esc_attr( $category->name );
//         $cat_name = apply_filters( 'list_cats', $cat_name, $category );
//         $link = '<a href="' . esc_url( get_term_link($category) ) . '" ';
//         if ( $use_desc_for_title == 0 || empty($category->description) )
//             $link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s' ), $cat_name) ) . '"';
//         else
//             $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
//             $link .= '>';
//             $link .= $cat_name . '</a>';

//         if ( !empty($show_count) )
//             $link .= ' (' . intval($category->count) . ')';

//                 if ( 'list' == $args['style'] ) {
//                         $output .= "\t<li";
//                         //$class = 'cat-item cat-item-' . $category->term_id;
//                         $class = 'category__list-item';

//                         $termchildren = get_term_children( $category->term_id, $category->taxonomy );
//                         if(count($termchildren)>0){
//                             $class .=  ' has-children';
//                         }

//                         if ( !empty($current_category) ) {
//                                 $_current_category = get_term( $current_category, $category->taxonomy );
//                                 if ( $category->term_id == $current_category )
//                                         $class .=  ' current-cat';
//                                 elseif ( $category->term_id == $_current_category->parent )
//                                         $class .=  ' current-cat-parent';
//                         }
//                         $output .=  ' class="' . $class . '"';
//                         $output .= ">$link\n";
//                 } else {
//                         $output .= "\t$link<br />\n";
//                 }
//         }
//     }







	
