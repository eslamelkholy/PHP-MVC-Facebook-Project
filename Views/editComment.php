<?php 
    session_start();
    if(isset($_SESSION['userid']))
    {
        $connect=mysqli_connect("localhost","root","","facebook");
        if($connect)
        {
            $result = mysqli_query($connect,"SELECT * FROM comments WHERE commentid = '{$_GET['commentId']}'");
            if($result)
                $oldComment = mysqli_fetch_assoc($result);
        }   
        else
            echo "Connection failed" 

?>
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
    <?php
        
    ?>
    <div class="container">
    <h1 align="Center">Edit Comment Page</h1>
    <form class="col-5 offset-3" method="POST" action="../Controller/commentController.php">
        <div class="form-group">
            <label>Post Content</label>
            <input type="text" class="form-control" name="commentContent" value = "<?php echo $oldComment['commentcontent'] ?>" />
        </div>
        <input type="hidden" value = "<?php echo $oldComment['commentid'] ?>" name="commentid">
        <input type="submit" value="Edit Post" class="btn btn-primary" name="editComment">
        </form>
    </div>
      <script src="../public/js/JQuery-3.3.1.min.js"></script>
    <script src="../public/js/popper.js"></script>
    <script src="../public/js/bootstrap.js"></script>
</body>
</html>

<?php }
    else
        header("Location:login.php");
    ?>
