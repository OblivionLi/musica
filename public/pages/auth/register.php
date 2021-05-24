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
  <title>Register Page</title>
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
    <h3 class="content-title">Register</h3>

    <div class="auth-content">
      <form class="auth-form" action="../../../private/includes/auth/register_form_handle.php" method="POST">
        <div class="form-control-auth">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Type your username here.." required />
          <div style="color: red;">
            <?php echo in_array("Your username must be between 2 and 10 characters.", $errors) ? "<span>&#8594;</span> Your username must be between 2 and 10 characters." : ""; ?>
          </div>
        </div>

        <div class="form-control-auth">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Type your email here.." required />
          <div style="color: red;">
            <?php
            if (in_array("Email already in use.", $errors)) echo "<span>&#8594;</span> Email already in use.";
            else if (in_array("Email has invalid format.", $errors)) echo "<span>&#8594;</span> Email has invalid format.";
            ?>
          </div>
        </div>

        <div class="form-control-auth">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Type your password here.." required />
        </div>

        <div class="form-control-auth">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" id="confirm_password" name="confirm_password" placeholder="Type your password again.." required />
          <div style="color: red;">
            <?php echo in_array("Your passwords do not match.", $errors) ? "<span>&#8594;</span> Your passwords do not match." : ""; ?>
          </div>
        </div>

        <div class="form-control-auth">
          <button type="submit" class="auth-btn" name="register">Register</button>
        </div>
      </form>

      <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/auth/login.php'); ?>">Already have an account?</a>
        <a class="link" href="<?php echo url_for('welcome.php'); ?>">Nevermind...</a>
      </div>
    </div>

  </section>


  <footer>
    <p>Made by <a href="mailto:liviuandrei.dev@gmail.com" class="copyright">Liviu Andrei</a> &copy 2021 </p>
  </footer>
</body>

</html>