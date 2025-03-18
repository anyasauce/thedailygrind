<?php
$current_page = basename($_SERVER['PHP_SELF']);
$page_name = '';

if ($current_page == 'analytics.php') {
    $page_name = 'Analytics';
} elseif ($current_page == 'orders.php') {
    $page_name = 'Orders';
} elseif ($current_page == 'sold.php') {
    $page_name = 'Sold';
}
?>

<section>
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 text-center mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="fw-bold text-warning mb-4">Under Construction</h1>
                        <p class="fs-5 mb-4">Gina ubra paka upod ko, kalma lang.</p>

                        <?php if (!empty($page_name)): ?>
                            <h4 class="text-muted">This page is: <strong><?php echo $page_name; ?></strong></h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>