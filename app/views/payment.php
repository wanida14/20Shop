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
            $sql = "SELECT* FROM orders
                    WHERE member_id = '$id'";
            $result2 = mysqli_query($conn, $sql);
            $orders_count = mysqli_num_rows($result2);
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
                    <li class="nav-item">
                        <a class="nav-link" href="../../public/index.php">หน้าหลัก</a>
                    </li>
                    <li class="nav-item active">
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
                            <a class="nav-link" href="../app/views/detail_orders.php" style="display: inline-block;padding-left: 10px;color:#6c757d;padding-right: 0px;">
                                <i class="fas fa-shopping-cart p">(<?php echo $orders_count; ?>)</i>
                            </a>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#register" style="margin-right:5px;">สมัครสมาชิก</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#login" style="margin-right:5px;">เข้าสู่ระบบ</button>
                    </li>
                </ul>
                <?php } ?> 
            </div>
        </div>
    </nav>
<!-- modal form register -->
<div class="modal" id="register" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">สมัครสมาชิก</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="../src/process_register.php">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">ชื่อ - สกุล</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="ใส่ชื่อ - นามสกุล">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Username</label>
              <input id="username" type="text" name="username" class="form-control" placeholder="ใส่ Username">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Password</label>
              <input id="password" type="text" name="password" class="form-control" placeholder="ใส่ Password">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">วันเกิด</label>
              <input id="birthday" type="date" name="birthday" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">เบอร์โทรศัพท์</label>
              <input id="tel" type="text" name="tel" class="form-control" placeholder="ใส่เบอรืโทรศัพท์ของคุณ">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">E-mail</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="ใส่ชื่อ E-mail ของคุณ">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">ที่อยู่</label>
            <input type="text" class="form-control" name="address" id="address" placeholder="ใส่ที่อยู่ของคุณ">
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
    <!-- modal form login -->
    <div class="modal" id="login" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เข้าสู่ระบบ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="../src/process-login.php">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Usename</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Usename">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Password</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
          </div>
        </form>
      </div>      
    </div>
  </div>
</div>   

<!-- row 1 -->
<div class="container">
    <div class="row">
        <div class="col-6" style="margin-top: 30px;margin-left: 300px;">
            <div class="card">
            <h5 class="card-header">ช่องทางการชำระเงิน</h5>
                <div class="card-body" style="padding-left: 40px;">
                    <div class="form-group">
                        <h5>ช่องทางการชำระเงิน</h5>
                        <p>- ธนาคารไทยพาณิชย์ 123456789 สาขา xxxxx ชื่อ Wanida niwkoy</p>
                        <p>- ธนาคารกรุงไทย 123456789 สาขา xxxxx ชื่อ Wanida niwkoy</p>
                        <p>- ธนาคารกสิกร 123456789 สาขา xxxxx ชื่อ Wanida niwkoy</p>
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
