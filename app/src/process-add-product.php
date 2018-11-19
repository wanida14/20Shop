<?php
    require('connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $product_id = $_POST['product_id'];
        $member_id = $_POST['member_id'];
        $date = date("Y-m-d");

        $sql = "INSERT INTO orders (product_id, member_id, date)
                    VALUES ('$product_id', '$member_id', '$date')";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: ../../public/index.php");
            } 
    }
?>