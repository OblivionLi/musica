<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('/pages/admin/groups/index.php'));
}

$id = $_GET['id'];

$group = find_group_by_id($id)->fetch();

if ($db) {
    $name = '';
    $error = [];

    if (isset($_POST['edit-group']) && filter_has_var(INPUT_POST, 'edit-group')) {
        
        unset($_SESSION['errors']);

        $name = h(st($_POST['name']));

        if (empty($name)) {
            array_push($error, "Group name field can't be empty.");
        }

        if (empty($error)) {
            
            $query = 'UPDATE groups 
                            SET 
                                name = :name,
                                updated_at = NOW()
                            WHERE id = :id
                ';

            $stmt = $db->prepare($query);

            $stmt->bindParam(':name', $name);

            $stmt->bindParam(':id', $id);

            $stmt->execute();
            redirect_to(url_for('../public/pages/admin/groups/index.php'));
        } else {

            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/admin/groups/edit.php?id=' . h($group['id'])));
        }
    }
}
?>