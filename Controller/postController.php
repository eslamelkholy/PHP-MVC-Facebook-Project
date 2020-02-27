<?php
    require_once '..' . DIRECTORY_SEPARATOR . 'config.php';
    //Add Post Section
    if(isset($_POST["addPost"]))
    {
        $myPost = new Post();
        $myPost->setPostContent($_POST['userPost']);
        $myPost->setCommentUserId($_SESSION['userid']);
        $myPost->addPost();
        header("Location:../Views/timeLine.php");        
    }

    //Update Post Section
    elseif(isset($_POST["editPost"]))
    {   
        Post::editPost($_POST);
        header("Location:../Views/timeLine.php");    
    }
    
    //Delete Post
    elseif(isset($_GET['deletePostid']))
    {
        Post::deletePost($_GET['deletePostid']);
        header("Location:../Views/timeLine.php");
    }
?>