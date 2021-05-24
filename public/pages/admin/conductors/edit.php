<?php require_once('../../../../private/initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/conductors/index.php'));
}

$id = $_GET['id'];

$conductor = find_conductor_by_id($id)->fetch();

// get all groups
$groups = get_all_groups()->fetchAll();

$errors = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Updating conductor &rarr; <?php echo h($conductor['name']); ?></h3>

    <form class="auth-form" action='../../../../private/includes/admin/conductors/edit-handle.php?id=<?php echo h($conductor['id']); ?>' method="POST">
        <div class="form-control-auth">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo h($conductor['name']); ?>" required />
            <div style="color: red;">
                <?php echo in_array("Conductor name field can't be empty.", $errors) ? "<span>&#8594;</span> Conductor name field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <label for="group">Choose a group:</label>

            <select name="group" id="group" required>
                <option value="" disabled>Select a group from the list below</option>
                <?php foreach ($groups as $group) { ?>
                    <option 
                        value="<?php echo h($group['groups_id']) ?>" 
                        <?php echo $group['groups_id'] == $group['groups_id'] ? 'selected="selected"' : '' ?>
                        >
                        <?php echo h($group['groups_name']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-control-auth">
            <button type="submit" class="auth-btn" name="edit-conductor">Update</button>
        </div>
    </form>

    <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/admin/conductors/index.php'); ?>">Nevermind...</a>
    </div>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>