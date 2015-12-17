<?php
/******** START MAIN CODE BELOW ********/
require('security.php');
require('regextests.php');
require('mysql_connect.php');
require('helper_functions.php');
require('querytests.php');

$PUBLIC_BLOG = 1;

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
	if (gettype(value) == "integer")
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
			$query = $query . " AND bi.status_flags&&" . $PUBLIC_BLOG . "=" . $PUBLIC_BLOG;

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
					$response['data']['tags'] = array();
					if (count($tags) > 0)
					{
						// Get the tag names.
						$tag_query = "SELECT * FROM tags WHERE";
						for ($i = 0; $i < count($tags) - 1; $i++)
						{
							if ($i == 0)
								$tag_query = $tag_query . " id=" . $tags[$i];
							else
								$tag_query = $tag_query . " OR id=" . $tags[$i];
						}

						$tag_result = mysqli_query($conn, $tag_query);
						if ($tag_result && mysqli_num_rows($tag_result) > 0)
						{
							while ($tag_row = mysqli_fetch_assoc($tag_result))
							{
								array_push($response['data']['tags'], $tag_row['tag']);
							}
						}
					}
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