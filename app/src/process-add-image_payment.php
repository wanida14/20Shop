<?php
    require('connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {

        $payment_code = $_POST['payment_code'];
        $price = $_POST['price'];

        //upload image file
        $ext = pathinfo(basename($_FILES['myfile']['name']), PATHINFO_EXTENSION); //นามสกุลไฟล์
        $new_image_name = 'img-' .uniqid().".".$ext; //สุ่มชื่อไฟล์ใหม่
        $image_path = "images/"; //เส้นทางที่จะเก็บไฟล์ภาพไว้
        $upload_path = $image_path.$new_image_name;
        $success = move_uploaded_file($_FILES['myfile']['tmp_name'],$upload_path); //ฟังค์ชั่นการอัพโหลดไฟล์เก็บค่า true,fales ไว้ในตัวแปล
        if ($success == FALSE) { //เช็คการอัพโหลดไฟล์
            echo "เลือกรูปภาพใหม่";
            exit();
        }
        $image = $new_image_name;//เก็บชื่อไฟล์ภาพใหม่ไว้ในตัวแปลเพื่อลงฐานข้อมุล

        $sql = "UPDATE payment 
                SET image = '$image',
                    price = '$price',
                    payment_status = 'จ่ายแล้ว',
                    delivery_status = '-',
                    ems_number = '-'
            WHERE payment_code = '$payment_code'";               
        $result = mysqli_query($conn, $sql);
        
        $sql = "DELETE FROM orders WHERE payment_code = '$payment_code'";
        $result2 = mysqli_query($conn, $sql);

        header("Location: ../views/pay_orders_fnish.php?payment_code=$payment_code");
    }
?>