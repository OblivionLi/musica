
<?php require_once('../../../initialize.php') ?>

<?php

if ($db) {
    $name = '';
    $album_id = '';
    $group_id = '';
    $error = [];

    if (isset($_POST['add-artist']) && filter_has_var(INPUT_POST, 'add-artist')) {

        unset($_SESSION['errors']);

        $name = h(st($_POST['name']));

        if (empty($name)) {
            array_push($error, "Artist name field can't be empty.");
        }

        $album_id = h(st($_POST['album']));

        $group_id = h(st($_POST['group']));

        if (empty($error)) {
            
                $query = 'INSERT INTO artists 
                        SET 
                            name = :name,
                            album_id = :album_id,
                            group_id = :group_id,
                            created_at = NOW()
                ';

                $stmt = $db->prepare($query);

                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':album_id', $album_id);
                $stmt->bindParam(':group_id', $group_id);

                $stmt->execute();

                redirect_to(url_for('../public/pages/admin/artists/index.php'));
        } else {
            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/admin/artists/add.php'));
        }
    }
}
?>