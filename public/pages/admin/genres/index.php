<?php require_once('../../../../private/initialize.php') ?>

<?php

$genres = get_all_genres()->fetchAll();


?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <div class="main-table-options">
        <h3 class="content-title">Genres List</h3>
        <a href="<?php echo url_for('pages/admin/genres/add.php'); ?>" class="option">Add</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Genre Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Options</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($genres as $genre) { ?>
                
                <tr>
                    <td><?php echo h($genre['id']); ?></td>
                    <td><?php echo h($genre['name']); ?></td>
                    <td><?php echo h($genre['created_at']); ?></td>
                    <td><?php echo h($genre['updated_at']); ?></td>
                    <td>
                        <div class="options">
                            <a href="<?php echo url_for('pages/admin/genres/edit.php?id=' . h($genre['id'])); ?>" class="option">Edit</a>
                            <a href="<?php echo url_for('pages/admin/genres/delete.php?id=' . h($genre['id'])); ?>" class="option">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>