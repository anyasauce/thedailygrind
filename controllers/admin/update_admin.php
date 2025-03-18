<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';

if (isset($_POST['update_admin'])) {
    $newName = mysqli_real_escape_string($conn, $_POST['name']);
    $newEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['password']);

    $passwordUpdate = $newPassword ? ", password = '" . password_hash($newPassword, PASSWORD_DEFAULT) . "'" : "";

    $updateQuery = mysqli_query($conn, "UPDATE admin SET name = '$newName', email = '$newEmail' $passwordUpdate WHERE email = '{$_SESSION['admin']['email']}'");

    if ($updateQuery) {
        $_SESSION['admin']['email'] = $newEmail;
        $_SESSION['message'] = "Admin Profile Updated!";
        $_SESSION['type'] = "success";
        ?>
        <script>
            location.href = "../../admin/profile.php";
        </script>
        <?php
        exit();
    } else {
        $_SESSION['message'] = "Error updating profile.";
        $_SESSION['type'] = "error";
    }
}

?>