<?php
/**
 * Builder functions to process ACF options and render markup
 */

namespace Builder;

use Roots\Sage\App;

/**
 * Prepend HTML container open tags
 *
 * @param string  $width        Set full width fluid container or fixed width
 * @param string  $bg_colour    Background colour for container (aka panel in ACF)
 */
function open_container($args)
{
    $classes[] = get_position($args['padding']);
    $classes[] = get_width($args['width']);
    $classes[] = get_bg_colour($args['bg_colour'], $args['bg_custom']);
    $classes[] = get_visibility($args['visibility']); ?>
    <section class="o-panel l-container <?= class_styles($classes) ?>">
  <?php
}

/**
 * Append HTML container close tags
 */
function close_container()
{
    ?>
  </section>
  <?php
}

/**
 * Process component templates
 */
function get_component_template($args)
{

  // Pass ACF field data
    global $data;
    $data = $args['data'];

    if ($args['component'] == 'hero') :
    get_template_part('partials/template/component-builder/controllers/hero'); elseif ($args['component'] == 'text') :
    get_template_part('partials/template/component-builder/controllers/text'); elseif ($args['component'] == 'list') :
    get_template_part('partials/template/component-builder/controllers/list'); elseif ($args['component'] == 'banner') :
    get_template_part('partials/template/component-builder/controllers/banner'); elseif ($args['component'] == 'button') :
    get_template_part('partials/template/component-builder/controllers/button'); elseif ($args['component'] == 'media') :
    get_template_part('partials/template/component-builder/controllers/media'); elseif ($args['component'] == 'form') :
    get_template_part('partials/template/component-builder/controllers/form'); elseif ($args['component'] == 'footer') :
    get_template_part('partials/template/component-builder/controllers/footer'); elseif ($args['component'] == 'custom') :
    get_template_part('partials/template/component-builder/controllers/custom-panel'); else :
    return;
    endif;
}

/**
 * Process main panel width
 */
function get_width($args)
{
    if ($args == 'full_width_panel') :
    return 'l-container--full-width'; else :
    return null;
    endif;
}

/**
 * Process mobile and desktop visibility
 */
function get_visibility($args)
{
    if ($args == 'mobile-hidden') :
    return 'h-mobile-hidden'; elseif ($args == 'desktop-hidden') :
      return 'h-desktop-hidden'; else :
    return null;
    endif;
}

/**
 * Process background colour
 */
function get_bg_colour($args, $value)
{
    if ($args == 'white') :
    return 't-bg--white'; elseif ($args == 'light-grey') :
    return 't-bg--grey-light'; elseif ($args == 'medium-grey') :
    return 't-bg--grey-medium'; elseif ($args == 'dark-grey') :
    return 't-bg--grey-dark'; elseif ($args == 'yellow') :
    return 't-bg--yellow'; elseif ($args == 'blue') :
    return 't-bg--blue'; elseif ($args == 'custom') :
    return 't-bg--' . str_replace('#', '', $value); else :
    return null;
    endif;
}

/**
 * Process text / button alignment
 */
function get_align($args)
{
    if ($args == 'left') :
    return 't-align--left'; elseif ($args == 'right') :
    return 't-align--right'; elseif ($args == 'center') :
    return 't-align--center'; else :
    return null;
    endif;
}

/**
 * Process type colour
 */
function get_text_colour($args)
{
    if ($args == 'light-grey') :
    return 't-text--grey-light'; elseif ($args == 'medium-grey') :
    return 't-text--grey-medium'; elseif ($args == 'dark-grey') :
    return 't-text--grey-dark'; elseif ($args == 'yellow') :
    return 't-text--yellow'; elseif ($args == 'blue') :
    return 't-text--blue'; elseif ($args == 'white') :
    return 't-text--white'; else :
    return null;
    endif;
}

/**
 * Get font size for text
 */
function get_text_size($args)
{
    if ($args == 'small') :
    return 't-font--small'; elseif ($args == 'medium') :
    return 't-font--medium'; elseif ($args == 'large') :
    return 't-font--large'; else :
    return null;
    endif;
}

/**
 * Get button colour
 */
function get_button_colour($args)
{
    if ($args == 'light-grey') :
    return 'c-button--grey-light'; elseif ($args == 'medium-grey') :
    return 'c-button--grey-medium'; elseif ($args == 'dark-grey') :
    return 'c-button--grey-dark'; elseif ($args == 'yellow') :
    return 'c-button--yellow'; elseif ($args == 'blue') :
    return 'c-button--blue'; elseif ($args == 'white') :
    return 'c-button--white'; else :
    return null;
    endif;
}

/**
 * Get button style
 */
function get_button_style($args)
{
    if ($args == 'outline') :
    return 'c-button--outline'; elseif ($args == 'solid') :
    return 'c-button--solid'; else :
    return null;
    endif;
}

/**
 * Get button action (ie modal)
 */
function get_button_action($args)
{
    if ($args == 'evaluation') :
    return 'js-modal-tryit'; elseif ($args == 'other') :
    return 'js-modal-other'; else :
    return null;
    endif;
}

/**
 * Get text builder content from other components
 *
 * Used in ACF clone
 */
function get_text($element, $value)
{

  // Build array of data for output into markup
    $output = array(

    'heading' => array(
        'text' => null,
        'colour' => null,
        'size' => null,
        'align' => null,
      ),
    'subheading' => array(
        'text' => null,
        'colour' => null,
        'size' => null,
        'align' => null,
      ),
    'paragraph' => array(
        'text' => null,
        'colour' => null,
        'size' => null,
        'align' => null,
      ),
     'link' => array(
        'text' => null,
        'colour' => null,
        'size' => null,
        'align' => null,
        'url' => null,
        'link' => null,
      ),
  );

    // Use ACF functions to loop through each row of content
    if (have_rows('text_builder')) : while (have_rows('text_builder')) : the_row();

    // Select type of text content
    $text = get_row_layout();

    // Add content to output array
    if ($text == 'heading') :
      $output['heading']['text'] = get_sub_field('text');
    $output['heading']['colour'] = get_text_colour(get_sub_field('colour_selector'));
    $output['heading']['size'] = get_text_size(get_sub_field('font_size'));
    $output['heading']['align'] = get_sub_field('align'); elseif ($text == 'subheading') :
      $output['subheading']['text'] = get_sub_field('text');
    $output['subheading']['colour'] = get_text_colour(get_sub_field('colour_selector'));
    $output['subheading']['size'] = get_text_size(get_sub_field('font_size'));
    $output['subheading']['align'] = get_sub_field('align'); elseif ($text == 'paragraph') :
      $output['paragraph']['text'] = get_sub_field('text');
    $output['paragraph']['colour'] = get_text_colour(get_sub_field('colour_selector'));
    $output['paragraph']['size'] = get_text_size(get_sub_field('font_size'));
    $output['paragraph']['align'] = get_sub_field('align'); elseif ($text == 'link') :
      $output['link']['text'] = get_sub_field('text');
    $output['link']['colour'] = get_text_colour(get_sub_field('colour_selector'));
    $output['link']['size'] = get_text_size(get_sub_field('font_size'));
    $output['link']['align'] = get_sub_field('align');
    $output['link']['link'] = get_sub_field('link');
    $output['link']['url'] = get_sub_field('url');
    $output['link']['label'] = get_sub_field('label');
    endif;
    endwhile;
    endif;

    return $output[$element][$value];
}

/**
 * Show / hide image labels
 */
function get_image_labels($args)
{
    if ($args == true) :
    return null; else :
    return 'has-hidden-labels';
    endif;
}

/**
 * Get image spacing for image lists
 */
function get_image_spacing($args)
{
    if ($args == 'narrow') :
    return 'is-narrow-spacing'; elseif ($args == 'wide') :
    return 'is-wide-spacing'; elseif ($args == 'symmetrical') :
    return null; else :
    return null;
    endif;
}

/**
 * Get image size for image lists
 */
function get_image_size($args)
{
    if ($args == 'small') :
    return '100'; elseif ($args == 'medium') :
    return '200'; elseif ($args == 'large') :
    return '300'; else :
    return null;
    endif;
}

/**
 * Has banner content, check if it exists
 */
function has_banner_content($panel)
{
    if (get_sub_field($panel)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Get banner content
 */
function get_banner_content($panel)
{
    global $content;
    $content = $panel;
    get_template_part('partials/template/component-builder/models/banner/banner');
}

/**
 * Get banner panel width
 */
function get_banner_width()
{
    return get_sub_field('panel_width');
}

/**
 * Get form
 *
 * @param string $form From ACF radio selection
 */
function get_form($form)
{
    if ($form == 'career') :
    get_template_part('partials/template/component-builder/views/forms/form-career'); elseif ($form == 'contact') :
    get_template_part('partials/template/component-builder/views/forms/form-contact'); elseif ($form == 'contact-general') :
    get_template_part('partials/template/component-builder/views/forms/form-contact-general'); elseif ($form == 'demo') :
    get_template_part('partials/template/component-builder/views/forms/form-demo'); elseif ($form == 'demo-small') :
    get_template_part('partials/template/component-builder/views/forms/form-demo-small'); elseif ($form == 'evaluation') :
    get_template_part('partials/template/component-builder/views/forms/form-evaluation'); elseif ($form == 'partner') :
    get_template_part('partials/template/component-builder/views/forms/form-partner'); elseif ($form == 'services') :
    get_template_part('partials/template/component-builder/views/forms/form-services'); elseif ($form == 'support') :
    get_template_part('partials/template/component-builder/views/forms/form-support');
    endif;
}

/**
 * Process media size
 */
function get_media_size($args)
{
    if ($args == 'small') :
    return 'l-2-of-5'; elseif ($args == 'medium') :
    return 'l-3-of-5'; elseif ($args == 'large') :
    return 'l-4-of-5'; else :
    return null;
    endif;
}

/**
 * Process media width
 */
function get_media_width($args)
{
    if ($args == 'small') :
    return '456'; elseif ($args == 'medium') :
    return '684'; elseif ($args == 'large') :
    return '912'; else :
    return null;
    endif;
}

/**
 * Process media position (padding)
 */
function get_media_position($args)
{
    $output = [];

    if ($args) :
    foreach ($args as $arg) :
      if ($arg == 'top') :
        $output[] = 't-media--top '; elseif ($arg == 'right') :
        $output[] = 't-media--right '; elseif ($arg === 'bottom') :
        $output[] = 't-media--bottom '; elseif ($arg == 'left') :
        $output[] = 't-media--left '; elseif ($arg == 'centred') :
        $output[] = 't-media--centred ';
    endif;
    endforeach;
    endif;

    return implode($output);
}

/**
 * Process banner background position
 */
function get_bg_image_position($arg)
{
    if ($arg == 'top') :
      return ' c-billboard--top'; elseif ($arg == 'right') :
        return ' c-billboard--right'; elseif ($arg == 'bottom') :
        return ' c-billboard--bottom'; elseif ($arg == 'left') :
        return ' c-billboard--left'; else :
      return null;
    endif;
}

/**
 * Get footer graphics content
 */
function get_footer_graphics($style)
{
    if ($style == 'default') :
    return 'c-waves'; elseif ($style == 'small') :
    return 'c-waves c-waves--small'; else :
    return null;
    endif;
}

/**
 * Show image / media border
 */
function get_border($show)
{
    if ($show == 'show') :
    return 't-border'; else :
    return null;
    endif;
}

/**
 * Get custom positioning
 */
function get_position($position)
{
    if ($position == 'remove') :
    return ' t-custom-positioning';
    endif;
}

/**
 * Inline styles printed into HTML
 */
 function inline_styles($styles)
 {
     if ($styles != []) {
         echo ' style="';
         foreach ($styles as $style) {
             echo $style;
         }
         echo '"';
     } else {
         return null;
     }
 }

 /**
  * Styles classes printed into HTML
  */
  function class_styles($classes)
  {
      if ($classes != []) {
          foreach ($classes as $class) {
              if ($class != '') {
                  echo ' ' . $class;
              }
          }
      } else {
          return null;
      }
  }
