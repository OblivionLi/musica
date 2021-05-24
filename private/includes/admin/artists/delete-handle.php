<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/artists/index.php'));
}

$id = $_GET['id'];

$artist = find_artist_by_id($id)->fetch();

if ($db) {
    if (isset($_POST['delete-artist']) && filter_has_var(INPUT_POST, 'delete-artist')) {

        $query = 'DELETE FROM artists 
                        WHERE id = :id
                    ';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        redirect_to(url_for('../public/pages/admin/artists/index.php'));
    }
}
?>