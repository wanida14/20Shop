<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $detail = $_POST['detail'];
    $category_id = $_POST['category_id'];

    if (is_uploaded_file($_FILES['myfile']['tmp_name'])) {
            //upload image file
            $ext = pathinfo(basename($_FILES['myfile']['name']), PATHINFO_EXTENSION); //นามสกุลไฟล์
            $new_image_name = 'img-' .uniqid().".".$ext; //สุ่มชื่อไฟล์ใหม่
            $image_path = "../../views/admin/images/"; //เส้นทางที่จะเก็บไฟล์ภาพไว้
            move_uploaded_file($_FILES['myfile']['tmp_name'],$image_path.$new_image_name); //ฟังค์ชั่นการอัพโหลดไฟล์

            $image = $new_image_name;//เก็บชื่อไฟล์ภาพใหม่ไว้ในตัวแปลเพื่อลงฐานข้อมุล
            $sql = "UPDATE product 
                        SET name = '$name', 
                            price = '$price', 
                            detail = '$detail', 
                            image  = '$image'
                    WHERE id = $id";
        } else {
            $sql = "UPDATE product 
                        SET name = '$name', 
                            price = '$price', 
                            detail = '$detail'
                    WHERE id = $id";
        }
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: ../../views/admin/product.php?category_id_update=$category_id");        
        }
?>