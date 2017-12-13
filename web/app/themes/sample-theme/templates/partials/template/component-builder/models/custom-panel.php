<?php
/**
 * Controller Name: Custom Panel
 *
 * @description Selects custom panel based on hardcoded ACF choices
 */

global $data, $content;

$options = get_sub_field('custom_panel');
$selection = get_sub_field($options);

// Test with pricing and case-studies/kodak pages
// var_dump($options);
// var_dump($selection);

// What the heck is wrong with if..elseif..else..endif?
if (!empty($options)) :
  if ($selection == 'pricing-business-en-full') :
    get_template_part('partials/template/component-builder/views/custom/pricing-business-en-full');
  endif;
  if ($selection == 'pricing-business-en-hidden') :
    get_template_part('partials/template/component-builder/views/custom/pricing-business-en-hidden');
  endif;
  if ($selection == 'pricing-business-jp-full') :
    get_template_part('partials/template/component-builder/views/custom/pricing-business-jp-full');
  endif;
  if ($selection == 'pricing-business-jp-hidden') :
    get_template_part('partials/template/component-builder/views/custom/pricing-business-jp-hidden');
  endif;
  if ($selection == 'pricing-vendor-en-full') :
      get_template_part('partials/template/component-builder/views/custom/pricing-vendor-en-full');
  endif;
  if ($selection == 'pricing-vendor-en-hidden') :
      get_template_part('partials/template/component-builder/views/custom/pricing-vendor-en-hidden');
  endif;
  if ($selection == 'pricing-vendor-jp-full') :
      get_template_part('partials/template/component-builder/views/custom/pricing-vendor-jp-full');
  endif;
  if ($selection == 'pricing-vendor-jp-hidden') :
      get_template_part('partials/template/component-builder/views/custom/pricing-vendor-jp-hidden');
  endif;
  if ($options == 'case-study') :
      get_template_part('partials/template/component-builder/views/custom/case-study');
  endif;
endif;
