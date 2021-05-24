<?php require_once('../../../../private/initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/artists/index.php'));
}

$id = $_GET['id'];

$artist = find_artist_by_id($id)->fetch();

// get all albums
$albums = get_all_albums()->fetchAll();

// get all groups
$groups = get_all_groups()->fetchAll();

$errors = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Updating artist &rarr; <?php echo h($artist['name']); ?></h3>

    <form class="auth-form" action='../../../../private/includes/admin/artists/edit-handle.php?id=<?php echo h($artist['id']); ?>' method="POST">
        <div class="form-control-auth">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo h($artist['name']); ?>" required />
            <div style="color: red;">
                <?php echo in_array("Artist name field can't be empty.", $errors) ? "<span>&#8594;</span> Artist name field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <label for="group">Choose an group:</label>

            <select name="group" id="group" required>
                <option value="" disabled>Select a group from the list below</option>
                <?php foreach ($groups as $group) { ?>
                    <option 
                        value="<?php echo h($group['groups_id']) ?>" 
                        <?php echo $group['groups_id'] == $artist['group_id'] ? 'selected="selected"' : '' ?>
                        >
                        <?php echo h($group['groups_name']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-control-auth">
            <label for="album">Choose an album:</label>

            <select name="album" id="album" required>
                <option value="" disabled>Select an album from the list below</option>
                <?php foreach ($albums as $album) { ?>
                    <option 
                        value="<?php echo h($album['id']) ?>" 
                        <?php echo $album['id'] == $artist['album_id'] ? 'selected="selected"' : '' ?>
                        >
                        <?php echo h($album['name']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-control-auth">
            <button type="submit" class="auth-btn" name="edit-artist">Update</button>
        </div>
    </form>

    <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/admin/artists/index.php'); ?>">Nevermind...</a>
    </div>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>