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

        $sql = "SELECT * FROM category";
        $result_category = mysqli_query($conn, $sql);
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
                        <a class="nav-link" href="add_product.php">เพิ่มสินค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="category.php">หมวดหมู่สินค้า</a>
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

    <?php 
    if (isset($_GET['add_category'])) { ?>
        <div class="alert alert-success" role="alert">
            เพิ่มข้อมูล 'หมวดหมู่สินค้า' เรียบร้อยแล้วค่ะ
        </div>
    <?php } ?>
    <?php 
    if (isset($_GET['delete_category'])) { ?>
        <div class="alert alert-success" role="alert">
            ลบข้อมูล 'หมวดหมู่สินค้า' เรียบร้อยแล้วค่ะ
        </div>
    <?php } ?>
    <?php 
    if (isset($_GET['update_category'])) { ?>
        <div class="alert alert-success" role="alert">
            แก้ไขข้อมูล 'หมวดหมู่สินค้า' เรียบร้อยแล้วค่ะ
        </div>
    <?php } ?>

    <!-- content -->
    <div class="container" style="background-color: white;margin-top: 30px;">
    <div class="text-center" style="padding-top: 20px;"><h3>หมวดหมู่สินค้า</h3></div>       
        <div class="row" style="padding-left: 130px;padding-right: 130px;">
            <a class="btn btn-outline-success ml-auto" href="#" role="button" data-toggle="modal" data-target="#add_category">เพิ่มหมวดหมู่สินค้า</a>
            <div class="col-12">
                <table class="table text-center" style="margin-top:30px;">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th style="width: 144px;">ชื่อ</th>
                            <th style="width: 374px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            while ($row = mysqli_fetch_array($result_category)) {
                                echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td class=\"button-style\">
                                            <a href=\"#\" class=\"btn btn-outline-info\" data-toggle=\"modal\" data-target=\"#category" . $row["id"] ."\">
                                                <i class=\"fas fa-address-book fa-lg icon\"></i>แก้ไข</a>
                                            <a href=\"../../src/admin/process_delete_category.php?id={$row["id"]}\" class=\"btn btn-outline-danger\">
                                                <i class=\"fas fa-trash-alt fa-lg\"></i> ลบ</a>
                                        </td>";
                                echo "</tr>";
                            $i++;
                            }
                    echo "</tbody>";
                echo "</table>";
                        ?>
            </div>
        </div>
    </div>
    <!-- modal form add category -->
    <div class="modal" id="add_category" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เพิ่มหมวดหมู่สินค้า</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="../../src/admin/process_add_category.php">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">ชื่อหมวดหมู่สินค้า</label>
            <input type="text" name="name" class="form-control" id="name">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            <button type="submit" class="btn btn-primary">บันทึก</button>
          </div>
        </form>
      </div>
    </div>
    </div>
    </div>

    <!-- modal form edit category -->
    <?php 
        $sql = "SELECT * FROM category";
        $result_category = mysqli_query($conn, $sql);
    
        while ($row = mysqli_fetch_array($result_category)) { 
        echo "<div class=\"modal\" id=\"category". $row["id"] ."\" tabindex=\"-1\" role=\"dialog\">"; $category_id=$row["id"] 
    ?>
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">รายละเอียดสินค้า</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">                   
            <?php 
                $sql = "SELECT * FROM category
                        WHERE id = '$category_id'";
                $result_category_edit = mysqli_query($conn, $sql);
                $category_name = mysqli_fetch_array($result_category_edit);
            ?>
            <form method="post" action="../../src/admin/process_update_category.php">
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">แก้ไขสถานะ</label>
                    <input type="text" name="category_name" class="form-control" id="ems_number" value="<?php echo $category_name['name']; ?>">
                    <input type="hidden" name="category_id" class="form-control" value="<?php echo $category_id; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>           
        </div>
        </div>
        </div>
    <?php } ?>

</body>

</html>