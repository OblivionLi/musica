<?php require_once('../../../initialize.php') ?>

<?php

if ($db) {
    $name = '';
    $genre_ids = '';
    $album_id = '';
    $description = '';
    $song_length = '';
    $published_at = '';
    $error = [];

    if (isset($_POST['add-song']) && filter_has_var(INPUT_POST, 'add-song')) {

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

        if (empty($genre_ids)) {
            array_push($error, "Genres checkboxes can't be empty.");
        }

        if (empty($error)) {

            $query = 'INSERT INTO songs 
                        SET 
                            name = :name,
                            description = :description,
                            song_length = :song_length,
                            published_at = :published_at,
                            album_id = :album_id,
                            created_at = NOW()
                ';

            $stmt = $db->prepare($query);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':song_length', $song_length);
            $stmt->bindParam(':published_at', $published_at);
            $stmt->bindParam(':album_id', $album_id);

            $stmt->execute();

            $lastSongAddedId = $db->lastInsertId(); 

            songs_sync_genres($genre_ids, $lastSongAddedId);

            redirect_to(url_for('../public/pages/admin/songs/index.php'));
        } else {
            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/admin/songs/add.php'));
        }
    }
}
?>