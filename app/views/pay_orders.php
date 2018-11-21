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
        if (isset($_GET['payment_code'])) {
            $payment_code = $_GET['payment_code'];
            $sql = "SELECT * FROM payment
                    WHERE payment_code = '$payment_code'";
            $result_payment = mysqli_query($conn, $sql);
            $member_address = mysqli_fetch_array($result_payment);
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
            20Shop
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../../public/index.php">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="payment.php">ช่องทางการชำระเงิน</a>
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
                                        <a class="dropdown-item" href="profile_member.php">ข้อมูลสมาชิก</a>
                                        <a class="dropdown-item" href="product_status.php">สถานะสินค้า</a>
                                        <a class="dropdown-item" href="../src/logout.php">ออกจากระบบ</a>
                                    </div>
                                </li>
                            </ul>
                            <a class="nav-link" href="detail_orders.php" style="display: inline-block;padding-left: 10px;color:#6c757d;padding-right: 0px;">
                                <i class="fas fa-shopping-cart p" style="color:#353b48;">(<?php echo $orders_count; ?>)</i>
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
            <div class="col-8 bg-product">
                <table class="table text-center">
                <h4 style="text-align: center;margin-bottom: 30px;">สินค้าที่สั่งซื้อ</h4>
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
                    while ($row = mysqli_fetch_array($result_order)) {
                    echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo '<td><img src ="images/' . $row["image"] . '" height="50" width="50"></td>';
                        echo "<td>" . $row["product_name"] . "</td>";
                        echo "<td>" . $row["price"] . " บาท</td>";
                    echo "</tr>";
                    $i++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                    ?>
            </div>
            <div class="col-4 bg-pay">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <h5 class="card-header">ที่อยู่ในการจัดส่ง</h5>
                            <div class="card-body">                       
                                <p class="card-text">ชื่อ <span class="float-right"><?php echo $member_address["name"]; ?></span></p>
                                <p class="card-text">เบอร์โทร <span class="float-right"><?php echo $member_address["phone"]; ?></span></p>
                                <span class="card-text">ที่อยู่  </span><br>
                                <span class="card-text"><?php echo $member_address["address"]; ?></span><br>
                                <a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#edit_adress">แก้ไข</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:30px;">
                    <div class="col-12">
                        <div class="card">
                        <h5 class="card-header">รายการสั่งซื้อ</h5>
                            <div class="card-body">                       
                                <p class="card-text">ยอดรวม (จำนวน <?php echo $orders_count; ?> ชิ้น) <span class="float-right">฿<?php echo $orders_price; ?>.</span></p>
                                <p class="card-text">ค่าจัดส่ง <span class="float-right">฿50.</span></p>
                                <h5 class="card-title">ยอดรวมทั้งสิ้น <span class="float-right">฿<?php echo $total; ?>.</span></p></h5>
                                <a href="#" class="btn btn-primary btn-lg btn-block btn-warning" data-toggle="modal" data-target="#image_payment">ชำระเงิน</a>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
            
            <!-- modal form edit address -->
            <div class="modal" id="edit_adress" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ใส่ที่อยู่ในการจัดส่งสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../src/process-edit-adress.php">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">ชื่อ - สกุล</label>
                        <input type="text" name="name" class="form-control" id="name" value="<?php echo $member_address['name']; ?>">
                        <input type="hidden" name="member_id" value="<?php echo $id; ?>">
                        <input type="hidden" name="payment_code" value="<?php echo $payment_code ?>">
                    </div>                    
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">เบอร์โทรศัพท์</label>
                        <input type="text" name="phone" class="form-control" id="" value="<?php echo $member_address['phone']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ที่อยู่</label>
                        <textarea type="text" name="address" class="form-control" id="" rows="4"><?php echo $member_address['address']; ?></textarea>
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

            <!-- modal form input image payment -->
            <div class="modal" id="image_payment" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">อัพโหลดหลักฐานการโอนเงิน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../src/process-add-image_payment.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <h5>ช่องทางการชำระเงิน</h5>
                        <p>- ธนาคารไทยพาณิชย์ 123456789 สาขา xxxxx ชื่อ Wanida niwkoy</p>
                        <p>- ธนาคารกรุงไทย 123456789 สาขา xxxxx ชื่อ Wanida niwkoy</p>
                        <p>- ธนาคารกสิกร 123456789 สาขา xxxxx ชื่อ Wanida niwkoy</p>
                    </div>                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-group"><br>
                                <h5>อัพโหลดภาพหลักฐานการโอนเงิน</h5>
                                <input id="myfile" type="file" name="myfile" class="form-control-file">
                                <input type="hidden" name="payment_code" value="<?php echo $payment_code; ?>">
                                <input type="hidden" name="price" value="<?php echo $total; ?>">
                            </div>
                        </div>
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
