<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    $id = $_GET['id'];
    $payment_code = $_GET['payment_code'];

    $sql = "DELETE FROM payment WHERE id = $id";
    $result_payment = mysqli_query($conn, $sql);

    $sql = "DELETE FROM orders_reserve WHERE payment_code = '$payment_code'";
    // echo $sql; exit();
    $result_orders_reserve = mysqli_query($conn, $sql);
    
    header("Location: ../../views/admin/order.php?delete_payment='success'");
?>