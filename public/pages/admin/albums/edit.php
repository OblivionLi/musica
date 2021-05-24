<?php require_once('../../../../private/initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/albums/index.php'));
}

$id = $_GET['id'];

$album = find_album_by_id($id)->fetch();

$errors = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Updating album &rarr; <?php echo h($album['name']); ?></h3>

    <form class="auth-form" action='../../../../private/includes/admin/albums/edit-handle.php?id=<?php echo h($album['id']); ?>' method="POST" enctype="multipart/form-data">
        <div class="form-control-auth">
            <label for="name">Name</label>
            <input type="text" id="name" name="name"  value="<?php echo h($album['name']); ?>" />
            <div style="color: red;">
                <?php echo in_array("Album name field can't be empty.", $errors) ? "<span>&#8594;</span> Album name field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <label for="edition">Edition</label>
            <input type="text" id="edition" name="edition"  value="<?php echo h($album['edition']); ?>" />
            <div style="color: red;">
                <?php echo in_array("Edition field can't be empty.", $errors) ? "<span>&#8594;</span> Edition field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <label for="currentCover">Current Cover</label>
            <img class="main-table-cover" id="currentCover" src="<?php echo url_for('assets/img/albumCovers/' . h($album['cover'])); ?>" />
        </div>

        <div class="form-control-auth">
            <label for="cover">Cover</label>
            <input type="file" id="cover" name="cover" />
            <div style="color: red;">
                <?php
                if (in_array("You file extension must be .jpg, .png or .jpeg", $errors)) {
                    echo "<span>&#8594;</span> You file extension must be .jpg, .png or .jpeg";
                } elseif (in_array("File too large! max: 10mb", $errors)) {
                    echo "<span>&#8594;</span> File too large! max: 10mb";
                } elseif (in_array("Failed to upload file.", $errors)) {
                    echo "<span>&#8594;</span> Failed to upload file.";
                }
                ?>
            </div>
        </div>

    
        <div class="form-control-auth">
            <button type="submit" class="auth-btn" name="edit-album">Update</button>
        </div>
    </form>

    <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/admin/albums/index.php'); ?>">Nevermind...</a>
    </div>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>