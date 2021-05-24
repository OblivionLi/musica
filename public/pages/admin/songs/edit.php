<?php require_once('../../../../private/initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/songs/index.php'));
}

$id = $_GET['id'];

$song = find_song_by_id($id)->fetch();

// get all albums
$albums = get_all_albums()->fetchAll();

$errors = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

// get all genres
$genres = get_all_genres()->fetchAll();

$checkForGenres = $song['genres'];

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Updating song &rarr; <?php echo h($song['name']); ?></h3>

    <form class="auth-form" action='../../../../private/includes/admin/songs/edit-handle.php?id=<?php echo h($song['id']); ?>' method="POST">
        <div class="form-control-auth">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo h($song['name']); ?>" />
            <div style="color: red;">
                <?php echo in_array("Song name field can't be empty.", $errors) ? "<span>&#8594;</span> Song name field can't be empty." : ""; ?>
            </div>
        </div>

        <span style="font-size: 20px;">Choose a genre:</span>
        <div class="form-control-auth genres">
                <?php foreach ($genres as $genre) { ?>
                    <div class="genres-content">
                        <input type="checkbox" id="<?php echo h($genre['name']); ?>" value="<?php echo h($genre['id']) ?>" name="genre[]" <?php echo str_contains($checkForGenres, $genre['name']) ? 'checked' : '' ?>  />
                        <label for="<?php echo h($genre['name']); ?>"><?php echo h($genre['name']); ?></label>
                    </div>
                <?php } ?>
        </div>

        <div class="form-control-auth">
            <label for="album">Choose an album:</label>

            <select name="album" id="album">
                <option value="" disabled>Select an album from the list below</option>
                <?php foreach ($albums as $album) { ?>
                    <option value="<?php echo h($album['id']) ?>" <?php echo $album['id'] == $song['album_id'] ? 'selected="selected"' : '' ?>>
                        <?php echo h($album['name']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-control-auth">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" cols="50" placeholder="Enter song description here.."><?php echo h($song['description']); ?></textarea>
            <div style="color: red;">
                <?php echo in_array("Description field can't be empty.", $errors) ? "<span>&#8594;</span> Description field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth length">
            <label for="song_length">Song Length (format ex: 01:30)</label>
            <input type="text" id="song_length" name="song_length" value="<?php echo h($song['song_length']); ?>" placeholder="Enter song length here.." />
            <div style="color: red;">
                <?php echo in_array("Song length field can't be empty.", $errors) ? "<span>&#8594;</span> Song length field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth length">
            <label for="published_at">Published At</label>
            <input type="datetime-local" id="published_at" name="published_at" value="<?php echo date('Y-m-d\TH:i:s', strtotime($song['published_at'])); ?>" placeholder="Enter song published date here.." />
            <div style="color: red;">
                <?php echo in_array("Published at field can't be empty.", $errors) ? "<span>&#8594;</span> Published at field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <button type="submit" class="auth-btn" name="edit-song">Update</button>
        </div>
    </form>

    <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/admin/songs/index.php'); ?>">Nevermind...</a>
    </div>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>