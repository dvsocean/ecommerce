<?php 
ob_start();


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', DS . 'Applications' . DS . 'XAMPP' . DS . 'htdocs');
define('INCLUDES_PATH', SITE_ROOT . DS . 'setup');

require_once "new_config.php";
require_once "database.php";
require_once "object.php";
require_once "comments_class.php";
require_once "user.php";
require_once "photo.php";
require_once "session.php";
require_once "extra_image.php";
require_once "nav_bar.php";
?>

