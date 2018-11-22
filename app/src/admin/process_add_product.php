<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $detail = $_POST['detail'];
        $category_id = $_POST['category_id'];

        //upload image file
        $ext = pathinfo(basename($_FILES['myfile']['name']), PATHINFO_EXTENSION); //นามสกุลไฟล์
        $new_image_name = 'img-' .uniqid().".".$ext; //สุ่มชื่อไฟล์ใหม่
        $image_path = "../../views/admin/images/"; //เส้นทางที่จะเก็บไฟล์ภาพไว้
        $upload_path = $image_path.$new_image_name;
        $success = move_uploaded_file($_FILES['myfile']['tmp_name'],$upload_path); //ฟังค์ชั่นการอัพโหลดไฟล์เก็บค่า true,fales ไว้ในตัวแปล
        if ($success == FALSE) { //เช็คการอัพโหลดไฟล์
            echo "เลือกรูปภาพใหม่";
            exit();
        }
        $image = $new_image_name;//เก็บชื่อไฟล์ภาพใหม่ไว้ในตัวแปลเพื่อลงฐานข้อมุล

        $sql = "INSERT INTO product (name, price, detail, category_id, image)
                    VALUES ('$name', '$price', '$detail', '$category_id', '$image')";

        $result = mysqli_query($conn, $sql);
        
        header("Location: ../../views/admin/product.php?add_product='success'");
    }
?>