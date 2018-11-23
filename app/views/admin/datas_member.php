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
</style>

<body>
        <?php
        session_start();

        require('../../src/connect.php'); // เรียกใช้ไฟล์...

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM member
                    WHERE id = '$id'";
            $result_member = mysqli_query($conn, $sql);
            $member = mysqli_fetch_array($result_member);
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
    <?php if(isset($_GET['update_profile'])) { ?>
        <div class="alert alert-success" role="alert">
            แก้ไขข้อมูลเรียบร้อยแล้วค่ะ
        </div>
    <?php  } ?>
    <!-- row 1 -->
    <div class="container">
        <div class="row">
            <div class="col-6" style="margin-top: 30px;margin-left: 300px;">
                <div class="card">
                <h5 class="card-header">ข้อมูลสมาชิก</h5>
                    <div class="card-body" style="padding-left: 40px;">
                        <div class="form-group">
                            <label>ชื่อ : </label>
                            <?php echo $member["name"]; ?>
                        </div>
                        <div class="form-group">
                            <label>Username : </label>
                            <?php echo $member["username"]; ?>
                        </div>
                        <div class="form-group">
                            <label>Password : </label>
                            <?php echo $member["password"]; ?>
                        </div>

                        <div class="form-group">
                            <label>E-mail : </label>
                            <?php echo $member["email"]; ?>
                        </div>
                        
                        <div class="form-group">
                            <label>เบอร์โทรศัพท์ : </label>
                            <?php echo $member["tel"]; ?>
                        </div>

                        <div class="form-group">
                            <label>Birthday :</label>
                            <?php echo $member["birthday"]; ?>
                        </div>

                        <div class="form-group">
                            <label>ที่อยู่ : </label>
                            <?php echo $member["address"]; ?>
                        </div>

                        <!-- <div class="form-group" style="margin:40px 0px;"> -->
                        <a class="btn btn-outline-success float-left" href="home.php" role="button">
                            <i class="fas fa-edit fa-lg icon"></i>ย้อนกลับ</a>
                        <a class="btn btn-outline-warning float-right" href="#" role="button" data-toggle="modal" data-target="#edit-frofile">
                            <i class="fas fa-edit fa-lg icon"></i>แก้ไขข้อมูล</a>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal form register -->
    <div class="modal" id="edit-frofile" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form method="post" action="../../src/admin/process_update_data_member.php">
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">ชื่อ - สกุล</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php echo $member["name"]; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Username</label>
                        <input id="username" type="text" name="username" class="form-control" value="<?php echo $member["username"]; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input id="password" type="text" name="password" class="form-control" value="<?php echo $member["password"]; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">วันเกิด</label>
                        <input id="birthday" type="date" name="birthday" class="form-control" value="<?php echo $member["birthday"]; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">เบอร์โทรศัพท์</label>
                        <input id="tel" type="text" name="tel" class="form-control" value="<?php echo $member["tel"]; ?>">
                    </div>
                </div>

                <div class="form-group">
                <label for="message-text" class="col-form-label">E-mail</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $member["email"]; ?>">
                </div>

                <div class="form-group">
                <label for="message-text" class="col-form-label">ที่อยู่</label>
                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $member["address"]; ?>">
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