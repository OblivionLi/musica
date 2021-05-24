<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('/pages/admin/songs/index.php'));
}

$id = $_GET['id'];

$song = find_song_by_id($id)->fetch();

if ($db) {
    $name = '';
    $genre_ids = '';
    $album_id = '';
    $description = '';
    $song_length = '';
    $published_at = '';
    $error = [];

    if (isset($_POST['edit-song']) && filter_has_var(INPUT_POST, 'edit-song')) {
        
        unset($_SESSION['errors']);

        $name = h(st($_POST['name']));

        if (empty($name)) {
            array_push($error, "Song name field can't be empty.");
        }

        $description = h(st($_POST['description']));

        if (empty($description)) {
            array_push($error, "Description field can't be empty.");
        }

        $song_length = h(st($_POST['song_length']));

        if (empty($song_length)) {
            array_push($error, "Song length field can't be empty.");
        }

        $published_at = h(st($_POST['published_at']));

        if (empty($published_at)) {
            array_push($error, "Published at field can't be empty.");
        }

        $album_id = h(st($_POST['album']));

        $genre_ids = $_POST['genre'];

        if (empty($error)) {
            $query = 'UPDATE songs 
                            SET 
                                name = :name,
                                description = :description,
                                song_length = :song_length,
                                published_at = :published_at,
                                album_id = :album_id, 
                                updated_at = NOW()
                            WHERE id = :id
                ';

            $stmt = $db->prepare($query);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':song_length', $song_length);
            $stmt->bindParam(':published_at', $published_at);
            $stmt->bindParam(':album_id', $album_id);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            delete_songs_genres_records($id);

            songs_sync_genres($genre_ids, $id);

            redirect_to(url_for('../public/pages/admin/songs/index.php'));

        } else {

            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/admin/songs/edit.php?id=' . h($song['id'])));
        }
    }
}
?>