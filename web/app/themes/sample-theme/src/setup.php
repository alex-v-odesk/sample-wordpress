<?php

namespace App;

use Roots\Sage\Template;

/**
* Theme assets
*/
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('main.js', asset_path('scripts/main.js'), null, null, true);
    wp_deregister_script('wp-embed');
}, 100);

/**
* Theme setup
*/
add_action('after_setup_theme', function () {
    /**
    * Enable features from Soil when plugin is activated
    * @link https://roots.io/plugins/soil/
    */
    add_theme_support('soil-clean-up');
    // add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
    * Enable plugins to manage the document title
    * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
    */
    add_theme_support('title-tag');

    /**
    * Register navigation menus
    * @link http://codex.wordpress.org/Function_Reference/register_nav_menus
    */
    register_nav_menus([
      'primary_menu' => __('Primary Menu', 'sample-theme'),
      'secondary_menu' => __('Secondary Menu', 'sample-theme'),
      'mobile_menu' => __('Mobile Menu', 'sample-theme'),
      'footer_platform_menu' => __('Footer Menu - Platform', 'sample-theme'),
      'footer_solutions_menu' => __('Footer Menu - Solutions', 'sample-theme'),
      'footer_company_menu' => __('Footer Menu - Company', 'sample-theme'),
      'footer_blog_menu' => __('Footer Menu - Blog', 'sample-theme'),
      'footer_contact_menu' => __('Footer Menu - Contact', 'sample-theme'),
    ]);

    /**
    * Enable post thumbnails
    * @link http://codex.wordpress.org/Post_Thumbnails
    * @link http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
    * @link http://codex.wordpress.org/Function_Reference/add_image_size
    */
    add_theme_support('post-thumbnails');

    /**
    * Enable post formats
    * @link http://codex.wordpress.org/Post_Formats
    */
    add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

    /**
    * Enable HTML5 markup support
    * @link http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
    */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
    * Use main stylesheet for visual editor
    * @see assets/styles/layouts/_tinymce.scss
    */
    //add_editor_style(asset_path('styles/main.css'));

    /**
    * Remove WordPress version meta tag, and other extraneous header items
    */
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'wp_resource_hints', 2);

    /**
     * Remove the additional CSS section, introduced in 4.7, from the Customizer.
     * Allow on test environment only
     * @param $wp_customize WP_Customize_Manager
     */
    if (WP_ENV !== 'test') {
        add_action('customize_register', function ($wp_customize) {
            $wp_customize->remove_section('custom_css');
        });
    }
});


/**
* Remove JSON API and header output
*/
// add_action( 'after_setup_theme',  __NAMESPACE__.'\\remove_json_api' );
// function remove_json_api()
// {
//     // Remove the REST API lines from the HTML Header
//     remove_action('wp_head', 'rest_output_link_wp_head', 10);
//     remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
//     // Remove the REST API endpoint.
//     remove_action('rest_api_init', 'wp_oembed_register_route');
//     // Turn off oEmbed auto discovery.
//     add_filter('embed_oembed_discover', '__return_false');
//     // Don't filter oEmbed results.
//     remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
//     // Remove oEmbed discovery links.
//     remove_action('wp_head', 'wp_oembed_add_discovery_links');
//     // Remove oEmbed-specific JavaScript from the front-end and back-end.
//     remove_action('wp_head', 'wp_oembed_add_host_js');
//     // Remove all embeds rewrite rules.
//     // add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
// }

/**
* Disable JSON API
*/
// // add_action( 'after_setup_theme', __NAMESPACE__.'\\disable_json_api' );
// function disable_json_api()
// {
//     // Filters for WP-API version 1.x
//     add_filter('json_enabled', '__return_false');
//     add_filter('json_jsonp_enabled', '__return_false');
//     // Filters for WP-API version 2.x
//     add_filter('rest_enabled', '__return_false');
//     add_filter('rest_jsonp_enabled', '__return_false');
// }

// /**
// * Register sidebars
// */
// //add_action('widgets_init', __NAMESPACE__.'\\widgets');
// function widgets()
// {
//     $config = [
//         'before_widget' => '<section class="widget %1$s %2$s">',
//         'after_widget'  => '</section>',
//         'before_title'  => '<h3>',
//         'after_title'   => '</h3>'
//         ];
//     register_sidebar([
//         'name'          => __('Primary', 'sample-theme'),
//         'id'            => 'sidebar-primary'
//         ] + $config);
//     register_sidebar([
//         'name'          => __('Footer', 'sample-theme'),
//         'id'            => 'sidebar-footer'
//         ] + $config);
// }

/**
* Remove emoji scripts
*/
add_action('init', __NAMESPACE__.'\\disable_emojis');
function disable_emojis()
{
    // Remove from the head, i.e. wp_head()
    remove_action('wp_head', 'print_emoji_detection_script', 7);

    // Remove from Dashboard
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');

    // Remove from print styles
    remove_action('wp_print_styles', 'print_emoji_styles');

    // Remove from comment feed and RSS
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    // Remove from Emails
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}

/**
* Add development script for Usersnap
*
*/
// if (WP_ENV === 'staging') {
//     add_action('wp_footer', __NAMESPACE__ . '\\usersnap', 999 );
// }
function usersnap()
{
    ?>
<script aysnc src='//api.usersnap.com/load/48682905-c665-4fc8-b9ca-eaf7ddd9e506.js'></script>
    <?php
    echo "\n";
}

/**
* Add development polyfill script for IE
*
* https://github.com/Yaffle/EventSource
* Needs php script to track events to be added
*
* OR
* https://github.com/remy/polyfills/blob/master/EventSource.js
*
*/
// if (WP_ENV === 'development') {
//     add_action('wp_enqueue_scripts', function () {
//         wp_enqueue_script('eventsource.js', asset_path('scripts/vendor/eventsource.js'), null, null, false);
//     });
// }


/**
* Set ACF JSON load location
*/
add_filter('acf/settings/load_json', __NAMESPACE__ . '\\yf_load_acf_json');
function yf_load_acf_json($paths)
{
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = WP_CONTENT_DIR . '/data/acf';
    // return
    return $paths;
}

/**
* Set ACF JSON save location
*/
add_filter('acf/settings/save_json', __NAMESPACE__ . '\\yf_save_acf_json');
function yf_save_acf_json($path)
{
    // update path
    $path = WP_CONTENT_DIR . '/data/acf';
    // return
    return $path;
}

/**
* Disable local jQuery for front end as it is bundled via Webpack
*/
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\local_jquery', 100);
function local_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
    }
}

/**
* Marketo RTP script
*
* To disable: set boolean to false
*
*/
if (WP_ENV !== 'production' && false) {
    add_action('wp_head', __NAMESPACE__ . '\\marketoRtp', 999);
}
function marketoRtp()
{
    ?><script>(function(c,h,a,f,e,i){c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};c[a].p=e;c[a].a=i;var g=h.createElement("script");g.async=true;g.type="text/javascript";g.src=f;var b=h.getElementsByTagName("script")[0];b.parentNode.insertBefore(g,b)})(window,document,"rtp","[rtp-js-cdn-url]","[pod-url]","[accountId]");</script>
<?php
}

/**
* Google Tag Manager script
*
*/
if (WP_ENV !== 'development') {
    add_action('wp_head', __NAMESPACE__ . '\\google_tag_manager_js', 999);
    add_action('after_body', __NAMESPACE__ . '\\google_tag_manager_iframe', 999);
}
function google_tag_manager_js()
{
    ?><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= GTM ?>');</script><?php
}
function google_tag_manager_iframe()
{
    ?><noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= GTM ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><?php
}

/**
* Google Analytics script
*
* Only used for testing on local development environment
* To disable: set boolean to false
*
* Note that common.js causes JS errors if this is not enabled
* Todo: Break out ga function into it's own module and conditionally load it
*
*/
if (WP_ENV === 'development' && true) {
    // add_action('wp_head', __NAMESPACE__ . '\\munchkin_js', 999);
    // add_action('after_body', __NAMESPACE__ . '\\google_analytics_js', 999);
    // add_action('wp_head', __NAMESPACE__ . '\\data_layer_js', 999);
    add_action('wp_head', __NAMESPACE__ . '\\google_tag_manager_js', 999);
}

/**
* GA snippet
*
*/
function google_analytics_js()
{
    ?><script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');ga('create', 'UA-10903042-1', 'auto');ga('send', 'pageview');
    </script><?php
}

/**
* Dummy GTM dataLayer array snippet
*
*/
function data_layer_js()
{
    ?><script>
      window.dataLayer = window.dataLayer || [];
    </script><?php
}


/**
* Marketo MunchkinJS snippet
*
*/
function munchkin_js()
{
    ?>
  <script type="text/javascript">
  (function() {
    var didInit = false;
    function initMunchkin() {
      if(didInit === false) {
        didInit = true;
        Munchkin.init('249-ZVV-229');
      }
    }
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = '//munchkin.marketo.net/munchkin.js';
    s.onreadystatechange = function() {
      if (this.readyState == 'complete' || this.readyState == 'loaded') {
        initMunchkin();
      }
    };
    s.onload = initMunchkin;
    document.getElementsByTagName('head')[0].appendChild(s);
  })();
  </script>
  <?php
}

/**
* Marketo MunchkinJS snippet (uglified)
*
*/
function munchkin_js_min()
{
    ?>
  <script type="text/javascript">!function(){function e(){!1===t&&(t=!0,Munchkin.init("249-ZVV-229"))}var t=!1,n=document.createElement("script");n.type="text/javascript",n.async=!0,n.src="//munchkin.marketo.net/munchkin.js",n.onreadystatechange=function(){"complete"!=this.readyState&&"loaded"!=this.readyState||e()},n.onload=e,document.getElementsByTagName("head")[0].appendChild(n)}();</script>
  <?php
}

/**
* Optimizely snippet
*
* To disable: set boolean to false
*/
if (WP_ENV === 'production' && false) {
    add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\optimizely_js', 999);
}
function optimizely_js()
{
    wp_enqueue_script('optimizely', 'https://cdn.optimizely.com/js/8321131397.js', null, null, false);
}

/**
 * ACF options page for translations
 */
 if (function_exists('acf_add_options_page')) {
     acf_add_options_page(array(
        'page_title'    => 'General Settings',
        'menu_title'    => 'Options',
        'menu_slug'    => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));

     acf_add_options_sub_page(array(
        'page_title'    => 'Translation',
        'menu_title'    => 'Translation',
        'menu_slug'    => 'theme-translation-settings',
        'parent_slug'    => 'theme-general-settings',
    ));
 }

 /**
  * Add custom post type to The SEO Framework
  */
add_filter('the_seo_framework_supported_post_types', function ($args = array()) {
    $args[] = 'campaign';
    return $args;
});

/**
 * Remove editor from posts to enable page builder / default templates
 */
add_action('init', __NAMESPACE__.'\\post_template', 10);
function post_template()
{
    remove_post_type_support('post', 'post-formats');
}

/**
 * Inlcude AdWords tracking snippet on campaigns.
 *
 * Todo: set action to trigger on 'after_body' or 'wp_head'
 * Todo: strip all tags
 * Todo: strip any script not hosted on google?
 */
add_action('wp_head', function () {
    if (is_single() && (get_post_type() === 'campaign')) {
        $tracking = get_field('tracking_script');
        if ($tracking) {
            echo $tracking;
        }
    }
});
