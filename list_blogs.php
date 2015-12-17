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
		'tag' =>
		[
			'value' => '',
			'regex_error' => 'Invalid tag entered.',
			'error' => 'No blogs listed under this tag.'
		],
		'count' =>
		[
			'value' => '',
			'regex_error' => 'You don\'t have the access privileges to view this blog.',
			'expired' => 'Login session expired.',
			'private' => 'You don\'t have the access privileges to view this blog.'
		]
	];

/******** END MAIN CODE ABOVE ********/
?>