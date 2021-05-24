<?php require_once('../../initialize.php') ?>

<?php

// check if db is connected
if ($db) {
    // define vars
    $username = '';
    $pass = '';
    $error = [];

    // check if login btn is pressed
    if (isset($_POST['login']) && filter_has_var(INPUT_POST, 'login')) {

        // reset sessions
        unset($_SESSION['errors']);

        // validate $_POST inputs
        $username = h(st($_POST['username']));
        $username = str_replace(' ', '', $username);

        $pass = h(st($_POST['password']));

        // find user by username
        $user_query = read_user($username);

        // fetch data from query
        $fetch_user_data = $user_query->fetch(PDO::FETCH_ASSOC);

        // check if there is any result from fetched data
        if ($fetch_user_data) {
            // get fetched data
            $user = $fetch_user_data['username'];
            $hash_pass = $fetch_user_data['password'];
            $role = $fetch_user_data['role'];

            // verify passwords
            if (password_verify($pass, $hash_pass)) {
                // create sessions
                $_SESSION['username'] = $user;
                $_SESSION['role'] = $role;

                // redirect back to index.php
                redirect_to(url_for('../public/index.php'));
            } else {
                // push error in error array
                array_push($error, "Username or Password are incorrect.");

                // create errors session
                $_SESSION['errors'] = $error;

                // redirect back to login.php
                redirect_to(url_for('../public/pages/auth/login.php'));
            }
        } else {
            // push error in error array
            array_push($error, 'Sorry, this user doesn\'t exist in our database');

            // create errors session
            $_SESSION['errors'] = $error;

            // redirect back to login.php
            redirect_to(url_for('../public/pages/auth/login.php'));
        }
    }
}
?>