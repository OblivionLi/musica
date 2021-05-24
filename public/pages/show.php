<?php
require_once('../../private/initialize.php');

if (!isset($_GET['id'])) {
    redirect_to(url_for('index.php'));
}

$id = $_GET['id'];

$album = find_album_by_id($id)->fetch();
$artists = find_artists_by_album_id($id)->fetchAll();
$songs = find_songs_by_album_id($id)->fetchAll();

?>

<?php include_once(SHARED_PATH . '/main-header.php') ?>

<section class="content">
    <h3 class="content-title">Display details for &rarr; <?php echo h($album['name']); ?> &rarr; <?php echo h($album['edition']); ?></h3>

    <div class="show-main">
        <div class="show-main-img">
            <img src="<?php echo url_for('assets/img/albumCovers/' . h($album['cover'])); ?>" alt="Album Cover">
        </div>
    </div>

    <div class="show-main-artists">
        <h3 class="content-title">Album's Artists</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Artist Name</th>
                    <th>Group Name</th>
                    <th>Conductor Name</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($artists as $artist) { ?>

                    <tr>
                        <td><?php echo h($artist['id']); ?></td>
                        <td><?php echo h($artist['name']); ?></td>
                        <td><?php echo h($artist['groups_name']); ?></td>
                        <td><?php echo h($artist['conductors_name']) ? h($artist['conductors_name']) : '-'; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="show-main-artists">
        <h3 class="content-title">Album's Songs</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Song Name</th>
                    <th>Genre</th>
                    <th>Song Length</th>
                    <th>Published At</th>
                    <th>Options</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($songs as $song) { ?>

                    <tr>
                        <td><?php echo h($song['id']); ?></td>
                        <td><?php echo h($song['name']); ?></td>
                        <td><?php echo h($song['genres']) ? h($song['genres']) : '-'; ?></td>
                        <td><?php echo h($song['song_length']); ?></td>
                        <td><?php echo h($song['published_at']); ?></td>
                        <td>
                            <div class="options">
                                <a href="<?php echo url_for('pages/song.php?id=' . h($song['id'])); ?>" class="option">Check Description</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php include_once(SHARED_PATH . '/main-footer.php') ?>