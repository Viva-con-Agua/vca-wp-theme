<?php

$GLOBALS['localUrl'] = "vca.lokal";
$GLOBALS['mapBoxToken'] = get_field('mapBoxToken', 'options');
$GLOBALS['placeholder'] = get_template_directory_uri().'/assets/img/placeholder.gif';
$placeholder = get_field('placeholder', 'options');

if (isset($placeholder) && $placeholder != '' && is_array($placeholder) && count($placeholder) > 0) {
    $GLOBALS['placeholder'] = $placeholder['sizes']['medium'];
}


