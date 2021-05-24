<?php require_once('../../../../private/initialize.php') ?>

<?php

$conductors = get_all_conductors()->fetchAll();

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <div class="main-table-options">
        <h3 class="content-title">Conductors List</h3>
        <a href="<?php echo url_for('pages/admin/conductors/add.php'); ?>" class="option">Add</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Conductor Name</th>
                <th>Group Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Options</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($conductors as $conductor) { ?>
                
                <tr>
                    <td><?php echo h($conductor['conductors_id']); ?></td>
                    <td><?php echo h($conductor['conductors_name']); ?></td>
                    <td><?php echo h($conductor['groups_name']); ?></td>
                    <td><?php echo h($conductor['conductors_created_at']); ?></td>
                    <td><?php echo h($conductor['conductors_updated_at']); ?></td>
                    <td>
                        <div class="options">
                            <a href="<?php echo url_for('pages/admin/conductors/edit.php?id=' . h($conductor['conductors_id'])); ?>" class="option">Edit</a>
                            <a href="<?php echo url_for('pages/admin/conductors/delete.php?id=' . h($conductor['conductors_id'])); ?>" class="option">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>