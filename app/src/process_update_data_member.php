<?php
    require('connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sql = "UPDATE member 
                SET name = '$name', 
                username = '$username', 
                password = '$password',
                birthday = '$birthday',
                tel      = '$tel',
                email    = '$email',
                address  = '$address'
            WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    header("Location: ../views/profile_member.php?update_profile='success'");
?>