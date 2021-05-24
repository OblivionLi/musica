<?php 

require_once('../../../private/initialize.php');

unset($_SESSION['username']);
unset($_SESSION['role']);

session_destroy();
redirect_to(url_for('welcome.php'))

?>