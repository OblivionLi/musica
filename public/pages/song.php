<?php
require_once('../../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('index.php'));
}

$id = $_GET['id'];

$song = find_song_by_id($id)->fetch();

?>

<?php include_once(SHARED_PATH . '/main-header.php') ?>

<section class="content">
    <h3 class="content-title">Display Description for &rarr; <?php echo h($song['name']); ?></h3>
    <h4><a class="link" href="<?php echo url_for('pages/show.php?id=' . h($song['album_id'])); ?>">Go back</a></h4>

    <div class="show-main">
        <div class="show-main-desc">
            <p><?php echo h($song['description']); ?></p>
        </div>
    </div>
</section>

<?php include_once(SHARED_PATH . '/main-footer.php') ?>