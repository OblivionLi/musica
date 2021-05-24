<?php require_once('../../../initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('/pages/admin/albums/index.php'));
}

$id = $_GET['id'];

$album = find_album_by_id($id)->fetch();

if ($db) {
    $name = '';
    $edition = '';
    $error = [];
    $newFile = 0;
    $filename = '';

    if (isset($_POST['edit-album']) && filter_has_var(INPUT_POST, 'edit-album')) {
        unset($_SESSION['errors']);

        $name = h(st($_POST['name']));

        if (empty($name)) {
            array_push($error, "Album name field can't be empty.");
        }

        $edition = h(st($_POST['edition']));

        if (empty($edition)) {
            array_push($error, "Edition field can't be empty.");
        }

        if ($_FILES['cover']['size'] != 0 && $_FILES['cover']['error'] != 4) {
            $newFile = 1;
            $oldDestination =  '../../../../public/assets/img/albumCovers/' . $album['cover'];

            unlink($oldDestination);

            $filename = time().uniqid(rand()) . '-' . $_FILES['cover']['name'];

            $destination = '../../../../public/assets/img/albumCovers/' . $filename;

            $extension = pathinfo($filename, PATHINFO_EXTENSION);

            $file = $_FILES['cover']['tmp_name'];
            $size = $_FILES['cover']['size'];

            if (!in_array($extension, ['jpg', 'png', 'jpeg'])) {
                array_push($error, "You file extension must be .jpg, .png or .jpeg");
            } elseif ($_FILES['cover']['size'] > 10000000) { 
                array_push($error, "File too large! max: 10mb");
            }

            move_uploaded_file($file, $destination);
        }

        if (empty($error)) {
            $query = 'UPDATE albums 
                            SET 
                                name = :name,
                                edition = :edition,
                                cover = :cover,
                                updated_at = NOW()
                            WHERE id = :id
                ';

            $stmt = $db->prepare($query);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':edition', $edition);

            if ($newFile == 1) {
                $stmt->bindParam(':cover', $filename);
            } else {
                $stmt->bindParam(':cover', $album['cover']);
            }

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            redirect_to(url_for('../public/pages/admin/albums/index.php'));
        } else {

            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/admin/albums/edit.php?id=' . h($album['id'])));
        }
    }
}
?>