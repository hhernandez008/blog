<?php
//require_once('');
require('regextests.php');
require('security.php');
session_start();
$conn = mysqli_connect('localhost', 'root', 'root', 'lfz_blog');
$_SESSION = $_POST; //?
$id = (int)$_POST['id']; //$_POST instead?
//$id = 1; //test value
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$profile_img = $_POST['profile_img'];

$auth_token = $_SESSION['auth_token'];
$response = [
    'success' => false,
    'data' => [],
    'errors' => []
];

$duration = '';

if (doesEntryExist('auth_token', $auth_token) && !didEntryExpire('auth_token', $auth_token, $duration)) {
    $response['success'] = true;

    //username regex.
    if (!empty($username)) {
        if (testValidEntry('display_name', $username)) {
            $fixed_username = makeSafeString($username);
            $username_query = "UPDATE `users` SET `username` = '{$fixed_username}' WHERE id = $id";
            mysqli_query($conn, $username_query);
            if (mysqli_affected_rows($conn)) {
                $response['success'] = true;
                $response['data']['id'] = $id;
            }
        } else {
            $response['success'] = false;
            $response['errors']['username'] = 'not a valid username.';
        }
    }
    //password regex
    if (!empty($password)) {
        if (testValidEntry('password', $password)) {
            $fixed_password = makeSafeString($password);
            $encrypted_password = sha1($fixed_password);
            $password_query = "UPDATE `users` SET `password` = '{$encrypted_password}' WHERE id = $id";
            mysqli_query($conn, $password_query);
            if (mysqli_affected_rows($conn)) {
                $response['success'] = true;
                $response['data']['id'] = $id;
            }
        } else {
            $response['errors']['password'] = 'not a valid password.';
        }
    }

    //profile_img regex?

//response code
    if (empty($response['errors'])) {
        //$query = "SELECT u.id AS user_ID, l.auth_token AS auth_token, u.username AS username, u.password AS password, a.pic AS picture FROM users as u JOIN avatars as a on u.id = a.uid";
        $query = "SELECT u.id, u.email, u.username, a.pic, l.login_timestamp
              FROM users as u
              JOIN avatars as a ON u.id = a.uid
              JOIN logins as l ON u.id = l.uid";
        $rows = mysqli_query($conn, $query);

        if (mysqli_num_rows($rows) > 0) {
            while ($row = mysqli_fetch_assoc($rows)) {
                $output[] = $row;
            }
            $response['data'] = $output;
        }
    }
} else{
    $response['errors']['auth_token'] = 'Session invalid';
}
print(json_encode($response));

?>