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

        $sql_category = "SELECT * FROM category";
        $category = mysqli_query($conn, $sql_category);

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
                        <a class="nav-link" href="product.php">สินค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="add_product.php">เพิ่มสินค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">หมวดหมู่สินค้า</a>
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
    <h3 class="text-center" style="padding-top: 20px;">เพิ่มสินค้า</h3>
        <div class="row" style="padding-left: 130px;padding-right: 130px;">
            <div class="col-12">
                <form method="post" action="../../src/Admin/process_add_product.php" enctype="multipart/form-data" style="margin:40px 20px;">
                    <div class="form-row">
                        <div class="col form-group col-md-6">
                        <label for="inputEmail4">ชื่อสินค้า</label>
                        <input id="name" type="text" name="name" class="form-control">            
                    </div>
                    <div class="col form-group col-md-6">
                        <label for="inputEmail4">ราคา</label>
                        <input id="price" type="text" name="price" class="form-control">
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">รายละเอียด</label>
                        <input id="detail" type="text" name="detail" class="form-control">
                    </div>
                    <div class="form-row">
                        <div class="col form-group col-md-4" style="margin-bottom: 0px;">
                            <label for="inputEmail4">เลือกหมวดหมู่สินค้า</label>
                            <select id="category_id" class="form-control" name="category_id">
                                <option value="" >---- เลือก ----</option>
                                <?php
                                while ($row = mysqli_fetch_array($category)) {
                                        echo "<option value=\"{$row['id']}\">{$row['name']}</option>";                        
                                    }
                                ?>
                            </select>            
                        </div>
                        <div class="col form-group col-md-4" style="margin-bottom: 0px;">
                            <label for="exampleFormControlFile1">รูปภาพ</label>
                            <input id="myfile" type="file" name="myfile" class="form-control-file">
                        </div>                   
                    </div>
                    <div style="padding-top: 30px;">
                        <button id="save" type="submit" class="btn btn-outline-info"><i class="fas fa-save fa-lg icon"></i>บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>