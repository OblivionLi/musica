<?php

$username = '';
$role = '';

if (is_logged()) {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo url_for('assets/styles/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo url_for('assets/styles/pagination.css'); ?>">

    <title>Musica - Home Page</title>
</head>

<body class="container">

    <header class="header">
        <div class="logo">
            <a href="index.php"><img class="logo-img" src="<?php echo url_for('assets/img/logo.png'); ?>" alt="Logo.png"></a>
        </div>

        <div class="links">
            <ul class="links-list">
                <li><a class="link" href="<?php echo url_for('index.php'); ?>">Home</a></li>
                <li><a class="link" href="<?php echo url_for('/pages/about.php'); ?>">About</a></li>
                <?php
                if (empty($username)) {
                    echo '<li><a class="link" href="' . url_for('pages/auth/register.php') . '">Register</a></li>';
                    echo '<li><a class="link" href="' . url_for('pages/auth/login.php') . '">Login</a></li>';
                } else {
                    echo
                    '<li>
                        <div class="dropdown">
                            <a class="link">' . $username . '</a>
                            <div class="dropdown-content">
                                <a href="' . url_for('pages/auth/logout.php') . '">Logout</a>
                            </div>
                        </div>
                    </li>';

                    echo $role == 1 ? '<li><a class="link" href="' . url_for('pages/admin/index.php') . '">Administration</a></li>' : '';
                }
                ?>
            </ul>
        </div>

    </header>
