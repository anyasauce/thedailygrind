<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/config/config.php';
include BASE_PATH . 'components/admin/admin_session.php';

$getProducts = mysqli_query($conn, "SELECT * FROM products ORDER BY product_id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = "The Daily Grind | Products";
include '../components/admin/head.php'; ?>

<body>
    <?php include '../components/admin/sidebar.php'; ?>

    <div class="sidebar-overlay"></div>

    <div id="content">
        <?php include '../components/admin/header.php'; ?>

        <section>
            <div class="container-fluid">
                <h2 class="my-4">Product Management</h2>

                <div class="d-flex justify-content-between">

                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#categoryModal">
                        Add Category
                    </button>
                </div>

                <hr>

                <div class="row">
                <h2 class="mb-3">Category</h2>
                <?php
                    $categories = $conn->query("SELECT c.category_id, c.category_name, COUNT(p.product_id) as product_count FROM category c LEFT JOIN products p ON c.category_name = p.category GROUP BY c.category_id");
                    while ($category = $categories->fetch_assoc()):
                        ?>
                        <div class="col-md-4">
                            <div class="card p-3 shadow-sm">
                                <i class="bi bi-cup text-center fs-1"></i>
                                <h3 class="text-center fw-bold"> <?= $category['category_name']; ?> </h3>
                                <p class="text-center mb-3">Products: <span class="fw-bold"> <?= $category['product_count']; ?> </span></p>
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex justify-content-center">
                                    <a href="view_products.php?category_id=<?= $category['category_id']; ?>&category_name=<?= urlencode($category['category_name']); ?>" class="btn btn-outline-primary">
                                        View Products
                                    </a>
                                </div>

                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

            </div>
        </section>

        <?php include '../components/admin/footer.php'; ?>
    </div>

    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Category Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="<?= route('controllers', 'product_controller'); ?>" method="POST">
                    <div class="modal-body">

                        <div class="col-md-12">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_name" id="category_name" required>
                        </div>

                    <div class="modal-footer">
                        <button type="submit" name="add_category" class="btn btn-success">Save Category</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>