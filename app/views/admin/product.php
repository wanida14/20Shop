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

        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
            $sql = "SELECT * FROM product WHERE category_id='$category_id'";
            $result_product = mysqli_query($conn, $sql);
        } else {
            $sql = "SELECT * FROM product";
            $result_product = mysqli_query($conn, $sql);

        }
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
    <div class="text-center" style="padding-top: 20px;"><h3>ข้อมูลสินค้า</h3></div>
        <form method="post" action="category_id.php">
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
            </div>
            <button id="ok" type="submit" class="btn btn-outline-success">ตกลง</button>
        </form>
        <div class="row">
            <div class="col-12">
                <table class="table text-center" style=margin-top:30px;">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>ภาพ</th>
                            <th style="width: 144px;">ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th style="width: 374px;">รายละเอียด</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            while ($row = mysqli_fetch_array($result_product)) {
                                echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo '<td><img src ="images/' . $row["image"] . '" height="60" width="60"></td>';
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>" . $row["price"] . "</td>";
                                    echo "<td>" . $row["detail"] . "</td>";
                                    echo "<td class=\"button-style\">
                                            <a href=\"edit_product.php?id={$row["id"]}\" class='btn btn-outline-info'>
                                                <i class='fas fa-address-book fa-lg icon'></i>แก้ไข</a>
                                            <a href=\"../../src/Admin/Student/process_delete_student.php?id={$row["id"]}\" class='btn btn-outline-danger'>
                                                <i class='fas fa-trash-alt fa-lg'></i> ลบ</a>
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

</body>

</html>