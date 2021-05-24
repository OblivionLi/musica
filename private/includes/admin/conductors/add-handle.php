<?php require_once('../../../initialize.php') ?>

<?php

if ($db) {
    $name = '';
    $group_id = '';
    $error = [];

    if (isset($_POST['add-conductor']) && filter_has_var(INPUT_POST, 'add-conductor')) {

        unset($_SESSION['errors']);

        $name = h(st($_POST['name']));

        if (empty($name)) {
            array_push($error, "Conductor name field can't be empty.");
        }

        $group_id = h(st($_POST['group']));

        if (empty($error)) {
            $query = 'INSERT INTO conductors 
                        SET 
                            name = :name,
                            group_id = :group_id,
                            created_at = NOW()
                ';

            $stmt = $db->prepare($query);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':group_id', $group_id);

            $stmt->execute();

            redirect_to(url_for('../public/pages/admin/conductors/index.php'));
        } else {
            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/admin/conductors/add.php'));
        }
    }
}
?>