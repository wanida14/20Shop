<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
</head>
<style>
    * {
        font-family: 'Kanit', sans-serif;
    }

    body {
        background-color: #eee;
    }

    .style-form {
        background-color: burlywood;
        padding-top: 40px;
        border-bottom-width: 20px;
        padding-bottom: 40px;
        padding-left: 40px;
        padding-right: 40px;
        margin-top: 10px;
        border-radius: 2%

    }
</style>

<body>
    <div class="container" style="margin-top: 70px;">
        <div class="row text-center">
            <div class="col">
                <div>
                    <h4>ระบบ Login สำหรับ Admin</h4>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-5 style-form">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-success">Login</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>