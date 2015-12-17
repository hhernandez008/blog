<?php
function generateSummary($text, $summary_length)
{
	return ($summary_length < strlen($text) ? substr($text, 0, $summary_length) : $text);
}
?>