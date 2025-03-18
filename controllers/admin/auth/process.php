<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';

if (isset($_POST['admin_login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'");
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['message'] = "Admin login successful!";
        $_SESSION['type'] = "success";
        ?>
        <script>
            location.href = "/thedailygrind/admin/admin.php";
        </script>
        <?php
    } else {
        $_SESSION['message'] = "Invalid email or password!";
        $_SESSION['type'] = "error";
        ?>
        <script>
            location.href = "/thedailygrind/views/auth/admin_login.php";
        </script>
        <?php
    }
    exit();
}

?>