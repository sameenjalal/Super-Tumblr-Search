<?php

require_once('helpers.php');



function select_item_by_value($toClense)
{
	if( !isset($toClense) ){
		return false;
	}

	$wordsToRemove = array('for', 'and', 'nor', 'but', 'or', 'yet', 'to', 'a', 'the', 'then', 'on', "i", 'what', 'is', 'be');
	$full_post_array = array();

	foreach( $toClense as $word ) {
		if( !in_array( $word, $wordsToRemove )) {
			$query = "SELECT * FROM tumblr_words WHERE word='$word' LIMIT 1";
			$word_row = db_fetch_assoc(db_query($query));
			if ($word_row) {
				array_push( $full_post_array, $word_row[0]['links'] );
			}
			else {
				//print_r("Array is empty");
			}
		}
	}
	return $full_post_array;
}

$query=$_REQUEST;

if( !$query ) {
	return false;
}

$spaceReplace = preg_replace("/\s+/", " ", $query['data']);
$spaceReplace = preg_replace("/\s+/", " ", $spaceReplace);

$filteredString = preg_replace("/[^0-9a-zA-Z ]/ui", '', $spaceReplace);
$filteredStringTrim = trim($filteredString);
$terms=explode(" ", $filteredStringTrim);

$posts = select_item_by_value($terms);

$master = array();
$tempArray = array();
foreach($posts as $post) {
	$tempArray = json_decode($post);
	foreach($tempArray as $linkPair) {
		if (array_key_exists($linkPair[0], $master)) {
			$master[$linkPair[0]] += $linkPair[1];
		}
		else {
			$master[$linkPair[0]] = $linkPair[1];
		}
	}
}
arsort($master);
$postIds = array_keys($master);//postIds is array of post Id's
//$postIds = array_unique($postIds);
$postText = array();
$return_master = array();
foreach($postIds as $postId) {
	$postText = getPost($postId);
	$postAct = $postText[0]['post'];
	//$postToAdd = getPost($postId);
	//print_r($postAct);	
	$clean = html_entity_decode($postAct, ENT_QUOTES, "UTF-8");
	$clean = html_entity_decode($clean, ENT_NOQUOTES);
	$clean = html_entity_decode($clean, ENT_NOQUOTES, "UTF-8");
	$clean = json_decode($clean);
	$return_master[] = $clean;
}
/*
//$no_dups = array();
//print_r($return_master[0]->$id);
foreach($return_master as $dupeObj)
{
	//alert($return_master[0]);
	if (!array_key_exists($dupeObj->id, $no_dups))
	   $no_dups[$dupeObj->id] = $dupeObj;
}
//print_r($no_dups);
//print_r("Master\n");
*/
$json_return_master = json_encode($return_master);
//$json_return_master = json_encode($no_dups);

print_r($json_return_master);
?>

