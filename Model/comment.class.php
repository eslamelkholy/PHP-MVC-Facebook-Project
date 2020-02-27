<?php 

class Comment
{
    private $commentBody;
    private $postId;
    private $userId;
    
    public function setCommentBody($_commentBody)
    {
        $this->commentBody = Validation::validateText($_commentBody);
    }
    public function getCommentBody(){return $this->commentBody;}
    public function setPostId($_postId)
    {
        $this->postId = Validation::validateNumber($_postId);
    }
    public function getPostId(){return $this->postId;}
    public function setUserId($_userId)
    {
        $this->userId = Validation::validateNumber($_userId);
    }
    public function getUserId(){return $this->userId;}

    //Add Comment Section
    public function addComment()
    {
        global $db;
        if((empty($this->commentBody)))
            return false;
        $result = mysqli_query($db,"INSERT INTO comments SET commentcontent = '$this->commentBody',
            postid = '$this->postId',
            userid = '$this->userId'
        ");
        return ($result) ? true : false;
    }
    //Update Comment Section
    public static function editComment($_commentId,$_commentContent)
    {
        global $db;
        $_commentContent = Validation::validateText($_commentContent);
        $_commentId = Validation::validateNumber($_commentId);
        if(empty($_commentContent))
            return false;
        $result = mysqli_query($db,"UPDATE comments SET commentContent = '$_commentContent' WHERE commentid = '$_commentId'");
        return ($result) ? true : false;

    }
    public static function deleteComment($_commentId)
    {
        global $db;
        $commentId = mysqli_escape_string($db,$_commentId);
        $result = mysqli_query($db,"DELETE FROM comments WHERE commentid = '$commentId'");
        return ($result) ? true : false;
    }
}
?>