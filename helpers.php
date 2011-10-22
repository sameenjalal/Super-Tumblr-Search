<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

define('DB_USER', 'samjalal');
define('DB_PASS', 'akash123');
define('DB_HOST', 'mysql.sameenjalal.com');
define('DB_NAME', 'sameen_test');

define('DEBUG', 0);
define('SQL_EXPLAIN', 0);

//echo 'REQUEST'; debug_r($_REQUEST);

function debug_r($arr)
{
	if(!DEBUG)
		return;
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

/** This function connects us to the database defined in the macros above. */
function db_connect()
{
	mysql_connect(DB_HOST, DB_USER, DB_PASS);		
	mysql_select_db(DB_NAME);
}

/** This function is equivalent to calling mysql_query(sprintf(query, ...)). It will mysql_real_escape all args after the first arg in sprintf.
 * This is awesome for avoiding SQL injections.
 * You can set sql_explain=1 in the $_REQUEST to debug sql_queries.
 */
function db_query($query)
{
	$num_args = func_num_args();

	$args = array();
	$args[] = $query;

	for($i = 1; $i < $num_args; $i++)
		$args[] = htmlspecialchars(mysql_real_escape_string(func_get_arg($i)));

	$query = call_user_func_array('sprintf', $args);


	if(DEBUG && @$_REQUEST['sql_explain'] == 1 || SQL_EXPLAIN)
		debug_r('Query: '.$query."\n");

	//debug_r(debug_backtrace());

	$res = mysql_query($query) or die('Mysql Error occurred: '.mysql_error(). '	 File: '.__FILE__. ' Line: '.__LINE__. "\n Query: $query\n");
//	echo "$res";
	return $res;
}


/** This function returns back a list of entries in the table. Each entry is an associative array of stuff.
 * DO NOT USE THIS FOR BIG TABLES
 */
function db_fetch_assoc($res)
{
	$rv = array();
	while($row = mysql_fetch_assoc($res))
		$rv[] = $row;
	
	return $rv;
}

db_connect();
$success = session_start();
if(!$success)
{
	die('Session was not successfully started in '.__FILE__.' on line '.__LINE__);
}

function addNewWord($word, $link)
{
	return db_query("INSERT INTO tumblr_words (word, links) VALUES ('%s', '%s')", $word, $link);
}

function addNewPost($post)
{
	return db_query("INSERT INTO tumblr_post (post) VALUES ('%s')", $post);
}

function getMaxIDOfPost()
{
	$query = "SELECT MAX(id) as max_id FROM tumblr_post";
	$arr = db_fetch_assoc(db_query($query));
	return $arr;
}

function updateLink($word, $link)
{
	$query = "UPDATE tumblr_words SET links='$link' WHERE word='$word'";
	return db_query($query);
}

function getLink($word)
{
	$query = "SELECT links FROM tumblr_words WHERE word='$word'";
	return db_fetch_assoc(db_query($query));
}

function getPost($post_id)
{
	$query = "SELECT post FROM tumblr_post WHERE id=$post_id";
	return db_fetch_assoc(db_query($query));
}

function wordInDatabase($word)
{
	$query = "SELECT word FROM tumblr_words WHERE word='$word'";
	$result = db_fetch_assoc(db_query($query));
	if (empty($result))
		return false;
	return true;
}
