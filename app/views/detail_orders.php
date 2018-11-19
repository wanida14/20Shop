<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.css">
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/bootstrap.js"></script>
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

    .shadow {
        box-shadow: 10px 10px 5px grey;
    }

    .a {
        width: 80;
        color: #353b48;
    }

    .menu-l-top {
        padding: 30px 10px 25px 10px;
    }
    .menu-l-midden {
        padding: 20px 10px 30px 10px;
    }

    .menu-l-bottom {
        padding: 20px 10px 35px 10px;
    }

    .a:hover {
        background-color: #dfe6e9;
    }

    .a:hover .icon-left:hover {
        width:55px;
        height:55px;
    }

    .search {
        background-color: #fff;
        padding: 10px 10px 10px 715px;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .bt-searh {
        /* border-color: #fd79a8; */
        background-color: #fd79a8;
        color: #2d3436;
    }

    .bt-searh:hover {
        /* background-color: #fd79a8; */
        color: #222f3e;
    }

    .zoom {
    transition: transform .3s;
    }

    .zoom:hover {
    transform: scale(1.1);
    border-style: solid;
    border-width: 1px;
    border-color:#fd79a8; 
    }

    .font-product {
        color:#353b48;
        font-size:20px;
    }

    .p:hover {
        color:#353b48;
    }
    .pointer {
        cursor: pointer;
    }
    .bg-product {
        margin-top: 40px;
        margin-right: 0px;
        margin-bottom: 100px;
        padding-right: 50px;
        background-color: #fff;
        padding-top: 30px;
        padding-left: 50px;
        padding-bottom: 50px;
    }
    .bg-pay {
        margin-top: 40px;
        padding-right: 0px;
    }
</style>

<body>
    <?php
        session_start();

        require('../src/connect.php'); // เรียกใช้ไฟล์...

        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $status_id = $_SESSION['status_id'];
            if ($status_id == '2') {
                $sql = "SELECT * FROM member
                WHERE id = '$id'";
                $result_member = mysqli_query($conn, $sql);
                $member = mysqli_fetch_array($result_member);
            }
            $sql = "SELECT product.name AS product_name,
                           product.price AS price,
                           product.image AS image,
                           orders.id AS id
                    FROM orders
                    INNER JOIN product ON orders.product_id = product.id
                    WHERE orders.member_id = '$id'";
            $result_order = mysqli_query($conn, $sql);
            $orders_count = mysqli_num_rows($result_order);
            $orders_price = $orders_count*20;
            $total = $orders_price+50;

        }
    ?>
    <!-- menu bar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#fff;height: 56px;padding-top: 5px;">
        <div class="container" style="padding-right: 0px;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="../../public/index.php">
                <!-- <img src="images/shop.png" width="50" height="40" class="d-inline-block align-center" alt=""> -->
            20Shop
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="../../public/index.php">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ติดต่อเรา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ช่องทางการชำระเงิน</a>
                    </li>
                </ul>
                <?php
                if (isset($_SESSION['id'])) {
                    if ($status_id == '2') { ?>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" style="display: inline-block;">
                                    <?php
                                        echo $member["username"];
                                    ?>
                                        <i class="fas fa-user"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown"  style="padding-top: 0px;padding-bottom: 00px;">
                                        <a class="dropdown-item" href="#">ข้อมูลสมาชิก</a>
                                        <a class="dropdown-item" href="product_status.php">สถานะสินค้า</a>
                                        <a class="dropdown-item" href="../app/src/logout.php">ออกจากระบบ</a>
                                    </div>
                                </li>
                            </ul>
                            <a class="nav-link" href="detail_orders.php" style="display: inline-block;padding-left: 10px;color:#6c757d;padding-right: 0px;">
                                <i class="fas fa-shopping-cart p">(<?php echo $orders_count; ?>)</i>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>                   
            </div>
        </div>
    </nav>
    <?php 
        if ($orders_count == 0) {
            echo '<h1 style="text-align: center;margin-top: 50px;">ยังไม่มีสินค้าในตะกร้า</h1>';
            exit();
        }
    ?>
    <!-- row 1 -->
    <div class="container">
        <div class="row">
            <div class="col-8 bg-product">
                <table class="table text-center">
                <h4 style="text-align: center;margin-bottom: 30px;">สินค้าในตะกร้า</h4>
                <thead>
                    <tr>
                    <th>ลำดับที่</th>
                    <th>ภาพสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>ราคาสินค้า</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $order_product = [];                   
                    while ($row = mysqli_fetch_array($result_order)) {
                        echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo '<td><img src ="images/' . $row["image"] . '" height="50" width="50"></td>';
                            echo "<td>" . $row["product_name"] . "</td>";
                            echo "<td>" . $row["price"] . " บาท</td>";
                            echo "<td class=\"button-style\">  
                                    <a href=\"../src/process_dalete_order.php?id={$row["id"]}\" class='btn btn-outline-danger'>
                                    <i class='fas fa-trash-alt fa-lg icon'></i> ลบ</a>
                                </td>";
                        echo "</tr>";
                        array_push($order_product, $row["id"]);
                        $i++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $order_product_implode = implode(",",$order_product);
                    ?>
            </div>
            <div class="col-4 bg-pay">
                <div class="card">
                <h5 class="card-header">สรุปรายการสั่งซื้อ</h5>
                    <div class="card-body">                       
                        <p class="card-text">ยอดรวม (จำนวน <?php echo $orders_count; ?> ชิ้น) <span class="float-right">฿<?php echo $orders_price; ?>.</span></p>
                        <p class="card-text">ค่าจัดส่ง <span class="float-right">฿50.</span></p>
                        <h5 class="card-title">ยอดรวมทั้งสิ้น <span class="float-right">฿<?php echo $total; ?>.</span></p></h5>
                        <a href="#" class="btn btn-primary btn-lg btn-block btn-warning" data-toggle="modal" data-target="#adress">ดำเนินการชำระเงิน</a>
                    </div>
                </div>
            </div>
            <!-- modal form input address -->
            <div class="modal" id="adress" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ใส่ที่อยู่ในการจัดส่งสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../src/process-add-adress.php">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">ชื่อ - สกุล</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="ชื่อ - สกุล">
                        <input type="hidden" name="member_id" value="<?php echo $id; ?>">
                        <input type="hidden" name="order_product_implode" value="<?php echo $order_product_implode; ?>">
                    </div>                    
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">เบอร์โทรศัพท์</label>
                        <input type="text" name="phone" class="form-control" id="" placeholder="โปรดป้อนหมายเลขโทรศัพท์ของคุณ">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ที่อยู่</label>
                        <textarea type="text" name="address" class="form-control" id="" placeholder="กรุณาระบุที่อยู่ (บ้านเลขที่,ถนน,ตำบล,เขตมอำเภอมจังหวัดมรหัสไปรษณีย์)" rows="4"></textarea>
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
        </div>
    </div>
    
    <!-- 5. Footage -->
    <div class="footer-light" style="margin-top:40px;">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="footer-widget-title">Product Site</h5>
                    <ul class="list-unstyled footer-widget-list">
                    <li>Skype</li>
                    <li>MSN</li>
                    <li>Bing</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="footer-widget-title">Accessories</h5>
                    <ul class="list-unstyled footer-widget-list">
                    <li>Speakers</li>
                    <li>Headsets</li>
                    <li>Car and navigation</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="footer-widget-title">Popular Resource</h5>
                    <ul class="list-unstyled footer-widget-list">
                    <li>footer-text</li>
                    <li>footer-text</li>
                    <li>footer-text</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="footer-widget-title">Download Center</h5>
                    <ul class="list-unstyled footer-widget-list">
                    <li>footer-text</li>
                    <li>footer-text</li>
                    <li>footer-text</li>
                    </ul>
                </div>
            </div>
            <div class="spacer"></div>
            <hr>
            <div class="spacer"></div>
                <div class="row">
                    <div class="col-md-12">
                        <img class="img-fluid" src="./images/mslogo.png" alt="">
                        <div class="footer-text">
                        2015, Microsoft Store | Credit Doonnn.com
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
