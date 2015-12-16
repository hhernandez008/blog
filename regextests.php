<?php

function testValidEntry($key, $value)
{
	$regex_tests = 
	[
		'email' => "/^([A-Za-z0-9!#$%&'*\+\-\/\=?^_`{|}~]+)(\.?[A-Za-z0-9!#$%&'*\+\-\/\=?^_`{|}~]+)*(@)([A-Za-z0-9!#$%&'*\+\-\/\=?^_`{|}~]+)(\.?[A-Za-z0-9!#$%&'*\+\-\/\=?^_`{|}~]+)*$/",
		'display_name' => '/^[A-Za-z0-9_]{1,32}$/',
		'password' => '/^.{8,32}$/'
	];
	
	return preg_match($regex_tests[$key], $value);
}

?>