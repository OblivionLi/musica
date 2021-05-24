<?php require_once('../../../../private/initialize.php') ?>

<?php

$errors = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}

// get all albums
$albums = get_all_albums()->fetchAll();

// get all groups
$groups = get_all_groups()->fetchAll();

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Add a New Artist</h3>

    <form class="auth-form" action='../../../../private/includes/admin/artists/add-handle.php' method="POST">
        <div class="form-control-auth">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter artist name here.." required />
            <div style="color: red;">
                <?php echo in_array("Artist name field can't be empty.", $errors) ? "<span>&#8594;</span> Artist name field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <label for="group">Choose a group:</label>

            <select name="group" id="group" required>
                <option value="" selected="selected" disabled>Select a group from the list below</option>
                <?php foreach ($groups as $group) { ?>
                    <option value="<?php echo h($group['groups_id']) ?>"><?php echo h($group['groups_name']) ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-control-auth">
            <label for="album">Choose an album:</label>

            <select name="album" id="album" required>
                <option value="" selected="selected" disabled>Select an album from the list below</option>
                <?php foreach ($albums as $album) { ?>
                    <option value="<?php echo h($album['id']) ?>"><?php echo h($album['name']) ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-control-auth">
            <button type="submit" class="auth-btn" name="add-artist">Add</button>
        </div>
    </form>

    <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/admin/artists/index.php'); ?>">Nevermind...</a>
    </div>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>