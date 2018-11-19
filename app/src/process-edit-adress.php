<?php
    require('connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $member_id = $_POST['member_id'];
    $payment_code = $_POST['payment_code'];

    $sql = "UPDATE payment 
                SET name = '$name', 
                    phone = '$phone', 
                    address = '$address'
            WHERE member_id = $member_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../views/pay_orders.php?payment_code=$payment_code");
    } 
?>