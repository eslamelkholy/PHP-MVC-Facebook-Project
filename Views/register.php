<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Responsive Page</title>
    <link href="../public/css/bootstrap.css" rel="stylesheet" />
    <link href="../public/css/bootstrap.css" rel="stylesheet"/>
    <style>
        body{
            background-color: #EEf;
        }
        *{
            padding: 0;
            margin: 0;
        }
        .container{
            margin-top: 50px;
        }
        h1{
            color: lightseagreen;
            margin-bottom: 50px;
            margin-top: 50px;
            margin-left: -110px;
        }
        .btn{
            margin-left: 120px;
            width: 200px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1 align="Center">Registration Page</h1>
    <form class="col-5 offset-3" method="POST" action="../Controller/Authentication.php" enctype="multipart/form-data">
    
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" class="form-control" name="full_name"/>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" />
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address" />
        </div>
        <div class="form-group">
            <label>Profile Pic</label>
            <input type="file" class="form-control" name="user_pic" id="user_pic" />
        </div>
        <input type="submit" value="Register" name="register" class="btn btn-success">
        </form>
    </div>
      <script src="../public/js/JQuery-3.3.1.min.js"></script>
    <script src="../public/js/popper.js"></script>
    <script src="../public/js/bootstrap.js"></script>
</body>
</html>
