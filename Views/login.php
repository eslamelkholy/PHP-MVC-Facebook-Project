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
            margin-top: 100px;
            margin-left: -100px;
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
    <h1 align="Center">Login Page</h1>
    <form class="col-5 offset-3" method="POST" action="../Controller/authentication.php">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" />
        </div>
        <input type="submit" value="Login" class="btn btn-primary" name="login">
        <a href="register.php" class="btn btn-success">Register</a>
        </form>
    </div>
      <script src="../public/js/JQuery-3.3.1.min.js"></script>
    <script src="../public/js/popper.js"></script>
    <script src="../public/js/bootstrap.js"></script>
</body>
</html>
