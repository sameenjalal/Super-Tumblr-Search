<?php


/**
 * Connect to the database defined in the macros above.
 */
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

?>
