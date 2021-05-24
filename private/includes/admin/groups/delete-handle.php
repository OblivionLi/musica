<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/groups/index.php'));
}

$id = $_GET['id'];

$group = find_group_by_id($id)->fetch();

if ($db) {
    if (isset($_POST['delete-group']) && filter_has_var(INPUT_POST, 'delete-group')) {

        $query = 'DELETE FROM groups 
                        WHERE id = :id
                    ';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        redirect_to(url_for('../public/pages/admin/groups/index.php'));
    }
}
?>