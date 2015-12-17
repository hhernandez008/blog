<?php
$id = $_POST['id']; //blog id.
$title = $_POST['title'];
$text = $_POST['text'];
$tags = $_POST['tags'];
$public = $_POST['public'];
$auth_token = $_SESSION['auth_token'];

$query = "INSERT INTO `blog_infos`(`uid`,`status_flags`) VALUES ([value-2],[value-7])";


    mysqli_query($conn,$query);

?>