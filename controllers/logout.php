<?php
session_start();
session_destroy();
$_SESSION['message'] = "Logout successful!";
$_SESSION['type'] = "success";
?>

<script>
    location.href='/thedailygrind/index.php';
</script>