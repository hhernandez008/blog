<?php
/******** START MAIN CODE BELOW ********/
require('security.php');
require('regextests.php');

$input =
	[
		'email' =>
		[
			'value' => '',
			'regex_error' => 'Please use a valid email address (local@domain.ext)',
			'error' => 'This email is already registered.  You may register a different email for a new account.'
		],
		'display_name' =>
		[
			'value' => '',
			'regex_error' => 'Please enter a username between 2 and 32 alphanumeric or underscore characters',
			'error' => 'This username is already taken.  Please try a different username'
		],
		'password' =>
		[
			'value' => '',
			'regex_error' => 'Please enter a password between 8 and 32 non-whitespace characters.',
			'error' => 'Invalid password.'
		]
	];

$response =
	[
		'success'=>false,
		'data'=>array(),
		'errors'=>array()
	];

foreach($_POST as $key=>$value)
{
	$input[$key]['value'] = makeSafeString($value);
	if (!testValidEntry($key, $input[$key]['value']))
	{
		array_push($response['errors'], $input[$key]['regex_error']);
	}
}

// Only do existence queries if regex tests pass.
if (empty($response['errors']))
{
	foreach($_POST as $key=>$value)
	{
		require_once('querytests.php');
		if (doesEntryExist($key, $input[$key]['value']))
		{
			array_push($response['errors'], $input[$key]['error']);
		}
	}
}

// If we don't pass any existence tests, then exit right away.
if (empty($response['errors']))
{
	require('mysql_connect.php');

	$query =
		"INSERT INTO users (id, email, username, password, date_started)
	VALUES (NULL, '" .$input['email']['value'] . "', '" . $input['display_name']['value'] . "', sha1('" . $input['password']['value'] ."'), NOW())";

	$result = mysqli_query($conn, $query);

	if ($result && mysqli_affected_rows($conn) > 0)
	{
		$new_id = mysqli_insert_id($conn);
		$response['success'] = true;
		$response['data']['uid'] = $new_id;

		$sel_query = "SELECT * FROM users WHERE id='" . $new_id . "'";
		$sel_result = mysqli_query($conn, $sel_query);

		if ($sel_result && mysqli_num_rows($sel_result) > 0)
		{
			while ($row = mysqli_fetch_assoc($sel_result))
			{
				$response['data']['email'] = $row['email'];
				$response['data']['display_name'] = $row['username'];
			}
		}
	}
}
print(json_encode($response));
/******** END MAIN CODE ABOVE ********/
?>