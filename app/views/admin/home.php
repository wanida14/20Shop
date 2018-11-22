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

        if (isset($_SESSION['id'])) {
            $sql = "SELECT * FROM member";
            $result_member = mysqli_query($conn, $sql);
        }
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
                        <a class="nav-link active" href="home.php">สมาชิก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product.php">สินค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_product.php">เพิ่มสินค้า</a>
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
    <?php 
    if (isset($_GET['delete_member'])) { ?>
        <div class="alert alert-success" role="alert">
            ลบข้อมูลสมาชิกเรียบร้อยแล้วค่ะ
        </div>
    <?php } ?>
    <!-- content -->
    <div class="container" style="background-color: white;margin-top: 30px;">
        <div class="text-center" style="padding-top: 20px;"><h3>ข้อมูลสมาชิก</h3></div>
        <div class="row">
            <div class="col-12">
                <table class="table text-center" style="margin-top:30px;">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            while ($row = mysqli_fetch_array($result_member)) {
                                echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>" . $row["username"] . "</td>";
                                    echo "<td>" . $row["password"] . "</td>";
                                    echo "<td class=\"button-style\">
                                            <a href=\"datas_member.php?id={$row["id"]}\" class='btn btn-outline-info'>
                                                <i class='fas fa-address-book fa-lg icon'></i>ดูข้อมูล</a>
                                            <a href=\"../../src/admin/process_delete_member.php?id={$row["id"]}\" class='btn btn-outline-danger'>
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