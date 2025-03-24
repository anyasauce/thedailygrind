<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/admin/admin_session.php';

$getUsers = mysqli_query($conn, "SELECT * FROM users ORDER BY user_id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "The Daily Grind | Users";
include '../components/admin/head.php'; ?>

<body>
    <?php include '../components/admin/sidebar.php'; ?>

    <div class="sidebar-overlay"></div>

    <div id="content">
        <?php include '../components/admin/header.php'; ?>

        <section>
            <div class="container-fluid">
                <h2 class="my-4">User Management</h2>

                <div class="table-responsive">
                    <table id="usersTable" class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($user = mysqli_fetch_assoc($getUsers)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                                    <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#updateModal<?php echo $user['user_id']; ?>">
                                            Update
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal<?php echo $user['user_id']; ?>">
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                                <!-- Update User Modal -->
                                <div class="modal fade" id="updateModal<?php echo $user['user_id']; ?>" tabindex="-1"
                                    aria-labelledby="updateModalLabel<?php echo $user['user_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="updateModalLabel<?php echo $user['user_id']; ?>">Update User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="<?= route('admin', 'update_userprofile'); ?>" method="POST">
                                                <div class="modal-body">
                                                    <input type="hidden" name="user_id"
                                                        value="<?php echo $user['user_id']; ?>">

                                                    <div class="mb-3">
                                                        <label for="fullname<?php echo $user['user_id']; ?>"
                                                            class="form-label">Full Name</label>
                                                        <input type="text" class="form-control"
                                                            id="fullname<?php echo $user['user_id']; ?>" name="fullname"
                                                            value="<?php echo htmlspecialchars($user['fullname']); ?>"
                                                            required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email<?php echo $user['user_id']; ?>"
                                                            class="form-label">Email</label>
                                                        <input type="email" class="form-control"
                                                            id="email<?php echo $user['user_id']; ?>" name="email"
                                                            value="<?php echo htmlspecialchars($user['email']); ?>"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="update_profile" class="btn btn-primary">Save
                                                        Changes</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete User Modal -->
                                <div class="modal fade" id="deleteModal<?php echo $user['user_id']; ?>" tabindex="-1"
                                    aria-labelledby="deleteModalLabel<?php echo $user['user_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="deleteModalLabel<?php echo $user['user_id']; ?>">Delete User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="<?= route('admin', 'update_userprofile'); ?>" method="POST">
                                                <div class="modal-body">
                                                    Are you sure you want to delete
                                                    <strong><?php echo htmlspecialchars($user['fullname']); ?></strong>?
                                                    <input type="hidden" name="user_id"
                                                        value="<?php echo $user['user_id']; ?>">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="deleteUserAccount"
                                                        class="btn btn-danger">Delete</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <?php include '../components/admin/footer.php'; ?>
    </div>

    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable();
        });
    </script>

</body>

</html>