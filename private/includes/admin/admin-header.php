<?php


$username = '';
$role = '';

is_logged();

if (isset($_SESSION['role'])) {
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
}

if ($role < 1) {
    redirect_to(url_for('index.php'));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for('assets/styles/style.css'); ?>">

    <link rel="stylesheet" href="<?php echo url_for('assets/styles/admin.css'); ?>">

    <title>Musica - Administration Area</title>
</head>

<body>

    <aside class="admin-sidebar" id="sidebar">
        <div class="close-btn">
            <span onclick="closeNav()" class="c-btn">X</span>
        </div>

        <nav class="sidebar-nav">
            <ul class="sidebar-list">
                <li><a class="sidebar-link" href="<?php echo url_for('pages/admin/index.php'); ?>">Dashboard</a></li>
                <li><a class="sidebar-link" href="<?php echo url_for('pages/admin/users/index.php'); ?>">Users</a></li>
                <li class="border"></li>
                <li><a class="sidebar-link" href="<?php echo url_for('pages/admin/albums/index.php'); ?>">Albums</a></li>
                <li class="border"></li>
                <li><a class="sidebar-link" href="<?php echo url_for('pages/admin/songs/index.php'); ?>">Songs</a></li>
                <li><a class="sidebar-link" href="<?php echo url_for('pages/admin/genres/index.php'); ?>">Genres</a></li>
                <li class="border"></li>
                <li><a class="sidebar-link" href="<?php echo url_for('pages/admin/artists/index.php'); ?>">Artists</a></li>
                <li><a class="sidebar-link" href="<?php echo url_for('pages/admin/groups/index.php'); ?>">Groups</a></li>
                <li><a class="sidebar-link" href="<?php echo url_for('pages/admin/conductors/index.php'); ?>">Conductors</a></li>
            </ul>
        </nav>
    </aside>

    <section class="admin-content" id="main">
        <header class="admin-header">
            <nav class="admin-navbar">
                <div>
                    <button id="menu" onclick="openNav()" class="openMenu">Open Sidebar</button>
                </div>

                <ul class="admin-links">
                    <?php
                    if ($username) {
                        echo
                        '<li>
                        <div class="dropdown">
                        <a class="link">' . $username . '</a>
                        <div class="dropdown-content">
                        <a href="' . url_for('pages/auth/logout.php') . '">Logout</a>
                        </div>
                        </div>
                        </li>';
                    } else {
                        redirect_to(url_for('index.php'));
                    }
                    ?>
                    <li><a class="link" href="<?php echo url_for('index.php'); ?>">Home</a></li>
                </ul>
            </nav>
        </header>

        

