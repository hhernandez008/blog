<?php
//require_once('');
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
$check_auth_query = "SELECT uid FROM logins WHERE `auth_token` = '{$auth_token}'";
$check_auth_row = mysqli_query($conn, $check_auth_query);

function verify_username($username)
{
    $regex_username = '/^[a-zA-Z0-9_]{1,32}$/';

    if (preg_match($regex_username, $username)) {
        $regexedusername = stripslashes($username);
        return htmlentities($regexedusername);
    } else {
        $response['errors']['username'] = 'please enter a valid username';
    }
}

function verify_email($email)
{
    $regex_email = '/^([A-Za-z0-9!#$%&\'*\+\-\/\=?^_`{|}~]+)(\.?[A-Za-z0-9!#$%&\'*\+\-\/\=?^_`{|}~]+)*(@)([A-Za-z0-9!#$%&\'*\+\-\/\=?^_`{|}~]+)(\.?[A-Za-z0-9!#$%&\'*\+\-\/\=?^_`{|}~]+)*$/';

    if (preg_match($regex_email, $email)) {
        $regexedemail = stripslashes($email);
        return htmlentities($regexedemail);
    } else {
        $response['errors']['email'] = 'please enter a valid email';
    }
}

function verify_password($password)
{
    $regex_password = '/^[^\s]{8,32}$/';

    if (!preg_match($regex_password, $password)) {
        $response['errors']['password'] = 'please enter a valid password';
    }
}

if (mysqli_num_rows($check_auth_row) > 0) {
    $response['success'] = true;

    if (!empty($email)) {
        $fixed_email = verify_email($email);
        if ($_SESSION['errors']['email']) {
            //do I need ['email']?
            $response = ['success' => false, 'error' => "{$_SESSION['errors']['email']}"];
            print json_encode($response);
            //maybe header();
        } else if ($fixed_email) {
            //change email table?
            $email_query = "UPDATE `users` SET `email` = '{$fixed_email}' WHERE `id` = $id";
            mysqli_query($conn, $email_query);
        }
    }

    if (!empty($username)) {
        $fixed_username = verify_username($email);

        if ($_SESSION['errors']['username']) {
            $response = ['success' => false, 'error' => "{$_SESSION['errors']['username']}"];
            print json_encode($response);
        } else if ($fixed_username) {
            $username_query = "UPDATE `users` SET `username` = '{$fixed_username}' WHERE id` = $id";
            mysqli_query($conn, $username_query);
        }
    }

//escape keys necessary?
    if (!empty($password)) {
        $fixed_password = verify_username($password);

        if ($_SESSION['errors']['password']) {
            $response = ['success' => false, 'errors' => "{$_SESSION['errors']['password']}"];
            print json_encode($response);
        } else if ($fixed_password) {
            //do query
            $password_query = "UPDATE `users` SET `password` = '{$fixed_password}' WHERE `id` = $id";
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