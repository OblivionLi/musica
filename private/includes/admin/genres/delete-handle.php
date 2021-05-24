<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/genres/index.php'));
}

$id = $_GET['id'];

$genre = find_genre_by_id($id)->fetch();

if ($db) {
    if (isset($_POST['delete-genre']) && filter_has_var(INPUT_POST, 'delete-genre')) {

        $query = 'DELETE FROM genres 
                        WHERE id = :id
                    ';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        redirect_to(url_for('../public/pages/admin/genres/index.php'));
    }
}
?>