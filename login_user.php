<?php

/******** START MAIN CODE BELOW ********/
require('security.php');
require('regextests.php');

$input =
	[
		'email' =>
		[
			'value' => '',
			'error' => 'Incorrect email address and/or incorrect password'
		],
		'password' =>
		[
			'value' => '',
			'error' => 'Incorrect email address and/or incorrect password'
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
		array_push($response['errors'], $input[$key]['error']);
		break;
	}
}

if (empty($response['errors']))
{
	require('mysql_connect.php');

	$query = "
		SELECT id, username
		FROM users
		WHERE email='" . $input['email']['value'] . "'
			AND password='" . sha1($input['password']['value']) . "'";
	$result = mysqli_query($conn, $query);

	if ($result && mysqli_num_rows($result) > 0)
	{
		$response['success'] = true;
		$timestamp = time();
		while ($row = mysqli_fetch_assoc($result))
		{
			$response['data']['uid'] = (int)$row['id'];
			$response['data']['username'] = $row['username'];
			$response['data']['auth_token'] = sha1($_SERVER['REMOTE_ADDR'] . $timestamp);
			break;
		}

		// Add login entry
		$login_query = "
			INSERT INTO logins (id, uid, login_timestamp, login_ip, auth_token)
			VALUES (NULL, '" . $response['data']['uid'] . "', '" . $timestamp ."', '" . sha1($_SERVER['REMOTE_ADDR']) . "', '" . $response['data']['auth_token'] . "')";
		$login_result = mysqli_query($conn, $login_query);
		if ($login_result && mysqli_affected_rows($conn) > 0)
		{
			array_push($response['errors'], 'Successfully added login information.');
		}
	}
	else
	{
		array_push($response['errors'], $input[$key]['error']);
	}
}

print(json_encode($response));
/******** END MAIN CODE ABOVE ********/

?>