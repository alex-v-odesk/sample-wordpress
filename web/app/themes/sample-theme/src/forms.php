<?php
/**
 * Functions to generate forms html
 *
 */

$forms_includes = [
  'src/lib/Forms/Button.php',
  'src/lib/Forms/Select.php',
  'src/lib/Forms/Text.php',
  'src/lib/Forms/Textarea.php',
];

array_walk($forms_includes, function ($file) {
    if (!locate_template($file, true, true)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'sample-theme'), $file), E_USER_ERROR);
    }
});
