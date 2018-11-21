<?php
session_start();
require('../connect.php');

if ($_POST) {
        // echo 'hello'; exit();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM admins 
                WHERE username = '$username' AND password = '$password'";

        $result = mysqli_query($conn, $sql);
        $admin = mysqli_fetch_array($result);

        $_SESSION['id']        = $admin['id'];
        $_SESSION['username']  = $admin['username'];
        $_SESSION['password']  = $admin['password'];
        $_SESSION['status_id'] = $admin['status_id'];

        header('Location: ../../views/admin/home.php');
    
}

?>
