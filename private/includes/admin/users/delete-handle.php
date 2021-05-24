<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/users/index.php'));
}

$id = $_GET['id'];

if ($db) {
    if (isset($_POST['delete-user']) && filter_has_var(INPUT_POST, 'delete-user')) {

        $query = 'DELETE FROM users 
                        WHERE id = :id
                    ';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        redirect_to(url_for('../public/pages/admin/users/index.php'));
    }
}
?>