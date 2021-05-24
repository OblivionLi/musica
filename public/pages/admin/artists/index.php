<?php require_once('../../../../private/initialize.php') ?>

<?php

$artists = get_all_artists()->fetchAll();

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <div class="main-table-options">
        <h3 class="content-title">Artists List</h3>
        <a href="<?php echo url_for('pages/admin/artists/add.php'); ?>" class="option">Add</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Artist Name</th>
                <th>Album Name</th>
                <th>Group Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Options</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($artists as $artist) { ?>
                
                <tr>
                    <td><?php echo h($artist['artists_id']); ?></td>
                    <td><?php echo h($artist['artists_name']); ?></td>
                    <td><?php echo h($artist['albums_name']); ?></td>
                    <td><?php echo h($artist['groups_name']); ?></td>
                    <td><?php echo h($artist['artists_created_at']); ?></td>
                    <td><?php echo h($artist['artists_updated_at']); ?></td>
                    <td>
                        <div class="options">
                            <a href="<?php echo url_for('pages/admin/artists/edit.php?id=' . h($artist['artists_id'])); ?>" class="option">Edit</a>
                            <a href="<?php echo url_for('pages/admin/artists/delete.php?id=' . h($artist['artists_id'])); ?>" class="option">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>