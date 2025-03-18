<?php
if (!isset($_SESSION['admin']['email'])) {
    $_SESSION['message'] = "You are not logged in as an admin!";
    $_SESSION['type'] = "error";
    ?>
    <script>
        location.href = "/thedailygrind/views/auth/login.php";
    </script>
    <?php
    exit();
}

$adminEmail = $_SESSION['admin']['email'];
$getAdmin = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$adminEmail'");
$admin = mysqli_fetch_assoc($getAdmin);

$name = $admin['name'];
$email = $admin['email'];

?>