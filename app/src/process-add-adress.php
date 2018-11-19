<?php
    require('connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $member_id = $_POST['member_id'];
        $date = date("Y-m-d");
        $order_product_implode = $_POST['order_product_implode']; // id product order
        $order_product_explode = explode(",",$order_product_implode); // aray id product order
        $payment_code = $member_id . date("Ymd-His") ."-". rand(10,100); // 

        $sql = "INSERT INTO payment (member_id, phone, address, name, payment_code, date)
                VALUES ('$member_id', '$phone', '$address' ,'$name', '$payment_code', '$date')";
        $result_payment = mysqli_query($conn, $sql);

        foreach ($order_product_explode as $value) {
            $sql = "UPDATE orders 
                SET payment_code = '$payment_code'
                WHERE id = $value";
            // echo $sql; exit();
            mysqli_query($conn, $sql);

            $sql = "SELECT product_id FROM orders
                    WHERE id = '$value'";
            $result = mysqli_query($conn, $sql);
            $order = mysqli_fetch_array($result);
            $product_id = $order['product_id'];

            $sql = "INSERT INTO orders_reserve (product_id, payment_code, member_id)
                    VALUES ('$product_id', '$payment_code', '$member_id')";

            $result = mysqli_query($conn, $sql);
        }
        
        if ($result_payment) {
            header("Location: ../views/pay_orders.php?payment_code=$payment_code");
        } 
    }
?>