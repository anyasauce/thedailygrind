<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/admin/admin_session.php';

?>

<!DOCTYPE html>
<html lang="en">

<?php include '../components/admin/head.php'; ?>

<body>
    <?php include '../components/admin/sidebar.php'; ?>

    <div class="sidebar-overlay"></div>

    <div id="content">
        <?php include '../components/admin/header.php'; ?>

        <section>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h2 class="card-title mb-0">Admin Profile</h2>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="../controllers/admin/update_admin.php">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="<?php echo htmlspecialchars($name); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            value="<?php echo htmlspecialchars($email); ?>" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="password" class="form-label">New Password (optional):</label>
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Enter new password if you want to change it">
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" name="update_admin" class="btn btn-primary btn-lg">Update Profile</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include '../components/admin/footer.php'; ?>
    </div>

</body>

</html>