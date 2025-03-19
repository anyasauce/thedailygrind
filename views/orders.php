<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

$user_id = $_SESSION['user']['user_id'];
$result = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = "The Daily Grind | My Orders";
include BASE_PATH . 'components/user/head.php';
?>

<body class="bg-light">
    <?php include BASE_PATH . 'components/user/header.php'; ?>

    <main class="container" style="margin-top: 100px; margin-bottom: 100px;" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4 text-center text-primary">My Orders</h2>

            <div class="table-responsive">
                <table id="ordersTable" class="table table-hover table-bordered text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Total</th>
                            <th>Delivery Method</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td>#<?php echo $row['order_id']; ?></td>
                                <td>₱<?php echo number_format($row['total'], 2); ?></td>
                                <td><?php echo $row['delivery_method']; ?></td>
                                <td><?php echo $row['payment_method']; ?></td>
                                <td>
                                    <?php
                                        $status = $row['status'];
                                        $badgeClass = match ($status) {
                                            'Processing' => 'warning',
                                            'On the Way' => 'info',
                                            'Ready for Pickup' => 'success',
                                            'Completed' => 'primary',
                                            'Pending' => 'secondary',
                                            'Cancelled' => 'danger',
                                            default => 'secondary',
                                        };
                                        ?>
                                    <span class="badge bg-<?php echo $badgeClass; ?> px-3 py-2">
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="track_order.php?order_id=<?php echo $row['order_id']; ?>"
                                        class="btn btn-sm btn-outline-primary">Track</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </main>

    <?php include BASE_PATH . 'components/user/footer.php'; ?>

    <script>
        $(document).ready(function() {
            $('#ordersTable').DataTable();
        });
    </script>


</body>

</html>