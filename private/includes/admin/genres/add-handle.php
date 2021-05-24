<?php require_once('../../../initialize.php') ?>

<?php

if ($db) {
    $name = '';
    $error = []; 

    if (isset($_POST['add-genre']) && filter_has_var(INPUT_POST, 'add-genre')) {

        unset($_SESSION['errors']);

        $name = h(st($_POST['name']));

        if (empty($name)) {
            array_push($error, "Genre name field can't be empty.");
        }

        if (empty($error)) {
            $query = 'INSERT INTO genres 
                        SET 
                            name = :name,
                            created_at = NOW()
                ';

            $stmt = $db->prepare($query);

            $stmt->bindParam(':name', $name);

            $stmt->execute();
            redirect_to(url_for('../public/pages/admin/genres/index.php'));
        } else {
            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/admin/genres/add.php'));
        }
    }
}
?>