<?php require_once('../../../../private/initialize.php') ?>

<?php

$songs = get_all_songs()->fetchAll();

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <div class="main-table-options">
        <h3 class="content-title">Songs List</h3>
        <a href="<?php echo url_for('pages/admin/songs/add.php'); ?>" class="option">Add</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Song Name</th>
                <th>Album Name</th>
                <th>Genre</th>
                <th>Song Length</th>
                <th>Published At</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Options</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($songs as $song) { ?>
                
                <tr>
                    <td><?php echo h($song['songs_id']); ?></td>
                    <td><a target="_blank" class="link2" href="<?php echo url_for('pages/song.php?id=' . h($song['songs_id'])); ?>"><?php echo h($song['songs_name']); ?></a></td>
                    <td><?php echo h($song['albums_name']); ?></td>
                    <td><?php echo h($song['genres']) ? h($song['genres']) : '-'; ?></td>
                    <td><?php echo h($song['songs_song_length']); ?></td>
                    <td><?php echo h($song['songs_published_at']); ?></td>
                    <td><?php echo h($song['songs_created_at']); ?></td>
                    <td><?php echo h($song['songs_updated_at']); ?></td>
                    <td>
                        <div class="options">
                            <a href="<?php echo url_for('pages/admin/songs/edit.php?id=' . h($song['songs_id'])); ?>" class="option">Edit</a>
                            <a href="<?php echo url_for('pages/admin/songs/delete.php?id=' . h($song['songs_id'])); ?>" class="option">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>