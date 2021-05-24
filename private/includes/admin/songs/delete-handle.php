<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/songs/index.php'));
}

$id = $_GET['id'];

$song = find_song_by_id($id)->fetch();

if ($db) {
    if (isset($_POST['delete-song']) && filter_has_var(INPUT_POST, 'delete-song')) {

        delete_songs_genres_records($id);
        
        $query = 'DELETE FROM songs 
                        WHERE id = :id
                    ';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        redirect_to(url_for('../public/pages/admin/songs/index.php'));
    }
}
?>