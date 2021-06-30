<?php

add_action('wp_enqueue_scripts', 'headerWpUrls');
function headerWpUrls() {
    if (!is_admin()) {

        // #### WP URLS ####
        $street = get_field('street', 'options');
        $postCode = get_field('postCode', 'options');
        $place = get_field('place', 'options');
        $adress = '';
        if(isset($street) && $street != '' && isset($postCode) && $postCode != '' && isset($place) && $place != ''){
            $adress = $street.' '.$postCode.' '.$place;
        }

        $wpUrl = array(
            'template_dir' => get_template_directory_uri(),
            'categoryID' => get_query_var('cat'),
            'globalIds' => json_encode($GLOBALS['ownId']),
            'isHome' => is_front_page(),
            'adress' => $adress,
            'mapBoxToken' => $GLOBALS['mapBoxToken'],
            'ajaxObj' => admin_url('admin-ajax.php')
        );

        if(function_exists('icl_object_id')){
            $wpUrl['pageID'] = icl_object_id( get_the_ID() , 'page', true, ICL_LANGUAGE_CODE);
        }

        wp_localize_script('html5blankscripts', 'wp_urls', $wpUrl);
    }
}
