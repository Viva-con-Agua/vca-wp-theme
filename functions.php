<?php

// Gutenberg Block Functions
include('inc/gutenberg.php');

// Global Vars
include('inc/globals.php');

// ACF Functions
if(class_exists('ACF')){
    include('inc/acfSettings.php');
}

// WooCommercer Functions
if(class_exists('WooCommerce')){
    include('inc/woocommerceSettings.php');
}

// Yoast Functions
if(class_exists('WPSEO_Frontend')){
    include('inc/yoastSettings.php');
}

// Enqueue Scripts & Styles
include('inc/enqueue.php');

// Header / Menu Functions
include('inc/header.php');

// Set WP Urls
include('inc/wpUrls.php');

// Wordpress Login Custom
include('inc/login.php');

// Picture Tag Function
include('inc/pictureTag.php');

// Pagination Function
include('inc/pagination.php');

// Pagination Function
include('inc/security.php');

// Tiny MCE Functions
include('inc/tinyMce.php');

// Thumbail Sizes & Theme Supports Functions
include('inc/sizesSupports.php');

// Data rights & Svg allow
include('inc/dataUpload.php');

// Rest Api Settings
// include('inc/restSettings.php');

// Recovery Mail, Disable Functions & Additinal Snipped
include('inc/additional.php');

// Herrlich Media Functions
include('inc/hmFunctions.php');

// Teams Custom Post Type
include('inc/teamPostType.php');

// Volunteer Teams Custom Post Type
if(class_exists('ACF')){
    function my_acf_google_map_api( $api ){
        $api['key'] = get_field('googleMapsToken', 'option');
        return $api;
    }
    add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
};

include('inc/volunteerTeamsPostType.php');

// Press Custom Post Type
include('inc/pressPostType.php');

// Press Custom Post Type
include('inc/registerBlockStyles.php');

?>
