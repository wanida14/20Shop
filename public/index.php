<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
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

        require('../app/src/connect.php'); // เรียกใช้ไฟล์...

        if (isset($_GET['text_register'])) {
            echo '<div class="alert alert-success" role="alert">
                        สมัครสมาชิกเรียบร้อยแล้วค่ะ
                  </div>';
        }

        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
            
            $sql = "SELECT * FROM product
                    WHERE category_id = $category_id";
            $result = mysqli_query($conn, $sql);
        } else {
            $category_id = 1;
            $sql = "SELECT * FROM product
                    WHERE category_id = $category_id";
            $result = mysqli_query($conn, $sql);
        }

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
            <a class="navbar-brand" href="index.php">
                <!-- <img src="images/shop.png" width="50" height="40" class="d-inline-block align-center" alt=""> -->
            20Shop
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../app/views/payment.php">ช่องทางการชำระเงิน</a>
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
                                        <a class="dropdown-item" href="../app/views/profile_member.php">ข้อมูลสมาชิก</a>
                                        <a class="dropdown-item" href="../app/views/product_status.php">สถานะสินค้า</a>
                                        <a class="dropdown-item" href="../app/src/logout.php">ออกจากระบบ</a>
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
        <form method="post" action="../app/src/process_register.php">
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
        <form method="post" action="../app/src/process-login.php">
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
    <!-- menu left -->
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-4" style="background-color:#fff;padding-bottom: 0px;padding-top: 0px;">
                <div class="row">
                    <div class="col-6 text-center a menu-l-top"  <?php if ($category_id == '1') { ?> style="background-color: #dfe6e9" <?php } ?>>
                        <a class="nav-link" href="category_id.php?category_id=1">
                            <img  class="icon-left" src="images/writing-tool.png" width="50" height="50" class="d-inline-block align-center" alt="">
                            <p class="a" style="padding-top:5px;">อุปกรณ์การเรียน</p>
                        </a>
                    </div>
                    <div class="col-6 text-center a menu-l-top" <?php if ($category_id == '2') { ?> style="background-color: #dfe6e9" <?php } ?>>
                        <a class="nav-link" href="category_id.php?category_id=2">
                            <img class="icon-left" src="images/dress.png" width="50" height="50" class="d-inline-block align-center" alt="">
                            <p class="a" style="padding-top:5px;">เครื่องแต่งกาย</p>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-center a menu-l-midden" <?php if ($category_id == '3') { ?> style="background-color: #dfe6e9" <?php } ?>>
                        <a class="nav-link" href="category_id.php?category_id=3">
                            <img class="icon-left" src="images/synchronize.png" width="50" height="50" class="d-inline-block align-center" alt="">
                            <p class="a" style="padding-top:5px;">ของใช้ทั่วไป</p>
                        </a>
                    </div>
                    <div class="col-6 text-center a menu-l-bottom" <?php if ($category_id == '4') { ?> style="background-color: #dfe6e9" <?php } ?>>
                        <a class="nav-link" href="category_id.php?category_id=4">
                            <img class="icon-left" src="images/mobile.png" width="50" height="50" class="d-inline-block align-center" alt="">
                            <p class="a" style="padding-top:5px;">อิเล็กทรอนิกส์</p>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-center a menu-l-bottom" <?php if ($category_id == '5') { ?> style="background-color: #dfe6e9" <?php } ?>>
                        <a class="nav-link" href="category_id.php?category_id=5">
                            <img class="icon-left" src="images/lipstick.png" width="50" height="50" class="d-inline-block align-center" alt="">
                            <p class="a" style="padding-top:5px;">ความงาม</p>
                        </a>
                    </div>
                    <div class="col-6 text-center a menu-l-bottom" <?php if ($category_id == '6') { ?> style="background-color: #dfe6e9" <?php } ?>>
                        <a class="nav-link" href="category_id.php?category_id=6">
                            <img class="icon-left" src="images/cutlery.png" width="50" height="50" class="d-inline-block align-center" alt="">
                            <p class="a" style="padding-top:5px;">อาหาร</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-8" style="padding-right: 0px;padding-left: 20px;">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="images/cover-0.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="images/cover-1.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="images/problem-solving.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- row search -->
    <div class="container">
        <div class="row">
            <div class="col-12 search">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width: 326px;">
                    <button class="btn bt-searh my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    <!-- row 3 -->
    <div class="container" style="padding-left: 0px;padding-right: 0px;">
        <div class="row">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            echo '<div class="col-3" style="margin-bottom: 15px;">';
                echo "<div class=\"card zoom pointer\" data-toggle=\"modal\" data-target=\"#product" . $row["id"] ."\">";
                    echo "<img class=\"card-img-top\" src=\"../app/views/admin/images/" . $row["image"] . "\" height=\"200\" width=\"120\">";
                    echo '<div class="card-body">';
                        echo "<p class=\"card-text font-product text-center\">" . $row["name"] ."</p>";
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        ?>
        </div>
    </div>
    <?php
        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
            
            $sql = "SELECT * FROM product
                    WHERE category_id = $category_id";
            $result = mysqli_query($conn, $sql);
        } else {
            $category_id = 1;
            $sql = "SELECT * FROM product
                    WHERE category_id = $category_id";
            $result = mysqli_query($conn, $sql);
        }
        while ($row = mysqli_fetch_array($result)) { 
            echo "<div class=\"modal\" id=\"product". $row["id"] ."\" tabindex=\"-1\" role=\"dialog\">" ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">รายละเอียดสินค้า</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="../app/src/process-add-product.php">
                            <div class="form-group">
                                <div class="col-12 text-center">
                                    <img class="card-img-top" src="../app/views/admin/images/<?php echo $row["image"]; ?>" style="width: 250px;height: 190px;">
                                </div>
                                <p for="recipient-name" class="col-form-label"><?php echo "ชื่อสินค้า : ".$row["name"]; ?></p>
                                <p for="recipient-name" class="col-form-label"><?php echo "ราคาสินค้า : ".$row["price"]; ?></p>
                                <p for="recipient-name" class="col-form-label"><?php echo "รายละเอียดสินค้า : <br>".$row["detail"]; ?></p>
                                <input type="hidden" name="product_id" value="<?php echo $row["id"]; ?>">
                                <input type="hidden" name="member_id" value="<?php echo $id ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                <?php 
                                if (isset($_SESSION['id'])) {
                                    if ($status_id == '2') { ?>
                                        <button type="submit" class="btn btn-primary">ใส่ตะกร้า</button>
                                    <?php } ?>
                                <?php } ?>

                            </div>
                            </form>
                        </div>      
                    </div>
                </div>
            </div>

        <?php } ?>
    
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
