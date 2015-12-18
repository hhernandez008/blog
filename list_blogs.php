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
		'tag' =>
		[
			'value' => '',
			'regex_error' => 'Invalid tag entered.',
			'error' => 'No blogs listed under this tag.'
		],
		'count' =>
		[
			'value' => '',
			'regex_error' => 'Invalid count number entered.',
			'error' => 'Something bad happened with count.'
		],
		'auth_token' =>
		[
			'value' => '',
			'regex_error' => 'You don\'t have the access privileges to view this blog.',
			'expired' => 'Login session expired.',
			'private' => 'You don\'t have the access privileges to view this blog.',
			'error' => 'No blogs for this user.'
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
	if ($key == 'count')
		$input[$key]['value'] = makeSafeInt($value);
	else
		$input[$key]['value'] = makeSafeString($value);

	if (!testValidEntry($key, $input[$key]['value']))
	{
		array_push($response['errors'], $input[$key]['regex_error']);
	}
}

// Check for empty fields
$empty_tag = strlen($input['tag']['value']) == 0;
$empty_count = $input['count']['value'] == 0;
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
		// if invalid tag, then let user know and don't use tag condition
		// if no count set, then list all blogs
		// List by timestamp created, descending
		$query =
			"SELECT DISTINCT(bi.id), bi.uid, bi.time_created, bt.title, bt.text, bt.tags, bi.status_flags
			FROM logins, blog_infos as bi, blog_texts as bt, tags
			WHERE bi.id=bt.biid";

		$extra_queries =
			[
				($empty_tag ? "" : " AND INSTR(bt.tags, (SELECT CONCAT(SPACE(1), (SELECT tags.id FROM tags WHERE tag='" . $input['tag']['value'] . "'), ',')))!=0"),
				($empty_auth_token ? " AND (bi.status_flags&&" . $PUBLIC_BLOG . ")=" . $PUBLIC_BLOG : " AND (SELECT logins.uid FROM logins WHERE logins.auth_token='" . $input['auth_token']['value'] . "')=bi.uid"),
				(" AND (bi.status_flags&&" . $DELETED_BLOG . ")!=" . $DELETED_BLOG),
				(" ORDER BY bi.time_created DESC"),
				($empty_count ? "" : " LIMIT " . $input['count']['value'])
			];

		for ($i = 0; $i < count($extra_queries); $i++)
			$query = $query . $extra_queries[$i];

		$result = mysqli_query($conn, $query);
		if ($result && mysqli_num_rows($result) > 0)
		{
			$response['success'] = true;
			while ($row = mysqli_fetch_assoc($result))
			{
				array_push($response['data'],
				[
					'id'=>$row['id'],
					'uid'=>$row['uid'],
					'ts'=>$row['time_created'],
					'title'=>$row['title'],
					'summary'=>generateSummary($row['text'], 100),
					'tags'=>generateTagsArray(strlen($row['tags']) > 0 ? explode(",", $row['tags']) : array()),
					'public'=>($row['status_flags'] & $PUBLIC_BLOG != 0) ? true : false
				]);
			}
		}
		else
		{
			if (!$empty_tag) array_push($response['errors'], $input['tag']['error']);
			if (!$empty_auth_token) array_push($response['errors'], $input['auth_token']['error']);
		}
	}
}

print(json_encode($response));
/******** END MAIN CODE ABOVE ********/
?>