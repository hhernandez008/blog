<?php
function generateSummary($text, $summary_length)
{
	return ($summary_length < strlen($text) ? substr($text, 0, $summary_length) . "...": $text);
}

function generateTagsArray($tags)
{
	require('mysql_connect.php');

	$ret_arr = array();
	if (count($tags) > 0)
	{
		// Get the tag names.
		$tag_query = "SELECT * FROM tags WHERE";
		for ($i = 0; $i < count($tags) - 1; $i++) // Last element is just blank, so ignore it.
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
				array_push($ret_arr, $tag_row['tag']);
			}
		}
	}
	return $ret_arr;
}
?>