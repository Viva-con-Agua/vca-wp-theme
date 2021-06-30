<?php


/***************** CATEGORY SELECTOR FÜR POST MIT PARENT CAT *****************/

//ADD RULE TO SECTION
add_filter('acf/location/rule_types', 'acf_location_rules_types');
function acf_location_rules_types( $choices ){
    $choices['Other']['has_parent_cat'] = 'Post in Child Category of Parent (inkl. parent)';
    $choices['Other']['is_or_has_parent'] = 'Cat is or has parent Cat';
    $choices['Other']['is_global_id'] = 'Is Post/Page/Category with global ID';
    $choices['Other']['is_global_id_child'] = 'Is Child of Page/Category with global ID';
    $choices['Other']['is_global_id_in_cat_or_child'] = 'Post in Category or Child-Category with global ID';
    return $choices;
}

/***************** Post in Child Category of Parent (inkl. parent) *****************/


//POPULATE LIST WITH OPTIONS
add_filter('acf/location/rule_values/has_parent_cat', 'acf_location_rules_values_has_parent_cat');
function acf_location_rules_values_has_parent_cat( $choices ){

	$categories = get_categories(array('hide_empty'=>0));

	//print_r($categories);
	foreach ($categories as $category):

		$thisCat = get_category($category);
		if($thisCat->category_parent == 0){
			$choices[$thisCat->cat_ID] = $thisCat->name;
		}

	endforeach;

    return $choices;
}

//MATCH THE RULE
add_filter('acf/location/rule_match/has_parent_cat', 'acf_location_rules_match_has_parent_cat', 10, 3);
function acf_location_rules_match_has_parent_cat( $match, $rule, $options ){

	if(isset($_GET['post'])){

		if(function_exists('icl_object_id')){
			$cat = icl_object_id( $rule['value'], 'category', true, ICL_LANGUAGE_CODE);
		}else{
			$cat = $rule['value'];
		}
	    $thisPostId = $_GET['post'];
		$post_categories = wp_get_post_categories( $thisPostId );

		foreach ($post_categories as $oneCat):
			if((get_category($oneCat)->category_parent == $cat) || get_category($oneCat)->cat_ID == $cat) {
				$isChld = 1;
				break;
			}else{
				$isChld = 0;
			}

		endforeach;

		if(isset($isChld)) {
		    if($rule['operator'] == "=="){
				$match = (1 == $isChld);
		    }
		    else if($rule['operator'] == "!="){
		    	$match = (0 == $isChld);
		    }
		}
	}else{
		$match = 0;
	}


    return $match;
};








/***************** IS PARENT CAT OR HAS PARENT CAT *****************/


//POPULATE LIST WITH OPTIONS
add_filter('acf/location/rule_values/is_or_has_parent', 'acf_location_rules_values_is_or_has_parent');
function acf_location_rules_values_is_or_has_parent( $choices ){

	$categories = get_categories(array('hide_empty'=>0));

	foreach ($categories as $category):

		$thisCat = get_category($category);
		if($thisCat->category_parent == 0){
			$choices[$thisCat->cat_ID] = $thisCat->name;
		}

	endforeach;

    return $choices;
}

//MATCH THE RULE
add_filter('acf/location/rule_match/is_or_has_parent', 'acf_location_rules_match_is_or_has_parent', 10, 3);
function acf_location_rules_match_is_or_has_parent( $match, $rule, $options ){


	if(isset($_GET['tag_ID'])){

		if(function_exists('icl_object_id')){
			$cat = icl_object_id( $rule['value'], 'category', true, ICL_LANGUAGE_CODE);
		}else{
			$cat = $rule['value'];
		}
		$theCatId = $_GET['tag_ID'];

		if($theCatId == $cat || cat_is_ancestor_of($cat, $theCatId)){
			// FOUND A MATCH
			$isChld = 1;
		}else{
			$isChld = 0;
		}

	    if($rule['operator'] == "=="){
			$match = (1 == $isChld);
	    }
	    else if($rule['operator'] == "!="){
	    	$match = (0 == $isChld);
	    }
	}else{
		$match = 0;
	}


    return $match;
}







function getGlobalIdsForOptions($choices) {

	$globalIds = get_global_option('global_ids');


	if(isset($globalIds) && count($globalIds) > 0 && $globalIds != '') {

	    foreach ($globalIds as $globalId) {
	        // if(function_exists('icl_object_id')){
	        //     // INKLUSIVE WPML
	        //     $id = icl_object_id($globalId['id'], $globalId['typ'], true, ICL_LANGUAGE_CODE);
	        //     $choices[$id.'_'. $globalId['typ']] = $globalId['name'];
	        // } else {
	        //     // Normal, ohne WPML
	        //     $choices[$globalId['id'].'_'. $globalId['typ']] = $globalId['name'];
	        // }
	        $choices[$globalId['name']] = $globalId['name'].' ('.$globalId['id'].', '.$globalId['typ'].')';
	    }
	}
	return $choices;
}



function getInfoFromGlobalIdSlug($slug,$what) {

	$globalIds = get_global_option('global_ids');

	if(isset($globalIds) && count($globalIds) > 0 && $globalIds != '') {

		$cluster = false;

		foreach ($globalIds as $n=>$c) {
            if (in_array($slug, $c)) {
                $cluster = $n;
                break;
            }
        }


	  	return $globalIds[$cluster][$what];
	}
}



/***************** Is Post/Page/Category with global ID *****************/

//POPULATE LIST WITH OPTIONS
add_filter('acf/location/rule_values/is_global_id', 'acf_location_rules_values_is_global_id');
function acf_location_rules_values_is_global_id( $choices ){

	$choices = getGlobalIdsForOptions($choices);
	return $choices;

}

//MATCH THE RULE
add_filter('acf/location/rule_match/is_global_id', 'acf_location_rules_match_is_global_id', 10, 3);
function acf_location_rules_match_is_global_id( $match, $rule, $options ){

	$idType = getInfoFromGlobalIdSlug($rule['value'],'typ');
	$idItem = getInfoFromGlobalIdSlug($rule['value'],'id');

	if(function_exists('icl_object_id')){
		$id = icl_object_id($idItem, $idType, true, ICL_LANGUAGE_CODE);
	}else{
		$id = $idItem;
	}

	if(isset($_GET['post'])){
		$contentId = $_GET['post'];
	}else if(isset($_GET['tag_ID'])) {
		$contentId = $_GET['tag_ID'];
	}

	if(isset($contentId)){

		if(get_post_type() == $idType && $id == $contentId || isset($_GET['tag_ID']) && $id == $contentId) {
			$isContent = 1;
		}else{
			$isContent = 0;
		}

		if($rule['operator'] == "=="){
			$match = (1 == $isContent);
	    }
	    else if($rule['operator'] == "!="){
	    	$match = (0 == $isContent);
	    }

	}else{
		$match = 0;
	}

    return $match;
};






/***************** Is Child of Page/Category with global ID *****************/

//POPULATE LIST WITH OPTIONS
add_filter('acf/location/rule_values/is_global_id_child', 'acf_location_rules_values_is_global_id_child');
function acf_location_rules_values_is_global_id_child( $choices ){
	$choices = getGlobalIdsForOptions($choices);
	return $choices;
}

//MATCH THE RULE
add_filter('acf/location/rule_match/is_global_id_child', 'acf_location_rules_match_is_global_id_child', 10, 3);
function acf_location_rules_match_is_global_id_child( $match, $rule, $options ){

	$idType = getInfoFromGlobalIdSlug($rule['value'],'typ');
	$idItem = getInfoFromGlobalIdSlug($rule['value'],'id');

	if(function_exists('icl_object_id')){
		$id = icl_object_id($idItem, $idType, true, ICL_LANGUAGE_CODE);
	}else{
		$id = $idItem;
	}

	if(isset($_GET['post'])){
		$contentId = $_GET['post'];
	}else if(isset($_GET['tag_ID'])) {
		$contentId = $_GET['tag_ID'];
	}

	if(isset($contentId)){

		if(get_post_type() == $idType && $idType == 'page' && is_page_child($id, $contentId) || isset($_GET['tag_ID']) && term_is_ancestor_of($id, $contentId,$idType)) {
			$isContent = 1;
		}else{
			$isContent = 0;
		}

		if($rule['operator'] == "=="){
			$match = (1 == $isContent);
	    }
	    else if($rule['operator'] == "!="){
	    	$match = (0 == $isContent);
	    }

	}else{
		$match = 0;
	}

    return $match;
};




function is_page_child($pid,$cid) {// $pid = The ID of the page we're looking for pages underneath
  	$anc = get_post_ancestors( $cid );
  	foreach($anc as $ancestor) {
      	if($ancestor == $pid) {
          	return true;
      	}
  	}
};












/***************** Post in Category or Child-Category with global ID *****************/


add_filter('acf/location/rule_values/is_global_id_in_cat_or_child', 'acf_location_rules_values_is_global_id_in_cat_or_child');
function acf_location_rules_values_is_global_id_in_cat_or_child( $choices ){
	$choices = getGlobalIdsForOptions($choices);
	return $choices;
}

//MATCH THE RULE
add_filter('acf/location/rule_match/is_global_id_in_cat_or_child', 'acf_location_rules_match_is_global_id_in_cat_or_child', 10, 3);
function acf_location_rules_match_is_global_id_in_cat_or_child( $match, $rule, $options ){



	if(isset($_GET['post'])){

		$idType = getInfoFromGlobalIdSlug($rule['value'],'typ');
		$idItem = getInfoFromGlobalIdSlug($rule['value'],'id');

		if(function_exists('icl_object_id')){
			$id = icl_object_id($idItem, $idType, true, ICL_LANGUAGE_CODE);
		}else{
			$id = $idItem;
		}

	    $thisPostId = $_GET['post'];

		$post_categories = wp_get_post_categories( $thisPostId );

		foreach ($post_categories as $oneCat):

			$thisCat = get_category($oneCat);

			if( ($thisCat->category_parent != 0 && $thisCat->category_parent == $id) || $thisCat->cat_ID == $id) {
				$isChld = 1;

				break;
			}else{
				$isChld = 0;
			}

		endforeach;


	    if($rule['operator'] == "=="){
			$match = (1 == $isChld);
	    }
	    else if($rule['operator'] == "!="){
	    	$match = (0 == $isChld);
	    }
	}else{
		$match = 0;
	}


    return $match;
};











?>
