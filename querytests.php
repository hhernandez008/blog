<?php

function doesEntryExist($key, $value)
{
	require('mysql_connect.php');

	$query_tests =
	[
		'email' => "SELECT * FROM users WHERE email='",
		'display_name' => "SELECT * FROM users WHERE username='"
	];

	if (!isset($query_tests[$key])) return false;

	$query_tests[$key] = $query_tests[$key] . $value . "'";

	if (mysqli_query($conn, $query_tests[$key]) && mysqli_affected_rows($conn) > 0)
	{
		return true;
	}
	return false;
}
?>