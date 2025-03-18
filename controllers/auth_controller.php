<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';

if (isset($_POST['register'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    if (mysqli_num_rows($check_email) > 0) {
        $_SESSION['message'] = "Email is already registered!";
        $_SESSION['type'] = "error";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insertUser = mysqli_query($conn, "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_password')");
        if ($insertUser) {
            $_SESSION['message'] = "Registration successful!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Error: " . mysqli_error($conn);
            $_SESSION['type'] = "error";
        }
    }
    ?>
    <script>
        location.href="<?= route('user', 'login'); ?>";
    </script>
    <?php
    exit();
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'email' => $user['email'],
            'user_id' => $user['user_id'],
            'fullname' => $user['fullname']
        ];
        $_SESSION['message'] = "Welcome " . $_SESSION['user']['fullname'] . "!";
        $_SESSION['type'] = "success";
        ?>
        <script>
            location.href="<?= route('user', 'home'); ?>";
        </script>
        <?php
    } else {
        $result = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'");
        $admin = mysqli_fetch_assoc($result);

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = [
                'email' => $admin['email'],
            ];
            $_SESSION['message'] = "Welcome Admin!";
            $_SESSION['type'] = "success";

            ?>
            <script>
                location.href="<?= route('admin', 'dashboard'); ?>";
            </script>
            <?php
        } else {
            $_SESSION['message'] = "Invalid email or password!";
            $_SESSION['type'] = "error";
            ?>
            <script>
                location.href="<?= route('user', 'login'); ?>";
            </script>
            <?php
        }
    }
    exit();
}

?>