<?php
/**
 * Media, image, MIME functions and definitions
 *
 * @package DEE
 * @subpackage IR
 * @since The Big Bang
 */


/**
 * Set video embed width
 */
if (! isset($content_width)) {
    $content_width = 550;
}

/**
 * Set JPG quality
 */
add_filter('jpeg_quality', function ($arg) {
    return 80;
});

/**
 * Set mime type for SVG
 */
add_filter('upload_mimes', __NAMESPACE__ . '\\mimetypes');
function mimetypes($m)
{
    $m['svg'] = 'image/svg+xml';
    $m['svgz'] = 'image/svg+xml';
    return $m;
}

/**
 * Set sizes parameter for srcset
 */
add_filter('wp_calculate_image_sizes', function ($sizes, $size) {
    $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
    return $sizes;
}, 10, 2);

/**
 * Images sizes
 */
// Display in ... as normal screen image
update_option('medium_size_w', 300);
update_option('medium_size_h', 200);
update_option('medium_crop', 1);

// Display in ... pages as retina screen image
update_option('large_size_w', 600);
update_option('large_size_h', 400);
update_option('large_crop', 1);

// Media builder sizes for srcset
add_image_size('media-small', 456, 9999, 0);
add_image_size('media-small@2x', 912, 9999, 0);
add_image_size('media-medium', 684, 9999, 0);
add_image_size('media-medium@2x', 1368, 9999, 0);
add_image_size('media-large', 912, 9999, 0);
add_image_size('media-large@2x', 1824, 9999, 0);

// Home boxes
add_image_size('box_half', 478, 313, 1);
add_image_size('box_two_thirds', 643, 311, 1);
add_image_size('box_full', 980, 314, 1);

// Blog images
add_image_size('blog', 720, 999, 0);
add_image_size('blog@2x', 1440, 9999, 0);
