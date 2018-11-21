<?php

    if ($_POST) {
        $category_id = $_POST['category_id'];

        header("Location: product.php?category_id=$category_id");

    }
?>