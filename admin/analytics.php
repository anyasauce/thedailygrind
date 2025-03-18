<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/admin/admin_session.php';

?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "The Daily Grind | Analytics";
include '../components/admin/head.php'; ?>

<body>
    <?php include '../components/admin/sidebar.php'; ?>

    <div class="sidebar-overlay"></div>
    <div id="content">
        <?php include '../components/admin/header.php'; ?>

        <?php include 'under_construction.php'; ?>

        <?php include '../components/admin/footer.php'; ?>
    </div>
</body>

</html>