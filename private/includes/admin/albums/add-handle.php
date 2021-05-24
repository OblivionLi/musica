
<?php require_once('../../../initialize.php') ?>

<?php

if ($db) {
    $name = '';
    $edition = '';
    $cover = '';
    $error = [];

    if (isset($_POST['add-album']) && filter_has_var(INPUT_POST, 'add-album')) {

        unset($_SESSION['errors']);

        $name = h(st($_POST['name']));

        if (empty($name)) {
            array_push($error, "Album name field can't be empty.");
        }


        $edition = h(st($_POST['edition']));

        if (empty($edition)) {
            
            array_push($error, "Edition field can't be empty.");
        }


        $filename =  time().uniqid(rand()) . '-' . $_FILES['cover']['name'];

        $destination =  '../../../../public/assets/img/albumCovers/' . $filename;

        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $file = $_FILES['cover']['tmp_name'];
        $size = $_FILES['cover']['size'];

        if (!in_array($extension, ['jpg', 'png', 'jpeg'])) {
            array_push($error, "You file extension must be .jpg, .png or .jpeg");
        } elseif ($_FILES['cover']['size'] > 10000000) { 
            array_push($error, "File too large! max: 10mb");
        }
        
        if (empty($error)) {
            if (move_uploaded_file($file, $destination)) {
                $query = 'INSERT INTO albums 
                        SET 
                            name = :name,
                            edition = :edition,
                            cover = :cover,
                            created_at = NOW()
                ';

                $stmt = $db->prepare($query);

                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':edition', $edition);
                $stmt->bindParam(':cover', $filename);

                $stmt->execute();

                redirect_to(url_for('../public/pages/admin/albums/index.php'));

            } else {
                array_push($error, "Failed to upload file.");

                $_SESSION['errors'] = $error;
                redirect_to(url_for('../public/pages/admin/albums/add.php'));
            }
        } else {
            $_SESSION['errors'] = $error;
            redirect_to(url_for('../public/pages/admin/albums/add.php'));
        }
    }
}
?>