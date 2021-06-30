<?php

// Globals for Picture Tag
$GLOBALS['breakpointsMin'] = array('1139px', '1023px', '719px', '575px', '0px');
$GLOBALS['baseUrl'] = baseUrl() . '/';


/**
 * Picture Tag Image Function & responsvie sources
 *
 * @param ing       $attachmentId   Input Attachment ID.
 * @param string    $attachmentSize   Input Attachment Default Size.
 * @param string    $classes Input HTML class for Picture Tag.
 * @param array     $sources Input array with strings for breakpoint sizes.
 * @return string   HTML Picture Tag
 * Example echo getPicture(148, 'small', 'lazy', array('biggest', 'large', 'medium', 'small', 'tiny'));
 */
function getPicture($attachmentId, $attachmentSize, $classes = '', $sources = array()){

    $attachmentAlt = get_post_meta($attachmentId, '_wp_attachment_image_alt', TRUE);
    $attachmentTitle = get_the_title($attachmentId);
    $attachmentSrc = wp_get_attachment_image_src($attachmentId , $attachmentSize);
    $attachmentPlaceholderSrc = wp_get_attachment_image_src($attachmentId , 'placeholder');

    $attachmentClass = '';
    if(isset($classes) && $classes !== ''){
        $attachmentClass = 'class="'. $classes .'"';
    }

    $output = '<picture>';
        if(isset($sources) && is_array($sources) && count($sources) > 0){
            for ($i=0; $i < count($sources); $i++) {
                if($GLOBALS['breakpointsMin'][$i] !== ''){
                    $sourcesImgSize = wp_get_attachment_image_src($attachmentId , $sources[$i]);

                    $sourceImgPath = str_replace($GLOBALS['baseUrl'], "", $sourcesImgSize[0]);
                    $sourceImgType = mime_content_type($sourceImgPath);
                    $sourcesImgWebp = str_replace($GLOBALS['baseUrl'], "", $sourcesImgSize[0] .'.webp');

                    // if WebP exists Add Webp for Breakpoint
                    if(file_exists($sourcesImgWebp)){
                        $output .= '<source media="(min-width: '. $GLOBALS['breakpointsMin'][$i] .')" data-srcset="'. str_replace(' ', '%20', $sourcesImgSize[0]) .'.webp" type="image/webp" srcset="'. str_replace(' ', '%20', $attachmentPlaceholderSrc[0]) .'" >';
                    }
                    // Add default for Breakpoint
                    $output .= '<source media="(min-width: '. $GLOBALS['breakpointsMin'][$i] .')" data-srcset="'. str_replace(' ', '%20', $sourcesImgSize[0]) .'" type="'. $sourceImgType .'" srcset="'. str_replace(' ', '%20', $attachmentPlaceholderSrc[0]) .'" >';
                }
            }
        }
        $output .= '<img '. $attachmentClass .' data-src="'. $attachmentSrc[0] .'"  src="'. str_replace(' ', '%20', $attachmentPlaceholderSrc[0]) .'" width="'. $attachmentSrc[1] .'" height="'. $attachmentSrc[2] .'" title="'. $attachmentTitle .'" alt="'. $attachmentAlt .'">';
    $output .= '</picture>';

    return $output;
}

// Get Base Url
function baseUrl(){
    if($_SERVER["HTTP_HOST"] == $GLOBALS['localUrl']){
        return 'http://' . $GLOBALS['localUrl'];
    } else {
        return sprintf(
            "%s://%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME']
        );
    }
}
