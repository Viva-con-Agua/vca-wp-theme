<?php

// Disable WP REST API JSON endpoints if user not logged in
add_filter('rest_authentication_errors', 'chuck_disable_rest_endpoints');
function chuck_disable_rest_endpoints( $access ) {
    if(!is_user_logged_in()){
        return new WP_Error( 'rest_cannot_access', __( 'Only authenticated users can access the REST API.', 'disable-json-api' ), array( 'status' => rest_authorization_required_code() ) );
    }
    return $access;
}

// Remove REST API info from head and headers
remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
