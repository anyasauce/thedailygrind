<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';

if (isset($_POST['update_profile'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $updateProfile = mysqli_query($conn, "UPDATE users SET fullname = '$fullname', email = '$email' WHERE user_id = '$user_id'");

    if ($updateProfile) {
        $_SESSION['message'] = "Successfully updated profile of user ID: $user_id!";
        $_SESSION['type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to update profile.";
        $_SESSION['type'] = "danger";
    }
    ?>
    <script>
        location.href = '<?= route('admin', 'users'); ?>';
    </script>
    <?php
}

if(isset($_POST['deleteUserAccount'])){
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $deleteUserAccount = mysqli_query($conn, "DELETE FROM users WHERE user_id = '$user_id'");
    if($deleteUserAccount){
    $_SESSION['message'] = "Successfully deleted profile of user ID: $user_id!";
    $_SESSION['type'] = "success";
    ?>
    <script>
        location.href = '<?= route('admin', 'users'); ?>';
    </script>
    <?php
    }
}
?>
