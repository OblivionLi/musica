<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/conductors/index.php'));
}

$id = $_GET['id'];

$conductor = find_conductor_by_id($id)->fetch();

if ($db) {
    if (isset($_POST['delete-conductor']) && filter_has_var(INPUT_POST, 'delete-conductor')) {

        $query = 'DELETE FROM conductors 
                        WHERE id = :id
                    ';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        redirect_to(url_for('../public/pages/admin/conductors/index.php'));
    }
}
?>