<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

if (isset($_POST['addtocart'])) {
    if (isset($_POST['size']) && !empty($_POST['size'])) {
        $email = $_SESSION['user']['email'];
        $product_id = intval($_POST['product_id']);
        $size = $_POST['size'];
        $price = floatval($_POST['size_price']);

        $user_query = mysqli_query($conn, "SELECT user_id FROM users WHERE email = '$email'");
        $user = mysqli_fetch_assoc($user_query);
        $user_id = $user['user_id'];

        $check_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' AND size = '$size'");

        if (mysqli_num_rows($check_query) > 0) {
            mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id' AND size = '$size'");
            $_SESSION['message'] = "Quantity updated!";
            $_SESSION['type'] = "success";
        } else {
            $product_query = mysqli_query($conn, "SELECT product_name FROM products WHERE product_id = '$product_id'");
            $product = mysqli_fetch_assoc($product_query);
            $product_name = $product['product_name'];

            mysqli_query($conn, "INSERT INTO cart (user_id, product_id, product_name, price, quantity, size, status) 
                VALUES ('$user_id', '$product_id', '$product_name', '$price', 1, '$size', 'Available')");

            $_SESSION['message'] = "Item added to cart!";
            $_SESSION['type'] = "success";
        }

        ?>
        <script>
            location.href = "<?= route('user', 'menu'); ?>";
        </script>
        <?php
    } else {
        $_SESSION['message'] = "Please select a size before adding to cart.";
        $_SESSION['type'] = "danger";
        ?>
        <script>
            location.href = "<?= route('user', 'menu'); ?>";
        </script>
        <?php
    }
}
?>