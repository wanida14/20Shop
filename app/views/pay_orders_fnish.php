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

    <!-- row 1 -->
    <div class="container">
        <div class="row">
            <div class="col-12 bg-product" style="padding-bottom: 100px;padding-top: 100px;">
            <h5 style="text-align: center;">สั่งซื้อสินค้าเรียบร้อยแล้ว ลูกค้าสามารถตรวจสอบสถานะการส่งสินค้าได้ในเมนู "เช็คสถานะสินค้า" ค่ะ
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
