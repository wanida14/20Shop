<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session

    if ($_POST) {
        $name = $_POST['name'];

        $sql = "INSERT INTO category (name)
                    VALUES ('$name')";

        $result = mysqli_query($conn, $sql);
        
        header("Location: ../../views/admin/category.php?add_category='success'");
    }
?>