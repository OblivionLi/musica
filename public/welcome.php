<?php
require_once('../private/initialize.php');

$username = '';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for('assets/styles/style.css'); ?>">

    <title>Welcome - Musica</title>
</head>

<body class="container">
    <header class="welcome-header">
        <div class="logo">
            <a href="index.php"><img class="logo-img" src="<?php echo url_for('assets/img/logo.png'); ?>" alt="Logo.png"></a>
        </div>
    </header>

    <section class="welcome">
        <?php
        if (empty($username)) {
            echo 
                '
                    <p>You need to be logged in before accessing the main page.</p>
                    <a href="./pages/auth/login.php" class="link">Go to login page.</a>
                ';
        } else {
            echo 
                '
                    <p>You are already logged in as ' . strtoupper($username) . ' , what are you doing???</p>
                    <a href="' . url_for('index.php') . '" class="link">Go Home already..</a>
                ';
        }

        ?>
    </section>

    <footer>
        <p>Made by <a href="mailto:liviuandrei.dev@gmail.com" class="copyright">Liviu Andrei</a> &copy 2021 </p>
    </footer>
</body>

</html>