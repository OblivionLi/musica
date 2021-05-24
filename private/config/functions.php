<?php

// function for path finding in the public directory
function url_for($string_path) {
    if ($string_path[0] != '/') {
        $string_path = '/' . $string_path;
    }

    return WWW_ROOT . $string_path;
}

// shortcut for htmlspecialchars()
function h($string) {
    return htmlspecialchars($string);
}

// shortcut for strip_tags()
function st($string) {
    return strip_tags($string);
}

// shortcut for header redirect
function redirect_to($location) {
    header('Location: ' . $location);
}

// check if user is logged
// by checked if $_SESSION['username'] is set
// if it's not then redirect to welcome.php page
function is_logged() {
    if (isset($_SESSION['username'])) {
        return true;
    } else {
        redirect_to(url_for('welcome.php'));
    }
}

?>