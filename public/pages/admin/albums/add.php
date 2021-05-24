<?php require_once('../../../../private/initialize.php') ?>

<?php

$errors = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Add a New Album</h3>

    <form class="auth-form" action='../../../../private/includes/admin/albums/add-handle.php' method="POST" enctype="multipart/form-data">
        <div class="form-control-auth">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter album name here.." />
            <div style="color: red;">
                <?php echo in_array("Album name field can't be empty.", $errors) ? "<span>&#8594;</span> Album name field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <label for="edition">Edition</label>
            <input type="text" id="edition" name="edition" placeholder="Enter album edition here.." />
            <div style="color: red;">
                <?php echo in_array("Edition field can't be empty.", $errors) ? "<span>&#8594;</span> Edition field can't be empty." : ""; ?>
            </div>
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
            <button type="submit" class="auth-btn" name="add-album">Add</button>
        </div>
    </form>

    <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/admin/albums/index.php'); ?>">Nevermind...</a>
    </div>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>