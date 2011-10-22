<?php 
require("add_to_database.php");

$consumer_key = "SFykvXo0udlCkkBREheLrmnhXwkyC9acw7UFjSCN9R1m78jGnc";
$secret_key = "3Jx75BM2YE4BbTI5AXqgSJ1UYSIX7m5x2yKSAWWc2lUiigRJvV";
$signature_method = "HMAC-SHA1";

$offset = 0;
while (1)
{
	$posts_in_response = 0;
	$ch = curl_init(); 
	#$url = "http://www.tumblr.com/oauth/request_token?api_key=$consumer_key";
	$url = "http://api.tumblr.com/v2/blog/grardb.tumblr.com/posts?api_key=$consumer_key&offset=$offset";
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

	curl_setopt($ch, CURLOPT_HEADER, $signature_method); 

	$posts = curl_exec($ch);
	curl_close($ch);


	if( isset($posts) ) {
		$posts = json_decode($posts);
	}
	else {
		print("\nDone fucked up now\n");
		return false;
	}
	//print_r(json_decode($posts));

	$posts = $posts->response;
	$posts = $posts->posts;
	foreach ($posts as $post)
	{
		print_r("Adding post ");
		print_r($posts_in_response + $offset);
		print_r("\n");
		add_to_database($post);
		$posts_in_response++;
	}
	if ($posts_in_response < 20)
		break;
	$offset += 20;
}
print_r("DONE!\n");

?>
