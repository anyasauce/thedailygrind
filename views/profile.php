<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/user/user_session.php';

?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "The Daily Grind | My Profile";
include BASE_PATH . 'components/user/head.php';
?>

<body class="bg-light">
    <?php include BASE_PATH . 'components/user/header.php'; ?>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-lg border-0 rounded-4 mt-5" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <div class="card-body p-5">
                        <h3 class="card-title text-center mb-4">Update User</h3>

                        <form action="<?= route('user', 'update_profile'); ?>" method="POST">
                            <!-- Hidden User ID -->
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">

                            <!-- Full Name -->
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" placeholder="Enter full name" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Enter email" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Leave blank to keep current)</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" name="update_profile" class="btn btn-primary btn-lg">Update User</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include BASE_PATH . 'components/user/footer.php'; ?>

</body>

</html>
