<?php require_once('../../../../private/initialize.php') ?>

<?php

$users = get_all_users()->fetchAll();

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Users List</h3>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Options</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo h($user['id']); ?></td>
                    <td><?php echo h($user['username']); ?></td>
                    <td><?php echo h($user['email']); ?></td>
                    <td><?php echo h($user['role']) == '1' ? 'Admin' : 'User'; ?></td>
                    <td><?php echo h($user['created_at']); ?></td>
                    <td><?php echo h($user['updated_at']); ?></td>
                    <td>
                        <div class="options">
                            <a href="<?php echo url_for('pages/admin/users/edit.php?id=' . h($user['id'])); ?>" class="option">Edit</a>
                            <a href="<?php echo url_for('pages/admin/users/delete.php?id=' . h($user['id'])); ?>" class="option">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>