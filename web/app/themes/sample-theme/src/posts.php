<?php
// Forum (label) & forum (registered custom post type name)
add_action('init', __NAMESPACE__ . '\\forum_custom_post_type');
function forum_custom_post_type()
{
    $labels = array(
    'name' => _x('Forum', 'Post type general name'),
    'singular_name' => _x('Forum', 'Post type singular name'),
    'add_new' => __('Add New', 'Forum'),
    'add_new_item' => __('Add New Forum'),
    'edit_item' => __('Edit Forum'),
    'new_item' => __('New Forum'),
    'all_items' => __('All Forums'),
    'view_item' => __('View Forum'),
    'search_items' => __('Search Forums'),
    'not_found' =>  __('No Forums found'),
    'not_found_in_trash' => __('No Forums found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Forum',
    'menu_icon'   => 'dashicons-welcome-add-page',
  );

    $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'resources/forum','with_front' => false),
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
    'menu_position' => null,
    'can_export' => true,
    'show_in_nav_menus' => true,
    'supports' => array( 'title' )
  );

    register_post_type('forum', $args);
}

// Form (label) & form (registered custom post type name)
add_action('init', __NAMESPACE__ . '\\form_custom_post_type');
function form_custom_post_type()
{
    $labels = array(
    'name' => _x('Form', 'Post type general name'),
    'singular_name' => _x('Form', 'Post type singular name'),
    'add_new' => __('Add New', 'Form'),
    'add_new_item' => __('Add New Form'),
    'edit_item' => __('Edit Form'),
    'new_item' => __('New Form'),
    'all_items' => __('All Forms'),
    'view_item' => __('View Form'),
    'search_items' => __('Search Forms'),
    'not_found' =>  __('No Forms found'),
    'not_found_in_trash' => __('No Forms found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Forms',
    'menu_icon'   => 'dashicons-welcome-add-page',
  );

    $args = array(
    'labels' => $labels,
    'public' => false,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => false,
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
    'menu_position' => null,
    'can_export' => true,
    'supports' => array( 'title' )
  );

    register_post_type('form', $args);
}

// Partner (label) & partner (registered custom post type name)
add_action('init', __NAMESPACE__ . '\\partner_custom_post_type');
function partner_custom_post_type()
{
    $labels = array(
    'name' => _x('Partner', 'Post type general name'),
    'singular_name' => _x('Partner', 'Post type singular name'),
    'add_new' => __('Add New', 'Partner'),
    'add_new_item' => __('Add New Partner'),
    'edit_item' => __('Edit Partner'),
    'new_item' => __('New Partner'),
    'all_items' => __('All Partners'),
    'view_item' => __('View Partner'),
    'search_items' => __('Search Partners'),
    'not_found' =>  __('No Partners found'),
    'not_found_in_trash' => __('No Partners found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Partners',
    'menu_icon'   => 'dashicons-welcome-add-page',
  );

    $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_rest' => true,
    'rest_base' => 'partner',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'query_var' => true,
    'rewrite' => array('slug' => 'resources/partner-directory','with_front' => false),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'can_export' => true,
    'show_in_nav_menus' => true,
    'supports' => array( 'title', 'thumbnail' )
  );

    register_post_type('partner', $args);
}

// hook into the init action and call create_book_taxonomies when it fires
add_action('init', __NAMESPACE__ . '\\partner_taxonomies', 0);

function partner_taxonomies()
{
    $labels = array(
        'name'              => _x('Region', 'Taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Region', 'Taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Regions', 'textdomain'),
        'all_items'         => __('All Regions', 'textdomain'),
        'parent_item'       => __('Parent Region', 'textdomain'),
        'parent_item_colon' => __('Parent Region:', 'textdomain'),
        'edit_item'         => __('Edit Region', 'textdomain'),
        'update_item'       => __('Update Region', 'textdomain'),
        'add_new_item'      => __('Add New Region', 'textdomain'),
        'new_item_name'     => __('New Region Name', 'textdomain'),
        'menu_name'         => __('Region', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'meta_box_cb'       => false,
        'query_var'         => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'rewrite'           => array(
                                'slug' => 'resources/partner-directory/by-region', 'with_front' => false ),
    );

    register_taxonomy('region', array( 'partner' ), $args);

    $labels = array(
        'name'              => _x('Country', 'Taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Country', 'Taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Countries', 'textdomain'),
        'all_items'         => __('All Countries', 'textdomain'),
        'parent_item'       => __('Parent Country', 'textdomain'),
        'parent_item_colon' => __('Parent Country:', 'textdomain'),
        'edit_item'         => __('Edit Country', 'textdomain'),
        'update_item'       => __('Update Country', 'textdomain'),
        'add_new_item'      => __('Add New Country', 'textdomain'),
        'new_item_name'     => __('New Country Name', 'textdomain'),
        'menu_name'         => __('Country', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'meta_box_cb'       => false,
        'query_var'         => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'rewrite'           => array(
                                'slug' => 'resources/partner-directory/by-country', 'with_front' => false ),
    );

    register_taxonomy('country', array( 'partner' ), $args);
}

// Campaign (label) & campaign (registered custom post type name)
add_action('init', __NAMESPACE__ . '\\campaign_custom_post_type');
function campaign_custom_post_type()
{
    $labels = array(
    'name' => _x('Campaign', 'Post type general name'),
    'singular_name' => _x('Campaign', 'Post type singular name'),
    'add_new' => __('Add New', 'Campaign'),
    'add_new_item' => __('Add New Campaign'),
    'edit_item' => __('Edit Campaign'),
    'new_item' => __('New Campaign'),
    'all_items' => __('All Campaigns'),
    'view_item' => __('View Campaign'),
    'search_items' => __('Search Campaigns'),
    'not_found' =>  __('No Campaigns found'),
    'not_found_in_trash' => __('No Campaigns found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Campaigns',
    'menu_icon'   => 'dashicons-welcome-add-page',
  );

    $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_rest' => true,
    'rest_base' => 'campaign',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'query_var' => true,
    'rewrite' => array('slug' => 'campaign','with_front' => false),
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => true,
    'menu_position' => null,
    'can_export' => true,
    'show_in_nav_menus' => true,
    'supports' => array( 'title', 'thumbnail' )
  );

    register_post_type('campaign', $args);
}


// hook into the init action and call create_book_taxonomies when it fires
add_action('init', __NAMESPACE__ . '\\internal_taxonomies', 0);

function internal_taxonomies()
{
    $labels = array(
        'name'              => _x('Internal Analytics', 'Taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Internal Analytics', 'Taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Internal Analytics', 'textdomain'),
        'all_items'         => __('All Analytics', 'textdomain'),
        'parent_item'       => __('Parent Analytic', 'textdomain'),
        'parent_item_colon' => __('Parent Analytic:', 'textdomain'),
        'edit_item'         => __('Edit Internal Analytic', 'textdomain'),
        'update_item'       => __('Update Internal Analytic', 'textdomain'),
        'add_new_item'      => __('Add New Internal Analytic', 'textdomain'),
        'new_item_name'     => __('New Internal Analytic Name', 'textdomain'),
        'menu_name'         => __('Internal Analytics', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'meta_box_cb'       => false,
        'query_var'         => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'show_ui'           => true,
        'rewrite'           => false,
    );

    register_taxonomy('internal_analytic', array( 'post', 'page' ), $args);
}
