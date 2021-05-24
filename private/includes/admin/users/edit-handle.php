<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/users/index.php'));
}

$id = $_GET['id'];

if ($db) {
    $username = '';
    $email = '';
    $role = '';
    $error = [];

    if (isset($_POST['update-user']) && filter_has_var(INPUT_POST, 'update-user')) {
        
        unset($_SESSION['errors']);

        $username = h(st($_POST['username']));

        $username = str_replace(' ', '', $username);

        if (strlen($username) > 10 || strlen($username) < 2) {
            array_push($error, "Username must be between 2 and 10 characters.");
        }

        $email = h(st($_POST['email']));
        $email = str_replace(' ', '', $email);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        } else {
            array_push($error,  "Email has invalid format.");
        }

        $role = $_POST['role'];

        if (empty($error)) {
            
            $query = 'UPDATE users 
                            SET 
                                username = :username,
                                email = :email,
                                role = :role,
                                updated_at = NOW()
                            WHERE id = :id
                    ';
            
            $stmt = $db->prepare($query);

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            print_r($stmt);

            redirect_to(url_for('../public/pages/admin/users/index.php'));
        
        } else {
            
            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/admin/users/edit.php?id=' . $id));
        }
    }
}
?>