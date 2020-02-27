<?php 
class Post
{
    private $postContent;
    private $userid;
    public function setPostContent($_postContent)
    {
        $this->postContent = Validation::validateText($_postContent);
    }
    public function getPostContent(){return $this->postContent;}
    public function setCommentUserId($_userid)
    {
        $this->userid = Validation::validateNumber($_userid);
    }
    public function getCommentUserId(){return $this->userid;}

    //Add Post Section
    public function addPost()
    {
        global $db;
        if(!isset($this->postContent) || empty($this->postContent))
            return false;
        else
        {
            $result = mysqli_query($db,"INSERT INTO posts SET postContent = '$this->postContent',userid = '$this->userid'");
            return ($result) ? true : false;
        }
    }
    //Update Post Section
    public static function editPost($postValues)
    {
        global $db;
        $postContent = mysqli_escape_string($db,$postValues['postContent']);
        $postId = mysqli_escape_string($db,$postValues['postid']);
        if(empty($postContent)) return false;
        $result = mysqli_query($db,"UPDATE posts SET postContent = '$postContent' WHERE postid = '$postId'");
        return ($result) ? true : false;
    }
    //Delete Post Section
    public static function deletePost($postId)
    {
        global $db;
        $result = mysqli_query($db,"DELETE FROM posts WHERE postid ='$postId'");
        return ($result) ? true : false;
    }
}

?>