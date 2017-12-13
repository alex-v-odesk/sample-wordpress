<?php
/**
 * Open container tags to hold BG image for footer
 */

global $options;
?>

<div  class="c-billboard c-billboard--footer <?= $options['bg_position'] ?> <?= $options['has_form'] ?>"
      style="background-image: url('<?= $options['bg_image'] ?>');">
