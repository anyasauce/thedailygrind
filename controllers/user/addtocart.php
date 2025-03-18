<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

if (isset($_POST['addtocart'])) {
    $email = $_SESSION['user']['email'];
    $product_id = intval($_POST['product_id']);
    $product_name = $_POST['product_name'];

    $user_query = mysqli_query($conn, "SELECT user_id FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($user_query);
    $user_id = $user['user_id'];

    $check_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'");

    if (mysqli_num_rows($check_query) > 0) {
        mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id'");
        $_SESSION['message'] = "Quantity updated!";
        $_SESSION['type'] = "success";
        ?>
        <script>
            location.href = "<?= route('user', 'menu'); ?>";
        </script>
        <?php
    } else {
        mysqli_query($conn, "INSERT INTO cart (user_id, product_id, product_name, price, quantity, status) SELECT '$user_id', product_id, product_name, price, 1, 'Available' FROM products WHERE product_id = '$product_id'");
        $_SESSION['message'] = "Item added to cart!";
        $_SESSION['type'] = "success";
        ?>
        <script>
            location.href = "<?= route('user', 'menu'); ?>";
        </script>
        <?php
    }
}
?>