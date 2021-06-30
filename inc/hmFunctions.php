<?php

// get titel
function hmGetTitle() {
    if (is_category()) {
        $category = get_category(get_query_var('cat'));
        $title = $category->name;
    } else if (is_archive()) {
        $title = get_the_archive_title();
    } else {
        $title = get_the_title();
    }
    return $title;
}

// get the Id
function hmGetId() {
    if (is_category()) {
        $category = get_category(get_query_var('cat'));
        $theID = 'category_'.$category->term_id;
    } else if (is_archive()) {
        $queryObject = get_queried_object();
        $theID = $queryObject->name . '__Archive__options';
    } else {
        $theID = get_the_ID();
    }
    return $theID;
}

// Get Term Id
function hmGetTermId() {
    if (is_category()) {
        $category = get_category(get_query_var('cat'));
        $termId = $category->term_id;
    } else {
        $termId = '';
    }
    return $termId;
}
