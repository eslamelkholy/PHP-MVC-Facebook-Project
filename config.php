<?php
ob_start();
session_start();

ini_set('display_errors', 1);

// Database Credentials
define('HOSTNAME', 'localhost');
define('DBNAME', 'facebook');
define('DBUSER', 'root');
define('DBPASS', '');

// Paths
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('APP_PATH', dirname(realpath(__FILE__)));
define('MODELS_PATH', APP_PATH . DS . 'Model');
define('VIEWS_PATH', APP_PATH . DS . 'Views');
define('CONTROLLERS_PATH', APP_PATH . DS . 'Controller');
define('LIB_PATH', APP_PATH . DS . 'public');

// Web Directories
define('CONTROLLERS', '/IslamicLibrary/controllers/');

// Database Connection
$db = $connect = mysqli_connect("localhost","root","","facebook");
// $db = new PDO('mysql://localhost=' . HOSTNAME . ';dbname=' . DBNAME, DBUSER, 
//         DBPASS, array(
//                 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//         ));

$path = get_include_path().PS.LIB_PATH;
set_include_path($path);

// define an autoloader function 

function facebookAutoLoad($className)
{
    require_once MODELS_PATH.DS.strtolower($className). '.class.php';
}
spl_autoload_register('facebookAutoLoad');