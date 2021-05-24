<?php require_once('../../../initialize.php') ?>

<?php

// check if db is connected
if ($db) {
    // define vars
    $name = '';
    $error = [];

    // check if search-form btn is pressed
    if (isset($_POST['search-form']) && filter_has_var(INPUT_POST, 'search-form')) {

        // reset sessions
        unset($_SESSION['errors']);

        // validate $_POST inputs
        $name = h(st($_POST['name']));

        // check if name is empty
        if (empty($name)) {
            // push error in error var
            array_push($error, "Genre name field can't be empty.");
        }

        // check if error var is empty
        if (empty($error)) {

            // create query
            $query = 'INSERT INTO genres 
                        SET 
                            name = :name,
                            created_at = NOW()
                ';

            // prepare query
            $stmt = $db->prepare($query);

            // bind value to query
            $stmt->bindParam(':name', $name);

            // execute query
            $stmt->execute();

            // redirect back to index.php
            redirect_to(url_for('../public/pages/admin/genres/index.php'));
        } else {
            // create session with errors
            $_SESSION['errors'] = $error;
            // redirect back to index.php
            redirect_to(url_for('../public/pages/admin/genres/add.php'));
        }
    }
}
?>