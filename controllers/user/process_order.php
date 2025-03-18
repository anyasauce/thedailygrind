<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

if (!isset($_SESSION['user']['user_id'])) {
    die("User not logged in.");
}
$user_id = $_SESSION['user']['user_id'];

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$region = $_POST['region'];
$zip = $_POST['zip'];
$notes = $_POST['notes'];
$paymentMethod = $_POST['paymentMethod'];
$deliveryMethod = $_POST['deliveryMethod'];

$cart_items = json_decode($_POST['cart_items'], true);
$subtotal = $_POST['subtotal'];
$tax = $_POST['tax'];
$delivery_fee = $_POST['delivery_fee'];
$total = $_POST['total'];

if ($deliveryMethod == 'pickup') {
    $paymentMethod = NULL;
} else {
    $paymentMethod = $_POST['paymentMethod'];
}

$orders = mysqli_query($conn, "INSERT INTO orders (
    user_id, email, fullname, total, tax, delivery_fee, payment_method, delivery_method,
    address, city, region, zip, phone, notes, status, created_at
) VALUES (
    '$user_id', '$email', '$fullname', '$total', '$tax', '$delivery_fee', " .
    ($paymentMethod !== NULL ? "'$paymentMethod'" : "NULL") . ", '$deliveryMethod',
    '$address', '$city', '$region', '$zip', '$phone', '$notes', 'Pending', NOW()
)");

if ($orders) {
    $order_id = mysqli_insert_id($conn);

    foreach ($cart_items as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $price = $item['price'];

        $query = mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')");
        mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");
    }
    $_SESSION['user']['order_id'] = $order_id;
    ?>
    <script>
        location.href = "<?= route('user', 'receipt'); ?>";
    </script>
    <?php
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>