<?php require_once('../../../initialize.php') ?>

<?php

if ($db) {
    $name = '';
    $error = [];

    if (isset($_POST['add-group']) && filter_has_var(INPUT_POST, 'add-group')) {

        unset($_SESSION['errors']);

        $name = h(st($_POST['name']));

        if (empty($name)) {
            array_push($error, "Group name field can't be empty.");
        }

        if (empty($error)) {
            $query = 'INSERT INTO groups 
                        SET 
                            name = :name,
                            created_at = NOW()
                ';

            $stmt = $db->prepare($query);

            $stmt->bindParam(':name', $name);

            $stmt->execute();

            redirect_to(url_for('../public/pages/admin/groups/index.php'));
        } else {
            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/admin/groups/add.php'));
        }
    }
}
?>