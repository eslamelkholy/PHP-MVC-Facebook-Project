<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="../public/css/bootstrap.css" rel="stylesheet" />
    <link href="../public/css/bootstrap.css" rel="stylesheet"/>
    <style>
        body{
            background-color: mintcream;
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
            margin-top: -30px;
            margin-left: -150px;
        }
        .row{
            margin-top: 40px;
        }
        .post{
            background-color: #EEE;
            height: 450px;
            border-radius: 10px;
            border: 2px solid lightgray;
        }
        .postPublisher{
            margin-top: 5px;
            height: 100px;
        }
        .postContent{
            height: 210px;

        }
        .comment{
            height: 140px;
        }
        .postImg{
            height: 80px;
            width: 80px;
            border-radius: 50%;
            float: left;
        }
        h4{
            margin-left: 10px;
            margin-top: 25px;
            float: left;
        }
        .submitComment{
            margin-top: -10px;
        }
        .btnControllers{
            float:right;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/admin/profile">Profile</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/speaker/list">Timeline</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/speaker/list">Notifications</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/speaker/list">Friends List</span></a>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Logout</span></a>
            </li>
            <li class="nav-item active">
                <button class="btn btn-outline-success my-2 my-sm-0">Welcome Eslam</button>
            </li>
        </ul>
    </nav>
    <?php 
        if(isset($_POST))
            foreach($_POST as $key => $value)
                if($key != "addPost")
                    file_put_contents("lab2.txt","eslam,".$value."\n",FILE_APPEND);
        if(isset($_GET["id"]))
        {
            $counter = 0;
            
            $row_number = (int)$_GET["id"];    // Number of the line we are deleting
            $file_out = file("lab2.txt"); // Read the whole file into an array
            //Delete the recorded line
            unset($file_out[$row_number]);

            //Recorded in a file
            file_put_contents("lab2.txt", implode("", $file_out));
        }
    ?>
    <div class="container">
        <form method="POST" class="col-9" action="">
            <div class="form-group">
                <label>Add Post..</label>
                <input type="text" class="form-control" name="userPost" />
            </div>
            <input type="submit" value="addPost" name="addPost" class="btn btn-primary submitComment">
        </form>
        <?php 
            $file = fopen("lab2.txt","r");
            while(! feof($file))
            {
                $arr = explode(",",fgets($file));
                if($arr[0] != "")
                { ?>
                    <div class="row">
                        <div class="col-8 offset-2 post">
                            <div class="postPublisher">
                                <img class="postImg" src="../public/Images/2.jpg">
                                <h4>Eslam Elkholy</h4>
                                <div class="btnControllers">
                                <a href="editPost.php?id=<?php echo $arr[0] ?>" class="btn btn-primary">Edit Post</a>
                                <a href="?id=<?php echo $arr[0] ?>" class="btn btn-danger">Delete Post</a>
                                </div>
                            </div>
                            <div class="postContent">
                                <p><?php echo $arr[2]  ?></p>
                            </div>
                            <div class="comment">
                                <form method="GET" class="col-9" action="">
                                    <div class="form-group">
                                        <label>Comment..</label>
                                        <input type="text" class="form-control" name="comment" />
                                    </div>
                                    <input type="submit" value="Add Comment" name="addComment" class="btn btn-primary submitComment">
                                </form>
                            </div> 
                        </div>
                    </div>
            <?php
                }
            }
            fclose($file); 
            ?>
        
    </div>
      <script src="../public/js/JQuery-3.3.1.min.js"></script>
    <script src="../public/js/popper.js"></script>
    <script src="../public/js/bootstrap.js"></script>
</body>
</html>
