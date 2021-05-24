<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('/pages/admin/artists/index.php'));
}

$id = $_GET['id'];

$artist = find_artist_by_id($id)->fetch();

if ($db) {
    $name = '';
    $album_id = '';
    $group_id = '';
    $error = [];

    if (isset($_POST['edit-artist']) && filter_has_var(INPUT_POST, 'edit-artist')) {
        unset($_SESSION['errors']);

        $name = h(st($_POST['name']));

        if (empty($name)) {
            array_push($error, "Artist name field can't be empty.");
        }

        $album_id = h(st($_POST['album']));

        $group_id = h(st($_POST['group']));

        if (empty($error)) {
            $query = 'UPDATE artists 
                            SET 
                                name = :name,
                                album_id = :album_id,
                                group_id = :group_id,
                                updated_at = NOW()
                            WHERE id = :id
                ';

            $stmt = $db->prepare($query);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':album_id', $album_id);
            $stmt->bindParam(':group_id', $group_id);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            redirect_to(url_for('../public/pages/admin/artists/index.php'));
        } else {

            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/admin/artists/edit.php?id=' . h($album['id'])));
        }
    }
}
?>