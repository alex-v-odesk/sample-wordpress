<?php
/**
 * Component Name: Footer
 *
 * Graphic elements - small and large waves
 */

global $options;

?>
  <div class="l-container l-container--full-width t-bg--waves <?= \Builder\get_bg_colour($options['graphic_bg_colour'],null) ?>">
    <div class="<?= \Builder\get_footer_graphics($options['graphic_style']) ?>">
    </div>
  </div>
