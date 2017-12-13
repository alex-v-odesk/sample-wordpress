<?php
/**
 * Functions to generate forms html
 *
 */

namespace Forms\Button;

function Submit()
{
    $output = '<button class="c-button c-button--yellow t-align--right js-form-submit">';
    $output .= _x('Submit', 'Form Submit', 'sample-theme');
    $output .= '</button>';

    echo $output;
}
