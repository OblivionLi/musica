<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('/pages/admin/conductors/index.php'));
}

$id = $_GET['id'];

$conductor = find_conductor_by_id($id)->fetch();

if ($db) {
    $name = '';
    $error = [];

    if (isset($_POST['edit-conductor']) && filter_has_var(INPUT_POST, 'edit-conductor')) {
        unset($_SESSION['errors']);

        $name = h(st($_POST['name']));

        if (empty($name)) {
            array_push($error, "Conductor name field can't be empty.");
        }

        if (empty($error)) {
            $query = 'UPDATE conductors 
                            SET 
                                name = :name,
                                updated_at = NOW()
                            WHERE id = :id
                ';

            $stmt = $db->prepare($query);

            $stmt->bindParam(':name', $name);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            redirect_to(url_for('../public/pages/admin/conductors/index.php'));
        } else {

            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/admin/conductors/edit.php?id=' . h($group['id'])));
        }
    }
}
?>