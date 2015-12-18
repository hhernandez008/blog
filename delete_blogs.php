<?php

$delete_blog_entries = $_POST['array'];
$auth_token = $_SESSION['token'];
$time = time();
$response = [
    'success' => false,
    'data' => [],
    'errors' => []
];
$duration = 600;
if (doesEntryExist('auth_token', $auth_token) && !didEntryExpire('auth_token', $auth_token, $duration)) {

    foreach ($delete_blog_entries as $key) {
        $selected_query = "UPDATE blog_infos, blog_texts
                            JOIN blog_texts ON blog_infos.id = blog_texts.biid
                            SET blog_infos.time_deleted ='{$time}', blog_infos.status_flags =[value-7]
                            WHERE blog_infos.id = '{$key}'";

        mysqli_query($conn,$selected_query);

        if (mysqli_affected_rows($conn) > 0) {
            $response['success'] = true;
        } else {
            $response['errors']['delete'] = 'no blog id\'s deleted.';
        }
    }

    $not_deleted_query = "SELECT id FROM blog_texts
                          JOIN blog_infos ON blog_infos.id = blog_texts.biid
                          WHERE blog_infos.time_deleted = ''";
    $rows = mysqli_query($conn,$not_deleted_query);

    if (mysqli_num_rows($rows) > 0){
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