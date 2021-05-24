<?php require_once('../../../../private/initialize.php') ?>

<?php

if (!isset($_GET['id'])) {
    redirect_to(url_for('pages/admin/genres/index.php'));
}

$id = $_GET['id'];

$genre = find_genre_by_id($id)->fetch();

?>

<?php include_once(SHARED_PATH . '/admin/admin-header.php'); ?>

<section class="main-table">
    <h3 class="content-title">Deleting genre &rarr; <?php echo $genre['name']; ?></h3>

    <form class="auth-form" action='../../../../private/includes/admin/genres/delete-handle.php?id=<?php echo h($genre['id']); ?>' method="POST">
        <p class="admin-txt">Are you sure you want to delete this genre &rarr; <?php echo $genre['name']; ?> ?</p>

        <div class="form-control-auth">
            <button type="submit" class="auth-btn" name="delete-genre">Yes, Delete it !</button>
        </div>
    </form>

    <div class="auth-options">
        <a class="link" href="<?php echo url_for('pages/admin/genres/index.php'); ?>">Nevermind...</a>
    </div>
</section>

<?php include_once(SHARED_PATH . '/admin/admin-footer.php'); ?>