<?php
require('querytests.php');

$uid = $_POST['uid']; //uid.
$title = $_POST['title'];
$text = $_POST['text'];
$tags = $_POST['tags'];
$public = $_POST['public'];
$auth_token = $_POST['auth_token'];

$response = [
    'success' => false,
    'data' => [],
    'errors' => []
];

//$rights = [
//    'create' => 1,
//    'read' => 2,
//    'update' => 4,
//    'delete' => 8
//];

$public_true = 1;
$time = time();
$duration = 600;
//use the function in the if statements instead.
//Where do we get $duration
if (doesEntryExist('auth_token', $auth_token) && !didEntryExpire('auth_token', $auth_token, $duration)) {
    $query_info_flags = "INSERT INTO `blog_infos`(`uid`, `time_created`, `status_flags`) VALUES ('{$uid}', '{$time}', '{$public}')";
    $info_and_flags = mysqli_query($conn, $query_title_flags);

    if (mysqli_affected_rows($info_and_flags) > 0) {
        $biid = mysqli_insert_id($conn);
        //$timestamp = time(); //how to get timestamp of $conn and should I use now() in $query_info_flags?
        $response['success'] = true;
        $response['data']['id'] = $biid;
        //$response['data']['ts'] = $timestamp;
    } else {
        $response['errors']['blog_info'] = 'there was an error in query to get blog info.';
    }
    if (isset($biid)) {
        $text_query = "INSERT INTO `blog_texts`(`biid`, `title`, `text`, `tags`) VALUES ('{$biid}','{$title}','{$text}','{$tags}')";
        $blog_text = mysqli_query($conn, $text_query);
        //nothing else required?
    }
    if (mysqli_affected_rows($blog_text) > 0) {
        $time_query = "SELECT `time_created` FROM `blog_infos` WHERE `biid` = '{$biid}'";
        $time_row = mysqli_query($conn, $time_query);
        if (mysqli_num_rows($time_rows) > 0) {
            while ($row = mysqli_fetch_assoc($time_row)) {
                $response['success'] = true;
                $response['data']['ts'] = $row['time_created'];
            }
        }
    } else {
        //$response['success'] = false;
        $response['errors']['blog_text'] = 'there was an error with the blog texts, time_created not stored.';
    }
} else {
    $response['errors']['auth_token'] = 'session has expired or invalid user authentication.';
}

print json_encode($response);

?>