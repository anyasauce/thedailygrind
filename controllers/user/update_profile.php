<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

if (isset($_POST['update_profile'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $passwordUpdate = $password ? ", password = '" . password_hash($password, PASSWORD_DEFAULT) . "'" : "";
    $updateProfile = mysqli_query($conn, "UPDATE users SET fullname = '$fullname', email = '$email' $passwordUpdate WHERE user_id = '{$_SESSION['user']['user_id']}'");

    if ($updateProfile) {
        $userQuery = mysqli_query($conn, "SELECT fullname, email, user_id FROM users WHERE user_id = '{$_SESSION['user']['user_id']}'");
        $user = mysqli_fetch_assoc($userQuery);

        $_SESSION['user'] = [
            'email' => $user['email'],
            'user_id' => $user['user_id'],
            'fullname' => $user['fullname'],
        ];
        $_SESSION['message'] = "Updated Profile: " . $_SESSION['user']['fullname'] . "!";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['message'] = "Profile update failed.";
        $_SESSION['type'] = "danger";
    }
    ?>
    <script>
        location.href = '<?= route('user', 'profile'); ?>';
    </script>
    <?php
}
?>