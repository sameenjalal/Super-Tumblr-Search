<?php
require("helpers.php");

function add_to_database($post)
{
	addNewPost(json_encode($post));
	$post_id_arr = getMaxIDOfPost();
	$post_id = $post_id_arr[0]['max_id'];
	if ($post->type === "text")
	{
		add_content($post->body, $post_id);
	}
	else if ($post->type === "photo")
	{
		add_content($post->caption, $post_id);
	}
	else if ($post->type === "quote")
	{
		add_content($post->text, $post_id);
	}
	else if ($post->type === "link")
	{
		add_content($post->title, $post_id);
	}
	else if ($post->type === "chat")
	{
		add_content($post->body, $post_id);
	}
	else if ($post->type === "audio")
	{
		add_content($post->track_name, $post_id);
	}
	else if ($post->type === "video")
	{
		add_content($post->caption, $post_id);
	}
	else if ($post->type === "answer")
	{
		add_content($post->answer, $post_id);
	}
}

function add_content($content, $post_id)
{
	$post_id = (int)$post_id;
	$content = strip_content($content);
	$content_split = explode(" ", $content);
	$word_frequencies = array_count_values($content_split);
	foreach ($word_frequencies as $word => $frequency)
	{
		//print("word: [$word] :: freq: [$frequency]\n\n\n");
		$newlink = array($post_id, $frequency);
		if (!wordInDatabase($word)) 
		{
			$links = array($newlink);
			addNewWord($word, json_encode($links));
		}
		else
		{
			$link_arr = getLink($word);
			$links = json_decode($link_arr[0]['links']);
			$links[] = $newlink;
			updateLink($word, json_encode($links));
		}
	}
}

function strip_content($content)
{
	$search = array("<p>", "</p>", '"', "!", "#", ";", ":", ",", ".", "\n", "\r");
	$content = str_replace($search, " ", $content);
	$spaceReplace = preg_replace("/\s+/", " ", $content);
	$spaceReplace = preg_replace("/\s+/", " ", $spaceReplace);

	$filteredString = preg_replace("/[^0-9a-zA-Z ]/ui", '', $spaceReplace);
	$filteredStringTrim = trim($filteredString);
	return $filteredStringTrim;
}

?>
