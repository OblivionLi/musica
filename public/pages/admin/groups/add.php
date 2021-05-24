<?php require_once('../../../../private/initialize.php') ?>

<?php

$errors = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Add a New Group</h3>

    <form class="auth-form" action='../../../../private/includes/admin/groups/add-handle.php' method="POST">
        <div class="form-control-auth">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter group name here.." />
            <div style="color: red;">
                <?php echo in_array("Group name field can't be empty.", $errors) ? "<span>&#8594;</span> Group name field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <button type="submit" class="auth-btn" name="add-group">Add</button>
        </div>
    </form>

    <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/admin/groups/index.php'); ?>">Nevermind...</a>
    </div>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>