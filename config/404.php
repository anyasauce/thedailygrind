<?php include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "The Daily Grind | Home";
include BASE_PATH . 'components/user/head.php';
?>

<body class="bg-light">
    <?php include BASE_PATH . 'components/user/header.php'; ?>

    <div class="container text-center" style="margin-top: 150px; margin-bottom: 150px;">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-lg border-0 p-4">
                    <div class="card-body">
                        <h1 class="display-3 text-danger fw-bold">404</h1>
                        <h2 class="mb-3">Page Not Found</h2>
                        <p class="text-muted">Sorry, the page you are looking for does not exist.</p>
                        <a href="<?= route('user', 'home'); ?>" class="btn btn-primary">Go Back Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include BASE_PATH . 'components/user/footer.php'; ?>
</body>

</html>