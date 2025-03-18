<?php
$getUsers = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$userData = mysqli_fetch_assoc($getUsers);
$totalUsers = $userData['total'];

$getPreviousUsers = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)");
$prevUserData = mysqli_fetch_assoc($getPreviousUsers);
$previousUsers = $prevUserData['total'];

$percentageChange = 0;
if ($previousUsers > 0) {
    $percentageChange = (($totalUsers - $previousUsers) / $previousUsers) * 100;
}

$trendClass = ($percentageChange >= 0) ? 'text-success' : 'text-danger';
$trendIcon = ($percentageChange >= 0) ? 'fa-arrow-up' : 'fa-arrow-down';
?>