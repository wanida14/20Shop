<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session
    
    if (isset($_POST['payment_status'])) { 
        $payment_status = $_POST['payment_status'];
        $payment_id = $_POST['payment_id'];
        
        $sql = "UPDATE payment 
                SET payment_status = '$payment_status'
            WHERE id = $payment_id";
        
        $result = mysqli_query($conn, $sql);
    
        header("Location: ../../views/admin/order_detail.php?update_payment_status='success'&id=$payment_id");
    }
    if (isset($_POST['delivery_status'])) { 
        $delivery_status = $_POST['delivery_status'];
        $payment_id = $_POST['payment_id'];
        
        $sql = "UPDATE payment 
                SET delivery_status = '$delivery_status'
            WHERE id = $payment_id";
        
        $result = mysqli_query($conn, $sql);
    
        header("Location: ../../views/admin/order_detail.php?update_delivery_status='success'&id=$payment_id");
    }
    if (isset($_POST['ems_number'])) { 
        $ems_number = $_POST['ems_number'];
        $payment_id = $_POST['payment_id'];
        
        $sql = "UPDATE payment 
                SET ems_number = '$ems_number'
            WHERE id = $payment_id";
        
        $result = mysqli_query($conn, $sql);
    
        header("Location: ../../views/admin/order_detail.php?update_ems_number='success'&id=$payment_id");
    }

    
?>