<?php 
class User
{
    private $full_name;
    private $username;
    private $password;
    private $email;
    private $address;
    private $FILE;
    public function setFullName($_fullName)
    {
        $this->full_name = Validation::validateText($_fullName);
    }
    public function getFullName(){return $this->full_name;}

    public function setUsername($_username)
    {
        $this->username = Validation::validateText($_username);
    }
    public function getUsername(){return $this->username;}

    public function setPassword($_password)
    {
        $this->password = Validation::validateText($_password);
    }
    public function getPassword(){return $this->password;}

    public function setEmail($_email)
    {
        $this->email = Validation::validateEmail($_email);
    }
    public function getEmail(){return $this->email;}
    
    public function setAddress($_address)
    {
        $this->address = Validation::validateText($_address);
    }
    public function getAddress(){return $this->address;}

    public function setFileContent($_FILE)
    {
        $this->FILE = $_FILE;
    }
    public function getFileContent(){return $this->FILE;}

    //Register User Validation Function
    public function registerValidation()
    {
        $errorArray = [];
        if(!isset($this->full_name) || empty($this->full_name))
            $errorArray[]="full_name";
        if(!isset($this->username) || empty($this->username))
            $errorArray[]="username";
        if(!isset($this->password) || empty($this->password))
            $errorArray[]="password";
        if(!isset($this->email) || empty($this->email) || !filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL))
            $errorArray[]="email";
        if(!isset($this->address) || empty($this->address))
            $errorArray[]="address";
        //Picture Validation
        $pic_name = $this->FILE["user_pic"]["name"];
        $allowed_ext = array('gif', 'png', 'jpg');
        $extension = pathinfo($pic_name, PATHINFO_EXTENSION);
        if(!in_array($extension,$allowed_ext))
            $errorArray[] = "error_extension";
        
        return count($errorArray);
    }
    //Add User >> Register User
    public function addUser()
    {
        global $db;
        $full_name = mysqli_escape_string($db,$this->full_name);
        $username = mysqli_escape_string($db,$this->username);
        $password = mysqli_escape_string($db,$this->password);
        $email = mysqli_escape_string($db,$this->email);
        $address = mysqli_escape_string($db,$this->address);
        //Picture Section
        $dir_to_upload = "../public/Images";
        $temp_file_name = $this->FILE["user_pic"]["tmp_name"];
        $pic_name = $this->FILE["user_pic"]["name"];
        if(move_uploaded_file($temp_file_name,$dir_to_upload."/".basename($pic_name)))
        {
            $result = mysqli_query($db,"INSERT INTO users SET full_name = '$full_name',
            username = '$username',
            password = '$password',
            email = '$email',
            address = '$address',
            pic = '$pic_name'
            ");
            if($result) header("Location:../Views/login.php");    
        }
    }
    //Login Validation
    public function loginValidation($loginData)
    {
        global $db;
        $errorArray = [];
        if(!isset($this->username) || empty($this->username))
            $errorArray[]="username";
        if(!isset($this->password) || empty($this->password))
            $errorArray[]="password";
        $username = mysqli_escape_string($db,$this->username);
        $password = mysqli_escape_string($db,$this->password);
        if(count($errorArray) > 0)
            return false;
        else
        {
            $checkUser = mysqli_query($db,"SELECT * FROM users WHERE username = '$username' AND password = '$password' ");
            return (mysqli_num_rows(($checkUser)) > 0) ? mysqli_fetch_assoc($checkUser) : false;
        }
    }
    
}

?>