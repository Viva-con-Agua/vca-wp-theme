<?php // global Id's
$globalIds = get_global_option('global_ids');
if(is_array($globalIds) && count($globalIds) > 0 && $globalIds != '') {
    foreach ($globalIds as $globalId) {
        if(function_exists('icl_object_id')){
            // INKLUSIVE WPML
            $GLOBALS['ownId'][$globalId['name']] = icl_object_id($globalId['id'], $globalId['typ'], true, ICL_LANGUAGE_CODE);
        } else {
            // Normal, ohne WPML
            $GLOBALS['ownId'][$globalId['name']] = $globalId['id'];
        }
    }
}else{
    $GLOBALS['ownId'] = [];
}

/**
 * Advanced Custom Fields Options function
 * Always fetch an Options field value from the default language
 */
function cl_acf_set_language() {
    return acf_get_setting('default_language');
}

function get_global_option($name) {
    add_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
    $option = get_field($name, 'option');
    remove_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
    return $option;
}

// ACF options page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}

// ACF Custom json Path for Sync
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    // return
    return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    // return
    return $paths;
}

acf_add_options_sub_page(array(
	'page_title' 	=> 'Presse Archiv Einstellungen',
    'menu_title'	=> 'Presse Archiv Einstellungen',
    'menu_slug'     => 'press-archive-options',
    'parent_slug'	=> 'edit.php?post_type=presse',
    'capability'	=> 'edit_posts',
    'redirect'		=> false,
    'position'      => false,
    'icon_url'      => false,
    'post_id' 		=> 'presse__Archive__options'
));

// ACF EXTENSION PARENT CAT SELECTOR
include('ACF-etend-parent-cat-selector.php');
