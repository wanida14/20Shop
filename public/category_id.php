<?php

    if ($_GET) {
        $category_id = $_GET['category_id'];

        header("Location: index.php?category_id=$category_id");

    }
?>