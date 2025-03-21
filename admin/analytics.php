<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/admin/admin_session.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=coffee_shop;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$selectedMonth = $_GET['month'] ?? date('Y-m');

$salesByDayQuery = $pdo->prepare("
    SELECT DATE(created_at) AS date, 
           SUM(total) AS sales, 
           SUM(total - tax - delivery_fee) AS revenue
    FROM orders
    WHERE DATE_FORMAT(created_at, '%Y-%m') = :selectedMonth
    GROUP BY date
    ORDER BY date ASC
");
$salesByDayQuery->execute(['selectedMonth' => $selectedMonth]);
$salesByDayData = $salesByDayQuery->fetchAll(PDO::FETCH_ASSOC);

$dayLabels = array_column($salesByDayData, 'date');
$daySales = array_column($salesByDayData, 'sales');
$dayRevenue = array_column($salesByDayData, 'revenue');

$salesByMonthQuery = $pdo->prepare("
    SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, 
           SUM(total) AS sales, 
           SUM(total - tax - delivery_fee) AS revenue
    FROM orders
    WHERE DATE_FORMAT(created_at, '%Y-%m') = :selectedMonth
    GROUP BY month
    ORDER BY month ASC
");
$salesByMonthQuery->execute(['selectedMonth' => $selectedMonth]);
$salesByMonthData = $salesByMonthQuery->fetchAll(PDO::FETCH_ASSOC);

$monthLabels = array_column($salesByMonthData, 'month');
$monthSales = array_column($salesByMonthData, 'sales');
$monthRevenue = array_column($salesByMonthData, 'revenue');

$todaysSalesQuery = $pdo->query("
    SELECT SUM(total) AS todays_sales 
    FROM orders 
    WHERE DATE(created_at) = CURDATE()
");
$todaysSales = $todaysSalesQuery->fetch(PDO::FETCH_ASSOC)['todays_sales'] ?? 0;

$totalSalesQuery = $pdo->query("SELECT SUM(total) AS total_sales FROM orders");
$totalSales = $totalSalesQuery->fetch(PDO::FETCH_ASSOC)['total_sales'] ?? 0;

$todaysRevenueQuery = $pdo->query("
    SELECT SUM(total - tax - delivery_fee) AS todays_revenue
    FROM orders
    WHERE DATE(created_at) = CURDATE()
");
$todaysRevenue = $todaysRevenueQuery->fetch(PDO::FETCH_ASSOC)['todays_revenue'] ?? 0;

$totalRevenueQuery = $pdo->query("
    SELECT SUM(total - tax - delivery_fee) AS total_revenue
    FROM orders
");
$totalRevenue = $totalRevenueQuery->fetch(PDO::FETCH_ASSOC)['total_revenue'] ?? 0;

$dailySalesQuery = $pdo->prepare("
    SELECT DATE(created_at) AS date, SUM(total) AS total
    FROM orders
    WHERE DATE_FORMAT(created_at, '%Y-%m') = :selectedMonth
    GROUP BY date
    ORDER BY date ASC
");
$dailySalesQuery->execute(['selectedMonth' => $selectedMonth]);
$dailySalesData = $dailySalesQuery->fetchAll(PDO::FETCH_ASSOC);

$monthlySalesQuery = $pdo->prepare("
    SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, SUM(total) AS total
    FROM orders
    WHERE DATE_FORMAT(created_at, '%Y-%m') = :selectedMonth
    GROUP BY month
    ORDER BY month ASC
");
$monthlySalesQuery->execute(['selectedMonth' => $selectedMonth]);
$monthlySalesData = $monthlySalesQuery->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="/thedailygrind/assets/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/thedailygrind/assets/admin/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php
$pageTitle = "The Daily Grind | Analytics";
include BASE_PATH . 'components/admin/head.php'; 
?>

<body>
    <?php include BASE_PATH . 'components/admin/sidebar.php'; ?>
    <div class="sidebar-overlay"></div>
    <div id="content">
        <?php include BASE_PATH . 'components/admin/header.php'; ?>

        <div class="analyticscs">

            <!-- Date Picker -->
            <div class="container-fluid pt-4 px-4">
            <form method="GET" action="">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-4">
                        <label for="month">Select Month:</label>
                        <input type="month" id="month" name="month" class="form-control" value="<?= $selectedMonth ?>" required>
                    </div>
                    <div class="col-sm-6 col-xl-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>

            <!-- Sales Overview -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded p-4">
                            <p>Today's Sales</p>
                            <h6>$<?= number_format($todaysSales, 2) ?></h6>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded p-4">
                            <p>Total Sales</p>
                            <h6>$<?= number_format($totalSales, 2) ?></h6>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded p-4">
                            <p>Today's Revenue</p>
                            <h6>$<?= number_format($todaysRevenue, 2) ?></h6>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded p-4">
                            <p>Total Revenue</p>
                            <h6>$<?= number_format($totalRevenue, 2) ?></h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <!-- Sales & Revenue Chart -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded p-4">
                            <h6>Sales & Revenue (By Day & Month)</h6>
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>             

                    <!-- Daily & Monthly Sales Charts -->
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded p-4">
                            <h6>Daily & Monthly Sales</h6>
                            <canvas id="dailySales"></canvas>  
                            <canvas id="monthlySales"></canvas>  
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <?php include BASE_PATH . 'components/admin/footer.php'; ?>
    </div>

    <script>    
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_merge($dayLabels, $monthLabels)) ?>,
                datasets: [
                    {
                        label: 'Daily Sales ($)',
                        data: <?= json_encode(array_merge($daySales, array_fill(0, count($monthLabels), null))) ?>,
                        borderColor: 'blue',
                        fill: false
                    },
                    {
                        label: 'Daily Revenue ($)',
                        data: <?= json_encode(array_merge($dayRevenue, array_fill(0, count($monthLabels), null))) ?>,
                        borderColor: 'green',
                        fill: false
                    },
                    {
                        label: 'Monthly Sales ($)',
                        data: <?= json_encode(array_merge(array_fill(0, count($dayLabels), null), $monthSales)) ?>,
                        borderColor: 'orange',
                        fill: false,
                        borderDash: [5, 5]
                    },
                    {
                        label: 'Monthly Revenue ($)',
                        data: <?= json_encode(array_merge(array_fill(0, count($dayLabels), null), $monthRevenue)) ?>,
                        borderColor: 'purple',
                        fill: false,
                        borderDash: [5, 5]
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date (Daily & Monthly)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Amount ($)'
                        }
                    }
                }
            }
        });

        // Daily Sales Chart
        const dailyCtx = document.getElementById('dailySales').getContext('2d');
        new Chart(dailyCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($dailySalesData, 'date')) ?>,
                datasets: [{
                    label: 'Daily Sales',
                    data: <?= json_encode(array_column($dailySalesData, 'total')) ?>,
                    backgroundColor: 'orange'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Sales ($)'
                        }
                    }
                }
            }
        });

        // Monthly Sales Chart
        const monthlyCtx = document.getElementById('monthlySales').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($monthlySalesData, 'month')) ?>,
                datasets: [{
                    label: 'Monthly Sales',
                    data: <?= json_encode(array_column($monthlySalesData, 'total')) ?>,
                    backgroundColor: 'purple'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Sales ($)'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>