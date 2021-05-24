<?php require_once('../../../private/initialize.php') ?>

<?php

$errors = [];

if (isset($_SESSION['username'])) {
  header("Location: ../../index.php");
}

if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="<?php echo url_for('assets/styles/style.css'); ?>">
  <title>Login Page</title>
</head>

<body class="container">
  <header class="header">
    <div class="logo">
      <a href="<?php echo url_for('index.php'); ?>"><img class="logo-img" src="<?php echo url_for('assets/img/logo.png'); ?>" alt="Logo.png"></a>
    </div>

    <div class="links">
      <ul class="links-list">
        <li><a class="link" href="<?php echo url_for('pages/auth/login.php'); ?>">Login</a></li>
        <li><a class="link" href="<?php echo url_for('pages/auth/register.php'); ?>">Register</a></li>
      </ul>
    </div>
  </header>


  <section class="content">
    <h3 class="content-title">Login</h3>

    <div style="color: red;">
      <?php echo in_array('Sorry, this user doesn\'t exist in our database', $errors) ? "<span>&#8594;</span> Sorry, this user doesn't exist in our database" : ""; ?>
    </div>

    <div class="auth-content">
      <form class="auth-form" action="../../../private/includes/auth/login_form_handle.php" method="POST">
        <div class="form-control-auth">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Type your username here.." required />
        </div>

        <div class="form-control-auth">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Type your password here.." required />
          <div style="color: red;">
            <?php echo in_array("Username or Password are incorrect.", $errors) ? "<span>&#8594;</span> Username or Password are incorrect." : ""; ?>
          </div>
        </div>

        <div class="form-control-auth">
          <button type="submit" class="auth-btn" name="login">Login</button>
        </div>
      </form>

      <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/auth/register.php'); ?>">Don't have an account yet?</a>
        <a class="link" href="<?php echo url_for('welcome.php'); ?>">Nevermind...</a>
      </div>
    </div>
  </section>


  <footer>
    <p>Made by <a href="mailto:liviuandrei.dev@gmail.com" class="copyright">Liviu Andrei</a> &copy 2021 </p>
  </footer>
</body>

</html>