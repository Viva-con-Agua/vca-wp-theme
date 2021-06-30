<?php

// Allowe SVG
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function cc_ignore_upload_ext($checked, $file, $filename, $mimes){
    if (!$checked['type']) {
        $wp_filetype = wp_check_filetype( $filename, $mimes );
        $ext = $wp_filetype['ext'];
        $type = $wp_filetype['type'];
        $proper_filename = $filename;

        if ($type && 0 === strpos($type, 'image/') && $ext !== 'svg') {
            $ext = $type = false;
        }

        $checked = compact('ext','type','proper_filename');
    }
    return $checked;
}
add_filter('wp_check_filetype_and_ext', 'cc_ignore_upload_ext', 10, 4);

