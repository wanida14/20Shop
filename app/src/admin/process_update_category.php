<?php
    require('../connect.php'); // เรียกใช้ไฟล์...
    session_start(); // เรียกใช้ฟังก์ชั่น session
    
    if (isset($_POST['category_name'])) { 
        $category_name = $_POST['category_name'];
        $category_id = $_POST['category_id'];
        
        $sql = "UPDATE category 
                SET name = '$category_name'
            WHERE id = $category_id";
        
        $result = mysqli_query($conn, $sql);
    
        header("Location: ../../views/admin/category.php?update_category='success'");
    }
       
?>