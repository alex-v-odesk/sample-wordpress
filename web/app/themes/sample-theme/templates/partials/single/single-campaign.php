<?php
/**
 * Single post template - Campaign custom content type
 *
 */

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

// Marketo testing
if (WP_ENV !== 'production') {
}

// Check if the Panel Builder has any content
if (have_rows('panel_builder')):

    // Loop through the rows of data
    while (have_rows('panel_builder')) : the_row();

      // Retrieve panel options and build arguments array
      // Note that ACF clone uses original field keys
      $args = array(
        'padding' => get_sub_field('padding'),
        'width' => get_row_layout(),
        'text_colour' => get_sub_field('colour_selector'),
        'bg_colour' => get_sub_field('colour_selector'),
        'visibility' => get_sub_field('visibility'),
      );

      // Open panel container markup
      \Builder\open_container($args);

      // Check if a Component Builder has been saved and loop through data
      if (have_rows('component_builder')):

        // Process row / panel
        while (have_rows('component_builder')) : the_row();

          // Retrieve panel options
          $args = array(
            'data' => get_row(),
            'component' => get_row_layout(),
          );

          \Builder\get_component_template($args);

        endwhile;

      endif;

      // Close panel container markup
      \Builder\close_container();

    endwhile;

endif;
