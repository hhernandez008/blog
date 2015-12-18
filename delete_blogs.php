<?php
require('querytests.php');

$delete_blog_entries = $_POST['blog_ids'];
$auth_token = $_POST['auth_token'];
$time = time();
$response = [
    'success' => false,
    'data' => [],
    'errors' => []
];
$duration = 600;
$deleted = 8;
if (doesEntryExist('auth_token', $auth_token) && !didEntryExpire('auth_token', $auth_token, $duration)) {

    foreach ($delete_blog_entries as $key) {
        $selected_query = "UPDATE blog_infos
                            SET time_deleted ='{$time}'
                            WHERE blog_infos.id = '{$key}'";

        mysqli_query($conn, $selected_query);

        if (mysqli_affected_rows($conn) > 0) {
            $response['success'] = true;
        } else if (!isset($response['errors']['delete'])) {
                $response['errors']['delete'] = 'some id\'s not deleted.';
            }
    }

    $not_deleted_query = "SELECT id FROM blog_texts
                          JOIN blog_infos ON blog_texts.biid = blog_infos.id
                          WHERE time_deleted is NULL";
    $rows = mysqli_query($conn, $not_deleted_query);

    if (mysqli_num_rows($rows) > 0) {
        $response['success'] = true;
        while ($row = mysqli_fetch_assoc($rows)) {
            array_push($response['data']['id'], $row['id']);
        }
    } else {
        $response['errors']['id'] = 'no id\'s not deleted.';
    }
} else {
    $response['errors']['auth_token'] = 'Session invalid';
}

print(json_encode($response));

?>