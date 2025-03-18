<?php
$currentFile = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['user']['email'])) {
    if ($currentFile !== 'menu.php') {
        $_SESSION['message'] = "You are not logged in as a user!";
        $_SESSION['type'] = "error";
        ?>
        <script>
            location.href = "/thedailygrind/index.php";
        </script>
        <?php
        exit();
    }
} else {
    $email = $_SESSION['user']['email'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);
    $user_id = $user['user_id'];
}


?>