<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

$email = $_SESSION['user']['email'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
$user = mysqli_fetch_assoc($result);

$user_id = $user['user_id'];
if (!isset($_SESSION['user']['email'])) {
    die("User not logged in.");
}

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if (isset($_POST['increase'])) {
        $increase = mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND id = $id");
        if ($increase) {
            ?>
            <script>
                location.href = "<?= route('user', 'cart'); ?>";
            </script>
            <?php
        } else {
            echo "Error updating quantity: " . mysqli_error($conn) . "<br>";
        }
    }

    if (isset($_POST['decrease'])) {
        $decrease = mysqli_query($conn, "UPDATE cart SET quantity = GREATEST(quantity - 1, 1) WHERE user_id = $user_id AND id = $id");
        if ($decrease) {
            ?>
            <script>
                location.href = "<?= route('user', 'cart'); ?>";
            </script>
            <?php
        } else {
            echo "Error updating quantity: " . mysqli_error($conn) . "<br>";
        }
    }

    if (isset($_POST['delete'])) {
        $delete = mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id AND id = $id");
        if ($delete) {
            ?>
            <script>
                location.href = "<?= route('user', 'cart'); ?>";
            </script>
            <?php
        } else {
            echo "Error deleting item: " . mysqli_error($conn) . "<br>";
        }
    }

    exit();
}



if (isset($_POST['update_order_status'])) {
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $status = "Cancelled";

    $updateOrderStatus = mysqli_query($conn, "UPDATE orders SET status = '$status' WHERE order_id = '$order_id'");

    if ($updateOrderStatus) {
        $_SESSION['message'] = "Your ordered successfully cancelled!";
        $_SESSION['type'] = "success";
        ?>
        <script>
            location.href = "<?= route('user', 'orders'); ?>";
        </script>
        <?php
    }
}
?>