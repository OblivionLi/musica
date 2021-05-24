<?php require_once('../../../../private/initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/genres/index.php'));
}

$id = $_GET['id'];

$genre = find_genre_by_id($id)->fetch();

$errors = [];

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Updating genre &rarr; <?php echo h($genre['name']); ?></h3>

    <form class="auth-form" action='../../../../private/includes/admin/genres/edit-handle.php?id=<?php echo h($genre['id']); ?>' method="POST">
        <div class="form-control-auth">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo h($genre['name']); ?>" />
            <div style="color: red;">
                <?php echo in_array("Genre name field can't be empty.", $errors) ? "<span>&#8594;</span> Genre name field can't be empty." : ""; ?>
            </div>
        </div>

        <div class="form-control-auth">
            <button type="submit" class="auth-btn" name="edit-genre">Update</button>
        </div>
    </form>

    <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/admin/genres/index.php'); ?>">Nevermind...</a>
    </div>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>