<?php require_once('../../../../private/initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/users/index.php'));
}

$id = $_GET['id'];

$user = find_by_id($id)->fetch();

$errors = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Updating user &rarr; <?php echo $user['username']; ?></h3>

    <form class="auth-form" action='../../../../private/includes/admin/users/edit-handle.php?id=<?php echo h($user['id']); ?>' method="POST">
        <div class="form-control-auth">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo h($user['username']); ?>" />
            <div style="color: red;">
                <?php echo in_array("Username must be between 2 and 10 characters.", $errors) ? "<span>&#8594;</span> Username must be between 2 and 10 characters." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo h($user['email']); ?>" />
            <div style="color: red;">
                <?php
                if (in_array("Email has invalid format.", $errors)) echo "<span>&#8594;</span> Email has invalid format.";
                ?>
            </div>
        </div>

        <div class="form-control-auth">
            <label for="role0">User</label>
            <input type="radio" id="role0" name="role" value="0" <?php if (h($user['role']) == '0') {
                                                                        echo 'checked';
                                                                    }  ?> />

            <label for="role1">Admin</label>
            <input type="radio" id="role" name="role" value="1" <?php if (h($user['role']) == '1') {
                                                                    echo 'checked';
                                                                }  ?> />
        </div>

        <div class="form-control-auth">
            <button type="submit" class="auth-btn" name="update-user">Update</button>
        </div>
    </form>

    <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/admin/users/index.php'); ?>">Nevermind...</a>
    </div>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>