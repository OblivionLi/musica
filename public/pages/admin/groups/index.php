<?php require_once('../../../../private/initialize.php') ?>

<?php

$groups = get_all_groups()->fetchAll();

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <div class="main-table-options">
        <h3 class="content-title">Groups List</h3>
        <a href="<?php echo url_for('pages/admin/groups/add.php'); ?>" class="option">Add</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Group Name</th>
                <th>Conductor Name</th>
                <th>No. artists</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Options</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($groups as $group) { ?>
                
                <tr>
                    <td><?php echo h($group['groups_id']); ?></td>
                    <td><?php echo h($group['groups_name']); ?></td>
                    <td><?php echo h($group['conductors_name']) ? h($group['conductors_name']) : '-'; ?></td>
                    <td><?php echo h($group['artist']); ?></td>
                    <td><?php echo h($group['groups_created_at']); ?></td>
                    <td><?php echo h($group['groups_updated_at']); ?></td>
                    <td>
                        <div class="options">
                            <a href="<?php echo url_for('pages/admin/groups/edit.php?id=' . h($group['groups_id'])); ?>" class="option">Edit</a>
                            <a href="<?php echo url_for('pages/admin/groups/delete.php?id=' . h($group['groups_id'])); ?>" class="option">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>