<?php require_once('../../../../private/initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/groups/index.php'));
}

$id = $_GET['id'];

$group = find_group_by_id($id)->fetch();

$errors = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Updating group &rarr; <?php echo h($group['name']); ?></h3>

    <form class="auth-form" action='../../../../private/includes/admin/groups/edit-handle.php?id=<?php echo h($group['id']); ?>' method="POST">
        <div class="form-control-auth">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo h($group['name']); ?>" />
            <div style="color: red;">
                <?php echo in_array("Group name field can't be empty.", $errors) ? "<span>&#8594;</span> Group name field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <button type="submit" class="auth-btn" name="edit-group">Update</button>
        </div>
    </form>

    <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/admin/groups/index.php'); ?>">Nevermind...</a>
    </div>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>