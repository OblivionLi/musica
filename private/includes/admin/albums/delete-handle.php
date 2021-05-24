
<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/albums/index.php'));
}

$id = $_GET['id'];

$album = find_album_by_id($id)->fetch();

if ($db) {
    if (isset($_POST['delete-album']) && filter_has_var(INPUT_POST, 'delete-album')) {

        $fileLocation = '../../../../public/assets/img/albumCovers/' . $album['cover'];

        unlink($fileLocation);

        $query = 'DELETE FROM albums 
                        WHERE id = :id
                    ';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        redirect_to(url_for('../public/pages/admin/albums/index.php'));
    }
}
?>