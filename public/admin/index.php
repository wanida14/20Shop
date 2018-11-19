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
</style>

<body>
    <?php
        require('../app/src/connect.php'); // เรียกใช้ไฟล์...

        $category_id = 1;
        $sql = "SELECT * FROM product
                WHERE category_id = $category_id";
        $result = mysqli_query($conn, $sql);
    ?>
    <!-- menu bar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#fff;height: 56px;padding-top: 5px;">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="admin.php">
                <!-- <img src="images/shop.png" width="50" height="40" class="d-inline-block align-center" alt=""> -->
            20Shop
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ติดต่อเรา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ช่องทางการชำระเงิน</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#register" style="margin-right:5px;">สมัครสมาชิก</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#login" style="margin-right:5px;">เข้าสู่ระบบ</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- modal register -->
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
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">ชื่อ - สกุล</label>
            <input type="text" class="form-control" id="name" placeholder="name">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Username</label>
              <input id="" type="text" name="age" class="form-control" placeholder="Username">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Password</label>
              <input id="" type="text" name="tel" class="form-control" placeholder="Password">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">วันเกิด</label>
              <input id="age" type="date" name="age" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">เบอร์โทรศัพท์</label>
              <input id="tel" type="text" name="tel" class="form-control" placeholder="Phone">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">E-mail</label>
            <input type="text" class="form-control" id="" placeholder="E-mail">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">ที่อยู่</label>
            <input type="text" class="form-control" id="" placeholder="Adress">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary">บันทึก</button>
      </div>
    </div>
    </div>
    </div>
    <!-- modal login -->
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
        <form action="../app/src/process-login.php">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Usename</label>
            <input type="text" class="form-control" id="username" placeholder="Usename">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Password</label>
            <input type="text" class="form-control" id="password" placeholder="Password">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary">เข้าสู่ระบบ</button>
      </div>
    </div>
  </div>
</div>
    <!-- menu left -->
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-4" style="background-color:#fff;padding-bottom: 0px;padding-top: 0px;">
                <div class="row">
                    <div class="col-6 text-center a menu-l-top">
                        <a class="nav-link" href="#">
                            <img  class="icon-left" src="images/writing-tool.png" width="50" height="50" class="d-inline-block align-center" alt="">
                            <p class="a" style="padding-top:5px;">อุปกรณ์การเรียน</p>
                        </a>
                    </div>
                    <div class="col-6 text-center a menu-l-top">
                        <a class="nav-link" href="#">
                            <img class="icon-left" src="images/dress.png" width="50" height="50" class="d-inline-block align-center" alt="">
                            <p class="a" style="padding-top:5px;">เครื่องแต่งกาย</p>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-center a menu-l-midden">
                        <a class="nav-link" href="#">
                            <img class="icon-left" src="images/synchronize.png" width="50" height="50" class="d-inline-block align-center" alt="">
                            <p class="a" style="padding-top:5px;">ของใช้ทั่วไป</p>
                        </a>
                    </div>
                    <div class="col-6 text-center a menu-l-bottom">
                        <a class="nav-link" href="#">
                            <img class="icon-left" src="images/mobile.png" width="50" height="50" class="d-inline-block align-center" alt="">
                            <p class="a" style="padding-top:5px;">อิเล็กทรอนิกส์</p>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-center a menu-l-bottom">
                        <a class="nav-link" href="#">
                            <img class="icon-left" src="images/lipstick.png" width="50" height="50" class="d-inline-block align-center" alt="">
                            <p class="a" style="padding-top:5px;">ความงาม</p>
                        </a>
                    </div>
                    <div class="col-6 text-center a menu-l-bottom">
                        <a class="nav-link" href="#">
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
            echo '<a class="nav-link" style="padding-left: 0px;padding-right:0px;" href="#">';
                echo '<div class="card zoom">';
                    echo "<img class=\"card-img-top\" src=\"../app/views/images/" . $row["image"] . "\" height=\"200\" width=\"120\">";
                    echo '<div class="card-body">';
                        echo "<p class=\"card-text font-product text-center\">" . $row["name"] ."</p>";
                    echo '</div>';
                echo '</div>';
                echo '</a>';
            echo '</div>';
        }
        ?>
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
