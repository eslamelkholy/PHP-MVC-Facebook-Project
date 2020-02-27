<?php
    require_once '..' . DIRECTORY_SEPARATOR . 'config.php';
    
    //Add Comments Section
    $myComment = new Comment();
    if(isset($_POST["addComment"]))
    {    
        $myComment->setUserId($_SESSION['userid']);
        $myComment->setCommentBody($_POST["comment"]);
        $myComment->setPostId($_POST["postid"]);

        if($myComment->addComment())
            header("Location:../Views/timeLine.php");
        else    
            header("Location:../Views/timeLine.php");
    }
    
    //Updating Comments
    elseif (isset($_POST["editComment"])) {

        if(Comment::editComment($_POST["commentid"],$_POST["commentContent"]))
            header("Location:../Views/timeLine.php");
        else
            echo "Error While Executing Query";
    }

    //Deleteing Comments
    elseif (isset($_GET["deleteCommentId"])) {
        
        if(Comment::deleteComment($_GET["deleteCommentId"]))
            header("Location:../Views/timeLine.php");
        else
            echo "Error While Executing Query..";
        
    }
?>