<?php

use Core\Session;
use Core\Cookie;
use Core\Router;
use App\Models\Users;
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));


//LOAD CONFIGURATION AND HELPERS FUNCTIONS
require_once(ROOT . DS . 'config' . DS . 'config.php');


function autoload($class_name)
{
    $class_array = explode('\\', $class_name);
    $class = array_pop($class_array);
    $sub_path = strtolower(implode(DS, $class_array));

    $path = ROOT . DS . $sub_path . DS . $class . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
}

// USE SPL FOR AUTOLOAD WITHOUT MAGIC METHODS
spl_autoload_register('autoload');
session_start();


$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];


// CHECK USER SESSION IF USER SESSION IF THERE  IS NOT USER SESSION GO FOR USER FOR COOKIE
if (!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
    Users::login_user_from_cookie();
}

//ROUTE THE REQUIRES
Router::route($url);
