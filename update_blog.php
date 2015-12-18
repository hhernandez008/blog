<?php
require('querytests.php');

$biid = $_POST['biid']; //blog id;
$title = $_POST['title'];
$text = $_POST['text'];
$tags = $_POST['tags'];
$public = $_POST['public']; //is this where situation_flags comes in?
$time = time();
$response = [
    'success' => false,
    'data' => [],
    'errors' => []
];
$auth_token = $_POST['auth_token'];
$duration = 600;
//need info for $duration.
if (doesEntryExist('auth_token', $auth_token) && !didEntryExpire('auth_token', $auth_token, $duration)) {
    $query_update_blog_info = "UPDATE blog_texts, blog_infos
                                SET blog_texts.title = '{$title}', blog_infos.date_modified = '{$time}', blog_texts.text = '{$text}'
                                WHERE blog_infos.biid = '{$biid}' AND blog_texts.biid = blog_infos.id";
    mysqli_query($conn, $query_update_blog_info);
    if(mysqli_affected_rows($conn) > 0){
        $response['success'] = true;
        $query_biid = "SELECT `id` FROM `blog_texts` WHERE `biid` = '{$biid}'";
        $rows = mysqli_query($conn, $query_biid);
        if (mysqli_num_rows($rows) > 0){
            while ($row = mysqli_fetch_assoc($rows)){
                $response['data']['id'] = $row['id'];
            }
        } else {
            $response['success'] = false;
            $response['errors']['update'] = 'failed to update entry.';
        }
    }
} else {
    $response['success'] = false;
    $response['errors']['auth_token'] = 'Session is not valid';
}

print(json_encode($response));

?>