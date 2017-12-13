<?php
/**
 * Functions to generate forms html
 *
 */

namespace Forms;

function Textarea($type = null)
{
    if ($type === 'default' || $type === null) {
        $output = '<textarea name="text" rows="6"></textarea>';
    } elseif ($type === 'careers') {
        $output = '<textarea name="postition" rows="2"></textarea>';
    } elseif ($type === 'contact') {
        $output = '<textarea name="contactMessage" rows="6"></textarea>';
    } else {
        $output = null;
    }
    echo $output;
}
