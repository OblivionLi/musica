<?php require_once('../../../../private/initialize.php') ?>

<?php

$errors = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}

// get all albums
$albums = get_all_albums()->fetchAll();

// get all genres
$genres = get_all_genres()->fetchAll();

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Add a New Song</h3>

    <form class="auth-form" action='../../../../private/includes/admin/songs/add-handle.php' method="POST">
        <div class="form-control-auth">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter song name here.." />
            <div style="color: red;">
                <?php echo in_array("Song name field can't be empty.", $errors) ? "<span>&#8594;</span> Song name field can't be empty." : ""; ?>
            </div>
        </div>

        <span style="font-size: 20px;">Choose a genre:</span>
        <div class="form-control-auth genres">
                <?php foreach ($genres as $genre) { ?>
                    <div class="genres-content">
                        <input type="checkbox" id="<?php echo h($genre['name']); ?>" value="<?php echo h($genre['id']) ?>" name="genre[]" />
                        <label for="<?php echo h($genre['name']); ?>"><?php echo h($genre['name']); ?></label>
                    </div>
                <?php } ?>

            <div style="color: red;">
                <?php echo in_array("Genres checkboxes can't be empty.", $errors) ? "<span>&#8594;</span> Genres checkboxes can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <label for="album">Choose an album:</label>

            <select name="album" id="album">
                <option value="" selected="selected" disabled>Select an album from the list below</option>
                <?php foreach ($albums as $album) { ?>
                    <option value="<?php echo h($album['id']) ?>"><?php echo h($album['name']) ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-control-auth">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" cols="50" placeholder="Enter song description here.."></textarea>
            <div style="color: red;">
                <?php echo in_array("Description field can't be empty.", $errors) ? "<span>&#8594;</span> Description field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth length">
            <label for="song_length">Song Length (format ex: 01:30)</label>
            <input type="text" id="song_length" name="song_length" placeholder="Enter song length here.." />
            <div style="color: red;">
                <?php echo in_array("Song length field can't be empty.", $errors) ? "<span>&#8594;</span> Song length field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth length">
            <label for="published_at">Published At</label>
            <input type="datetime-local" id="published_at" name="published_at" placeholder="Enter song published date here.." />
            <div style="color: red;">
                <?php echo in_array("Published at field can't be empty.", $errors) ? "<span>&#8594;</span> Published at field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <button type="submit" class="auth-btn" name="add-song">Add</button>
        </div>
    </form>

    <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/admin/songs/index.php'); ?>">Nevermind...</a>
    </div>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>