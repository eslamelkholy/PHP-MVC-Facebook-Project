<?php
    //List All Posts
    session_start();
    if(isset($_GET["logout"]))
    {
        session_unset();
        session_destroy();
        header("Location:login.php");
    }
    if(isset($_SESSION['userid']))
    {
        $connect = mysqli_connect("localhost","root","","facebook");
        if($connect)
            $result = mysqli_query($connect,"SELECT * FROM posts");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Timeline</title>
    <link href="../public/css/bootstrap.css" rel="stylesheet" />
    <link href="../public/css/bootstrap.css" rel="stylesheet"/>
    <link href="../public/css/profile.css" rel="stylesheet"/>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="profile.php">Profile</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="timeLine.php">Timeline</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="">Notifications</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="">Friends List</span></a>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link text-danger" href="?logout=true">Logout</span></a>
            </li>
            <li class="nav-item active">
                <button style="margin-left: 10px" class="btn btn-outline-success my-2 my-sm-0"><?php echo $_SESSION['full_name']; ?></button>
            </li>
            <li class="nav-item active">
            <img class="commentImg" style="margin-left: 10px" src="../public/Images/<?php echo $_SESSION['pic']; ?>">
            </li>
        </ul>
    </nav>
    <div class="container">
        <!-- Add POST Section -->
        <form method="POST" class="col-9" action="../Controller/postController.php">
            <div class="form-group">
                <label>Add Post..</label>
                <input type="text" class="form-control" name="userPost" />
            </div>
            <input type="submit" value="addPost" name="addPost" class="btn btn-primary submitComment">
        </form>
         <!-- This POST Content -->
        <?php
            while($row = mysqli_fetch_assoc($result))
            {
                //********** Posts For Every User ********
                $postUserId = $row['userid'];
                $postUser = mysqli_query($connect,"SELECT * FROM users WHERE userid = '$postUserId'");
                $user = mysqli_fetch_assoc($postUser);
            ?>
            <div class="row">
                <div class="col-8 offset-2 post">
                    <div class="postPublisher">
                        <img class="postImg" src="../public/Images/<?php echo $user['pic'] ?>">
                        <h4><?php echo $user['full_name'] ?></h4>
                        <?php if($postUserId == $_SESSION['userid'] ){ ?>
                        <div class="btnControllers">
                            <a href="editPost.php?postid=<?php echo $row['postid'] ?>" class="btn btn-primary">Edit Post</a>
                            <a href="../Controller/postController.php?deletePostid=<?php echo $row['postid'] ?>" class="btn btn-danger">Delete Post</a>
                        </div>
                        <?php }?>
                    </div>
                    <div class="postContent">
                        <p><?php echo $row['postContent']; ?></p>
                    </div>
                    <!-- Comment Section -->
                    <!-- List All Related Comments -->
                    <?php 
                        $postId = $row['postid'];
                        //[1]- Select Related Post For the Comment
                        $comments = mysqli_query($connect,"SELECT * FROM comments WHERE postid = '$postId' ");
                        $counter = 0;
                        $ListFlag = TRUE;
                        while($rowComment = mysqli_fetch_assoc($comments))
                        {
                            //[2]- Select Related User For This Comment
                            $userCommentId = $rowComment['userid'];
                            $userComment = mysqli_query($connect,"SELECT full_name,pic FROM users WHERE userid = '$userCommentId'");
                            $userCommentData = mysqli_fetch_assoc($userComment);
                            //This For prevent Comments Overflow
                            $counter ++;
                            if($counter >2 && $ListFlag)
                                break;
                    ?>
                        <div class="userCommentsContainer">
                            <div class="userComment">
                                <img class="commentImg" src="../public/Images/<?php echo $userCommentData['pic']; ?>">
                                <?php if($rowComment['userid'] == $_SESSION['userid']){ ?>
                                <div class="commentControllers">
                                    <a href="editComment.php?commentId=<?php echo $rowComment['commentid'] ?>" class="btn btn-primary commentEdit" style="width:100px">Edit Comment</a>
                                    <a href="../Controller/commentController.php?deleteCommentId=<?php echo $rowComment['commentid'] ?>" class="btn btn-danger commentEdit" >Delete Comment</a>
                                </div>
                                <?php } ?>
                                <p class="usernameComment" style="font-weight:bold "><?php echo $userCommentData['full_name']; ?></p>
                                <p class="commentContent"><?php echo $rowComment['commentcontent'] ?></p>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- End Of Listing Comments -->
                    <div class="comment">
                        <form method="POST" class="col-9" action="../Controller/commentController.php">
                            <div class="form-group">
                                <a class="btn btn-success" class="seeMoreBtn" style=" margin-right: -150px;margin-left:-105px;float:right;">See More..</a>
                                <input id="addComment" type="text" class="form-control" name="comment" />
                            </div>
                            <input type="hidden" value="<?php echo $row['postid'] ?>" name="postid" />
                            <input type="submit" value="Add Comment" name="addComment" class="btn btn-primary submitComment">
                            
                        </form>
                    </div> 
                </div>
            </div>

        <?php } 
        }
        else
            header("Location:login.php");
        ?>
       
        
        
    </div>
      <script src="../public/js/JQuery-3.3.1.min.js"></script>
    <script src="../public/js/popper.js"></script>
    <script src="../public/js/bootstrap.js"></script>
</body>
</html>
