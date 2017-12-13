<?php
/**
 * Functions to generate forms html
 *
 */

namespace Forms\Input;

function Text($type)
{
    $output = '<label>';
    $output .= '<input'."\n";

    if ($type === 'firstName') {
        $output .= 'name="firstName"';
        $output .= 'type="text"';
        $output .= 'placeholder="'. _x('First Name', 'Form', 'sample-theme') . '"';
    } elseif ($type === 'lastName') {
        $output .= 'name="lastName"';
        $output .= 'type="text"';
        $output .= 'placeholder="'. _x('Last Name', 'Form', 'sample-theme') . '"';
    } elseif ($type === 'emailAddress') {
        $output .= 'name="emailAddress"';
        $output .= 'type="text"';
        $output .= 'placeholder="'. _x('Business Email', 'Form', 'sample-theme') . '"';
    } elseif ($type === 'phone') {
        $output .= 'name="phone"';
        $output .= 'type="text"';
        $output .= 'placeholder="'. _x('Phone', 'Form', 'sample-theme') . '"';
    } elseif ($type === 'company') {
        $output .= 'name="company"';
        $output .= 'type="text"';
        $output .= 'placeholder="'. _x('Company', 'Form', 'sample-theme') . '"';
    } elseif ($type === 'website') {
        $output .= 'name="website"';
        $output .= 'type="text"';
        $output .= 'placeholder="'. _x('Website', 'Form', 'sample-theme') . '"';
    } elseif ($type === 'jobTitle') {
        $output .= 'name="jobTitle"';
        $output .= 'type="text"';
        $output .= 'placeholder="'. _x('Job Title', 'Form', 'sample-theme') . '"';
    }
    $output .= '>';
    $output .= '</label>';
    echo $output;
}
