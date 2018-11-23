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

        $id = $_GET['id'];
        $sql = "SELECT  member.name AS member_name,
                        payment.date AS date,
                        payment.price AS price,
                        payment.payment_status AS payment_status,
                        payment.id AS payment_id,
                        payment.payment_code AS payment_code,
                        payment.payment_status AS payment_status,
                        payment.delivery_status AS delivery_status,
                        payment.ems_number AS ems_number,
                        payment.name AS name,
                        payment.phone AS phone,
                        payment.address AS address,
                        payment.image AS image
                    FROM payment
                    INNER JOIN member ON payment.member_id = member.id
                    WHERE payment.id = '$id'";
        $result_payment = mysqli_query($conn, $sql);
        $payment = mysqli_fetch_array($result_payment);
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
                        <a class="nav-link" href="category.php">หมวดหมู่สินค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="order.php">ออเดอร์</a>
                    </li>
                </ul>
                <div class="text-right">
                    <a class="btn btn-info float-left" href="../../src/admin/logout.php" role="button">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <?php 
    if (isset($_GET['update_payment_status'])) { ?>
        <div class="alert alert-success" role="alert">
            แก้ไข 'สถานะการจ่ายเงิน' เรียบร้อยแล้วค่ะ
        </div>
    <?php } ?>
    <?php 
    if (isset($_GET['update_delivery_status'])) { ?>
        <div class="alert alert-success" role="alert">
            แก้ไข 'สถานะการจัดส่ง' เรียบร้อยแล้วค่ะ
        </div>
    <?php } ?>
    <?php 
    if (isset($_GET['update_ems_number'])) { ?>
        <div class="alert alert-success" role="alert">
            แก้ไข 'เลข EMS' เรียบร้อยแล้วค่ะ
        </div>
    <?php } ?>
    <!-- row 1 -->
    <div class="container">
        <div class="row">
            <div class="col-6" style="margin-top: 20px;margin-left: 300px;margin-bottom:30px;">
                <div class="card">
                <h5 class="card-header">รายละเอียดการสั่งซื้อ</h5>
                    <div class="card-body" style="padding-left: 40px;">
                        <div class="form-group">
                            <label>วันที่ : </label>
                            <?php echo $payment["date"]; ?>
                        </div>
                        <div class="form-group">
                            <label>รหัสการสั่งซื้อ : </label>
                            <?php echo $payment["payment_code"]; ?>
                        </div>
                        <div class="form-group">
                            <label>ชื่อ - นามสกุล : </label>
                            <?php echo $payment["member_name"]; ?>
                        </div>

                        <div class="form-group">
                            <label>ยอดรวม : </label>
                            <?php echo $payment["price"]; ?>
                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#order_detail">รายละเอียดสินค้า</button>
                        </div>
                        
                        <div class="form-group">
                            <label>สถานะการจ่ายเงิน : </label>
                            <span style="color:green"><?php echo $payment["payment_status"]; ?></span>
                            <button type="button" class="btn btn-primary btn-sm float-right" style="margin-left: 5px;" data-toggle="modal" data-target="#image_payment">หลักฐานการโอน</button>
                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#edit_payment_status">แก้ไขสถานะ</button>    
                        </div>

                        <div class="form-group">
                            <label>สถานะการจัดส่ง :</label>
                            <span style="color:orange"><?php echo $payment["delivery_status"]; ?></span>
                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#edit_delivery_status">แก้ไขสถานะ</button>
                        </div>

                        <div class="form-group">
                            <label>เลข EMS : </label>
                            <?php echo $payment["ems_number"]; ?>
                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#edit_ems_number">แก้ไขสถานะ</button>
                        </div>

                        <div class="form-group">
                            <label>ที่อยู่ในการจัดส่ง : </label>
                            <?php 
                                echo $payment["name"];
                                echo ' ';
                                echo $payment["phone"];
                                echo ' ';
                                echo $payment["address"];
                                echo ' ';    
                            ?>
                        </div>

                        <!-- <div class="form-group" style="margin:40px 0px;"> -->
                        <a class="btn btn-outline-success" href="order.php" role="button">
                            <i class="fas fa-edit fa-lg icon"></i>ย้อนกลับ</a>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal product detail -->
    <div class="modal" id="order_detail" tabindex="-1" role="dialog">
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
        $payment_code = $payment['payment_code']; 
            $sql = "SELECT  product.name AS product_name,
                            product.price AS price
                FROM orders_reserve
                INNER JOIN product ON orders_reserve.product_id = product.id
                WHERE orders_reserve.payment_code = '$payment_code'";
            $result_orders_reserve = mysqli_query($conn, $sql);
        
            while ($row = mysqli_fetch_array($result_orders_reserve)) { 
                echo "<p class=\"card-text\">" . $row["product_name"] . "<span class=\"float-right\">฿" . $row["price"] . ".</span></p>";
            } 
        ?>
            <p class="card-text">ค่าจัดส่ง <span class="float-right">฿50.</span></p>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        </div>
    </div>           
    </div>
    </div>
    </div>

    <!-- modal form add category -->
    <div class="modal" id="image_payment" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">หลักฐานการโอน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <img class="icon-left" src="../../src/admin/images/<?php echo $payment['image']; ?>" width="400" height="400" class="d-inline-block align-center" alt="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
          </div>
        </form>
      </div>
    </div>
    </div>
    </div>

    <!-- modal form edit payment status -->
    <div class="modal" id="edit_payment_status" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขสถานะการจ่ายเงิน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="../../src/admin/process_update_order.php">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">แก้ไขสถานะ</label>
            <input type="text" name="payment_status" class="form-control" id="payment_status">
            <input type="hidden" name="payment_id" class="form-control" value="<?php echo $payment['payment_id']; ?>">
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

    <!-- modal form edit_delivery_status -->
    <div class="modal" id="edit_delivery_status" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขสถานะการจัดส่งสินค้า</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="../../src/admin/process_update_order.php">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">แก้ไขสถานะ</label>
            <input type="text" name="delivery_status" class="form-control" id="delivery_status">
            <input type="hidden" name="payment_id" class="form-control" value="<?php echo $payment['payment_id']; ?>">
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

    <!-- modal form edit_ems_number -->
    <div class="modal" id="edit_ems_number" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขเลข EMS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="../../src/admin/process_update_order.php">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">แก้ไขสถานะ</label>
            <input type="text" name="ems_number" class="form-control" id="ems_number">
            <input type="hidden" name="payment_id" class="form-control" value="<?php echo $payment['payment_id']; ?>">
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

</body>

</html>