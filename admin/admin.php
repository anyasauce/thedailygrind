<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/admin/admin_session.php';
include BASE_PATH . 'controllers/admin/dashboardcontroller.php';

?>


<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = "The Daily Grind | Dashboard";
include '../components/admin/head.php' ?>

<body>
    <?php include '../components/admin/sidebar.php' ?>
    
    <div class="sidebar-overlay"></div>
    <!-- Main Content -->
    <div id="content">
        <!-- Header -->
        <?php include '../components/admin/header.php' ?>

        <!-- Page Content -->
        <section>
            <div class="page-content">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">Dashboard Overview</h2>
                    </div>
            
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5>Total Users</h5>
                                <h3 class="fw-bold"><?php echo number_format($totalUsers); ?></h3>
                                <p class="<?php echo $trendClass; ?> fw-bold">
                                    <i class="fas <?php echo $trendIcon; ?>"></i>
                                    <?php echo number_format(abs($percentageChange), 1); ?>%
                                    <?php echo ($percentageChange >= 0) ? 'increase' : 'decrease'; ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <h5>Total Sales</h5>
                                <h3>₱34,252</h3>
                                <p class="positive"><i class="fas fa-arrow-up"></i> 8.3% increase</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="icon">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                <h5>Support Tickets</h5>
                                <h3>42</h3>
                                <p class="negative"><i class="fas fa-arrow-up"></i> 3.7% increase</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="icon">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <h5>Page Views</h5>
                                <h3>89,725</h3>
                                <p class="positive"><i class="fas fa-arrow-up"></i> 15.2% increase</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include '../components/admin/footer.php' ?>
    </div>
</body>

</html>