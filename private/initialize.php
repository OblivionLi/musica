<?php 

// Start the session
session_start();

// define global variables for path finding
define('PRIVATE_PATH', dirname(__FILE__));
define('PROJECT_PATH', dirname(PRIVATE_PATH));
define('PUBLIC_PATH', PROJECT_PATH . '/public');
define('SHARED_PATH', PRIVATE_PATH . '/includes');

// get /public path
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define('WWW_ROOT', $doc_root);

// import class functions
require_once('database/database.php');
require_once('config/functions.php');
require_once('config/users_query_func.php');
require_once('config/albums_query_func.php');
require_once('config/artists_query_func.php');
require_once('config/groups_query_func.php');
require_once('config/conductors_query_func.php');
require_once('config/genres_query_func.php');
require_once('config/songs_query_func.php');

// connect to db
$db = db_connect();

?>