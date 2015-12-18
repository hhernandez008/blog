<?php
/******** START MAIN CODE BELOW ********/
require('security.php');
require('regextests.php');
require('mysql_connect.php');
require('helper_functions.php');
require('querytests.php');

$PUBLIC_BLOG = 1;
$DELETED_BLOG = 128;
$input =
	[
		'id' =>
		[
			'value' => '',
			'regex_error' => 'Invalid id entered.',
			'error' => 'This blog no longer exists.'
		],
		'auth_token' =>
		[
			'value' => '',
			'regex_error' => 'You don\'t have the access privileges to view this blog.',
			'expired' => 'Login session expired.',
			'private' => 'You don\'t have the access privileges to view this blog.'
		]
	];

$response =
	[
		'success'=>false,
		'data'=>array(),
		'errors'=>array()
	];

// Regex tests
foreach($_POST as $key=>$value)
{
	if ($key == 'id')
		$input[$key]['value'] = makeSafeInt($value);
	else
		$input[$key]['value'] = makeSafeString($value);

	if (!testValidEntry($key, $input[$key]['value']))
	{
		array_push($response['errors'], $input[$key]['regex_error']);
	}
}

// Check for empty auth_token
$empty_auth_token = strlen($input['auth_token']['value']) == 0;

if (empty($response['errors']))
{
	if (!$empty_auth_token && didEntryExpire('auth_token', $input['auth_token']['value'], 1209600))
	{
		array_push($response['errors'], $input['auth_token']['expired']);
	}
	else
	{
		// if $empty_auth_token, SQL for public mask for status flags.
		$query =
			"SELECT bi.id, bi.uid, bi.time_created, bi.status_flags, bt.title, bt.text, bt.tags
			FROM blog_infos as bi, blog_texts as bt
			WHERE bi.id=" . $input['id']['value'] . " AND bi.id=bt.biid";
		if ($empty_auth_token)
			$query = $query . " AND (bi.status_flags&&" . $PUBLIC_BLOG . ")=" . $PUBLIC_BLOG;

		$query = $query . " AND (bi.status_flags&&" . $DELETED_BLOG . ")!=" . $DELETED_BLOG;
		$result = mysqli_query($conn, $query);

		if ($result)
		{
			$response['success'] = true;
			if (mysqli_num_rows($result) > 0)
			{
				while ($row = mysqli_fetch_assoc($result))
				{
					$response['data']['id'] = $row['id'];
					$response['data']['uid'] = $row['uid'];
					$response['data']['ts'] = $row['time_created'];
					$response['data']['title'] = $row['title'];
					$response['data']['text'] = $row['text'];
					$response['data']['summary'] = generateSummary($row['text'], 80);
					$response['data']['public'] = ($row['status_flags'] & $PUBLIC_BLOG != 0) ? true : false;

					// Get the tag numbers
					$tags = strlen($row['tags']) > 0 ? explode(",", $row['tags']) : array();
					$response['data']['tags'] = generateTagsArray($tags);
				}
			}
			else
			{
				array_push($response['errors'], $input['auth_token']['private']);
			}
		}
		else
		{
			array_push($response['errors'], $input['id']['error']);
		}
	}
}

print(json_encode($response));
/******** END MAIN CODE ABOVE ********/
?>