<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

if (!isset($_GET['order_id'])) {
    die("Order ID is missing.");
}

$order_id = intval($_GET['order_id']);
$query = "SELECT * FROM orders WHERE order_id = $order_id";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    die("Order not found.");
}

$status = $order['status'];
$delivery_method = $order['delivery_method'];

if ($status == 'Cancelled') {
    $status_steps = ['Cancelled'];
} else {
    $status_steps = ['Pending', 'Processing', 'Ready for Pickup', 'On the Way', 'Completed'];

    if ($delivery_method == 'pickup') {
        $status_steps = array_diff($status_steps, ['On the Way']);
    } elseif ($delivery_method == 'delivery') {
        $status_steps = array_diff($status_steps, ['Ready for Pickup']);
    }

    if ($status == 'Ready for Pickup') {
        $status_steps = array_diff($status_steps, ['On the Way']);
    } elseif ($status == 'On the Way' || $status == 'Completed') {
        $status_steps = array_diff($status_steps, ['Ready for Pickup']);
    }
}

$status_index = array_search($status, $status_steps);

?>

<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = "The Daily Grind | Track Orders";
include BASE_PATH . 'components/user/head.php';
?>

<body class="bg-light">
    <?php include BASE_PATH . 'components/user/header.php'; ?>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0 rounded-4 mt-5" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card-body p-5">
                        <h3 class="card-title text-center mb-4">Track Your Order</h3>

                        <p><strong>Order ID:</strong> <?php echo $order_id; ?></p>
                        <?php
                        $badgeClass = ($status == 'Cancelled') ? 'bg-danger' : 'bg-info';
                        ?>
                        <p><strong>Current Status:</strong> <span class="badge <?php echo $badgeClass; ?>"><?php echo $status; ?></span></p>
                        </p>

                    <div class="progress mb-4">
                        <?php foreach ($status_steps as $index => $step): ?>
                            <?php
                            if ($status == 'Cancelled') {
                                $barClass = 'bg-danger';
                            } elseif ($index <= $status_index) {
                                $barClass = 'bg-success';
                            } else {
                                $barClass = 'bg-light';
                            }
                            ?>
                            <div class="progress-bar <?php echo $barClass; ?>" style="width: <?php echo 100 / count($status_steps); ?>%;"
                                role="progressbar">
                                <?php echo $step; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                        <?php if ($status == 'Ready for Pickup' || $status == 'On the Way' || $status == 'Completed'): ?>
                            <h4 class="mt-4">Pickup Location Details</h4>

                            <?php if ($status == 'Ready for Pickup'): ?>
                                <iframe title="Pickup Location"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3920.550913468201!2d122.56701887444208!3d10.691923960747907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aee5255345f11b%3A0xb32057bb6b1d39c8!2sPHINMA%20UNIVERSITY%20OF%20ILOILO!5e0!3m2!1sen!2sph!4v1742176496392!5m2!1sen!2sph"
                                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                                <p><a href="https://www.google.com/maps/dir/?api=1&destination=PHINMA+UNIVERSITY+OF+ILOILO,+Iloilo+City"
                                        target="_blank">Click here for directions to Pickup Location</a></p>
                            <?php elseif ($status == 'On the Way'): ?>
                                <p><strong>Delivery Status:</strong> Your order is currently on the way!</p>
                                <p><strong>Estimated Delivery Time:</strong> 10-20 minutes</p>
                            <?php elseif ($status == 'Completed'): ?>
                                <p><strong>Delivery Completed:</strong> Your order has been successfully delivered.</p>
                                <p><strong>Delivery Address:</strong> <?php echo htmlspecialchars($order['address']); ?></p>
                            <?php endif; ?>

                        <?php endif; ?>

                        <div class="d-grid gap-2 mt-4 text-center">
                            <a href="orders.php" class="btn btn-primary btn-lg">Back to Orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include BASE_PATH . 'components/user/footer.php'; ?>
</body>

</html>