<?php

define('DEBUG', true);

define('DB_NAME', 'frame'); // database name
define('DB_USER', 'admin'); // database user
define('DB_PASSWORD', 'admin'); // database password
define('DB_HOST', 'localhost'); // database password or use IP for security 127.0.0.1

define('DEFAULT_CONTROLLER', 'Home'); // dfault controller if there isn't one defined in the url
define('DEFAULT_LAYOUT', 'default'); // if no layout is set in the controller use this layout.

define('PROOT', '/frame/'); // set this to '/' for a live server. 

define('PFILE', '/var/www/html/frame/files/'); // destination to files folder

define('SITE_TITLE', 'Ceci MVC frame'); // this will be uset if no site title is set

define('ADMIN_TITLE', 'admin panel'); // this will be uset if no site title is set

define('MENU_BRAND', 'FRAME'); //this is the nramd text in the menu


define('CURRENT_USER_SESSION_NAME', 'BikErCeCi'); //session name for logged in user

define('REMEMBER_ME_COOKIE_NAME', 'SDFSADSA546ASDsad4'); //cookie name for  in logged user remember me

define('REMEMBER_ME_COOKIE_EXPIRY', 2592000); // time in seconds for remember me cookie to live (30 days);

define('ACCESS_RESTRICTED', 'Restricted'); //controller name for the restricted redirect

// ADMIN PANEL

define('ADMIN_USER', '/frame/admin/user/');

define('ADMIN_EDIT', '/frame/admin/edit/');
