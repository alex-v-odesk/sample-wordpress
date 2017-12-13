<?php
/**
 * Functions to generate forms html
 *
 */

namespace Forms;

function Select($type = '', $variation = '')
{
    if ($type === 'interest') {
        $output  = '<label for="interest" class="h-hidden"></label>';
        $output .= '<select class="ui search dropdown" name="interest">';
        $output .= '<option value="">' . _x('Interest', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
        if ($variation === 'contact') {
            $output .= '<option value="Support">' . _x('Support', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
            $output .= '<option value="Career">' . _x('Career', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
            $output .= '<option value="Services">' . _x('Services', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
            $output .= '<option value="Training">' . _x('Training', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
            $output .= '<option value="General Inquiry">' . _x('General Inquiry', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
            $output .= '<option value="Other">' . _x('Other', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
          } elseif ($variation === 'evaluation') {
              $output .= '<option value="CUSTOMER">' . _x('Customer', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
              $output .= '<option value="RESELLER">' . _x('Reseller', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
              $output .= '<option value="Embedded Partner">' . _x('Embedded Partner', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
          } elseif ($variation === 'partner') {
              $output .= '<option value="CUSTOMER">' . _x('Customer', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
              $output .= '<option value="RESELLER">' . _x('Reseller', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
              $output .= '<option value="Embedded Partner">' . _x('Embedded Partner', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
              $output .= '<option value="Other">' . _x('Other', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
          } elseif ($variation === 'services') {
            $output .= '<option value="Services">' . _x('Services', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
            $output .= '<option value="Training">' . _x('Training', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
            $output .= '<option value="Support">' . _x('Support', 'Form Dropdown - Interest', 'sample-theme') .'</option>';
        }
        $output .= '</select>';
    } elseif ($type === 'country') {
        if (get_locale() === 'ja') {
            $output = '<input name="countryCode" type="hidden" value="JP">';
        } else {
            $output = get_template_part('partials/template/component-builder/views/forms/partials/country-select');
        }
    } else {
        $output = null;
    }
    echo $output;
}
