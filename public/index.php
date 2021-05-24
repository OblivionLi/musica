<?php

require_once('../private/initialize.php');

// validation to display pagination
// 0 => do not display pagination links
// 1 => display pagination links 
$displayPag = 0;

// check if search form button is pressed
if (isset($_POST['search-form']) && filter_has_var(INPUT_POST, 'search-form')) {
    // do not display pagination, because when a client searches, there will be only a few results to display
    $displayPag = 0;
    // get value from search from input
    $search = h($_POST['search']);
    // fetch all artists with all of their relationships based on the form search keyword
    $datas = get_all_artists_by_search($search)->fetchAll();
// else if search button is not pressed 
} else {
    // display pagination links
    $displayPag = 1;
    // limit how many results should be displayed per page
    $limit = 3;
    // count database rows
    $count = count_artists()->rowCount();

    // check if the keyword page inside the url is NOT set
    if (!isset($_GET['page'])) {
        // assing page var with value 1
        $page = 1;
    // else if keyword page is SET
    } else {
        // get url page number
        $page = $_GET['page'];
    }

    // formula for pagination
    $starting_limit = ($page - 1) * $limit;

    // fetch all artists with pagination based on a LIMIT in sql
    $datas = get_all_artists_with_pagination($starting_limit, $limit)->fetchAll(PDO::FETCH_ASSOC);

    // count total pages with results
    $total_pages  = ceil($count / $limit);
}

?>

<?php include_once(SHARED_PATH . '/main-header.php') ?>

<div class="search-bar">
    <form class="search-form" action="" method="POST">
        <div class="form-control">
            <input class="search-text" type="text" name="search" placeholder="Search by artist or album name..">
            <button type="submit" class="search-btn" name="search-form">Search</button>
        </div>
    </form>
</div>


<section class="content">
    <h3 class="content-title">Lastest Albums</h3>

    <div class="main-content">
        <?php foreach ($datas as $data) { ?>
            <div class="informations">

                <div class="informations-content-img">
                    <img class="informations-img" src="<?php echo url_for('assets/img/albumCovers/' . h($data['albums_cover'])); ?>" />
                </div>

                <div class="informations-content">
                    <h2><?php echo h($data['albums_name']); ?></h2>
                </div>

                <div class="informations-content">
                    <h3><?php echo h($data['artists_name']); ?></h3>
                </div>

                <div class="informations-content">
                    <h4><?php echo h($data['groups_name']); ?></h4>
                </div>

                <div class="main-content-link">
                    <a href="<?php echo url_for('pages/show.php?id=' . h($data['albums_id'])); ?>">Details</a>
                </div>
            </div>
        <?php } ?>

    </div>

    <div class="pagination">
        <?php if ($displayPag == 1) { ?>
            <?php for ($page = 1; $page <= $total_pages; $page++) { ?>
                <a href='<?php echo "?page=$page"; ?>' class="page-link">
                    <?php echo $page; ?>
                </a>
            <?php } ?>
        <?php } ?>
    </div>



</section>

<?php include_once(SHARED_PATH . '/main-footer.php') ?>