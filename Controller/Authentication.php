<?php
    require_once '..' . DIRECTORY_SEPARATOR . 'config.php';
    $user = new User();

    //Register User
    if(isset($_POST['register']))
    {    
        $user->setFullName($_POST['full_name']);
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);
        $user->setEmail($_POST['email']);
        $user->setAddress($_POST['address']);
        $user->setFileContent($_FILES);
        if($user->registerValidation() == 0)
            $user->addUser();
        else
            header("Location:../Views/register.php");
    } 
    //Login User
    else if ($_POST["login"]) 
    {
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);
        $loginUser = $user->loginValidation($_POST);
        if($loginUser)
        {
            session_start();
            $_SESSION['full_name'] = $loginUser['full_name'];
            $_SESSION['userid'] = $loginUser['userid'];
            $_SESSION['pic'] = $loginUser['pic'];
            header("Location:../Views/timeLine.php");
        }
        else
            header("Location:../Views/login.php");
    }
?>