<?php
// Theme Support for WooCommerce
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Remoce Actions from Single Content Product
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 30 );

// Price mit ab
add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);
function custom_variation_price( $price, $product ) {
    $price = '';
    $price .= '<span class="startingFrom">'.__('ab','vca').'</span>'.wc_price($product->get_price());
    return $price;
}

// Tel kein Pflichtfeld
add_filter( 'woocommerce_billing_fields', 'kb_no_required_phone', 10, 1 );
function kb_no_required_phone( $address_fields ) {
    $address_fields['billing_phone']['required'] = false;
    return $address_fields;
}
