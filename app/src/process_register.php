<?php
    require('connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $name     = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $birthday = $_POST['birthday'];
        $tel      = $_POST['tel'];
        $email    = $_POST['email'];
        $address  = $_POST['address'];

        $sql = "INSERT INTO member (name, username, password, birthday, tel, email, address)
                VALUES ('$name', '$username', '$password' ,'$birthday', '$tel','$email', '$address')";
        $result= mysqli_query($conn, $sql);

        header("Location: ../../public/index.php?text_register='success'");
    }
?>