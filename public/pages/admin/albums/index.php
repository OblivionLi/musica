<?php require_once('../../../../private/initialize.php') ?>

<?php

$albums = get_all_albums()->fetchAll();


?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <div class="main-table-options">
        <h3 class="content-title">Albums List</h3>
        <a href="<?php echo url_for('pages/admin/albums/add.php'); ?>" class="option">Add</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Album Cover</th>
                <th>Album Name</th>
                <th>Album Edition</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Options</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($albums as $album) { ?>
                <tr>
                    <td><?php echo h($album['id']); ?></td>
                    <td><?php echo '<img class="main-table-cover" src="' . url_for('assets/img/albumCovers/' . h($album['cover'])) . '" />'; ?></td>
                    <td><?php echo h($album['name']); ?></td>
                    <td><?php echo h($album['edition']); ?></td>
                    <td><?php echo h($album['created_at']); ?></td>
                    <td><?php echo h($album['updated_at']); ?></td>
                    <td>
                        <div class="options">
                            <a href="<?php echo url_for('pages/admin/albums/edit.php?id=' . h($album['id'])); ?>" class="option">Edit</a>
                            <a href="<?php echo url_for('pages/admin/albums/delete.php?id=' . h($album['id'])); ?>" class="option">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>