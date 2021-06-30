<?php

// Add HTML5 Blank Menu
add_action('init', 'register_html5_menu');
function register_html5_menu() {
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu', 'html5blank'),
            'footer-menu' => __('Footer Menu', 'html5blank'),
            'contact-menu' => __('Kontakt Menu', 'html5blank'),
            'cat1-menu' => __('Kategorie 1 Menu', 'html5blank'),
            'cat2-menu' => __('Kategorie 2 Menu', 'html5blank'),
            'lang-menu' => __('Sprachen Menu', 'html5blank')
        )
    );
}

// HTML5 Blank navigation
function html5blank_nav($location, $walker = '', $depth = 0, $zusatz = '', $before = '') {
    wp_nav_menu(
        array(
            'theme_location' => $location,
            'menu' => '',
            'container' => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id' => '',
            'menu_class' => 'menu',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'before' => '',
            'after' => '',
            'link_before' => $before,
            'link_after' => '',
            'items_wrap' => '<ul id="'.$location.$zusatz.'">%3$s</ul>',
            'depth' => $depth,
            'walker' => $walker
        )
    );
}


class mainMenuWalker extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = Array(), $id = 0) {
        global $wp_query;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $item_output = $args->before;

        $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . $item->title . $args->link_after;
        $item_output .= '</a>';
        if( in_array( 'menu-item-has-children', $classes) ) {
            $item_output .= '<span class="menuPlus"></span>';
        }

        $donateMenu = get_field('donateMenu', $item->ID);
        if (isset($donateMenu) && is_array($donateMenu) && count($donateMenu) > 0) {
            array_push($classes, $donateMenu[0]);
            $item_output .= '<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" width="95.846" height="15.112" viewBox="0 0 95.846 15.112">
                <g transform="translate(-336.866 -7388.158)">
                    <path id="Pfad_338" data-name="Pfad 338" d="M81.3.408l10.48-.733s1.172.035,1.186.843-3.63.618-3.63.618L.357,6.995S-.437,6.121.271,5.762,81.3.408,81.3.408Z" transform="matrix(0.998, 0.07, -0.07, 0.998, 337.928, 7389.273)" fill="#fff" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                    <path id="Pfad_339" data-name="Pfad 339" d="M8.2,0l.778.673c.067.431.139.854.2,1.279.122.9.233,1.8.354,2.693.086.636.171,1.271.275,1.9.12.735.193,1.447-.589,1.967L8.5,8.263c-.87-1.99-.59-4.2-1.256-6.292-1.346.512-2.611,1-3.886,1.472-.767.281-1.546.528-2.323.778a.768.768,0,0,1-.86-.292.626.626,0,0,1,.134-.981.642.642,0,0,1,.236-.115c1.729-.282,3.188-1.3,4.845-1.778A3.1,3.1,0,0,0,6.108.724,4.346,4.346,0,0,1,8.2,0Z" transform="translate(427.086 7388.851) rotate(60)" fill="#fff" stroke="#fff" stroke-width="1"/>
                </g>
            </svg>';
        }


        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');
function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}

// Remove wp_head() injected Recent Comment styles
add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory -> widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}


add_action('init', 'removeHeaderLinks');
function removeHeaderLinks(){
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_header', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'rest_output_link_wp_head');
}
