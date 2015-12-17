<?php

function doesEntryExist($key, $value)
{
	require('mysql_connect.php');

	$query_tests =
	[
		'email' => "SELECT * FROM users WHERE email='",
		'display_name' => "SELECT * FROM users WHERE username='",
		'auth_token' => "SELECT * FROM logins WHERE auth_token="
	];

	if (!isset($query_tests[$key])) return false;

	$query_tests[$key] = $query_tests[$key] . $value . "'";

	if (mysqli_query($conn, $query_tests[$key]) && mysqli_num_rows($conn) > 0)
	{
		return true;
	}
	return false;
}

function didEntryExpire($key, $value, $duration)
{
	require('mysql_connect.php');

	$query_tests =
	[
		'auth_token' => "
			SELECT id, login_timestamp
			FROM logins WHERE auth_token='",
		'deleted' => "
			SELECT id, time_deleted
			FROM blog_infos WHERE id='"
	];

	if (!isset($query_tests[$key])) return false;

	$query_tests[$key] = $query_tests[$key] . $value . "'";

	if (mysqli_query($conn, $query_tests[$key]) && mysqli_num_rows($conn) > 0)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			if (time() - $row['login_timestamp'] > $duration)
				return true;
		}
	}
	else
	{
		return true;
	}
	return false;
}
?>