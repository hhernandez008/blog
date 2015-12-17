<?php
//require_once('');
require('regextests.php');
session_start();
$conn = mysqli_connect('localhost', 'root', 'root', 'lfz_blog');

$id = (int)$_POST['id']; //$_POST instead?
//$id = 1; //test value
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$profile_img = $_POST['profile_img'];

$auth_token = $_SESSION['auth_token'];
$response = ['success' => false];
$duration = '';
//$check_auth_query = "SELECT uid FROM logins WHERE `auth_token` = '{$auth_token}'";
//$check_auth_row = mysqli_query($conn, $check_auth_query);


//function verify_password($password)
//{
//    $regex_password = '/^[^\s]{8,32}$/';
//
//    if (!preg_match($regex_password, $password)) {
//        $response['errors']['password'] = 'please enter a valid password';
//    }
//}

if (doesEntryExist('auth_token', $auth_token) && !didEntryExpire('auth_token', $auth_token, $duration)) {

    $response['success'] = true;

    if (!empty($username)) {
        if (testValidEntry('display_name', $username)) {
            $fixed_username = makeSafeString($username);
            $username_query = "UPDATE `users` SET `username` = '{$fixed_username}' WHERE id` = $id";
            mysqli_query($conn, $username_query);
            if (mysqli_affected_rows($conn)) {
                $response['success'] = true;
            }
        } else {
            $response['success'] = false;
            $response['errors']['username'] = 'not a valid username.';
        }

    }

}
//response code
if (!empty($response['errors'])) {
    //$query = "SELECT u.id AS user_ID, l.auth_token AS auth_token, u.username AS username, u.password AS password, a.pic AS picture FROM users as u JOIN avatars as a on u.id = a.uid";
    $query = "SELECT u.id, u.email, u.username, a.pic, l.login_timestamp, l.is_logged_in, u.recent_posts
              FROM users as u
              JOIN avatars as a ON u.ID = a.uid
              JOIN logins as l ON l.uid = u.ID";
    $rows = mysqli_query($conn, $query);

    if (mysqli_num_rows($rows) > 0) {
        while ($row = mysqli_fetch_assoc($rows)) {
            $output[] = $row;
        }
        $response['data'] = $output;
    }
}

print(json_encode($response));
?>