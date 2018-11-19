<?php
session_start();

require('connect.php');

if ($_POST) {
// echo 'hello'; exit();
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM member 
        WHERE username = '$username' AND password = '$password'";

$result = mysqli_query($conn, $sql);
$member = mysqli_fetch_array($result);

$_SESSION['id'] = $member['id'];
$_SESSION['username'] = $member['username'];
$_SESSION['password'] = $member['password'];
$_SESSION['status_id'] = $member['status_id'];

header('Location: ../../public/index.php');
    
}

?>
