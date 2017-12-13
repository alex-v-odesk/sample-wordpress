<?php
/** Production */
ini_set('display_errors', 0);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', false);
/** Disable all file modifications including updates and update notifications */
define('DISALLOW_FILE_MODS', false);

/** WP Super Cache settings */
// define('WP_CACHE', true);
define('AUTOSAVE_INTERVAL', 300);
// define('WP_POST_REVISIONS', false);
// define('WPCACHEHOME', '/srv/www/sample.splendidperch.co/releases/20171030073808/web/app/plugins/wp-super-cache/');
