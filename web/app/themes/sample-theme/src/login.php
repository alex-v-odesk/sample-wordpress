<?php
/**
 * Login page functions and definitions
 *
 * @package Beer
 * @subpackage IR
 * @since The Big Bang
 */

 namespace App;

/* ==========================================================================
   Login logo, url etc, Dashboard icons
   ========================================================================== */

// Login logo
function login_logo()
{
    echo '<style type="text/css">
    	body.login {background-color:#fff;}
    	.wp-core-ui .button-primary {background-color: #009eec;text-transform:uppercase;border-color:#009eec;box-shadow: inset 0 1px 0 rgba(230, 211, 120, .5),0 1px 0 rgba(0,0,0,.15);transition: all 0.2s linear; text-shadow: none;}

    	.wp-core-ui .button-primary:hover {background-color: #fff;color: #009eec;border-color: #009eec;box-shadow: inset 0 1px 0 rgba(244, 170, 149, 0.15),0 1px 0 rgba(244, 170, 149, 0.15);}
        h1 a{ background-image:url('.asset_path('images/logo.svg').') !important; width:200px !important; height:57.142857143px !important; background-size: 100% !important;margin-right:auto!important;margin-left:auto!important; }
        input[type=checkbox]:checked:before {color: #009eec; transition:all 0.2s linear}
        body.login #backtoblog{display:none!important}
        body.login #nav{margin-top:6px!important}
    </style>';
}
add_action('login_head', __NAMESPACE__ . '\\login_logo');


// Change login URL from wordpress to us!
function login_url()
{
    return get_home_url();
}
add_filter('login_headerurl', __NAMESPACE__ . '\\login_url');


// Change alt text (ie on hover of logo on login page)
function login_alt()
{
    echo get_option('blogname');
}
//add_filter('login_alt', 'login_alt');


// Change the login page URL hover text
function login_title()
{
    return get_bloginfo('description'); // changing the title from "Powered by WordPress"
}
add_filter('login_headertitle', __NAMESPACE__ . '\\login_title');


// Admin logo
function admin_logo()
{
    echo '<style type="text/css">
         #wp-admin-bar-wp-logo > .ab-item .ab-icon { background-image: url('.asset_path('images/logo-white.svg').') !important; height:20px!important; background-size: 20px 20px!important; background-position:0 -1px; }
         #wpadminbar.nojs #wp-admin-bar-wp-logo:hover > .ab-item .ab-icon,
		 #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {background-image: url('.get_bloginfo('url').'/wp-includes/images/admin-bar-sprite.png?d=20111130);background-position: 0 -104px;}
         </style>';
}
add_action('admin_head', __NAMESPACE__ . '\\admin_logo');


/* Or...... */
function enquestyle()
{
    wp_enquestyle('core', 'style.css', false);
}

function enquescript()
{
    wp_enquescript('my-js', 'filename.js', false);
}

//add_action( 'login_enquescripts', 'enquestyle', 10 );
//add_action( 'login_enquescripts', 'enquescript', 1 );
