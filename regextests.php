<?php

function testValidEntry($key, $value)
{
	$regex_tests =
	[
		'email' => "/^([A-Za-z0-9!#$%&'*\+\-\/\=?^_`{|}~]+)(\.?[A-Za-z0-9!#$%&'*\+\-\/\=?^_`{|}~]+)*(@)([A-Za-z0-9!#$%&'*\+\-\/\=?^_`{|}~]+)(\.?[A-Za-z0-9!#$%&'*\+\-\/\=?^_`{|}~]+)*$/",
		'display_name' => '/^[A-Za-z0-9_]{1,32}$/',
		'password' => '/^.{8,32}$/',
		'fName' => '/^[A-Za-z\- ]{1,32}$/',
		'lName' => '/^[A-Za-z\- ]{1,32}$/',
	];

	// If the key doesn't exist, then we don't need to test this.
	if (!isset($regex_tests[$key])) return true;

	return preg_match($regex_tests[$key], $value);
}

?>