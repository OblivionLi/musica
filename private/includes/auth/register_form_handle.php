<?php require_once('../../initialize.php') ?>

<?php

// check if db is connected
if ($db) {
    // define vars
    $username = '';
    $email = '';
    $pass = '';
    $confirm_pass = '';
    $role = 0;
    $error = [];

    // check if register btn is pressed
    if (isset($_POST['register']) && filter_has_var(INPUT_POST, 'register')) {
        
        // reset sessions
        unset($_SESSION['errors']);

        // validate $_POST inputs
        $username = h(st($_POST['username']));
        $username = str_replace(' ', '', $username);

        if (strlen($username) > 10 || strlen($username) < 2) {
            array_push($error, "Your username must be between 2 and 10 characters.");
        }

        $email = h(st($_POST['email']));
        $email = str_replace(' ', '', $email);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            $email_check = check_email_unique($email);

            $num_rows = $email_check->fetchColumn();

            if ($num_rows > 0) {
                array_push($error, "Email already in use.");
            }
        } else {
            array_push($error,  "Email has invalid format.");
        }

        $pass = h(st($_POST['password']));
        $confirm_pass = h(st($_POST['confirm_password']));

        if ($pass != $confirm_pass) {
            array_push($error, "Your passwords do not match.");
        } else {
            if (preg_match('/[^A-Za-z0-9]/', $pass)) {
                array_push($error, "Your password can only contain english characters or numbers.");
            }
        }

        if (empty($error)) {
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

            $query = 'INSERT INTO users 
                            SET 
                                username = :username,
                                email = :email,
                                password = :password,
                                role = :role,
                                created_at = NOW()
                    ';
            
            $stmt = $db->prepare($query);

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_pass);
            $stmt->bindParam(':role', $role);

            $stmt->execute();

            redirect_to(url_for('../public/pages/auth/login.php'));
        } else {
            
            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/auth/register.php'));
        }
    }
}
?>