<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';

if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $updateOrder = mysqli_query($conn, "UPDATE orders SET status = '$status' WHERE order_id = '$order_id'");

    if ($updateOrder) {
        $_SESSION['message'] = "Successfully updated order status for Order ID: $order_id!";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to update order status.";
        $_SESSION['type'] = "danger";
    }
    ?>
    <script>
        location.href = '<?= route('admin', 'orders'); ?>';
    </script>
    <?php
}
?>