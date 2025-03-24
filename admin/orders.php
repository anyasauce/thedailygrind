<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/admin/admin_session.php';

$query = "
    SELECT 
        o.order_id AS 'Order ID',
        u.fullname AS 'Customer Name',
        u.email AS 'Customer Email',
        o.phone,
        GROUP_CONCAT(CONCAT(p.product_name, ' (x', oi.quantity, ')') SEPARATOR ', ') AS items,
        SUM(oi.quantity) AS total_items,  -- Count total quantity of items ordered
        o.address,
        o.total,
        o.tax,
        o.delivery_fee,
        o.payment_method,
        o.delivery_method,
        o.notes,
        o.status,
        o.created_at
    FROM orders o
    JOIN users u ON o.user_id = u.user_id
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN products p ON oi.product_id = p.product_id
    WHERE o.status != 'Cancelled'
    GROUP BY o.order_id
    ORDER BY o.created_at DESC
";


$getOrders = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "The Daily Grind | Orders";
include '../components/admin/head.php'; 
?>

<body>
    <?php include '../components/admin/sidebar.php'; ?>

    <div class="sidebar-overlay"></div>

    <div id="content">
        <?php include '../components/admin/header.php'; ?>

        <section>
            <div class="container-fluid">
                <h2 class="my-4">Orders Management</h2>

                <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">Pending</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing" type="button" role="tab">Processing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pickup-tab" data-bs-toggle="tab" data-bs-target="#pickup" type="button" role="tab">Pick Up</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#delivery" type="button" role="tab">Delivery</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="delivery-tab" data-bs-toggle="tab" data-bs-target="#complete" type="button" role="tab">Complete</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab">Cancelled</button>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="orderTabsContent">

                    <!-- Pending Orders -->
                    <div class="tab-pane fade show active" id="pending" role="tabpanel">
                        <h3>Pending Orders</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    mysqli_data_seek($getOrders, 0);
                                    while ($order = mysqli_fetch_assoc($getOrders)):
                                        if ($order['status'] === 'Pending'):
                                    ?>
                                    <tr>
                                        <td><?php echo $order['Order ID']; ?></td>
                                        <td><?php echo $order['Customer Name']; ?></td>
                                        <td><?php echo $order['Customer Email']; ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal<?php echo $order['Order ID']; ?>">View Details</button>
                                        </td>
                                    </tr>
                                    <?php include 'order_modal.php'; ?>
                                    <?php endif; endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Processing Orders -->
                    <div class="tab-pane fade" id="processing" role="tabpanel">
                        <h3>Processing Orders</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    mysqli_data_seek($getOrders, 0);
                                    while ($order = mysqli_fetch_assoc($getOrders)):
                                        if ($order['status'] === 'Processing'):
                                    ?>
                                    <tr>
                                        <td><?php echo $order['Order ID']; ?></td>
                                        <td><?php echo $order['Customer Name']; ?></td>
                                        <td><?php echo $order['Customer Email']; ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal<?php echo $order['Order ID']; ?>">View Details</button>
                                            <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#printModal<?php echo $order['Order ID']; ?>">
                                                <i class="bi bi-printer-fill"></i> Print Order
                                            </button>
                                        </td>
                                    </tr>
                                    <?php include 'order_modal.php'; ?>

                                    <?php include 'print_modal.php'; ?>
                                    <?php endif; endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pick Up Orders -->
                    <div class="tab-pane fade" id="pickup" role="tabpanel">
                        <h3>Pick Up Orders</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    mysqli_data_seek($getOrders, 0);
                                    while ($order = mysqli_fetch_assoc($getOrders)):
                                        if ($order['delivery_method'] === 'pickup'):
                                    ?>
                                    <tr>
                                        <td><?php echo $order['Order ID']; ?></td>
                                        <td><?php echo $order['Customer Name']; ?></td>
                                        <td><?php echo $order['Customer Email']; ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal<?php echo $order['Order ID']; ?>">View Details</button>
                                        </td>
                                    </tr>
                                    <?php include 'order_modal.php'; ?>
                                    <?php endif; endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Delivery Orders -->
                    <div class="tab-pane fade" id="delivery" role="tabpanel">
                        <h3>Delivery Orders</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    mysqli_data_seek($getOrders, 0);
                                    while ($order = mysqli_fetch_assoc($getOrders)):
                                        if ($order['delivery_method'] === 'delivery'):
                                    ?>
                                    <tr>
                                        <td><?php echo $order['Order ID']; ?></td>
                                        <td><?php echo $order['Customer Name']; ?></td>
                                        <td><?php echo $order['Customer Email']; ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal<?php echo $order['Order ID']; ?>">View Details</button>
                                        </td>
                                    </tr>
                                    <?php include 'order_modal.php'; ?>
                                    <?php endif; endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Complete Orders -->
                    <div class="tab-pane fade" id="complete" role="tabpanel">
                        <h3>Delivery Orders</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    mysqli_data_seek($getOrders, 0);
                                    while ($order = mysqli_fetch_assoc($getOrders)):
                                        if ($order['status'] === 'Completed'):
                                    ?>
                                    <tr>
                                        <td><?php echo $order['Order ID']; ?></td>
                                        <td><?php echo $order['Customer Name']; ?></td>
                                        <td><?php echo $order['Customer Email']; ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal<?php echo $order['Order ID']; ?>">View Details</button>
                                        </td>
                                    </tr>
                                    <?php include 'order_modal.php'; ?>
                                    <?php endif; endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Cancelled Orders -->
                    <div class="tab-pane fade" id="cancelled" role="tabpanel">
                        <h3>Cancelled Orders</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $cancelledQuery = "
                                        SELECT 
                                            o.order_id AS 'Order ID',
                                            u.fullname AS 'Customer Name',
                                            u.email AS 'Customer Email',
                                            o.phone, 
                                            GROUP_CONCAT(CONCAT(p.product_name, ' (x', oi.quantity, ')') SEPARATOR ', ') AS items, 
                                            o.address,
                                            o.total, 
                                            o.tax, 
                                            o.delivery_fee, 
                                            o.payment_method, 
                                            o.delivery_method, 
                                            o.notes, 
                                            o.status, 
                                            o.created_at
                                        FROM orders o
                                        JOIN users u ON o.user_id = u.user_id
                                        JOIN order_items oi ON o.order_id = oi.order_id
                                        JOIN products p ON oi.product_id = p.product_id
                                        WHERE o.status = 'Cancelled'
                                        GROUP BY o.order_id
                                        ORDER BY o.created_at DESC
                                    ";

                                    $getCancelledOrders = mysqli_query($conn, $cancelledQuery);

                                    while ($order = mysqli_fetch_assoc($getCancelledOrders)):
                                        ?>
                                        <tr>
                                            <td><?php echo $order['Order ID']; ?></td>
                                            <td><?php echo $order['Customer Name']; ?></td>
                                            <td><?php echo $order['Customer Email']; ?></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#orderModal<?php echo $order['Order ID']; ?>">View Details</button>
                                            </td>
                                        </tr>
                                        <?php include 'order_modal.php'; ?>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <?php include '../components/admin/footer.php'; ?>
    </div>

    <script>
        $(document).ready(function () {
            $('.table').DataTable();
        });
    </script>

</body>
</html>