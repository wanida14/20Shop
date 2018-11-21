<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/bootstrap.css">
    <script src="../../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../../public/js/bootstrap.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
</head>
<style>
    * {
        font-family: 'Kanit', sans-serif;
    }

    body {
        background-color: #eee;
    }

    .m-left {
        background-color: bisque;
    }
    .icon {
        padding-right: 5px;
    }
</style>

<body>
    <?php
        session_start();

        require('../../src/connect.php'); // เรียกใช้ไฟล์...

        $product_id = $_GET['id'];
        $sql = "SELECT * FROM product WHERE id='$product_id'";
        $result_product = mysqli_query($conn, $sql);
        $product = mysqli_fetch_array($result_product);

    ?>
    <!-- menu bar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#fff;height: 56px;padding-top: 5px;">
        <div class="container" style="padding-right: 0px;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="home.php">
                20Shop
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">สมาชิก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="product.php">สินค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_product.php">เพิ่มสินค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order.php">ออเดอร์</a>
                    </li>
                </ul>
                <div class="text-right">
                    <a class="btn btn-info float-left" href="../../src/admin/logout.php" role="button">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- content -->
    <div class="container" style="background-color: white;margin-top: 30px;">
    <h3 class="text-center">แก้ไขข้อมูลสินค้า</h3>
        <div class="row">
            <div class="col-10">
                <form method="post" action="../../src/Admin/process_update_product.php" enctype="multipart/form-data" style="margin:40px 20px;">
                    <div class="form-row">
                        <div class="col form-group col-md-6">
                        <label for="inputEmail4">ชื่อสินค้า</label>
                        <input id="name" type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>">
                        <input type="hidden" name="category_id" value="<?php echo $product['category_id']; ?>">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    </div>
                    <div class="col form-group col-md-6">
                        <label for="inputEmail4">ราคา</label>
                        <input id="price" type="text" name="price" class="form-control" value="<?php echo $product['price']; ?>">
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">รายละเอียด</label>
                        <input id="detail" type="text" name="detail" class="form-control" value="<?php echo $product['detail']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">รูปภาพ</label>
                        <input id="myfile" type="file" name="myfile" class="form-control-file">
                    </div>
                <button id="save" type="submit" class="btn btn-outline-info"><i class="fas fa-save fa-lg icon"></i>บันทึก</button>
            </form>
            </div>
        </div>
    </div>

</body>

</html>