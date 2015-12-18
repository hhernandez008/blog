<?php
session_start();
$auth_token = $_SESSION['auth_token'];
$response = [];
require('mysql_connect.php');
if ( isset( $_COOKIE[session_name()] ) )
    setcookie( session_name(), '', time()-3600, '/' );
session_unset();
session_destroy();
$query = "UPDATE `logins` SET `auth_token`= '' WHERE logins.auth_token = '{$auth_token}'";
mysqli_query($conn,$query);
if(mysqli_affected_rows($conn) > 0){
    $response['success'] = true;
} else {
    $response['error']['logout'] = 'there was an error logging out.';
}

print(json_encode($response));
header("Location: something.php");
?>